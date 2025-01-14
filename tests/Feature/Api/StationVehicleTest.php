<?php

namespace Tests\Feature\Api;

use App\Models\Station;
use App\Models\Stations_Vehicles;
use App\Models\Type;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StationVehicleTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfCanReceiveAllTollsWithApi() {
        $types = Type::factory(3)->create();
        $stations = Station::factory(5)->create();
        $vehicles = Vehicle::factory(5)->create();
        $tolls = Stations_Vehicles::factory(10)->create();

        $response = $this->get(route('apiHomeTolls'));

        $response->assertStatus(200)
            ->assertJsonCount(10);
    }

    public function test_CheckIfCanReceiveOneTollWithApi() {
        $types = Type::factory(3)->create();
        $stations = Station::factory(5)->create();
        $vehicles = Vehicle::factory(5)->create();
        
        $toll = $this->post(route('apiStoreToll'), [
            'id_station' => 2,
            'id_vehicle' => 1,
        ]);
        $data = ['id_vehicle' => 1];

        $response = $this->get(route('apiShowToll', 1));
        $response->assertStatus(200)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfCanCreateNewTollWithApi() {
        $types = Type::factory(3)->create();
        $stations = Station::factory(5)->create();
        $vehicles = Vehicle::factory(5)->create();
        
        $response = $this->post(route('apiStoreToll'), [
            'id_station' => 2,
            'id_vehicle' => 1,
        ]);
        $data = ['id_vehicle' => 1];

        $response->assertStatus(201);

        $response = $this->get(route('apiHomeTolls'));
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfTollCreateReturnErrorIfBadRequestWithApi() {
        $types = Type::factory(3)->create();
        $stations = Station::factory(5)->create();
        $vehicles = Vehicle::factory(5)->create();

        $response = $this->post(route('apiStoreToll'), [
            'id_station' => 2,
            'id_vehicle' => 'error',
        ]);
        $data = ['message' => 'Introduced data is not correct'];

        $response->assertStatus(400)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfCanUpdateATollWithApi() {
        $types = Type::factory(3)->create();
        $stations = Station::factory(5)->create();
        $vehicles = Vehicle::factory(5)->create();
        
        $response = $this->post(route('apiStoreToll'), [
            'id_station' => 2,
            'id_vehicle' => 1,
        ]);
        $data = ['id_vehicle' => 1];

        $response->assertStatus(201);

        $response = $this->get(route('apiHomeTolls'));
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);

        $response = $this->put(route('apiUpdateToll', 1), [
            'id_station' => 4,
            'id_vehicle' => 3,
        ]);
        $data = ['id_vehicle' => 3];

        $response = $this->get(route('apiHomeTolls'));
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfTollUpdateReturnErrorIfBadRequestWithApi() {
        $types = Type::factory(3)->create();
        $stations = Station::factory(5)->create();
        $vehicles = Vehicle::factory(5)->create();
        
        $response = $this->post(route('apiStoreToll'), [
            'id_station' => 2,
            'id_vehicle' => 1,
        ]);
        $data = ['id_vehicle' => 1];

        $response->assertStatus(201);

        $response = $this->get(route('apiHomeTolls'));
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);

        $response = $this->put(route('apiUpdateToll', 1), [
            'id_station' => 4,
            'id_vehicle' => 'error',
        ]);
        $data = ['message' => 'Introduced data is not correct'];

        $response->assertStatus(400)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfCanDeleteATollWithApi() {
        $types = Type::factory(3)->create();
        $stations = Station::factory(5)->create();
        $vehicles = Vehicle::factory(5)->create();
        $tolls = Stations_Vehicles::factory(2)->create();
        
        $response = $this->get(route('apiHomeTolls'));
        $response->assertStatus(200)
            ->assertJsonCount(2);

        $response = $this->delete(route('apiDestroyToll', 1));

        $response = $this->get(route('apiHomeTolls'));
        $response->assertStatus(200)
            ->assertJsonCount(1);
    }
}
