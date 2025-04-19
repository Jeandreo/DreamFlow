<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayOfWeek extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'diet_id'];

    public function diet()
    {
        return $this->belongsTo(Diet::class);
    }

    public function meals()
    {
        return $this->hasMany(MealTime::class);
    }

    public function getTotalNutrients()
    {
        $totals = [
            'calories'      => 0,
            'proteins'      => 0,
            'fats'          => 0,
            'carbohydrates' => 0,
            'fibers'        => 0,
            'sodium'        => 0,
        ];

        $this->meals->load(['items.food', 'items.dish.foods']);

        foreach ($this->meals as $meal) {
            foreach ($meal->items as $item) {
                if ($item->food) {
                    foreach ($totals as $key => $value) {
                        $totals[$key] += $item->food->$key * $item->quantity;
                    }
                }

                if ($item->dish) {
                    foreach ($item->dish->foods as $food) {
                        foreach ($totals as $key => $value) {
                            $totals[$key] += $food->$key * $item->quantity;
                        }
                    }
                }
            }
        }

        return $totals;
    }


}
