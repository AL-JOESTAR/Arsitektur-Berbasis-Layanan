<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('kamars')->insert([
            [
                'nomor_kamar' => '101',
                'type_room_id' => 1,
                'status_kamar' => 'Tersedia'
            ],
            [
                'nomor_kamar' => '102',
                'type_room_id' => 1,
                'status_kamar' => 'Tersedia'
            ],
            [
                'nomor_kamar' => '103',
                'type_room_id' => 1,
                'status_kamar' => 'Tersedia'
            ],
            [
                'nomor_kamar' => '201',
                'type_room_id' => 2,
                'status_kamar' => 'Tersedia'
            ],
            [
                'nomor_kamar' => '202',
                'type_room_id' => 2,
                'status_kamar' => 'Tersedia'
            ],
            [
                'nomor_kamar' => '203',
                'type_room_id' => 2,
                'status_kamar' => 'Tersedia'
            ],
            [
                'nomor_kamar' => '301',
                'type_room_id' => 3,
                'status_kamar' => 'Tersedia'
            ],
            [
                'nomor_kamar' => '302',
                'type_room_id' => 3,
                'status_kamar' => 'Tersedia'
            ],
            [
                'nomor_kamar' => '303',
                'type_room_id' => 3,
                'status_kamar' => 'Tersedia'
            ],
            [
                'nomor_kamar' => '304',
                'type_room_id' => 3,
                'status_kamar' => 'Tersedia'
            ],
        ]);
    }
}
