@extends('layouts.app')
@section('content')

 <main class="aq-thankyou-page">
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
                <h1 class="aq-catpage-title">Thank You</h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="index.html">Home</a>
                    <span>/</span>
                    <span>Thank You</span>
                </div>
            </div>
        </section>


        <!-- Dynamic Success Thank You Section (Dashboard Layout) -->
        <section class="aq-thankyou-wrapper" id="aqThankYouSection">
            <div class="container">
                <div class="aq-thankyou-card">
                    <div class="aq-thankyou-icon">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <h2 class="aq-thankyou-title">Order Confirmed!</h2>
                    <p class="aq-thankyou-subtitle">
                        Thank you for your elegant curation. We have successfully received your order and are preparing
                        your handcrafted apparel for shipping.
                    </p>

                    <!-- Tracker -->
                    <div class="aq-thankyou-tracker">
                        <div class="aq-tracker-progress-bar"></div>

                        <div class="aq-tracker-step completed">
                            <span class="aq-tracker-dot"><i class="fa-solid fa-box"></i></span>
                            <span class="aq-tracker-label">Order Placed</span>
                        </div>
                        <div class="aq-tracker-step active">
                            <span class="aq-tracker-dot"><i class="fa-solid fa-spinner"></i></span>
                            <span class="aq-tracker-label">Processing</span>
                        </div>




                        <div class="aq-tracker-step">
                            <span class="aq-tracker-dot"><i class="fa-solid fa-truck-fast"></i></span>
                            <span class="aq-tracker-label">Shipped</span>
                        </div>
                    </div>

                    <!-- Meta details summary -->
                    <div class="aq-thankyou-summary-box">
                        <div class="aq-summary-meta-item">
                            <span class="aq-meta-label">Order ID</span>
                            <span class="aq-meta-val" id="valEnquiryId">#ORD-68249</span>
                        </div>
                        <div class="aq-summary-meta-item">
                            <span class="aq-meta-label">Owner / Contact</span>
                            <span class="aq-meta-val" id="valOwnerName">Rajesh Sharma</span>
                        </div>
                        <div class="aq-summary-meta-item">
                            <span class="aq-meta-label">Mobile Number</span>
                            <span class="aq-meta-val" id="valMobile">+91 0000 000 000</span>
                        </div>
                        <div class="aq-summary-meta-item">
                            <span class="aq-meta-label">Email Id</span>
                            <span class="aq-meta-val" id="valMobile">abcd@gmail.com</span>
                        </div>

                        <div class="aq-summary-meta-item">
                            <span class="aq-meta-label">Business Name</span>
                            <span class="aq-meta-val" id="valBusinessName">Acme Corp Ltd</span>
                        </div>
                        <div class="aq-summary-meta-item">
                            <span class="aq-meta-label">State / City</span>
                            <span class="aq-meta-val" id="valBusinessName">Uttar Pradesh / Noida</span>
                        </div>


                        <div class="aq-summary-meta-item" style="grid-column: span 2;">
                            <span class="aq-meta-label">Delivery Address</span>
                            <span class="aq-meta-val" id="valAddress">Plot 24, HITEC City, Hyderabad, Telangana -
                                500081</span>
                        </div>
                    </div>

                    <a href="index.html" class="aq-thankyou-btn">
                        <i class="fa-solid fa-house"></i>
                        <span>Return to Home</span>
                    </a>
                </div>
            </div>
        </section>
    </main>
@endsection

