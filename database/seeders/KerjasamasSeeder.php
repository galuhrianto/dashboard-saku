<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KerjasamasSeeder extends Seeder
{
    public function run()
    {
        DB::table('kerjasamas')->insert([
            [
                'bentuk_kerjasama' => 'Training',
                'state_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bentuk_kerjasama' => 'Research Collaboration',
                'state_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
