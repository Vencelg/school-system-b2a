<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'dateOfBirth' => $this->faker->date,
            'dateOfEnroll' => $this->faker->dateTimeBetween('+0 days', '+2 years'),
            'group_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
