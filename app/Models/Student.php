<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Student
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $date_of_birth
 * @property string $date_of_enroll
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $group
 * @property-read int|null $group_count
 * @method static \Database\Factories\StudentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereDateOfEnroll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'date_of_birth',
        'date_of_enroll',
        'credits'
    ];

    public function group(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }

    public function prerequisite(): HasMany
    {
        return $this->hasMany(Prerequisite::class);
    }
}
