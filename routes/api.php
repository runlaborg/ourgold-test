<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\FurnitureController;
use \App\Http\Controllers\HistoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::apiResource('apartments',ApartmentController::class)
    ->only(['index', 'show', 'store']);
Route::apiResource('apartments.rooms',RoomController::class)
    ->only(['index', 'show', 'store'])
    ->scoped();
Route::apiResource('apartments.rooms.furniture',FurnitureController::class)
    ->only(['index', 'show', 'store', 'update', 'destroy'])
    ->scoped();

Route::match(['get', 'post'], 'history/apartment/{id}', [HistoryController::class, 'showApartmentHistory']);
Route::match(['get', 'post'], 'history/room/{id}', [HistoryController::class, 'showRoomHistory']);
