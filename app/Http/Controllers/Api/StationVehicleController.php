<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stations_Vehicles;
use Illuminate\Http\Request;

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
