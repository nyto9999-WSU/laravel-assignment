<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-300 day');
        return [
            'user_id' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ];
    }
}
