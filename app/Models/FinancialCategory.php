<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FinancialCategory extends Model
{
    use HasFactory;
    protected $table = 'financial_categories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'type',
        'color',
        'icon',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * Get the brand associated with the user.
     */
    public function childrens(): HasMany
    {
        return $this->hasMany(FinancialCategory::class, 'category_id', 'id');
    }

    /**
     * Get the brand associated with the user.
     */
    public function father(): HasOne
    {
        return $this->hasOne(FinancialCategory::class, 'id', 'category_id');
    }
}
