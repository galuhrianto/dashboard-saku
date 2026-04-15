<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HeadOffice extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['parent_id', 'name', 'position', 'photo'];

    // Relasi ke atasan (parent)
    public function parent(): BelongsTo
    {
        return $this->belongsTo(HeadOffice::class, 'parent_id');
    }

    // Relasi ke bawahan (children) secara rekursif
    public function children(): HasMany
    {
        return $this->hasMany(HeadOffice::class, 'parent_id')->with('children');
    }
}
