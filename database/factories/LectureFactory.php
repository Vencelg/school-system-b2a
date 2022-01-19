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
            'presentation_date' => $this->faker->dateTimeBetween('+0 days', '+2 years'),
            'subject_id' => $this->faker->numberBetween(1,5),
        ];
    }
}
