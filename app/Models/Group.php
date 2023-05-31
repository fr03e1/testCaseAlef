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
        'title'
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function lectures(): BelongsToMany
    {
        return $this->belongsToMany(Lecture::class,'groups_lectures');
    }

    public function attachStudyPlan(array $array): void
    {

        foreach ($array['study_plan'] as $item) {
            $group = $this->find($item["group_id"]);
            $group->lectures()->attach($item["lecture_id"], [
                'order' => $item["order"],
            ]);
        }
    }

    public function syncStudentPlan(array $array)
    {

        foreach ($array['study_plan'] as $item) {
            $group = $this->find($item["group_id"]);
            $group->lectures()->syncWithPivotValues($item["lecture_id"], ['order'=>$item['order']]);
        }
    }
}
