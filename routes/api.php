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
Route::get('counties/{id}/areas', function ($id) {
    $county = \App\Models\County::with('areas')->find($id);
    if (empty($county)) {
        return response()->json(['success' => false, 'message' => 'County not found'], 404);
    }
    return response()->json(['success' => true, 'data' => $county->areas]);
});

Route::resource('areas', App\Http\Controllers\API\AreaAPIController::class);

Route::resource('room-types', App\Http\Controllers\API\RoomTypeAPIController::class);

Route::resource('airbnbs', App\Http\Controllers\API\AirbnbAPIController::class);

Route::resource('host-details', App\Http\Controllers\API\HostDetailAPIController::class);

// Admin Authentication
Route::post('admin/login', [App\Http\Controllers\API\AdminAuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('admin/me', [App\Http\Controllers\API\AdminAuthController::class, 'me']);
    Route::post('admin/logout', [App\Http\Controllers\API\AdminAuthController::class, 'logout']);
});