<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Collection;
use App\Models\GiftingOccasion;
use App\Models\Blog;
use App\Models\DynamicPage;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Cache TTL for the whole sitemap. Regenerated at most once every
     * 6 hours rather than on every crawler hit.
     */
    private const CACHE_MINUTES = 360; // 6 hours

    /**
     * GET /sitemap.xml — single merged sitemap covering every indexable
     * URL type. Fine as one file as long as total URL count stays well
     * under the 50,000-URL / 50MB protocol limit; if the catalog grows
     * past that, split products() back out into its own file (see the
     * multi-file version — ask if you need it later).
     */
    public function index(): Response
    {
        $urls = Cache::remember('sitemap:all', self::CACHE_MINUTES * 60, function () {
            return collect()
                ->merge($this->staticUrls())
                ->merge($this->categoryUrls())
                ->merge($this->collectionUrls())
                ->merge($this->occasionUrls())
                ->merge($this->attributeUrls())
                ->merge($this->productUrls())
                ->merge($this->blogUrls())
                ->merge($this->pageUrls());
        });

        return response(view('sitemap.urlset', ['urls' => $urls])->render(), 200)
            ->header('Content-Type', 'text/xml');
    }

    private function staticUrls(): array
    {
        return [
            ['loc' => route('home'),       'priority' => '1.0', 'changefreq' => 'daily'],
            ['loc' => route('categories'), 'priority' => '0.8', 'changefreq' => 'daily'],
            ['loc' => route('occasions'),  'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => route('about-us'),   'priority' => '0.5', 'changefreq' => 'monthly'],
            ['loc' => route('why-us'),     'priority' => '0.5', 'changefreq' => 'monthly'],
            ['loc' => route('contact-us'), 'priority' => '0.5', 'changefreq' => 'monthly'],
            ['loc' => route('faqs'),       'priority' => '0.4', 'changefreq' => 'monthly'],
            ['loc' => route('blogs'),      'priority' => '0.6', 'changefreq' => 'daily'],
        ];
    }

    /**
     * Gated on BOTH `status` (visible on the frontend at all — matches
     * Category::where('status', 1) used everywhere in FrontController)
     * AND `meta_status` (explicitly marked indexable).
     */
    private function categoryUrls()
    {
        return Category::query()
            ->where('status', 1)
            ->where('meta_status', 'index_follow')
            ->get()
            ->map(function (Category $category) {
                $chain = [];
                $node = $category;
                while ($node) {
                    $chain[] = $node;
                    $node = $node->parent ?? null;
                }

                $slugPath = [];
                foreach (array_reverse($chain) as $n) {
                    $slugPath[] = $n->slug;
                }

                return [
                    'loc'        => route('products.listing', $slugPath),
                    'lastmod'    => $category->updated_at,
                    'priority'   => $category->parent_id ? '0.7' : '0.8',
                    'changefreq' => 'daily',
                ];
            });
    }

    private function collectionUrls()
    {
        return Collection::query()
            ->where('status', 1)
            ->where('meta_status', 'index_follow')
            ->get()
            ->map(fn (Collection $c) => [
                'loc'        => $c->canonical_resolved,
                'lastmod'    => $c->updated_at,
                'priority'   => '0.7',
                'changefreq' => 'weekly',
            ]);
    }

    private function occasionUrls()
    {
        return GiftingOccasion::query()
            ->where('status', 1)
            ->where('meta_status', 'index_follow')
            ->get()
            ->map(fn (GiftingOccasion $o) => [
                'loc'        => $o->canonical_resolved,
                'lastmod'    => $o->updated_at,
                'priority'   => '0.6',
                'changefreq' => 'weekly',
            ]);
    }

    /**
     * NOTE: no confirmed `status` column on attribute_values — filtering
     * on meta_status only. Add ->where('status', 1) if that column exists.
     */
    private function attributeUrls()
    {
        return AttributeValue::with('attribute')
            ->where('meta_status', 'index_follow')
            ->get()
            ->filter(fn (AttributeValue $av) => $av->attribute)
            ->map(fn (AttributeValue $av) => [
                'loc' => $av->canonical
                    ? url(ltrim($av->canonical, '/'))
                    : route('attribute.listing', [
                        'attributeSlug' => $av->attribute->slug,
                        'valueSlug'     => $av->slug,
                    ]),
                'lastmod'    => $av->updated_at,
                'priority'   => '0.5',
                'changefreq' => 'weekly',
            ]);
    }

    /**
     * Uses the same Product::visible() scope the frontend uses everywhere.
     * Chunked to avoid loading the whole catalog into memory at once.
     */
    private function productUrls()
    {
        $items = collect();

        Product::query()
            ->where('meta_status', 'index_follow')
            ->visible()
            ->orderBy('id')
            ->chunk(1000, function ($chunk) use (&$items) {
                foreach ($chunk as $product) {
                    $items->push([
                        'loc'        => route('product.details', ['slug' => $product->slug]),
                        'lastmod'    => $product->updated_at,
                        'priority'   => '0.9',
                        'changefreq' => 'daily',
                    ]);
                }
            });

        return $items;
    }

    private function blogUrls()
    {
        return Blog::query()
            ->where('status', 1)
            ->get()
            ->map(fn (Blog $b) => [
                'loc'        => url('/blog/' . $b->slug),
                'lastmod'    => $b->updated_at,
                'priority'   => '0.6',
                'changefreq' => 'monthly',
            ]);
    }

    private function pageUrls()
    {
        return DynamicPage::query()
            ->where('status', 1)
            ->get()
            ->map(fn (DynamicPage $p) => [
                'loc'        => url('/page/' . Str::slug($p->page_name)),
                'lastmod'    => $p->updated_at,
                'priority'   => '0.5',
                'changefreq' => 'monthly',
            ]);
    }
}