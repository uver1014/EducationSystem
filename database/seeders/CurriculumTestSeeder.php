<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CurriculumTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('curriculums')->insert([
            [
                'id' => 80,
                'title' => '単体テスト1',
                'thumbnail' => 'https://picsum.photos/800/450',
                'description' => '単体テスト1概要',
                'video_url' => 'https://example.com/1',
                'alway_delivery_flg' => 1,
                'grade_id' => 1,
            ],
            [
                'id' => 90,
                'title' => '単体テスト2',
                'thumbnail' => 'https://picsum.photos/800/450',
                'description' => '単体テスト2概要',
                'video_url' => 'https://example.com/2',
                'alway_delivery_flg' => 1,
                'grade_id' => 1,
            ],
             [
                'id' => 100,
                'title' => '単体テスト3',
                'thumbnail' => 'https://picsum.photos/800/450',
                'description' => '単体テスト3概要',
                'video_url' => 'https://example.com/3',
                'alway_delivery_flg' => 1,
                'grade_id' => 7,
            ],
            [
                'id' => 105,
                'title' => '単体テスト4',
                'thumbnail' => 'https://picsum.photos/800/450',
                'description' => '単体テスト4概要',
                'video_url' => 'https://example.com/4',
                'alway_delivery_flg' => 1,
                'grade_id' => 10,
            ],
            [
                'id' => 110,
                'title' => '単体テスト5',
                'thumbnail' => 'https://picsum.photos/800/450',
                'description' => '単体テスト5概要',
                'video_url' => 'https://example.com/5',
                'alway_delivery_flg' => 1,
                'grade_id' => 6,
            ],
             [
                'id' => 120,
                'title' => '単体テスト6',
                'thumbnail' => 'https://picsum.photos/800/450',
                'description' => '単体テスト6概要',
                'video_url' => 'https://example.com/6',
                'alway_delivery_flg' => 1,
                'grade_id' => 12,
            ],
        ]);


        DB::table('delivery_times')->insert([
            [
                'id' => 85,
                'curriculums_id' => 80,
                'delivery_from' => Carbon::parse('2025-05-01 10:00'),
                'delivery_to' => Carbon::parse('2025-05-31 18:00'),
            ],
            [
                'id' => 95,
                'curriculums_id' => 90,
                'delivery_from' => Carbon::parse('2025-06-18 13:30'),
                'delivery_to' => Carbon::parse('2025-07-17 20:30'),
            ],
            [
                'id' => 115,
                'curriculums_id' => 110,
                'delivery_from' => Carbon::parse('2024-12-15 00:00'),
                'delivery_to' => Carbon::parse('2025-01-15 23:59'),
            ],
            [
                'id' => 125,
                'curriculums_id' => 120,
                'delivery_from' => Carbon::parse('2025-01-01 13:30'),
                'delivery_to' => Carbon::parse('2025-01-31 00:00'),
            ],
         ]);
    }
}
