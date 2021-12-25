<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' =>'admin@gmail.com',
            'role_id' => 2,
            'password' => Hash::make('chen0606'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now()
        ]);


        DB::table('users')->insert([
            'name' => 'user',
            'email' =>'user@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('chen0606'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::factory(10)->create();
    }
}
