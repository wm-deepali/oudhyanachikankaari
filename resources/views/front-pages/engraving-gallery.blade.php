@extends('layouts.app')


@section('content')

    <main>


        <!-- 1. Luxury Inner Banner / Hero Section -->
        <section class="aq-catpage-hero">
            <div class="aq-hero-glow"></div>
            <div class="aq-floating-gift-box aq-floating-shape-1">
                <i class="fa-solid fa-pen-nib"></i>
            </div>
            <div class="aq-floating-gift-box aq-floating-shape-2">
                <i class="fa-solid fa-gem"></i>
            </div>
            <div class="aq-catpage-hero-content">
                <h1 class="aq-catpage-title">Engraving Gallery</h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="index.html">Home</a>
                    <span>/</span>
                    <span>Engraving Gallery</span>
                </div>
            </div>
        </section>

        <div class="aq-engraving-page-wrap">

            <!-- Intro Section -->
            <section class="aq-engraving-intro-section">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-8">
                            <span class="aq-section-title-sm aq-engraving-title-sm">PRECISION ENGRAVING SOLUTIONS</span>
                            <h2 class="aq-section-title aq-engraving-main-title">Engraved Corporate Gifts</h2>
                            <p class="aq-section-desc aq-engraving-desc">
                                Discover a curated range of premium products crafted for precision engraving. From logo
                                detailing to personalized branding, we help you create refined, long-lasting impressions
                                with every gift.
                            </p>
                            <button type="button" class="aq-engraving-btn" onclick="openGlobalDrawer('engraving_gallery')">
                                Get Your Brand Engraved <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Gallery Section -->
            <section class="aq-engraving-gallery-section">
                <div class="container">
                    <div class="row justify-content-center text-center mb-50">
                        <div class="col-lg-8">
                            <h2 class="aq-section-title aq-engraving-main-title">Our Finest Engraving & Customization Work
                            </h2>
                            <p class="aq-section-desc aq-engraving-desc" style="margin-bottom: 0;">
                                Real Products • Premium finishes • Memorable branding
                            </p>
                        </div>
                    </div>

                    @if($products->count() > 0)

                        <div class="row g-4 justify-content-center">
                            @foreach($products as $product)
                                        <!-- Item 1 -->
                                        <div class="col-lg-3 col-md-6">

                                            <a href="{{ route('product.details', $product->slug) }}" class="text-decoration-none text-dark">

                                                <div class="aq-engraving-card">

                                                    <div class="aq-engraving-img-wrap">

                                                        <img src="{{ $product->display_image
                                ? asset('storage/' . $product->display_image)
                                : asset('no-image.jpg') }}" alt="{{ $product->name }}">

                                                        <div class="aq-engraving-overlay">
                                                            <i class="fa-solid fa-magnifying-glass-plus"></i>
                                                        </div>

                                                    </div>

                                                    <div class="aq-engraving-content">

                                                        <h3 class="aq-engraving-card-title">
                                                            {{ $product->name }}
                                                        </h3>

                                                        <p class="aq-engraving-card-desc">
                                                            {{ $product->description }}
                                                        </p>

                                                        <div class="aq-engraving-card-details">

                                                            <span class="aq-engraving-price">
                                                                ₹{{ number_format($product->price) }}
                                                            </span>

                                                            <span class="aq-engraving-moq">
                                                                MOQ: {{ $product->min_qty ?? 1 }} pcs
                                                            </span>

                                                        </div>

                                                    </div>

                                                </div>

                                            </a>

                                        </div>
                            @endforeach
                        </div>

                        <div class="row mt-50">
                            <div class="col-12 text-center">
                                <a href="{{ route('products', ['collection' => 'engravings']) }}"
                                    class="aq-engraving-btn-outline">View More Engravings</a>
                            </div>
                        </div>

                    @else

                        <div class="row justify-content-center text-center">
                            <div class="col-lg-8">
                                <div class="aq-personalised-empty-state">
                                    <div class="aq-personalised-empty-icon">
                                        <i class="fa-solid fa-box-open"></i>
                                    </div>
                                    <h4 class="aq-personalised-empty-title">No Products found</h4>
                                    <p class="aq-personalised-empty-desc">Please explore our product section to find items
                                        available for personalization.</p>
                                    <a href="{{ route('products') }}" class="aq-personalised-btn-outline mt-30">Explore
                                        Collection</a>
                                </div>
                            </div>
                        </div>

                    @endif
                </div>
            </section>

            <!-- CTA Section -->
            <section class="aq-engraving-cta-section">
                <div class="container">
                    <div class="aq-engraving-cta-box">
                        <div class="row align-items-center">
                            <div class="col-lg-8 text-center text-lg-start mb-4 mb-lg-0">
                                <h2 class="aq-engraving-cta-title">Want Your Brand Engraved?</h2>
                                <p class="aq-engraving-cta-desc">From diaries to drinkware — we make your logo look premium
                                    and memorable.</p>
                            </div>
                            <div class="col-lg-4 text-center text-lg-end">
                                <button type="button" class="aq-engraving-btn-solid" onclick="openGlobalDrawer('engraving_gallery')">
                                    Start Your Customization Project
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

    </main>


@endsection