<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'goal', 'total_calories'];

    public function meals()
    {
        return $this->belongsToMany(Meal::class)->withPivot('time', 'day_of_week')->withTimestamps();
    }
     /**
     * Função para calcular o total de calorias de uma dieta
     *
     * @return int
     */
    public function calculateTotalCalories()
    {
        $totalCalories = 0;

        // Itera sobre as refeições associadas à dieta
        foreach ($this->meals as $meal) {
            // Itera sobre os pratos de cada refeição
            foreach ($meal->dishes as $dish) {
                // Soma as calorias do prato
                $totalCalories += $dish->foods->sum('calories');
            }
        }

        return $totalCalories;
    }
}
