@extends('layouts.app')
@section('content')

    <style>
        .saved-address-card {
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: .3s;
        }

        .saved-address-card:hover {
            border-color: #d49aa7;
        }

        .saved-address-card.active {
            border: 2px solid #d49aa7;
            background: #fff8fa;
        }

        .saved-address-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .saved-address-radio {
            width: 18px !important;
            height: 18px !important;
            margin-right: 10px;
            position: static !important;
        }

        .saved-address-card input:checked+.saved-address-content {
            color: #000;
        }

        .saved-address-card:has(input:checked) {
            border: 2px solid #d49aa7;
            background: #fff8fa;
        }

        .saved-address-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .saved-address-title {
            font-weight: 600;
            color: #d49aa7;
        }

        .checkout-login-note {
            background: #fff8fa;
            border: 1px solid #d49aa7;
            border-radius: 10px;
            color: #555;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkout-login-note i {
            color: #d49aa7;
        }

        .checkout-login-note a {
            color: #d49aa7;
            font-weight: 700;
            text-decoration: underline;
        }

        #authModal .nav-pills .nav-link {
            color: #555;
            border-radius: 8px;
        }

        #authModal .nav-pills .nav-link.active {
            background: #d49aa7;
            color: #fff;
        }
    </style>


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
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <a href="{{ route('cart') }}">Cart</a>
                    <span>/</span>
                    <span>Checkout</span>
                </div>
            </div>
        </section>

        <!-- Cart subtotal snapshot (guest login ke baad cart merge compare karne ke liye) -->
        <div id="checkoutMeta" data-subtotal="{{ $cart->items->sum('total') }}" style="display:none;"></div>

        <section class="aq-cart-wrapper" id="aqCartMainSection">
            <div class="container">

                <form id="checkoutForm">
                    @csrf

                    <div class="row">

                        <!-- Left: Billing & Shipping -->
                        <div class="col-xl-8 col-lg-8 col-12 mb-40">
                            <h1 class="aq-cart-title font-family-heading mb-4">Billing & Shipping Details</h1>

                            @guest('customer')
                                <div class="checkout-login-note mb-4">
                                    <i class="fa-regular fa-circle-user"></i>
                                    <span>
                                        Already have an account?
                                        <a href="#" class="open-auth-modal">Login</a>
                                        to use your saved details.
                                    </span>
                                </div>
                            @endguest

                            <div class="aq-checkout-container aq-contact-page">

                                <input type="hidden" id="selectedAddressId" name="address_id"
                                    value="{{ $defaultAddress->id ?? '' }}">

                                @if($addresses->count())

                                    <div class="mb-4">

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="mb-0">Saved Addresses</h6>
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#newAddressModal">
                                                + Add New Address
                                            </button>

                                        </div>

                                        @foreach($addresses as $address)

                                            <label class="saved-address-card">

                                                <input type="radio" name="address_option" value="{{ $address->id }}"
                                                    class="saved-address-radio" {{ $address->is_default ? 'checked' : '' }}>
                                                <div class="saved-address-content">

                                                    <div class="saved-address-header">
                                                        <span class="saved-address-title">
                                                            {{ $address->address_type ?? 'Address' }}
                                                        </span>

                                                        @if($address->is_default)
                                                            <span class="badge bg-success">
                                                                Default
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <strong>{{ $address->name }}</strong>

                                                    <div>{{ $address->phone }}</div>

                                                    <div>{{ $address->email }}</div>

                                                    <div>{{ $address->address_line_1 }}</div>

                                                    @if($address->address_line_2)
                                                        <div>{{ $address->address_line_2 }}</div>
                                                    @endif

                                                    <div>
                                                        {{ $address->city?->name }},
                                                        {{ $address->state?->name }}
                                                        - {{ $address->pincode }}
                                                    </div>

                                                </div>

                                            </label>

                                        @endforeach

                                    </div>

                                @endif
                                <!-- Contact Information -->
                                <h4 class="aq-checkout-section-title font-family-heading my-4 pb-2">
                                    1. Contact Information
                                </h4>

                                <div class="row g-3 mb-5">

                                    <div class="col-md-12">
                                        <div class="position-relative">
                                            <i class="fa-regular fa-user position-absolute aq-contact-input-icon"></i>

                                            <input type="text" id="customer_name" name="name"
                                                class="form-control aq-contact-input" value="{{ $customer->name ?? '' }}"
                                                placeholder="Full Name *" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="position-relative">
                                            <i class="fa-regular fa-envelope position-absolute aq-contact-input-icon"></i>

                                            <input type="email" id="customer_email" name="email"
                                                class="form-control aq-contact-input" value="{{ $customer->email ?? '' }}"
                                                placeholder="Email Address *" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="position-relative">
                                            <i class="fa-solid fa-phone position-absolute aq-contact-input-icon"></i>

                                            <input type="tel" id="customer_phone" name="phone"
                                                class="form-control aq-contact-input" value="{{ $customer->mobile ?? '' }}"
                                                placeholder="Phone Number *" required>
                                        </div>
                                    </div>

                                </div>

                                <!-- Shipping Address -->
                                <h4 class="aq-checkout-section-title font-family-heading my-4 pb-2">2. Shipping Address</h4>

                                <div id="newAddressSection" class="row g-3 mb-5">

                                    <div class="col-12">
                                        <div class="position-relative">
                                            <i class="fa-solid fa-house position-absolute aq-contact-input-icon"></i>

                                            <input type="text" id="address_line_1" name="address_line_1"
                                                class="form-control aq-contact-input"
                                                value="{{ $defaultAddress->address_line_1 ?? '' }}"
                                                placeholder="Address Line 1 (House No., Building, Street) *" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="position-relative">
                                            <i class="fa-solid fa-map-pin position-absolute aq-contact-input-icon"></i>

                                            <input type="text" id="address_line_2" name="address_line_2"
                                                class="form-control aq-contact-input"
                                                value="{{ $defaultAddress->address_line_2 ?? '' }}"
                                                placeholder="Address Line 2 (Area, Landmark)">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="position-relative">
                                            <i
                                                class="fa-solid fa-earth-americas position-absolute aq-contact-input-icon"></i>

                                            <select name="country" class="form-control aq-contact-input">
                                                <option value="India" selected>India</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="position-relative">
                                            <i class="fa-solid fa-map position-absolute aq-contact-input-icon"></i>

                                            <select name="state_id" id="state_id" class="form-control aq-contact-input"
                                                required>

                                                <option value="">Select State</option>

                                                @foreach($states as $state)
                                                    <option value="{{ $state->id }}" {{ ($defaultAddress->state_id ?? '') == $state->id ? 'selected' : '' }}>
                                                        {{ $state->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="position-relative">
                                            <i class="fa-solid fa-city position-absolute aq-contact-input-icon"></i>

                                            <select name="city_id" id="city_id" class="form-control aq-contact-input"
                                                required>

                                                <option value="">Select City</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="position-relative">
                                            <i class="fa-solid fa-location-dot position-absolute aq-contact-input-icon"></i>

                                            <input type="text" id="pincode" name="pincode"
                                                value="{{ $defaultAddress->pincode ?? '' }}"
                                                class="form-control aq-contact-input" placeholder="Postal Code / PIN Code *"
                                                required>
                                        </div>
                                    </div>

                                </div>

                                <!-- Payment Method -->
                                <h4 class="aq-checkout-section-title font-family-heading my-4 pb-2">3. Payment Method</h4>
                                <div class="checkout-payment-methods">
                                    <div class="payment-method-box active">
                                        <label class="aq-custom-radio-container">
                                            <input type="radio" name="payment_method" value="razorpay" checked>
                                            <span class="checkmark-radio"></span>
                                            Pay Online
                                        </label>
                                    </div>
                                    @if($general && $general->cod_enabled)
                                        <div class="payment-method-box">
                                            <label class="aq-custom-radio-container">
                                                <input type="radio" name="payment_method" value="cod">
                                                <span class="checkmark-radio"></span>
                                                Cash on Delivery (COD)
                                            </label>
                                        </div>
                                    @endif
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

                                                    @if(!empty($item->selected_attributes))

                                                        <div class="mt-1">

                                                            @foreach($item->selected_attributes as $attr)

                                                                <small class="d-block text-muted">
                                                                    {{ $attr['attribute'] }} : {{ $attr['value'] }}
                                                                </small>

                                                            @endforeach

                                                        </div>

                                                    @endif

                                                    @if(!empty($item->custom_colour_code))

                                                        <small class="d-block text-muted mt-1">
                                                            <i class="fa-solid fa-palette"></i>
                                                            Custom Colour Code : {{ $item->custom_colour_code }}
                                                            @if((float) $item->dye_charge > 0)
                                                                (+₹{{ number_format($item->dye_charge, 2) }}/pc dye charge)
                                                            @endif
                                                        </small>

                                                    @endif

                                                    @if($item->addons->count())

                                                        <div class="mt-1">

                                                            @foreach($item->addons as $addon)

                                                                <small class="d-block text-muted">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                    {{ $addon->detail }}
                                                                    (+₹{{ number_format($addon->price, 2) }})
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

                                @if($cart && $cart->tax_amount > 0)

                                    @if($cart->gst_type == 'cgst_sgst')

                                        <div class="aq-summary-row">
                                            <span>CGST ({{ $cart->cgst_rate }}%)</span>
                                            <span>
                                                ₹{{ number_format($cart->cgst_amount, 2) }}
                                            </span>
                                        </div>

                                        <div class="aq-summary-row">
                                            <span>SGST ({{ $cart->sgst_rate }}%)</span>
                                            <span>
                                                ₹{{ number_format($cart->sgst_amount, 2) }}
                                            </span>
                                        </div>

                                    @elseif($cart->gst_type == 'igst')

                                        <div class="aq-summary-row">
                                            <span>IGST ({{ $cart->igst_rate }}%)</span>
                                            <span>
                                                ₹{{ number_format($cart->igst_amount, 2) }}
                                            </span>
                                        </div>

                                    @endif

                                @endif

                                <div class="aq-summary-row total-row">
                                    <span>Total Amount</span>
                                    <span id="summaryTotal">
                                        ₹{{ number_format($cart->grand_total ?? 0, 2) }}
                                    </span>
                                </div>

                                <button type="button" id="placeOrderBtn" class="aq-btn-final-quote aq-checkout-btn-submit">

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

                </form>

            </div>
        </section>


        <!-- Add New Address Modal (logged-in users) -->
        <div class="modal fade aq-premium-modal address-modal" id="newAddressModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 550px;">
                <div class="modal-content">

                    <button type="button" class="btn-close position-absolute" style="top: 20px; right: 20px; z-index: 10;"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="p-4">
                        <h3 class="font-family-heading mb-4">Add New Address</h3>


                        <form id="newAddressForm">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="aq-form-label">Full Name *</label>
                                    <input type="text" id="modal_name" class="form-control" required
                                        value="{{ $customer->name ?? '' }}" placeholder="John Doe">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="aq-form-label">Mobile Number *</label>
                                    <input type="tel" id="modal_phone" class="form-control" required
                                        value="{{ $customer->mobile ?? '' }}" placeholder="+91 00000 00000">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="aq-form-label">Email Address *</label>
                                <input type="email" id="modal_email" class="form-control" required
                                    value="{{ $customer->email ?? '' }}" placeholder="example@email.com">
                            </div>

                            <div class="mb-3">
                                <label class="aq-form-label">Address Line 1 *</label>
                                <input type="text" id="modal_address_line_1" class="form-control" required
                                    placeholder="House/Flat No., Building Name">
                            </div>

                            <div class="mb-3">
                                <label class="aq-form-label">Address Line 2 (Optional)</label>
                                <input type="text" id="modal_address_line_2" class="form-control"
                                    placeholder="Street, Sector, Area">
                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="aq-form-label">State *</label>

                                    <select id="modal_state_id" class="form-select" required>

                                        <option value="">Select State</option>

                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}">
                                                {{ $state->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="aq-form-label">City *</label>

                                    <select id="modal_city_id" class="form-select" required>

                                        <option value="">Select City</option>

                                    </select>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-4">
                                    <label class="aq-form-label">Pincode *</label>

                                    <input type="text" id="modal_pincode" class="form-control" required
                                        placeholder="122002">
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="aq-form-label">Address Type *</label>

                                    <div class="d-flex gap-4 mt-2">

                                        <label class="d-flex align-items-center gap-2"
                                            style="cursor:pointer;font-size:14px;color:#555;">

                                            <input type="radio" name="address_type" value="home" checked
                                                style="width:16px;height:16px;margin:0;appearance:auto !important;">

                                            Home
                                        </label>

                                        <label class="d-flex align-items-center gap-2"
                                            style="cursor:pointer;font-size:14px;color:#555;">

                                            <input type="radio" name="address_type" value="office"
                                                style="width:16px;height:16px;margin:0;appearance:auto !important;">

                                            Office
                                        </label>

                                    </div>
                                </div>

                            </div>

                            <button type="button" id="saveAddressBtn" class="aq-btn-submit w-100"
                                style="background: var(--aq-color-maroon); color:#fff; padding:12px; border:none; border-radius:8px;">

                                Save Address

                            </button>

                        </form>


                    </div>
                </div>
            </div>
        </div>

        <!-- Login / Signup Modal (guests, on Place Order) -->
        <div class="modal fade aq-premium-modal" id="authModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
                <div class="modal-content">

                    <button type="button" class="btn-close position-absolute" style="top:20px;right:20px;z-index:10;"
                        data-bs-dismiss="modal" aria-label="Close"></button>

                    <div class="p-4">
                        <h3 class="font-family-heading mb-1">Continue to Order</h3>
                        <p class="text-muted mb-3" style="font-size:14px;">
                            Login or create an account to place your order.
                        </p>

                        <ul class="nav nav-pills nav-fill mb-3" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" data-bs-toggle="pill"
                                    data-bs-target="#authLoginPane">Login</button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" data-bs-toggle="pill"
                                    data-bs-target="#authRegisterPane">Sign Up</button>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <!-- LOGIN -->
                            <div class="tab-pane fade show active" id="authLoginPane">
                                <div id="loginError" class="alert alert-danger py-2 d-none"></div>

                                <div class="mb-3">
                                    <input type="email" id="login_email" class="form-control" placeholder="Email Address">
                                </div>
                                <div class="mb-3">
                                    <input type="password" id="login_password" class="form-control" placeholder="Password">
                                </div>

                                <button type="button" id="authLoginBtn" class="aq-btn-submit w-100"
                                    style="background: var(--aq-color-maroon); color:#fff; padding:12px; border:none; border-radius:8px;">
                                    Login & Continue
                                </button>
                            </div>

                            <!-- REGISTER -->
                            <div class="tab-pane fade" id="authRegisterPane">
                                <div id="registerError" class="alert alert-danger py-2 d-none"></div>

                                <div class="mb-3">
                                    <input type="text" id="reg_name" class="form-control" placeholder="Full Name"
                                        maxlength="100">
                                </div>
                                <div class="mb-3">
                                    <input type="email" id="reg_email" class="form-control" placeholder="Email Address">
                                </div>
                                <div class="mb-3">
                                    <input type="tel" id="reg_mobile" class="form-control" placeholder="Mobile Number"
                                        maxlength="10">
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <input type="password" id="reg_password" class="form-control"
                                            placeholder="Password (min 8)">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <input type="password" id="reg_password_confirmation" class="form-control"
                                            placeholder="Confirm Password">
                                    </div>
                                </div>

                                <button type="button" id="authRegisterBtn" class="aq-btn-submit w-100"
                                    style="background: var(--aq-color-maroon); color:#fff; padding:12px; border:none; border-radius:8px;">
                                    Create Account & Continue
                                </button>
                            </div>
                        </div>

                        <div class="d-flex align-items-center my-3">
                            <hr class="flex-grow-1 m-0">
                            <span class="mx-3 text-muted" style="font-size:12px;">OR</span>
                            <hr class="flex-grow-1 m-0">
                        </div>

                        <a href="{{ route('google.login', ['redirect' => route('checkout')]) }}"
                            class="w-100 d-flex justify-content-center align-items-center"
                            style="background:#fff;color:#555;padding:11px;border-radius:8px;border:1px solid #ddd;font-weight:600;font-size:14px;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg"
                                alt="Google" style="width:18px;margin-right:10px;">
                            Continue with Google
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </main>


    <div id="payment-overlay" style="display:none;">
        <div class="payment-loader">
            <div class="spinner-border text-light" role="status"></div>
            <p>Please wait, processing your payment...</p>
        </div>
    </div>

    <style>
        #payment-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .6);
            backdrop-filter: blur(5px);
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .payment-loader {
            text-align: center;
            color: #fff;
            font-size: 18px;
        }

        .payment-loader p {
            margin-top: 15px;
            margin-bottom: 0;
        }
    </style>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>

        let csrfToken = "{{ csrf_token() }}";

        function setCsrfToken(token) {
            if (!token) return;

            csrfToken = token;

            // Form ka hidden _token (placeOrder serialize() isi se leta hai)
            $('input[name="_token"]').val(token);

            // Layout ka meta tag agar hai
            $('meta[name="csrf-token"]').attr('content', token);

            // Aage ke saare jQuery ajax calls ke liye header
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': token } });
        }

        let isLoggedIn = @json(auth('customer')->check());
        let pendingPlaceOrder = false;
        const initialSubtotal = Number($('#checkoutMeta').data('subtotal') || 0);

        function trackStep(step) {
            $.post("{{ route('checkout.track-step') }}", { _token: csrfToken, step: step });
        }

        function showError(message, title = 'Error') {
            Swal.fire({
                icon: 'error',
                title: title,
                html: message,
                confirmButtonColor: '#d49aa7'
            });
        }

        function ajaxErrorMessage(xhr, fallback) {
            if (xhr.responseJSON) {
                if (xhr.responseJSON.errors) {
                    return Object.values(xhr.responseJSON.errors)
                        .map(e => e[0])
                        .join('<br>');
                }
                if (xhr.responseJSON.message) {
                    return xhr.responseJSON.message;
                }
            }
            return fallback;
        }

        /* ---------------- Cities / Saved address ---------------- */

        $(document).ready(function () {

            function loadCities(stateId, citySelector, selectedCityId = '') {
                if (!stateId) {
                    $(citySelector).html('<option value="">Select City</option>');
                    return;
                }

                $(citySelector).html('<option value="">Loading...</option>');

                $.ajax({
                    url: "{{ route('get-cities') }}",
                    type: "GET",
                    data: { state_id: stateId },
                    success: function (response) {

                        let options = '<option value="">Select City</option>';

                        $.each(response, function (key, city) {
                            let selected = city.id == selectedCityId ? 'selected' : '';
                            options += `<option value="${city.id}" ${selected}>${city.name}</option>`;
                        });

                        $(citySelector).html(options);
                    }
                });
            }

            let defaultCityId = "{{ $defaultAddress->city_id ?? '' }}";

            loadCities($('#state_id').val(), '#city_id', defaultCityId);

            $('#state_id').on('change', function () {
                loadCities($(this).val(), '#city_id');
            });

            $('#modal_state_id').on('change', function () {
                loadCities($(this).val(), '#modal_city_id');
            });

            $('.saved-address-radio').on('change', function () {

                $.ajax({
                    url: "{{ route('checkout.change-default-address') }}",
                    type: "POST",
                    data: {
                        _token: csrfToken,
                        address_id: $(this).val()
                    },
                    success: function (response) {
                        if (response.success) {
                            location.reload();
                        }
                    }
                });
            });

            $('#saveAddressBtn').on('click', function () {

                $.ajax({
                    url: "{{ route('address.store') }}",
                    type: "POST",
                    data: {
                        _token: csrfToken,

                        name: $('#modal_name').val(),
                        email: $('#modal_email').val(),
                        phone: $('#modal_phone').val(),

                        address_line_1: $('#modal_address_line_1').val(),
                        address_line_2: $('#modal_address_line_2').val(),

                        state_id: $('#modal_state_id').val(),
                        city_id: $('#modal_city_id').val(),

                        pincode: $('#modal_pincode').val(),

                        address_type: $('input[name="address_type"]:checked').val()
                    },
                    success: function (response) {
                        if (response.success) {
                            location.reload();
                        }
                    },
                    error: function (xhr) {
                        showError(ajaxErrorMessage(xhr, 'Unable to save address.'), 'Validation Error');
                    }
                });
            });

        });

        /* ---------------- Login / Signup modal ---------------- */

        const authModalEl = document.getElementById('authModal');

        function openAuthModal() {

            $('#loginError, #registerError').addClass('d-none').html('');

            // Checkout form ki details se prefill
            if (!$('#reg_name').val()) $('#reg_name').val($('#customer_name').val());
            if (!$('#reg_email').val()) $('#reg_email').val($('#customer_email').val());
            if (!$('#reg_mobile').val()) $('#reg_mobile').val($('#customer_phone').val());
            if (!$('#login_email').val()) $('#login_email').val($('#customer_email').val());

            bootstrap.Modal.getOrCreateInstance(authModalEl).show();
        }

        // Top wali "Login" link: login ke baad sirf page reload (saved details prefill ho jayengi)
        $(document).on('click', '.open-auth-modal', function (e) {
            e.preventDefault();
            pendingPlaceOrder = false;
            openAuthModal();
        });

        function onAuthSuccess(res) {

            setCsrfToken(res.csrf_token);

            isLoggedIn = true;

            if (typeof fireTrackingEvents === 'function' && res.tracking_events) {
                try {
                    fireTrackingEvents(res.tracking_events);
                } catch (e) {
                    console.warn('Tracking event failed (ignored):', e);
                }
            }

            let proceed = pendingPlaceOrder;
            pendingPlaceOrder = false;

            // Modal poora band hone ke baad aage badho (Razorpay popup focus issue se bachne ke liye)
            $(authModalEl).one('hidden.bs.modal', function () {

                if (!proceed) {
                    location.reload();
                    return;
                }

                // Login ke baad cart ke items badal gaye (purana saved cart merge hua) to review karwao
                if (Math.abs(Number(res.cart_subtotal) - initialSubtotal) > 0.01) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Cart Updated',
                        text: 'Your saved cart items were merged. Please review your order before paying.',
                        confirmButtonColor: '#d49aa7'
                    }).then(() => location.reload());
                    return;
                }

                placeOrder();
            });

            bootstrap.Modal.getOrCreateInstance(authModalEl).hide();
        }

        $('#authLoginBtn').on('click', function () {

            let btn = $(this);
            $('#loginError').addClass('d-none');
            btn.prop('disabled', true);

            $.ajax({
                url: "{{ route('checkout.ajax-login') }}",
                type: "POST",
                data: {
                    _token: csrfToken,
                    email: $('#login_email').val(),
                    password: $('#login_password').val()
                },
                success: function (res) {
                    btn.prop('disabled', false);
                    onAuthSuccess(res);
                },
                error: function (xhr) {
                    btn.prop('disabled', false);
                    $('#loginError')
                        .removeClass('d-none')
                        .html(ajaxErrorMessage(xhr, 'Login failed.'));
                }
            });
        });

        $('#authRegisterBtn').on('click', function () {

            let btn = $(this);
            $('#registerError').addClass('d-none');
            btn.prop('disabled', true);

            $.ajax({
                url: "{{ route('checkout.ajax-register') }}",
                type: "POST",
                data: {
                    _token: csrfToken,
                    name: $('#reg_name').val(),
                    email: $('#reg_email').val(),
                    mobile: $('#reg_mobile').val(),
                    password: $('#reg_password').val(),
                    password_confirmation: $('#reg_password_confirmation').val()
                },
                success: function (res) {
                    btn.prop('disabled', false);
                    onAuthSuccess(res);
                },
                error: function (xhr) {
                    btn.prop('disabled', false);
                    $('#registerError')
                        .removeClass('d-none')
                        .html(ajaxErrorMessage(xhr, 'Registration failed.'));
                }
            });
        });

        // Enter key se submit
        $('#login_email, #login_password').on('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                $('#authLoginBtn').click();
            }
        });

        $('#reg_name, #reg_email, #reg_mobile, #reg_password, #reg_password_confirmation').on('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                $('#authRegisterBtn').click();
            }
        });

        /* ---------------- Place Order ---------------- */

        $('#placeOrderBtn').on('click', function () {

            // Pehle form validate (guest ho ya logged in)
            let formEl = document.getElementById('checkoutForm');

            if (!formEl.reportValidity()) {
                return;
            }

            // Guest hai to pehle login / signup modal
            if (!isLoggedIn) {
                pendingPlaceOrder = true;
                trackStep('login_prompt');  
                openAuthModal();
                return;
            }

            placeOrder();
        });

        function placeOrder() {

            let btn = $('#placeOrderBtn');
            let overlay = document.getElementById('payment-overlay');

            function resetUI() {
                overlay.style.display = 'none';
                btn.prop('disabled', false);
            }

            btn.prop('disabled', true);

            $.ajax({
                url: "{{ route('checkout.place-order') }}",
                type: "POST",
                data: $('#checkoutForm').serialize(),

                success: function (response) {

                    if (!response.success) {
                        resetUI();
                        showError(response.message || 'Unable to place order.');
                        return;
                    }

                    let paymentMethod = $('input[name="payment_method"]:checked').val();

                    // COD
                    if (paymentMethod === 'cod') {
                        window.location.href = response.redirect_url;
                        return;
                    }

                    // Razorpay
                    let localOrderId = response.order_id;

                    let options = {
                        key: response.key,
                        amount: response.amount,
                        currency: "INR",
                        name: "{{ config('app.name') }}",
                        description: "Order Payment",
                        order_id: response.razorpay_order_id,

                        prefill: {
                            name: response.customer_name,
                            email: response.customer_email,
                            contact: response.customer_phone
                        },

                        // Popup band kiya to button wapas enable
                        modal: {
                            ondismiss: function () {
                                resetUI();
                            }
                        },

                        handler: function (razorpayResponse) {

                            overlay.style.display = 'flex';

                            $.ajax({
                                url: "{{ route('checkout.razorpay.success') }}",
                                type: "POST",
                                data: {
                                    _token: csrfToken,
                                    order_id: localOrderId,
                                    razorpay_payment_id: razorpayResponse.razorpay_payment_id,
                                    razorpay_order_id: razorpayResponse.razorpay_order_id,
                                    razorpay_signature: razorpayResponse.razorpay_signature
                                },

                                success: function (res) {
                                    if (res.success) {
                                        window.location.href = res.redirect_url;
                                        return;
                                    }
                                    resetUI();
                                    showError(res.message || 'Payment could not be confirmed.');
                                },

                                error: function (xhr) {
                                    resetUI();
                                    showError(ajaxErrorMessage(
                                        xhr,
                                        'Payment confirmation failed. If money was deducted, please contact support.'
                                    ));
                                }
                            });
                        }
                    };

                    let rzp = new Razorpay(options);

                    rzp.on('payment.failed', function (failure) {
                        resetUI();
                        showError(
                            (failure.error && failure.error.description)
                                ? failure.error.description
                                : 'Payment failed. Please try again.'
                        );
                    });

                    rzp.open();
                },

                error: function (xhr) {
                    resetUI();
                    showError(ajaxErrorMessage(xhr, 'Something went wrong.'), 'Validation Error');
                }
            });
        }

    </script>
    @if(!empty($beginCheckoutScript))
        <script>
            {!! $beginCheckoutScript !!}
        </script>
    @endif

@endsection