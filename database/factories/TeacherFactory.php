<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titles' => $this->faker->title,
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date,
        ];
    }
}
