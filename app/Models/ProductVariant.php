<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [

        'product_id',

        'sku',

        'mrp',
        'discount_type',
        'discount',
        'price',

        'stock',

        'image',

        'status',

    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function values()
    {
        return $this->hasMany(ProductVariantValue::class, 'variant_id');
    }

    public function cartItems()
    {
        return $this->hasMany(
            CartItem::class,
            'variant_id'
        );
    }
}