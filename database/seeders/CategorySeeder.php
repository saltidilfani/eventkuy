<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Seminar'],
            ['name' => 'Workshop'],
            ['name' => 'Kompetisi'],
            ['name' => 'Pameran Seni'],
            ['name' => 'Olahraga'],
            ['name' => 'Webinar Online'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category['name']]);
        }
    }
}