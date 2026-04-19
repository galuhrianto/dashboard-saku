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
        'type_kerjasama',
        'mou',
        'bentuk_kerjasama',
        'status_penerimaan',
        'status',
        'deskripsi'
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
