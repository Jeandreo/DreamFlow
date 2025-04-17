<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
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
                'Arroz Integral',
                'Peito de Frango',
                'Banana',
                'Ovo',
                'Brócolis',
                'Batata Doce',
                'Aveia',
                'Salmão',
                'Queijo Cottage',
            ]),
            'category' => $this->faker->randomElement(['Proteína', 'Carboidrato', 'Gordura', 'Vegetal', 'Fruta']),
            'base_quantity' => '100g',
            'calories' => $this->faker->randomFloat(2, 20, 300),
            'proteins' => $this->faker->randomFloat(2, 0, 30),
            'carbohydrates' => $this->faker->randomFloat(2, 0, 50),
            'fats' => $this->faker->randomFloat(2, 0, 20),
            'fiber' => $this->faker->randomFloat(2, 0, 10),
            'notes' => $this->faker->optional()->sentence(),
            'created_by' => 1,
        ];
        

    }
}
