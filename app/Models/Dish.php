<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'preparation_method',
        'status',
        'created_by',
        'updated_by'
    ];

    public function foods()
    {
        return $this->belongsToMany(Food::class)->withTimestamps();
    }

    public function meals()
    {
        return $this->belongsToMany(Meal::class)->withPivot('quantity')->withTimestamps();
    }

    public function getTotalCaloriesAttribute()
    {
        return $this->foods->sum('calories');
    }
    
}
