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
        
        // Define a localização para pegar o nome do dia em português
        Carbon::setLocale('pt_BR');
    
        // Obtém o nome do dia atual (ex: Segunda, Terça, etc.)
        $todayName = ucfirst(Carbon::now()->isoFormat('dddd'));
    
        // Busca o dia correspondente na dieta
        $day = $this->days()->where('name', $todayName)->first();

        return $day;

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
