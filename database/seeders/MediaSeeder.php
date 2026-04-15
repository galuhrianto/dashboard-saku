<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        Media::updateOrCreate(
            ['type' => 'aidememoire'],
            [
                'title' => 'Aidememoire Default',
                'file_path' => 'media/aidememoire.pdf',
            ]
        );
    }
}