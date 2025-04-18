<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'goal', 'total_calories'];

    public function meals()
    {
        return $this->hasMany(MealTime::class);
    }

}
