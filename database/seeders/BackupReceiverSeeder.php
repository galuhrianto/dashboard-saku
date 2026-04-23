<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BackupReceiver;

class BackupReceiverSeeder extends Seeder
{
    public function run(): void
    {
        BackupReceiver::updateOrCreate(
            ['phone' => '085156930628'],
            [
                'name' => 'Hafidz Manoer',
                'accounts' => ['1', '2'],
                'is_active' => true,
            ]
        );
    }
}
