@extends('layouts.app')


@section('content')

<main class="aq-about-page">

                <!-- 1. Luxury Inner Banner / Hero Section -->
        <section class="aq-catpage-hero">
            <div class="aq-hero-glow"></div>
            <div class="aq-floating-gift-box aq-floating-shape-1">
                <i class="fa-solid fa-leaf"></i>
            </div>
            <div class="aq-floating-gift-box aq-floating-shape-2">
                <i class="fa-solid fa-recycle"></i>
            </div>
            <div class="aq-catpage-hero-content">
                <h1 class="aq-catpage-title">Recycling Pledge</h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="index.html">Home</a>
                    <span>/</span>
                    <span>Recycling Pledge</span>
                </div>
            </div>
        </section>

        <div class="aq-recycling-page-wrap">
            
            <!-- Hero / Intro Section with overlapping Team card -->
            <section class="aq-recycling-intro-luxury pt-120 pb-120">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7">
                            <div class="aq-recycling-intro-content pr-lg-5">
                                <span class="aq-section-title-sm aq-recycling-intro-subtitle">Sustainable Gifting • Responsible Choices • Better Impact</span>
                                <h2 class="aq-section-title aq-recycling-intro-title">Eco-Friendly Corporate Gifting Solutions</h2>
                                <p class="aq-section-desc aq-recycling-intro-desc">
                                    We help businesses make a positive impact with sustainable corporate gifts crafted from eco-conscious materials — combining thoughtful gifting with environmental responsibility.
                                </p>
                                <button type="button" class="aq-recycling-expert-btn mt-30" onclick="openGlobalDrawer('recycling_pledge')">
                                    Speak With Our Expert <i class="fa-solid fa-arrow-right-long"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-5 position-relative mt-50 mt-lg-0">
                            <!-- Team Card (Floating aesthetic) -->
                            <div class="aq-recycling-team-card">
                                <div class="aq-team-card-inner">
                                    <div class="aq-team-card-icon">🎁</div>
                                    <span class="aq-team-card-since">Since 2020</span>
                                    <h3 class="aq-team-card-name">B2B Gifts India Team</h3>
                                    <p class="aq-team-card-tagline">Elevating Corporate Gifting Experiences</p>
                                </div>
                                <!-- Decorative Elements -->
                                <div class="aq-team-card-decor-1"></div>
                                <div class="aq-team-card-decor-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Our Pledge Section (Timeline/List Style) -->
            <section class="aq-pledge-list-section pt-100 pb-100">
                <div class="container">
                    <div class="row mb-60">
                        <div class="col-lg-8">
                            <span class="aq-section-title-sm aq-recycling-title-sm">OUR PLEDGE</span>
                            <h2 class="aq-section-title aq-recycling-main-title">Thoughtful Gifting with Quality & Precision</h2>
                            <p class="aq-section-desc aq-recycling-desc">
                                We deliver high-quality, customized corporate gifts that reflect your brand, with a focus on reliability and seamless execution.
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="aq-pledge-list-container">
                                <!-- Item 1 -->
                                <div class="aq-pledge-list-item">
                                    <div class="aq-pledge-list-num">01</div>
                                    <div class="aq-pledge-list-content">
                                        <p>Promoting responsible waste management by encouraging proper segregation of recyclable and non-recyclable materials.</p>
                                    </div>
                                </div>
                                <!-- Item 2 -->
                                <div class="aq-pledge-list-item">
                                    <div class="aq-pledge-list-num">02</div>
                                    <div class="aq-pledge-list-content">
                                        <p>Staying aligned with local recycling guidelines and continuously improving our processes to ensure effective sustainability practices.</p>
                                    </div>
                                </div>
                                <!-- Item 3 -->
                                <div class="aq-pledge-list-item">
                                    <div class="aq-pledge-list-num">03</div>
                                    <div class="aq-pledge-list-content">
                                        <p>Reducing waste through conscious efforts such as reusing materials, optimizing packaging, and minimizing unnecessary consumption.</p>
                                    </div>
                                </div>
                                <!-- Item 4 -->
                                <div class="aq-pledge-list-item">
                                    <div class="aq-pledge-list-num">04</div>
                                    <div class="aq-pledge-list-content">
                                        <p>Prioritizing eco-friendly, sustainable, and recyclable products within our corporate gifting solutions.</p>
                                    </div>
                                </div>
                                <!-- Item 5 -->
                                <div class="aq-pledge-list-item">
                                    <div class="aq-pledge-list-num">05</div>
                                    <div class="aq-pledge-list-content">
                                        <p>Encouraging awareness among clients and partners about responsible gifting and environmentally conscious choices.</p>
                                    </div>
                                </div>
                                <!-- Item 6 -->
                                <div class="aq-pledge-list-item">
                                    <div class="aq-pledge-list-num">06</div>
                                    <div class="aq-pledge-list-content">
                                        <p>Supporting sustainable initiatives, including recycling programs and community-driven environmental efforts.</p>
                                    </div>
                                </div>
                                <!-- Item 7 -->
                                <div class="aq-pledge-list-item">
                                    <div class="aq-pledge-list-num">07</div>
                                    <div class="aq-pledge-list-content">
                                        <p>Continuously evolving by adopting better practices, materials, and innovations that contribute to a greener future.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Sustainability Commitment Section -->
            <section class="aq-sustainability-section pt-100 pb-100">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 mb-50 mb-lg-0">
                            <div class="aq-sustainability-content">
                                <span class="aq-section-title-sm aq-sus-title-sm">Our Sustainability Commitment</span>
                                <h2 class="aq-section-title aq-sus-main-title">A Greener Future Starts Here</h2>
                                <p class="aq-section-desc aq-sus-desc">
                                    We believe corporate gifting should not only create meaningful impressions but also contribute responsibly to the environment. At B2B Gifts India, we are committed to promoting sustainable practices by offering eco-friendly solutions and encouraging conscious gifting choices that support a greener future.
                                </p>
                                <a href="about.html" class="aq-sus-btn">Know Our Journey</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="aq-sustainability-img-wrap">
                                <img src="public/assets/img/corporate/hero_gift_box_1778667986732.webp" alt="Sustainability Commitment" class="aq-sus-img">
                                <div class="aq-sus-overlay-glow"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </main>

@endsection