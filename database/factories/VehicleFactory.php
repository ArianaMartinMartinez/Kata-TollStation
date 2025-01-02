<?php

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = Type::all()->random();
        $axles = $type->type == 'truck' ? $this->faker->numberBetween(1, 3) : null;

        return [
            'license' => $this->faker->randomNumber(),
            'axles' => $axles,
            'id_type' => $type->id,
        ];
    }
}
