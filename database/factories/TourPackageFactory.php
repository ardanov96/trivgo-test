<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourPackage>
 */
class TourPackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'destination' => $this->faker->city, 
            'price' => $this->faker->numberBetween(100000, 1000000),
            'duration_days' => $this->faker->numberBetween(1, 14),
            'description' => $this->faker->sentence,
            'max_participants' => $this->faker->numberBetween(5, 30),
            'image_url' => null,
            'is_active' => true,
        ];
    }
}
