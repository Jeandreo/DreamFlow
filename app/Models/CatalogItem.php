<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CatalogItem extends Model
{
    use HasFactory;
    protected $table = 'catalog_items';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'catalog_id',
        'name',
        'url',
        'link_video',
        'link_blog',
        'content',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * Get the brand associated with the user.
     */
    public function catalog(): HasOne
    {
        return $this->HasOne(Catalog::class, 'id', 'catalog_id');
    }
}