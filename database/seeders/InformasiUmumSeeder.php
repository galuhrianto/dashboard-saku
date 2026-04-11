<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformasiUmumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = base_path('data/informasi_umum.csv');

        if (!file_exists($file)) {
            $this->command->warn('File data/informasi_umum.csv tidak ditemukan. Lewati seeder Informasi Umum.');
            return;
        }

        $handle = fopen($file, "r");
        $headerLine = true;
        
        while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
            if ($headerLine) {
                $headerLine = false;
                continue; // Skip header: State Name, Informasi Umum
            }

            if (count($data) >= 2) {
                $stateName = trim($data[0]);
                $informasiUmum = trim($data[1]);

                if (strlen($stateName) < 3) {
                    continue;
                }

                $isPosisiLine = preg_match('/^(.*?)\s+(YA|TIDAK|Mempertimbangkan)\s+(YA|TIDAK|Mempertimbangkan)$/i', $informasiUmum, $posisiMatches);
                $isPosisiLineWithState = preg_match('/^(YA|TIDAK|Mempertimbangkan)\s+(YA|TIDAK|Mempertimbangkan)$/i', $informasiUmum, $posisiMatchesOnly);

                $searchName = trim($stateName);
                // If it's a "posisi" line but the format is `CountryName YA TIDAK` inside $informasiUmum:
                if ($isPosisiLine) {
                    $posisi2016 = trim($posisiMatches[2]);
                    $posisi2013 = trim($posisiMatches[3]);
                } elseif ($isPosisiLineWithState) {
                    $posisi2016 = trim($posisiMatchesOnly[1]);
                    $posisi2013 = trim($posisiMatchesOnly[2]);
                }

                if (($isPosisiLine || $isPosisiLineWithState) && strlen($informasiUmum) < 60) {
                    // It's a support position line!
                    $state = \App\Models\State::where('state_name', 'like', $searchName)->first();
                    if (!$state) {
                        $searchNameMod = str_ireplace([' and ', ' & '], '%', $searchName);
                        $state = \App\Models\State::where('state_name', 'like', $searchNameMod)->first();
                    }
                    if (!$state) continue;

                    \Illuminate\Support\Facades\DB::table('states')->where('id', $state->id)->update([
                        'posisi_2016' => strtoupper($posisi2016),
                        'posisi_2013' => strtoupper($posisi2013),
                    ]);
                    continue;
                }

                if (str_contains($informasiUmum, 'YA TIDAK') || strlen($informasiUmum) < 30) {
                    continue;
                }

                $searchName = trim($stateName);
                $state = \App\Models\State::where('state_name', 'like', $searchName)->first();
                
                if (!$state) {
                    $searchNameMod = str_ireplace([' and ', ' & '], '%', $searchName);
                    $state = \App\Models\State::where('state_name', 'like', $searchNameMod)->first();
                }

                if (!$state) {
                    $state = \App\Models\State::where('state_name', 'like', $searchName . '%')->first();
                }

                if (!$state) {
                    $possible = \App\Models\State::where('state_name', 'like', '%' . $searchName . '%')->get();
                    if ($possible->count() === 1) {
                        $state = $possible->first();
                    } elseif (stripos($searchName, 'United States') !== false) {
                        $state = \App\Models\State::where('state_name', 'like', '%United States of America%')->first();
                    }
                }

                if (!$state) continue;

                // Strip the duplicated uppercase country name prefix if it exists
                $len = strlen($stateName);
                $upperName = strtoupper(str_replace(' ', '', $stateName));
                $informasiUmum = preg_replace('/^'.preg_quote($upperName, '/').'/i', '', $informasiUmum);
                $informasiUmum = trim($informasiUmum);

                // Specific known fields
                $patterns = [
                    'dialing_code' => '/Dialing code:\s*(.+?)(?=\n|$)/i',
                    'currency' => '/Currency:\s*(.+?)(?=\n|$)/i',
                    'population' => '/Population:\s*(.+?)(?=\n|$)/i',
                    'leader' => '/(?:President|Prime minister|King|Monarch|Emperor|Supreme Leader|Leader):\s*(.+?)(?=\n|$)/i',
                    'official_languages' => '/Official languag(?:e|es):\s*(.+?)(?=\n|$)/i',
                    'points_of_interest' => '/Points of interest:\s*(.+?)(?=\n|$)/i',
                    'university' => '/University:\s*(.+?)(?=\n|$)/i',
                ];

                $updates = ['informasi_umum' => $informasiUmum];
                $additionalInfo = [];

                foreach ($patterns as $field => $regex) {
                    if (preg_match($regex, $informasiUmum, $matches)) {
                        $updates[$field] = trim($matches[1]);
                        $informasiUmum = str_replace($matches[0], '', $informasiUmum);
                    }
                }

                // Capital fallback
                if (preg_match('/Capital:\s*(.+?)(?=\n|$)/i', $informasiUmum, $matches)) {
                    $updates['capital_city'] = trim($matches[1]); // Will override or fill capital_city
                    $informasiUmum = str_replace($matches[0], '', $informasiUmum);
                }

                // Find any remaining "Key: Value" lines
                if (preg_match_all('/^([A-Z][a-zA-Z\s]+):\s*(.+?)$/mi', $informasiUmum, $matches, PREG_SET_ORDER)) {
                    foreach ($matches as $match) {
                        $key = trim($match[1]);
                        $val = trim($match[2]);
                        
                        // Ignore some false positives or generic text
                        if (strlen($key) < 30) {
                            $additionalInfo[$key] = $val;
                            $informasiUmum = str_replace($match[0], '', $informasiUmum);
                        }
                    }
                }

                // Preserve intentional double newlines as paragraph breaks
                $informasiUmum = preg_replace("/(?:(?:\r\n)|\n|\r){2,}/", "<PARAGRAPH_BREAK>", $informasiUmum);

                // Replace single newlines with a space (removes mid-sentence breaks)
                $informasiUmum = preg_replace("/(?:(?:\r\n)|\n|\r)/", " ", $informasiUmum);

                // Restore paragraph breaks as real double newlines
                $informasiUmum = str_replace("<PARAGRAPH_BREAK>", "\n\n", $informasiUmum);

                // Clean up any double spaces that might have formed
                $informasiUmum = preg_replace("/\s{2,}/", " ", $informasiUmum);

                $updates['deskripsi'] = trim($informasiUmum);
                $updates['additional_info'] = !empty($additionalInfo) ? json_encode($additionalInfo) : null;

                \Illuminate\Support\Facades\DB::table('states')->where('id', $state->id)->update($updates);
            }
        }
        
        fclose($handle);
        $this->command->info('Berhasil mengimpor informasi umum dari CSV!');
    }
}
