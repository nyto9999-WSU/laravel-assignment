<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TechFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'role_id' => 3,
            'email_verified_at' => now(),
            'password' => Hash::make('aaaa1111'),
            'remember_token' => Str::random(10),
        ];
    }
}
