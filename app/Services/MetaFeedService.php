<?php

namespace App\Services;

use App\Models\InvoiceSetting;
use App\Models\Product;
use Illuminate\Support\Str;

class MetaFeedService
{
    private const BRAND = 'Oudhyana Chikankaari';
    private const MAX_ADDITIONAL_IMAGES = 10;

    /**
     * true  => GST registered + tax_type "exclusive" ho to feed price me GST add hoga
     * false => feed hamesha product->price (jo page par dikhta hai) bhejega
     */
    private const ADD_GST_ON_EXCLUSIVE = true;

    /**
     * Feed file generate karta hai (atomic: temp file -> rename).
     * Return: kitne products feed me gaye.
     */
    public function generate(string $path): int
    {
        $dir = dirname($path);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $tmp = $path . '.' . uniqid('', true) . '.tmp';
        $fh = fopen($tmp, 'w');
        $count = 0;

        try {
            fwrite($fh, '<?xml version="1.0" encoding="UTF-8"?>' . "\n");
            fwrite($fh, '<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">' . "\n");
            fwrite($fh, "<channel>\n");
            fwrite($fh, '<title>' . $this->esc(self::BRAND) . "</title>\n");
            fwrite($fh, '<link>' . $this->esc($this->https(url('/'))) . "</link>\n");
            fwrite($fh, '<description>' . $this->esc(self::BRAND . ' product feed') . "</description>\n");

            $multiplier = $this->gstMultiplier();

            // visible() = status 1 (+ stock > 0 agar auto_disable_out_of_stock ON ho),
            // SoftDeletes se deleted products apne aap bahar. Product page bhi isi scope se
            // open hota hai, to feed ka koi link 404 nahi dega.
            Product::query()
                ->visible()
                ->with([
                    'images',
                    'category',
                    'subcategory',
                    'variants',
                    'attributeValues.attribute',
                    'attributeValues.value',
                ])
                ->chunkById(200, function ($products) use ($fh, $multiplier, &$count) {
                    foreach ($products as $product) {
                        $item = $this->buildItem($product, $multiplier);
                        if ($item !== null) {
                            fwrite($fh, $item);
                            $count++;
                        }
                    }
                });

            fwrite($fh, "</channel>\n</rss>\n");
            fclose($fh);
            $fh = null;

            rename($tmp, $path);
        } finally {
            if (is_resource($fh)) {
                fclose($fh);
            }
            if (is_file($tmp)) {
                @unlink($tmp);
            }
        }

        return $count;
    }

    private function buildItem(Product $product, float $multiplier): ?string
    {
        $price = (float) $product->price;
        $mrp = (float) $product->mrp;

        if ($price <= 0) {
            return null;
        }

        // Regular price = MRP (agar price se bada hai), sale_price = selling price.
        // Dono par same GST multiplier, taaki sale < regular hi rahe.
        $selling = round($price * $multiplier, 2);
        $regular = $mrp > $price ? round($mrp * $multiplier, 2) : $selling;
        $hasSale = $regular > $selling;

        // Images: default pehle, phir sort_order. Full size only (thumb kabhi nahi).
        $images = $product->images
            ->sortBy([['is_default', 'desc'], ['sort_order', 'asc'], ['id', 'asc']])
            ->map(fn($img) => $this->imageUrl($img->image))
            ->filter()
            ->unique()
            ->values();

        if ($images->isEmpty()) {
            return null; // Meta image ke bina reject karta hai
        }

        // Availability: page jaisa logic — stock variants hon to unka sum, warna base stock.
        $stockVariants = $product->variants->where('type', 'stock');
        $stock = $stockVariants->count()
            ? (int) $stockVariants->sum('stock')
            : (int) $product->stock;
        $inStock = $stock >= max(1, (int) $product->min_qty);

        $description = $this->plainText($product->description)
            ?: $this->plainText($product->short_description)
            ?: $product->name;
        $description = Str::limit($description, 5000, '');

        $productType = $product->subcategory->name ?? $product->category->name ?? null;

        $color = $this->color($product);

        $x = "<item>\n";
        $x .= '<g:id>' . $product->id . "</g:id>\n";
        $x .= '<g:title>' . $this->cdata(mb_substr(trim($product->name), 0, 200)) . "</g:title>\n";
        $x .= '<g:description>' . $this->cdata($description) . "</g:description>\n";
        $x .= '<g:availability>' . ($inStock ? 'in stock' : 'out of stock') . "</g:availability>\n";
        $x .= "<g:condition>new</g:condition>\n";
        $x .= '<g:price>' . $this->money($regular) . "</g:price>\n";
        if ($hasSale) {
            $x .= '<g:sale_price>' . $this->money($selling) . "</g:sale_price>\n";
        }
        $x .= '<g:link>' . $this->esc($this->https(route('product.details', $product->slug))) . "</g:link>\n";
        $x .= '<g:image_link>' . $this->esc($images->first()) . "</g:image_link>\n";
        foreach ($images->slice(1, self::MAX_ADDITIONAL_IMAGES) as $img) {
            $x .= '<g:additional_image_link>' . $this->esc($img) . "</g:additional_image_link>\n";
        }
        $x .= '<g:brand>' . $this->esc(self::BRAND) . "</g:brand>\n";
        if ($productType) {
            $x .= '<g:product_type>' . $this->esc($productType) . "</g:product_type>\n";
        }
        if ($color) {
            $x .= '<g:color>' . $this->esc($color) . "</g:color>\n";
        }
        $x .= "<g:gender>female</g:gender>\n";
        $x .= "<g:age_group>adult</g:age_group>\n";
        $x .= "</item>\n";

        return $x;
    }

