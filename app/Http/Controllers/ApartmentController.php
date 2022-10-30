<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApartmentRequest;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::all();
        return response($apartments);
    }

    public function show($id)
    {
        $apartment = Apartment::findOrFail($id);
        return response($apartment);
    }

    public function store(ApartmentRequest $apartmentRequest)
    {
        Apartment::create($apartmentRequest->all());
        return response(['status' => 'success']);
    }
}
