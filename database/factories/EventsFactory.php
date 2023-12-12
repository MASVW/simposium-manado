<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Events>
 */
class EventsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'eventName' => $this->faker->sentence(mt_rand(1,3)),
            'excerpt' => $this->faker->paragraph(10),
            'eventDesc' => $this->faker->paragraph(40),
            'eventDate' => $this->faker->date('Y_m_d'),
            'slug' => $this->faker->slug(),
        ];
    }
}
