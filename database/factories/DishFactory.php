<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dish>
 */
class DishFactory extends Factory
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
                'Frango com Batata Doce',
                'Omelete de Claras',
                'Peito de Frango Grelhado',
                'Salmão com Legumes',
                'Quinoa com Vegetais',
            ]),
            'description' => $this->faker->sentence(),
            'preparation_method' => $this->faker->paragraph(),
            'created_by' => 1,
        ];
        
    }
}
