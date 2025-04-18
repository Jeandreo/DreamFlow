<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealTime extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'diet_id',
        'day_of_week',
        'status',
        'created_by',
        'updated_by'
    ];
    
}
