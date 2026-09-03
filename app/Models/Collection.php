<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'h1_heading',
        'image',
        'image_alt',
        'meta_title',
        'meta_description',
        'canonical',
        'og_title',
        'og_description',
        'code',
        'status',
        'sort_order',
    ];

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'collection_product',
            'collection_id',
            'product_id'
        );
    }

    /**
     * Resolved OG title — falls back to meta_title, then name.
     */
    public function getOgTitleResolvedAttribute()
    {
        return $this->og_title ?: ($this->meta_title ?: $this->name);
    }

    /**
     * Resolved OG description — falls back to meta_description.
     */
    public function getOgDescriptionResolvedAttribute()
    {
        return $this->og_description ?: $this->meta_description;
    }

    /**
     * Resolved image alt text — falls back to name.
     */
    public function getImageAltResolvedAttribute()
    {
        return $this->image_alt ?: $this->name;
    }

    /**
     * Resolved canonical URL — falls back to slug-based URL.
     */
    public function getCanonicalResolvedAttribute()
    {
        return $this->canonical
            ? url('/collection/' . ltrim($this->canonical, '/'))
            : url('/collection/' . $this->slug);
    }
}