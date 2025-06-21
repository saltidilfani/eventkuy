<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location; // Memastikan menggunakan model yang benar
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mengosongkan tabel sebelum diisi
        DB::table('salti_locations')->delete();

        Location::insert([
            ['location_name' => 'Aula Gedung Utama', 'address' => 'Jl. Kampus, Limau Manis, Padang'],
            ['location_name' => 'Gedung PKM', 'address' => 'Jl. Kampus, Limau Manis, Padang'],
            ['location_name' => 'Auditorium', 'address' => 'Jl. Kampus, Limau Manis, Padang'],
            ['location_name' => 'Online via Zoom', 'address' => 'Tautan akan diberikan setelah pendaftaran'],
        ]);
    }
}
