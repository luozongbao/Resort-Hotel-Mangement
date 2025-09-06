<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AccommodationLocationController;
use App\Http\Controllers\API\AccommodationTypeController;
use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\RoomTypeController;

Route::apiResource('accommodation-locations', AccommodationLocationController::class)->middleware('can:manage-accommodation-locations');
Route::apiResource('accommodation-types', AccommodationTypeController::class)->middleware('can:manage-accommodation-types');
Route::apiResource('room-types', RoomTypeController::class)->middleware('can:manage-room-types');
Route::apiResource('rooms', RoomController::class)->middleware('can:manage-rooms');
