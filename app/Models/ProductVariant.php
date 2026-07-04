<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    // type: 'price' | 'image' | 'stock' | 'sku'
    // Each row belongs to exactly one dependency type — it only carries
    // the field(s) relevant to that type. This lets a product have, say,
    // an independent Image-variant table (built from Colour only) and a
    // separate Price-variant table (built from Colour + Size combined).
    const TYPE_PRICE = 'price';
    const TYPE_IMAGE = 'image';
    const TYPE_STOCK = 'stock';
    const TYPE_SKU = 'sku';

    protected $fillable = [
        'product_id',
        'type',

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

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }
}