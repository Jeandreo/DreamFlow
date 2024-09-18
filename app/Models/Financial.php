<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financial extends Model
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
        'credit_card_id',
        'category_id',
        'name',
        'hitching',
        'recurrent',
        'recurrent_begin',
        'adjustment',
        'adjustment_count',
        'fature',
        'fature_id',
        'value',
        'value_paid',
        'date_purchase',
        'date_payment',
        'date_paid',
        'paid',
        'fees',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];
}
