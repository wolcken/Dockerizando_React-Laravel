<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Colegio>
 */
class ColegioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'turno_id' => $this->faker->randomElement([1, 2, 3]),
            'categoria_id' => $this->faker->randomElement([1, 2, 3]),
        ];
    }
}
