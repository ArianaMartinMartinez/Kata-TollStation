<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stations_Vehicles;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StationVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pivots = Stations_Vehicles::with('station', 'vehicle.type')->get();

        return response()->json($pivots, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_station' => 'required | exists:stations,id',
            'id_vehicle' => 'required | exists:vehicles,id',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Introduced data is not correct',
                'errors' => $validator->errors(),
            ], 400);
        }

        $validated = $validator->validate();

        $vehicle = Vehicle::with('type')->findOrFail($validated['id_vehicle']);

        $amount = 0;
        if($vehicle->type->type === 'truck') {
            $amount = $vehicle->axles * $vehicle->type->price;
        } else {
            $amount = $vehicle->type->price;
        }

        $toll = Stations_Vehicles::create([
            'id_station' => $validated['id_station'],
            'id_vehicle' => $validated['id_vehicle'],
            'amount' => $amount,
        ]);

        $toll->save();

        $fullToll = Stations_Vehicles::with('station', 'vehicle')->findOrFail($toll->id);

        return response()->json($fullToll, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pivot = Stations_Vehicles::with('station', 'vehicle.type')->findOrFail($id);

        return response()->json($pivot, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $toll = Stations_Vehicles::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'id_station' => 'required | exists:stations,id',
            'id_vehicle' => 'required | exists:vehicles,id',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Introduced data is not correct',
                'errors' => $validator->errors(),
            ], 400);
        }

        $validated = $validator->validate();

        $vehicle = Vehicle::with('type')->findOrFail($validated['id_vehicle']);

        $amount = 0;
        if($vehicle->type->type === 'truck') {
            $amount = $vehicle->axles * $vehicle->type->price;
        } else {
            $amount = $vehicle->type->price;
        }

        $toll->update([
            'id_station' => $validated['id_station'],
            'id_vehicle' => $validated['id_vehicle'],
            'amount' => $amount,
        ]);

        $toll->save();

        $fullToll = Stations_Vehicles::with('station', 'vehicle')->findOrFail($toll->id);

        return response()->json($fullToll, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $toll = Stations_Vehicles::findOrFail($id);
        $toll->delete();

        return response()->json([
            'message' => 'Toll deleted',
        ], 200);
    }
}
