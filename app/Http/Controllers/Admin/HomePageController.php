<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        $sections = [


            [
                'title' => 'Home Sliders',
                'route' => route('admin.home.sliders.index'),
                'type' => 'multiple'
            ],

            [
                'title' => 'Hero Section',
                'route' => route('admin.home.hero.edit'),
                'type' => 'fixed'
            ],

            [
                'title' => 'Why Choose Us',
                'route' => route('admin.home.why.index'),
                'type' => 'multiple'
            ],

            [
                'title' => 'Offer & Product Banners',
                'route' => route('admin.home.banners.index'),
                'type' => 'multiple'
            ],

            // ✅ NEW (Feature Cards Section)
            [
                'title' => 'Feature Cards Section',
                'route' => route('admin.home.features.index'),
                'type' => 'multiple'
            ],

        ];

        return view('admin.home.index', compact('sections'));
    }
}