<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 

class ProductColor extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'color_name', 'color_code'];

    public function product(): BelongsTo 
    {
        return $this->belongsTo(Product::class);
    }



}