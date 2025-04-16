<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class)->withPivot('quantity')->withTimestamps();
    }

    public function diets()
    {
        return $this->belongsToMany(Diet::class)->withPivot('time', 'day_of_week')->withTimestamps();
    }
}
