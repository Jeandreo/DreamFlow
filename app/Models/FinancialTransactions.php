<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTransactions extends Model
{
    use HasFactory;
    protected $table = 'financial_transactions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'wallet_id',
        'category_id',
        'name',
        'hitching',
        'recurrent',
        'value',
        'value_paid',
        'date_venciment',
        'date_payment',
        'paid',
        'fees',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];
}