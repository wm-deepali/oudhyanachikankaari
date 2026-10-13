<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class BackfillProductSeoMeta extends Command
{
    /**
     * php artisan products:backfill-seo-meta
     * php artisan products:backfill-seo-meta --force   (overwrite existing meta_title/meta_description too)
     */
    protected $signature = 'products:backfill-seo-meta {--force : Overwrite meta_title/meta_description even if already set}';

    protected $description = 'Auto-generate Meta Title, Meta Description, OG and Twitter fields for all existing products';

    public function handle(): int
    {
        $force = $this->option('force');

        $products = Product::with(['attributeValues.attribute', 'attributeValues.value', 'images'])->get();

        $this->info("Found {$products->count()} products. Processing...");

        $bar = $this->output->createProgressBar($products->count());
        $bar->start();

        $updatedCount = 0;

        foreach ($products as $product) {

            $fabricName = $this->getFabricValueName($product);

            $needsMetaTitle = $force || empty($product->meta_title);
            $needsMetaDescription = $force || empty($product->meta_description);

            $metaTitle = $needsMetaTitle
                ? $this->buildAutoMetaTitle($product->name, $product->product_code, $fabricName, $product->id)
                : $product->meta_title;

            $metaDescription = $needsMetaDescription
                ? $this->buildAutoMetaDescription($product->name, $fabricName)
                : $product->meta_description;

            $default = $product->images->firstWhere('is_default', 1)
                ?? $product->images->first();

            $product->update([
                'meta_title' => $metaTitle,
                'meta_description' => $metaDescription,
                'og_title' => $metaTitle,
                'og_description' => $metaDescription,
                'og_image' => $default->image ?? null,
                'twitter_card' => 'summary_large_image',
                'twitter_title' => $metaTitle,
                'twitter_description' => $metaDescription,
                'twitter_image' => $default->image ?? null,
            ]);

            $updatedCount++;
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Done. Updated {$updatedCount} products.");

        return self::SUCCESS;
    }

    /**
     * Reads the Fabric attribute value already attached to this product
     * (from the eager-loaded attributeValues relation), instead of reading
     * request input like the controller does.
     */
    private function getFabricValueName(Product $product): ?string
    {
        $fabricRow = $product->attributeValues->first(function ($row) {
            return $row->attribute && strtolower(trim($row->attribute->name)) === 'fabric';
        });

        return $fabricRow?->value?->value;
    }

    private function metaTitleExists(string $title, ?int $ignoreId = null): bool
    {
        return Product::where('meta_title', $title)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists();
    }

    /**
     * Same logic as ProductController@buildAutoMetaTitle:
     * "Name | Oudhyaana Chikankaari" → falls back to Product Code, then
     * Fabric, only if the plain version collides with another product.
     */
    private function buildAutoMetaTitle(string $name, ?string $productCode, ?string $fabric, ?int $ignoreId = null): string
    {
        $base = $name . ' | Oudhyaana Chikankaari';

        if (!$this->metaTitleExists($base, $ignoreId)) {
            return $base;
        }

        if ($productCode) {
            $withCode = $name . ' | ' . $productCode . ' | Oudhyaana Chikankaari';
            if (!$this->metaTitleExists($withCode, $ignoreId)) {
                return $withCode;
            }
        }

        if ($fabric) {
            $withFabric = $name . ' | ' . $fabric . ' | Oudhyaana Chikankaari';
            if (!$this->metaTitleExists($withFabric, $ignoreId)) {
                return $withFabric;
            }
        }

        return $base;
    }

    /**
     * Same logic as ProductController@buildAutoMetaDescription.
     */
    private function buildAutoMetaDescription(string $name, ?string $fabric): string
    {
        $fabricPart = $fabric ? ' crafted in ' . $fabric : '';
        return "Shop {$name} at Oudhyaana. Discover authentic handcrafted Lucknowi Chikankari{$fabricPart}. Explore product details and order online.";
    }
}