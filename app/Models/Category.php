<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'sub_title',
        'description',
        'meta_title',
        'meta_description',
        'h1_heading',
        'meta_status',
        'og_title',
        'og_description',
        'og_image',
        'image',
        'size_chart_image',
        'sort_order',

        'is_popular',
        'status',

        'added_by',
        'is_featured',
        'show_in_navbar',
        'is_sub_category',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // Parent
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Children
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->whereNull('deleted_at'); // âœ… ignore soft deleted
    }


    /*
    |--------------------------------------------------------------------------
    | SCOPES (ðŸ”¥ VERY USEFUL)
    |--------------------------------------------------------------------------
    */

    // Only active
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Only parent categories
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    // Only subcategories
    public function scopeSubCategories($query)
    {
        return $query->whereNotNull('parent_id');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS (CLEAN UI)
    |--------------------------------------------------------------------------
    */

    public function getIsParentAttribute()
    {
        return is_null($this->parent_id);
    }

    public function getIsChildAttribute()
    {
        return !is_null($this->parent_id);
    }

    public function categoryAttributes()
    {
        return $this->hasMany(CategoryAttribute::class);
    }

    // Products directly under category
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    // Products where this category is selected as subcategory
    public function subCategoryProducts()
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SEO HELPERS
    |--------------------------------------------------------------------------
    | Centralised fallback logic so the frontend <head> partial can just call
    | these instead of repeating "og_title ?: meta_title" everywhere.
    */
public function seoCanonicalUrl(): string
{
    return url('/products/' . implode('/', $this->slugPath()));
}

// Root-to-self slugs, e.g. ['men', 'kurtas', 'chikankari-kurtas'].
private function slugPath(): array
{
    $path = [$this->slug];
    $node = $this->parent;

    while ($node) {
        array_unshift($path, $node->slug);
        $node = $node->parent;
    }

    return $path;
}

    // Admin-editable for categories; falls back to Meta Title if left blank.
    public function seoOgTitle(): ?string
    {
        return $this->og_title ?: $this->meta_title;
    }

    // Admin-editable for categories; falls back to Meta Description if left blank.
    public function seoOgDescription(): ?string
    {
        return $this->og_description ?: $this->meta_description;
    }

    // Always derived from the category image â€” no admin override field.
    // Falls back to the category image when no override is uploaded.
    public function seoOgImage(): ?string
    {
        $source = $this->og_image ?: $this->image;

        return $source ? asset('storage/' . $source) : null;
    }
    // Backend-only, same on every page type.
    public function seoTwitterCard(): string
    {
        return 'summary_large_image';
    }

    // Backend-only default per spec: category name as the alt text.
    public function seoImageAlt(): string
    {
        return $this->name;
    }

    /**
     * CollectionPage JSON-LD ONLY — the BreadcrumbList schema is NOT
     * generated here anymore. It's handled centrally by
     * SeoService::breadcrumbForCategory(), which builds the exact same
     * "Home > Parent > This Category" trail and is what the blade layer
     * actually reads via $seoData['breadcrumbJsonLd']. Keeping it here
     * too was producing TWO separate BreadcrumbList schemas on the same
     * page (one nested in this @graph, one from SeoService) — search
     * engines don't like duplicate/competing breadcrumb schemas, so this
     * method now only owns the CollectionPage part.
     */
    public function seoJsonLd(): array
    {
        return [
            '@context'    => 'https://schema.org',
            '@type'       => 'CollectionPage',
            'name'        => $this->h1_heading ?: $this->name,
            'description' => $this->meta_description,
            'url'         => $this->seoCanonicalUrl(),
        ];
    }
}