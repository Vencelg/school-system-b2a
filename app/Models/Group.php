<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function subjects() :BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }

    public function students() :BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }
}
