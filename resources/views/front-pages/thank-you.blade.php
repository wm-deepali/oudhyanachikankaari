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
                    <h2 class="aq-thankyou-title">Enquiry Transmitted!</h2>
                    <p class="aq-thankyou-subtitle">
                        Thank you for initiating your custom curation. A dedicated corporate manager has received your
                        volume list and is curate-compiling elegant design proposals right now.
                    </p>

                    <!-- Tracker -->
                    <div class="aq-thankyou-tracker">
                        <div class="aq-tracker-progress-bar"></div>

                        <div class="aq-tracker-step completed">
                            <span class="aq-tracker-dot"><i class="fa-solid fa-file-invoice"></i></span>
                            <span class="aq-tracker-label">Request Submitted</span>
                        </div>
                        <div class="aq-tracker-step active">
                            <span class="aq-tracker-dot"><i class="fa-solid fa-file-pdf"></i></span>
                            <span class="aq-tracker-label">Download PDF</span>
                        </div>




                        <div class="aq-tracker-step">
                            <span class="aq-tracker-dot"><i class="fa-solid fa-gift"></i></span>
                            <span class="aq-tracker-label">Quote Under Review</span>
                        </div>
                    </div>

                    <!-- Meta details summary -->
                    <div class="aq-thankyou-summary-box">
                        <div class="aq-summary-meta-item">
                            <span class="aq-meta-label">Quote Request ID</span>
                            <span class="aq-meta-val" id="valEnquiryId">#{{ $enquiry->id }}</span>
                        </div>
                        <div class="aq-summary-meta-item">
                            <span class="aq-meta-label">Owner / Contact</span>
                            <span class="aq-meta-val" id="valOwnerName">{{ $enquiry->owner_name }}</span>
                        </div>
                        <div class="aq-summary-meta-item">
                            <span class="aq-meta-label">Mobile Number</span>
                            <span class="aq-meta-val" id="valMobile">{{ $enquiry->mobile }}</span>
                        </div>
                        <div class="aq-summary-meta-item">
                            <span class="aq-meta-label">Email Id</span>
                            <span class="aq-meta-val" id="valEmail">{{ $enquiry->email }}</span>
                        </div>

                        <div class="aq-summary-meta-item">
                            <span class="aq-meta-label">Business Name</span>
                            <span class="aq-meta-val" id="valBusinessName">{{ $enquiry->business_name }}</span>
                        </div>
                        <div class="aq-summary-meta-item">
                            <span class="aq-meta-label">State / City</span>
                            <span class="aq-meta-val" id="valBusinessName">{{ $enquiry->state->name ?? '' }} / {{ $enquiry->city->name ?? '' }}</span>
                        </div>


                        <div class="aq-summary-meta-item" style="grid-column: span 2;">
                            <span class="aq-meta-label">Delivery Address</span>
                            <span class="aq-meta-val" id="valAddress">{{ $enquiry->address }}</span>
                        </div>
                    </div>

                    <a href="{{ route('home') }}" class="aq-thankyou-btn">
                        <i class="fa-solid fa-house"></i>
                        <span>Return to Corporate Home</span>
                    </a>
                </div>
            </div>
        </section>
    </main>

@endsection