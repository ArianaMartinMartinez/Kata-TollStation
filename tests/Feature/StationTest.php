<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Type;
use App\Models\Station;
use App\Models\Stations_Vehicles;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StationTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfCanReceiveAllStationsInView() {
        $stations = Station::factory(5)->create();

        $response = $this->get(route('stationsHome'));

        $response->assertStatus(200)
            ->assertViewIs('stations');
    }

    public function test_CheckIfCanReceiveOneStationWithVehiclesInView() {
        $station = Station::factory()->create();
        $type = Type::factory(3)->create();
        $vehicle = Vehicle::factory()->create();
        $toll = Stations_Vehicles::factory()->create();

        $response = $this->get(route('stationsShow', 1));
        $response->assertStatus(200)
            ->assertViewIs('stationShow');
    }
}
