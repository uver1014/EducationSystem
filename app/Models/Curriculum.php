<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DeliveryTime;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';

    protected $fillable = [
        'title',
        'thumbnail',
        'description',
        'video_url',
        'alway_delivery_flg',
        'grade_id'
    ];

    /**
     * gradeとのリレーションを定義
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    /**
     * 指定したIDの授業情報を取得
     */
    public static function getLessonWithGrade($id)
    {
        return self::with('grade')->findOrFail($id);
    }

    /**
     * 配信可能かどうかを判定（常時公開フラグも考慮）
     */
    public function isAvailable()
    {
        return $this->alway_delivery_flg || DeliveryTime::isLessonAvailable($this->id);
    }
}
