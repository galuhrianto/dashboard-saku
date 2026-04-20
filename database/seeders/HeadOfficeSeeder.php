<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class HeadOfficeSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

    // LEVEL 1
    $president = $this->insert('Mr. Toshiyuki Onuma', 'President of the Council');

    // LEVEL 2
    $sg = $this->insert('Mr. Juan Carlos Salazar', 'Secretary General', $president);

    // ======================
    // 1. LEGAL
    // ======================
    $legal = $this->insert('Mr. Michael S. GILL', 'Director Legal Affairs and External Relations Bureau', $sg);
    $this->insert('Mr. Chunyu DING', 'Deputy Director', $legal);

    // ======================
    // 2. AIR TRANSPORT
    // ======================
    $air = $this->insert('Mr. Mohamed Abdel Rahman Ali KHALIFA', 'Director Air Transport Bureau', $sg);
    $this->insert('-', 'Deputy Director Aviation Security and Facilitation', $air);
    $this->insert('-', 'Deputy Director Economic Development', $air);
    $this->insert('Mrs. Jane HUPE', 'Deputy Director Environment', $air);

    // ======================
    // 3. AIR NAVIGATION
    // ======================
    $nav = $this->insert('Mrs. Michele Marie MERKLE', 'Director Air Navigation Bureau', $sg);
    $this->insert('Mr. Pascal LUCIANI', 'Deputy Director Air Navigation and Aviation Safety', $nav);
    $this->insert('-', 'Deputy Director Monitoring, Analysis, and Coordination', $nav);

    // ======================
    // 4. CAPACITY
    // ======================
    $cap = $this->insert('Mr. Jorge VARGAS ARAYA', 'Director Capacity Development and Implementation Bureau', $sg);
    $this->insert('Mr. Miguel MARIN', 'Deputy Director', $cap);

    // ======================
    // 5. ADMIN
    // ======================
    $admin = $this->insert('Mr. Arun MISHRA', 'Director Bureau of Administration and Services', $sg);
    $this->insert('-', 'Chief Information Officer/Deputy Director, Information Management Services', $admin);
    $this->insert('Mr. Wei WEN', 'Deputy Director Languages, Publications, and Confrence Management', $admin);
    $this->insert('-', 'Deputy Director Human Resources', $admin);

    // ======================
    // 6. STRATEGIC
    // ======================
    $this->insert('-', 'Strategic Portfolio Management Office', $sg);

    // ======================
    // 7. REGIONAL (URUTAN EXACT)
    // ======================
    $this->insert('Mr. Tao MA', 'Director Regional Office, Bangkok (APAC)', $sg);
    $this->insert('Mr. Mohamed SMAOUI', 'Director Regional Office, Cairo (MID)', $sg);
    $this->insert('Mr. Romain EKOTO', 'Director Regional Office, Dakar (WACAF)', $sg);
    $this->insert('Mr. Oscar QUESADA CARBONI', 'Director Regional Office, Lima (SAM)', $sg);
    $this->insert('Mr. Christopher BARKS', 'Director Regional Office, Mexico (NACC)', $sg);
    $this->insert('Ms. Lucy MBUGUA', 'Director Regional Office, Nairobi (ESAF)', $sg);
    $this->insert('Mr. Nicolas RALO', 'Director Regional Office, Paris (EUR/NAT) Director', $sg);

});
    }

    private $time;

private function insert($name, $position, $parentId = null)
{
    if (!$this->time) {
        $this->time = now();
    }

    $this->time = $this->time->copy()->addSecond();

    $id = (string) \Illuminate\Support\Str::uuid();

    DB::table('head_offices')->insert([
        'id' => $id,
        'parent_id' => $parentId,
        'name' => $name,
        'position' => $position,
        'photo' => $this->photoName($name),
        'created_at' => $this->time,
        'updated_at' => $this->time,
    ]);

    return $id;
}
   
    private function photoName($name)
{
    if (!$name || $name === '-') return null;

    $availablePhotos = [
        'toshiyuki onuma',
        'juan carlos salazar',
        'michael s. gill',
        'chunyu ding',
        'mohamed abdel rahman ali khalifa',
        'jane hupe',
        'michele marie merkle',
        'pascal luciani',
        'jorge vargas araya',
        'miguel marin',
        'arun mishra',
        'tao ma',
        'mohamed smaoui',
        'romain ekoto',
        'oscar quesada carboni',
        'christopher barks',
        'lucy mbugua',
        'nicolas ralo',
    ];

    // normalisasi nama
    $clean = preg_replace('/^(Mr\.|Mrs\.|Ms\.|Dr\.)\s*/i', '', $name);
    $clean = strtolower(trim($clean));

    if (!in_array($clean, $availablePhotos)) {
        return null;
    }

    $words = explode(' ', $clean);
    $words = array_slice($words, 0, 2);

    $filename = implode('', $words) . '.jpg';
    return $this->copyPhotoToStorage($filename);
}
}