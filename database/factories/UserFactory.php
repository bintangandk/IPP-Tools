<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomNumber(8),
            'full_name' => fake()->name(),
            'password' => bcrypt('11111111'),
            'region' => fake()->city(),
            'teritory' => fake()->state(),
            'role' => fake()->randomElement(['admin', 'user', 'guest']),
            'status' => fake()->randomElement(['Active', 'Non Active']),
            'level' => fake()->randomElement(['Admin', 'User']),
            'remember_token' => fake()->sha256(),
            'img' => 'user.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
