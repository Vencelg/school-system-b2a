<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'dateOfBirth',
        'dateOfEnroll',
    ];

    public function group(): HasOne
    {
        return $this->hasOne(Group::class);
    }

}
