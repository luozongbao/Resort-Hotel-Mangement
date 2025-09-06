<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccommodationLocationResource;
use App\Models\AccommodationLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccommodationLocationController extends Controller
{
    public function index()
    {
        return AccommodationLocationResource::collection(AccommodationLocation::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $location = AccommodationLocation::create($validator->validated());

        return new AccommodationLocationResource($location);
    }

    public function show(AccommodationLocation $accommodationLocation)
    {
        return new AccommodationLocationResource($accommodationLocation);
    }

    public function update(Request $request, AccommodationLocation $accommodationLocation)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $accommodationLocation->update($validator->validated());

        return new AccommodationLocationResource($accommodationLocation);
    }

    public function destroy(AccommodationLocation $accommodationLocation)
    {
        $accommodationLocation->delete();

        return response()->noContent();
    }
}
