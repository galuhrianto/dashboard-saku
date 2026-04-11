<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\State;

$states = State::whereNotNull('informasi_umum')->get();
$count = 0;

foreach ($states as $state) {
    $info = $state->informasi_umum;
    
    // Pattern to grab "Key: Value" lines
    $patterns = [
        'dialing_code' => '/Dialing code:\s*(.+?)(?=\n|$)/i',
        'currency' => '/Currency:\s*(.+?)(?=\n|$)/i',
        'population' => '/Population:\s*(.+?)(?=\n|$)/i',
        'leader' => '/(?:President|Prime minister|King|Monarch|Emperor|Supreme Leader|Leader):\s*(.+?)(?=\n|$)/i',
    ];

    $updates = [];
    foreach ($patterns as $field => $regex) {
        if (preg_match($regex, $info, $matches)) {
            $updates[$field] = trim($matches[1]);
            // Remove the matched line from info
            $info = str_replace($matches[0], '', $info);
        }
    }

    // Also look for Capital since they asked for it, though we already have capital_city
    // If capital_city is empty in DB, we can maybe grab it. 
    // And actually "Capital: " might still be inside info, let's remove it
    if (preg_match('/Capital:\s*(.+?)(?=\n|$)/i', $info, $matches)) {
        if (empty($state->capital_city)) {
            $updates['capital_city'] = trim($matches[1]);
        }
        $info = str_replace($matches[0], '', $info);
    }
    
    // Official language
    if (preg_match('/Official languag(?:e|es):\s*(.+?)(?=\n|$)/i', $info, $matches)) {
        $info = str_replace($matches[0], '', $info);
    }

    // University
    if (preg_match('/University:\s*(.+?)(?=\n|$)/i', $info, $matches)) {
        $info = str_replace($matches[0], '', $info);
    }
    
    // Points of interest
    if (preg_match('/Points of interest:\s*(.+?)(?=\n|$)/i', $info, $matches)) {
        $info = str_replace($matches[0], '', $info);
    }

    // Clean up empty lines
    $info = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $info);
    $info = trim($info);
    
    $updates['deskripsi'] = $info;

    $state->update($updates);
    $count++;
}

echo "Successfully parsed and separated informasi_umum into columns for $count states.\n";
