<?php

namespace App\Http\Controllers\Api;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::with('type')->get();

        return response()->json($vehicles, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'license' => 'required',
            'axles' => 'nullable | integer | between:1,3',
            'type' => 'required | exists:types,type',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Los datos introducidos no son correctos',
                'errors' => $validator->errors(),
            ], 400);
        }

        $validated = $validator->validate();

        $vehicleType = Type::where('type', $validated['type'])->first();

        if($vehicleType->type == 'truck' && empty($validated['axles'])) {
            return response()->json([
                'message' => 'Number of axles is required for trucks',
            ], 400);
        }

        $vehicle = Vehicle::create([
            'license' => $validated['license'],
            'id_type' => $vehicleType->id,
            'axles' => $vehicleType->type === 'truck' ? $validated['axles'] : null,
        ]);

        $vehicle->save();

        return response()->json($vehicle, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehicle = Vehicle::with('type')->findOrFail($id);

        return response()->json($vehicle, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'license' => 'required',
            'axles' => 'nullable | integer | between:1,3',
            'type' => 'required | exists:types,type',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Los datos introducidos no son correctos',
                'errors' => $validator->errors(),
            ], 400);
        }

        $validated = $validator->validate();

        $vehicleType = Type::where('type', $validated['type'])->first();

        if($vehicleType->type == 'truck' && empty($validated['axles'])) {
            return response()->json([
                'message' => 'Number of axles is required for trucks',
            ], 400);
        }

        $vehicle->update([
            'license' => $validated['license'],
            'axles' => $vehicleType->type === 'truck' ? $validated['axles'] : null,
            'id_type' => $vehicleType->id,
        ]);
        $vehicle->save();

        return response()->json($vehicle, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return response()->json([
            'message' => 'Vehicle deleted',
        ], 200);
    }
}
