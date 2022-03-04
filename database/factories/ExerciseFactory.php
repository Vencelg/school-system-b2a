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
            'credits_to_give' => $this->faker->numberBetween('0', '30'),
            'subject_id' => $this->faker->numberBetween(1, 5),
            'teacher_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
