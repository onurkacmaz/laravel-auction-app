<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArtWork>
 */
class ArtWorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'artist_id' => 1,
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(10),
            'status' => 1,
            'start_price' => $this->faker->randomFloat(2, 12000, 120000),
            'end_price' => 0,
            'auction_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'estimated_market_price' => $this->faker->randomFloat(2, 12000, 120000)
        ];
    }
}
