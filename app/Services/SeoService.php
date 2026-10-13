<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use App\Models\Collection;
use App\Models\GiftingOccasion;
use App\Models\Blog;
use App\Models\DynamicPage;
use App\Models\AttributeValue;

class SeoService
{
    /**
     * @param mixed $seo     Model returned by getSeo() — SeoPage, Product, Category, Collection, GiftingOccasion, Blog, DynamicPage, etc.
     * @param mixed $general Site-wide "general settings" object (site_name, tagline) — optional
     */
    public static function build($seo, $general = null): array
    {
        if (is_null($seo)) {
            // No SEO record matched this URL — genuinely unindexable page,
            // not "same as Home". Safe, honest, noindexed defaults instead
            // of borrowing another page's data.
            $canonicalUrl = url()->current();

            return [
                'metaTitle'          => $general?->site_name,
                'metaDescription'    => $general?->tagline,
                'canonicalUrl'       => $canonicalUrl,
                'ogTitle'            => $general?->site_name,
                'ogDescription'      => $general?->tagline,
                'ogImage'            => null,
                'ogUrl'              => $canonicalUrl,
                'ogType'             => 'website',
                'twitterCard'        => 'summary_large_image',
                'twitterTitle'       => $general?->site_name,
                'twitterDescription' => $general?->tagline,
                'twitterImage'       => null,
                'metaRobots'         => 'noindex, nofollow',
                'breadcrumbJsonLd'   => null,
            ];
        }

        if ($seo instanceof Product) {
            return self::buildForProduct($seo);
        }

        if ($seo instanceof Category) {
            return self::buildForCategory($seo);
        }

        if ($seo instanceof Collection) {
            return self::buildForCollection($seo);
        }

        if ($seo instanceof GiftingOccasion) {
            return self::buildForOccasion($seo);
        }

        if ($seo instanceof Blog) {
            return self::buildForBlog($seo);
        }

        if ($seo instanceof DynamicPage) {
            return self::buildForDynamicPage($seo);
        }

        if ($seo instanceof AttributeValue) {
            return self::buildForAttributeValue($seo);
        }

        // Fallback: plain-column models (SeoPage, etc.)
        $metaTitle       = $seo->meta_title ?? null;
        $metaDescription = $seo->meta_description ?? null;
        // AttributeValue/Occasion/Collection all store this as `canonical`,
        // not `canonical_url` — check both so nothing silently falls back
        // to the current URL when a real canonical is actually stored.
        $canonicalUrl    = $seo->canonical ?? $seo->canonical_url ?? url()->current();

        $ogTitle       = $seo->og_title ?? $metaTitle ?? $general?->site_name;
        $ogDescription = $seo->og_description ?? $metaDescription ?? $general?->tagline;
        $ogImage       = $seo->og_image ?? null;
        $ogUrl         = $seo->og_url ?? $canonicalUrl;

        $twitterCard        = $seo->twitter_card ?? 'summary_large_image';
        $twitterTitle       = $seo->twitter_title ?? $ogTitle;
        $twitterDescription = $seo->twitter_description ?? $ogDescription;
        $twitterImage       = $seo->twitter_image ?? $ogImage;

        return [
            'metaTitle'          => $metaTitle,
            'metaDescription'    => $metaDescription,
            'canonicalUrl'       => $canonicalUrl,
            'ogTitle'            => $ogTitle,
            'ogDescription'      => $ogDescription,
            'ogImage'            => $ogImage,
            'ogUrl'              => $ogUrl,
            'ogType'             => 'website',
            'twitterCard'        => $twitterCard,
            'twitterTitle'       => $twitterTitle,
            'twitterDescription' => $twitterDescription,
            'twitterImage'       => $twitterImage,
            'metaRobots'         => self::resolveRobots($seo),
            // Fallback pages (Home, Cart, Checkout, static pages, etc.)
            // just get "Home > Page Name" — nothing deeper to walk.
            'breadcrumbJsonLd'   => self::breadcrumbJsonLd([
                ['name' => 'Home', 'url' => route('home')],
                ['name' => $metaTitle ?: ($general?->site_name ?: 'Page'), 'url' => $canonicalUrl],
            ]),
        ];
    }

