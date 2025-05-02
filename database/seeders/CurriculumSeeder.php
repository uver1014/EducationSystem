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
        foreach ($grades as $grade) {
            $curriculum = Curriculum::create([
                'title' => "学年{$grade}の授業",
                'thumbnail' => "thumbnail{$grade}.jpg",
                'description' => "これは学年{$grade}のカリキュラムです。",
                'video_url' => "https://example.com/video{$grade}",
                'alway_delivery_flg' => 0,
                'grade_id' => $grade,
            ]);

            DeliveryTime::create([
                'curriculums_id' => $curriculum->id,
                'delivery_from' => Carbon::now()->startOfMonth(),
                'delivery_to' => Carbon::now()->endOfMonth(),
            ]);
        }
    }
}
