<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'type',
        'quantity',
        'calories',
        'proteins',
        'carbohydrates',
        'fats',
        'fibers',
        'sodium',
        'notes',
        'status',
        'created_by',
        'updated_by'
    ];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class)->withTimestamps();
    }
}
