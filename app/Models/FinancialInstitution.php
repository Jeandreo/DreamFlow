<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialInstitution extends Model
{
    use HasFactory;
    protected $table = 'financial_institutions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'status',
        'created_by',
        'updated_by',
    ];
}
