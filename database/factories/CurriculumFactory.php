<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Grade;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curriculum>
 */
class CurriculumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gradeIds = Grade::pluck('id')->toArray();

        return [
            'title' => $this->faker->word,
            'thumbnail' => $this->faker->realText(),
            'description' => $this->faker->realText(),
            'video_url' => $this->faker->url(),
            'alway_delivery_flg' => $this->faker->numberBetween($min = 0, $max = 1),
            'grade_id' => $this->faker->randomElement($gradeIds),
        ];
    }
}
