<?php

namespace App\Http\Controllers;

use App\Models\Cart;


class CheckoutController extends Controller
{
    public function checkout()
    {
        $customer = auth('customer')->user();

        $cart = Cart::with([
            'items.product.images',
            'items.product.category',
            'items.variant.values.attributeValue.attribute',
        ])
            ->where('user_id', $customer->id)
            ->first();

        $customer = auth('customer')->user();

        $addresses = $customer->addresses()
            ->with(['state', 'city'])
            ->orderByDesc('is_default')
            ->get();

        $defaultAddress = $addresses->firstWhere('is_default', true);

        return view(
            'front-pages.checkout',
            compact(
                'cart',
                'customer',
                'addresses',
                'defaultAddress'
            )
        );
    }

}