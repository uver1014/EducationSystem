<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryTime;
use App\Models\Curriculum;
use Carbon\Carbon;

class DeliveryTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // カリキュラムが存在する場合のみ処理
        $curriculums = Curriculum::where('alway_delivery_flg', 0)->get();

        foreach ($curriculums as $curriculum) {
            DeliveryTime::create([
                'curriculums_id' => $curriculum->id,
                'delivery_from' => Carbon::now()->subDays(rand(1, 30)), // 過去1〜30日のランダムな日付
                'delivery_to' => Carbon::now()->addDays(rand(1, 30)),  // 未来1〜30日のランダムな日付
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
