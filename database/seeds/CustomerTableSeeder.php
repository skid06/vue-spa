<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Customer;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Customer::truncate();

        foreach(range(1, 25) as $i) {
            Customer::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'website' => $faker->url,
                'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now')
            ]);
        }
    }
}
