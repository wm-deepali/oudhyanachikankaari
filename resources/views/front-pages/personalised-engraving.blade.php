@extends('layouts.app')


@section('content')
    <main>



        <!-- 1. Luxury Inner Banner / Hero Section -->
        <section class="aq-catpage-hero">
            <div class="aq-hero-glow"></div>
            <div class="aq-floating-gift-box aq-floating-shape-1">
                <i class="fa-solid fa-gem"></i>
            </div>
            <div class="aq-floating-gift-box aq-floating-shape-2">
                <i class="fa-solid fa-gift"></i>
            </div>
            <div class="aq-catpage-hero-content">
                <h1 class="aq-catpage-title">Personalised Engraving</h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="index.html">Home</a>
                    <span>/</span>
                    <span>Personalised Engraving</span>
                </div>
            </div>
        </section>

        <div class="aq-personalised-page-wrap aq-engraving-page-wrap">

            <!-- Intro Section -->
            <section class="aq-personalised-intro-section ">
                <div class="container">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6">
                            <div class="aq-personalised-content-box">
                                <span class="aq-section-title-sm aq-personalised-title-sm">PERSONALISED CRAFTSMANSHIP</span>
                                <h2 class="aq-section-title aq-personalised-main-title">Personalised Engraving</h2>
                                <p class="aq-section-desc aq-personalised-desc">
                                    Turn meaningful moments into lasting memories with precision engraving. From names and
                                    messages to special dates, create unique gifts that feel truly personal and timeless.
                                </p>
                                <button type="button" class="aq-personalised-btn" onclick="openGlobalDrawer('personalised_engraving')">
                                    Start Your Custom Project <i class="fa-solid fa-arrow-right-long"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="aq-personalised-why-box">
                                <h3 class="aq-personalised-why-title">Why Choose Our Personal Engraving?</h3>
                                <p class="aq-personalised-why-desc">
                                    From elegant diaries to premium drinkware and lifestyle products, we craft personalised
                                    engravings with precision and care — turning your names, messages, and special moments
                                    into timeless keepsakes.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

               <!-- Works / Empty State Section -->
            <section class="aq-engraving-gallery-section">
                <div class="container">
                    <div class="row justify-content-center text-center mb-50">
                        <div class="col-lg-8">
                            <h2 class="aq-section-title aq-personalised-main-title text-center">Our Personal Engraving Works</h2>
                        </div>
                    </div>

                    @if($products->count() > 0)
                        <div class="row g-4 justify-content-center">
                            @foreach($products as $product)
                                <div class="col-lg-3 col-md-6">
                                    <a href="{{ route('product.details', $product->slug) }}" class="text-decoration-none text-dark">
                                        <div class="aq-engraving-card bg-white">
                                            <div class="aq-engraving-img-wrap">
                                                <img src="{{ $product->display_image ? asset('storage/' . $product->display_image) : asset('no-image.jpg') }}" alt="{{ $product->name }}">
                                                <div class="aq-engraving-overlay">
                                                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                                                </div>
                                            </div>
                                            <div class="aq-engraving-content">
                                                <h3 class="aq-engraving-card-title">{{ $product->name }}</h3>
                                                <p class="aq-engraving-card-desc">{{ $product->description }}</p>
                                                <div class="aq-engraving-card-details">
                                                    <span class="aq-engraving-price">₹{{ number_format($product->price) }}</span>
                                                    <span class="aq-engraving-moq">MOQ: {{ $product->min_qty ?? 1 }} pcs</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <div class="row mt-50">
                            <div class="col-12 text-center">
                                <a href="{{ route('products', ['collection' => 'engravings']) }}" class="aq-personalised-btn-outline">View More Engravings</a>
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
                                    <p class="aq-personalised-empty-desc">Please explore our product section to find items available for personalization.</p>
                                    <a href="{{ route('products') }}" class="aq-personalised-btn-outline mt-30">Explore Collection</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
            
            
            
       

            <!-- Process Section -->
            <section class="aq-personalised-process-section">
                <div class="container">
                    <div class="row justify-content-center text-center mb-60">
                        <div class="col-lg-8">
                            <span class="aq-section-title-sm aq-personalised-title-sm">PROCESS</span>
                            <h2 class="aq-section-title aq-personalised-main-title text-center">Step-by-Step Guide</h2>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="aq-timeline-wrapper">
                                <!-- Step 1 -->
                                <div class="aq-timeline-item">
                                    <div class="aq-timeline-icon" style="background-color: #f4a261;">1</div>
                                    <div class="aq-timeline-content">
                                        <h4 class="aq-timeline-title">Share Your Requirement</h4>
                                        <p class="aq-timeline-desc">Tell us about your brand, logo, message, and the
                                            products you want to engrave.</p>
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="aq-timeline-item">
                                    <div class="aq-timeline-icon" style="background-color: #2a9d8f;">2</div>
                                    <div class="aq-timeline-content">
                                        <h4 class="aq-timeline-title">Design Approval</h4>
                                        <p class="aq-timeline-desc">We create a digital mockup of the engraving and get your
                                            approval before production.</p>
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="aq-timeline-item">
                                    <div class="aq-timeline-icon" style="background-color: #e76f51;">3</div>
                                    <div class="aq-timeline-content">
                                        <h4 class="aq-timeline-title">Precision Engraving</h4>
                                        <p class="aq-timeline-desc">Our expert team performs high-precision laser engraving
                                            on your selected products.</p>
                                    </div>
                                </div>

                                <!-- Step 4 -->
                                <div class="aq-timeline-item">
                                    <div class="aq-timeline-icon" style="background-color: #264653;">4</div>
                                    <div class="aq-timeline-content">
                                        <h4 class="aq-timeline-title">Quality Check & Delivery</h4>
                                        <p class="aq-timeline-desc">Every piece is inspected for perfection before secure
                                            packaging and timely delivery.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </main>

@endsection