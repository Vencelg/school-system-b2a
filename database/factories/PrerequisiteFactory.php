<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PrerequisiteFactory extends Factory
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
            'deadline_date' => $this->faker->dateTimeBetween('+0 days', '+2 years'),
            'student_id' => $this->faker->numberBetween(1, 5),
            'subject_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
