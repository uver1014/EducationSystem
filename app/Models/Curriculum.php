<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    public function saveDeliveryTimes(array $fromDate, array $fromTime, array $toDate, array $toTime): void{
        $this->deliveryTimes()->delete();

        for ($i = 0; $i < count($fromDate); $i++) {
            if (empty($fromDate[$i]) || empty($fromTime[$i]) || empty($toDate[$i]) || empty($toTime[$i])) {
                continue;
            }
            $delivery = new DeliveryTime();
            $delivery->curriculums_id = $this->id;
            $delivery->delivery_from = Carbon::createFromFormat('Y-m-d H:i', $fromDate[$i] . ' ' . $fromTime[$i]);
            $delivery->delivery_to   = Carbon::createFromFormat('Y-m-d H:i', $toDate[$i] . ' ' . $toTime[$i]);
            $delivery->save();
        }

        $this->alway_delivery_flg = 0;
        $this->save();
    }

    public function grade() {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function deliveryTimes() {
        return $this->hasmany(DeliveryTime::class, 'curriculums_id');
    }
}
