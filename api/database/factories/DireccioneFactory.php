<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Direccione>
 */
class DireccioneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'ciudad' => $this->faker->city(),
            'zona' => $this->faker->randomElement(['Obrajes','Calacoto','Irpavi','Achumani'.'San Pedro','Achachicala']),
            'calle' => $this->faker->streetName(),
            'nro' => $this->faker->streetAddress()
        ];
    }
}
