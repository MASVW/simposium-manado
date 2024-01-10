<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prices>
 */
class PricesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'priceTag' => $this->faker->sentence(2),
                'priceDesc' => $this->faker->sentence(8),
                'price' => $this->faker->randomNumber(5, true),
                'events_id'=> mt_rand(1,2),
                'position_id'=> mt_rand(1,7),
        ];
    }
}
