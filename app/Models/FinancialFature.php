<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FinancialFature extends Model
{
    use HasFactory;
    protected $table = 'financial_fatures';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'credit_card_id',
        'month',
        'year',
        'day',
        'paid',
    ];
    
    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(FinancialTransactions::class, 'financial_fatures_transactions', 'fature_id', 'transaction_id');
    }
}
