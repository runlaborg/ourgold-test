<?php

namespace App\Models;

use App\Models\History;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Furniture extends BaseModel
{
    use HasFactory, SoftDeletes;

    const CHAIR = 'chair';
    const TABLE = 'table';
    const SOFA = 'sofa';

    const PLASTIC = 'plastic';
    const METAL = 'metal';
    const WOOD = 'wood';

    public static $types = [self::CHAIR, self::TABLE, self::SOFA];
    public static $materials = [self::PLASTIC, self::METAL, self::WOOD];

    protected $visible = ['id', 'room_id', 'title', 'type', 'color', 'material', 'deleted_at'];
    protected $fillable = ['room_id', 'title', 'type', 'material', 'color'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function(Furniture $furniture) {
            History::create([
                'furniture_id' => $furniture->id,
                'room_id' => $furniture->room_id,
                'start_datetime' => $furniture->created_at,
                //'end_datetime' => null,
            ]);
        });

        static::updated(function(Furniture  $furniture) {
            if($furniture->wasChanged('room_id'))
            {
                History::where('furniture_id', $furniture->id)
                    ->where('room_id', $furniture->getOriginal('room_id'))
                    ->latest()
                    ->first()
                    ->update([
                        'end_datetime' => Carbon::now(),
                    ]);
                History::create([
                    'furniture_id' =>  $furniture->id,
                    'room_id' => $furniture->room_id,
                    'start_datetime' => Carbon::now(),
                ]);
            }
        });

        static::deleted(function(Furniture $furniture) {
            History::where('furniture_id', $furniture->id)->latest()->first()->update([
                'end_datetime' => Carbon::now(),
            ]);
        });

        static::restored(function(Furniture $furniture) {
            History::create([
                'furniture_id' =>  $furniture->id,
                'room_id' => $furniture->room_id,
                'start_datetime' => Carbon::now(),
            ]);
        });
    }
}
