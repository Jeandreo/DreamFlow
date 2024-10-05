<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'credit_card_id',
        'category_id',
        'name',
        'hitching',
        'recurrent_id',
        'adjustment',
        'adjustment_count',
        'fature',
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

    /**
     * Get the brand associated with the user.
     */
    public function payment()
    {
        // Verifica como foi pago
        if($this->wallet_id){
            return $this->wallet;
        } elseif($this->credit_card_id) {
            return $this->credit;
        } else {
            return null;
        }

    }

    /**
     * Get the brand associated with the user.
     */
    public function credit(): HasOne
    {
        return $this->HasOne(FinancialCreditCard::class, 'id', 'credit_card_id');
    }

    /**
     * Get the brand associated with the user.
     */
    public function wallet(): HasOne
    {
        return $this->HasOne(FinancialWallet::class, 'id', 'wallet_id');
    }

    /**
     * Get the brand associated with the user.
     */
    public function category(): HasOne
    {
        return $this->HasOne(FinancialCategory::class, 'id', 'category_id');
    }

    /**
     * Get the brand associated with the user.
     */
    public function recurrent(): HasOne
    {
        return $this->HasOne(FinancialTransactionsRecurrent::class, 'transaction_id', 'id');
    }

}