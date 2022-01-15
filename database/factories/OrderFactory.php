<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
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
        $recent = $this->faker->dateTimeBetween('-7 day');
        $job_start = $this->faker->dateTimeBetween($recent, '+3 day');
        $job_end = $this->faker->dateTimeBetween($job_start, '+3 day');
        $name = $this->faker->name(['en_US']);
        return [

            'user_id' => 1,
            'name' => $name,
            'email' => $this->faker->unique()->safeEmail,
            'mobile_number' => $this->faker->numerify('+61(0#) ### ####'),
            'no_of_unit' => rand(1,10),
            'install_address' => $this->faker->address(),
            'install_address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'postcode' => $this->faker->postcode(),
            'prefer_date' => $recent,
            'prefer_time' => $this->faker->randomElement(['morning', 'afternoon', 'evening']),
            'job_start_date' => $job_start,
            'job_start_time' => $this->faker->randomElement(['morning', 'afternoon', 'evening']),
            'job_end_date' => $job_end,
            'domestic_commercial' => $this->faker->randomElement(['domestic', 'commercial']),
            'status' => $this->faker->randomElement(['Booked', 'assigned', 'completed']),
            'assigned_at' => $job_start,
            'created_at' => $date,
            'updated_at' => $date


        ];
    }
}
