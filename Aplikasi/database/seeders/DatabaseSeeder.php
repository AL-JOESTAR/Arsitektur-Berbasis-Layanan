<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rental;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

         User::create([
            'name' => 'Admin',
            'no_hp' => '081234567890',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'parend_id' => 0,
            'status_user' => 'active',
        ]);

        // Penyewa
        User::create([
            'name' => 'Budi Santoso',
            'no_hp' => '081298765432',
            'email' => 'budi@test.com',
            'password' => Hash::make('budi123'),
            'role' => 'penyewa',
            'parend_id' => 1,
            'status_user' => 'nonaktif',
        ]);

        User::create([
            'name' => 'Siti Aisyah',
            'no_hp' => '081377788899',
            'email' => 'siti@test.com',
            'password' => Hash::make('siti123'),
            'role' => 'penyewa',
            'parend_id' => 1,
            'status_user' => 'nonaktif',
        ]);


    }
}
