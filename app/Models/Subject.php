<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function teacher(): BelongsTo
     {
         return $this->belongsTo(Teacher::class);
     }

    public function group(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
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
