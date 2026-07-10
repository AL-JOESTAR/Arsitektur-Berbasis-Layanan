<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_rooms')->insert([
            [
                'name' => 'Normal',
                'price' => 150000,
            ],
            [
                'name' => 'Premium',
                'price' => 250000,
            ],
            [
                'name' => 'Deluxe Room',
                'price' => 400000,
            ]
        ]);
    }
}
