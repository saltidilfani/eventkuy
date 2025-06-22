<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            ['location_name' => 'Gedung PKM', 'address' => 'Jl. Kampus, Limau Manis, Padang'],
            ['location_name' => 'Online via Zoom', 'address' => 'Tautan akan diberikan setelah pendaftaran'],
            ['location_name' => 'Lapangan Olahraga', 'address' => 'Area outdoor kampus'],
            ['location_name' => 'Gedung C Lantai 3', 'address' => 'Jl. Kampus, Limau Manis, Padang'],
        ];

        foreach ($locations as $location) {
            Location::firstOrCreate($location);
        }
    }
}
