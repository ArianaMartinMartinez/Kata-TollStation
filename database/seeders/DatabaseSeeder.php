<?php

namespace Database\Seeders;

use App\Models\Station;
use App\Models\Stations_Vehicles;
use App\Models\Type;
use App\Models\User;
use App\Models\Vehicle;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */

        Station::factory(20)->create();
        Type::factory(3)->create();
        Vehicle::factory(20)->create();
        Stations_Vehicles::factory(40)->create();
    }
}
