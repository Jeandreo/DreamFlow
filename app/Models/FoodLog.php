<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodLog extends Model
{
    use HasFactory;

    protected $table = 'food_logs';

    protected $fillable = [
        'diet_id',
        'meal_time_id',
        'food_id',
        'date',
        'eaten',
        'planned',
    ];
}