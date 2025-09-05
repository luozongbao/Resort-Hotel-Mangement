<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomTypeResource;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomTypeController extends Controller
{
    public function index()
    {
        return RoomTypeResource::collection(RoomType::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'amenities' => 'nullable|json',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $roomType = RoomType::create($validator->validated());

        return new RoomTypeResource($roomType);
    }

    public function show(RoomType $roomType)
    {
        return new RoomTypeResource($roomType);
    }

    public function update(Request $request, RoomType $roomType)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'sometimes|required|integer|min:1',
            'amenities' => 'nullable|json',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $roomType->update($validator->validated());

        return new RoomTypeResource($roomType);
    }

    public function destroy(RoomType $roomType)
    {
        $roomType->delete();

        return response()->noContent();
    }
}
