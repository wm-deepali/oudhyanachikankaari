<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cart;
use Illuminate\Support\Facades\View;
use App\Models\DynamicPage;
use App\Models\Announcement;


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
                'items.customization'
            ])
                ->where('session_id', $sessionId)
                ->first();

            $count = $cart ? $cart->items->count() : 0;

            $view->with([
                'globalCartCount' => $count,
                'miniCart' => $cart,
            ]);
        });


        View::composer('*', function ($view) {

            $pages = DynamicPage::where('status', 1)->get();

            $view->with('footerPages', $pages);
        });


        View::composer('*', function ($view) {

            $announcements = Announcement::where('status', 1)
                ->latest()
                ->get();

            $view->with(
                'announcements',
                $announcements
            );
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


        View::composer('*', function ($view) {

              $footerCategories = \App\Models\Category::where('status', 1)
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->take(10)
            ->get();

            $view->with(
                'footerCategories',
                $footerCategories
            );

        });

            View::composer('*', function ($view) {
    
                $footerSetting = \App\Models\FooterSetting::first();
    
                $view->with(
                    'footerSetting',
                    $footerSetting
                );
    
            });

            


    }
}
