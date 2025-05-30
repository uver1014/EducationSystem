<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        \App\Models\Grade::truncate();

        $grades = [
            '小学1年', 
            '小学2年', 
            '小学3年', 
            '小学4年', 
            '小学5年', 
            '小学6年',
            '中学1年',
            '中学2年',
            '中学3年',
            '高校1年',
            '高校2年',
            '高校3年',
        ];

        foreach ($grades as $grade) {
            Grade::create(['name' => $grade]);

         }
    }
}