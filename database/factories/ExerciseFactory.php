<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExerciseFactory extends Factory
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
            'own_computer' => $this->faker->boolean,
            'subject_id' => $this->faker->numberBetween(1, 6),

        ];
    }
}