    /**
     * GST sirf tab: business_type = registered AND tax_type = exclusive
     * (inclusive me price me GST pehle se included hai, unregistered me GST hai hi nahi).
     * Rate cart jaisa hi: cgst + sgst.
     */
    private function gstMultiplier(): float
    {
        if (!self::ADD_GST_ON_EXCLUSIVE) {
            return 1.0;
        }

        $setting = InvoiceSetting::first();

        if (
            !$setting
            || $setting->business_type !== 'registered'
            || $setting->tax_type !== 'exclusive'
        ) {
            return 1.0;
        }

        $rate = (float) $setting->cgst + (float) $setting->sgst;

        return 1 + ($rate / 100);
    }

    private function color(Product $product): ?string
    {
        $names = ['color', 'colour'];

        $match = $product->attributeValues->first(function ($av) use ($names) {
            $attr = $av->attribute;

            return $attr
                && $av->value
                && (in_array(Str::lower((string) $attr->slug), $names, true)
                    || in_array(Str::lower((string) $attr->name), $names, true));
        });

        $value = $match?->value?->value;

        return $value ? trim($value) : null;
    }

    /**
     * Absolute https image URL. "public/storage/https://..." jaisa double path ho to
     * andar wala asli URL nikaal leta hai.
     */
    private function imageUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        if (preg_match('#(https?://.+)$#i', $path, $m)) {
            return $this->https($m[1]);
        }

        $path = preg_replace('#^/?(public/)?(storage/)?#', '', trim($path));

        return $this->https(asset('storage/' . ltrim($path, '/')));
    }

    private function https(string $url): string
    {
        return preg_replace('#^http://#i', 'https://', $url);
    }

    private function money(float $value): string
    {
        // "5285.00 INR" — na ₹, na comma, na extra space
        return number_format($value, 2, '.', '') . ' INR';
    }

    private function plainText(?string $html): string
    {
        if (!$html) {
            return '';
        }

        $html = str_ireplace(['</p>', '</li>', '</div>', '<br>', '<br/>', '<br />'], ' ', $html);
        $text = html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace('/\s+/u', ' ', $text);

        return trim($text);
    }

    /** XML me invalid control characters hata deta hai */
    private function clean(string $v): string
    {
        return preg_replace('/[^\x{9}\x{A}\x{D}\x{20}-\x{D7FF}\x{E000}-\x{FFFD}\x{10000}-\x{10FFFF}]/u', '', $v);
    }

    private function cdata(string $v): string
    {
        return '<![CDATA[' . str_replace(']]>', ']]]]><![CDATA[>', $this->clean($v)) . ']]>';
    }

    private function esc(string $v): string
    {
        return htmlspecialchars($this->clean($v), ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }
}