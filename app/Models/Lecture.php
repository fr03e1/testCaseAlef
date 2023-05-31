<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic',
        'description',
    ];


    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class,'groups_lectures');
    }

    public function students(): HasManyThrough
    {
        return $this->hasManyThrough(Student::class, Student::class);
    }
}
