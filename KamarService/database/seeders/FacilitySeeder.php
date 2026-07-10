<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('facilities')->insert([
            [
                'name' => 'Kasur'
            ],
            [
                'name' => 'TV'
            ],
            [
                'name' => 'WiFi dan TV'
            ],
        ]);
    }
}
