<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'preparation_method'];

    public function foods()
    {
        return $this->belongsToMany(Food::class)->withPivot('amount_used')->withTimestamps();
    }

    public function meals()
    {
        return $this->belongsToMany(Meal::class)->withPivot('quantity')->withTimestamps();
    }
    
}
