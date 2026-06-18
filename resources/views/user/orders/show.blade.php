@extends('layouts.user-app')

@section('title', 'Order #' . $order->order_number)

@section('content')

@php
    $status = strtolower($order->status);

    $trackerSteps = ['Order Placed', 'Processing', 'Shipped', 'Delivered'];
    $trackerIcons = [
        'Order Placed' => 'fa-solid fa-check',
        'Processing'   => 'fa-solid fa-box-open',
        'Shipped'      => 'fa-solid fa-truck-fast',
        'Delivered'    => 'fa-solid fa-house',
    ];
    $activeStepMap = ['pending' => 0, 'processing' => 1, 'shipped' => 2, 'delivered' => 3];
    $activeStep    = $activeStepMap[$status] ?? -1;
    $isCancelled   = $status === 'cancelled';
    $isDelivered   = $status === 'delivered';

    $statusBadge = [
        'pending'    => 'status-processing',
        'processing' => 'status-processing',
        'shipped'    => 'status-shipped',
        'delivered'  => 'status-delivered',
        'cancelled'  => 'status-cancelled',
    ];

    $paymentIcons = [
        'razorpay'   => 'fa-solid fa-credit-card',
        'upi'        => 'fa-solid fa-building-columns',
        'cod'        => 'fa-solid fa-money-bill-wave',
        'netbanking' => 'fa-solid fa-building-columns',
        'card'       => 'fa-solid fa-credit-card',
    ];
    $paymentKey  = strtolower($order->payment_method ?? 'cod');
    $paymentIcon = $paymentIcons[$paymentKey] ?? 'fa-solid fa-credit-card';
@endphp

