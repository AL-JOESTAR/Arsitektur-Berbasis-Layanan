<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('room_type__facilities')->insert([
            // Single Room
            [
                'type_room_id' => 1,
                'facility_id' => 1
            ],
            [
                'type_room_id' => 2,
                'facility_id' => 2
            ],
            [
                'type_room_id' => 3,
                'facility_id' => 3
            ],
        ]);
    }
}
