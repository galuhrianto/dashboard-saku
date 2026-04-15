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
                'nama' => 'Mr. Takoyaki Isi Gurita',
                'jabatan' => 'Director General',
                'state_id' => 159,
                'photo' => 'direktur/QFWqtSlAPSilpKh21aedT39m9JM9HTea13XwrhZZ.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
