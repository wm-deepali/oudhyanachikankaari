<?php

namespace App\Http\Controllers;

use App\Mail\NewOrderAdminMail;
use App\Mail\OrderConfirmationMail;
use App\Models\Cart;
use App\Models\CustomerAddress;
use App\Models\Setting;
use App\Models\SmtpSetting;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Invoice;
use App\Models\PaymentSetting;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Helpers\MailHelper;
use App\Services\StockAlertService;

class CheckoutController extends Controller
{

    // Inject in constructor
    public function __construct(protected StockAlertService $alertService)
    {
    }

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

        if ($cart) {
            $cart->recalculateTotals();
            $cart->refresh();
        }

        $customer = auth('customer')->user();

        $addresses = $customer->addresses()
            ->with(['state', 'city'])
            ->orderByDesc('is_default')
            ->get();

        $defaultAddress = $addresses->firstWhere('is_default', true);

        $states = State::orderBy('name')
            ->get();

        return view(
            'front-pages.checkout',
            compact(
                'cart',
                'customer',
                'addresses',
                'defaultAddress',
                'states'
            )
        );
    }

    public function storeAddress(Request $request)
    {
        $customer = auth('customer')->user();

        CustomerAddress::where(
            'customer_id',
            $customer->id
        )->update([
                    'is_default' => 0
                ]);

        CustomerAddress::create([
            'customer_id' => $customer->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'country' => 'India',
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'pincode' => $request->pincode,
            'address_type' => $request->address_type ?? 'home',
            'is_default' => 1,
        ]);

        $cart = Cart::where('user_id', $customer->id)->first();

        if ($cart) {
            $cart->recalculateTotals();
        }

        return response()->json([
            'success' => true
        ]);
    }


    public function changeDefaultAddress(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:customer_addresses,id'
        ]);

        $customer = auth('customer')->user();

        CustomerAddress::where(
            'customer_id',
            $customer->id
        )->update([
                    'is_default' => 0
                ]);

        CustomerAddress::where(
            'id',
            $request->address_id
        )
            ->where('customer_id', $customer->id)
            ->update([
                'is_default' => 1
            ]);

        $cart = Cart::where(
            'user_id',
            $customer->id
        )->first();

        if ($cart) {
            $cart->recalculateTotals();
        }

        return response()->json([
            'success' => true
        ]);
    }


    public function placeOrder(Request $request)
    {
        $customer = auth('customer')->user();

        $request->validate([
            'payment_method' => 'required|in:cod,razorpay',
        ]);

        $address = null;

        /*
        |--------------------------------------------------------------------------
        | Existing Address
        |--------------------------------------------------------------------------
        */

        if ($request->filled('address_id')) {

            $address = CustomerAddress::where(
                'customer_id',
                $customer->id
            )->find($request->address_id);
        }

        /*
        |--------------------------------------------------------------------------
        | Create Address If Not Exists
        |--------------------------------------------------------------------------
        */

        if (!$address) {

            $request->validate([

                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required',

                'address_line_1' => 'required',
                'state_id' => 'required|exists:states,id',
                'city_id' => 'required|exists:cities,id',
                'pincode' => 'required',
            ]);

            CustomerAddress::where(
                'customer_id',
                $customer->id
            )->update([
                        'is_default' => 0
                    ]);

            $address = CustomerAddress::create([

                'customer_id' => $customer->id,

                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,

                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,

                'state_id' => $request->state_id,
                'city_id' => $request->city_id,

                'pincode' => $request->pincode,

                'address_type' => 'home',

                'is_default' => 1,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Recalculate GST Using New Address
            |--------------------------------------------------------------------------
            */

            $cart = Cart::where(
                'user_id',
                $customer->id
            )->first();

            if ($cart) {

                $cart->recalculateTotals();
                $cart->refresh();
            }
        }

        $cart = Cart::with([
            'items.product'
        ])
            ->where('user_id', $customer->id)
            ->first();

        if (!$cart || $cart->items->count() == 0) {

            return response()->json([
                'success' => false,
                'message' => 'Cart is empty.'
            ]);
        }

        DB::beginTransaction();

        try {

            $order = Order::create([

                'customer_id' => $customer->id,
                'address_id' => $address->id,

                'order_number' =>
                    'ORD-' . strtoupper(uniqid()),

                'customer_name' => $address->name,
                'customer_email' => $address->email,
                'customer_phone' => $address->phone,

                'address_line_1' => $address->address_line_1,
                'address_line_2' => $address->address_line_2,

                'state_id' => $address->state_id,
                'city_id' => $address->city_id,
                'pincode' => $address->pincode,

                'coupon_code' => $cart->coupon_code,

                'subtotal' => $cart->subtotal,
                'discount' => $cart->discount,
                'tax_amount' => $cart->tax_amount,
                'grand_total' => $cart->grand_total,

                'gst_type' => $cart->gst_type,

                'cgst_rate' => $cart->cgst_rate,
                'sgst_rate' => $cart->sgst_rate,
                'igst_rate' => $cart->igst_rate,

                'cgst_amount' => $cart->cgst_amount,
                'sgst_amount' => $cart->sgst_amount,
                'igst_amount' => $cart->igst_amount,

                'payment_method' => $request->payment_method,

                'payment_status' =>
                    $request->payment_method == 'cod'
                    ? 'pending'
                    : 'pending',

                'status' => 'pending',
            ]);

            $order->statusHistory()->create([
                'status' => 'pending',
                'remarks' => 'Order placed successfully',
            ]);

            \App\Models\Notification::create([
                'customer_id' => $customer->id,
                'title' => 'Order Placed',
                'message' => 'Your order ' . $order->order_number . ' has been placed successfully.',
                'icon' => 'fa-cart-shopping',
                'color' => 'order-icon',
                'data' => [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'status' => 'pending',
                ],
            ]);

            foreach ($cart->items as $item) {

                OrderItem::create([

                    'order_id' => $order->id,

                    'product_id' => $item->product_id,
                    'variant_id' => $item->variant_id,

                    'product_name' =>
                        $item->product->name ?? 'Product',

                    'quantity' => $item->quantity,

                    'price' => $item->price,

                    'total' => $item->total,
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | COD Order
            |--------------------------------------------------------------------------
            */

            if ($request->payment_method == 'cod') {

                $invoiceNumber =
                    AdminSettingController::generateInvoiceNumber();

                Invoice::create([
                    'order_id' => $order->id,
                    'invoice_number' => $invoiceNumber,
                    'invoice_date' => now()->toDateString(),

                    'customer_name' => $order->customer_name,
                    'customer_email' => $order->customer_email,
                    'customer_phone' => $order->customer_phone,

                    'billing_address' => collect([
                        $order->address_line_1,
                        $order->address_line_2,
                        $order->city?->name ?? '',
                        $order->state?->name ?? '',
                        $order->pincode,
                    ])->filter()->implode(', '),

                    'subtotal' => $order->subtotal,
                    'discount' => $order->discount,
                    'tax_amount' => $order->tax_amount,
                    'grand_total' => $order->grand_total,

                    'gst_type' => $order->gst_type,

                    'cgst_rate' => $order->cgst_rate,
                    'sgst_rate' => $order->sgst_rate,
                    'igst_rate' => $order->igst_rate,

                    'cgst_amount' => $order->cgst_amount,
                    'sgst_amount' => $order->sgst_amount,
                    'igst_amount' => $order->igst_amount,

                    'status' => 'generated',
                ]);

                $cart->items()->delete();
                $cart->delete();

                // COD — deduct stock before committing
                $this->deductOrderStock($order);
                $this->alertService->sendAlertEmailIfNeeded(); // ← add this


                DB::commit();

                $this->sendOrderEmails($order);

                return response()->json([
                    'success' => true,
                    'type' => 'cod',
                    'message' => 'Order placed successfully.',
                    'redirect_url' => route(
                        'order.success',
                        $order->id
                    )
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Razorpay Order
            |--------------------------------------------------------------------------
            */

            $paymentSetting = PaymentSetting::first();

            $keyId = $paymentSetting->live_mode
                ? $paymentSetting->live_key_id
                : $paymentSetting->test_key_id;

            $keySecret = $paymentSetting->live_mode
                ? $paymentSetting->live_key_secret
                : $paymentSetting->test_key_secret;

            $api = new Api(
                $keyId,
                $keySecret
            );

            $razorpayOrder = $api->order->create([

                'receipt' => $order->order_number,

                'amount' =>
                    round($order->grand_total * 100),

                'currency' => 'INR',

                'payment_capture' => 1
            ]);

            $order->update([
                'razorpay_order_id' =>
                    $razorpayOrder['id']
            ]);

            DB::commit();

            return response()->json([

                'success' => true,

                'type' => 'razorpay',

                'order_id' => $order->id,

                'razorpay_order_id' =>
                    $razorpayOrder['id'],

                'amount' =>
                    round($order->grand_total * 100),

                'key' => $keyId,

                'customer_name' =>
                    $order->customer_name,

                'customer_email' =>
                    $order->customer_email,

                'customer_phone' =>
                    $order->customer_phone,
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    public function razorpaySuccess(Request $request)
    {
        $request->validate([

            'order_id' => 'required|exists:orders,id',

            'razorpay_payment_id' => 'required',

            'razorpay_order_id' => 'required',

            'razorpay_signature' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $order = Order::with('items')
                ->findOrFail($request->order_id);

            /*
            |--------------------------------------------------------------------------
            | Verify Signature
            |--------------------------------------------------------------------------
            */

            $paymentSetting = PaymentSetting::first();

            $keyId = $paymentSetting->live_mode
                ? $paymentSetting->live_key_id
                : $paymentSetting->test_key_id;

            $keySecret = $paymentSetting->live_mode
                ? $paymentSetting->live_key_secret
                : $paymentSetting->test_key_secret;

            $api = new Api(
                $keyId,
                $keySecret
            );

            $attributes = [

                'razorpay_order_id' =>
                    $request->razorpay_order_id,

                'razorpay_payment_id' =>
                    $request->razorpay_payment_id,

                'razorpay_signature' =>
                    $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature(
                $attributes
            );

            /*
            |--------------------------------------------------------------------------
            | Mark Order Paid
            |--------------------------------------------------------------------------
            */

            $order->update([

                'payment_status' => 'paid',

                'razorpay_payment_id' =>
                    $request->razorpay_payment_id,

                'razorpay_signature' =>
                    $request->razorpay_signature,

                'transaction_id' =>
                    $request->razorpay_payment_id,

                'status' => 'processing',
            ]);

            $order->statusHistory()->create([
                'status' => 'processing',
                'remarks' => 'Payment received successfully via Razorpay',
            ]);


            \App\Models\Notification::create([
                'customer_id' => $order->customer_id,
                'title' => 'Payment Successful',
                'message' => 'Payment received for order ' . $order->order_number . '. Your order is now being processed.',
                'icon' => 'fa-credit-card',
                'color' => 'success-icon',
                'data' => [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'status' => 'processing',
                ],
            ]);

            /*
            |--------------------------------------------------------------------------
            | Generate Invoice
            |--------------------------------------------------------------------------
            */

            if (!$order->invoice) {

                $invoiceNumber =
                    AdminSettingController::generateInvoiceNumber();

                Invoice::create([

                    'order_id' => $order->id,

                    'invoice_number' =>
                        $invoiceNumber,

                    'invoice_date' =>
                        now()->toDateString(),

                    'customer_name' =>
                        $order->customer_name,

                    'customer_email' =>
                        $order->customer_email,

                    'customer_phone' =>
                        $order->customer_phone,

                    'billing_address' =>
                        collect([
                            $order->address_line_1,
                            $order->address_line_2,
                            $order->city?->name ?? '',
                            $order->state?->name ?? '',
                            $order->pincode,
                        ])->filter()->implode(', '),

                    'subtotal' =>
                        $order->subtotal,

                    'discount' =>
                        $order->discount,

                    'tax_amount' =>
                        $order->tax_amount,

                    'grand_total' =>
                        $order->grand_total,

                    'gst_type' =>
                        $order->gst_type,

                    'cgst_rate' =>
                        $order->cgst_rate,

                    'sgst_rate' =>
                        $order->sgst_rate,

                    'igst_rate' =>
                        $order->igst_rate,

                    'cgst_amount' =>
                        $order->cgst_amount,

                    'sgst_amount' =>
                        $order->sgst_amount,

                    'igst_amount' =>
                        $order->igst_amount,

                    'status' => 'generated',
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Clear Cart
            |--------------------------------------------------------------------------
            */

            $cart = Cart::where(
                'user_id',
                $order->customer_id
            )->first();

            if ($cart) {

                $cart->items()->delete();

                $cart->delete();
            }

            // Razorpay — deduct stock after payment verified, before committing
            $this->deductOrderStock($order);
            $this->alertService->sendAlertEmailIfNeeded(); // ← add this


            DB::commit();

            $this->sendOrderEmails($order);

            return response()->json([

                'success' => true,

                'redirect_url' =>
                    route(
                        'order.success',
                        $order->id
                    ),
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([

                'success' => false,

                'message' =>
                    $e->getMessage()
            ], 422);
        }
    }

    public function orderSuccess(Order $order)
    {
        return view(
            'front-pages.thank-you',
            compact('order')
        );
    }


    protected function sendOrderEmails(Order $order)
    {
        $smtpSetting = SmtpSetting::first();

        if (!$smtpSetting) {
            return;
        }

        MailHelper::configure();

        if ($smtpSetting->order_confirmation) {

            Mail::to($order->customer_email)
                ->send(
                    new OrderConfirmationMail($order)
                );
        }

        if ($smtpSetting->new_order_alert) {

            $setting = Setting::first();

            Mail::to($setting->admin_email)->send(
                new NewOrderAdminMail($order)
            );
        }
    }


    protected function deductOrderStock(Order $order): void
    {
        /** @var \App\Services\StockService $stockService */
        $stockService = app(\App\Services\StockService::class);

        foreach ($order->items as $item) {
            $product = $item->product;

            if (!$product)
                continue;

            try {
                $stockService->debit(
                    $product,
                    $item->quantity,
                    'order',
                    $order,           // reference — links history entry to this order
                    null,             // no admin user, this is a customer action
                    null,             // no note
                    true              // allowNegative: true so an order never fails due to stock race
                );
            } catch (\Exception $e) {
                // Log but don't block the order — stock can be corrected manually
                \Log::warning("Stock debit failed for product {$product->id} on order {$order->id}: " . $e->getMessage());
            }
        }
    }

}