    /**
     * ------------------------------------------------------------------
     * Robots directive
     * ------------------------------------------------------------------
     * Converts the stored meta_status enum into the literal
     * <meta name="robots"> content string.
     *
     * STRICT MODE: only an explicit 'index_follow' yields "index, follow".
     * Anything else — 'noindex_unfollow', null, missing column, or an
     * unrecognized value — falls through to "noindex, nofollow".
     */
    private static function resolveRobots($seo): string
    {
        $status = $seo->meta_status ?? null;

        return $status === 'index_follow'
            ? 'index, follow'
            : 'noindex, nofollow';
    }

    /**
     * ------------------------------------------------------------------
     * Pagination-aware canonical / rel=prev / rel=next
     * ------------------------------------------------------------------
     * Shared by every listing-type page — Category, Collection, Occasion,
     * AttributeValue — since collections.listing, attribute.listing,
     * products.listing, and occasions.listing all render the same
     * paginated products-grid template.
     *
     * Appends the current page's `page` query param to a base canonical
     * URL so each paginated page self-canonicalizes instead of every
     * page pointing at page 1. Sort/filter query params are deliberately
     * NOT carried into the canonical, so they never get treated as
     * distinct indexable URLs.
     */
    private static function withPagination(string $baseUrl): string
    {
        $page = (int) request()->query('page', 1);

        if ($page <= 1) {
            return $baseUrl;
        }

        $separator = str_contains($baseUrl, '?') ? '&' : '?';

        return $baseUrl . $separator . 'page=' . $page;
    }

    /**
     * Builds rel=prev / rel=next targets for the current paginated
     * listing. $lastPage should be passed in from the controller (e.g.
     * $products->lastPage()) via request()->attributes, since this
     * service has no direct access to the paginator instance. Returns
     * null for prev/next when there's no such page, so the blade can
     * conditionally skip rendering those <link> tags.
     */
    private static function paginationLinks(string $baseUrl): array
    {
        $page     = (int) request()->query('page', 1);
        $lastPage = (int) (request()->attributes->get('seo_last_page') ?? 0);

        $build = fn (int $p) => $p <= 1
            ? $baseUrl
            : $baseUrl . (str_contains($baseUrl, '?') ? '&' : '?') . 'page=' . $p;

        return [
            'prev' => $page > 1 ? $build($page - 1) : null,
            'next' => ($lastPage && $page < $lastPage) ? $build($page + 1) : null,
        ];
    }

    /**
     * ------------------------------------------------------------------
     * BreadcrumbList JSON-LD
     * ------------------------------------------------------------------
     * $items = [ ['name' => 'Home', 'url' => 'https://...'], ['name' => 'Sarees', 'url' => '...'], ... ]
     * in trail order (Home first, current page last). Every item gets a
     * position + item URL — including the last one, which is harmless per
     * spec and keeps things consistent, rather than omitting it.
     *
     * Returns null (not an empty array) when there's nothing meaningful
     * to build, so the blade layer can skip rendering the <script> tag
     * entirely instead of printing an empty ItemList.
     */
    private static function breadcrumbJsonLd(array $items): ?array
    {
        $items = array_values(array_filter($items, function ($item) {
            return !empty($item['name']);
        }));

        if (count($items) < 2) {
            // A single-crumb trail ("Home" only) isn't a breadcrumb worth
            // emitting — Google Search Console flags these as low-value.
            return null;
        }

        $listElements = [];

        foreach ($items as $index => $item) {
            $listElements[] = [
                '@type'    => 'ListItem',
                'position' => $index + 1,
                'name'     => $item['name'],
                'item'     => $item['url'] ?? null,
            ];
        }

        return [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $listElements,
        ];
    }

