<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Catalog extends Model
{
    use HasFactory;
    protected $table = 'catalogs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'url',
        'color',
        'icon',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * Get the brand associated with the user.
     */
    public function items(): HasMany
    {
        return $this->HasMany(CatalogItem::class, 'catalog_id', 'id');
    }

}
