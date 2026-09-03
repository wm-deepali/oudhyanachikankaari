<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use App\Models\Collection;
use App\Models\GiftingOccasion;
use App\Models\Blog;
use App\Models\DynamicPage;

class SeoService
{
    /**
     * @param mixed $seo     Model returned by getSeo() — SeoPage, Product, Category, Collection, GiftingOccasion, Blog, DynamicPage, etc.
     * @param mixed $general Site-wide "general settings" object (site_name, tagline) — optional
     */
    public static function build($seo, $general = null): array
    {
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

        // Fallback: plain-column models (SeoPage, AttributeValue, etc.)
        $metaTitle       = $seo->meta_title ?? null;
        $metaDescription = $seo->meta_description ?? null;
        $canonicalUrl    = $seo->canonical_url ?? url()->current();

        $ogTitle       = $seo->og_title ?? $metaTitle ?? $general?->site_name;
        $ogDescription = $seo->og_description ?? $metaDescription ?? $general?->tagline;
        $ogImage       = $seo->og_image ?? null;
        $ogUrl         = $seo->og_url ?? $canonicalUrl;

        $twitterCard  = $seo->twitter_card ?? 'summary_large_image';
        $twitterImage = $seo->twitter_image ?? $ogImage;

        return [
            'metaTitle'       => $metaTitle,
            'metaDescription' => $metaDescription,
            'canonicalUrl'    => $canonicalUrl,
            'ogTitle'         => $ogTitle,
            'ogDescription'   => $ogDescription,
            'ogImage'         => $ogImage,
            'ogUrl'           => $ogUrl,
            'ogType'          => 'website',
            'twitterCard'     => $twitterCard,
            'twitterImage'    => $twitterImage,
        ];
    }

    /**
     * ------------------------------------------------------------------
     * Categories / Sub Categories / Sub Sub Categories
     * Form inputs: Meta Title, Meta Description, H1 Heading.
     * Editable-with-autofill: OG Title/Description/Image, Image Alt.
     * Backend-only, never on form: Canonical (slug-derived), Twitter Card.
     * ------------------------------------------------------------------
     */
    private static function buildForCategory(Category $category): array
    {
        $metaTitle       = $category->meta_title ?: $category->name;
        $metaDescription = $category->meta_description ?: null;
        $canonicalUrl    = $category->seoCanonicalUrl();

        $ogTitle       = $category->seoOgTitle() ?: $metaTitle;
        $ogDescription = $category->seoOgDescription() ?: $metaDescription;
        $ogImage       = $category->seoOgImage();

        return [
            'metaTitle'       => $metaTitle,
            'metaDescription' => $metaDescription,
            'h1'              => $category->h1_heading ?: $category->name,
            'canonicalUrl'    => $canonicalUrl,
            'ogTitle'         => $ogTitle,
            'ogDescription'   => $ogDescription,
            'ogImage'         => $ogImage,
            'ogUrl'           => $canonicalUrl,
            'ogType'          => 'website',
            'twitterCard'     => $category->seoTwitterCard(),
            'twitterImage'    => $ogImage,
            'imageAlt'        => $category->seoImageAlt(),
            'jsonLd'          => $category->seoJsonLd(),
        ];
    }

    /**
     * ------------------------------------------------------------------
     * Occasions & Collections — spec says "follow same as Categories":
     * Meta, OG, Twitter, H1, Canonical all admin-editable-with-autofill,
     * same shape as Category.
     * ------------------------------------------------------------------
     */
    private static function buildForCollection(Collection $collection): array
    {
        $metaTitle       = $collection->meta_title ?: $collection->name;
        $metaDescription = $collection->meta_description ?: null;
        $canonicalUrl    = $collection->canonical_resolved;

        $ogTitle       = $collection->og_title_resolved;
        $ogDescription = $collection->og_description_resolved;
        $ogImage       = $collection->image ? asset('storage/' . $collection->image) : null;

        return [
            'metaTitle'       => $metaTitle,
            'metaDescription' => $metaDescription,
            'h1'              => $collection->h1_heading ?: $collection->name,
            'canonicalUrl'    => $canonicalUrl,
            'ogTitle'         => $ogTitle,
            'ogDescription'   => $ogDescription,
            'ogImage'         => $ogImage,
            'ogUrl'           => $canonicalUrl,
            'ogType'          => 'website',
            'twitterCard'     => 'summary_large_image',
            'twitterImage'    => $ogImage,
            'imageAlt'        => $collection->image_alt_resolved,
            'jsonLd'          => self::genericJsonLd(
                'CollectionPage',
                $collection->h1_heading ?: $collection->name,
                $metaDescription,
                $canonicalUrl
            ),
        ];
    }

    private static function buildForOccasion(GiftingOccasion $occasion): array
    {
        $metaTitle       = $occasion->meta_title ?: $occasion->title;
        $metaDescription = $occasion->meta_description ?: null;
        $canonicalUrl    = $occasion->canonical_resolved;

        $ogTitle       = $occasion->og_title_resolved;
        $ogDescription = $occasion->og_description_resolved;
        $ogImage       = $occasion->image ? asset('storage/' . $occasion->image) : null;

        return [
            'metaTitle'       => $metaTitle,
            'metaDescription' => $metaDescription,
            'h1'              => $occasion->h1_heading ?: $occasion->title,
            'canonicalUrl'    => $canonicalUrl,
            'ogTitle'         => $ogTitle,
            'ogDescription'   => $ogDescription,
            'ogImage'         => $ogImage,
            'ogUrl'           => $canonicalUrl,
            'ogType'          => 'website',
            'twitterCard'     => 'summary_large_image',
            'twitterImage'    => $ogImage,
            'imageAlt'        => $occasion->image_alt_resolved,
            'jsonLd'          => self::genericJsonLd(
                'CollectionPage',
                $occasion->h1_heading ?: $occasion->title,
                $metaDescription,
                $canonicalUrl
            ),
        ];
    }

