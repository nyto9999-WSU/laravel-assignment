<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AirconFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-600 day');
        return [
            'equipment_type' => $this->faker->randomElement(['Spilt System', 'Ducted System', 'Package Unit', 'Watercool unit', 'Mini VRF']),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
