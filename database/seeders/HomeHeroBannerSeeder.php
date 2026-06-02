<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeHeroBanner;

class HomeHeroBannerSeeder extends Seeder
{
    public function run(): void
    {
        HomeHeroBanner::truncate();

        HomeHeroBanner::create([
            'small_text' => 'Luxury Curation',
            'title' => "Curated Executive <br/> Hampers",
            'button_text' => 'Discover Now',
            'button_link' => '#',
            'image' => 'assets/img/corporate/hero-banners/mini-banner-1.webp',
            'sort_order' => 1,
            'status' => 1,
        ]);

        HomeHeroBanner::create([
            'small_text' => 'Tech Excellence',
            'title' => "Premium Tech <br/>Gift Sets",
            'button_text' => 'Shop Now',
            'button_link' => '#',
            'image' => 'assets/img/corporate/hero-banners/mini-banner-2.webp',
            'sort_order' => 2,
            'status' => 1,
        ]);
    }
}