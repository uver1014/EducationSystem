<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    use HasFactory;

    protected $table = 'delivery_times';
    protected $fillable = ['curriculums_id', 'delivery_from', 'delivery_to'];
    public $timestamps = false;

    /**
     * 指定した授業が配信可能かどうかを判定（常時公開フラグも考慮）
     */
    public static function isLessonAvailable($id)
    {
        $curriculum = Curriculum::find($id);
        if ($curriculum && $curriculum->alway_delivery_flg) {
            return true;
        }

        return self::where('curriculums_id', $id)
            ->where('delivery_from', '<=', now())
            ->where('delivery_to', '>=', now())
            ->exists();
    }
}
