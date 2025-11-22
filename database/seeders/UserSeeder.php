<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('pt_BR');

        foreach (range(1, 10) as $index) {
            DB::table('users')->insert([
                'name'       => $faker->name,           
                'email'      => $faker->unique()->email,
                'password'   => Hash::make('12345678'), 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }   
    }
}
