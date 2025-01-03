<?php

namespace Tests\Feature\Api;

use App\Models\Type;
use Tests\TestCase;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfCanReceiveAllVehiclesWithApi() {
        $types = Type::factory(3)->create();
        $vehicles = Vehicle::factory(5)->create();

        $response = $this->get(route('apiHomeVehicles'));

        $response->assertStatus(200)
            ->assertJsonCount(5);
    }

    public function test_CheckIfCanReceiveOneVehicleWithApi() {
        $types = Type::factory(3)->create();
        $vehicle = $this->post(route('apiStoreVehicle'), [
            'license' => '123456789',
            'axles' => null,
            'type' => 'car',
        ]);
        $data = ['license' => '123456789'];

        $response = $this->get(route('apiShowVehicle', 1));
        $response->assertStatus(200)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfCanCreateNewVehicleWithApi() {
        $types = Type::factory(3)->create();
        
        $response = $this->post(route('apiStoreVehicle'), [
            'license' => '123456789',
            'axles' => 2,
            'type' => 'truck',
        ]);
        $data = ['license' => '123456789'];

        $response->assertStatus(201);

        $response = $this->get(route('apiHomeVehicles'));
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfReturnErrorIfBadRequestWithApi() {
        $types = Type::factory(3)->create();
        
        $response = $this->post(route('apiStoreVehicle'), [
            'license' => '123456789',
            'axles' => null,
            'type' => 'bike',
        ]);
        $data = ['message' => 'Introduced data is not correct'];

        $response->assertStatus(400)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfReturnErrorIfTruckHasNullAxlesWithApi() {
        $types = Type::factory(3)->create();
        
        $response = $this->post(route('apiStoreVehicle'), [
            'license' => '123456789',
            'axles' => null,
            'type' => 'truck',
        ]);
        $data = ['message' => 'Number of axles is required for trucks'];

        $response->assertStatus(400)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfCanUpdateAVehicleWithApi() {
        $types = Type::factory(3)->create();

        $response = $this->post(route('apiStoreVehicle'), [
            'license' => '123456789',
            'axles' => 2,
            'type' => 'truck',
        ]);
        $data = ['license' => '123456789'];

        $response->assertStatus(201);

        $response = $this->get(route('apiHomeVehicles'));
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);

        $response = $this->put(route('apiUpdateVehicle', 1), [
            'license' => '987654321',
            'axles' => null,
            'type' => 'car',
        ]);
        $data = ['license' => '987654321'];

        $response = $this->get(route('apiHomeVehicles'));
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfUpdateReturnErrorIfBadRequestWithApi() {
        $types = Type::factory(3)->create();

        $response = $this->post(route('apiStoreVehicle'), [
            'license' => '123456789',
            'axles' => 2,
            'type' => 'truck',
        ]);
        $data = ['license' => '123456789'];

        $response->assertStatus(201);

        $response = $this->get(route('apiHomeVehicles'));
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);
        
            $response = $this->put(route('apiUpdateVehicle', 1), [
                'license' => '123456789',
                'axles' => null,
                'type' => 'bike',
            ]);
            $data = ['message' => 'Introduced data is not correct'];
    
            $response->assertStatus(400)
                ->assertJsonFragment($data);
    }

    public function test_CheckIfUpdateReturnErrorIfTruckHasNullAxlesWithApi() {
        $types = Type::factory(3)->create();

        $response = $this->post(route('apiStoreVehicle'), [
            'license' => '123456789',
            'axles' => 2,
            'type' => 'truck',
        ]);
        $data = ['license' => '123456789'];

        $response->assertStatus(201);

        $response = $this->get(route('apiHomeVehicles'));
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);
        
        $response = $this->put(route('apiUpdateVehicle', 1), [
            'license' => '123456789',
            'axles' => null,
            'type' => 'truck',
        ]);
        $data = ['message' => 'Number of axles is required for trucks'];

        $response->assertStatus(400)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfCanDeleteAVehicleWithApi() {
        $types = Type::factory(3)->create();
        $vehicles = Vehicle::factory(2)->create();

        $response = $this->get(route('apiHomeVehicles'));
        $response->assertStatus(200)
            ->assertJsonCount(2);

        $response = $this->delete(route('apiDestroyVehicle', 1));

        $response = $this->get(route('apiHomeVehicles'));
        $response->assertStatus(200)
            ->assertJsonCount(1);
    }
}
