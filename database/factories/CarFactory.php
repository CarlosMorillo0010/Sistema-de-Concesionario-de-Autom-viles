<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'marca' => fake()->randomElement(['Toyota','Chevrolet','Ford','Mazda','Kia','Nissan']),
            'modelo' => fake()->word(),
            'anio' => fake()->numberBetween(2005, 2026),
            'color' => fake()->safeColorName(),
            'precio' => fake()->randomFloat(2, 5000, 60000),
            'kilometraje' => fake()->numberBetween(0, 200000),
        ];
    }
}
