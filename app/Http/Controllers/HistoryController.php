<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoryRequest;
use App\Models\Apartment;
use App\Models\History;
use App\Models\Room;

class HistoryController extends Controller
{
    public function showApartmentHistory($id, HistoryRequest $request)
    {
        $apartment = Apartment::findOrFail($id);

        if($request->isMethod('post'))
        {
            $datetime = $request->input('datetime');
            return response(History::whereIn('room_id', $apartment->rooms->pluck('id'))
                ->where('start_datetime', '<=', $datetime)
                ->where(function($query) use ($datetime) {
                    $query->where('end_datetime', '>=', $datetime);
                    $query->orWhereNull('end_datetime');
                })
                ->get());
        }

        return response(History::whereIn('room_id', $apartment->rooms->pluck('id'))->get());
    }

    public function  showRoomHistory($id, HistoryRequest $request)
    {
        $room = Room::findOrFail($id);

        if($request->isMethod('post'))
        {
            $datetime = $request->input('datetime');
            return response(History::with('furniture')
                ->where('room_id', $room->id)
                ->where('start_datetime', '<=', $datetime)
                ->where(function($query) use ($datetime) {
                    $query->where('end_datetime', '>=', $datetime);
                    $query->orWhereNull('end_datetime');
                })
                ->get());
        }

        return response(History::with('furniture')->where('room_id', $room->id)->get());
    }


}
