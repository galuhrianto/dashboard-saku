<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\State;

class DctpSeeder extends Seeder
{
    /**
     * Data DCTP dari Buku Saku.pptx
     * Slide 12: Sudah Menerima Training DCTP
     * Slides 15-19: Identifikasi per kawasan (Sudah Menerima / Penerima Potensial / Prioritas Penerima Dewan ICAO / Kompetitor)
     */
    public function run(): void
    {
        // =====================================================
        // 1. SUDAH MENERIMA TRAINING DCTP (Slide 12)
        // =====================================================
        $sudahMenerima = [
            // Asia Pasifik
            'Bangladesh', 'Bhutan', 'Cambodia', 'Fiji', 'India',
            'Lao People\'s Democratic Republic', 'Malaysia', 'Maldives', 'Mongolia',
            'Myanmar', 'Nepal', 'Pakistan', 'Papua New Guinea', 'Philippines',
            'Samoa', 'Sri Lanka', 'Thailand', 'Timor-Leste', 'Vanuatu', 'Viet Nam',
            // Eropa
            'Azerbaijan', 'Belarus', 'Bosnia and Herzegovina', 'Georgia', 'Kazakhstan',
            'Kyrgyzstan', 'North Macedonia', 'Tajikistan', 'Uzbekistan',
            // Amerika Latin & Karibia
            'Bahamas', 'Barbados', 'Belize', 'Brazil', 'Chile', 'Dominican Republic',
            'El Salvador', 'Jamaica', 'Mexico', 'Peru', 'Saint Lucia', 'Suriname',
            'Venezuela (Bolivarian Republic of)',
            // Timur Tengah
            'Egypt', 'Iran (Islamic Republic of)', 'Iraq', 'Jordan', 'Kuwait',
            'Lebanon', 'Oman', 'Syrian Arab Republic', 'Yemen',
            // Afrika
            'Algeria', 'Angola', 'Benin', 'Burkina Faso', 'Burundi', 'Cabo Verde',
            'Cameroon', 'Chad', 'Côte d\'Ivoire', 'Djibouti', 'Eswatini', 'Ethiopia',
            'Gambia', 'Ghana', 'Guinea', 'Kenya', 'Malawi', 'Mali', 'Mauritania',
            'Mauritius', 'Mozambique', 'Namibia', 'Nigeria', 'Somalia', 'South Sudan',
            'United Republic of Tanzania', 'Togo', 'Tunisia', 'Uganda', 'Zimbabwe',
        ];

        // =====================================================
        // 2. PENERIMA POTENSIAL
        // =====================================================
        $penerimaPotenial = [
            // Asia Pasifik (Slide 15 - PENERIMA POTENSIAL)
            'Afghanistan', 'Brunei Darussalam', 'Cook Islands',
            'Democratic People\'s Republic of Korea', 'Kiribati', 'Marshall Islands',
            'Solomon Islands', 'Federated States of Micronesia', 'Nauru', 'Palau',
            'Tonga', 'Tuvalu',
            // Afrika (Slide 16 - PENERIMA POTENSIAL)
            'Comoros', 'Botswana', 'Eritrea', 'Central African Republic', 'Lesotho',
            'Congo', 'Madagascar', 'Democratic Republic of the Congo', 'Equatorial Guinea',
            'Sao Tome and Principe', 'Libya', 'Guinea-Bissau', 'Seychelles', 'Senegal',
            'South Africa', 'Sudan', 'Rwanda', 'Gabon', 'Zambia',
            // Amerika Latin & Karibia (Slide 17 - PENERIMA POTENSIAL)
            'Argentina', 'Colombia', 'Costa Rica', 'Cuba', 'Ecuador',
            'Guatemala', 'Honduras', 'Nicaragua', 'Panama', 'Paraguay', 'Uruguay',
            'Antigua and Barbuda', 'Dominica', 'Grenada', 'Haiti',
            'Saint Kitts and Nevis', 'Saint Vincent and the Grenadines', 'Trinidad and Tobago',
            // Eropa (Slide 19 - PENERIMA POTENSIAL)
            'Albania', 'Andorra', 'Armenia', 'Bulgaria', 'Croatia', 'Cyprus',
            'Czechia', 'Estonia', 'Hungary', 'Latvia', 'Lithuania', 'Malta',
            'Moldova', 'Romania', 'Serbia', 'Slovakia', 'Slovenia', 'Turkmenistan',
        ];

        // =====================================================
        // 3. KOMPETITOR (negara maju / tidak masuk kategori lain)
        // =====================================================
        $kompetitor = [
            // PART I: Chief importance in air transport (Slide 7)
            'Australia', 'Canada', 'China', 'France', 'Germany', 'Italy',
            'Japan', 'United Kingdom', 'United States',
            // PART II: Largest contribution
            'Denmark', 'India', 'Singapore', 'Spain', 'Switzerland',
            // Other advanced nations (Asia Pasifik "Sudah Menerima" but developed)
            'New Zealand', 'Republic of Korea',
            // Slide 19 EROPA - kompetitor (negara maju Eropa tidak masuk potensial)
            'Ukraine', 'Belarus', // Belarus sudah masuk sudah menerima
        ];

        // Normalize: Kompetitor = negara yang sudah menerima dari kelompok PART I/II
        // (yang masuk kategori advanced, tidak perlu dilobi via DCTP)
        // Kita override dari sudahMenerima untuk negara-negara maju
        $kompetitorOverride = [
            'Australia', 'Canada', 'China', 'France', 'Germany', 'Italy',
            'Japan', 'United Kingdom', 'United States', 'Denmark', 'Singapore',
            'Spain', 'Switzerland', 'New Zealand', 'Republic of Korea',
            'Saudi Arabia', 'Colombia', 'Argentina', 'Nigeria (Part I)',
        ];

        // =====================================================
        // Apply Sudah Menerima
        // =====================================================
        foreach ($sudahMenerima as $name) {
            $state = $this->findState($name);
            if ($state) {
                DB::table('states')->where('id', $state->id)->update(['dctp_status' => 'Sudah Menerima']);
            }
        }

        // =====================================================
        // Apply Penerima Potensial (only if not already set)
        // =====================================================
        foreach ($penerimaPotenial as $name) {
            $state = $this->findState($name);
            if ($state && !$state->fresh()->dctp_status) {
                DB::table('states')->where('id', $state->id)->update(['dctp_status' => 'Penerima Potensial']);
            }
        }
    }

