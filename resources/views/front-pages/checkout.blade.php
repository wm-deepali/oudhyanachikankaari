@extends('layouts.app')
@section('content')
    <main class="aq-cart-page">

        <!-- 1. Luxury Inner Banner / Hero Section -->
        <section class="aq-catpage-hero aq-apparel-hero">
            <div class="aq-hero-glow"></div>
            <div class="aq-floating-gift-box aq-floating-shape-1">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
            </div>
            <div class="aq-floating-gift-box aq-floating-shape-2">
                <i class="fa-regular fa-star"></i>
            </div>
            <div class="aq-catpage-hero-content">
                <h1 class="aq-catpage-title">Checkout</h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="index.html">Home</a>
                    <span>/</span>
                    <a href="{{ route('cart') }}">Cart</a>
                    <span>/</span>
                    <span>Checkout</span>
                </div>
            </div>
        </section>

        <!-- Breadcrumb Bar -->




        <section class="aq-cart-wrapper" id="aqCartMainSection">
            <div class="container">
                <div class="row">
                    <!-- Left: Your Cart -->
                    <!-- Left: Billing & Shipping -->
                    <div class="col-xl-8 col-lg-8 col-12 mb-40">
                        <h1 class="aq-cart-title font-family-heading mb-4">Billing & Shipping Details</h1>
                        <div class="aq-checkout-container aq-contact-page">

                            <!-- Contact Information -->
                            <h4 class="aq-checkout-section-title font-family-heading my-4 pb-2">1. Contact Information
                            </h4>
                            <div class="row g-3 mb-5">
                                <div class="col-md-12">
                                    <div class="position-relative">
                                        <i class="fa-regular fa-user position-absolute aq-contact-input-icon"></i>
                                        <input type="text" class="form-control aq-contact-input"
                                            value="{{ $customer->name }}" placeholder="Full Name *" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative">
                                        <i class="fa-regular fa-envelope position-absolute aq-contact-input-icon"></i>
                                        <input type="email" class="form-control aq-contact-input"
                                            value="{{ $customer->email }}" placeholder="Email Address *" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative">
                                        <i class="fa-solid fa-phone position-absolute aq-contact-input-icon"></i>
                                        <input type="tel" class="form-control aq-contact-input"
                                            value="{{ $customer->mobile }}" placeholder="Phone Number *" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Address -->
                            <h4 class="aq-checkout-section-title font-family-heading my-4 pb-2">2. Shipping Address</h4>
                            <div class="row g-3 mb-5">
                                <div class="col-12">
                                    <div class="position-relative">
                                        <i class="fa-solid fa-house position-absolute aq-contact-input-icon"></i>
                                        <input type="text" class="form-control aq-contact-input"
                                            placeholder="Address Line 1 (House No., Building, Street) *" value="{{ $defaultAddress->address_line_1 ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="position-relative">
                                        <i class="fa-solid fa-map-pin position-absolute aq-contact-input-icon"></i>
                                        <input type="text" class="form-control aq-contact-input" value="{{ $defaultAddress->address_line_2 ?? '' }}"
                                            placeholder="Address Line 2 (Area, Landmark)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative">
                                        <i class="fa-solid fa-earth-americas position-absolute aq-contact-input-icon"></i>
                                        <select class="form-control aq-contact-input" required>
                                            <option selected>India</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative">
                                        <i class="fa-solid fa-map position-absolute aq-contact-input-icon"></i>
                                        <input type="text" class="form-control aq-contact-input"
                                            placeholder="State / Province *" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative">
                                        <i class="fa-solid fa-city position-absolute aq-contact-input-icon"></i>
                                        <input type="text" class="form-control aq-contact-input" placeholder="City *" 
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative">
                                        <i class="fa-solid fa-location-dot position-absolute aq-contact-input-icon"></i>
                                        <input type="text" class="form-control aq-contact-input"
                                            placeholder="Postal Code / PIN Code *" required value="{{ $defaultAddress->pincode ?? '' }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <h4 class="aq-checkout-section-title font-family-heading my-4 pb-2">3. Payment Method</h4>
                            <div class="checkout-payment-methods">
                                <div class="payment-method-box active">
                                    <label class="aq-custom-radio-container">
                                        <input type="radio" name="payment_method" checked>
                                        <span class="checkmark-radio"></span>
                                        Credit / Debit Card
                                        <div class="ms-auto d-flex gap-2">
                                            <i class="fa-brands fa-cc-visa" style="font-size: 24px; color: #1434CB;"></i>
                                            <i class="fa-brands fa-cc-mastercard"
                                                style="font-size: 24px; color: #EB001B;"></i>
                                            <i class="fa-brands fa-cc-amex" style="font-size: 24px; color: #016FD0;"></i>
                                        </div>
                                    </label>
                                </div>
                                <div class="payment-method-box">
                                    <label class="aq-custom-radio-container">
                                        <input type="radio" name="payment_method">
                                        <span class="checkmark-radio"></span>
                                        UPI (GPay, PhonePe, Paytm)
                                    </label>
                                </div>
                                <div class="payment-method-box">
                                    <label class="aq-custom-radio-container">
                                        <input type="radio" name="payment_method">
                                        <span class="checkmark-radio"></span>
                                        Cash on Delivery (COD)
                                    </label>
                                </div>
                            </div>

                            <div class="aq-checkout-disclaimer">
                                <i class="fa-solid fa-lock mr-5"></i> Your personal data will be used to process your
                                order, support your experience throughout this website, and for other purposes described
                                in our privacy policy.
                            </div>

                        </div>
                    </div>

                    <!-- Right: Order Summary sticky card -->
                    <div class="col-xl-4 col-lg-4 col-12">
                        <div class="aq-summary-card">

                            <h3 class="aq-summary-title">Order Summary</h3>

                            @if($cart && $cart->items->count())

                                <div class="mb-3">

                                    @foreach($cart->items as $item)

                                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">

                                            <div>

                                                <div style="font-size:14px;font-weight:600;">
                                                    {{ $item->product->name }}
                                                </div>

                                                <small class="text-muted">
                                                    Qty : {{ $item->quantity }}
                                                </small>

                                                @if($item->variant && $item->variant->values->count())

                                                    <div class="mt-1">

                                                        @foreach($item->variant->values as $variantValue)

                                                            <small class="d-block text-muted">
                                                                {{ $variantValue->attributeValue->attribute->name }}
                                                                :
                                                                {{ $variantValue->attributeValue->value }}
                                                            </small>

                                                        @endforeach

                                                    </div>

                                                @endif

                                            </div>

                                            <div style="font-weight:600;">
                                                ₹{{ number_format($item->total) }}
                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            @endif

                            <div class="aq-summary-row">
                                <span>Cart Subtotal</span>
                                <span id="summarySubtotal">
                                    ₹{{ number_format($cart->subtotal ?? 0, 2) }}
                                </span>
                            </div>

                            <div class="aq-summary-row">
                                <span>Coupon Discount</span>
                                <span id="summaryDiscount" style="color:green;">
                                    - ₹{{ number_format($cart->discount ?? 0, 2) }}
                                </span>
                            </div>


                            <div class="aq-summary-row">
                                <span>Shipping & Handling</span>
                                <span class="text-success font-weight-bold">
                                    Free
                                </span>
                            </div>

                            <div class="aq-summary-row">
                                <span>GST (Taxes)</span>
                                <span id="summaryGST">
                                    ₹{{ number_format($cart->tax_amount ?? 0, 2) }}
                                </span>
                            </div>

                            <div class="aq-summary-row total-row">
                                <span>Total Amount</span>
                                <span id="summaryTotal">
                                    ₹{{ number_format($cart->grand_total ?? 0, 2) }}
                                </span>
                            </div>

                            <button type="submit" class="aq-btn-final-quote aq-checkout-btn-submit">

                                <span>Place Order Now</span>
                                <i class="fa-solid fa-check-circle ml-10"></i>

                            </button>

                            <div class="aq-summary-perks">

                                <div class="aq-summary-perk-item">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>Secure Checkout with SSL Encryption</span>
                                </div>

                                <div class="aq-summary-perk-item">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>Free Shipping on Pre-paid Orders</span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>


@endsection