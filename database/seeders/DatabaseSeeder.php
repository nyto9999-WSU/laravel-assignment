<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name' => 'admin',
            'email' =>'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('chen0606'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'email' =>'user@gmail.com',
            'role' => 'user',
            'password' => Hash::make('chen0606'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
