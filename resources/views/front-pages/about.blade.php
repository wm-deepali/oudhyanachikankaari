@extends('layouts.app')
@section('content')

 <main class="aq-about-page">


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
                <h1 class="aq-catpage-title">About </h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <span>About</span>
                </div>
            </div>
        </section> <!-- collection area start -->



        <!-- Luxury Stats Overlap Wrap -->
        <section class="aq-stats-wrap">
            <div class="container">
                <div class="row g-4">
                    <!-- Stat Item 1 -->
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fa-solid fa-handshake"></i>
                            </div>
                            <h3 class="stat-number">500+</h3>
                            <span class="stat-label">Happy Clients</span>
                        </div>
                    </div>
                    <!-- Stat Item 2 -->
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fa-solid fa-wand-magic-sparkles"></i>
                            </div>
                            <h3 class="stat-number">1,25,000+</h3>
                            <span class="stat-label">Orders Delivered</span>
                        </div>
                    </div>
                    <!-- Stat Item 3 -->
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fa-solid fa-crown"></i>
                            </div>
                            <h3 class="stat-number">700+</h3>
                            <span class="stat-label">Premium Products</span>
                        </div>
                    </div>
                    <!-- Stat Item 4 -->
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fa-solid fa-network-wired"></i>
                            </div>
                            <h3 class="stat-number">100</h3>
                            <span class="stat-label">Artisans Supported</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Journey & Goal (Discover Segment) -->
        <section class="aq-discover-section">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <span class="aq-section-title-sm">Crafting Elegance Since 5+ Years</span>
                        <h2 class="aq-section-title">Discover Our Chikankari Heritage</h2>
                        <p class="aq-section-desc">
                            Our platform provides access to the next level of luxury fashion. Sharing a successful
                            journey of over 5 years, we have been spreading elegance and fostering appreciation through
                            thoughtfully crafted Chikankari apparel.
                        </p>
                        <p class="aq-section-desc">
                            Our goal is to offer you the finest selection of options that cater to your specific fashion
                            needs for any occasion. We collaborate with skilled artisans to bring you authentic,
                            handcrafted elegance.
                        </p>
                        <a href="javascript:void(0);" onclick="openGlobalDrawer('about_page')" class="aq-about-btn-gold mt-10 enquiry-btn">Get Started</a>
                    </div>
                    <div class="col-lg-6">

                        <div class="aq-creative-image-collage" style="position: relative; height: 500px; width: 100%;">
                            <img src="{{ asset('assets/img/corporate/roohani_organza_saree.png')}}" alt="Chikankari Saree"
                                style="position: absolute; top: 0; left: 0; width: 60%; height: 350px; object-fit: cover; border-radius: 12px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); z-index: 2;">
                            <img src="{{ asset('assets/img/corporate/meher_silk_dupatta.png')}}" alt="Chikankari Suit"
                                style="position: absolute; bottom: 0; right: 0; width: 55%; height: 350px; object-fit: cover; border-radius: 12px; box-shadow: 0 20px 40px rgba(0,0,0,0.15); z-index: 3; border: 5px solid #fff;">
                            <img src="{{ asset('assets/img/corporate/gallery_bridal_lehenga.png')}}" alt="Chikankari Background"
                                style="position: absolute; top: 50px; right: 10%; width: 45%; height: 250px; object-fit: cover; border-radius: 12px; z-index: 1; opacity: 0.7;">
                            <div
                                style="position: absolute; top: -20px; left: -20px; width: 150px; height: 150px; background: #C98F9D; border-radius: 50%; opacity: 0.1; z-index: 0;">
                            </div>
                            <div
                                style="position: absolute; bottom: -30px; right: 20%; width: 120px; height: 120px; border: 2px dashed #C98F9D; border-radius: 50%; opacity: 0.4; z-index: 0;">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            </div>
        </section>

        <!-- Philosophy / Tech section -->
        <section class="aq-tech-section">
            <div class="container">
                <div class="row justify-content-center text-center mb-50">
                    <div class="col-lg-8">
                        <span class="aq-section-title-sm">Authentic Craftsmanship</span>
                        <h2 class="aq-section-title">Elevate Your Wardrobe with Handcrafted Luxury</h2>
                        <p class="aq-section-desc" style="max-width: 700px; margin: 0 auto;">
                            We bridge traditional luxury craftsmanship with modern fashion curation. Discover our
                            commitment to preserving the authentic art of Chikankari.
                        </p>
                    </div>
                </div>
                <div class="row g-4">
                    <!-- Feature 1 -->
                    <div class="col-lg-4">
                        <div class="tech-feature-card">
                            <span class="tech-feature-icon"><i class="fa-solid fa-microchip"></i></span>
                            <h4 class="tech-feature-title">Authentic Embroidery</h4>
                            <p class="tech-feature-desc">
                                We distinguish ourselves through our commitment to authentic hand embroidery. Each piece
                                is meticulously crafted by skilled artisans, ensuring the preservation of this
                                traditional art form while delivering exceptional quality and elegance.
                            </p>
                        </div>
                    </div>
                    <!-- Feature 2 -->
                    <div class="col-lg-4">
                        <div class="tech-feature-card">
                            <span class="tech-feature-icon"><i class="fa-solid fa-tags"></i></span>
                            <h4 class="tech-feature-title">Exclusive Fabric Collection</h4>
                            <p class="tech-feature-desc">
                                We offer a wide range of premium fabrics including Pure Georgette, Organza, Modal, and
                                Chanderi. Our exclusive collection caters to diverse tastes, ensuring every woman finds
                                her perfect piece of handcrafted luxury.
                            </p>
                        </div>
                    </div>
                    <!-- Feature 3 -->
                    <div class="col-lg-4">
                        <div class="tech-feature-card">
                            <span class="tech-feature-icon"><i class="fa-solid fa-heart-pulse"></i></span>
                            <h4 class="tech-feature-title">Empowering Local Artisans</h4>
                            <p class="tech-feature-desc">
                                To promote local trade, support local artisans, and contribute to the growth of the
                                Indian economy, the majority of our products are manufactured in India. We are delighted
                                to offer an exciting opportunity for brand partnerships.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- CTA banner inside -->
                <div class="aq-reach-cta-banner d-flex align-items-center justify-content-between flex-wrap gap-4">
                    <div>
                        <h3 class="aq-reach-title">Reach us for an extraordinary fashion experience.</h3>
                        <p class="aq-reach-desc">Our design curators are ready to help you launch your next campaign.
                        </p>
                    </div>
                    <a href="javascript:void(0);" onclick="openGlobalDrawer('about_page')" class="aq-about-btn-gold enquiry-btn"
                        style="background:#ffffff; color:#C98F9D !important; border-color:#ffffff; box-shadow:0 10px 20px rgba(0,0,0,0.1);">Get
                        a Custom Proposal</a>
                </div>
            </div>
        </section>

        <!-- Brand Promise -->
        <section class="aq-promise-section">
            <div class="container">
                <div class="row justify-content-center text-center mb-50">
                    <div class="col-lg-8">
                        <span class="aq-section-title-sm">Commitment to Distinction</span>
                        <h2 class="aq-section-title">Our Brand Promise</h2>
                        <p class="aq-section-desc" style="max-width: 700px; margin: 0 auto;">
                            We go beyond fashion — we deliver handcrafted experiences that elevate your style and create
                            lasting impressions of elegance.
                        </p>
                    </div>
                </div>
                <div class="row g-4">
                    <!-- Card 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="promise-card">
                            <div class="promise-icon"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
                            <h3 class="promise-title">Premium Quality</h3>
                            <p class="promise-desc">
                                Carefully curated, premium fabrics that reflect traditional elegance and leave a lasting
                                impression.
                            </p>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="promise-card">
                            <div class="promise-icon"><i class="fa-solid fa-palette"></i></div>
                            <h3 class="promise-title">Bespoke Tailoring</h3>
                            <p class="promise-desc">
                                Custom tailoring, intricate embroidery patterns, and elegant packaging to make every
                                piece uniquely yours.
                            </p>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="promise-card">
                            <div class="promise-icon"><i class="fa-solid fa-handshake-angle"></i></div>
                            <h3 class="promise-title">Exceptional Service</h3>
                            <p class="promise-desc">
                                End-to-end styling support from consultation to delivery, ensuring a smooth and
                                luxurious shopping experience.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision Mission Splits -->
        <section class="aq-vision-mission-section">
            <div class="container">
                <div class="row g-5">
                    <!-- Vision Card -->
                    <div class="col-lg-6">
                        <div class="vision-mission-card">
                            <span class="vm-badge">Our Vision</span>
                            <h3 class="vm-title">To Redefine Authentic Luxury</h3>
                            <p class="vm-desc">
                                To redefine luxury fashion by making it more authentic, handcrafted, and elegant —
                                helping individuals create a real statement through every piece they wear.
                            </p>
                        </div>
                    </div>
                    <!-- Mission Card -->
                    <div class="col-lg-6">
                        <div class="vision-mission-card">
                            <span class="vm-badge mission-badge">Our Mission</span>
                            <h3 class="vm-title">Preserving Craftsmanship</h3>
                            <p class="vm-desc">
                                To provide exquisite, high-quality, and handcrafted apparel with seamless execution —
                                ensuring every piece reflects the rich heritage of Chikankari and delivers a luxurious
                                experience.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Meet Our Leadership Section -->
        <section class="aq-leadership-section">
            <div class="container">
                <div class="aq-section-title-wrapper text-center mb-50">
                    <h2 class="aq-section-title">Meet Our Leadership</h2>
                    <p class="aq-section-subtitle">Passionate professionals dedicated to redefining corporate gifting in
                        India</p>
                </div>
                <div class="row g-4 justify-content-center">

                      @forelse($teams as $team)
                        <div class="col-lg-4 col-md-6">
                            <div class="aq-leader-card">
                                <div class="aq-leader-img-wrapper">

                                    <img src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->name }}"
                                        class="aq-leader-img" loading="lazy">

                                    <div class="aq-leader-socials">
                                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                        <a href="#"><i class="fa-regular fa-envelope"></i></a>
                                    </div>

                                </div>

                                <div class="aq-leader-info">
                                    <h4 class="aq-leader-name">
                                        {{ $team->name }}
                                    </h4>

                                    <span class="aq-leader-designation">
                                        {{ $team->designation }}
                                    </span>

                                    <p class="aq-leader-bio">
                                        {{ $team->description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>No team members found.</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </section>

         <section class="aq-footer-categories-section">
            <div class="container">
                <div class="aq-footer-cat-container">
                    <div class="aq-footer-cat-group">
                        <span class="aq-footer-cat-label">Shop by Recipient</span>
                        <div class="aq-footer-cat-links">
                            @foreach($menuCategories as $footerCategory)
                                <a href="{{ route('products.listing', $footerCategory->slug) }}" class="aq-footer-cat-link">
                                    {{ $footerCategory->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="aq-footer-cat-group">
                        <span class="aq-footer-cat-label">Shop by Occasion</span>
                        <div class="aq-footer-cat-links">
                            @foreach($headerOccasions->take(10) as $occasion)
                                <a href="{{ route('occasions.listing', $occasion->slug) }}" class="aq-footer-cat-link">
                                    {{ $occasion->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection
