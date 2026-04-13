<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Direktur;
use App\Models\Kerjasama;   
use App\Models\State;

class Kerjasama extends Model
{
    protected $fillable = [
        'bentuk_kerjasama',
        'state_id',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
