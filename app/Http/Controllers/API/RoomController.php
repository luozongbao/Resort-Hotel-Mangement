<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function index()
    {
        return RoomResource::collection(Room::with(['accommodationLocation', 'accommodationType', 'roomType'])->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:available,occupied,maintenance',
            'accommodation_location_id' => 'required|exists:accommodation_locations,id',
            'accommodation_type_id' => 'required|exists:accommodation_types,id',
            'room_type_id' => 'required|exists:room_types,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $room = Room::create($validator->validated());
        $room->load(['accommodationLocation', 'accommodationType', 'roomType']);

        return new RoomResource($room);
    }

    public function show(Room $room)
    {
        $room->load(['accommodationLocation', 'accommodationType', 'roomType']);
        return new RoomResource($room);
    }

    public function update(Request $request, Room $room)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|string|in:available,occupied,maintenance',
            'accommodation_location_id' => 'sometimes|required|exists:accommodation_locations,id',
            'accommodation_type_id' => 'sometimes|required|exists:accommodation_types,id',
            'room_type_id' => 'sometimes|required|exists:room_types,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $room->update($validator->validated());
        $room->load(['accommodationLocation', 'accommodationType', 'roomType']);

        return new RoomResource($room);
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return response()->noContent();
    }
}
