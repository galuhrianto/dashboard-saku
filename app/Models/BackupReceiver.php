<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackupReceiver extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'is_active',
        'accounts',
    ];

    protected $casts = [
        'accounts' => 'array',
    ];
}