<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\State;

class DctpSeeder extends Seeder
{
    public function run(): void
    {
        // ===============================
        // 1. SUDAH MENERIMA
        // ===============================
        $sudahMenerima = [
            'Bangladesh','Bhutan','Cambodia','Fiji','India',
            'Lao People\'s Democratic Republic','Malaysia','Maldives','Mongolia',
            'Myanmar','Nepal','Pakistan','Papua New Guinea','Philippines',
            'Samoa','Sri Lanka','Thailand','Timor-Leste','Vanuatu','Viet Nam',
            'Azerbaijan','Belarus','Bosnia and Herzegovina','Georgia','Kazakhstan',
            'Kyrgyzstan','North Macedonia','Tajikistan','Uzbekistan',
            'Bahamas','Barbados','Belize','Brazil','Chile','Dominican Republic',
            'El Salvador','Jamaica','Mexico','Peru','Saint Lucia','Suriname',
            'Venezuela (Bolivarian Republic of)',
            'Egypt','Iran (Islamic Republic of)','Iraq','Jordan','Kuwait',
            'Lebanon','Oman','Syrian Arab Republic','Yemen',
            'Algeria','Angola','Benin','Burkina Faso','Burundi','Cabo Verde',
            'Cameroon','Chad','Côte d\'Ivoire','Djibouti','Eswatini','Ethiopia',
            'Gambia','Ghana','Guinea','Kenya','Malawi','Mali','Mauritania',
            'Mauritius','Mozambique','Namibia','Nigeria','Somalia','South Sudan',
            'United Republic of Tanzania','Togo','Tunisia','Uganda','Zimbabwe',
        ];

        // ===============================
        // 2. PENERIMA POTENSIAL
        // ===============================
        $penerimaPotensial = [
            'Afghanistan','Brunei Darussalam','Cook Islands',
            'Democratic People\'s Republic of Korea','Kiribati','Marshall Islands',
            'Solomon Islands','Federated States of Micronesia','Nauru','Palau',
            'Tonga','Tuvalu',
            'Comoros','Botswana','Eritrea','Central African Republic','Lesotho',
            'Congo','Madagascar','Democratic Republic of the Congo','Equatorial Guinea',
            'Sao Tome and Principe','Libya','Guinea-Bissau','Seychelles','Senegal',
            'South Africa','Sudan','Rwanda','Gabon','Zambia',
            'Argentina','Colombia','Costa Rica','Cuba','Ecuador',
            'Guatemala','Honduras','Nicaragua','Panama','Paraguay','Uruguay',
            'Antigua and Barbuda','Dominica','Grenada','Haiti',
            'Saint Kitts and Nevis','Saint Vincent and the Grenadines','Trinidad and Tobago',
            'Albania','Andorra','Armenia','Bulgaria','Croatia','Cyprus',
            'Czechia','Estonia','Hungary','Latvia','Lithuania','Malta',
            'Moldova','Romania','Serbia','Slovakia','Slovenia','Turkmenistan',
        ];

        // ===============================
        // INSERT: SUDAH MENERIMA
        // ===============================
        foreach ($sudahMenerima as $name) {
            $state = $this->findState($name);

            if ($state) {
                $this->insertDctp($state->id, 'Sudah Menerima');
            } else {
                dump("NOT FOUND: " . $name);
            }
        }

        // ===============================
        // INSERT: POTENSIAL
        // ===============================
        foreach ($penerimaPotensial as $name) {
            $state = $this->findState($name);

            if ($state) {
                $this->insertDctp($state->id, 'Penerima Potensial');
            } else {
                dump("NOT FOUND: " . $name);
            }
        }
    }

    // ===============================
    // INSERT FUNCTION (ANTI DUPLICATE)
    // ===============================
    private function insertDctp($stateId, $status_penerimaan)
    {
        $exists = DB::table('kerjasamas')
            ->where('state_id', $stateId)
            ->where('bentuk_kerjasama', 'DCTP')
            ->exists();

        if (!$exists) {
            DB::table('kerjasamas')->insert([
                'state_id' => $stateId,
                'type_kerjasama' => 'Kerja Sama Lainnya',
                'bentuk_kerjasama' => 'DCTP',
                'status_penerimaan' => $status_penerimaan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    // ===============================
    // FIND STATE (SMART MATCH)
    // ===============================
    private function findState(string $name): ?State
    {
        $state = State::where('state_name', $name)->first();
        if ($state) return $state;

        $map = [
            'Lao People\'s Democratic Republic' => 'Lao People%',
            'Timor-Leste' => 'Timor%',
            'Venezuela (Bolivarian Republic of)' => 'Venezuela%',
            'Iran (Islamic Republic of)' => 'Iran%',
            'Syrian Arab Republic' => 'Syrian%',
            'North Macedonia' => '%Macedonia%',
            'Bosnia and Herzegovina' => 'Bosnia%',
            'Côte d\'Ivoire' => '%Ivoire%',
            'United Republic of Tanzania' => '%Tanzania%',
            'Federated States of Micronesia' => '%Micronesia%',
            'Democratic Republic of the Congo' => '%Congo%',
            'Central African Republic' => '%Central African%',
            'Sao Tome and Principe' => 'Sao Tome%',
            'Democratic People\'s Republic of Korea' => '%Korea%',
        ];

        if (isset($map[$name])) {
            return State::where('state_name', 'LIKE', $map[$name])->first();
        }

        return null;
    }
}