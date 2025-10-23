<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    // Mass Assignment ke liye in columns ko fillable bana sakte hain
    protected $fillable = [
        'image', 'name', 'price', 'quantity', 'sku', 'status', 'short_description', 'description'
    ];

    /**
     * Product ke ProductColor relationships.
     */
    public function colors(): HasMany
    {
        return $this->hasMany(ProductColor::class);
    }

    /**
     * Product ke ProductImage relationships.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Product ke ProductTag relationships.
     */
    public function tags(): HasMany
    {
        return $this->hasMany(ProductTag::class);
    }

    /**
     * Product ke ProductReview relationships.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }
}