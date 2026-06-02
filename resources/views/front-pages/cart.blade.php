@extends('layouts.app')

@section('content')

    <main class="aq-cart-page">

        <!-- 1. Luxury Inner Banner / Hero Section -->
        <section class="aq-catpage-hero">
            <div class="aq-hero-glow"></div>
            <div class="aq-floating-gift-box aq-floating-shape-1">
                <i class="fa-solid fa-gift"></i>
            </div>
            <div class="aq-floating-gift-box aq-floating-shape-2">
                <i class="fa-solid fa-gem"></i>
            </div>
            <div class="aq-catpage-hero-content">
                <h1 class="aq-catpage-title">Your Cart</h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="index.html">Home</a>
                    <span>/</span>
                    <span>Cart</span>
                </div>
            </div>
        </section>

        <!-- Breadcrumb Bar -->




        <section class="aq-cart-wrapper" id="aqCartMainSection">
            <div class="container">
                <div class="row">
                    <!-- Left: Your Cart -->
                    <div class="col-xl-8 col-lg-8 col-12 mb-40">
                        <h1 class="aq-cart-title">Your Cart</h1>
                        <div class="aq-cart-items-list" id="aqCartItemsList">
                            @forelse($cartItems as $item)

                                <!-- Cart Row 1: Bespoke Welcome Kit -->
                                <div class="aq-cart-item-row" data-id="item-welcome-kit">
                                    <div class="aq-cart-item-thumb">
                                        <img src="{{ asset('storage/' . $item->product->display_image) }}"
                                            alt="{{ $item->product->name }}" />
                                    </div>
                                    <div class="aq-cart-item-details">
                                        <span class="aq-cart-item-category">
                                            @if($item->product->categories->count())
                                                {{ $item->product->categories->pluck('name')->implode(', ') }}
                                            @elseif($item->product->subcategories->count())
                                                {{ $item->product->subcategories->pluck('name')->implode(', ') }}
                                            @else
                                                Product
                                            @endif
                                        </span>
                                        <h4 class="aq-cart-item-title"><a
                                                href="product_details.html">{{ $item->product->name }}</a></h4>
                                        @if($item->customization)

                                            <div class="aq-cart-customization-badges">

                                                <span class="aq-cart-badge">
                                                    <i class="{{ $item->customization->icon ?: 'fa-solid fa-palette' }} mr-5"></i>
                                                    {{ $item->customization->name }}
                                                </span>

                                            </div>

                                        @endif
                                    </div>
                                    <div class="aq-cart-item-price-qty">
                                        <!-- Qty Selector -->
                                        <div class="aq-cart-qty-selector">
                                            <button class="aq-cart-qty-btn qty-minus" data-id="{{ $item->id }}"
                                                aria-label="Decrease quantity"><i class="fa-solid fa-minus"></i></button>
                                            <input type="text" class="aq-cart-qty-input" value="{{ $item->quantity }}"
                                                readonly />
                                            <button class="aq-cart-qty-btn qty-plus" data-id="{{ $item->id }}"
                                                aria-label="Increase quantity"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                        <!-- Price -->
                                        <div class="aq-cart-price-block">

                                            @if($item->price > 0)

                                                @php
                                                    $mrp = $item->product->mrp ?? $item->price;
                                                    $discountPercent = 0;

                                                    if ($mrp > 0 && $mrp > $item->price) {
                                                        $discountPercent = round((($mrp - $item->price) / $mrp) * 100);
                                                    }
                                                @endphp

                                                @if($discountPercent > 0)
                                                    <span class="aq-cart-discount-tag">
                                                        {{ $discountPercent }}% OFF
                                                    </span>
                                                @endif

                                                <span class="aq-cart-mrp">
                                                    ₹{{ number_format($mrp) }}
                                                </span>

                                                <span class="aq-cart-price" data-base-price="{{ $item->price }}">
                                                    ₹{{ number_format($item->total) }}
                                                </span>

                                            @else

                                                <span class="aq-cart-discount-tag">
                                                    Quote
                                                </span>

                                                <span class="aq-cart-mrp">
                                                    Contact Us
                                                </span>

                                                <span class="aq-cart-price">
                                                    Quote Required
                                                </span>

                                            @endif

                                        </div>
                                        <button class="aq-cart-item-remove" data-id="{{ $item->id }}" aria-label="Remove item">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500">Your cart is empty</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Right: Order Summary sticky card -->
                    <div class="col-xl-4 col-lg-4 col-12">
                        <div class="aq-summary-card">
                            <h3 class="aq-summary-title">Order Summary</h3>

                            <div class="aq-summary-row">
                                <span>Cart Subtotal</span>
                                <span id="summarySubtotal">
                                    ₹{{ number_format($subtotal) }}
                                </span>
                            </div>

                            <div class="aq-summary-row">
                                <span>Logo & Graphics Customisation</span>
                                <span class="text-success font-weight-bold">Charges Extra</span>
                            </div>
                            <div class="aq-summary-row">
                                <span>GST (as Applicable)</span>
                                <span id="summaryGST">On final Quote</span>
                            </div>

                            <div class="aq-summary-row total-row">
                                <span>Final Offered Value</span>
                                <span id="summaryTotal">
                                    ₹{{ number_format($grandTotal) }}
                                </span>
                            </div>

                            <button type="button" class="aq-btn-final-quote" data-bs-toggle="modal"
                                data-bs-target="#finalQuoteModal">
                                <span>Request a Final Quote</span>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>

                            <div class="aq-summary-perks">
                                <div class="aq-summary-perk-item">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>Prices are just for reference. Actual price will be shared in final quote.

                                    </span>
                                </div>
                                <div class="aq-summary-perk-item">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>GST will be Charges as per Actual Invoice</span>
                                </div>
                                <div class="aq-summary-perk-item">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>Shipping & Delivery Charges may be paid as actual</span>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


    </main>

    <div class="modal fade aq-premium-modal final-quote-modal" id="finalQuoteModal" tabindex="-1"
        aria-labelledby="finalQuoteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal"
                    aria-label="Close"></button>

                <div class="row g-0">
                    <!-- Left: Creative Visual Side -->
                    <div class="col-lg-5 d-none d-lg-block aq-modal-left-panel">
                        <div>
                            <div class="mb-5">
                                <i class="fa-solid fa-gem aq-modal-icon"></i>
                            </div>
                            <h3 class="font-family-heading mb-3 aq-modal-title">
                                Finalize Your <br><span>Curated Experience</span>
                            </h3>
                            <p class="aq-modal-desc">
                                Provide your details to receive the final customized quotation and digital proofs for your
                                selected luxury gifts.
                            </p>
                        </div>
                        <div class="aq-modal-left-features">
                            <div class="aq-modal-feature-item">
                                <i class="fa-solid fa-check text-success mr-10"></i>
                                <span>Dedicated Corporate Manager</span>
                            </div>
                            <div class="aq-modal-feature-item">
                                <i class="fa-solid fa-check text-success mr-10"></i>
                                <span>Free Mockups & Virtual Proofs</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Form Side -->
                    <div class="col-lg-7 col-12 aq-modal-right-panel">
                        <div class="aq-login-top mb-30">
                            <h3 class="font-family-heading aq-modal-title">Submit Enquiry</h3>
                            <p class="aq-modal-desc">We'll get back to you within 2 business hours.</p>
                        </div>

                        <form id="aqFinalQuoteForm" onsubmit="handleFinalQuoteSubmit(event)">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="aq-form-label">Business Name *</label>
                                    <div class="position-relative">
                                        <i class="fa-solid fa-building position-absolute input-icon"></i>
                                        <input type="text" name="business_name" class="form-control with-icon" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="aq-form-label">Owner Name *</label>
                                    <div class="position-relative">
                                        <i class="fa-regular fa-user position-absolute input-icon"></i>
                                        <input type="text" name="owner_name" class="form-control with-icon" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="aq-form-label">Email *</label>
                                    <div class="position-relative">
                                        <i class="fa-regular fa-envelope position-absolute input-icon"></i>
                                        <input type="email" name="email" class="form-control with-icon" required />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="aq-form-label">Mobile *</label>
                                    <div class="position-relative">
                                        <i class="fa-solid fa-phone position-absolute input-icon"></i>
                                        <input type="text" name="mobile" pattern="[6-9]{1}[0-9]{9}" maxlength="10"
                                            class="form-control with-icon" required />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="aq-form-label">Full Address *</label>
                                <textarea name="address" class="form-control" required rows="2"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="aq-form-label">State *</label>
                                    <select name="state" id="state" class="form-select" required>

                                        <option value="">
                                            Select State
                                        </option>

                                        @foreach($states as $state)

                                            <option value="{{ $state->id }}">
                                                {{ $state->name }}
                                            </option>

                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="aq-form-label">City *</label>
                                    <select name="city" id="city" class="form-select" required>

                                        <option value="">
                                            Select City
                                        </option>

                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}">
                                </div>
                            </div>
                            <button type="submit" class="aq-btn-submit">
                                <span>Submit Enquiry</span>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>

        document.querySelectorAll('.aq-cart-item-remove').forEach(btn => {
            btn.addEventListener('click', function () {

                let itemId = this.getAttribute('data-id');

                fetch("{{ route('cart.remove') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        item_id: itemId
                    })
                })
                    .then(res => res.json())
                    .then(data => {

                        Swal.fire({
                            icon: 'success',
                            title: 'Removed!',
                            text: data.message,
                            timer: 1200,
                            showConfirmButton: false
                        });

                        // ✅ Remove item from UI instantly
                        this.closest('.aq-cart-item-row').remove();

                        // ✅ Reload page (to update totals + header count)
                        setTimeout(() => {
                            location.reload();
                        }, 800);

                    });

            });
        });


        document.querySelectorAll('.qty-plus').forEach(btn => {

            btn.addEventListener('click', function () {

                let row = this.closest('.aq-cart-item-row');

                let input = row.querySelector('.aq-cart-qty-input');

                let qty = parseInt(input.value) + 1;

                updateCartQty(this.dataset.id, qty);
            });

        });

        document.querySelectorAll('.qty-minus').forEach(btn => {

            btn.addEventListener('click', function () {

                let row = this.closest('.aq-cart-item-row');

                let input = row.querySelector('.aq-cart-qty-input');

                let qty = parseInt(input.value) - 1;

                if (qty < 1) qty = 1;

                updateCartQty(this.dataset.id, qty);
            });

        });

        function updateCartQty(itemId, qty) {
            fetch("{{ route('cart.update.quantity') }}", {

                method: "POST",

                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },

                body: JSON.stringify({
                    item_id: itemId,
                    quantity: qty
                })

            })
                .then(res => res.json())
                .then(data => {

                    location.reload();

                });
        }

        let cityDropdown = document.getElementById('city');

        cityDropdown.disabled = true;

        document.getElementById('state').addEventListener('change', function () {

            let stateId = this.value;

            cityDropdown.disabled = false;

            fetch(`/get-cities/${stateId}`)
                .then(res => res.json())
                .then(data => {

                    cityDropdown.innerHTML =
                        '<option value="">Select City</option>';

                    data.forEach(item => {

                        cityDropdown.innerHTML +=
                            `<option value="${item.id}">
                                    ${item.name}
                                </option>`;

                    });

                });

        });

        document.getElementById('aqFinalQuoteForm')
            .addEventListener('submit', function (e) {

                e.preventDefault();

                let formData = new FormData(this);

                let recaptcha = grecaptcha.getResponse();

                if (recaptcha.length === 0) {

                    Swal.fire(
                        'Error',
                        'Please verify captcha',
                        'error'
                    );

                    return;
                }

                formData.append(
                    'g-recaptcha-response',
                    recaptcha
                );

                fetch("{{ route('enquiry.store') }}", {

                    method: "POST",

                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },

                    body: formData

                })
                    .then(async res => {

                        let data = await res.json();

                        if (!res.ok) {

                            let errorHtml = '';

                            if (data.errors) {

                                Object.values(data.errors)
                                    .forEach(arr => {

                                        errorHtml += arr[0] + '<br>';

                                    });

                            }

                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                html: errorHtml
                            });

                            return;
                        }

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        setTimeout(() => {

                            window.location.href = data.redirect;

                        }, 1500);

                    });

            });



    </script>

@endsection