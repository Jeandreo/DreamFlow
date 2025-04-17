<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Café da Manhã',
                'Almoço',
                'Jantar',
                'Lanche da Tarde',
                'Pré-Treino',
                'Pós-Treino',
                'Ceia',
            ]),
        ];
        
    }
}
