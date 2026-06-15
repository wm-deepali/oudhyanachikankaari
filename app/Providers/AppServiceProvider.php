<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cart;
use Illuminate\Support\Facades\View;
use App\Models\DynamicPage;
use App\Models\Announcement;
use App\Models\Collection;
use App\Models\GiftingOccasion;
use App\Models\Category;
use App\Models\Attribute;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {

            $sessionId = session()->getId();

            $cart = Cart::with([
                'items.product.images',
                'items'
            ])
                ->where('session_id', $sessionId)
                ->first();

            $count = $cart ? $cart->items->count() : 0;

            $announcements = Announcement::where('status', 1)
                ->latest()
                ->get();

            $collections = Collection::where('status', 1)
                ->orderBy('sort_order')
                ->get();

            $headerOccasions = GiftingOccasion::where('status', 1)
                ->get();

            $menuCategories = Category::whereNull('parent_id')
                ->where('status', 1)
                ->orderBy('sort_order')
                ->get();

            $fabricAttribute = Attribute::with('values')
                ->where('name', 'Fabric')
                ->first();

            $headerFabrics = $fabricAttribute
                ? $fabricAttribute->values
                : collect();

            $navbarCategories = Category::with([
                'children' => function ($q) {
                    $q->where('status', 1)
                        ->where('show_in_navbar', 1)
                        ->orderBy('sort_order');
                }
            ])
                ->whereNull('parent_id')
                ->where('status', 1)
                ->where('show_in_navbar', 1)
                ->orderBy('sort_order')
                ->get();

            $footerSetting = \App\Models\FooterSetting::first();

            $view->with(
                [
                    'globalCartCount' => $count,
                    'miniCart' => $cart,
                    'announcements' => $announcements,
                    'headerCollections' => $collections,
                    'headerOccasions' => $headerOccasions,
                    'menuCategories' => $menuCategories,
                    'headerFabrics' => $headerFabrics,
                    'navbarCategories' => $navbarCategories,
                    'footerSetting' => $footerSetting
                ]
            );
        });


        View::composer('*', function ($view) {

            $pages = DynamicPage::where('status', 1)->get();

            $view->with('footerPages', $pages);
        });



        View::composer('*', function ($view) {

            $wishlistCount = \App\Models\Wishlist::where(
                'session_id',
                session()->getId()
            )->count();
            $view->with(
                'wishlistCount',
                $wishlistCount
            );
        });


    }
}
