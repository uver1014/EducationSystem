<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curriculum;

class CurriculumProgress extends Model
{
    use HasFactory;

    protected $table = 'curriculum_progress';

    protected $fillable = [

        'users_id',
        'curriculums_id',
        'clear_flg',
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculums_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
