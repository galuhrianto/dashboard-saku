<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeasiswasSeeder extends Seeder
{
    public function run()
    {
        DB::table('beasiswas')->insert([
            [
                'nama_penerima' => 'Andi Saputra',
                'nama_beasiswa' => 'ICAO Scholarship',
                'tahun' => 2023,
                'state_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_penerima' => 'Budi Santoso',
                'nama_beasiswa' => 'Aviation Training Program',
                'tahun' => 2024,
                'state_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
