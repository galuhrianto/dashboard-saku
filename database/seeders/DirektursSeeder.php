<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirektursSeeder extends Seeder
{
    public function run()
    {
        DB::table('direkturs')->insert([
            [
                'nama' => 'Dr. Ahmad Rizki',
                'jabatan' => 'Director Aviation',
                'state_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Mr. Kenji Tanaka',
                'jabatan' => 'Senior Aviation Director',
                'state_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
