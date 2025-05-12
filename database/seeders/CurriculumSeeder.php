<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use Carbon\Carbon;

class CurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = range(1,12); //小学1年～高校３年生
        $now = Carbon::now();
        $previousMonth = $now->copy()->subMonth()->format('Y-m-d H:i:s');
        $nextMonth = $now->copy()->addMonth()->format('Y-m-d H:i:s');

        foreach ($grades as $grade) {
            for ($i = 1; $i <=6 ; $i++) {
                //カリキュラムデータを6件ずつ作成
                $curriculum = Curriculum::create([
                    'title' => "学年{$grade}の授業",
                    'thumbnail' => "https://picsum.photos/300/200?random={$grade}{$i}",//外部画像URL
                    'description' => "これは{$grade}のカリキュラムです。",
                    'video_url' => "https://example.com/video{$grade}",
                    'alway_delivery_flg' => $i % 3 === 0 ? 1:0, //1/3の確率で常時公開フラグをＯＮ
                    'grade_id' => $grade,
                ]);
    
                // 配信期間（当月）のデータを作成（複数設定）
                DeliveryTime::create([
                    'curriculums_id' => $curriculum->id,
                    'delivery_from' => Carbon::now()->startOfMonth(),
                    'delivery_to' => Carbon::now()->endOfMonth(),
                ]);
    
                //前月のデータ
                DeliveryTime::create([
                    'curriculums_id' => $curriculum->id,
                    'delivery_from' => Carbon::parse($previousMonth)->startOfMonth(),
                    'delivery_to' => Carbon::parse($previousMonth)->endOfMonth(),
                ]);
    
                //翌月のデータ
                DeliveryTime::create([
                    'curriculums_id' => $curriculum->id,
                    'delivery_from' => Carbon::parse($nextMonth)->startOfMonth(),
                    'delivery_to' => Carbon::parse($nextMonth)->endOfMonth(),
                ]);    
            }
        }
    }
}
