<?php

namespace Database\Factories;

use App\Models\Asistencia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asistencia>
 */
class AsistenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fecha' => $this->faker->date(),
            'validacione_id' =>$this->faker->randomElement([1,2,3,4]),
            'materiauser_id' =>$this->faker->numberBetween(1,20),
            'mensaje_id' =>$this->faker->randomElement([1,2,3]),
            'mensaje' =>$this->faker->text(),
        ];
    }
}
