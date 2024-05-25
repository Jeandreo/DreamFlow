<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FinancialWallet extends Model
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
        'institution_id',
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
}