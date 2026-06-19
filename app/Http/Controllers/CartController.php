<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\Coupon;


class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'nullable|exists:product_variants,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        $quantity = $request->quantity ?? $product->min_qty;
        $variantId = $request->variant_id;

        /*
        |--------------------------------------------------------------------------
        | Get Cart
        |--------------------------------------------------------------------------
        */

        if (auth('customer')->check()) {

            $customer = auth('customer')->user();

            $cart = Cart::firstOrCreate(
                ['user_id' => $customer->id],
                [
                    'session_id' => session()->getId(),
                    'total_amount' => 0,
                    'subtotal' => 0,
                    'discount' => 0,
                    'tax_amount' => 0,
                    'grand_total' => 0,
                ]
            );

        } else {

            $cart = Cart::firstOrCreate(
                ['session_id' => session()->getId()],
                [
                    'total_amount' => 0,
                    'subtotal' => 0,
                    'discount' => 0,
                    'tax_amount' => 0,
                    'grand_total' => 0,
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Price & Stock
        |--------------------------------------------------------------------------
        */

        $price = $product->price;
        $stock = $product->stock;

        if ($variantId) {

            $variant = ProductVariant::findOrFail($variantId);

            $price = $variant->price;
            $stock = $variant->stock;
        }

        if ($stock < $product->min_qty) {

            return response()->json([
                'status' => false,
                'message' => 'Product is out of stock.'
            ], 422);
        }

        if ($quantity > $stock) {

            return response()->json([
                'status' => false,
                'message' => "Only {$stock} units available."
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Existing Item
        |--------------------------------------------------------------------------
        */

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->where('variant_id', $variantId)
            ->first();

        if ($item) {

            $newQty = $item->quantity + $quantity;

            if ($newQty > $stock) {

                return response()->json([
                    'status' => false,
                    'message' => "Only {$stock} units available."
                ], 422);
            }

            $item->quantity = $newQty;
            $item->total = $item->quantity * $item->price;
            $item->save();

        } else {

            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'variant_id' => $variantId,
                'quantity' => $quantity,
                'price' => $price,
                'total' => $price * $quantity,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Recalculate Cart
        |--------------------------------------------------------------------------
        */

        $cart->recalculateTotals();
        $cart->refresh();

        return response()->json([
            'status' => true,
            'message' => 'Product added to cart successfully.',
            'cart_count' => $cart->items()->sum('quantity'),
            'cart_total' => $cart->grand_total,
        ]);
    }

    public function cart()
    {
        if (auth('customer')->check()) {

            $cart = Cart::with([
                'items.product.images',
                'items.product.category',
                'items.product.subcategory',
                'items.variant.values.attributeValue.attribute',
            ])
                ->where('user_id', auth('customer')->id())
                ->first();

        } else {

            $cart = Cart::with([
                'items.product.images',
                'items.product.category',
                'items.product.subcategory',
                'items.variant.values.attributeValue.attribute',
            ])
                ->where('session_id', session()->getId())
                ->first();
        }

        // Recalculate GST based on latest default address
        if ($cart) {
            $cart->recalculateTotals();
            $cart->refresh();
        }

        return view(
            'front-pages.cart',
            compact('cart')
        );
    }


    public function remove($id)
    {
        $item = CartItem::findOrFail($id);

        if (auth('customer')->check()) {

            if ($item->cart->user_id != auth('customer')->id()) {
                abort(403);
            }

        } else {

            if ($item->cart->session_id != session()->getId()) {
                abort(403);
            }
        }

        $cart = $item->cart;

        $item->delete();

        $cart->recalculateTotals();
        $cart->refresh();

        return response()->json([
            'status' => true,
            'message' => 'Item removed successfully',
            'cart_total' => $cart->grand_total,
            'cart_count' => $cart->items()->sum('quantity')
        ]);
    }

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:cart_items,id',
            'action' => 'required|in:plus,minus',
        ]);

        $item = CartItem::findOrFail($request->item_id);

        if (auth('customer')->check()) {

            if ($item->cart->user_id != auth('customer')->id()) {
                abort(403);
            }

        } else {

            if ($item->cart->session_id != session()->getId()) {
                abort(403);
            }
        }

        $stock = $item->variant
            ? $item->variant->stock
            : $item->product->stock;

        $minQty = $item->product->min_qty;

        if ($request->action == 'plus') {

            if ($item->quantity + 1 > $stock) {

                return response()->json([
                    'status' => false,
                    'message' => 'Only ' . $stock . ' units available in stock.'
                ], 422);
            }

            $item->quantity++;

        } elseif ($request->action == 'minus') {

            if ($item->quantity - 1 >= $minQty) {
                $item->quantity--;
            }
        }

        $item->total = $item->quantity * $item->price;
        $item->save();

        $cart = $item->cart;

        $cart->recalculateTotals();
        $cart->refresh();

        $mrp = $item->variant->mrp ?? $item->product->mrp;
        $totalMrp = $mrp * $item->quantity;

        return response()->json([
            'status' => true,
            'quantity' => $item->quantity,
            'item_total' => $item->total,
            'total_mrp' => $totalMrp,
            'cart_total' => $cart->grand_total,
        ]);
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required'
        ]);

        $cart = auth('customer')->check()
            ? Cart::where('user_id', auth('customer')->id())->first()
            : Cart::where('session_id', session()->getId())->first();

        if (!$cart) {
            return response()->json([
                'status' => false,
                'message' => 'Cart not found'
            ]);
        }

        $coupon = Coupon::where('code', $request->coupon_code)
            ->where('status', 1)
            ->first();

        if (!$coupon) {

            return response()->json([
                'status' => false,
                'message' => 'Invalid coupon code'
            ]);
        }

        if ($coupon->start_date && now()->lt($coupon->start_date)) {

            return response()->json([
                'status' => false,
                'message' => 'Coupon not started yet'
            ]);
        }

        if ($coupon->end_date && now()->gt($coupon->end_date)) {

            return response()->json([
                'status' => false,
                'message' => 'Coupon expired'
            ]);
        }

        $subtotal = $cart->items()->sum('total');

        if (
            $coupon->minimum_order_amount &&
            $subtotal < $coupon->minimum_order_amount
        ) {

            return response()->json([
                'status' => false,
                'message' => 'Minimum order amount not reached'
            ]);
        }

        if ($coupon->discount_type == 'percentage') {

            $discount =
                ($subtotal * $coupon->discount_value) / 100;

            if (
                $coupon->maximum_discount &&
                $discount > $coupon->maximum_discount
            ) {
                $discount = $coupon->maximum_discount;
            }

        } else {

            $discount = $coupon->discount_value;
        }

        $cart->update([
            'coupon_id' => $coupon->id,
            'coupon_code' => $coupon->code,
            'discount' => $discount
        ]);

        $cart->recalculateTotals();
        $cart->refresh();

        return response()->json([
            'status' => true,
            'message' => 'Coupon applied successfully'
        ]);
    }

    public function removeCoupon()
    {
        $cart = auth('customer')->check()
            ? Cart::where('user_id', auth('customer')->id())->first()
            : Cart::where('session_id', session()->getId())->first();

        $cart->update([
            'coupon_id' => null,
            'coupon_code' => null,
            'discount' => 0
        ]);

        $cart->recalculateTotals();
        $cart->refresh();

        return response()->json([
            'status' => true
        ]);
    }

}