    /**
     * ------------------------------------------------------------------
     * Products
     * Form inputs: Meta Title, Meta Description ONLY.
     * H1 auto-set from product name (not a form field per your spec).
     * Canonical, OG, Twitter Card: fully backend, no form/editable fields.
     * ------------------------------------------------------------------
     */
    private static function buildForProduct(Product $product): array
    {
        $metaTitle       = $product->meta_title ?: $product->name;
        $metaDescription = $product->meta_description ?: null;
        $canonicalUrl    = url()->current();

        // $product->display_image already returns a full asset() URL — do not re-wrap it.
        $ogImage = $product->display_image ?: null;

        return [
            'metaTitle'       => $metaTitle,
            'metaDescription' => $metaDescription,
            'h1'              => $product->h1_heading ?: $product->name,
            'canonicalUrl'    => $canonicalUrl,
            'ogTitle'         => $metaTitle,
            'ogDescription'   => $metaDescription,
            'ogImage'         => $ogImage,
            'ogUrl'           => $canonicalUrl,
            'ogType'          => 'product',
            'twitterCard'     => 'summary_large_image',
            'twitterImage'    => $ogImage,
            'imageAlt'        => $product->name,
            'jsonLd'          => self::productJsonLd($product, $metaTitle, $metaDescription, $canonicalUrl, $ogImage),
        ];
    }

    /**
     * ------------------------------------------------------------------
     * Dynamic Pages / Blogs
     * Form inputs: Meta Title, Meta Description, H1 ONLY.
     * Canonical, OG, Twitter Card, Image Alt: fully backend.
     *
     * ASSUMPTION (confirm against actual DynamicPage/Blog columns):
     * both expose meta_title, meta_description, h1_heading, slug,
     * and an optional `image` column for OG image / alt text.
     * ------------------------------------------------------------------
     */
    private static function buildForDynamicPage(DynamicPage $page): array
    {
        $metaTitle       = $page->meta_title ?: $page->heading ?? $page->page_name;
        $metaDescription = $page->meta_description ?: null;
        $canonicalUrl    = url('/page/' . \Illuminate\Support\Str::slug($page->page_name));

        $ogImage = !empty($page->image) ? asset('storage/' . $page->image) : null;

        return [
            'metaTitle'       => $metaTitle,
            'metaDescription' => $metaDescription,
            'h1'              => $page->h1_heading ?: $metaTitle,
            'canonicalUrl'    => $canonicalUrl,
            'ogTitle'         => $metaTitle,
            'ogDescription'   => $metaDescription,
            'ogImage'         => $ogImage,
            'ogUrl'           => $canonicalUrl,
            'ogType'          => 'website',
            'twitterCard'     => 'summary_large_image',
            'twitterImage'    => $ogImage,
            'imageAlt'        => $page->h1_heading ?: $metaTitle,
            'jsonLd'          => self::genericJsonLd('WebPage', $page->h1_heading ?: $metaTitle, $metaDescription, $canonicalUrl),
        ];
    }

    private static function buildForBlog(Blog $blog): array
    {
        $metaTitle       = $blog->meta_title ?: $blog->title;
        $metaDescription = $blog->meta_description ?: null;
        $canonicalUrl    = url('/blog/' . $blog->slug);

        $ogImage = !empty($blog->image) ? asset('storage/' . $blog->image) : null;

        return [
            'metaTitle'       => $metaTitle,
            'metaDescription' => $metaDescription,
            'h1'              => $blog->h1_heading ?: $blog->title,
            'canonicalUrl'    => $canonicalUrl,
            'ogTitle'         => $metaTitle,
            'ogDescription'   => $metaDescription,
            'ogImage'         => $ogImage,
            'ogUrl'           => $canonicalUrl,
            'ogType'          => 'article',
            'twitterCard'     => 'summary_large_image',
            'twitterImage'    => $ogImage,
            'imageAlt'        => $blog->h1_heading ?: $blog->title,
            'jsonLd'          => self::genericJsonLd('Article', $blog->h1_heading ?: $blog->title, $metaDescription, $canonicalUrl, $ogImage),
        ];
    }

    /**
     * ------------------------------------------------------------------
     * JSON-LD helpers
     * ------------------------------------------------------------------
     */
    private static function productJsonLd(Product $product, $title, $description, $url, $image): array
    {
        return [
            '@context'    => 'https://schema.org',
            '@type'       => 'Product',
            'name'        => $product->name,
            'description' => $description,
            'image'       => $image ? [$image] : [],
            'sku'         => $product->sku,
            'url'         => $url,
            'offers'      => [
                '@type'         => 'Offer',
                'url'           => $url,
                'priceCurrency' => 'INR',
                'price'         => (string) $product->price,
                'availability'  => $product->stock > 0
                    ? 'https://schema.org/InStock'
                    : 'https://schema.org/OutOfStock',
            ],
        ];
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