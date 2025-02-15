<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Passwords>
 */
class PasswordsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title_site" => fake()->words(3, true),
            "site_url" => fake()->url(),
            "gen_password" => fake()->password(),
            "user_id" => User::inRandomOrder()->first()->id
        ];
    }
}
