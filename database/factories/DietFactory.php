<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diet>
 */
class DietFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Dieta ' . $this->faker->randomElement(['Low Carb', 'Balanceada', 'Cetogênica', 'Hipercalórica', 'Vegetariana']),
            'goal' => $this->faker->randomElement(['Emagrecimento', 'Manutenção', 'Ganhar Massa']),
            'total_calories' => $this->faker->numberBetween(1800, 3500),
        ];        
    }
}
