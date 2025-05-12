<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = [
            ['name' => '小学１年生'],
            ['name' => '小学２年生'],
            ['name' => '小学３年生'],
            ['name' => '小学４年生'],
            ['name' => '小学５年生'],
            ['name' => '小学６年生'],
            ['name' => '中学１年生'],
            ['name' => '中学２年生'],
            ['name' => '中学３年生'],
            ['name' => '高校１年生'],
            ['name' => '高校２年生'],
            ['name' => '高校３年生'],
        ];

        foreach ($grades as $grade) {
            Grade::create($grade);
        }
    }
}
