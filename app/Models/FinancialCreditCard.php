<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialCreditCard extends Model
{
    use HasFactory;
    protected $table = 'financial_credit_cards';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'limit',
        'wallet_id',
        'closing_day',
        'due_day',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];
}
