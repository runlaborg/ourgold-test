<?php

namespace App\Http\Controllers;

use App\Http\Requests\FurnitureRequest;
use App\Models\Apartment;
use App\Models\Room;
use Illuminate\Http\Request;
use  App\Models\Furniture;

class FurnitureController extends Controller
{
    public function index(Apartment $apartment, Room $room)
    {
        $furniture = $room->furniture()->get();
        return response($furniture);
    }

    public function show(Apartment $apartment, Room $room, Furniture $furniture)
    {
        return response($furniture);
    }

    public function store(Apartment $apartment, Room $room, FurnitureRequest $furnitureRequest)
    {
        Furniture::create($furnitureRequest->all());
        return response(['status' => 'created']);
    }

    public function update(Apartment $apartment, Room $room, Furniture $furniture, FurnitureRequest $furnitureRequest)
    {
        $furniture->fill($furnitureRequest->all());
        $furniture->save();
        return response(['status' => 'updated']);
    }

    public function destroy(Apartment $apartment, Room $room, Furniture $furniture)
    {
        $furniture->delete();
        return response(['status' => 'deleted']);
    }
}
