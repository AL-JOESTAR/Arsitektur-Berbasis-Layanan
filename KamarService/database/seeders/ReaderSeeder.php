<?php

namespace Database\Seeders;

use App\Models\Reader;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reader::create([
        'reader_name'=>'Reader Masuk',
        'reader_type'=>'Masuk'
    ]);

    Reader::create([
        'reader_name'=>'Reader Keluar',
        'reader_type'=>'Keluar'
    ]);
    }
}
