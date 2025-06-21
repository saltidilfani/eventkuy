<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User (Ganti jika email sudah ada)
        User::firstOrCreate(
            ['email' => 'admin@pnp.ac.id'],
            [
                'name' => 'Admin PNP',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Regular User
        User::firstOrCreate(
            ['email' => 'mahasiswa@pnp.ac.id'],
            [
                'name' => 'Mahasiswa PNP',
                'password' => Hash::make('mahasiswa123'),
                'role' => 'user',
            ]
        );
    }
} 