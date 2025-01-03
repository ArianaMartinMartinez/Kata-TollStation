<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stations = Station::all();

        return response()->json($stations, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required | string',
            'city' => 'required | string',
            'total_collected' => 'required | integer',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Introduced data is not correct',
                'errors' => $validator->errors(),
            ], 400);
        }

        $validated = $validator->validate();

        $station = Station::create([
            'name' => $validated['name'],
            'city' => $validated['city'],
            'total_collected' => $validated['total_collected'],
        ]);
        $station->save();

        return response()->json($station, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $station = Station::findOrFail($id);

        return response()->json($station, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $station = Station::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required | string',
            'city' => 'required | string',
            'total_collected' => 'required | integer',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Introduced data is not correct',
                'errors' => $validator->errors(),
            ], 400);
        }


        $validated = $validator->validate();

        $station->update([
            'name' => $validated['name'],
            'city' => $validated['city'],
            'total_collected' => $validated['total_collected'],
        ]);
        $station->save();

        return response()->json($station, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $station = Station::findOrFail($id);
        $station->delete();

        return response()->json([
            'message' => 'Station deleted',
        ], 200);
    }
}
