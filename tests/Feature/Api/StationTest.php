<?php

namespace Tests\Feature\Api;

use App\Models\Station;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StationTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfCanReceiveAllStationsWithApi() {
        $stations = Station::factory(5)->create();

        $response = $this->get(route('apiHomeStations'));

        $response->assertStatus(200)
            ->assertJsonCount(5);
    }

    public function test_CheckIfCanReceiveOneStationWithApi() {
        $station = $this->post(route('apiStoreStation'), [
            'name' => 'Nombre de ejemplo',
            'city' => 'Cuidad de ejemplo',
            'total_collected' => 200,
        ]);
        $data = ['city' => 'Cuidad de ejemplo'];

        $response = $this->get(route('apiShowStation', 1));
        $response->assertStatus(200)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfCanCreateNewStationWithApi() {
        $response = $this->post(route('apiStoreStation'), [
            'name' => 'Nombre de ejemplo',
            'city' => 'Cuidad de ejemplo',
            'total_collected' => 200,
        ]);
        $data = ['city' => 'Cuidad de ejemplo'];

        $response->assertStatus(201);

        $response = $this->get(route('apiHomeStations'));
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfStationCreateReturnErrorIfBadRequestWithApi() {
        $response = $this->post(route('apiStoreStation'), [
            'city' => 'Cuidad de ejemplo',
            'total_collected' => '200',
        ]);
        $data = ['message' => 'Introduced data is not correct'];

        $response->assertStatus(400)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfCanUpdateAStationWithApi() {
        $response = $this->post(route('apiStoreStation'), [
            'name' => 'Nombre de ejemplo',
            'city' => 'Cuidad de ejemplo',
            'total_collected' => 200,
        ]);
        $data = ['city' => 'Cuidad de ejemplo'];

        $response->assertStatus(201);

        $response = $this->get(route('apiHomeStations'));
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);
        
        $response = $this->put(route('apiUpdateStation', 1), [
            'name' => 'Nombre de ejemplo modificado',
            'city' => 'Cuidad de ejemplo modificado',
            'total_collected' => 500,
        ]);
        $data = ['city' => 'Cuidad de ejemplo modificado'];

        $response = $this->get(route('apiHomeStations'));
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfStationUpdateReturnErrorIfBadRequestWithApi() {
        $response = $this->post(route('apiStoreStation'), [
            'name' => 'Nombre de ejemplo',
            'city' => 'Cuidad de ejemplo',
            'total_collected' => 200,
        ]);
        $data = ['city' => 'Cuidad de ejemplo'];

        $response->assertStatus(201);

        $response = $this->get(route('apiHomeStations'));
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);
        
        $response = $this->put(route('apiUpdateStation', 1), [
            'city' => 'Cuidad de ejemplo modificado',
            'total_collected' => '500',
        ]);
        $data = ['message' => 'Introduced data is not correct'];

        $response->assertStatus(400)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfCanDeleteAStationWithApi() {
        $stations = Station::factory(2)->create();

        $response = $this->get(route('apiHomeStations'));
        $response->assertStatus(200)
            ->assertJsonCount(2);

        $response = $this->delete(route('apiDestroyStation', 1));

        $response = $this->get(route('apiHomeStations'));
        $response->assertStatus(200)
            ->assertJsonCount(1);
    }
}
