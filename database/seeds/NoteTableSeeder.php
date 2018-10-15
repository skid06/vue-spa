<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Note;

class NoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Note::truncate();

        foreach(range(1, 200) as $i) {
            Note::create([
                'task_id' => $faker->numberBetween(1, 50),
                'notes' => $faker->sentence,
                'user_id' => $faker->numberBetween(1,25),
                'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now')
            ]);
        }
    }
}
