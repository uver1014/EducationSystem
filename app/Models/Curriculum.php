<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CurriculumProgress;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';

    public function grades()
    {
        return $this->belongsTo(Grade::class);
    }

    public function curriculum_progress()
    {
        return $this->hasMany(CurriculumProgress::class, 'curriculums_id');
    }

    public function isCompleted($user)
    {
        return $this->curriculum_progress()->where('users_id', $user->id)
            ->where('clear_flg', 1)
            ->exists();
    }

    public static function getInfo($user)
    {
        $curriculums = Curriculum::all()->groupBy('grade_id');

        return $curriculums->map(function ($curriculumGroup) use ($user) {

            return $curriculumGroup->map(function ($curriculum) use ($user) {

                $curriculum->is_completed = $curriculum->isCompleted($user);
                return $curriculum;
            });
        });
    }
}
