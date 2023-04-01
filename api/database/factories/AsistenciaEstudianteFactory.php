<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AsistenciaEstudiante>
 */
class AsistenciaEstudianteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'estudiante_id' =>$this->faker->numberBetween(1,\App\Models\Estudiante::count()),
            'asistencia_id' =>$this->faker->numberBetween(1,\App\Models\Asistencia::count()),
        ];
    }
}
