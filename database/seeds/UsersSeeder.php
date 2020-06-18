<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {

            \App\Models\User::create([
                'name' => $faker->name,
                'email' => $i . $faker->email,
                'password' => Hash::make('password'),
            ]);

        }

    }
}
