<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishFood extends Model
{
    use HasFactory;
    protected $table = 'dish_food';

    protected $fillable = [
        'dish_id',
        'food_id',
        'quantity',
    ];
}
