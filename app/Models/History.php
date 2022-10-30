<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class History extends BaseModel
{
    use HasFactory;

    protected $with = ['furniture'];
    protected $dates = ['start_datetime', 'end_datetime'];
    protected $fillable  = ['furniture_id', 'room_id', 'start_datetime', 'end_datetime'];

    public function furniture()
    {
        return $this->belongsTo(Furniture::class)->withTrashed();
    }
}
