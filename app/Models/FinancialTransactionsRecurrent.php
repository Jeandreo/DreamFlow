<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FinancialTransactionsRecurrent extends Model
{
    use HasFactory;
    protected $table = 'financial_transactions_recurrents';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'transaction_id',
        'start',
        'end',
        'status',
    ];

    /**
     * Get the brand associated with the user.
     */
    public function transaction(): HasOne
    {
        return $this->HasOne(FinancialTransactions::class, 'id', 'transaction_id');
    }
}