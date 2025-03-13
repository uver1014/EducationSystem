<?php

namespace Database\Factories;

use App\Models\Curriculum;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Grade;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CurriculumProgress>
 */
class CurriculumProgressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        $curriculumIds = Curriculum::pluck('id')->toArray();

        return [
            'users_id' => $this->faker->randomElement($userIds),
            'curriculums_id' => $this->faker->randomElement($curriculumIds),
            'clear_flg' => $this->faker->numberBetween($min = 0, $max = 1),
        ];
    }
}