    /**
     * ------------------------------------------------------------------
     * Categories / Sub Categories / Sub Sub Categories
     * Form inputs: Meta Title, Meta Description, H1 Heading.
     * Editable-with-autofill: OG Title/Description/Image, Image Alt.
     * Backend-only, never on form: Canonical (slug-derived), Twitter Card
     * (and Twitter Title/Description, which mirror OG — Category has no
     * dedicated twitter_title/twitter_description/twitter_image columns).
     *
     * PAGINATION: products.listing is a paginated grid — canonical/OG url
     * carry the current `page` param so each page self-canonicalizes, and
     * paginationLinks gives the blade rel=prev/rel=next targets.
     * ------------------------------------------------------------------
     */
    private static function buildForCategory(Category $category): array
    {
        $metaTitle       = $category->meta_title ?: $category->name;
        $metaDescription = $category->meta_description ?: null;
        $baseCanonical   = $category->seoCanonicalUrl();
        $canonicalUrl    = self::withPagination($baseCanonical);

        $ogTitle       = $category->seoOgTitle() ?: $metaTitle;
        $ogDescription = $category->seoOgDescription() ?: $metaDescription;
        $ogImage       = $category->seoOgImage();

        return [
            'metaTitle'          => $metaTitle,
            'metaDescription'    => $metaDescription,
            'h1'                 => $category->h1_heading ?: $category->name,
            'canonicalUrl'       => $canonicalUrl,
            'ogTitle'            => $ogTitle,
            'ogDescription'      => $ogDescription,
            'ogImage'            => $ogImage,
            'ogUrl'              => $canonicalUrl,
            'ogType'             => 'website',
            'twitterCard'        => $category->seoTwitterCard(),
            'twitterTitle'       => $ogTitle,
            'twitterDescription' => $ogDescription,
            'twitterImage'       => $ogImage,
            'imageAlt'           => $category->seoImageAlt(),
            'jsonLd'             => $category->seoJsonLd(),
            'metaRobots'         => self::resolveRobots($category),
            'breadcrumbJsonLd'   => self::breadcrumbForCategory($category),
            'paginationLinks'    => self::paginationLinks($baseCanonical),
        ];
    }

    /**
     * Walks Home > [Parent Category] > This Category. Supports the
     * two-level depth used across the app (parent category → subcategory)
     * without hardcoding a fixed number of levels, in case a third level
     * is ever introduced.
     */
    private static function breadcrumbForCategory(Category $category): ?array
    {
        $trail = [];
        $chain = [];

        $node = $category;
        while ($node) {
            $chain[] = $node;
            $node = $node->parent ?? null;
        }

        $chain = array_reverse($chain);

        $trail[] = ['name' => 'Home', 'url' => route('home')];

        $slugPath = [];
        foreach ($chain as $node) {
            $slugPath[] = $node->slug;
            $trail[] = [
                'name' => $node->name,
                'url'  => route('products.listing', $slugPath),
            ];
        }

        return self::breadcrumbJsonLd($trail);
    }

