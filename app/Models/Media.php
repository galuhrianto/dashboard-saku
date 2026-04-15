<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{

protected $table = 'medias';
    protected $fillable = [
        'type',
        'title',
        'file_path',
    ];
}
