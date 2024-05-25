<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTransactions extends Model
{
    use HasFactory;
    protected $table = 'financial_wallets';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'url',
        'color',
        'icon',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];
}
