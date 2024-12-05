<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CallbackLog>
 */
class CallbackLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'incoming_log_id' => fake()->randomDigit(),
            'result' => fake()->text(),
            'status' => fake()->randomElement(['pending', 'confirmed'])
        ];
    }
}
