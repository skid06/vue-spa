<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Task;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Task::truncate();

        foreach(range(1, 50) as $i) {
            Task::create([
                'name' => $faker->name,
                'status' => $faker->randomElement(['Done', 'Working', 'Open', 'Pending', 'Closed']),
                'contact_name' => $faker->name,
                'contact_phone' => $faker->phoneNumber,
                'cost' => $faker->numberBetween(0,100),
                'website' => $faker->url,
                'customer_id' => $faker->numberBetween(1,25),
                'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now')
            ]);
        }
    }
}
