<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccommodationTypeResource;
use App\Models\AccommodationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccommodationTypeController extends Controller
{
    public function index()
    {
        return AccommodationTypeResource::collection(AccommodationType::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:accommodation_types,name',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $type = AccommodationType::create($validator->validated());

        return new AccommodationTypeResource($type);
    }

    public function show(AccommodationType $accommodationType)
    {
        return new AccommodationTypeResource($accommodationType);
    }

    public function update(Request $request, AccommodationType $accommodationType)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255|unique:accommodation_types,name,' . $accommodationType->id,
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $accommodationType->update($validator->validated());

        return new AccommodationTypeResource($accommodationType);
    }

    public function destroy(AccommodationType $accommodationType)
    {
        $accommodationType->delete();

        return response()->noContent();
    }
}
