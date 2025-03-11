<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CurriculumProgress extends Model
{
    use HasFactory;

    protected $table = 'curriculum_progress';
    protected $fillable = ['curriculums_id', 'users_id', 'clear_flg', 'completed_at'];
    public $timestamps = false;

    /**
     * 受講完了処理
     */
    public static function completeLesson($id)
    {
        return self::updateOrCreate(
            ['users_id' => Auth::id(), 'curriculums_id' => $id],
            ['completed_at' => now(), 'clear_flg' => 1]
        );
    }
}
