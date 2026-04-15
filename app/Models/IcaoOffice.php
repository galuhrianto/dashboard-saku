<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IcaoOffice extends Model
{
    protected $fillable = [
        'name',
        'position',
        'photo',
    ];
}
