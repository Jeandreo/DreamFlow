<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'day_of_week_id',
        'status',
        'created_by',
        'updated_by'
    ];

    public function day()
    {
        return $this->belongsTo(DayOfWeek::class);
    }

    public function items()
    {
        return $this->hasMany(MealItem::class);
    }

    /**
     * Calcula o total de um nutriente específico (ex: calorias, proteínas, etc)
     * somando o valor dos alimentos e pratos contidos neste horário da refeição.
     * 
     * @param string $nutrient Nome da propriedade do nutriente (ex: 'protein', 'calories')
     * @return float Total acumulado do nutriente
     */
    public function getTotalNutrient($nutrient)
    {
        // Conta as calorias
        $total = 0;

        // Faz looping entre os alimentos
        foreach ($this->items as $item) {

            // Se for alimento
            if ($item->food) {
                $total += $item->food->$nutrient * $item->quantity;
            }

            // Se for um prato
            if ($item->dish) {
                $total += $item->dish->foods->sum(function ($food) use ($nutrient) {
                    return $food->$nutrient;
                }) * $item->quantity;
            }

        }

        return $total;

    }



}
