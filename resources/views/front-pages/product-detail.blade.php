@extends('layouts.app')
@section('content')

    <main>

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
                <h1 class="aq-catpage-title">{{ $product->name }}</h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <a href="{{ route('products.listing', $product->category->slug) }}">
                        {{ $product->category->name }}
                    </a>
                    <span>/</span>
                    <span>Product Details</span>
                </div>
            </div>
        </section>


        <!-- 1. Luxury Product Details Container -->
        <section class="aq-product-details-area pt-50 pb-60">
            <div class="container">
                <!-- Elegant Breadcrumbs -->
                <div class="aq-details-breadcrumbs mb-40">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="divider">/</span>
                    <a href="{{ route('products.listing', $product->category->slug) }}">
                        {{ $product->category->name }}
                    </a>
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

                                @foreach($product->collections->take(2) as $index => $collection)

                                    <span class="aq-gallery-badge {{ $index == 0 ? 'bestseller' : 'logo-branding' }}">
                                        {{ $collection->name }}
                                    </span>

                                @endforeach

                            </div>
                            <div class="aq-gallery-main-img-wrap">
                                <img id="aqMainProductImg" src="{{ $product->display_image }}" alt="{{ $product->name }}"
                                    class="aq-gallery-main-img" />
                                <div class="aq-gallery-zoom-hint"><i class="fa-solid fa-magnifying-glass-plus"></i> Roll
                                    over image to zoom</div>
                            </div>
                            <!-- Gallery Thumbnails -->
                            <div class="aq-gallery-thumbs mt-25">

                                @foreach($product->images as $index => $image)

                                    <div class="aq-gallery-thumb-item {{ $index == 0 ? 'active' : '' }}"
                                        onclick="updateMainImage(this, '{{ asset('storage/' . $image->image) }}')">

                                        <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}" />

                                    </div>

                                @endforeach

                            </div>
                        </div>

                        <!-- SUITABLE FOR SELECTIONS -->
                        <div class="aq-details-suitable-wrap mt-30 mb-20">
                            <h5 class="aq-details-suitable-title">
                                <i class="fa-solid fa-check-double"></i> Perfectly Suited For
                            </h5>

                            <!-- Occasions Grid -->
                            <div class="aq-details-suitable-grid">
                                @foreach($product->occasions as $occasion)

                                    <div class="aq-details-suitable-item">
                                        <div class="aq-details-suitable-icon">
                                            <i class="fa-solid fa-gift"></i>
                                        </div>

                                        <span>{{ $occasion->title }}</span>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                        <!-- Trust Badges Section -->
                        <div class="aq-luxury-trust-badges">

                            @if($product->pan_india)
                                <div class="aq-trust-badge-item">
                                    <span class="aq-trust-badge-icon">
                                        <i class="fa-solid fa-truck-fast"></i>
                                    </span>
                                    <div class="aq-trust-badge-content">
                                        <span class="aq-trust-badge-text">
                                            PAN India Delivery
                                        </span>
                                        <span class="aq-trust-badge-sub">
                                            {{ $product->delivery_time ?: 'Express Shipping Available' }}
                                        </span>
                                    </div>
                                </div>
                            @endif

                            @if($product->quality)
                                <div class="aq-trust-badge-item">
                                    <span class="aq-trust-badge-icon">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </span>
                                    <div class="aq-trust-badge-content">
                                        <span class="aq-trust-badge-text">
                                            100% Quality Audited
                                        </span>
                                        <span class="aq-trust-badge-sub">
                                            Strict Assurance Audit
                                        </span>
                                    </div>
                                </div>
                            @endif

                        </div>

                    </div>

                    <!-- Right Column: Product Specs & Ordering Drawer Trigger -->
                    <div class="col-lg-6 col-md-12">
                        <div class="aq-product-details-summary">
                            <span class="aq-details-brand">
                                {{ $product->subcategory->name ?? $product->category->name }}
                            </span>
                            <h2 class="aq-details-title">
                                {{ $product->name }}
                            </h2>

                            <!-- Star reviews rating -->
                            <div class="aq-details-rating-wrap d-flex align-items-center gap-2 mt-10 mb-15">
                                <div class="aq-details-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa-{{ $i <= round($avgRating) ? 'solid' : 'regular' }} fa-star"></i>
                                    @endfor
                                </div>
                                <span class="aq-details-rating-text">
                                    ({{ $avgRating }} / 5 from {{ $reviewsCount }} verified customer
                                    {{ Str::plural('review', $reviewsCount) }})
                                </span>
                            </div>

                            <!-- Pricing box -->
                            <div class="aq-details-price-box p-3 mb-25">
                                <div class="d-flex flex-column gap-1">
                                    @php
                                        $discount = ($product->mrp > 0)
                                            ? round((($product->mrp - $product->price) / $product->mrp) * 100)
                                            : 0;
                                    @endphp

                                    @if($discount > 0)
                                        <div class="aq-price-mrp-row d-flex align-items-center gap-2 mb-2">
                                            <span class="mrp-label">
                                                MRP:
                                                <span class="mrp-value" id="productMrp">
                                                    ₹{{ number_format($product->mrp) }}
                                                </span>
                                            </span>

                                            <span class="discount-badge" id="productDiscount">
                                                DISCOUNT: {{ $discount }}% OFF
                                            </span>
                                        </div>
                                    @endif

                                    <div class="aq-price-offered-row d-flex align-items-baseline gap-2">
                                        <span class="offered-label">Offered Price:</span>

                                        <span class="aq-details-price" id="productPrice">
                                            ₹{{ number_format($product->price) }}
                                        </span>

                                        <span class="aq-details-price-unit">
                                            / unit (exclusive of GST)
                                        </span>
                                    </div>
                                </div>
                                <div class="aq-moq-info-list">
                                    <!-- <p class="mb-2">
                                                                        <i class="fa-solid fa-circle-info"></i> Minimum Order Quantity (MOQ):
                                                                        <strong>{{ $product->min_qty }}</strong>
                                                                    </p> -->
                                    <p class="mb-0">
                                        <i class="fa-solid fa-truck-fast"></i> Delivery Time:
                                        <strong>{{ $product->delivery_time }}</strong>
                                    </p>
                                </div>
                            </div>

                            <p class="aq-details-short-desc">
                                {{ $product->short_description }}
                            </p>

                            <div class="aq-creative-details-block mt-25 mb-30">

                                @php
                                    $groupedAttributes = $product->attributeValues
                                        ->filter(function ($item) use ($variantAttributes) {
                                            return $item->attribute
                                                && $item->value
                                                && !isset($variantAttributes[$item->attribute_id]);
                                        })
                                        ->groupBy('attribute_id');
                                @endphp

                                @foreach($groupedAttributes as $items)

                                    <div class="aq-detail-item">
                                        <span class="detail-label">
                                            {{ $items->first()->attribute->name }}
                                        </span>

                                        <span class="detail-value">
                                            {{ $items->pluck('value.value')->implode(', ') }}
                                        </span>
                                    </div>

                                @endforeach

                            </div>

                            <!-- Co-Branding Customizer -->
                            <!-- Size Selection -->
                            @foreach($variantAttributes as $attributeId => $attribute)

                                <div class="aq-size-selection-panel p-3">

                                    <h5 class="aq-size-title mb-2">
                                        {{ $attribute['name'] }}
                                    </h5>

                                    <div class="aq-product-size-row gap-2">

                                        @foreach($attribute['values'] as $valueId => $value)

                                            <button type="button" class="aq-size-badge variant-option"
                                                data-attribute-id="{{ $attributeId }}" data-value-id="{{ $valueId }}">

                                                {{ $value }}

                                            </button>

                                        @endforeach

                                    </div>

                                </div>

                            @endforeach

                            <!-- Interactive Quantity and Action -->
                            <div class="aq-action-panel p-3 mb-30 mt-25">
                                <div class="d-flex flex-column flex-sm-row align-items-center gap-3">
                                    <div class="aq-qty-selector luxury-qty">
                                        <button type="button" class="qty-btn" onclick="adjustQty(-1)"><i
                                                class="fa-solid fa-minus"></i></button>
                                        <input type="number" id="aqDetailQty" value="{{ $product->min_qty }}"
                                            min="{{ $product->min_qty }}" max="{{ $product->stock }}" />

                                        <span id="currentStock" class="d-none">
                                            {{ $product->stock }}
                                        </span>
                                        <button type="button" class="qty-btn" onclick="adjustQty(1)"><i
                                                class="fa-solid fa-plus"></i></button>
                                    </div>
                                    @if($product->stock >= $product->min_qty)

                                        <button type="button"
                                            class="aq-btn-black flex-grow-1 aq-add-to-cart-btn luxury-btn-outline"
                                            onclick="addToCart({{ $product->id }})">
                                            <i class="fa-solid fa-bag-shopping"></i>
                                            Add to Cart
                                        </button>
                                    @else
                                        <button type="button" class="aq-btn-black flex-grow-1 luxury-btn-outline" disabled
                                            style="background:#999;cursor:not-allowed;">
                                            <i class="fa-solid fa-ban"></i>
                                            Out of Stock
                                        </button>
                                    @endif
                                </div>
                                @if($product->stock >= $product->min_qty)
                                    <button class="aq-btn-black btn-red-bg w-100 mt-3 aq-buy-now-btn luxury-btn-solid"
                                        onclick="addToCart({{ $product->id }})">
                                        Buy it Now
                                    </button>
                                @else
                                    <button class="aq-btn-black btn-red-bg w-100 mt-3 luxury-btn-solid" disabled
                                        style="background:#999;cursor:not-allowed;">
                                        Out of Stock
                                    </button>
                                @endif
                            </div>
                        </div>


                    </div>

                    <!-- 2. Product Specification Tabs -->
                    <div class="aq-details-tabs-wrapper mt-60">
                        <ul class="nav nav-tabs justify-content-center aq-details-nav-tabs" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" id="desc-tab" data-bs-toggle="tab"
                                    data-bs-target="#tab-desc" type="button" role="tab">Full Description</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="brand-tab" data-bs-toggle="tab" data-bs-target="#tab-brand"
                                    type="button" role="tab">Fabric & Care</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="shipping-tab" data-bs-toggle="tab"
                                    data-bs-target="#tab-shipping" type="button" role="tab">Shipping & Returns</button>
                            </li>
                            @if($setting && $setting->product_reviews)

                                <li class="nav-item">
                                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#tab-reviews"
                                        type="button" role="tab">Reviews ({{ $reviewsCount }})</button>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content aq-details-tab-content p-4 mt-3">

                            <!-- Description Tab -->
                            <div class="tab-pane fade show active" id="tab-desc" role="tabpanel">
                                {!! $product->description !!}

                            </div>

                            <!-- Branding Specs Tab -->
                            <div class="tab-pane fade" id="tab-brand" role="tabpanel">
                                {!! $product->fabric_care !!}
                            </div>

                            <!-- Logistics Tab -->
                            <div class="tab-pane fade" id="tab-shipping" role="tabpanel">
                                {!! $product->delivery_returns !!}

                            </div>


                            <div class="tab-pane fade" id="tab-reviews" role="tabpanel">
                                <h4 class="aq-tab-heading">Customer Reviews</h4>

                                @if($reviews->isEmpty())
                                    <p class="aq-tab-text">No reviews yet for this product.</p>
                                @else
                                    @foreach($reviews as $review)
                                        <div class="aq-review-item mb-30 pb-3 border-bottom">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <div class="aq-review-stars mb-1">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="fa-{{ $i <= $review->rating ? 'solid' : 'regular' }} fa-star"></i>
                                                        @endfor
                                                    </div>
                                                    <strong class="aq-review-title">{{ $review->title }}</strong>
                                                </div>
                                                @if($review->verified_purchase)
                                                    <span class="badge bg-success">Verified Purchase</span>
                                                @endif
                                            </div>

                                            <p class="aq-review-body mt-2 mb-2">
                                                {{ $review->review }}
                                            </p>

                                            @if($review->images->isNotEmpty())
                                                <div class="aq-review-images d-flex gap-2 mb-2">
                                                    @foreach($review->images as $image)
                                                        <img src="{{ asset('storage/' . $image->image) }}" alt="Review image"
                                                            style="width:70px;height:70px;object-fit:cover;border-radius:6px;" />
                                                    @endforeach
                                                </div>
                                            @endif

                                            <span class="text-muted small">
                                                {{ $review->customer->name ?? 'Anonymous' }} ·
                                                {{ $review->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                    @endforeach

                                    <div class="mt-30">
                                        {{ $reviews->links() }}
                                    </div>
                                @endif
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
                            <span class="aq-creative-subtitle">Our Latest Collections</span>
                            <h2 class="aq-creative-title">New Arrivals</h2>
                            <div class="aq-creative-title-line"></div>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1 g-4 justify-content-center">
                    @foreach($newArrivals as $newArrival)

                        @php
                            $otherImages = $newArrival->images
                                ->where('is_default', 0)
                                ->values();
                        @endphp

                        <div class="col">
                            <div class="aq-product-card" data-category="onboarding" data-price="1899">
                                <div class="aq-product-card-top">
                                    <div class="aq-product-media-wrapper">

                                        <img src="{{ $newArrival->display_image }}" class="aq-product-card-img primary-img"
                                            alt="{{ $newArrival->name }}" />

                                        <img src="{{ isset($otherImages[0]) ? asset('storage/' . $otherImages[0]->image) : $newArrival->display_image }}"
                                            class="secondary-img" alt="{{ $newArrival->name }}" />

                                        <img src="{{ isset($otherImages[1]) ? asset('storage/' . $otherImages[1]->image) : $newArrival->display_image }}"
                                            class="tertiary-img" alt="{{ $newArrival->name }}" />

                                        <video src="{{ asset('assets/img/corporate/reals_video.mp4') }}"
                                            class="aq-product-card-video" muted loop playsinline>
                                        </video>

                                        <div class="aq-product-media-indicator">
                                            <span class="aq-media-dot active"></span>
                                            <span class="aq-media-dot"></span>
                                            <span class="aq-media-dot"></span>
                                            <span class="aq-media-dot"></span>
                                        </div>

                                    </div>
                                    @if($newArrival->collections->isNotEmpty())
                                        <div class="aq-product-badges">
                                            <span class="aq-product-badge bestseller">
                                                {{ $newArrival->collections->first()->name }}
                                            </span>
                                        </div>
                                    @endif

                                    <div class="aq-product-brand-badge">
                                        <img src="{{ $newArrival->display_image }}" alt="{{ $newArrival->name }}" />
                                    </div>

                                    <div class="aq-product-actions">
                                        <button class="aq-product-action-btn" title="Quick Consultation"
                                            onclick="openGlobalDrawer('about_page')">
                                            <i class="fa-regular fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="aq-product-card-info">
                                    <span class="aq-product-card-brand-name">
                                        {{ $newArrival->subcategory->name ?? $newArrival->category->name }}
                                    </span>

                                    <h4 class="aq-product-card-title">
                                        <a href="{{ route('product.details', $newArrival->slug) }}">
                                            {{ $newArrival->name }}
                                        </a>
                                    </h4>
                                    <p class="aq-product-card-desc">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($newArrival->short_description), 80) }}
                                    </p>

                                    <div class="aq-product-card-price-group">

                                        <span class="aq-product-card-price">
                                            ₹{{ number_format($newArrival->price) }}
                                        </span>

                                        @if($newArrival->mrp > $newArrival->price)
                                            <span class="aq-product-card-old-price">
                                                ₹{{ number_format($newArrival->mrp) }}
                                            </span>

                                            <span class="aq-product-card-discount">
                                                ({{ round((($newArrival->mrp - $newArrival->price) / $newArrival->mrp) * 100) }}%
                                                OFF)
                                            </span>
                                        @endif

                                    </div>
                                    <div class="aq-product-card-sizes">
                                        <span class="aq-size-badge">S</span>
                                        <span class="aq-size-badge">M</span>
                                        <span class="aq-size-badge active">L</span>
                                        <span class="aq-size-badge">XL</span>
                                        <span class="aq-size-badge">XXL</span>
                                    </div>
                                    <div class="aq-product-card-bottom">
                                        <button class="aq-product-card-cta">
                                            <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </section>

        <!-- 3. Related Products Section -->
        <section class="aq-related-products-section pt-60 pb-60">
            <div class="container">
                <div class="row align-items-center mb-40">
                    <div class="col-12 text-center">
                        <div class="aq-creative-title-box">
                            <span class="aq-creative-subtitle">View Other Products</span>
                            <h2 class="aq-creative-title">Related Products</h2>
                            <div class="aq-creative-title-line"></div>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1 g-4 justify-content-center">

                    @foreach($relatedProducts as $relatedProduct)

                        @php
                            $otherImages = $relatedProduct->images
                                ->where('is_default', 0)
                                ->values();
                        @endphp

                        <div class="col">
                            <div class="aq-product-card" data-category="onboarding" data-price="1899">
                                <div class="aq-product-card-top">
                                    <div class="aq-product-media-wrapper">

                                        <img src="{{ $relatedProduct->display_image }}" class="aq-product-card-img primary-img"
                                            alt="{{ $relatedProduct->name }}" />

                                        <img src="{{ isset($otherImages[0]) ? asset('storage/' . $otherImages[0]->image) : $relatedProduct->display_image }}"
                                            class="secondary-img" alt="{{ $relatedProduct->name }}" />

                                        <img src="{{ isset($otherImages[1]) ? asset('storage/' . $otherImages[1]->image) : $relatedProduct->display_image }}"
                                            class="tertiary-img" alt="{{ $relatedProduct->name }}" />

                                        <video src="{{ asset('assets/img/corporate/reals_video.mp4') }}"
                                            class="aq-product-card-video" muted loop playsinline>
                                        </video>

                                        <div class="aq-product-media-indicator">
                                            <span class="aq-media-dot active"></span>
                                            <span class="aq-media-dot"></span>
                                            <span class="aq-media-dot"></span>
                                            <span class="aq-media-dot"></span>
                                        </div>

                                    </div>
                                    @if($relatedProduct->collections->isNotEmpty())
                                        <div class="aq-product-badges">
                                            <span class="aq-product-badge bestseller">
                                                {{ $relatedProduct->collections->first()->name }}
                                            </span>
                                        </div>
                                    @endif

                                    <div class="aq-product-brand-badge">
                                        <img src="{{ $relatedProduct->display_image }}" alt="{{ $relatedProduct->name }}" />
                                    </div>

                                    <div class="aq-product-actions">
                                        <button class="aq-product-action-btn" title="Quick Consultation"
                                            onclick="openGlobalDrawer('about_page')"></button>
                                        <i class="fa-regular fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="aq-product-card-info">
                                    <span class="aq-product-card-brand-name">
                                        {{ $relatedProduct->subcategory->name ?? $relatedProduct->category->name }}
                                    </span>

                                    <h4 class="aq-product-card-title">
                                        <a href="{{ route('product.details', $relatedProduct->slug) }}">
                                            {{ $relatedProduct->name }}
                                        </a>
                                    </h4>
                                    <p class="aq-product-card-desc">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($relatedProduct->short_description), 80) }}
                                    </p>

                                    <div class="aq-product-card-price-group">

                                        <span class="aq-product-card-price">
                                            ₹{{ number_format($relatedProduct->price) }}
                                        </span>

                                        @if($relatedProduct->mrp > $relatedProduct->price)
                                            <span class="aq-product-card-old-price">
                                                ₹{{ number_format($relatedProduct->mrp) }}
                                            </span>

                                            <span class="aq-product-card-discount">
                                                ({{ round((($relatedProduct->mrp - $relatedProduct->price) / $relatedProduct->mrp) * 100) }}%
                                                OFF)
                                            </span>
                                        @endif

                                    </div>
                                    <div class="aq-product-card-sizes">
                                        <span class="aq-size-badge">S</span>
                                        <span class="aq-size-badge">M</span>
                                        <span class="aq-size-badge active">L</span>
                                        <span class="aq-size-badge">XL</span>
                                        <span class="aq-size-badge">XXL</span>
                                    </div>
                                    <div class="aq-product-card-bottom">
                                        <button class="aq-product-card-cta">
                                            <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </section>



    </main>

    <input type="hidden" id="currentUnitPrice" value="{{ $product->price }}">

    <input type="hidden" id="currentUnitMrp" value="{{ $product->mrp }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Product Details Custom Interactive Logic Scripts -->

    <script>

        const variants = @json($variantsJson);

        let selectedValues = [];

        $(document).on(
            'click',
            '.variant-option',
            function () {

                const valueId =
                    parseInt($(this).data('value-id'));

                const attributeId =
                    $(this).data('attribute-id');

                $('.variant-option[data-attribute-id="' +
                    attributeId +
                    '"]')
                    .removeClass('active');

                $(this).addClass('active');

                selectedValues =
                    $('.variant-option.active')
                        .map(function () {

                            return parseInt(
                                $(this).data('value-id')
                            );

                        }).get();

                const matchedVariant =
                    variants.find(function (variant) {

                        return selectedValues.every(
                            value =>
                                variant.values.includes(value)
                        );

                    });

                if (matchedVariant) {

                    $('#currentUnitPrice').val(
                        matchedVariant.price
                    );

                    $('#currentUnitMrp').val(
                        matchedVariant.mrp
                    );

                    updatePriceByQty();

                    $('#currentStock').text(matchedVariant.stock);

                    if (matchedVariant.stock > 0) {
                        $('#aqDetailQty')
                            .attr('max', matchedVariant.stock)
                            .val(
                                Math.max(
                                    parseInt($('#aqDetailQty').attr('min')) || 1,
                                    Math.min(
                                        parseInt($('#aqDetailQty').val()) || 1,
                                        matchedVariant.stock
                                    )
                                )
                            );
                    } else {
                        $('#aqDetailQty')
                            .attr('max', 0)
                            .val(0);
                    }

                    if (matchedVariant.stock < 1) {

                        $('.aq-add-to-cart-btn')
                            .prop('disabled', true)
                            .html('<i class="fa-solid fa-ban"></i> Out of Stock');

                        $('.aq-buy-now-btn')
                            .prop('disabled', true)
                            .text('Out of Stock');

                    } else {

                        $('.aq-add-to-cart-btn')
                            .prop('disabled', false)
                            .html('<i class="fa-solid fa-bag-shopping"></i> Add to Cart');

                        $('.aq-buy-now-btn')
                            .prop('disabled', false)
                            .text('Buy it Now');
                    }

                    if (matchedVariant.image) {

                        $('#aqMainProductImg').attr(
                            'src',
                            '/storage/' + matchedVariant.image
                        );
                    }
                }

            }
        );

        function updateMainImage(thumb, imgSrc) {
            // Update main image src
            const mainImg = document.getElementById('aqMainProductImg');
            if (mainImg) {
                mainImg.src = imgSrc;
            }
            // Toggle active thumbnail states
            const thumbs = document.querySelectorAll('.aq-gallery-thumb-item');
            thumbs.forEach(t => t.classList.remove('active'));
            thumb.classList.add('active');
        }

        function adjustQty(amount) {

            const qtyInput = document.getElementById('aqDetailQty');

            if (!qtyInput) return;

            const minQty = parseInt(qtyInput.min) || 1;
            const maxQty = parseInt(qtyInput.max) || 0;

            let newVal = parseInt(qtyInput.value || minQty) + amount;

            if (newVal < minQty) {
                newVal = minQty;
            }

            if (maxQty > 0 && newVal > maxQty) {
                newVal = maxQty;
            }

            qtyInput.value = newVal;
            updatePriceByQty();
        }

        function updatePriceByQty() {

            const qty =
                parseInt($('#aqDetailQty').val()) || 1;

            const unitPrice =
                parseFloat($('#currentUnitPrice').val()) || 0;

            const unitMrp =
                parseFloat(
                    $('#currentUnitMrp').val()
                ) || 0;

            const totalPrice =
                qty * unitPrice;

            const totalMrp =
                qty * unitMrp;

            $('#productPrice').text(
                '₹' + totalPrice.toLocaleString('en-IN')
            );

            $('#productMrp').text(
                '₹' + totalMrp.toLocaleString('en-IN')
            );

            let discount = 0;

            if (
                totalMrp > 0 &&
                totalPrice < totalMrp
            ) {
                discount = Math.round(
                    ((totalMrp - totalPrice) / totalMrp) * 100
                );
            }

            $('#productDiscount').text(
                'DISCOUNT: ' + discount + '% OFF'
            );
        }
        document.getElementById('aqDetailQty')?.addEventListener('change', function () {

            const minQty = parseInt(this.min) || 1;
            const maxQty = parseInt(this.max) || 0;

            let value = parseInt(this.value) || minQty;

            if (value < minQty) {
                value = minQty;
            }

            if (maxQty > 0 && value > maxQty) {
                value = maxQty;
            }

            this.value = value;
            updatePriceByQty();
        });

        function addToCart(productId) {
            const stock = parseInt($('#currentStock').text()) || 0;
            const quantity = parseInt($('#aqDetailQty').val());

            if (stock <= 0 || quantity > stock) {

                Swal.fire({
                    icon: 'error',
                    title: 'Out of Stock',
                    text: 'Requested quantity is not available.'
                });

                return;
            }

            let variantId = null;

            const selectedValues = $('.variant-option.active')
                .map(function () {
                    return parseInt($(this).data('value-id'));
                })
                .get();

            if (typeof variants !== 'undefined' && variants.length > 0) {

                const matchedVariant = variants.find(function (variant) {

                    return selectedValues.every(
                        value => variant.values.includes(value)
                    );

                });

                if (matchedVariant) {
                    variantId = matchedVariant.id;
                }
            }

            $.ajax({
                url: "{{ route('cart.add') }}",
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    product_id: productId,
                    variant_id: variantId,
                    quantity: quantity
                },
                success: function (response) {

                    if (response.status) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        $('.cart-count').text(
                            response.cart_count
                        );

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Unable to add product.'
                        });

                    }
                },
                error: function (xhr) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message ??
                            'Something went wrong.'
                    });

                }
            });
        }

    </script>

@endsection