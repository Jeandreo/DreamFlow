<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'last_numbers',
        'closing_day',
        'due_day',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * Get the brand associated with the user.
     */
    public function institution(): HasOne
    {
        return $this->HasOne(FinancialInstitution::class, 'id', 'institution_id');
    }

    /**
     * Get the brand associated with the user.
     */
    public function transactions(): HasMany
    {
        return $this->HasMany(FinancialTransactions::class, 'credit_card_id', 'id');
    }

    /**
     * Calculate the total value of the wallet.
     *
     * @return float
     */
    public function total(): float
    {
        return $this->transactions()->where('paid', true)->sum('value');
    }

}
