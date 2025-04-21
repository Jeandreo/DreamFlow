<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'goal', 'total_calories', 'created_by', 'updated_by'];

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

        $logs = FoodLog::where('diet_id', $this->id)
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

}
