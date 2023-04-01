<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona>
 */
class PersonaFactory extends Factory
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
                'carnet' => $this->faker->randomElement(['1655656 - LP','65466621 - Or','5498465 - SC','6546813 - Tj','165416516 - Pt']),
                'nacimiento'=>$this->faker->date(),
        ];
    }
}
