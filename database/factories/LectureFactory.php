<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LectureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->city,
            'subject_id' => $this->faker->numberBetween(1,5),
            'teacher_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
