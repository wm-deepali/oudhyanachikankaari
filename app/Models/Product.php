<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'category_id',
        'subcategory_id',

        'name',
        'slug',
        'sku',

        'short_description',
        'description',

        'base_price',

        'stock',

        'featured_image',

        'is_featured',

        'sort_order',

        'status',
    ];

    protected $casts = [

        'base_price'  => 'decimal:2',

        'is_featured' => 'boolean',

        'status'      => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function attributeValues()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}