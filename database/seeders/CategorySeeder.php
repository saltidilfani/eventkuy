<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('salti_categories')->delete();
        Category::insert([
            ['name' => 'Seminar'],
            ['name' => 'Workshop'],
            ['name' => 'Konser Musik'],
            ['name' => 'Pameran Seni'],
            ['name' => 'Festival Kuliner'],
            ['name' => 'Olahraga'],
        ]);
    }
}