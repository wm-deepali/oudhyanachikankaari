<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftingOccasion extends Model
{
    protected $fillable = [
        'title',
        'old_id',
        'h1_heading',
        'sub_title',
        'short_description',
        'slug',
        'meta_title',
        'meta_description',
        'canonical',
        'og_title',
        'og_description',
        'meta_status',
                'og_image',
                'twitter_card',
                'twitter_title',
                'twitter_description',
                'twitter_image',
        'image',
        'image_alt',
        'icon',
        'status'
    ];

    // 🔥 Products linked
    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'occasion_product',
            'occasion_id',
            'product_id'
        );
    }

    /**
     * Resolved OG title — falls back to meta_title, then title.
     */
    public function getOgTitleResolvedAttribute()
    {
        return $this->og_title ?: ($this->meta_title ?: $this->title);
    }

    /**
     * Resolved OG description — falls back to meta_description.
     */
    public function getOgDescriptionResolvedAttribute()
    {
        return $this->og_description ?: $this->meta_description;
    }

    /**
     * Resolved image alt text — falls back to title.
     */
    public function getImageAltResolvedAttribute()
    {
        return $this->image_alt ?: $this->title;
    }

    /**
     * Resolved canonical URL — falls back to slug-based URL.
     */
    public function getCanonicalResolvedAttribute()
    {
        return $this->canonical
            ? url('/occasions/' . ltrim($this->canonical, '/'))
            : url('/occasions/' . $this->slug);
    }
}