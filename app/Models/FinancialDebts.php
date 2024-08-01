<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialDebts extends Model
{
    use HasFactory;
    protected $table = 'financial_debts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'value',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];
}
