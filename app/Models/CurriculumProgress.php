<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumProgress extends Model
{
    use HasFactory;

    protected $table = 'curriculum_progress';
    protected $fillable = ['curriculums_id', 'users_id', 'clear_flg', 'created_at', 'updated_at'];

    public $timestamps = false;
}
