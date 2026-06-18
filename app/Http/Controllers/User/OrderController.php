<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\InvoiceSetting;
use App\Models\Order;
use App\Models\OrderReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Authenticated customer shorthand.
     */
    private function customer()
    {
        return Auth::guard('customer')->user();
    }

    /**
     * Guard: make sure the order belongs to this customer.
     */
    private function findOrder(int $id): Order
    {
        return Order::with([
            'items.product.images',
            'invoice',
            'city',
            'state',
        ])
            ->where('customer_id', $this->customer()->id)
            ->findOrFail($id);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // LIST
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * GET /user/orders
     */
    public function index()
    {
        $customer = $this->customer();

        // All orders eager-loaded; tabs filter client-side via JS
        $orders = $customer->orders()
            ->with(['items.product.images', 'invoice', 'statusHistory'])
            ->latest()
            ->get();

        $returnReasons = \App\Models\ReturnReason::where('is_active', 1)->orderBy('sort_order')->get();

        return view('user.orders.index', compact('orders', 'returnReasons'));
    }

    // ─────────────────────────────────────────────────────────────────────────
    // DETAIL
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * GET /user/orders/{order}
     */
    public function show(int $id)
    {
        $order = $this->findOrder($id);

        $returnReasons = \App\Models\ReturnReason::where('is_active', 1)->orderBy('sort_order')->get();

        return view('user.orders.show', compact('order', 'returnReasons'));
    }

    // ─────────────────────────────────────────────────────────────────────────
    // INVOICE
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * GET /user/orders/{order}/invoice
     * Streams a PDF invoice to the browser.
     * Requires: barryvdh/laravel-dompdf  (composer require barryvdh/laravel-dompdf)
     */
    public function invoice(int $id)
    {
        $order = $this->findOrder($id);

        // Only allow invoice download when one exists
        if (!$order->invoice) {
            return back()->with('error', 'Invoice is not available for this order yet.');
        }

        $order->load([
            'items.product',
            'items.variant.values.attributeValue.attribute',
            'state',
            'city',
        ]);

        $setting = InvoiceSetting::with([
            'state',
            'city'
        ])->first();


        $logo_64 = null;

        if ($setting?->company_logo) {
            $logoPath = storage_path('app/public/' . $setting->company_logo);

            if (file_exists($logoPath)) {
                $mime = mime_content_type($logoPath);

                $logo_64 = 'data:' . $mime . ';base64,' .
                    base64_encode(file_get_contents($logoPath));
            }
        }


        $pdf = Pdf::loadView('user.orders.invoice', [
            'order' => $order,
            'invoice' => $order->invoice,
            'setting' => $setting,
            'isPdf' => true,   // hides the print bar in the view
            'logo_64' => $logo_64,
        ])
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont' => 'DejaVu Sans',
                'isRemoteEnabled' => false,
                'isHtml5ParserEnabled' => true,
                'dpi' => 150,
            ]);

        $filename = 'Invoice-' . $order->invoice->invoice_number . '.pdf';

        return $pdf->download($filename);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // RETURN / EXCHANGE
    // ─────────────────────────────────────────────────────────────────────────

    public function submitReturn(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'order_item_id' => 'required|integer',
            'return_reason_id' => 'required|exists:return_reasons,id',
            'type' => 'required|in:return,exchange',
            'details' => 'nullable|string|max:1000',

            // Refund method
            'refund_method' => 'required|in:upi,qr,bank',

            // UPI
            'upi_id' => 'required_if:refund_method,upi|nullable|string|max:100',

            // QR
            'qr_image' => 'required_if:refund_method,qr|nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            // Bank
            'bank_name' => 'required_if:refund_method,bank|nullable|string|max:100',
            'account_name' => 'required_if:refund_method,bank|nullable|string|max:100',
            'account_number' => 'required_if:refund_method,bank|nullable|string|max:30',
            'ifsc_code' => 'required_if:refund_method,bank|nullable|string|max:20',
            'bank_branch' => 'nullable|string|max:100',
            'account_type' => 'required_if:refund_method,bank|nullable|in:savings,current,salary',
        ]);

        $customer = Auth::guard('customer')->user();

        // Verify the order belongs to this customer
        $order = $customer->orders()->findOrFail($request->order_id);

        // Verify the item belongs to this order
        $item = $order->items()->findOrFail($request->order_item_id);

        // Enforce 7-day window
        abort_if(
            $order->created_at->diffInDays(now()) > 7,
            403,
            'Return window has expired.'
        );

        // Prevent duplicate requests for the same item
        $already = OrderReturn::where('order_item_id', $item->id)
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($already) {
            return back()->with('error', 'A return request for this item is already in progress.');
        }

        // Handle QR upload
        $qrPath = null;
        if ($request->refund_method === 'qr' && $request->hasFile('qr_image')) {
            $qrPath = $request->file('qr_image')->store('returns/qr', 'public');
        }

        OrderReturn::create([
            'order_id' => $order->id,
            'order_item_id' => $item->id,
            'customer_id' => $customer->id,
            'return_reason_id' => $request->return_reason_id,
            'type' => $request->type,
            'details' => $request->details,
            'status' => 'pending',
            // Refund info
            'refund_method' => $request->refund_method,
            'upi_id' => $request->refund_method === 'upi' ? $request->upi_id : null,
            'qr_image' => $request->refund_method === 'qr' ? $qrPath : null,
            'bank_name' => $request->refund_method === 'bank' ? $request->bank_name : null,
            'account_name' => $request->refund_method === 'bank' ? $request->account_name : null,
            'account_number' => $request->refund_method === 'bank' ? $request->account_number : null,
            'ifsc_code' => $request->refund_method === 'bank' ? $request->ifsc_code : null,
            'bank_branch' => $request->refund_method === 'bank' ? $request->bank_branch : null,
            'account_type' => $request->refund_method === 'bank' ? $request->account_type : null,
        ]);

        return back()->with('success', 'Return request submitted. We\'ll process your refund within 3–5 business days.');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // REORDER
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * GET /user/orders/{order}/reorder
     * Adds all in-stock items from a previous order back into the cart,
     * then redirects to cart.
     */
    public function reorder(int $id)
    {
        $order = $this->findOrder($id);
        $customer = $this->customer();

        $added = 0;
        $skipped = [];

        foreach ($order->items as $item) {
            $product = $item->product;

            // Skip if product was deleted or is out of stock
            if (!$product || $product->stock < 1) {
                $skipped[] = $item->product_name;
                continue;
            }

            // Upsert into cart (assumes a Cart / CartItem model)
            $cart = $customer->cart()->firstOrCreate([]);

            $cartItem = $cart->items()->where('product_id', $product->id)->first();

            if ($cartItem) {
                // Clamp qty to available stock
                $newQty = min($cartItem->quantity + $item->quantity, $product->stock);
                $cartItem->update(['quantity' => $newQty]);
            } else {
                $cart->items()->create([
                    'product_id' => $product->id,
                    'quantity' => min($item->quantity, $product->stock),
                    'price' => $product->price,
                ]);
            }

            $added++;
        }

        if ($added === 0) {
            return redirect()->route('user.orders.index')
                ->with('error', 'None of the items from this order are currently available.');
        }

        $message = "{$added} " . Str::plural('item', $added) . " added to your cart.";

        if (!empty($skipped)) {
            $message .= ' Unavailable: ' . implode(', ', $skipped) . '.';
        }

        return redirect()->route('cart.index')->with('success', $message);
    }
}