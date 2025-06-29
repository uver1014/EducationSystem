<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DeliveryTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'curriculums_id',
        'delivery_from',
        'delivery_to',
        'created_at',
        'updated_at'
    ];

    public function curriculum() {
        return $this->belongsTo(Curriculum::class, 'curriculums_id');
    }

    public static function saveForCurriculum(Curriculum $curriculum, array $fromDate, array $fromTime, array $toDate, array $toTime): void{
        self::deleteForCurriculum($curriculum);

        for ($i = 0; $i < count($fromDate); $i++) {
            if (empty($fromDate[$i]) || empty($fromTime[$i]) || empty($toDate[$i]) || empty($toTime[$i])) {
                continue;
            }

            $delivery = new self();
            $delivery->curriculums_id = $curriculum->id;
            $delivery->delivery_from = Carbon::createFromFormat('Y-m-d H:i', $fromDate[$i] . ' ' . $fromTime[$i]);
            $delivery->delivery_to   = Carbon::createFromFormat('Y-m-d H:i', $toDate[$i] . ' ' . $toTime[$i]);
            $delivery->save();
        }
    }

    public static function deleteForCurriculum(Curriculum $curriculum): void{
        self::where('curriculums_id', $curriculum->id)->delete();
    }
}
