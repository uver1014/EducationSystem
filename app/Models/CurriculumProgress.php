<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CurriculumProgress extends Model
{
    use HasFactory;

    protected $table = 'curriculum_progress';

    protected $fillable = ['curriculums_id', 'users_id', 'clear_flg', 'created_at', 'updated_at'];

    public $timestamps = true; // created_at, updated_at を自動管理

    /**
     * 受講完了処理
     */
    public static function completeLesson($id)
    {
        return self::updateOrCreate(
            ['users_id' => Auth::id(), 'curriculums_id' => $id],
            [
                'clear_flg' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
