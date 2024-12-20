<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IncomingLog>
 */
class IncomingLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'source' => fake()->url(),
            'title' => fake()->title(),
            'word_count' => fake()->randomNumber(),
            'incoming_log_data_id' => fake()->randomDigit(),
        ];
    }
}
