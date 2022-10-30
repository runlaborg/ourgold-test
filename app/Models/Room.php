<?php

namespace App\Models;

use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends BaseModel
{
    use HasFactory;

    const KITCHEN = 'kitchen';
    const BATHROOM = 'bathroom';
    const HALLWAY = 'hallway';
    const LIVING_ROOM = 'living_room';

    public static $types = [self::KITCHEN, self::BATHROOM, self::HALLWAY, self::LIVING_ROOM];

    protected $withCount = ['furniture'];
    protected $with  =  ['furniture'];
    protected $visible = ['id','apartment_id', 'type', 'title', 'furniture_count'];
    protected $fillable = ['apartment_id', 'type', 'title'];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
    public function furniture()
    {
        return $this->hasMany(Furniture::class);
    }
}
