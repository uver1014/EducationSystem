<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Curriculum extends Model{
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

    public function saveCurriculumData(Request $request){
        $this->thumbnail = $request->input('thumbnail');
        $this->grade_id = $request->input('grade');
        $this->title = $request->input('title');
        $this->video_url = $request->input('video_url');
        $this->description = $request->input('description');
        $this->alway_delivery_flg = $request->has('alway_delivery_flg') ? 1 : 0;

        return $this; 
    }

    public function grade() {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function deliveryTimes() {
        return $this->hasmany(DeliveryTime::class, 'curriculums_id');
    }
}
