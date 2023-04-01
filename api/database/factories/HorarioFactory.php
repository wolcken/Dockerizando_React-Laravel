<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Horario>
 */
class HorarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'dia_id' => $this->faker->randomElement([1,2,3,4,5,6]),
            'nivele_id' => $this->faker->randomElement([1,2]),
            'cursoparalelo_id' => $this->faker->numberBetween(1,48),
            'materiauser_id' => $this->faker->numberBetween(1,20),
            'periodo_id' => $this->faker->randomElement([1,2,3,4]),
        ];
    }
}
