<?php
use App\Models\SeoPage;
use App\Models\Blog;
use App\Models\Product;
use App\Models\Collection;
use App\Models\Category;
use App\Models\DynamicPage;
use App\Models\GiftingOccasion;
use App\Models\AttributeValue;
use Illuminate\Support\Str;

function getSeo()
{
    $route = optional(request()->route())->getName();

    switch ($route) {
        // Collection Page
        case 'collections.listing':
            return Collection::where(
                'slug',
                request()->route('slug')
            )->first();

        // Attribute Page — scoped by BOTH attributeSlug and valueSlug so a
        // value-slug collision across two different attributes can't
        // return the wrong record (route is /{attributeSlug}/{valueSlug}).
        case 'attribute.listing':
            return AttributeValue::whereHas('attribute', function ($q) {
                    $q->where('slug', request()->route('attributeSlug'));
                })
                ->where('slug', request()->route('valueSlug'))
                ->first();

        // Blog Detail
        case 'blog.details':
            return Blog::where(
                'slug',
                request()->route('slug')
            )->first();

        // Product Listing Page (Category/Subcategory)
case 'products.listing':
    $segments = array_values(array_filter(explode('/', trim(request()->path(), '/'))));
    array_shift($segments); // drop the leading "products" segment

    if (empty($segments)) {
        return null;
    }

    $category = null;
    foreach ($segments as $slug) {
        $query = Category::where('slug', $slug);
        $query = $category
            ? $query->where('parent_id', $category->id)
            : $query->whereNull('parent_id');
        $category = $query->first();

        if (!$category) {
            break; // no match at this depth — bad URL, fall through to null
        }
    }

    return $category;

        // Product Detail Page
        case 'product.details':
            return Product::where(
                'slug',
                request()->route('slug')
            )->first();

        // Occasion Detail Page
        case 'occasions.listing':
            return GiftingOccasion::where(
                'slug',
                request()->route('slug')
            )->first();

        // Dynamic Page
        case 'dynamic.page':
            $slug = request()->route('slug');
            return DynamicPage::get()
                ->first(function ($p) use ($slug) {
                    return Str::slug($p->page_name) === $slug;
                });

        default:
    $map = [
        'home'         => 'home',
        'categories'   => 'categories',
        'occasions'    => 'occasions',
        'cart'         => 'cart',
        'checkout'     => 'checkout',
        'about-us'     => 'about',
        'why-us'       => 'why_choose_us',
        'contact-us'   => 'contact',
        'bulk-enquiry' => 'bulk_enquiry',
        'blogs'        => 'blog',
        'faqs'         => 'faq',
    ];

    if (!isset($map[$route])) {
        // Unnamed or unmapped route — no real SEO record for this page.
        // Do NOT fall back to Home; let the caller handle "no SEO found".
        return null;
    }

    return SeoPage::where('page_key', $map[$route])->first();
    }
}