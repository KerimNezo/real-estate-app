<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => $this->faker->numberBetween(500, 200000),
            'surface' => 59,
            'lat' => 44.2,
            'lon' => 17.933333333333334,
            'year_built' => $this->faker->numberBetween(1980, 2020)
        ];
    }
}
