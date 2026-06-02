<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeDealBanner;

class HomeDealBannerSeeder extends Seeder
{
    public function run(): void
    {
        HomeDealBanner::truncate();

        HomeDealBanner::create([
            'title' => 'Corporate Gifts',
            'highlight_text' => 'That Leave A Lasting Impression',
            'offer_text' => 'Up to 25% Off',
            'button_text' => 'Shop Collection',
            'button_link' => '#',
            'image' => 'assets/img/corporate/premium_gadgets_1778668027534.webp',
            'sort_order' => 1,
            'status' => 1,
        ]);

        HomeDealBanner::create([
            'title' => 'Welcome Kits',
            'highlight_text' => 'Premium Quality Gear & Backpacks',
            'offer_text' => 'New Onboarding Packs',
            'button_text' => 'Explore Bags',
            'button_link' => '#',
            'image' => 'assets/img/corporate/backpack_gifts_1778668040094.webp',
            'sort_order' => 2,
            'status' => 1,
        ]);

        HomeDealBanner::create([
            'title' => 'Premium Apparel',
            'highlight_text' => 'Custom Branded Corporate Outfits',
            'offer_text' => 'Exclusive Apparel',
            'button_text' => 'Explore Apparel',
            'button_link' => '#',
            'image' => 'assets/img/corporate/apparel_gifts_1778668621245.webp',
            'sort_order' => 3,
            'status' => 1,
        ]);
    }
}