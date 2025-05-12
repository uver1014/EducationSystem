<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DeliveryTime extends Model
{
    use HasFactory;

    protected $table = 'delivery_times';
    protected $fillable = [
        'curriculums_id',
        'delivery_from',
        'delivery_to',
    ];

    public function curriculum()
    {
        return $this->belongsTo(curriculum::class,'curriculums_id');
    }

    public function scopeActive($query)
    {
        return $query->where('delivery_from','<=',Carbon::now())
                    ->where('delivery_to','>=',Carbon::now());
    }

    public function scopForMonth($query, $month)
    {
        return $query->wheremonth('delivery_from',Carbon::parse($month)->month)
                    ->whereYear('delivery_from',Carbon::parse($month)->year);
    }
}