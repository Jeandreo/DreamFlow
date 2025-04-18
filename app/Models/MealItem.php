<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealItem extends Model
{
    use HasFactory;
    protected $table = 'meals_items';

    protected $fillable = [
        'meal_id',
        'day_of_week',
        'meal_time_id',
        'food_id',
        'dish_id',
        'quantity'
    ];

    public function diet()
    {
        return $this->belongsTo(Diet::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}