    /**
     * ------------------------------------------------------------------
     * Occasions & Collections — spec says "follow same as Categories":
     * Meta, OG, Twitter, H1, Canonical all admin-editable-with-autofill,
     * same shape as Category. Unlike Category, both models DO carry their
     * own twitter_card/twitter_title/twitter_description/twitter_image
     * columns, so those are read directly rather than mirroring OG.
     *
     * PAGINATION: collections.listing renders the same paginated products
     * grid as products.listing, so the same withPagination/paginationLinks
     * treatment applies here.
     * ------------------------------------------------------------------
     */
    private static function buildForCollection(Collection $collection): array
    {
        $metaTitle       = $collection->meta_title ?: $collection->name;
        $metaDescription = $collection->meta_description ?: null;
        $baseCanonical   = $collection->canonical_resolved;
        $canonicalUrl    = self::withPagination($baseCanonical);

        $ogTitle       = $collection->og_title_resolved;
        $ogDescription = $collection->og_description_resolved;
        $ogImage       = $collection->image ? asset('storage/' . $collection->image) : null;

        $twitterCard        = $collection->twitter_card ?: 'summary_large_image';
        $twitterTitle       = $collection->twitter_title ?: $ogTitle;
        $twitterDescription = $collection->twitter_description ?: $ogDescription;
        $twitterImage       = $collection->twitter_image ? asset('storage/' . $collection->twitter_image) : $ogImage;

        return [
            'metaTitle'          => $metaTitle,
            'metaDescription'    => $metaDescription,
            'h1'                 => $collection->h1_heading ?: $collection->name,
            'canonicalUrl'       => $canonicalUrl,
            'ogTitle'            => $ogTitle,
            'ogDescription'      => $ogDescription,
            'ogImage'            => $ogImage,
            'ogUrl'              => $canonicalUrl,
            'ogType'             => 'website',
            'twitterCard'        => $twitterCard,
            'twitterTitle'       => $twitterTitle,
            'twitterDescription' => $twitterDescription,
            'twitterImage'       => $twitterImage,
            'imageAlt'           => $collection->image_alt_resolved,
            'jsonLd'             => self::genericJsonLd(
                'CollectionPage',
                $collection->h1_heading ?: $collection->name,
                $metaDescription,
                $canonicalUrl
            ),
            'metaRobots'         => self::resolveRobots($collection),
            'breadcrumbJsonLd'   => self::breadcrumbJsonLd([
                ['name' => 'Home', 'url' => route('home')],
                ['name' => $collection->name, 'url' => $baseCanonical],
            ]),
            'paginationLinks'    => self::paginationLinks($baseCanonical),
        ];
    }

