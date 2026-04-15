<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Direktur;
use App\Models\Kerjasama;   
use App\Models\State;

class Kerjasama extends Model
{
    protected $fillable = [
        'state_id',
        'bentuk_kerjasama',
        'status',
        'deskripsi'
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
