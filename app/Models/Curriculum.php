<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Curriculum extends Model
{
    use HasFactory;

    const ALWAYS_DELIVERY_FLAG_ON = 1;

    protected $table = 'curriculums';
    protected $fillable = [
        'title',
        'thumbnail',
        'description',
        'video_url',
        'alway_delivery_fig',
        'grade_id',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class,'grade_id');
    }

    public function deliveryTimes()
    {
        return $this->hasMany(DeliveryTime::class,'curriculums_id');
    }

    public function scopeCurrentMonth($query,$month)
    {
        return $query->whereHas('deliveryTimes',function ($q) {
            $q->whereMonth('delivery_from',$month);
        });
        
    }

    //常時公開設定の場合、配信期間に関係なく取得
    public function scopeAvailable($query)
    {
        return $query->where('alway_delivery_flg',Curriculum::ALWAYS_DELIVERY_FLAG_ON)
                    ->orWhereHas('deliveryTimes',function ($query) {
                        $query->where('delivery_from','<=',Carbon::now())
                                ->where('delivery_to','>=',Carbon::now());
                    });
    }
}