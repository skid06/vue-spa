<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        User::truncate();

        foreach(range(1, 25) as $i) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('password1234'),
                'phone' => $faker->phoneNumber,
                'website' => $faker->url,
                'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now')
            ]);
        }
    }
}
