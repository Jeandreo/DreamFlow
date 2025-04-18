<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayOfWeek extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'diet_id'];

    public function diet()
    {
        return $this->belongsTo(Diet::class);
    }

    public function meals()
    {
        return $this->hasMany(MealTime::class);
    }
}
