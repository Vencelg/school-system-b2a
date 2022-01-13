<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Garant extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'subject_id',
    ];

    public function subject() :HasOne
    {
        return $this->hasOne(Subject::class, 'subject_id', 'id');
    }
}
