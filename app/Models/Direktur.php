<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direktur extends Model
{
    protected $fillable = [
        'nama',
        'jabatan',
        'masa_jabatan',
        'kontak',
        'state_id',
        'photo',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
