<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryAttribute extends Model
{
    protected $fillable = [
        'category_id',
        'attribute_id',

        'is_required',

        'used_for_variant',

        'show_in_filter',
        'show_on_listing',

        'sort_order',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function values()
    {
        return $this->attribute->values();
    }
}