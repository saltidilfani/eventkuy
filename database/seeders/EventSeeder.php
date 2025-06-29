<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Category;
use App\Models\Location;
use Faker\Factory as Faker;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $categories = Category::pluck('id');
        $locations = Location::pluck('id');

        for ($i = 0; $i < 15; $i++) {
            Event::create([
                'title' => $faker->sentence(4),
                'description' => $faker->paragraph(5),
                'event_date' => $faker->dateTimeBetween('+1 week', '+3 months'),
                'event_time' => $faker->time('H:i'),
                'category_id' => $categories->random(),
                'location_id' => $locations->random(),
                'organizer' => $faker->company,
                'max_participants' => $faker->numberBetween(50, 200),
            ]);
        }
    }
} 