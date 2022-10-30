<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends BaseModel
{
    use HasFactory;

    protected $with = ['rooms'];
    protected $withCount = ['rooms', 'furniture'];
    protected $visible = ['id', 'title', 'rooms_count', 'furniture_count', 'rooms'];
    protected $fillable = ['title'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function furniture()
    {
        return $this->hasManyThrough(Furniture::class, Room::class);
    }
}
