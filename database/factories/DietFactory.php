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
            'name' => 'Standard Diet - ' . $this->faker->word(),
            'goal' => $this->faker->randomElement(['Weight Loss', 'Maintenance', 'Bulking']),
            'total_calories' => $this->faker->numberBetween(1800, 3500),
        ];
    }
}
