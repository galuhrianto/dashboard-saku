<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NambahKerjasamaSeeder extends Seeder
{
    public function run(): void
    {
        // 🔥 FIX: pakai state_name
        $states = DB::table('states')->pluck('id', 'state_name')->toArray();

        $rows = [

            [
                'type_kerjasama' => 'Kerja Sama Kebandarudaraan',
                'mou' => 'MOU on Civil Aviation Cooperations',
                'bentuk_kerjasama' => 'MoU',
                'deskripsi' => 'Kemitraan dan peningkatan kapasitas SDM di bidang waterbase aerodromes dan seaplanes.',
                'status' => 'Tidak Berlaku',
                'state' => 'Canada',
            ],

            [
                'type_kerjasama' => 'Kerja Sama Angkutan Udara',
                'mou' => 'Joint Statement on Cooperations Towards a Smart & Sustainable Transportation Sector',
                'bentuk_kerjasama' => 'JS',
                'deskripsi' => 'Pertukaran tenaga ahli dan partisipasi dalam seminar internasional.',
                'status' => 'Berlaku',
                'state' => 'Netherlands',
            ],

            [
                'type_kerjasama' => 'Kerja Sama Kelaikudaraan',
                'mou' => 'Technical Cooperation Agreement',
                'bentuk_kerjasama' => 'Agreement',
                'deskripsi' => 'Kerja sama di bidang keselamatan penerbangan dan navigasi udara.',
                'status' => 'Berlaku',
                'state' => 'France',
            ],

            [
                'type_kerjasama' => 'Kerja Sama Angkutan Udara',
                'mou' => 'Memorandum of Understanding Concerning Cooperation In The Transportation Sector',
                'bentuk_kerjasama' => 'MoU',
                'deskripsi' => 'Kerja sama transportasi mencakup penerbangan sipil dan keselamatan transportasi.',
                'status' => 'Tidak Berlaku',
                'state' => 'Australia',
            ],

            [
                'type_kerjasama' => 'Kerja Sama Kelaikudaraan',
                'mou' => 'Memorandum of Agreement FAA - DGCA',
                'bentuk_kerjasama' => 'Agreement',
                'deskripsi' => 'Dukungan teknis dalam bidang kelaikudaraan dan operasi pesawat udara.',
                'status' => 'Berlaku',
                'state' => 'United States',
            ],

            [
                'type_kerjasama' => 'Kerja Sama Angkutan Udara',
                'mou' => 'Memorandum of Cooperation on Technical and Economic Development',
                'bentuk_kerjasama' => 'MoU',
                'deskripsi' => 'Kerja sama ekonomi transportasi udara dan lingkungan penerbangan.',
                'status' => 'Tidak Berlaku',
                'state' => 'Thailand',
            ],

            [
                'type_kerjasama' => 'Kerja Sama Angkutan Udara',
                'mou' => 'MoU on Technical Cooperation in Civil Aviation',
                'bentuk_kerjasama' => 'MoU',
                'deskripsi' => 'Kerja sama teknis penerbangan sipil meliputi keselamatan dan navigasi.',
                'status' => 'Tidak Berlaku',
                'state' => 'Saudi Arabia',
            ],

        ];

        $data = [];

        foreach ($rows as $row) {

            if (!isset($states[$row['state']])) {
                dump("❌ State tidak ditemukan: " . $row['state']);
                continue;
            }

            $data[] = [
                'type_kerjasama' => $row['type_kerjasama'],
                'mou' => $row['mou'],
                'bentuk_kerjasama' => $row['bentuk_kerjasama'],
                'deskripsi' => $row['deskripsi'],
                'status' => $row['status'],
                'state_id' => $states[$row['state']],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('kerjasamas')->insert($data);
    }
}