    private function findState(string $name): ?State
    {
        // Exact match first
        $state = State::where('state_name', $name)->first();
        if ($state) return $state;

        // Flexible match
        $map = [
            'Lao People\'s Democratic Republic' => 'Lao People%',
            'Viet Nam'                          => 'Viet Nam',
            'Timor-Leste'                       => 'Timor%',
            'Venezuela (Bolivarian Republic of)' => 'Venezuela%',
            'Iran (Islamic Republic of)'        => 'Iran%',
            'Syrian Arab Republic'              => 'Syrian%',
            'North Macedonia'                   => '%Macedonia%',
            'Bosnia and Herzegovina'            => 'Bosnia%',
            'Côte d\'Ivoire'                    => '%Ivoire%',
            'United Republic of Tanzania'       => '%Tanzania%',
            'Federated States of Micronesia'    => '%Micronesia%',
            'Democratic Republic of the Congo'  => '%Democratic Republic%Congo%',
            'Central African Republic'          => '%Central African%',
            'Sao Tome and Principe'             => 'Sao Tome%',
            'Guinea-Bissau'                     => 'Guinea-Bissau',
            'Democratic People\'s Republic of Korea' => '%People%Korea%',
        ];

        if (isset($map[$name])) {
            return State::where('state_name', 'LIKE', $map[$name])->first();
        }

        // Partial match (only if unique)
        $parts = explode(' ', $name);
        $firstWord = $parts[0];
        if (strlen($firstWord) > 4) {
            $results = State::where('state_name', 'LIKE', $firstWord . '%')->get();
            if ($results->count() === 1) return $results->first();
        }

        return null;
    }
}
