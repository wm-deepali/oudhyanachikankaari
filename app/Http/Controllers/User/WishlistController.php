<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $wishlists = Wishlist::current()
            ->with([
                'product.category',
                'product.subcategory',
                'product.images',
            ])
            ->latest()
            ->get();

        return view('user.wishlist', compact('wishlists'));
    }

    /*
    |--------------------------------------------------------------------------
    | Add to Wishlist
    |--------------------------------------------------------------------------
    */

    public function add(Request $request)
    {
        $settings = Setting::first();

        if (!$settings || !$settings->wishlist) {
            return response()->json([
                'status' => false,
                'message' => 'Wishlist feature is disabled.',
            ]);
        }

        $product = Product::findOrFail($request->product_id);

        $exists = Wishlist::current()
            ->where('product_id', $product->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => 'Product is already in your wishlist.',
                'wishlist_count' => Wishlist::current()->count(),
            ]);
        }

        Wishlist::addProduct($product);

        return response()->json([
            'status' => true,
            'message' => 'Product added to wishlist successfully.',
            'wishlist_count' => Wishlist::current()->count(),
        ]);

    }


    /*
    |--------------------------------------------------------------------------
    | Remove from Wishlist
    |--------------------------------------------------------------------------
    */

    public function remove(Request $request, Product $product)
    {
        Wishlist::removeProduct($product);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Removed from wishlist.',
            ]);
        }

        return back()->with('success', 'Item removed from your wishlist.');
    }


    /*
    |--------------------------------------------------------------------------
    | Move to Cart
    |--------------------------------------------------------------------------
    */

    public function moveToCart(Request $request, Product $product)
    {
        // Add to cart
        $cartItem = CartItem::firstOrCreate(
            [
                'customer_id' => auth('customer')->check()
                    ? auth('customer')->id()
                    : null,
                'session_id' => auth('customer')->check()
                    ? null
                    : session()->getId(),
                'product_id' => $product->id,
            ],
            ['quantity' => 1]
        );

        // If it already existed bump the quantity by 1
        if (!$cartItem->wasRecentlyCreated) {
            $cartItem->increment('quantity');
        }

        // Remove from wishlist
        Wishlist::removeProduct($product);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => "{$product->name} moved to cart.",
            ]);
        }

        return back()->with('success', "{$product->name} moved to your cart.");
    }


}