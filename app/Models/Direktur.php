<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direktur extends Model
{
    
    protected $fillable = [
    'nama',
    'jabatan',
    'state_id'
];
    public function state()
{
    return $this->belongsTo(State::class);  
}
}