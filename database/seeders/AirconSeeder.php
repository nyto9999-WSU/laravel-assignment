<?php

namespace Database\Seeders;

use App\Models\Aircon;
use Illuminate\Database\Seeder;

class AirconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Aircon::factory(100)->create();
    }
}
