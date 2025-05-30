<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';
    protected $fillable = [
        'id', 
        'title',
        'thumbnail',
        'description',
        'video_url',
        'alway_delivery_flg',
        'grade_id',
    ]; 

    protected $casts = [
    'alway_delivery_flg' => 'boolean',
    ];

    public function grade() {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function deliveryTimes() {
        return $this->hasmany(DeliveryTime::class, 'curriculums_id');
    }

}
