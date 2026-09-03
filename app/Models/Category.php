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
        'meta_title',
        'meta_description',
        'h1_heading',
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
            ->whereNull('deleted_at'); // ✅ ignore soft deleted
    }


    /*
    |--------------------------------------------------------------------------
    | SCOPES (🔥 VERY USEFUL)
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

    // Canonical is always derived from slug — never stored, never admin-editable.
    public function seoCanonicalUrl(): string
    {
        return url('/cat/' . $this->slug);
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

    // Always derived from the category image — no admin override field.
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

    // Minimal CollectionPage + Breadcrumb JSON-LD. Extend as needed per template.
    public function seoJsonLd(): array
    {
        $crumbs = [];
        $position = 1;
        $trail = [$this];
        $node = $this->parent;

        while ($node) {
            array_unshift($trail, $node);
            $node = $node->parent;
        }

        foreach ($trail as $cat) {
            $crumbs[] = [
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $cat->name,
                'item' => url('/cat/' . $cat->slug),
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'CollectionPage',
                    'name' => $this->h1_heading ?: $this->name,
                    'description' => $this->meta_description,
                    'url' => $this->seoCanonicalUrl(),
                ],
                [
                    '@type' => 'BreadcrumbList',
                    'itemListElement' => $crumbs,
                ],
            ],
        ];
    }
}