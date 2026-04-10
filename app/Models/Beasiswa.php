<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    protected $fillable = [
        'nama_penerima',
        'nama_beasiswa',
        'tahun',
        'state_id',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
