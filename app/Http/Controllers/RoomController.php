<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Apartment;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /*
     * Выводим комнаты для квартиры
     * */
    public function index(Apartment $apartment)
    {
        $rooms = $apartment->rooms;
        return response($rooms);
    }
    /*
     * Выводим отдельную комнату квартиры
     * */
    public function show(Apartment $apartment, Room $room)
    {
        return response($room);
    }

    public function store(Apartment $apartment, RoomRequest $roomRequest)
    {
        Room::create($roomRequest->all());
        return response(['status' => 'success']);
    }
}
