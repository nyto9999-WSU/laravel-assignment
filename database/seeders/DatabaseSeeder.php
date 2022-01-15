<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



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

        /* role */
        DB::table('roles')->insert([
            'name' => 'user'
        ]);
        DB::table('roles')->insert([
            'name' => 'admin'
        ]);
        DB::table('roles')->insert([
            'name' => 'technician'
        ]);

        /* user */
        DB::table('users')->insert([
            'name' => 'admin',
            'email' =>'admin@gmail.com',
            'role_id' => 2,
            'password' => Hash::make('aaaa1111'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now()
        ]);

       /* user */
        /* user */
        DB::table('users')->insert([
            'name' => 'user',
            'email' =>'user@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('aaaa1111'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // $this->call([
        //     OrderSeeder::class,
        //     TechSeeder::class,
        //     AirconSeeder::class,
        // ]);

    }
}
