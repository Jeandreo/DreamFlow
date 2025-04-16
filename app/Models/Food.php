<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'type', 'base_quantity', 'calories',
        'proteins', 'carbohydrates', 'fats', 'fiber', 'notes',
    ];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class)->withPivot('amount_used')->withTimestamps();
    }
}
