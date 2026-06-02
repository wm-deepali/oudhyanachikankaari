@extends('layouts.app')

@section('content')
    <main>

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
                <h1 class="aq-catpage-title">{{ $product->name }}</h1>

                <div class="aq-catpage-breadcrumbs">
                    <a href="{{ route('home') }}">Home</a>

                    @if($product->categories->count())
                        <span>/</span>
                        <a href="#">
                            {{ $product->categories->first()->name }}
                        </a>
                    @endif

                    @if($product->subcategories->count())
                        <span>/</span>
                        <a href="#">
                            {{ $product->subcategories->first()->name }}
                        </a>
                    @endif

                    <span>/</span>
                    <span>{{ $product->name }}</span>
                </div>
            </div>
        </section> <!-- collection area start -->
        <!-- Centralized Styles moved to custom-luxury.css -->

        <!-- 1. Luxury Product Details Container -->
        <section class="aq-product-details-area pt-50 pb-60">
            <div class="container">
                <!-- Elegant Breadcrumbs -->
                <div class="aq-details-breadcrumbs mb-40">
                    <a href="{{ route('home') }}">Home</a>

                    @if($product->categories->count())
                        <span class="divider">/</span>
                        <a href="#">
                            {{ $product->categories->first()->name }}
                        </a>
                    @endif

                    @if($product->subcategories->count())
                        <span class="divider">/</span>
                        <a href="#">
                            {{ $product->subcategories->first()->name }}
                        </a>
                    @endif

                    <span class="divider">/</span>

                    <span class="current">
                        {{ $product->name }}
                    </span>
                </div>

                <div class="row g-5 justify-content-between">

                    <!-- Left Column: Image Gallery -->
                    <div class="col-lg-6 col-md-12">
                        <div class="aq-product-gallery">
                            <div class="aq-gallery-badge-wrap">

                                @if($product->new_arrival)
                                    <span class="aq-gallery-badge bestseller">
                                        New Arrival
                                    </span>
                                @endif

                                @if($product->sale)
                                    <span class="aq-gallery-badge logo-branding">
                                        For Sale
                                    </span>
                                @endif


                            </div>
                            <div class="aq-gallery-main-img-wrap">
                                <img id="aqMainProductImg" src="{{ asset('storage/' . $product->display_image) }}"
                                    alt="Elite Executive Gift Set" class="aq-gallery-main-img" />
                                <div class="aq-gallery-zoom-hint"><i class="fa-solid fa-magnifying-glass-plus"></i> Roll
                                    over image to zoom</div>
                            </div>
                            <!-- Gallery Thumbnails -->
                            <div class="aq-gallery-thumbs mt-25">
                                @foreach($product->images as $key => $image)

                                    <div class="aq-gallery-thumb-item {{ $key == 0 ? 'active' : '' }}"
                                        onclick="updateMainImage(this,'{{ asset('storage/' . $image->image) }}')">

                                        <img src="{{ asset('storage/' . $image->image) }}">

                                    </div>

                                @endforeach
                            </div>
                        </div>

                        <!-- SUITABLE FOR SELECTIONS -->
                        <div class="aq-suitable-for-extra mt-30 p-4">
                            <h5>
                                <i class="fa-solid fa-circle-check"></i>
                                Suitable For
                            </h5>

                            <!-- Occasions Grid -->
                            <div class="row g-3 text-center">

                                @foreach($product->occasions as $occasion)

                                    <div class="col-4">
                                        <div class="aq-occasion-card p-3">

                                            <div class="aq-occasion-icon-wrap">
                                                <i class="{{ $occasion->icon ?: 'fa-solid fa-gift' }}"></i>
                                            </div>

                                            <span>{{ $occasion->title }}</span>

                                        </div>
                                    </div>

                                @endforeach

                            </div>
                        </div>
                        <!-- Trust Badges Section -->
                        <div class="aq-luxury-trust-badges">
                            <!-- Badge 1: PAN India Delivery -->
                            @if($product->pan_india)
                                <div class="aq-trust-badge-item">
                                    <span class="aq-trust-badge-icon"><i class="fa-solid fa-truck-fast"></i></span>
                                    <div class="aq-trust-badge-content">
                                        <span class="aq-trust-badge-text">PAN India Delivery</span>
                                        <span class="aq-trust-badge-sub">Express Shipping (7-10 Days)</span>
                                    </div>
                                </div>
                            @endif
                            @if($product->quality)
                                <!-- Badge 2: Quality assurance check -->
                                <div class="aq-trust-badge-item">
                                    <span class="aq-trust-badge-icon"><i class="fa-solid fa-circle-check"></i></span>
                                    <div class="aq-trust-badge-content">
                                        <span class="aq-trust-badge-text">100% Quality Audited</span>
                                        <span class="aq-trust-badge-sub">Strict Assurance Audit</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>

                    <!-- Right Column: Product Specs & Ordering Drawer Trigger -->
                    <div class="col-lg-6 col-md-12">
                        <div class="aq-product-details-summary">
                            <span class="aq-details-brand">
                                @if($product->subcategories->count())
                                    {{ $product->subcategories->first()->name }}
                                @elseif($product->categories->count())
                                    {{ $product->categories->first()->name }}
                                @endif
                            </span>
                            <h2 class="aq-details-title">
                                {{ $product->name }}
                            </h2>

                            <!-- Star reviews rating -->
                            <div class="aq-details-rating-wrap d-flex align-items-center gap-2 mt-10 mb-15">
                                <div class="aq-details-stars">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <span class="aq-details-rating-text">(4.9 / 5 from 18 verified corporate client
                                    orders)</span>
                            </div>

                            <!-- Pricing box -->
                            @php
                                $price = (float) ($product->price ?? 0);
                                $mrp = (float) ($product->mrp ?? 0);

                                $hasDiscount = $mrp > $price && $price > 0;

                                $discountAmount = $mrp - $price;

                                $discountPercent = $mrp > 0
                                    ? round(($discountAmount / $mrp) * 100)
                                    : 0;
                            @endphp

                            <div class="aq-details-price-box p-3 mb-25">
                                <div class="d-flex flex-column gap-1">

                                    @if($mrp > 0)

                                        <div class="aq-price-mrp-row d-flex align-items-center gap-2">

                                            <span class="mrp-label">
                                                MRP:
                                                <span class="mrp-value">
                                                    ₹{{ number_format($mrp) }}
                                                </span>
                                            </span>

                                            @if($hasDiscount)
                                                <span class="discount-badge">
                                                    Discount: {{ $discountPercent }}% OFF
                                                </span>
                                            @endif

                                        </div>

                                    @endif

                                    <div class="aq-price-offered-row d-flex align-items-baseline gap-2 mt-1">

                                        <span class="offered-label">
                                            Offered Price:
                                        </span>

                                        <span class="aq-details-price">
                                            @if($price > 0)
                                                ₹{{ number_format($price) }}
                                            @else
                                                Contact For Price
                                            @endif
                                        </span>

                                        @if($price > 0)
                                            <span class="aq-details-price-unit">
                                                / unit (exclusive of GST)
                                            </span>
                                        @endif

                                    </div>

                                </div>

                                @if($product->min_qty)
                                    <p class="aq-moq-info mb-0 mt-2">
                                        <i class="fa-solid fa-circle-info mr-5"></i>
                                        Minimum Order Quantity (MOQ):
                                        <strong>{{ $product->min_qty }} Units</strong>
                                    </p>
                                @endif
                                @if($product->delivery_time)
                                    <p class="aq-moq-info mb-0 mt-2">
                                        <i class="fa-solid fa-truck-fast mr-5"></i>
                                        Delivery Time:
                                        <strong>{{ $product->delivery_time }}</strong>
                                    </p>
                                @endif
                            </div>
                            <p class="aq-details-short-desc">
                                {{ $product->sub_title }}
                            </p>

                            <!-- Kit Contents Summary List -->
                            <div class="aq-details-highlights mt-20 mb-25">
                                <h5 class="highlights-title">Gift Box Curated Contents:</h5>

                                <ul class="highlights-list">

                                    @forelse($product->inclusions as $inclusion)

                                        <li>
                                            <i class="fa-regular fa-circle-check"></i>
                                            {{ $inclusion->title }}
                                        </li>

                                    @empty

                                        <li>
                                            <i class="fa-regular fa-circle-check"></i>
                                            No inclusions available
                                        </li>

                                    @endforelse

                                </ul>
                            </div>

                            <!-- Co-Branding Customizer -->
                            <div class="aq-branding-panel p-3 mb-25">
                                <h5 class="aq-branding-title">
                                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                                    Customize & Co-brand Your Kit
                                </h5>

                                <div class="row g-3">

                                    @foreach($product->customizations as $index => $customization)

                                        <div class="col-sm-6">
                                            <button type="button" data-customization="{{ $customization->id }}"
                                                class="aq-branding-btn {{ $index == 0 ? 'active' : '' }} w-100 d-flex align-items-center justify-content-center gap-2"
                                                onclick="selectBrandingOption(this)">
                                                <i class="{{ $customization->icon ?: 'fa-solid fa-check' }}"></i>
                                                {{ $customization->title ?? $customization->name }}

                                            </button>
                                        </div>

                                    @endforeach

                                </div>
                                <input type="hidden" id="selectedCustomization"
                                    value="{{ $product->customizations->first()?->id }}">
                            </div>
                            <!-- Interactive Quantity Calculator -->
                            <div class="aq-calculator-panel p-3 mb-30">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">

                                    <div class="d-flex align-items-center gap-3">
                                        <label class="aq-qty-label">Order Qty:</label>

                                        <div class="aq-qty-selector">
                                            <button type="button" class="qty-btn"
                                                onclick="adjustQty(-{{ $product->min_qty ?? 1 }})">
                                                -
                                            </button>

                                            <input type="number" id="aqDetailQty" value="{{ $product->min_qty ?? 1 }}"
                                                min="{{ $product->min_qty ?? 1 }}" step="{{ $product->min_qty ?? 1 }}"
                                                oninput="calculateTotalEstimate()" />

                                            <button type="button" class="qty-btn"
                                                onclick="adjustQty({{ $product->min_qty ?? 1 }})">
                                                +
                                            </button>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <span class="aq-estimate-label">Estimated Budget:</span>

                                        <span id="aqTotalEstimateDisplay" class="aq-estimate-value">
                                            ₹{{ number_format(($product->price ?? 0) * ($product->min_qty ?? 1)) }}
                                        </span>
                                    </div>

                                </div>
                            </div>

                            <!-- Call to Action Buttons -->
                            <div class="d-flex flex-column flex-sm-row gap-3">
                            @if($product->cart)
                            <button data-id="{{ $product->id }}" class="aq-btn-black btn-red-bg flex-grow-1 aq-custom-quote-btn add-to-cart">
                                <i class="fa-solid fa-cart-plus"></i>
                                Add to Cart
                            </button>
                        @endif
                    
                        @if($product->whatsapp)
                            <a href="https://wa.me/919876543210" target="_blank" class="aq-btn-black flex-grow-1 aq-download-pdf-btn">
                                <i class="fa-brands fa-whatsapp"></i>
                                WhatsApp
                            </a>
                        @endif
                        
                                                @if($product->call)
                            <a href="tel:919876543210" class="call-btn">
                                <i class="fa-solid fa-phone"></i>
                                Call Now
                            </a>
                        @endif
                            </div>
                            <!--product-action-wrapper-->
                            <div class=" d-flex flex-column flex-sm-row gap-3">

                        <!--@if($product->cart)-->
                        <!--    <button data-id="{{ $product->id }}" class=" btn-red-bg flex-grow-1 aq-custom-quote-btn">-->
                        <!--        <i class="fa-solid fa-cart-plus"></i>-->
                        <!--        Add to Cart-->
                        <!--    </button>-->
                        <!--@endif-->
                    
                        <!--@if($product->whatsapp)-->
                        <!--    <a href="https://wa.me/919876543210" target="_blank" class=" flex-grow-1 aq-download-pdf-btn">-->
                        <!--        <i class="fa-brands fa-whatsapp"></i>-->
                        <!--        WhatsApp-->
                        <!--    </a>-->
                        <!--@endif-->
                    
                        <!--@if($product->call)-->
                        <!--    <a href="tel:919876543210" class="call-btn">-->
                        <!--        <i class="fa-solid fa-phone"></i>-->
                        <!--        Call Now-->
                        <!--    </a>-->
                        <!--@endif-->
                    
                    </div>


                        </div>
                    </div>


                </div>

                <!-- 2. Product Specification Tabs -->
                <div class="aq-details-tabs-wrapper mt-60">
                    <ul class="nav nav-tabs justify-content-center aq-details-nav-tabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#tab-desc"
                                type="button" role="tab">Full Description</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="brand-tab" data-bs-toggle="tab" data-bs-target="#tab-brand"
                                type="button" role="tab">Branding Specs</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#tab-shipping"
                                type="button" role="tab">Bulk Logistics & Direct
                                Dispatch</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="faqs-tab" data-bs-toggle="tab" data-bs-target="#tab-faqs"
                                type="button" role="tab">Curation FAQs</button>
                        </li>
                    </ul>
                    <div class="tab-content aq-details-tab-content p-4 mt-3">

                        <!-- Description Tab -->
                        <div class="tab-pane fade show active" id="tab-desc" role="tabpanel">
                            {!! $product->details !!}
                        </div>

                        <!-- Branding Specs Tab -->
                        <div class="tab-pane fade" id="tab-brand" role="tabpanel">
                            {!! $product->delivery_returns !!}
                        </div>

                        <!-- Logistics Tab -->
                        <div class="tab-pane fade" id="tab-shipping" role="tabpanel">
                            <h4 class="aq-tab-heading">Direct-to-Employee Shipping Logistics</h4>
                            <p class="aq-tab-text">
                                Managing onboarding logistics for distributed or remote teams is challenging. Thatâ€™s why
                                B2B Gifts India offers end-to-end direct-to-employee dispatch logistics.
                            </p>
                            <div class="row g-4 mt-3">
                                <div class="col-md-4">
                                    <div class="shipping-card p-3">
                                        <h5><i class="fa-solid fa-warehouse mr-5"></i> Free Warehousing</h5>
                                        <p>Buy welcome kits in volume discounts and store them in our secure cleanrooms. We
                                            ship them individually as your new employees join.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="shipping-card p-3">
                                        <h5><i class="fa-solid fa-truck-ramp-box mr-5"></i> Bulk Freight Dispatch</h5>
                                        <p>Freight shipping of assembled kits directly to your headquarters or regional
                                            office locations. Palletized and fully insured transit.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="shipping-card p-3">
                                        <h5><i class="fa-solid fa-globe mr-5"></i> PAN India Delivery</h5>
                                        <p>Express tracked shipments across 19,000+ PIN codes inside India with
                                            dashboard tracking and instant delivery confirmation.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQs Tab -->
                        <div class="tab-pane fade" id="tab-faqs" role="tabpanel">

                            <h4 class="aq-tab-heading">
                                Frequently Asked Questions
                            </h4>

                            <div class="accordion" id="aqDetailFaqAccordion">

                                @forelse($faqs as $faq)

                                    <div class="accordion-item aq-faq-item">

                                        <h2 class="accordion-header">

                                            <button class="accordion-button collapsed aq-faq-btn" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}">

                                                {{ $faq->question }}

                                            </button>

                                        </h2>

                                        <div id="faq{{ $faq->id }}" class="accordion-collapse collapse"
                                            data-bs-parent="#aqDetailFaqAccordion">

                                            <div class="accordion-body aq-faq-body">

                                                {!! $faq->answer !!}

                                            </div>

                                        </div>

                                    </div>

                                @empty

                                    <div class="alert alert-light border">
                                        No FAQs available for this product.
                                    </div>

                                @endforelse

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </section>

        <!-- 2. New Arrivals Section -->
        <section class="aq-new-arrivals-section pt-60 pb-60">
            <div class="container">
                <div class="row align-items-center mb-40">
                    <div class="col-12 text-center">
                        <div class="aq-creative-title-box">
                            <span class="aq-creative-subtitle">Latest Additions</span>
                            <h2 class="aq-creative-title">New Arrival Treasures</h2>
                            <div class="aq-creative-title-line"></div>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1 g-4 justify-content-center">

                    @forelse($newArrivals as $arrival)

                                @php
                                    $badge = '';
                                    $badgeClass = '';

                                    if ($arrival->best_seller) {
                                        $badge = 'Best Seller';
                                        $badgeClass = 'bestseller';
                                    } elseif ($arrival->new_arrival) {
                                        $badge = 'New';
                                        $badgeClass = 'new';
                                    } elseif ($arrival->sale) {
                                        $badge = 'Sale';
                                        $badgeClass = 'sale';
                                    }
                                @endphp

                                <div class="col">

                                    <div class="aq-product-card">

                                        <div class="aq-product-card-top">

                                            <img src="{{ $arrival->display_image
                        ? asset('storage/' . $arrival->display_image)
                        : asset('assets/img/no-image.webp') }}" class="aq-product-card-img"
                                                alt="{{ $arrival->name }}" />

                                            @if($badge)
                                                <div class="aq-product-badges">
                                                    <span class="aq-product-badge {{ $badgeClass }}">
                                                        {{ $badge }}
                                                    </span>
                                                </div>
                                            @endif

                                            <div class="aq-product-brand-badge">
                                                @if(optional($arrival->brand)->logo)
                                                    <img src="{{ asset('storage/' . $arrival->brand->logo) }}"
                                                        alt="{{ $arrival->brand->name }}">
                                                @endif
                                            </div>

                                            <div class="aq-product-actions">
                                                <button class="aq-product-action-btn" title="Quick Consultation"
                                                    onclick="openGlobalDrawer('product-details')">
                                                    <i class="fa-regular fa-envelope"></i>
                                                </button>
                                            </div>

                                        </div>

                                        <div class="aq-product-card-info">

                                            <span class="aq-product-card-brand-name">
                                                {{ optional($arrival->brand)->name }}
                                            </span>

                                            <h4 class="aq-product-card-title">
                                                <a href="{{ route('product.details', $arrival->slug) }}">
                                                    {{ $arrival->name }}
                                                </a>
                                            </h4>

                                            <p>
                                                {{ Str::limit(strip_tags($arrival->sub_title), 80) }}
                                            </p>

                                            <div class="aq-product-card-bottom">

                                                <div class="aq-product-card-price">
                                                    ₹{{ number_format($arrival->price) }}
                                                    <span>/ unit</span>
                                                </div>

                                                <button class="aq-product-card-cta" onclick="openGlobalDrawer('product-details')">
                                                    Enquire
                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                    @empty

                        <div class="col-12 text-center">
                            <p>No new arrivals available.</p>
                        </div>

                    @endforelse

                </div>
            </div>
        </section>

        <!-- 3. Related Products Section -->
        <section class="aq-related-products-section pt-60 pb-60">
            <div class="container">
                <div class="row align-items-center mb-40">
                    <div class="col-12 text-center">
                        <div class="aq-creative-title-box">
                            <span class="aq-creative-subtitle">Bespoke Collection Drawer</span>
                            <h2 class="aq-creative-title">Related Products</h2>
                            <div class="aq-creative-title-line"></div>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1 g-4 justify-content-center">

                    @forelse($relatedProducts as $related)

                                @php
                                    $badge = '';
                                    $badgeClass = '';

                                    if ($related->best_seller) {
                                        $badge = 'Best Seller';
                                        $badgeClass = 'bestseller';
                                    } elseif ($related->new_arrival) {
                                        $badge = 'New';
                                        $badgeClass = 'new';
                                    } elseif ($related->sale) {
                                        $badge = 'Sale';
                                        $badgeClass = 'sale';
                                    }
                                @endphp

                                <div class="col">

                                    <div class="aq-product-card">

                                        <div class="aq-product-card-top">

                                            <img src="{{ $related->display_image
                        ? asset('storage/' . $related->display_image)
                        : asset('assets/img/no-image.webp') }}" class="aq-product-card-img"
                                                alt="{{ $related->name }}" />

                                            @if($badge)
                                                <div class="aq-product-badges">
                                                    <span class="aq-product-badge {{ $badgeClass }}">
                                                        {{ $badge }}
                                                    </span>
                                                </div>
                                            @endif

                                            <div class="aq-product-brand-badge">
                                                @if(optional($related->brand)->logo)
                                                    <img src="{{ asset('storage/' . $related->brand->logo) }}"
                                                        alt="{{ $related->brand->name }}">
                                                @endif
                                            </div>

                                            <div class="aq-product-actions">
                                                <button class="aq-product-action-btn" onclick="openGlobalDrawer('product-details')">
                                                    <i class="fa-regular fa-envelope"></i>
                                                </button>
                                            </div>

                                        </div>

                                        <div class="aq-product-card-info">

                                            <span class="aq-product-card-brand-name">
                                                {{ optional($related->brand)->name }}
                                            </span>

                                            <h4 class="aq-product-card-title">
                                                <a href="{{ route('product.details', $related->slug) }}">
                                                    {{ $related->name }}
                                                </a>
                                            </h4>

                                            <p>
                                                {{ Str::limit(strip_tags($related->sub_title), 80) }}
                                            </p>

                                            <div class="aq-product-card-bottom">

                                                <div class="aq-product-card-price">
                                                    ₹{{ number_format($related->price) }}
                                                    <span>/ unit</span>
                                                </div>

                                                <button class="aq-product-card-cta" onclick="openGlobalDrawer('product-details')">
                                                    Enquire
                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                    @empty

                        <div class="col-12 text-center">
                            <p>No related products found.</p>
                        </div>

                    @endforelse

                </div>
            </div>
        </section>

        <!-- 4. Complete Product Listing Catalog (Bottom Showcase) -->
        <section class="aq-bottom-catalog-section pt-60 pb-80">
            <div class="container">
                <div class="row align-items-center mb-40">
                    <div class="col-12 text-center">
                        <div class="aq-creative-title-box">
                            <span class="aq-creative-subtitle">Premium Corporate Catalog</span>
                            <h2 class="aq-creative-title">
                                Explore Other Categories
                            </h2>
                            <div class="aq-creative-title-line"></div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-12">

                        <div class="aq-product-grid">

                            @foreach($otherCategories as $category)

                                                <div class="aq-product-card">

                                                    <div class="aq-product-card-top">

                                                        <img src="{{ $category->image
                                ? asset('storage/' . $category->image)
                                : asset('assets/img/no-image.webp') }}" class="aq-product-card-img"
                                                            alt="{{ $category->name }}">

                                                    </div>

                                                    <div class="aq-product-card-info">

                                                        <h4 class="aq-product-card-title">
                                                            <a href="{{ route('category.products', $category->slug) }}">
                                                                {{ $category->name }}
                                                            </a>
                                                        </h4>

                                                        <p>
                                                            {{ Str::limit(strip_tags($category->short_description), 80) }}
                                                        </p>

                                                        <div class="aq-product-card-bottom">

                                                            <a href="{{ route('category.products', $category->slug) }}"
                                                                class="aq-product-card-cta">
                                                                Explore
                                                            </a>

                                                        </div>

                                                    </div>

                                                </div>

                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Product Details Custom Interactive Logic Scripts -->
        <script>
            function updateMainImage(thumb, imgSrc) {
                const mainImg = document.getElementById('aqMainProductImg');

                if (mainImg) {
                    mainImg.src = imgSrc;
                }

                const thumbs = document.querySelectorAll('.aq-gallery-thumb-item');

                thumbs.forEach(t => t.classList.remove('active'));

                thumb.classList.add('active');
            }

            function adjustQty(amount) {

                const qtyInput = document.getElementById('aqDetailQty');

                if (qtyInput) {

                    const minQty = {{ $product->min_qty ?? 1 }};

                    let newVal = parseInt(qtyInput.value) + amount;

                    if (newVal < minQty) {
                        newVal = minQty;
                    }

                    qtyInput.value = newVal;

                    calculateTotalEstimate();
                }
            }

            function calculateTotalEstimate() {

                const qtyInput = document.getElementById('aqDetailQty');
                const totalDisplay = document.getElementById('aqTotalEstimateDisplay');

                if (qtyInput && totalDisplay) {

                    const minQty = {{ $product->min_qty ?? 1 }};
                    const qty = parseInt(qtyInput.value) || minQty;

                    const pricePerUnit = {{ $product->price ?? 0 }};

                    const total = qty * pricePerUnit;

                    totalDisplay.innerText =
                        '₹' + total.toLocaleString('en-IN');
                }
            }

            function handleLogoUpload(input) {
                const label = document.getElementById('logoUploadLabel');

                if (input.files && input.files.length > 0) {

                    const fileName = input.files[0].name;

                    label.innerText = fileName;

                    label.parentElement.style.borderColor = '#28a745';
                    label.parentElement.style.color = '#28a745';
                    label.parentElement.style.background = '#f4fbf6';
                }
            }

            function selectBrandingOption(button) {

                const buttons = document.querySelectorAll('.aq-branding-btn');

                buttons.forEach(btn => {

                    btn.style.border = '1.5px solid rgba(0, 49, 8, 0.15)';
                    btn.style.background = '#ffffff';
                    btn.style.color = '#003108';
                    btn.style.boxShadow = 'none';

                    btn.classList.remove('active');
                });

                button.style.border = '2px solid #003108';
                button.style.background = '#003108';
                button.style.color = '#ffffff';
                button.style.boxShadow = '0 4px 10px rgba(0, 49, 8, 0.1)';

                button.classList.add('active');
                document.getElementById('selectedCustomization').value =
                    button.dataset.customization;
            }

            // Initial estimate on page load
            document.addEventListener('DOMContentLoaded', function () {
                calculateTotalEstimate();
            });

            document.querySelectorAll('.add-to-cart').forEach(btn => {
                btn.addEventListener('click', function () {

                    let productId = this.getAttribute('data-id');

                    fetch("{{ route('cart.add') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            customization_id: document.getElementById('selectedCustomization').value
                        })
                    })
                        .then(res => res.json())
                        .then(data => {

                            // ✅ Update Cart Count
                            // document.getElementById('cart-count').innerText = data.cart_count;

                            // ✅ Swal
                            Swal.fire({
                                icon: 'success',
                                title: 'Added!',
                                text: data.message,
                                showCancelButton: true,
                                confirmButtonText: 'Go to Cart',
                                cancelButtonText: 'Continue Shopping'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('shopping-cart') }}";
                                }
                            });

                        });

                });
            });

        </script>
        <!-- collection area end -->



@endsection