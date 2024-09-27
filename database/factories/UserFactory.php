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
            'type' => 'Region Team',
            'region' => fake()->city(),
            'teritory' => fake()->state(),
            'status' => fake()->randomElement(['Active', 'Non Active']),
            'password' => bcrypt('11111111'),
            'roles' => fake()->randomElement(['Admin', 'User', 'CS', 'Manager', 'Supervisor', 'Developer', 'Support', 'Operator', 'Guest']),
            'level' => fake()->randomElement(['Admin', 'User']),
            'img' => 'user.jpg',
            'remember_token' => fake()->sha256(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