    /**
     * PAGINATION: occasions.listing renders the same paginated products
     * grid as products.listing, so the same treatment applies here too.
     */
    private static function buildForOccasion(GiftingOccasion $occasion): array
    {
        $metaTitle       = $occasion->meta_title ?: $occasion->title;
        $metaDescription = $occasion->meta_description ?: null;
        $baseCanonical   = $occasion->canonical_resolved;
        $canonicalUrl    = self::withPagination($baseCanonical);

        $ogTitle       = $occasion->og_title_resolved;
        $ogDescription = $occasion->og_description_resolved;
        $ogImage       = $occasion->image ? asset('storage/' . $occasion->image) : null;

        $twitterCard        = $occasion->twitter_card ?: 'summary_large_image';
        $twitterTitle       = $occasion->twitter_title ?: $ogTitle;
        $twitterDescription = $occasion->twitter_description ?: $ogDescription;
        $twitterImage       = $occasion->twitter_image ? asset('storage/' . $occasion->twitter_image) : $ogImage;

        return [
            'metaTitle'          => $metaTitle,
            'metaDescription'    => $metaDescription,
            'h1'                 => $occasion->h1_heading ?: $occasion->title,
            'canonicalUrl'       => $canonicalUrl,
            'ogTitle'            => $ogTitle,
            'ogDescription'      => $ogDescription,
            'ogImage'            => $ogImage,
            'ogUrl'              => $canonicalUrl,
            'ogType'             => 'website',
            'twitterCard'        => $twitterCard,
            'twitterTitle'       => $twitterTitle,
            'twitterDescription' => $twitterDescription,
            'twitterImage'       => $twitterImage,
            'imageAlt'           => $occasion->image_alt_resolved,
            'jsonLd'             => self::genericJsonLd(
                'CollectionPage',
                $occasion->h1_heading ?: $occasion->title,
                $metaDescription,
                $canonicalUrl
            ),
            'metaRobots'         => self::resolveRobots($occasion),
            'breadcrumbJsonLd'   => self::breadcrumbJsonLd([
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'Occasions', 'url' => route('occasions')],
                ['name' => $occasion->title, 'url' => $baseCanonical],
            ]),
            'paginationLinks'    => self::paginationLinks($baseCanonical),
        ];
    }

    /**
     * ------------------------------------------------------------------
     * Products (Product Detail Page — NOT paginated, no pagination
     * handling needed here).
     * Form inputs: Meta Title, Meta Description ONLY.
     * H1 auto-set from product name (not a form field per your spec).
     * Canonical: fully backend (current URL — Product has no canonical
     * column). OG/Twitter fields are backend-populated (not on the form)
     * but ARE real columns on Product (og_title, og_description, og_image,
     * twitter_card, twitter_title, twitter_description, twitter_image).
     * ------------------------------------------------------------------
     */
    private static function buildForProduct(Product $product): array
    {
        $metaTitle       = $product->meta_title ?: $product->name;
        $metaDescription = $product->meta_description ?: null;
        $canonicalUrl    = url()->current();

        // $product->display_image already returns a full asset() URL — do not re-wrap it.
        $defaultImage = $product->display_image ?: null;

        $ogTitle       = $product->og_title ?: $metaTitle;
        $ogDescription = $product->og_description ?: $metaDescription;
        $ogImage       = $product->og_image ? asset('storage/' . $product->og_image) : $defaultImage;

        $twitterCard        = $product->twitter_card ?: 'summary_large_image';
        $twitterTitle       = $product->twitter_title ?: $ogTitle;
        $twitterDescription = $product->twitter_description ?: $ogDescription;
        $twitterImage       = $product->twitter_image ? asset('storage/' . $product->twitter_image) : $ogImage;

        return [
            'metaTitle'          => $metaTitle,
            'metaDescription'    => $metaDescription,
            'h1'                 => $product->h1_heading ?: $product->name,
            'canonicalUrl'       => $canonicalUrl,
            'ogTitle'            => $ogTitle,
            'ogDescription'      => $ogDescription,
            'ogImage'            => $ogImage,
            'ogUrl'              => $canonicalUrl,
            'ogType'             => 'product',
            'twitterCard'        => $twitterCard,
            'twitterTitle'       => $twitterTitle,
            'twitterDescription' => $twitterDescription,
            'twitterImage'       => $twitterImage,
            'imageAlt'           => $product->name,
            'jsonLd'             => self::productJsonLd($product, $metaTitle, $metaDescription, $canonicalUrl, $ogImage),
            'metaRobots'         => self::resolveRobots($product),
            'breadcrumbJsonLd'   => self::breadcrumbForProduct($product, $canonicalUrl),
        ];
    }

    /**
     * Home > Category > Subcategory (if any) > Product Name.
     * Category/Subcategory are read straight off the product's own
     * relations (category_id / subcategory_id) rather than re-deriving
     * from the URL, so this works regardless of which route led here.
     */
    private static function breadcrumbForProduct(Product $product, string $productUrl): ?array
    {
        $trail = [
            ['name' => 'Home', 'url' => route('home')],
        ];

        $slugPath = [];

        if ($product->category) {
            $slugPath[] = $product->category->slug;
            $trail[] = [
                'name' => $product->category->name,
                'url'  => route('products.listing', $slugPath),
            ];
        }

        if ($product->subcategory) {
            $slugPath[] = $product->subcategory->slug;
            $trail[] = [
                'name' => $product->subcategory->name,
                'url'  => route('products.listing', $slugPath),
            ];
        }

        $trail[] = ['name' => $product->name, 'url' => $productUrl];

        return self::breadcrumbJsonLd($trail);
    }

    /**
     * ------------------------------------------------------------------
     * Dynamic Pages / Blogs
     * Form inputs: Meta Title, Meta Description, H1 ONLY.
     * Canonical, OG, Twitter Card, Image Alt: fully backend.
     *
     * ASSUMPTION (confirm against actual DynamicPage/Blog columns): both
     * expose meta_title, meta_description, h1_heading, slug, and an
     * optional `image` column for OG image / alt text, with no dedicated
     * twitter_* columns, so Twitter title/description here mirror OG.
     * ------------------------------------------------------------------
     */
    private static function buildForDynamicPage(DynamicPage $page): array
    {
        $metaTitle       = $page->meta_title ?: $page->heading ?? $page->page_name;
        $metaDescription = $page->meta_description ?: null;
        $canonicalUrl    = url('/page/' . \Illuminate\Support\Str::slug($page->page_name));

        $ogImage = !empty($page->image) ? asset('storage/' . $page->image) : null;

        return [
            'metaTitle'          => $metaTitle,
            'metaDescription'    => $metaDescription,
            'h1'                 => $page->h1_heading ?: $metaTitle,
            'canonicalUrl'       => $canonicalUrl,
            'ogTitle'            => $metaTitle,
            'ogDescription'      => $metaDescription,
            'ogImage'            => $ogImage,
            'ogUrl'              => $canonicalUrl,
            'ogType'             => 'website',
            'twitterCard'        => 'summary_large_image',
            'twitterTitle'       => $metaTitle,
            'twitterDescription' => $metaDescription,
            'twitterImage'       => $ogImage,
            'imageAlt'           => $page->h1_heading ?: $metaTitle,
            'jsonLd'             => self::genericJsonLd('WebPage', $page->h1_heading ?: $metaTitle, $metaDescription, $canonicalUrl),
            'metaRobots'         => self::resolveRobots($page),
            'breadcrumbJsonLd'   => self::breadcrumbJsonLd([
                ['name' => 'Home', 'url' => route('home')],
                ['name' => $page->h1_heading ?: $metaTitle, 'url' => $canonicalUrl],
            ]),
        ];
    }

    private static function buildForBlog(Blog $blog): array
    {
        $metaTitle       = $blog->meta_title ?: $blog->title;
        $metaDescription = $blog->meta_description ?: null;
        $canonicalUrl    = url('/blog/' . $blog->slug);

        $ogImage = !empty($blog->image) ? asset('storage/' . $blog->image) : null;

        return [
            'metaTitle'          => $metaTitle,
            'metaDescription'    => $metaDescription,
            'h1'                 => $blog->h1_heading ?: $blog->title,
            'canonicalUrl'       => $canonicalUrl,
            'ogTitle'            => $metaTitle,
            'ogDescription'      => $metaDescription,
            'ogImage'            => $ogImage,
            'ogUrl'              => $canonicalUrl,
            'ogType'             => 'article',
            'twitterCard'        => 'summary_large_image',
            'twitterTitle'       => $metaTitle,
            'twitterDescription' => $metaDescription,
            'twitterImage'       => $ogImage,
            'imageAlt'           => $blog->h1_heading ?: $blog->title,
            'jsonLd'             => self::genericJsonLd('Article', $blog->h1_heading ?: $blog->title, $metaDescription, $canonicalUrl, $ogImage),
            'metaRobots'         => self::resolveRobots($blog),
            'breadcrumbJsonLd'   => self::breadcrumbJsonLd([
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'Blog', 'url' => route('blogs.index')],
                ['name' => $blog->h1_heading ?: $blog->title, 'url' => $canonicalUrl],
            ]),
        ];
    }

    /**
     * ------------------------------------------------------------------
     * Attribute Values (e.g. Color: Red, Size: XL — used for
     * attribute.listing route: /{attributeSlug}/{valueSlug})
     * Same editable-with-autofill shape as Category: Meta Title/Description,
     * OG Title/Description/Image, Twitter fields, Canonical — all stored
     * directly on the model.
     *
     * PAGINATION: attribute.listing renders the same paginated products
     * grid as products.listing, so the same treatment applies here too.
     * ------------------------------------------------------------------
     */
    private static function buildForAttributeValue(AttributeValue $attributeValue): array
    {
        $metaTitle       = $attributeValue->meta_title ?: $attributeValue->value;
        $metaDescription = $attributeValue->meta_description ?: null;

        $baseCanonical = $attributeValue->canonical
            ? url(ltrim($attributeValue->canonical, '/'))
            : route('attribute.listing', [
                'attributeSlug' => $attributeValue->attribute?->slug,
                'valueSlug'     => $attributeValue->slug,
            ]);
        $canonicalUrl = self::withPagination($baseCanonical);

        $ogTitle       = $attributeValue->og_title ?: $metaTitle;
        $ogDescription = $attributeValue->og_description ?: $metaDescription;
        $ogImage       = $attributeValue->og_image
            ? asset('storage/' . $attributeValue->og_image)
            : ($attributeValue->image ? asset('storage/' . $attributeValue->image) : null);

        $twitterCard        = $attributeValue->twitter_card ?: 'summary_large_image';
        $twitterTitle       = $attributeValue->twitter_title ?: $ogTitle;
        $twitterDescription = $attributeValue->twitter_description ?: $ogDescription;
        $twitterImage       = $attributeValue->twitter_image
            ? asset('storage/' . $attributeValue->twitter_image)
            : $ogImage;

        return [
            'metaTitle'          => $metaTitle,
            'metaDescription'    => $metaDescription,
            'h1'                 => $attributeValue->value,
            'canonicalUrl'       => $canonicalUrl,
            'ogTitle'            => $ogTitle,
            'ogDescription'      => $ogDescription,
            'ogImage'            => $ogImage,
            'ogUrl'              => $canonicalUrl,
            'ogType'             => 'website',
            'twitterCard'        => $twitterCard,
            'twitterTitle'       => $twitterTitle,
            'twitterDescription' => $twitterDescription,
            'twitterImage'       => $twitterImage,
            'imageAlt'           => $attributeValue->value,
            'jsonLd'             => self::genericJsonLd(
                'CollectionPage',
                $attributeValue->value,
                $metaDescription,
                $canonicalUrl,
                $ogImage
            ),
            'metaRobots'         => self::resolveRobots($attributeValue),
            'breadcrumbJsonLd'   => self::breadcrumbJsonLd([
                ['name' => 'Home', 'url' => route('home')],
                ['name' => $attributeValue->attribute?->name ?: 'Shop', 'url' => null],
                ['name' => $attributeValue->value, 'url' => $baseCanonical],
            ]),
            'paginationLinks'    => self::paginationLinks($baseCanonical),
        ];
    }

    /**
     * ------------------------------------------------------------------
     * JSON-LD helpers
     * ------------------------------------------------------------------
     */

    /**
     * Product schema — includes:
     *   - sku            → falls back to Product Code, per spec; if
     *                       product_code is empty, falls back to sku.
     *   - brand          → hardcoded "Oudhyaana" (site brand).
     *   - offers.availability → driven by the SAME effective stock
     *                       calculation the product detail page uses.
     */
    private static function productJsonLd(Product $product, $title, $description, $url, $image): array
    {
        $effectiveStock = self::resolveEffectiveStock($product);

        return [
            '@context'    => 'https://schema.org',
            '@type'       => 'Product',
            'name'        => $product->name,
            'description' => $description,
            'image'       => $image ? [$image] : [],
            'sku'         => $product->product_code ?: $product->sku,
            'brand'       => [
                '@type' => 'Brand',
                'name'  => 'Oudhyaana',
            ],
            'url'         => $url,
            'offers'      => [
                '@type'         => 'Offer',
                'url'           => $url,
                'priceCurrency' => 'INR',
                'price'         => (string) $product->price,
                'availability'  => $effectiveStock > 0
                    ? 'https://schema.org/InStock'
                    : 'https://schema.org/OutOfStock',
            ],
        ];
    }

    /**
     * Mirrors the product detail blade's $detailStock logic exactly:
     * if the product has stock-type variants, their summed stock is the
     * source of truth (the base `stock` column can go stale relative to
     * variants); otherwise falls back to the base column.
     */
    private static function resolveEffectiveStock(Product $product): int
    {
        $stockVariants = $product->variants->where('type', 'stock');

        return $stockVariants->count()
            ? (int) $stockVariants->sum('stock')
            : (int) $product->stock;
    }

    private static function genericJsonLd(string $type, ?string $name, ?string $description, string $url, ?string $image = null): array
    {
        $data = [
            '@context'    => 'https://schema.org',
            '@type'       => $type,
            'name'        => $name,
            'description' => $description,
            'url'         => $url,
        ];

        if ($image) {
            $data['image'] = $image;
        }

        return $data;
    }
}