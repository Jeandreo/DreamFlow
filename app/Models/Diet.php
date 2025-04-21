<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'goal', 
        'total_calories', 
        'created_by',
        'updated_by'
    ];

    protected static function booted()
    {
        static::created(function ($diet) {
            $diet->createDefaultDaysAndMeals();
        });
    }

    public function createDefaultDaysAndMeals()
    {
        $days = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'];
        $mealNames = ['Café da Manhã', 'Lanche da Manhã', 'Almoço', 'Lanche da Tarde', 'Jantar'];

        foreach ($days as $dayName) {
            $day = $this->days()->create(['name' => $dayName]);

            foreach ($mealNames as $mealName) {
                $day->meals()->create(['name' => $mealName]);
            }
        }
    }

    public function days()
    {
        return $this->hasMany(DayOfWeek::class);
    }


    public function today()
    {
        
        // Usa dayOfWeekIso (1 a 7, onde 1 = Segunda e 7 = Domingo)
        $dayIndex = Carbon::now()->dayOfWeekIso - 1;

        // Retorna o modelo DayOfWeek correspondente (mantém relacionamentos)
        return $this->days->values()->get($dayIndex);

    }

    public function eatToday() {

        $logs = FoodLog::where(
                'diet_id', $this->id)
                ->where('date', date('Y-m-d'))
                ->where('eaten', true)
                ->get()
                ->groupBy('meal_time_id')
                ->map(function ($group) {
                    return $group->pluck('food_id')->toArray();
                })
                ->toArray();        

        return $logs;
    }

    public function caloriesEatenToday()
    {
        // Pega os IDs dos alimentos comidos hoje
        $foodIds = collect($this->eatToday())
                    ->flatten()
                    ->unique()
                    ->toArray();

        // Soma as calorias dos alimentos
        return Food::whereIn('id', $foodIds)->sum('calories');
    }

}
