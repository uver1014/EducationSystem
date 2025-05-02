<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'title' => $this->facker->sentence(3),
            'thumbnaik' => $this->facker->imageUrl(),
            'description' => $this->facker->paragraph(),
            'video_url' => $this->facker->url(),
            'alway_delivery_flg' => $this->facker->boolean(),
            'grade_id' => $this->facker->numberBetween(1,12),
        ];
    }
}
