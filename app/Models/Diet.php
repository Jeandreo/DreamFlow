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

    public function plannedToday()
    {
        $day = $this->today();

        if (!$day) {
            return collect();
        }

        $meals = $day->meals()->with(['items.food'])->get();

        return $meals->map(function ($meal) {
            // Planejados
            $plannedFoods = $meal->items->map(function ($item) {
                return [
                    'food' => $item->food,
                    'quantity' => $item->quantity,
                    'is_extra' => false, // planejado
                ];
            });

            // Extras (FoodLog com planned = false)
            $extraFoods = FoodLog::where('meal_time_id', $meal->id)
                ->whereDate('date', today())
                ->where('planned', false)
                ->with('food')
                ->get()
                ->map(function ($foodLog) {
                    return [
                        'food' => $foodLog->food,
                        'is_extra' => true, // extra
                    ];
                });

            // Junta planejados + extras
            $allFoods = $plannedFoods->merge($extraFoods);

            return [
                'meal_id' => $meal->id,
                'meal_name' => $meal->name,
                'foods' => $allFoods,
            ];
        });
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
       
        $logsFoods = FoodLog::where('diet_id', $this->id)
                ->whereDate('date', today())
                ->where('eaten', true)
                ->get();

        // Soma calorias
        $calories = 0;

        foreach ($logsFoods as $log) {
        $calories += $log->food->calories;
        }

        return $calories;

    }

}
