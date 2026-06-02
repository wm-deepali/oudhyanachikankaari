@extends('layouts.app')

@section('content')

       <main>

        <!-- 1. Luxury Inner Banner / Hero Section -->
        <section class="aq-catpage-hero">
            <div class="aq-hero-glow"></div>
            <div class="aq-floating-gift-box aq-floating-shape-1">
                <i class="fa-solid fa-trophy"></i>
            </div>
            <div class="aq-floating-gift-box aq-floating-shape-2">
                <i class="fa-solid fa-medal"></i>
            </div>
            <div class="aq-catpage-hero-content">
                <h1 class="aq-catpage-title">Awards</h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="index.html">Home</a>
                    <span>/</span>
                    <span>Awards</span>
                </div>
            </div>
        </section>

        
        
        <div class="aq-engraving-page-wrap">
        <section class="aq-engraving-intro-section">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-8">
                            <span class="aq-section-title-sm aq-engraving-title-sm">Our Achievements</span>
                            <h2 class="aq-section-title aq-engraving-main-title">Awards & Recognition</h2>
                            <p class="aq-section-desc aq-engraving-desc">
                                                                   Celebrating excellence in corporate gifting. Our commitment to quality, innovation, and customer satisfaction has been recognized by industry leaders.

                            </p>
                           
                        </div>
                    </div>
                </div>
            </section>
                </div>
        
        
            <!-- 3. Awards Gallery Section -->
        <section class="aq-awards-gallery-section pt-100 pb-100" style="background: rgba(0, 49, 8, 0.02);">
            <div class="container">
                <div class="row justify-content-center mb-50">
                 
                    
                     <div class="col-lg-8 text-center">
                    <div class="aq-creative-title-box">
                                    <span class="aq-creative-subtitle">Glimpses of Glory</span>
                                    <h4 class="aq-creative-title">Awards Gallery</h4>
                                    <div class="aq-creative-title-line"></div>
                                </div>
                </div>
                </div>
                <div class="row g-4 popup-gallery">
    @forelse($awards as $award)
        <div class="col-lg-3 col-md-6">
            <div class="aq-gallery-card-luxury">
                <a href="{{ asset('storage/' . $award->image) }}"
                   class="popup-image"
                   title="{{ $award->title }}">

                    <div class="aq-gallery-img-box">
                        <img src="{{ asset('storage/' . $award->image) }}"
                             alt="{{ $award->title }}"
                             loading="lazy">

                        <div class="aq-gallery-overlay">
                            <i class="fa-solid fa-expand"></i>
                        </div>
                    </div>

                    <div class="aq-gallery-content">
                        <h4 class="aq-gallery-title">
                            {{ $award->title }}
                        </h4>

                        <p class="aq-gallery-date">
                            {{ $award->year }}
                        </p>
                    </div>
                </a>
            </div>
        </div>
    @empty
        <div class="col-12 text-center">
            <p>No awards found.</p>
        </div>
    @endforelse
</div>
            </div>
        </section>
        
        
        
        
           <!-- 4. Awards CTA Section -->
        <section class="aq-awards-cta-section pt-100 pb-100">
            <div class="container">
                <div class="aq-awards-cta-wrapper">
                    <div class="aq-awards-cta-shape-1"></div>
                    <div class="aq-awards-cta-shape-2"></div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <h2 class="aq-awards-cta-title">Ready to Experience Award-Winning Gifting?</h2>
                            <p class="aq-awards-cta-desc">
                                Join hundreds of top brands who trust us for their premium corporate gifting needs. Let our expert curators craft the perfect gifting experience for your company.
                            </p>
                            <div class="aq-awards-cta-btn-wrap mt-40">
                                <a href="{{ route('contact-us') }}" class="aq-btn-black btn-red-bg aq-awards-cta-btn mr-20">Get in Touch</a>
                                <a href="javascript:void(0);" onclick="openGlobalDrawer('awards_page')" class="aq-btn-outline aq-awards-cta-btn-outline">Request Bulk Quote</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <script>
          // Initialize Magnific Popup for Gallery
        $(document).ready(function() {
            if ($('.popup-image').length > 0) {
                $('.popup-image').magnificPopup({
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    mainClass: 'mfp-fade',
                    removalDelay: 160
                });
            }
        });
    </script>

@endsection

