<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'titles',
        'firstname',
        'lastname',
        'dateOfBirth',
        'subject_id'
    ];

    public function subject() :HasOne
    {
        return $this->hasOne(Subject::class, 'teacher_id', 'id');
    }
}
