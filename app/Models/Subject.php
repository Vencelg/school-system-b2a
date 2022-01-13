<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function garant(): BelongsTo
    {
        return $this->belongsTo(Garant::class, 'garant_id', 'id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class, 'subject_id', 'id');
    }

    public function Exercises(): HasMany
    {
        return $this->hasMany(Exercise::class, 'subject_id', 'id');
    }
}
