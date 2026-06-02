@extends('layouts.app')

@section('content')

    <main class="aq-about-page">


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
                <h1 class="aq-catpage-title">About </h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="index.html">Home</a>
                    <span>/</span>
                    <span>About</span>
                </div>
            </div>
        </section> <!-- collection area start -->

        <!-- Breadcrumb Bar -->
        <!-- <div class="aq-about-breadcrumb-wrap">
                    <div class="container">
                        <div class="aq-details-breadcrumbs">
                            <a href="index.html">Home</a>
                            <span class="divider">/</span>
                            <span class="current">About Us</span>
                        </div>
                    </div>
                </div> -->


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
                            <span class="stat-label">Happy Corporate Clients</span>
                        </div>
                    </div>
                    <!-- Stat Item 2 -->
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fa-solid fa-gift"></i>
                            </div>
                            <h3 class="stat-number">1,25,000+</h3>
                            <span class="stat-label">Gifts Delivered</span>
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
                            <span class="stat-label">Partners / Vendors</span>
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
                        <span class="aq-section-title-sm">Spreading Joy Since 5+ Years</span>
                        <h2 class="aq-section-title">Discover B2B Gifts India &amp; Our Giftech Platform</h2>
                        <p class="aq-section-desc">
                            Our Giftech platform provides access to the next level of corporate gifting. Sharing a
                            successful journey of over 5 years, we've been spreading joy and fostering connections
                            through thoughtfully chosen Gifts.
                        </p>
                        <p class="aq-section-desc">
                            Our goal is to offer you the finest selection of options that cater to your specific
                            corporate needs for any occasion. We will closely collaborate with you to gain a
                            comprehensive understanding of your choices, budget, and timelines.
                        </p>
                        <a href="javascript:void(0);" onclick="openGlobalDrawer('about_page')"
                            class="aq-about-btn-gold mt-10 enquiry-btn">Get Started</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="aq-image-box-premium">
                            <img src="public/assets/img/corporate/welcome_kit_1778668006890.webp"
                                alt="Corporate Welcome Gifting Kits Showcase" />
                            <div class="aq-image-box-overlay"></div>
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
                        <span class="aq-section-title-sm">Innovative Gifting Ecosystem</span>
                        <h2 class="aq-section-title">Elevate Your Corporate Gifting Experience</h2>
                        <p class="aq-section-desc" style="max-width: 700px; margin: 0 auto;">
                            We bridge premium luxury craftsmanship with cutting-edge digital curation. Discover our
                            tech-forward corporate gifting philosophy.
                        </p>
                    </div>
                </div>
                <div class="row g-4">
                    <!-- Feature 1 -->
                    <div class="col-lg-4">
                        <div class="tech-feature-card">
                            <span class="tech-feature-icon"><i class="fa-solid fa-microchip"></i></span>
                            <h4 class="tech-feature-title">Cutting-Edge Gifting Tech</h4>
                            <p class="tech-feature-desc">
                                We, as a Gift-Tech company, distinguish ourselves from others through our cutting-edge
                                technological tools, including an E-commerce website, CRM system, and well-defined
                                processes and policies. These elements shape our unique approach, vision, and mission,
                                ensuring customer satisfaction, exceptional service, and a strong brand value.
                            </p>
                        </div>
                    </div>
                    <!-- Feature 2 -->
                    <div class="col-lg-4">
                        <div class="tech-feature-card">
                            <span class="tech-feature-icon"><i class="fa-solid fa-tags"></i></span>
                            <h4 class="tech-feature-title">Vast Catalog & Brand Network</h4>
                            <p class="tech-feature-desc">
                                We efficiently handle a wide range of over 5000+ products & serving a client base of
                                over 400 plus corporate and established corporate partnerships with more than 150
                                national and international brands across 18 major categories and 100 subcategories.
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
                        <h3 class="aq-reach-title">Reach us for extraordinary gifting experience.</h3>
                        <p class="aq-reach-desc">Our design curators are ready to help you launch your next campaign.
                        </p>
                    </div>
                    <a href="javascript:void(0);" onclick="openGlobalDrawer('about_page')"
                        class="aq-about-btn-gold enquiry-btn"
                        style="background:#ffffff; color:#003108 !important; border-color:#ffffff; box-shadow:0 10px 20px rgba(0,0,0,0.1);">Get
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
                            We go beyond gifting — we deliver experiences that strengthen relationships, elevate your
                            brand, and create lasting impressions.
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
                                Carefully curated, high-quality products that reflect your brand standards and leave a
                                lasting impression.
                            </p>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="promise-card">
                            <div class="promise-icon"><i class="fa-solid fa-palette"></i></div>
                            <h3 class="promise-title">Creative Customization</h3>
                            <p class="promise-desc">
                                Tailored branding solutions including logo printing, engraving, and premium packaging to
                                make every gift uniquely yours.
                            </p>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="promise-card">
                            <div class="promise-icon"><i class="fa-solid fa-handshake-angle"></i></div>
                            <h3 class="promise-title">Exceptional Service</h3>
                            <p class="promise-desc">
                                End-to-end support from consultation to delivery, ensuring a smooth, reliable, and
                                hassle-free gifting experience.
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
                            <h3 class="vm-title">To Redefine Corporate Gifting</h3>
                            <p class="vm-desc">
                                To redefine corporate gifting by making it more meaningful, personalized, and
                                result-driven — helping businesses create real impact through every gift they share.
                            </p>
                        </div>
                    </div>
                    <!-- Mission Card -->
                    <div class="col-lg-6">
                        <div class="vision-mission-card">
                            <span class="vm-badge mission-badge">Our Mission</span>
                            <h3 class="vm-title">Delivering High-Quality Customization</h3>
                            <p class="vm-desc">
                                To provide reliable, high-quality, and customized gifting solutions with seamless
                                execution — ensuring every order reflects our client’s brand and delivers a smooth,
                                hassle-free experience from start to finish.
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
                    <p class="aq-section-subtitle">
                        Passionate professionals dedicated to redefining corporate gifting in India
                    </p>
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


        <!-- 6. Bottom Sticky Category Link Area (For SEO/Footer Links) -->
        <section class="aq-footer-categories-section">
            <div class="container">
                <div class="aq-footer-cat-container">
                    <div class="aq-footer-cat-group">
                        <span class="aq-footer-cat-label">Shop by Recipient</span>
                        <div class="aq-footer-cat-links">
                            @foreach($footerCategories as $footerCategory)
                                <a href="{{ route('category.products', $footerCategory->slug) }}" class="aq-footer-cat-link">
                                    {{ $footerCategory->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="aq-footer-cat-group">
                        <span class="aq-footer-cat-label">Shop by Occasion</span>
                        <div class="aq-footer-cat-links">
                            @foreach($occasions->take(10) as $occasion)
                                <a href="{{ route('products', ['occasion' => $occasion->slug]) }}" class="aq-footer-cat-link">
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