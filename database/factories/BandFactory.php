<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Band>
 */
class BandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genre = ['Rock', 'Pop', 'Reggae', 'Acoustic', 'Classical'];
        return [
            'bandName' => fake()->name(),
            'location' => fake()->city(),
            'rate' => fake()->numberBetween($min = 1000, $max = 9000),
            'genre' => $this->faker->randomElement($genre),
            'description' => fake()->sentence(),
            'image' => 'bandimg.jfif'
        ];
    }
}
