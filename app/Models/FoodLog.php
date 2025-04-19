<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodLog extends Model
{
    use HasFactory;

    protected $table = 'food_logs';

    protected $fillable = [
        'food_id',
        'date',
        'eaten',
        'planned',
    ];
}