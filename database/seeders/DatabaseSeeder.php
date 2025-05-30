<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curriculum;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 他のシーダークラスを指定して実行
        $this->call([
            GradeSeeder::class,  
            CurriculumSeeder::class, 
            DeliveryTimeSeeder::class, 
        ]);
    }
     
    //public function run(): void {
        //Curriculum::factory()->count(10)->create(); 
    //}
}
