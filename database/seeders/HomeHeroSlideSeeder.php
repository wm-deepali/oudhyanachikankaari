<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeHeroSlide;

class HomeHeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        HomeHeroSlide::truncate();

        HomeHeroSlide::create([
            'subtitle' => 'Bespoke Corporate Solutions',
            'title' => "Exquisite Gifts for Professional Excellence",
            'description' => 'Strengthen your business bonds with our meticulously curated gift collections, designed to reflect your brand commitment.',
            'button_text' => 'Explore Collection',
            'button_link' => '#',
            'image' => 'assets/img/corporate/hero-slides/banner1.webp',
            'sort_order' => 1,
            'status' => 1,
        ]);

        HomeHeroSlide::create([
            'subtitle' => 'Employee Appreciation',
            'title' => "Celebrate Your Success Together",
            'description' => 'Recognize your team hard work with premium welcome kits and milestone gifts.',
            'button_text' => 'View Kits',
            'button_link' => '#',
            'image' => 'assets/img/corporate/hero-slides/banner3.webp',
            'sort_order' => 2,
            'status' => 1,
        ]);

        HomeHeroSlide::create([
            'subtitle' => 'Global Shipping Available',
            'title' => "Premium Gifts Delivered Worldwide",
            'description' => 'Our seamless international delivery ensures your appreciation reaches worldwide.',
            'button_text' => 'Get Started',
            'button_link' => '#',
            'image' => 'assets/img/corporate/hero-slides/banner4.webp',
            'sort_order' => 3,
            'status' => 1,
        ]);
    }
}