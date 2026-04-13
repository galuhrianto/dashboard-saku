<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KerjasamasSeeder extends Seeder
{
    public function run()
    {
        $asaCountries = [
    'South Africa',
    'United States',
    'Saudi Arabia',
    'Argentina',
    'Australia',
    'Austria',
    'Bahrain',
    'Bangladesh',
    'Netherlands',
    'Belgium',
    'Brunei Darussalam',
    'Bulgaria',
    'Czechia',
    'Denmark',
    'Ethiopia',
    'Finland',
    'Hungary',
    'India',
    'United Kingdom',
    'Iran (Islamic Republic of)',
    'Iceland',
    'Italy',
    'Japan',
    'Germany',
    'Cambodia',
    'Canada',
    'Kazakhstan',
    'Kenya',
    'Republic of Korea',
    "Democratic People's Republic of Korea",
    'Croatia',
    'Kuwait',
    'Kyrgyzstan',
    "Lao People's Democratic Republic",
    'Lebanon',
    'Luxembourg',
    
    'Madagascar',
    'Malaysia',
    'Morocco',
    'Mauritius',
    'Mexico',
    'Egypt',
    'Myanmar',
    'Norway',
    'Oman',
    'Pakistan',
    'Papua New Guinea',
    'France',
    'Philippines',
    'Poland',
    'Qatar',
    'Romania',
    'Russian Federation',
    'New Zealand',
    'Singapore',
    'Slovakia',
    'Spain',
    'Sri Lanka',
    'Sweden',
    'Switzerland',
    
    'Thailand',
    'Timor-Leste',
    'Tunisia',
    'Türkiye',
    'Turkmenistan',
    'Ukraine',
    'United Arab Emirates',
    'Uzbekistan',
    'Viet Nam',
    'Yemen',
    'Jordan',
    'Greece',
    'Latvia',
    'Maldives',
];

$states = DB::table('states')->pluck('id', 'state_name');

$data = [];

foreach ($asaCountries as $country) {
    $data[] = [
        'bentuk_kerjasama' => 'ASA',
        'deskripsi' => 'Perjanjian layanan udara bilateral',
        'status' => 'Aktif',
        'state_id' => $states[$country],
        'created_at' => now(),
        'updated_at' => now(),
    ];
}

DB::table('kerjasamas')->insert($data);
    }
}
