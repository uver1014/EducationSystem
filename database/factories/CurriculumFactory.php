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
    public function definition(){
        return [
            'title' => $this->faker->sentence(3),
            'thumbnail' => 'https://picsum.photos/800/450',
            'description' => $this->faker->text(100),
            'video_url' => $this->faker->url(),
            'alway_delivery_flg' => $this->faker->boolean(),
            'grade_id' => $this->faker->numberBetween(1, 12),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
