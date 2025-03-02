<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany(CurriculumProgress::class);
    }
}
