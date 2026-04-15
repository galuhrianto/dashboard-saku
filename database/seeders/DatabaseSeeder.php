<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([

            RolesSeeder::class,
            UsersSeeder::class,
            StatesSeeder::class,
            KerjasamasSeeder::class,
            BeasiswasSeeder::class,
            DirektursSeeder::class,
            InformasiUmumSeeder::class,
            DctpSeeder::class,
            MediaSeeder::class,
        ]);
    }
}
