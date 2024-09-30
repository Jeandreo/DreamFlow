<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialFaturesTransaction extends Model
{
    use HasFactory;
    protected $table = 'financial_fatures_transactions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'transaction_id',
        'fature_id',
    ];

    public function fature()
    {
        return $this->belongsTo(FinancialFature::class, 'fature_id');
    }
}
