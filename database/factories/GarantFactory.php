<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GarantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'teacher_id' => $this->faker->numberBetween(1, 5),
            'subject_id' => $this->faker->unique->numberBetween(1, 6),
        ];
    }
}
