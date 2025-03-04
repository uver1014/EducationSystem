<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    use HasFactory;

    // テーブル名の明示 (Eloquentが自動で単数形にしないようにする)
    protected $table = 'delivery_times';

    // 変更可能なカラムの指定 (mass assignment対策)
    protected $fillable = [
        'curriculums_id', 'delivery_from', 'delivery_to'
    ];

    // timestamps (created_at, updated_at) を無効化する場合
    public $timestamps = false;

    // `curriculums_id` は `curriculum` テーブルの `id` に紐付く
    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculums_id');
    }
}
