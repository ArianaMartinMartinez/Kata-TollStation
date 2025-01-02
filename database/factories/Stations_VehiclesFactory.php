<?php

namespace Database\Factories;

use App\Models\Station;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Stations_VehiclesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vehicle = Vehicle::all()->random();
        $amount = $vehicle->type->type === 'truck' ? $vehicle->axles*50 : $vehicle->type->price;

        return [
            'id_station' => Station::all()->random()->id,
            'id_vehicle' => $vehicle->id,
            'amount' => $amount,
        ];
    }
}
