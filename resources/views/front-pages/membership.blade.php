@extends('layouts.app')

@section('content')

    <main class="aq-membership-page">

        <!-- Hero Section -->
        <section class="aq-catpage-hero">
            <div class="aq-hero-glow"></div>
            <div class="aq-floating-gift-box aq-floating-shape-1">
                <i class="fa-solid fa-gift"></i>
            </div>
            <div class="aq-floating-gift-box aq-floating-shape-2">
                <i class="fa-solid fa-gem"></i>
            </div>
            <div class="aq-catpage-hero-content">
                <h1 class="aq-catpage-title">Our Membership Plans</h1>
                <div class="aq-catpage-breadcrumbs">
                    <span class="text-white opacity-75">PREMIUM CORPORATE SOLUTIONS</span>
                </div>
                <p class="text-white mt-3 mx-auto" style="max-width: 600px; font-size: 16px; line-height: 1.5;">
                    Choose the perfect membership that suits your corporate gifting needs. From occasional orders to
                    enterprise-level solutions — we have a plan for every business.
                </p>
                <div class="mt-4">
                    <a href="#plans" class="aq-cta-btn-primary">Compare All Plans</a>
                </div>
            </div>
        </section>

        <div class="aq-membership-page-wrap pt-100 pb-120">

            <div class="container">
                <!-- Intro Section -->
                <div class="row justify-content-center mb-40 mt-40">
                    <div class="col-lg-9 text-center">
                        <span class="aq-membership-subtitle">Thoughtful Gifting</span>
                        <h2 class="aq-membership-title">Connecting Businesses Through Thoughtful Gifting</h2>
                        <p class="aq-membership-desc">
                            We help companies build stronger relationships with employees and clients through premium,
                            customized corporate gifts. Our membership plans are designed to make gifting seamless,
                            cost-effective, and impactful.
                        </p>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="row g-4 mb-50 justify-content-center">
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="aq-feature-box p-4 bg-white rounded-4 shadow-sm h-100 border border-light">
                            <h3 class="display-4 fw-bold text-black-50 mb-3 opacity-25">01</h3>
                            <h4 class="fs-4 fw-bold text-dark mb-3">Flexible Gifting Solutions</h4>
                            <p class="text-muted mb-0">Choose from one-time orders or enjoy priority access with our
                                membership plans.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="aq-feature-box p-4 bg-white rounded-4 shadow-sm h-100 border border-light">
                            <h3 class="display-4 fw-bold text-black-50 mb-3 opacity-25">02</h3>
                            <h4 class="fs-4 fw-bold text-dark mb-3">Exclusive Discounts & Benefits</h4>
                            <p class="text-muted mb-0">Members get up to 25% off on bulk orders, free customization, and
                                priority support.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="aq-feature-box p-4 bg-white rounded-4 shadow-sm h-100 border border-light">
                            <h3 class="display-4 fw-bold text-black-50 mb-3 opacity-25">03</h3>
                            <h4 class="fs-4 fw-bold text-dark mb-3">Dedicated Account Manager</h4>
                            <p class="text-muted mb-0">Get personalized assistance for all your gifting needs throughout
                                the year.</p>
                        </div>
                    </div>
                </div>

                <!-- Tiers Title -->
                <div class="row justify-content-center mb-40" id="plans">
                    <div class="col-12 text-center">
                        <span class="aq-membership-subtitle">Pricing Plans</span>
                        <h2 class="aq-membership-title">Choose Your Membership</h2>
                        <p class="aq-membership-desc">Three plans designed for different business needs</p>
                    </div>
                </div>

                <div class="row g-4 justify-content-center">

                    @foreach($packages as $package)

                        <div class="col-xl-4 col-lg-6 col-md-6">

                            <div class="aq-membership-card {{ $package->is_popular ? 'aq-membership-card-popular' : '' }}">

                                <div class="aq-membership-card-bg"></div>

                                @if($package->is_popular)
                                    <div class="aq-membership-badge">
                                        MOST POPULAR
                                    </div>
                                @endif

                                <div class="aq-membership-card-inner">

                                    <div class="aq-membership-icon">

                                        @if($loop->first)
                                            <i class="fa-solid fa-award"></i>
                                        @elseif($package->is_popular)
                                            <i class="fa-solid fa-crown"></i>
                                        @else
                                            <i class="fa-solid fa-building"></i>
                                        @endif

                                    </div>

                                    <h3 class="aq-membership-tier-name">
                                        {{ $package->name }}
                                    </h3>

                                    <p class="aq-membership-tier-desc fw-bold text-dark mb-2 border-0 pb-0">
                                        {{ $package->sub_title }}
                                    </p>

                                    <div class="aq-membership-price">

                                        <span class="currency">₹</span>

                                        <span class="amount">
                                            {{ number_format($package->cost) }}
                                        </span>

                                        <span class="period">
                                            / {{ $package->duration }} yr
                                        </span>

                                    </div>

                                    <ul class="aq-membership-features pt-4 border-top">

                                        @foreach($package->features as $feature)

                                            <li>
                                                <i class="fa-solid fa-check"></i>
                                                {{ $feature->feature_name }}
                                            </li>

                                        @endforeach

                                    </ul>

                                    <button type="button" onclick="openDrawer('{{ $package->name }}', {{ $package->id }})"
                                        class="aq-membership-btn {{ $package->is_popular ? 'aq-membership-btn-solid' : 'aq-membership-btn-outline' }}">

                                        {{ $package->button_text ?? 'Choose Plan' }}

                                    </button>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>
            </div>

        </div>
    </main>

    <!-- ================= MEMBERSHIP DRAWER ================= -->

    <div class="aq-drawer-parent-wrap" id="membershipEnquiryDrawer">
        <div class="aq-drawer-overlay" id="aqDrawerOverlay"></div>
        <div class="aq-drawer-card-body">
            <!-- Close Button -->
            <button class="aq-drawer-close-btn" id="aqDrawerCloseBtn" aria-label="Close Enquiry Drawer">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <!-- Drawer Header -->
            <div class="aq-drawer-header">
                <div class="aq-drawer-header-icon">
                    <i class="fa-solid fa-crown"></i>
                </div>

                <h3 class="aq-drawer-title">
                    Membership Enquiry
                </h3>

                <p class="mb-0 text-muted mt-2">
                    Fill in your details and our team will contact you regarding your selected membership plan.
                </p>
            </div>

            <!-- Scrollable Content -->
            <div class="aq-drawer-form-scrollable">
                <!-- Form State -->
                <form class="aq-drawer-form" id="membershipEnquiryForm" method="POST"
                    action="{{ route('package.enquiry') }}">
                    @csrf

                    <input type="hidden" name="package_id" id="package_id">
                    <div class="aq-drawer-form-row">
                        <div class="aq-drawer-form-group">
                            <label class="aq-drawer-label">Full Name *</label>
                            <div class="aq-drawer-input-wrapper">
                                <i class="fa-regular fa-user"></i>
                                <input type="text" name="name" value="{{ old('name') }}" class="aq-drawer-input"
                                    placeholder="Enter your name" required>
                            </div>
                        </div>
                    </div>

                    <div class="aq-drawer-form-row">
                        <div class="aq-drawer-form-group">
                            <label class="aq-drawer-label">Company Name *</label>
                            <div class="aq-drawer-input-wrapper">
                                <i class="fa-solid fa-building"></i>
                                <input type="text" name="company" value="{{ old('company') }}" class="aq-drawer-input"
                                    placeholder="Your Company Name" required>
                            </div>
                        </div>
                    </div>

                    <div class="aq-drawer-form-row">
                        <div class="aq-drawer-form-group">
                            <label class="aq-drawer-label">Email Address *</label>
                            <div class="aq-drawer-input-wrapper">
                                <i class="fa-regular fa-envelope"></i>
                                <input type="email" name="email" value="{{ old('email') }}" class="aq-drawer-input"
                                    placeholder="you@company.com" required>
                            </div>
                        </div>
                    </div>

                    <div class="aq-drawer-form-row">
                        <div class="aq-drawer-form-group">
                            <label class="aq-drawer-label">Mobile Number *</label>
                            <div class="aq-drawer-input-wrapper">
                                <i class="fa-solid fa-phone-flip"></i>
                                <input type="tel" name="phone" value="{{ old('phone') }}" class="aq-drawer-input"
                                    placeholder="+91 98765 43210" pattern="[6-9]{1}[0-9]{9}" maxlength="10" required>
                            </div>
                        </div>
                    </div>

                    <div class="aq-drawer-form-row">
                        <div class="aq-drawer-form-group">
                            <label class="aq-drawer-label">
                                Message
                            </label>

                            <div class="aq-drawer-input-wrapper textarea-wrapper">
                                <i class="fa-regular fa-comment-dots"></i>

                                <textarea name="message" class="aq-drawer-textarea"
                                    placeholder="Enter your message">{{ old('message') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}">
                        </div>
                    </div>

                    <div class="aq-drawer-form-footer">

                        <button type="submit" class="aq-drawer-submit-btn">

                            <span>Submit Enquiry</span>

                            <i class="fa-solid fa-arrow-right-long"></i>

                        </button>

                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    @if(session('success_package'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success_package') }}"
            });

            document.getElementById('membershipEnquiryDrawer').classList.remove('active');
            document.body.style.overflow = '';
        </script>
    @endif

    @if($errors->packageForm->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                // open only this drawer
                document.getElementById('membershipEnquiryDrawer').classList.add('active');
                document.body.style.overflow = 'hidden';
                // show errors in Swal
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: `{!! implode('<br>', $errors->packageForm->all()) !!}`
                });

            });
        </script>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const drawerWrap = document.getElementById("membershipEnquiryDrawer");
            const drawerOverlay = document.getElementById("aqDrawerOverlay");
            const drawerCloseBtn = document.getElementById("aqDrawerCloseBtn");
            const drawerForm = document.getElementById("membershipEnquiryForm");

            // Open Drawer
            window.openDrawer = function (packageName, packageId) {

                document.getElementById('package_id').value = packageId;

                drawerWrap.classList.add("active");
                document.body.style.overflow = "hidden";
            };

            // Close Drawer
            function closeEnquiryDrawer() {

                drawerWrap.classList.remove("active");
                document.body.style.overflow = "";

                setTimeout(() => {

                    drawerForm.reset();

                    document.querySelectorAll(
                        '.aq-drawer-input-wrapper, .aq-drawer-select-wrapper'
                    ).forEach(wrapper => {
                        wrapper.classList.remove("focus");
                    });

                }, 300);
            }

            // Input Focus Effect
            function setupInputEffects() {

                const inputs = document.querySelectorAll(
                    '.aq-drawer-input, .aq-drawer-select, .aq-drawer-textarea'
                );

                inputs.forEach(input => {

                    const wrapper = input.closest(
                        '.aq-drawer-input-wrapper, .aq-drawer-select-wrapper'
                    );

                    if (!wrapper) return;

                    input.addEventListener("focus", () => {
                        wrapper.classList.add("focus");
                    });

                    input.addEventListener("blur", () => {
                        wrapper.classList.remove("focus");
                    });

                });
            }

            // Close Events
            if (drawerCloseBtn) {
                drawerCloseBtn.addEventListener("click", closeEnquiryDrawer);
            }

            if (drawerOverlay) {
                drawerOverlay.addEventListener("click", closeEnquiryDrawer);
            }

            // ESC Key Close
            document.addEventListener("keydown", function (e) {

                if (e.key === "Escape" && drawerWrap.classList.contains("active")) {
                    closeEnquiryDrawer();
                }

            });

            setupInputEffects();

        });
    </script>
@endsection