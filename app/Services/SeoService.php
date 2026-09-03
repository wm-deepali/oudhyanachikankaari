<?php
namespace App\Services;

use App\Models\Product;

class SeoService
{
    /**
     * @param mixed $seo     Model returned by getSeo() — SeoPage, Product, Collection, etc.
     * @param mixed $general Site-wide "general settings" object (site_name, tagline) — optional
     */
    public static function build($seo, $general = null): array
    {
        if ($seo instanceof Product) {
            return self::buildForProduct($seo);
        }

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
     * Product pages: fully auto-set, no manual OG/Twitter fields.
     * OG Title = Meta Title, OG Image = Product display image,
     * Twitter Card = summary_large_image, Twitter Image = OG Image.
     */
    private static function buildForProduct(Product $product): array
    {
        $metaTitle       = $product->meta_title ?: $product->name;
        $metaDescription = $product->meta_description ?: null;
        $canonicalUrl    = url()->current();

        $ogImage = $product->display_image
            ? asset('storage/' . $product->display_image)
            : null;

        return [
            'metaTitle'       => $metaTitle,
            'metaDescription' => $metaDescription,
            'canonicalUrl'    => $canonicalUrl,
            'ogTitle'         => $metaTitle,
            'ogDescription'   => $metaDescription,
            'ogImage'         => $ogImage,
            'ogUrl'           => $canonicalUrl,
            'ogType'          => 'product',
            'twitterCard'     => 'summary_large_image',
            'twitterImage'    => $ogImage,
        ];
    }
    
}