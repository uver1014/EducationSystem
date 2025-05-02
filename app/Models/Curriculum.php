<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

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

    public function scopCurrentMonth($query,$month)
    {
        return $query->whereHas('deliveryTimes',function ($q) {
            $q->whereMonth('delivery_from',$month);
        });
        
    }
}