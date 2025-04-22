<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBody extends Model
{
    use HasFactory;
    protected $table = 'users_bodies';
    
    protected $fillable = [
        'user_id',
        'weight',
        'height',
        'age',
        'gender',
        'body_fat',
        'activity_level',
    ];

    /**
     * Relacionamento com o usuário
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mutator para calcular TMB baseado na fórmula de Harris-Benedict
    public function calculateBmr()
    {
        $bmr = 0;

        if ($this->gender == 'male') {
            $bmr = 88.362 + (13.397 * $this->weight) + (4.799 * $this->height) - (5.677 * $this->age);
        } elseif ($this->gender == 'female') {
            $bmr = 447.593 + (9.247 * $this->weight) + (3.098 * $this->height) - (4.330 * $this->age);
        }

        // Definir o Fator de Atividade baseado no nível de atividade
        $activity_factor = 1.2; // Sedentário como padrão

        switch ($this->activity_level) {
            case 'light':
                $activity_factor = 1.375;
                break;
            case 'moderate':
                $activity_factor = 1.55;
                break;
            case 'intense':
                $activity_factor = 1.725;
                break;
            case 'extreme':
                $activity_factor = 1.9;
                break;
        }

        // Calcular TMB ajustada com o fator de atividade
        $total_calories = $bmr * $activity_factor;

        // Salvar os valores
        $this->bmr = $bmr;
        $this->total_calories = $total_calories;

        $this->save();

        return [$bmr, $total_calories];
    }
}
