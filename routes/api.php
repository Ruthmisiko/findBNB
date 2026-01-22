<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('counties', App\Http\Controllers\API\CountyAPIController::class);

Route::resource('areas', App\Http\Controllers\API\AreaAPIController::class);

Route::resource('room-types', App\Http\Controllers\API\RoomTypeAPIController::class);

Route::resource('airbnbs', App\Http\Controllers\API\AirbnbAPIController::class);

Route::resource('host-details', App\Http\Controllers\API\HostDetailAPIController::class);