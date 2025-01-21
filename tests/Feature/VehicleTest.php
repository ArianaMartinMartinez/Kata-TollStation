<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Type;
use App\Models\Station;
use App\Models\Stations_Vehicles;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfCanReceiveAllVehiclesInView() {
        $types = Type::factory(3)->create();
        $vehicles = Vehicle::factory(5)->create();

        $response = $this->get(route('vehiclesHome'));

        $response->assertStatus(200)
            ->assertViewIs('vehicles');
    }

    public function test_CheckIfCanReceiveOneVehicleWithStationsInView() {
        $station = Station::factory()->create();
        $type = Type::factory(3)->create();
        $vehicle = Vehicle::factory()->create();
        $toll = Stations_Vehicles::factory()->create();

        $response = $this->get(route('vehiclesShow', 1));
        $response->assertStatus(200)
            ->assertViewIs('vehicleShow');
    }
}
