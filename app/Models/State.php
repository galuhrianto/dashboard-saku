<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Direktur;
use App\Models\Kerjasama;


class State extends Model
{
    protected $fillable = [
    'state_name',
    'country_code',
    'capital_city',
    'icao_region',
    'icao_regional_office',
    'rep_in_council',
    'vote_probability_indonesia',
    'council_part',
    'posisi_2016',
    'posisi_2013',
    'informasi_umum',
    'deskripsi',
    'dialing_code',
    'currency',
    'population',
    'leader',
    'official_languages',
    'points_of_interest',
    'university',
    'additional_info',
];

    protected $casts = [
        'additional_info' => 'array',
    ];

    public function kerjasamas()
    {
        return $this->hasMany(Kerjasama::class, 'state_id');
    }

    public function beasiswa()
    {
        return $this->hasMany(Beasiswa::class);
    }

    public function direktur()
    {
        return $this->hasOne(Direktur::class, 'state_id');
    }
}