<div class="aq-modern-content aq-orders-page">

    <!-- Back + Header -->
    <div class="aq-page-header d-flex align-items-center gap-3 flex-wrap">
        <a href="{{ route('user.orders.index') }}" class="aq-btn-invoice" style="padding: 8px 16px;">
            <i class="fa-solid fa-arrow-left"></i> Back to Orders
        </a>
        <div>
            <h2 class="mb-0">Order #{{ $order->order_number }}</h2>
            <p class="mb-0">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
        </div>
        <span class="aq-order-status {{ $statusBadge[$status] ?? '' }} ms-auto">
            {{ ucfirst($order->status) }}
        </span>
    </div>

    <div class="row g-4 mt-1">

        <!-- Left Column -->
        <div class="col-lg-8">

            <!-- Tracker -->
            @if (!$isCancelled)
                <div class="aq-modern-card mb-4" style="height:auto;">
                    <div class="aq-card-header"><h3>Order Progress</h3></div>
                    <div class="aq-card-body">
                        <div class="aq-order-tracker">
                            @foreach ($trackerSteps as $i => $step)
                                @php
                                    $isCompleted = $i < $activeStep;
                                    $isActive    = $i === $activeStep;
                                    $stepClass   = $isCompleted ? 'completed' : ($isActive ? 'active' : '');
                                @endphp
                                <div class="aq-order-tracker-step {{ $stepClass }}">
                                    <div class="aq-order-tracker-icon">
                                        <i class="{{ $isCompleted ? 'fa-solid fa-check' : $trackerIcons[$step] }}"></i>
                                    </div>
                                    <span class="aq-order-tracker-label">{{ $step }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Items -->
            <div class="aq-modern-card mb-4" style="height:auto;">
                <div class="aq-card-header">
                    <h3>Items Ordered</h3>
                    <span class="text-muted" style="font-size:13px;">{{ $order->items->count() }} {{ Str::plural('item', $order->items->count()) }}</span>
                </div>
                <div class="aq-card-body p-0">
                    <div class="aq-order-items" style="padding: 0;">
                        @foreach ($order->items as $item)
                            <div class="aq-order-item" style="border-bottom: 1px solid var(--aq-border); padding: 16px 20px;">
                                <img
                                    src="{{ $item->product?->display_image ?? asset('assets/img/corporate/placeholder.png') }}"
                                    alt="{{ $item->product_name }}"
                                    style="width:72px;height:72px;object-fit:cover;border-radius:8px;"
                                >
                                <div class="aq-order-item-details" style="flex:1;">
                                    <h4 style="margin-bottom:4px;">{{ $item->product_name }}</h4>
                                   @php
    $variantLabel = $item->variant && $item->variant->values->isNotEmpty()
        ? $item->variant->values
            ->map(fn($v) =>
                optional($v->attributeValue?->attribute)->name
                . ': ' .
                ($v->attributeValue->value ?? '')
            )
            ->join(' | ')
        : null;
@endphp

<p style="color:#888;font-size:13px;margin:0;">
    @if($variantLabel)
        {{ $variantLabel }} |
    @endif
    Qty: {{ $item->quantity }}
</p>
                                    @if ($item->sku)
                                        <p style="color:#aaa;font-size:12px;margin:2px 0 0;">SKU: {{ $item->sku }}</p>
                                    @endif
                                </div>
                                <div style="text-align:right;">
                                    <div class="aq-order-item-price">₹ {{ number_format($item->price) }}</div>
                                    @if ($item->quantity > 1)
                                        <small style="color:#aaa;">× {{ $item->quantity }} = ₹ {{ number_format($item->price * $item->quantity) }}</small>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Delivery Address -->
            <div class="aq-modern-card" style="height:auto;">
                <div class="aq-card-header"><h3>Delivery Address</h3></div>
                <div class="aq-card-body">
                    <p style="font-weight:600;margin-bottom:4px;">{{ $order->customer_name }}</p>
                    <p style="color:#666;margin:0;line-height:1.7;">
                        {{ $order->address_line_1 }}
                        @if ($order->address_line_2), {{ $order->address_line_2 }}@endif<br>
                        {{ $order->city?->name }}, {{ $order->state?->name }} – {{ $order->pincode }}<br>
                        <i class="fa-solid fa-phone" style="font-size:12px;"></i> {{ $order->customer_phone }}
                    </p>
                </div>
            </div>

        </div>

        <!-- Right Column: Summary -->
        <div class="col-lg-4">

            <!-- Price Breakdown -->
            <div class="aq-modern-card mb-4" style="height:auto;">
                <div class="aq-card-header"><h3>Price Summary</h3></div>
                <div class="aq-card-body">
                    <table style="width:100%;font-size:14px;border-collapse:collapse;">
                        <tr>
                            <td style="padding:6px 0;color:#666;">Subtotal</td>
                            <td style="padding:6px 0;text-align:right;">₹ {{ number_format($order->subtotal) }}</td>
                        </tr>
                        @if ($order->discount > 0)
                            <tr>
                                <td style="padding:6px 0;color:#2ecc71;">
                                    Discount
                                    @if ($order->coupon_code)
                                        <span style="font-size:11px;">({{ $order->coupon_code }})</span>
                                    @endif
                                </td>
                                <td style="padding:6px 0;text-align:right;color:#2ecc71;">
                                    − ₹ {{ number_format($order->discount) }}
                                </td>
                            </tr>
                        @endif
                        @if ($order->tax_amount > 0)
                            <tr>
                                <td style="padding:6px 0;color:#666;">
                                    Tax
                                    @if ($order->gst_type === 'igst')
                                        <span style="font-size:11px;">(IGST {{ $order->igst_rate }}%)</span>
                                    @else
                                        <span style="font-size:11px;">(CGST {{ $order->cgst_rate }}% + SGST {{ $order->sgst_rate }}%)</span>
                                    @endif
                                </td>
                                <td style="padding:6px 0;text-align:right;">₹ {{ number_format($order->tax_amount) }}</td>
                            </tr>
                        @endif
                        <tr style="border-top:1px solid var(--aq-border);">
                            <td style="padding:10px 0 0;font-weight:700;font-size:16px;">Grand Total</td>
                            <td style="padding:10px 0 0;text-align:right;font-weight:700;font-size:16px;">
                                ₹ {{ number_format($order->grand_total) }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="aq-modern-card mb-4" style="height:auto;">
                <div class="aq-card-header"><h3>Payment</h3></div>
                <div class="aq-card-body">
                    <p style="margin:0 0 6px;">
                        <i class="{{ $paymentIcon }}"></i>
                        {{ ucfirst(str_replace('_', ' ', $order->payment_method ?? 'N/A')) }}
                    </p>
                    <p style="margin:0;font-size:13px;color:#666;">
                        Status:
                        <span style="font-weight:600;color:{{ $order->payment_status === 'paid' ? '#2ecc71' : ($order->payment_status === 'refunded' ? '#f39c12' : '#ff4757') }};">
                            {{ ucfirst($order->payment_status ?? 'N/A') }}
                        </span>
                    </p>
                    @if ($order->transaction_id)
                        <p style="margin:4px 0 0;font-size:12px;color:#aaa;">
                            Txn ID: {{ $order->transaction_id }}
                        </p>
                    @endif
                </div>
            </div>


            @php
    $returnRequest = $order->returns()
        ->with([
            'returnReason',
            'refundTransaction',
            'orderItem.product'
        ])
        ->latest()
        ->first();
@endphp

@if($returnRequest)

<div class="aq-modern-card mb-4" style="height:auto;">
    <div class="aq-card-header">
        <h3>Return Request</h3>
    </div>

    <div class="aq-card-body">

        <div class="mb-3">
            <strong>Status:</strong>
            <span class="badge bg-secondary">
                {{ ucfirst($returnRequest->status) }}
            </span>
        </div>

        <div class="mb-2">
            <strong>Product:</strong><br>
            {{ $returnRequest->orderItem?->product?->name ?? $returnRequest->orderItem?->product_name }}
        </div>

        <div class="mb-2">
            <strong>Reason:</strong><br>
            {{ $returnRequest->returnReason?->title ?? '-' }}
        </div>

        @if($returnRequest->details)
            <div class="mb-2">
                <strong>Customer Notes:</strong><br>
                {{ $returnRequest->details }}
            </div>
        @endif

        <div class="mb-2">
            <strong>Requested On:</strong><br>
            {{ $returnRequest->created_at->format('d M Y h:i A') }}
        </div>

    </div>
</div>
<div class="aq-modern-card mb-4" style="height:auto;">
    <div class="aq-card-header">
        <h3>Refund Destination</h3>
    </div>

    <div class="aq-card-body">

        <p>
            <strong>Method:</strong>
            {{ strtoupper($returnRequest->refund_method ?? '-') }}
        </p>

        @if($returnRequest->refund_method === 'upi')
            <p>
                <strong>UPI ID:</strong>
                {{ $returnRequest->upi_id }}
            </p>

        @elseif($returnRequest->refund_method === 'bank')

            <p><strong>Bank:</strong> {{ $returnRequest->bank_name }}</p>
            <p><strong>Account Holder:</strong> {{ $returnRequest->account_name }}</p>
            <p><strong>Account Number:</strong> {{ $returnRequest->account_number }}</p>
            <p><strong>IFSC:</strong> {{ $returnRequest->ifsc_code }}</p>

        @elseif($returnRequest->refund_method === 'qr')

            @if($returnRequest->qr_image)
                <a href="{{ asset('storage/'.$returnRequest->qr_image) }}"
                   target="_blank"
                   class="aq-btn-track">
                    View QR Code
                </a>
            @endif

        @endif

    </div>
</div>@if($returnRequest->refundTransaction)

<div class="aq-modern-card mb-4" style="height:auto;">
    <div class="aq-card-header">
        <h3>Refund Information</h3>
    </div>

    <div class="aq-card-body">

        <div class="mb-2">
            <strong>Refund Amount:</strong><br>
            ₹{{ number_format($returnRequest->refundTransaction->amount, 2) }}
        </div>

        <div class="mb-2">
            <strong>UTR Number:</strong><br>
            {{ $returnRequest->refundTransaction->utr_id }}
        </div>

        <div class="mb-2">
            <strong>Refund Method Used:</strong><br>
            {{ strtoupper($returnRequest->refundTransaction->refund_method) }}
        </div>

        <div class="mb-2">
            <strong>Refund Date:</strong><br>
            {{ $returnRequest->refundTransaction->created_at->format('d M Y h:i A') }}
        </div>

        @if($returnRequest->refundTransaction->remarks)
            <div class="mb-2">
                <strong>Remarks:</strong><br>
                {{ $returnRequest->refundTransaction->remarks }}
            </div>
        @endif

        @if($returnRequest->refundTransaction->payment_proof)
            <a href="{{ asset('storage/'.$returnRequest->refundTransaction->payment_proof) }}"
               target="_blank"
               class="aq-btn-track">
                View Refund Proof
            </a>
        @endif

    </div>
</div>

@endif
@endif
            <!-- Actions -->
            <div class="aq-modern-card" style="height:auto;">
                <div class="aq-card-header"><h3>Actions</h3></div>
                <div class="aq-card-body d-flex flex-column gap-2">

                    @if ($order->invoice)
                        <a href="{{ route('user.orders.invoice', $order->id) }}" class="aq-btn-track text-center" target="_blank">
                            <i class="fa-solid fa-file-invoice"></i> Download Invoice
                        </a>
                    @endif

                    @if (in_array($status, ['processing', 'shipped']))
                       <a href="#"
   class="aq-btn-track text-center"
   data-bs-toggle="modal"
   data-bs-target="#trackOrderModal"
   data-order-number="{{ $order->order_number }}"
   data-order-status="{{ $order->status }}"
   data-order-date="{{ $order->created_at->format('M d, Y') }}"
   data-tracking-number="{{ $order->tracking_number }}"
   data-status-history='@json(
    $order->statusHistory->map(fn($h) => [
        "status" => $h->status,
        "time" => $h->created_at->format("d M Y h:i A"),
    ])
)'
><i class="fa-solid fa-location-crosshairs"></i> Track Order
                        </a>
                    @endif


                       @if ($isDelivered && $order->created_at->diffInDays(now()) <= 7)
                                        @php
                                            $existingReturn = $order->returns()
                                                ->whereIn('status', ['pending', 'approved', 'completed'])
                                                ->first();
                                        @endphp

                                        @if ($existingReturn)
                                            <span class="aq-btn-invoice text-center" style="opacity:.55;cursor:not-allowed;">
                                                <i class="fa-solid fa-arrow-rotate-left"></i>
                                                Return {{ ucfirst($existingReturn->status) }} 
                                            </span>
                                        @else
                                            <a href="#" class="aq-btn-invoice text-center" data-bs-toggle="modal" data-bs-target="#returnModal"
                                                data-order-id="{{ $order->id }}" data-order-number="{{ $order->order_number }}"
                                                data-order-items="{{ $order->items->pluck('product_name', 'id')->toJson() }}">
                                                <i class="fa-solid fa-arrow-rotate-left"></i> Return
                                            </a>
                                        @endif
                                    @endif

                    @if ($isCancelled)
                        <a href="{{ route('user.orders.reorder', $order->id) }}" class="aq-btn-invoice text-center">
                            <i class="fa-solid fa-cart-shopping"></i> Reorder
                        </a>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Track Order Modal (same as index) -->
<div class="modal fade aq-premium-modal track-order-modal" id="trackOrderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:400px;">
        <div class="modal-content">
            <button type="button" class="btn-close position-absolute" style="top:20px;right:20px;z-index:10;"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="p-4">
                <h3 class="font-family-heading mb-1">Track Your Order</h3>
                <p class="text-muted mb-4" id="trackOrderMeta"></p>
                <div id="trackingInfo"
     class="mb-3"
     style="display:none;padding:10px 12px;background:#f8f9fa;border-radius:8px;">
    <strong>Tracking Number:</strong>
    <span id="trackingNumber"></span>
</div>
                <div class="aq-order-tracker" style="flex-direction:column;align-items:flex-start;gap:20px;padding-left:20px;margin:20px 0;">
                   @foreach ([
    ['label' => 'Pending',    'icon' => 'fa-solid fa-clock'],
    ['label' => 'Processing', 'icon' => 'fa-solid fa-box-open'],
    ['label' => 'Shipped',    'icon' => 'fa-solid fa-truck-fast'],
    ['label' => 'Delivered',  'icon' => 'fa-solid fa-house'],
] as $ms)
                        <div class="aq-order-tracker-step track-modal-step" style="flex-direction:row;gap:15px;padding:0;">
                            <div class="aq-order-tracker-icon" style="width:35px;height:35px;min-width:35px;">
                                <i class="{{ $ms['icon'] }}"></i>
                            </div>
                            <div>
                                <span class="aq-order-tracker-label d-block text-dark">{{ $ms['label'] }}</span>
                                <small class="text-muted track-modal-time">—</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


   {{-- ══════════════════════════════════════════════════════════════
    2. RETURN MODAL — replace the entire #returnModal div
    NOTE: form has enctype because QR upload is a file
    ══════════════════════════════════════════════════════════════ --}}
    <div class="modal fade aq-premium-modal return-modal" id="returnModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width:460px;">
            <div class="modal-content">
                <button type="button" class="btn-close position-absolute" style="top:20px;right:20px;z-index:10;"
                    data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="p-4" style="max-height:88vh;overflow-y:auto;">
                    <h3 class="font-family-heading mb-1">Return or Exchange</h3>
                    <p class="text-muted mb-4" id="returnOrderMeta"></p>

                    <form action="{{ route('user.orders.return') }}" method="POST" enctype="multipart/form-data"
                        id="returnForm">
                        @csrf
                        <input type="hidden" name="order_id" id="returnOrderId">

                        {{-- ── Item ── --}}
                        <div class="rtn-field-group">
                            <label class="rtn-label">Select Item <span class="rtn-req">*</span></label>
                            <select class="rtn-select" name="order_item_id" id="returnItemSelect" required>
                                <option value="" disabled selected>Select an item</option>
                            </select>
                        </div>

                        {{-- ── Type toggle ── --}}
                        <div class="rtn-field-group">
                            <label class="rtn-label">Request Type <span class="rtn-req">*</span></label>
                            <div class="rtn-type-row">
                                <label class="rtn-type-opt">
                                    <input type="radio" name="type" value="return" checked>
                                    <span class="rtn-type-btn">
                                        <i class="fa-solid fa-arrow-rotate-left"></i> Return
                                    </span>
                                </label>
                            </div>
                        </div>

                        {{-- ── Reason ── --}}
                        <div class="rtn-field-group">
                            <label class="rtn-label">Reason <span class="rtn-req">*</span></label>
                            <select class="rtn-select" name="return_reason_id" required>
                                <option value="" disabled selected>Select a reason</option>
                                @foreach ($returnReasons as $reason)
                                    <option value="{{ $reason->id }}">{{ $reason->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- ── Details ── --}}
                        <div class="rtn-field-group">
                            <label class="rtn-label">Additional Details</label>
                            <textarea class="rtn-textarea" name="details" rows="2"
                                placeholder="Describe the issue…"></textarea>
                        </div>

                        {{-- ════════════════════════════════════════════════════
                        REFUND INFO SECTION
                        ════════════════════════════════════════════════════ --}}
                        <div class="rtn-divider">
                            <span>Refund Information</span>
                        </div>

                        {{-- ── Refund method dropdown ── --}}
                        <div class="rtn-field-group">
                            <label class="rtn-label">Refund Via <span class="rtn-req">*</span></label>
                            <select class="rtn-select" name="refund_method" id="refundMethod" required
                                onchange="switchRefundMethod(this.value)">
                                <option value="" disabled selected>Select bank info type</option>
                                <option value="upi">UPI ID</option>
                                <option value="qr">QR Code</option>
                                <option value="bank">Bank Details</option>
                            </select>
                        </div>

                        {{-- ── UPI panel ── --}}
                        <div id="rtnPanelUpi" class="rtn-panel" style="display:none;">
                            <div class="rtn-field-group">
                                <label class="rtn-label">UPI ID <span class="rtn-req">*</span></label>
                                <div class="rtn-input-icon-wrap">
                                    <i class="fa-solid fa-building-columns rtn-input-icon"></i>
                                    <input type="text" class="rtn-input rtn-input-icon-pad" name="upi_id"
                                        placeholder="yourname@upi" id="upiIdField">
                                </div>
                                <div class="rtn-hint">e.g. 9876543210@paytm, name@okaxis</div>
                            </div>
                        </div>

                        {{-- ── QR panel ── --}}
                        <div id="rtnPanelQr" class="rtn-panel" style="display:none;">
                            <div class="rtn-field-group">
                                <label class="rtn-label">Upload QR Code <span class="rtn-req">*</span></label>
                                <div class="rtn-upload-area" id="qrUploadArea"
                                    onclick="document.getElementById('qrFile').click()">
                                    <input type="file" name="qr_image" id="qrFile" accept="image/*" style="display:none"
                                        onchange="previewQr(this)">
                                    <div id="qrPlaceholder">
                                        <i class="fa-solid fa-qrcode" style="font-size:26px;color:#8c9196;"></i>
                                        <p style="margin:6px 0 0;font-size:13px;color:#6d7175;">Click to upload your UPI QR
                                        </p>
                                        <small style="color:#8c9196;">PNG, JPG — max 2 MB</small>
                                    </div>
                                    <div id="qrPreview" style="display:none;text-align:center;">
                                        <img id="qrPreviewImg" src=""
                                            style="max-width:130px;border-radius:8px;border:1px solid #e3e5e8;">
                                        <div style="margin-top:6px;">
                                            <button type="button" onclick="clearQr(event)"
                                                style="font-size:12px;color:#b22222;background:none;border:none;cursor:pointer;padding:0;">
                                                <i class="fa-solid fa-times"></i> Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ── Bank Details panel ── --}}
                        <div id="rtnPanelBank" class="rtn-panel" style="display:none;">

                            <div class="rtn-field-group">
                                <label class="rtn-label">Bank Name <span class="rtn-req">*</span></label>
                                <input type="text" class="rtn-input" name="bank_name"
                                    placeholder="e.g. State Bank of India">
                            </div>

                            <div class="rtn-field-group">
                                <label class="rtn-label">Account Holder Name <span class="rtn-req">*</span></label>
                                <input type="text" class="rtn-input" name="account_name"
                                    placeholder="Name as on bank account">
                            </div>

                            <div class="rtn-2col">
                                <div class="rtn-field-group">
                                    <label class="rtn-label">Account Number <span class="rtn-req">*</span></label>
                                    <input type="text" class="rtn-input" name="account_number"
                                        placeholder="XXXXXXXXXXXXXXXXXX" inputmode="numeric">
                                </div>
                                <div class="rtn-field-group">
                                    <label class="rtn-label">IFSC Code <span class="rtn-req">*</span></label>
                                    <input type="text" class="rtn-input" name="ifsc_code" placeholder="e.g. SBIN0001234"
                                        style="text-transform:uppercase" oninput="this.value=this.value.toUpperCase()">
                                </div>
                            </div>

                            <div class="rtn-2col">
                                <div class="rtn-field-group">
                                    <label class="rtn-label">Branch</label>
                                    <input type="text" class="rtn-input" name="bank_branch"
                                        placeholder="e.g. Connaught Place">
                                </div>
                                <div class="rtn-field-group">
                                    <label class="rtn-label">Account Type <span class="rtn-req">*</span></label>
                                    <select class="rtn-select" name="account_type">
                                        <option value="" disabled selected>Select</option>
                                        <option value="savings">Savings</option>
                                        <option value="current">Current</option>
                                        <option value="salary">Salary</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        {{-- ─────────────────────────────────────────────────── --}}

                        <button type="submit" class="rtn-submit-btn">
                            <i class="fa-solid fa-paper-plane"></i> Submit Return Request
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection



    <style>

    /* Return modal fields */
    .rtn-field-group {
        margin-bottom: 14px;
    }

    .rtn-field-group:last-child {
        margin-bottom: 0;
    }

    .rtn-label {
        display: block;
        font-size: 11.5px;
        font-weight: 600;
        color: #6d7175;
        text-transform: uppercase;
        letter-spacing: .03em;
        margin-bottom: 5px;
    }

    .rtn-req {
        color: #b22222;
        margin-left: 2px;
    }

    .rtn-hint {
        font-size: 11px;
        color: #8c9196;
        margin-top: 3px;
    }

    .rtn-input,
    .rtn-select,
    .rtn-textarea {
        width: 100%;
        border: 1px solid #e3e5e8;
        border-radius: 8px;
        padding: 0 12px;
        height: 38px;
        font-size: 13px;
        color: #202223;
        background: #fff;
        outline: none;
        font-family: inherit;
        transition: border-color .15s, box-shadow .15s;
    }

    .rtn-input:focus,
    .rtn-select:focus,
    .rtn-textarea:focus {
        border-color: var(--aq-color-maroon, #7b1010);
        box-shadow: 0 0 0 3px rgba(123, 16, 16, .1);
    }

    .rtn-textarea {
        height: auto;
        padding: 9px 12px;
        resize: none;
    }

    /* Icon-prefixed input */
    .rtn-input-icon-wrap {
        position: relative;
    }

    .rtn-input-icon {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: #8c9196;
        font-size: 13px;
        pointer-events: none;
    }

    .rtn-input-icon-pad {
        padding-left: 32px !important;
    }

    /* 2-column grid */
    .rtn-2col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    @media(max-width: 480px) {
        .rtn-2col {
            grid-template-columns: 1fr;
        }
    }

    /* Type toggle */
    .rtn-type-row {
        display: flex;
        gap: 8px;
    }

    .rtn-type-opt {
        flex: 1;
        cursor: pointer;
    }

    .rtn-type-opt input[type=radio] {
        display: none;
    }

    .rtn-type-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 9px 12px;
        border: 1.5px solid #e3e5e8;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        color: #6d7175;
        transition: border-color .15s, color .15s, background .15s;
    }

    .rtn-type-opt input[type=radio]:checked+.rtn-type-btn {
        border-color: var(--aq-color-maroon, #7b1010);
        color: var(--aq-color-maroon, #7b1010);
        background: rgba(123, 16, 16, .04);
    }

    /* Divider */
    .rtn-divider {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 18px 0 16px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #8c9196;
    }

    .rtn-divider::before,
    .rtn-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e3e5e8;
    }

    /* QR upload area */
    .rtn-upload-area {
        border: 2px dashed #e3e5e8;
        border-radius: 10px;
        padding: 20px 16px;
        text-align: center;
        cursor: pointer;
        transition: border-color .15s, background .15s;
    }

    .rtn-upload-area:hover {
        border-color: var(--aq-color-maroon, #7b1010);
        background: rgba(123, 16, 16, .03);
    }

    /* Submit */
    .rtn-submit-btn {
        width: 100%;
        margin-top: 18px;
        padding: 12px;
        background: var(--aq-color-maroon, #7b1010);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: opacity .15s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .rtn-submit-btn:hover {
        opacity: .9;
    }
</style>



@push('scripts')
<script>
    document.getElementById('trackOrderModal')?.addEventListener('show.bs.modal', function (e) {
        const t = e.relatedTarget;
        document.getElementById('trackOrderMeta').textContent =
    `Order #${t.dataset.orderNumber} • Placed ${t.dataset.orderDate}`;

const trackingNo = t.dataset.trackingNumber;

if (trackingNo) {
    document.getElementById('trackingInfo').style.display = 'block';
    document.getElementById('trackingNumber').textContent = trackingNo;
} else {
    document.getElementById('trackingInfo').style.display = 'none';
}
        const statusMap = { pending: 0, processing: 1, shipped: 2, delivered: 3 };
        const active = statusMap[t.dataset.orderStatus?.toLowerCase()] ?? 0;
        this.querySelectorAll('.track-modal-step').forEach((step, i) => {
            step.classList.remove('completed', 'active');
            if (i < active) step.classList.add('completed');
            else if (i === active) step.classList.add('active');
        });

         const history = JSON.parse(
    t.dataset.statusHistory || '[]'
);

const times = this.querySelectorAll('.track-modal-time');

times.forEach(el => el.textContent = '—');

const map = {
    pending: 0,
    processing: 1,
    shipped: 2,
    delivered: 3
};

history.forEach(item => {
    const idx = map[item.status];

    if (idx !== undefined && times[idx]) {
        times[idx].textContent = item.time;
    }
});


    });

  

   
</script>

<script>
    // ── Return Modal open ────────────────────────────────────────────
    document.getElementById('returnModal').addEventListener('show.bs.modal', function (e) {
        const trigger = e.relatedTarget;
        const orderId = trigger.dataset.orderId;
        const number = trigger.dataset.orderNumber;
        const items = JSON.parse(trigger.dataset.orderItems || '{}');

        document.getElementById('returnOrderId').value = orderId;
        document.getElementById('returnOrderMeta').textContent =
            `Requesting a return for Order #${number}.`;

        // Populate item select
        const select = document.getElementById('returnItemSelect');
        select.innerHTML = '<option value="" disabled selected>Select an item</option>';
        Object.entries(items).forEach(([id, name]) => {
            const opt = document.createElement('option');
            opt.value = id;
            opt.textContent = name;
            select.appendChild(opt);
        });

        // Reset type toggle
        document.querySelectorAll('.rtn-type-opt input[type=radio]').forEach(r => {
            r.checked = r.value === 'return';
        });

        // Reset refund section
        document.getElementById('refundMethod').value = '';
        switchRefundMethod('');

        // Clear QR
        clearQr();
    });

    // ── Refund method switcher ──────────────────────────────────────
    function switchRefundMethod(val) {
        ['upi', 'qr', 'bank'].forEach(k => {
            const panel = document.getElementById('rtnPanel' + k.charAt(0).toUpperCase() + k.slice(1));
            if (panel) panel.style.display = val === k ? 'block' : 'none';
        });
        // Toggle required on UPI input
        const upiField = document.getElementById('upiIdField');
        if (upiField) upiField.required = val === 'upi';
        // Toggle required on QR file
        const qrFile = document.getElementById('qrFile');
        if (qrFile) qrFile.required = val === 'qr';
    }

    // ── QR preview ─────────────────────────────────────────────────
    function previewQr(input) {
        if (!input.files || !input.files[0]) return;
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('qrPreviewImg').src = e.target.result;
            document.getElementById('qrPreview').style.display = 'block';
            document.getElementById('qrPlaceholder').style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }

    function clearQr(e) {
        if (e) e.stopPropagation();
        const qrFile = document.getElementById('qrFile');
        if (qrFile) qrFile.value = '';
        const preview = document.getElementById('qrPreview');
        const placeholder = document.getElementById('qrPlaceholder');
        if (preview) preview.style.display = 'none';
        if (placeholder) placeholder.style.display = 'block';
    }
</script>



@endpush