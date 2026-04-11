<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'deskripsi',
        'dialing_code',
        'currency',
        'population',
        'leader',
        'official_languages',
        'points_of_interest',
        'university',
        'additional_info',
        'posisi_2016',
        'posisi_2013',
        'dctp_status',
    ];

    protected $casts = [
        'additional_info' => 'array',
    ];

    public function kerjasama()
    {
        return $this->hasMany(Kerjasama::class);
    }

    public function beasiswa()
    {
        return $this->hasMany(Beasiswa::class);
    }

    public function direktur()
    {
        return $this->hasMany(Direktur::class);
    }
}
