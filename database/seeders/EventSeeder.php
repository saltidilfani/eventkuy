<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel event untuk menghindari duplikat
        DB::table('salti_events')->delete();

        // Ambil ID pertama dari Kategori dan Lokasi
        // Kita tahu ini pasti ada karena seeder sebelumnya berhasil
        $firstCategory = Category::first();
        $firstLocation = Location::first();
        $secondLocation = Location::skip(1)->first(); // Ambil lokasi kedua

        // Jika ada kategori dan lokasi, buat event
        if ($firstCategory && $firstLocation && $secondLocation) {
            Event::create([
                'title' => 'Seminar Nasional Technopreneurship',
                'description' => 'Seminar yang membahas tentang bagaimana menjadi pengusaha di era digital. Menghadirkan pembicara ahli di bidangnya.',
                'event_date' => now()->addDays(10),
                'event_time' => '09:00',
                'category_id' => $firstCategory->id,
                'location_id' => $firstLocation->id,
            ]);

            Event::create([
                'title' => 'Workshop Desain Grafis dengan Canva',
                'description' => 'Pelatihan intensif untuk mahasiswa yang ingin menguasai desain grafis untuk keperluan organisasi dan personal branding.',
                'event_date' => now()->addDays(20),
                'event_time' => '13:30',
                'category_id' => $firstCategory->id, // Bisa pakai kategori yang sama
                'location_id' => $secondLocation->id,
            ]);
        }
    }
} 