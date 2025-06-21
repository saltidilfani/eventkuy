<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Perbaikan: Memanggil seeder dengan nama yang benar
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            LocationSeeder::class,
            EventSeeder::class,
        ]);
    }
}
