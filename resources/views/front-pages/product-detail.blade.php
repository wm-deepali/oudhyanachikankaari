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
                <h1 class="aq-catpage-title">Roohani Organza Saree</h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="index.html">Home</a>
                    <span>/</span>
                    <a href="product_listing.html">Women's Wear</a>
                    <span>/</span>
                    <span>Product Details</span>
                </div>
            </div>
        </section> <!-- collection area start -->
        <!-- Centralized Styles moved to custom-luxury.css -->

        <!-- 1. Luxury Product Details Container -->
        <section class="aq-product-details-area pt-50 pb-60">
            <div class="container">
                <!-- Elegant Breadcrumbs -->
                <div class="aq-details-breadcrumbs mb-40">
                    <a href="index.html">Home</a>
                    <span class="divider">/</span>
                    <a href="product_listing.html">Women's Wear</a>
                    <span class="divider">/</span>
                    <span class="current">Roohani Organza Saree</span>
                </div>

                <div class="row g-5 justify-content-between">

                    <!-- Left Column: Image Gallery -->
                    <div class="col-lg-6 col-md-12">
                        <div class="aq-product-gallery">
                            <div class="aq-gallery-badge-wrap">
                                <span class="aq-gallery-badge bestseller">New Arrival</span>
                                <span class="aq-gallery-badge logo-branding">For Sale</span>
                            </div>
                            <div class="aq-gallery-main-img-wrap">
                                <img id="aqMainProductImg" src="{{ asset('assets/img/corporate/roohani_organza_saree.png') }}"
                                    alt="Roohani Organza Saree" class="aq-gallery-main-img" />
                                <div class="aq-gallery-zoom-hint"><i class="fa-solid fa-magnifying-glass-plus"></i> Roll
                                    over image to zoom</div>
                            </div>
                            <!-- Gallery Thumbnails -->
                            <div class="aq-gallery-thumbs mt-25">
                                <div class="aq-gallery-thumb-item active"
                                    onclick="updateMainImage(this, '{{ asset('assets/img/corporate/roohani_organza_saree.png') }}')">
                                    <img src="{{ asset('assets/img/corporate/roohani_organza_saree.png') }}" alt="Thumbnail 1" />
                                </div>
                                <div class="aq-gallery-thumb-item"
                                    onclick="updateMainImage(this, '{{ asset('assets/img/corporate/meher_silk_dupatta.png') }}')">
                                    <img src="{{ asset('assets/img/corporate/meher_silk_dupatta.png') }}" alt="Thumbnail 2" />
                                </div>
                                <div class="aq-gallery-thumb-item"
                                    onclick="updateMainImage(this, '{{ asset('assets/img/corporate/gallery_cotton_anarkali.png') }}')">
                                    <img src="{{ asset('assets/img/corporate/gallery_cotton_anarkali.png') }}" alt="Thumbnail 3" />
                                </div>
                                <div class="aq-gallery-thumb-item"
                                    onclick="updateMainImage(this, '{{ asset('assets/img/corporate/gallery_mukaish_dupatta.png') }}')">
                                    <img src="{{ asset('assets/img/corporate/gallery_mukaish_dupatta.png') }}" alt="Thumbnail 4" />
                                </div>
                            </div>
                        </div>

                        <!-- SUITABLE FOR SELECTIONS -->
                        <div class="aq-details-suitable-wrap mt-30 mb-20">
                            <h5 class="aq-details-suitable-title">
                                <i class="fa-solid fa-check-double"></i> Perfectly Suited For
                            </h5>

                            <!-- Occasions Grid -->
                            <div class="aq-details-suitable-grid">
                                <div class="aq-details-suitable-item">
                                    <div class="aq-details-suitable-icon">
                                        <i class="fa-solid fa-rings-wedding"></i>
                                    </div>
                                    <span>Wedding</span>
                                </div>
                                <div class="aq-details-suitable-item">
                                    <div class="aq-details-suitable-icon">
                                        <i class="fa-solid fa-sparkles"></i>
                                    </div>
                                    <span>Festive</span>
                                </div>
                                <div class="aq-details-suitable-item">
                                    <div class="aq-details-suitable-icon">
                                        <i class="fa-solid fa-martini-glass"></i>
                                    </div>
                                    <span>Party</span>
                                </div>
                            </div>
                        </div>
                        <!-- Trust Badges Section -->
                        <div class="aq-luxury-trust-badges">
                            <!-- Badge 1: PAN India Delivery -->
                            <div class="aq-trust-badge-item">
                                <span class="aq-trust-badge-icon"><i class="fa-solid fa-truck-fast"></i></span>
                                <div class="aq-trust-badge-content">
                                    <span class="aq-trust-badge-text">PAN India Delivery</span>
                                    <span class="aq-trust-badge-sub">Express Shipping (7-10 Days)</span>
                                </div>
                            </div>
                            <!-- Badge 2: Quality assurance check -->
                            <div class="aq-trust-badge-item">
                                <span class="aq-trust-badge-icon"><i class="fa-solid fa-circle-check"></i></span>
                                <div class="aq-trust-badge-content">
                                    <span class="aq-trust-badge-text">100% Quality Audited</span>
                                    <span class="aq-trust-badge-sub">Strict Assurance Audit</span>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Right Column: Product Specs & Ordering Drawer Trigger -->
                    <div class="col-lg-6 col-md-12">
                        <div class="aq-product-details-summary">
                            <span class="aq-details-brand">OUDHYANA EXCLUSIVE</span>
                            <h2 class="aq-details-title">Roohani Organza Saree</h2>
                            <!-- <div class="flex gap-2 flex-wrap mt-2" style="display: flex; gap: 8px; flex-wrap: wrap; margin-top: 8px;">
                                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded" style="background-color: #d1fae5; color: #047857; font-size: 12px; padding: 4px 8px; border-radius: 4px; font-weight: 600; font-family: 'Inter', sans-serif; display: inline-block;">New Arrivals</span>
                                    <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded" style="background-color: #fee2e2; color: #b91c1c; font-size: 12px; padding: 4px 8px; border-radius: 4px; font-weight: 600; font-family: 'Inter', sans-serif; display: inline-block;">On Sale</span>
                                </div> -->

                            <!-- Star reviews rating -->
                            <div class="aq-details-rating-wrap d-flex align-items-center gap-2 mt-10 mb-15">
                                <div class="aq-details-stars">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <span class="aq-details-rating-text">(4.9 / 5 from 34 verified customer reviews)</span>
                            </div>

                            <!-- Pricing box -->
                            <div class="aq-details-price-box p-3 mb-25">
                                <div class="d-flex flex-column gap-1">
                                    <div class="aq-price-mrp-row d-flex align-items-center gap-2">
                                        <span class="mrp-label">MRP: <span class="mrp-value">₹8,499</span></span>
                                        <span class="discount-badge">DISCOUNT: 15% OFF</span>
                                    </div>
                                    <div class="aq-price-offered-row d-flex align-items-baseline gap-2 mt-2">
                                        <span class="offered-label">Offered Price:</span>
                                        <span class="aq-details-price">₹7,224</span>
                                        <span class="aq-details-price-unit">/ unit (exclusive of GST)</span>
                                    </div>
                                </div>
                                <div class="aq-moq-info-list">
                                    <p class="mb-2">
                                        <i class="fa-solid fa-circle-info"></i> Minimum Order Quantity (MOQ): <strong>10
                                            Units</strong>
                                    </p>
                                    <p class="mb-0">
                                        <i class="fa-solid fa-truck-fast"></i> Delivery Time: <strong>10-15 Days</strong>
                                    </p>
                                </div>
                            </div>

                            <p class="aq-details-short-desc">
                                A masterpiece of Chikankari craftsmanship, this beautiful organza saree blends timeless
                                elegance with modern grace. Delicately hand-embroidered with intricate motifs, it is
                                perfect for evening soirees and festive celebrations.
                            </p>

                            <!-- Creative Details Block -->
                            <div class="aq-creative-details-block mt-25 mb-30">
                                <div class="aq-detail-item">
                                    <span class="detail-label">Fabric</span>
                                    <span class="detail-value">Pure Organza Silk</span>
                                </div>
                                <div class="aq-detail-item">
                                    <span class="detail-label">Color</span>
                                    <span class="detail-value d-flex align-items-center gap-2">
                                        <span class="color-swatch" style="background-color: #d1b3d4;"></span> Lilac
                                        Purple
                                    </span>
                                </div>
                                <div class="aq-detail-item">
                                    <span class="detail-label">Work</span>
                                    <span class="detail-value">Handcrafted Chikankari & Mukaish</span>
                                </div>
                                <div class="aq-detail-item">
                                    <span class="detail-label">Include</span>
                                    <span class="detail-value">Unstitched Blouse Piece (1 mtr)</span>
                                </div>
                            </div>

                            <!-- Co-Branding Customizer -->
                            <!-- Size Selection -->
                            <div class="aq-size-selection-panel p-3 mb-25">
                                <div class="d-flex justify-content-between align-items-center mb-10">
                                    <h5 class="aq-size-title mb-0">Select Size</h5>
                                    <a href="#" class="aq-size-guide-link"><i class="fa-solid fa-ruler"></i> Size
                                        Guide</a>
                                </div>
                                <div class="aq-product-size-row gap-2 mt-2">
                                    <button class="aq-size-badge">S</button>
                                    <button class="aq-size-badge active">M</button>
                                    <button class="aq-size-badge">L</button>
                                    <button class="aq-size-badge">XL</button>
                                    <button class="aq-size-badge">XXL</button>
                                </div>
                            </div>

                            <!-- Interactive Quantity and Action -->
                            <div class="aq-action-panel p-3 mb-30">
                                <div class="d-flex flex-column flex-sm-row align-items-center gap-3">
                                    <div class="aq-qty-selector luxury-qty">
                                        <button type="button" class="qty-btn" onclick="adjustQty(-1)"><i
                                                class="fa-solid fa-minus"></i></button>
                                        <input type="number" id="aqDetailQty" value="1" min="1" max="10" />
                                        <button type="button" class="qty-btn" onclick="adjustQty(1)"><i
                                                class="fa-solid fa-plus"></i></button>
                                    </div>
                                    <button class="aq-btn-black flex-grow-1 aq-add-to-cart-btn luxury-btn-outline">
                                        <i class="fa-solid fa-bag-shopping"></i> Add to Cart
                                    </button>
                                </div>
                                <button class="aq-btn-black btn-red-bg w-100 mt-3 aq-buy-now-btn luxury-btn-solid">
                                    Buy it Now
                                </button>
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
                            <li class="nav-item">
                                <button class="nav-link" id="faqs-tab" data-bs-toggle="tab" data-bs-target="#tab-faqs"
                                    type="button" role="tab">Stitching Services</button>
                            </li>
                        </ul>
                        <div class="tab-content aq-details-tab-content p-4 mt-3">

                            <!-- Description Tab -->
                            <div class="tab-pane fade show active" id="tab-desc" role="tabpanel">
                                <div class="row align-items-center py-3">
                                    <div class="col-lg-7">
                                        <h4 class="aq-tab-heading">Timeless Chikankari Heritage</h4>
                                        <p class="aq-tab-text">
                                            Handcrafted by skilled artisans in Lucknow, this piece embodies the delicate
                                            and intricate art of Chikankari embroidery. Passed down through generations,
                                            this traditional weaving technique adds a royal, ethereal charm to the
                                            luxurious pure organza fabric.
                                        </p>
                                        <p class="aq-tab-text">
                                            Perfectly suited for evening gatherings, festive celebrations, and wedding
                                            ceremonies. The exquisite thread work combined with modern silhouettes
                                            creates an outfit that is both traditional and beautifully contemporary.
                                        </p>
                                    </div>
                                    <div class="col-lg-5 text-center mt-3 mt-lg-0">
                                        <img src="{{ asset('assets/img/corporate/meher_silk_dupatta.png') }}" class="aq-tab-img"
                                            alt="Embroidery Detail" />
                                    </div>
                                </div>
                            </div>

                            <!-- Branding Specs Tab -->
                            <div class="tab-pane fade" id="tab-brand" role="tabpanel">
                                <h4 class="aq-tab-heading">Fabric & Care Instructions</h4>
                                <p class="aq-tab-text">
                                    To maintain the longevity and brilliance of the handcrafted Chikankari embroidery
                                    and premium fabrics, please adhere strictly to these care instructions.
                                </p>
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered align-middle aq-tab-table">
                                        <thead>
                                            <tr>
                                                <th>Feature</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Fabric Composition</strong></td>
                                                <td>100% Pure Organza Silk</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Embroidery Type</strong></td>
                                                <td>Authentic Handcrafted Lucknowi Chikankari</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Washing Instructions</strong></td>
                                                <td>Dry Clean Only. Do not hand wash or machine wash.</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Ironing Instructions</strong></td>
                                                <td>Steam iron only on low heat. Do not iron directly on the embroidery.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Logistics Tab -->
                            <div class="tab-pane fade" id="tab-shipping" role="tabpanel">
                                <h4 class="aq-tab-heading">Shipping & Return Policies</h4>
                                <p class="aq-tab-text">
                                    We partner with premium logistics providers to ensure your luxury apparel reaches
                                    you in perfect condition and on time.
                                </p>
                                <div class="row g-4 mt-3">
                                    <div class="col-md-4">
                                        <div class="shipping-card p-3">
                                            <h5><i class="fa-solid fa-truck-fast mr-5"></i> Express Dispatch</h5>
                                            <p>Ready to ship items are dispatched within 48 hours. Custom stitched items
                                                require an additional 5-7 business days before dispatch.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="shipping-card p-3">
                                            <h5><i class="fa-solid fa-globe mr-5"></i> International Shipping</h5>
                                            <p>We ship worldwide. International orders are typically delivered within
                                                7-14 business days via DHL/FedEx.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="shipping-card p-3">
                                            <h5><i class="fa-solid fa-box-open mr-5"></i> Return Policy</h5>
                                            <p>We accept returns within 7 days of delivery for unstitched items in
                                                original condition. Custom stitched apparel is not eligible for return.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQs Tab -->
                            <div class="tab-pane fade" id="tab-faqs" role="tabpanel">
                                <h4 class="aq-tab-heading">Customization & Stitching Services</h4>
                                <div class="accordion" id="aqDetailFaqAccordion">
                                    <div class="accordion-item aq-faq-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed aq-faq-btn" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#detailFaq1">
                                                Do you offer custom tailoring?
                                            </button>
                                        </h2>
                                        <div id="detailFaq1" class="accordion-collapse collapse"
                                            data-bs-parent="#aqDetailFaqAccordion">
                                            <div class="accordion-body aq-faq-body">
                                                Yes, our expert in-house tailors can stitch the included blouse piece to
                                                your exact measurements. Once you place an order with the 'Custom
                                                Stitching' option, our team will email you a measurement form.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item aq-faq-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed aq-faq-btn" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#detailFaq2">
                                                How much does custom stitching cost?
                                            </button>
                                        </h2>
                                        <div id="detailFaq2" class="accordion-collapse collapse"
                                            data-bs-parent="#aqDetailFaqAccordion">
                                            <div class="accordion-body aq-faq-body">
                                                Standard blouse stitching costs ₹1,500. Designer cuts, padded blouses,
                                                or complex necklines may incur additional charges.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item aq-faq-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed aq-faq-btn" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#detailFaq3">
                                                Can I request color customization?
                                            </button>
                                        </h2>
                                        <div id="detailFaq3" class="accordion-collapse collapse"
                                            data-bs-parent="#aqDetailFaqAccordion">
                                            <div class="accordion-body aq-faq-body">
                                                For bespoke creations and bridal orders, we offer complete color
                                                customization and dyeing services. Please contact our bridal concierge
                                                for more details.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
        </section>

        <!-- 2. New Arrivals Section -->
        <section class="aq-new-arrivals-section pt-60 pb-60">
            <div class="container">
                <div class="row align-items-center mb-40">
                    <div class="col">
                        <div class="aq-product-card" data-category="onboarding" data-price="1899">
                            <div class="aq-product-card-top">
                                <div class="aq-product-media-wrapper">
                                    <img src="{{ asset('assets/img/corporate/gallery_cotton_anarkali.png') }}"
                                        class="aq-product-card-img primary-img" alt="Elite Executive Gift Set" />
                                    <img src="{{ asset('assets/img/corporate/gallery_bridal_lehenga.png') }}" class="secondary-img"
                                        alt="Second Image" />
                                    <img src="{{ asset('assets/img/corporate/meher_silk_dupatta.png') }}" class="tertiary-img"
                                        alt="Third Image" />
                                    <video src="{{ asset('assets/img/corporate/reals_video.mp4') }}" class="aq-product-card-video" muted
                                        loop playsinline></video>
                                    <div class="aq-product-media-indicator">
                                        <span class="aq-media-dot active"></span>
                                        <span class="aq-media-dot"></span>
                                        <span class="aq-media-dot"></span>
                                        <span class="aq-media-dot"></span>
                                    </div>
                                </div>
                                <div class="aq-product-badges">
                                    <span class="aq-product-badge bestseller">Best Seller</span>
                                </div>
                                <div class="aq-product-brand-badge">
                                    <img src="{{ asset('assets/img/corporate/gallery_cotton_anarkali.png') }}" alt="Product Image" />
                                </div>
                                <div class="aq-product-actions">
                                    <button class="aq-product-action-btn" title="Quick Consultation" data-bs-toggle="modal"
                                        data-bs-target="#bulkOrderModal">
                                        <i class="fa-regular fa-envelope"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="aq-product-card-info">
                                <span class="aq-product-card-brand-name">Oudhyana</span>
                                <h4 class="aq-product-card-title"><a href="#">Roohani Organza Saree</a>
                                </h4>
                                <p class="aq-product-card-desc">
                                    Premium handcrafted chikankari apparel with delicate embroidery.</p>
                                <div class="aq-product-card-price-group">
                                    <span class="aq-product-card-price">₹1,899</span>
                                    <span class="aq-product-card-old-price">₹2,499</span>
                                    <span class="aq-product-card-discount">(24% OFF)</span>
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
                    <div class="col">
                        <div class="aq-product-card" data-category="onboarding" data-price="1899">
                            <div class="aq-product-card-top">
                                <div class="aq-product-media-wrapper">
                                    <img src="{{ asset('assets/img/corporate/gallery_cotton_anarkali.png') }}"
                                        class="aq-product-card-img primary-img" alt="Elite Executive Gift Set" />
                                    <img src="{{ asset('assets/img/corporate/gallery_bridal_lehenga.png') }}" class="secondary-img"
                                        alt="Second Image" />
                                    <img src="{{ asset('assets/img/corporate/meher_silk_dupatta.png') }}" class="tertiary-img"
                                        alt="Third Image" />
                                    <video src="{{ asset('assets/img/corporate/reals_video.mp4') }}" class="aq-product-card-video" muted
                                        loop playsinline></video>
                                    <div class="aq-product-media-indicator">
                                        <span class="aq-media-dot active"></span>
                                        <span class="aq-media-dot"></span>
                                        <span class="aq-media-dot"></span>
                                        <span class="aq-media-dot"></span>
                                    </div>
                                </div>
                                <div class="aq-product-badges">
                                    <span class="aq-product-badge bestseller">Best Seller</span>
                                </div>
                                <div class="aq-product-brand-badge">
                                    <img src="{{ asset('assets/img/corporate/gallery_cotton_anarkali.png') }}" alt="Product Image" />
                                </div>
                                <div class="aq-product-actions">
                                    <button class="aq-product-action-btn" title="Quick Consultation" data-bs-toggle="modal"
                                        data-bs-target="#bulkOrderModal">
                                        <i class="fa-regular fa-envelope"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="aq-product-card-info">
                                <span class="aq-product-card-brand-name">Oudhyana</span>
                                <h4 class="aq-product-card-title"><a href="#">Roohani Organza Saree</a>
                                </h4>
                                <p class="aq-product-card-desc">
                                    Premium handcrafted chikankari apparel with delicate embroidery.</p>
                                <div class="aq-product-card-price-group">
                                    <span class="aq-product-card-price">₹1,899</span>
                                    <span class="aq-product-card-old-price">₹2,499</span>
                                    <span class="aq-product-card-discount">(24% OFF)</span>
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
                    <div class="col">
                        <div class="aq-product-card" data-category="onboarding" data-price="1899">
                            <div class="aq-product-card-top">
                                <div class="aq-product-media-wrapper">
                                    <img src="{{ asset('assets/img/corporate/gallery_cotton_anarkali.png') }}"
                                        class="aq-product-card-img primary-img" alt="Elite Executive Gift Set" />
                                    <img src="{{ asset('assets/img/corporate/gallery_bridal_lehenga.png') }}" class="secondary-img"
                                        alt="Second Image" />
                                    <img src="{{ asset('assets/img/corporate/meher_silk_dupatta.png') }}" class="tertiary-img"
                                        alt="Third Image" />
                                    <video src="{{ asset('assets/img/corporate/reals_video.mp4') }}" class="aq-product-card-video" muted
                                        loop playsinline></video>
                                    <div class="aq-product-media-indicator">
                                        <span class="aq-media-dot active"></span>
                                        <span class="aq-media-dot"></span>
                                        <span class="aq-media-dot"></span>
                                        <span class="aq-media-dot"></span>
                                    </div>
                                </div>
                                <div class="aq-product-badges">
                                    <span class="aq-product-badge bestseller">Best Seller</span>
                                </div>
                                <div class="aq-product-brand-badge">
                                    <img src="{{ asset('assets/img/corporate/gallery_cotton_anarkali.png') }}" alt="Product Image" />
                                </div>
                                <div class="aq-product-actions">
                                    <button class="aq-product-action-btn" title="Quick Consultation" data-bs-toggle="modal"
                                        data-bs-target="#bulkOrderModal">
                                        <i class="fa-regular fa-envelope"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="aq-product-card-info">
                                <span class="aq-product-card-brand-name">Oudhyana</span>
                                <h4 class="aq-product-card-title"><a href="#">Roohani Organza Saree</a>
                                </h4>
                                <p class="aq-product-card-desc">
                                    Premium handcrafted chikankari apparel with delicate embroidery.</p>
                                <div class="aq-product-card-price-group">
                                    <span class="aq-product-card-price">₹1,899</span>
                                    <span class="aq-product-card-old-price">₹2,499</span>
                                    <span class="aq-product-card-discount">(24% OFF)</span>
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
                    <div class="col">
                        <div class="aq-product-card" data-category="onboarding" data-price="1899">
                            <div class="aq-product-card-top">
                                <div class="aq-product-media-wrapper">
                                    <img src="{{ asset('assets/img/corporate/gallery_cotton_anarkali.png') }}"
                                        class="aq-product-card-img primary-img" alt="Elite Executive Gift Set" />
                                    <img src="{{ asset('assets/img/corporate/gallery_bridal_lehenga.png') }}" class="secondary-img"
                                        alt="Second Image" />
                                    <img src="{{ asset('assets/img/corporate/meher_silk_dupatta.png') }}" class="tertiary-img"
                                        alt="Third Image" />
                                    <video src="{{ asset('assets/img/corporate/reals_video.mp4') }}" class="aq-product-card-video" muted
                                        loop playsinline></video>
                                    <div class="aq-product-media-indicator">
                                        <span class="aq-media-dot active"></span>
                                        <span class="aq-media-dot"></span>
                                        <span class="aq-media-dot"></span>
                                        <span class="aq-media-dot"></span>
                                    </div>
                                </div>
                                <div class="aq-product-badges">
                                    <span class="aq-product-badge bestseller">Best Seller</span>
                                </div>
                                <div class="aq-product-brand-badge">
                                    <img src="{{ asset('assets/img/corporate/gallery_cotton_anarkali.png') }}" alt="Product Image" />
                                </div>
                                <div class="aq-product-actions">
                                    <button class="aq-product-action-btn" title="Quick Consultation" data-bs-toggle="modal"
                                        data-bs-target="#bulkOrderModal">
                                        <i class="fa-regular fa-envelope"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="aq-product-card-info">
                                <span class="aq-product-card-brand-name">Oudhyana</span>
                                <h4 class="aq-product-card-title"><a href="#">Roohani Organza Saree</a>
                                </h4>
                                <p class="aq-product-card-desc">
                                    Premium handcrafted chikankari apparel with delicate embroidery.</p>
                                <div class="aq-product-card-price-group">
                                    <span class="aq-product-card-price">₹1,899</span>
                                    <span class="aq-product-card-old-price">₹2,499</span>
                                    <span class="aq-product-card-discount">(24% OFF)</span>
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

                </div>
            </div>
        </section>

        <!-- 3. Related Products Section -->
        <section class="aq-related-products-section pt-60 pb-60">
            <div class="container">
                <div class="row align-items-center mb-40">
                    <div class="col-12 text-center">
                        <div class="aq-creative-title-box">
                            <span class="aq-creative-subtitle">Bespoke Collection Drawer</span>
                            <h2 class="aq-creative-title">Related Products</h2>
                            <div class="aq-creative-title-line"></div>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1 g-4 justify-content-center">

                    <!-- Card 1 -->
                    <div class="col">
                        <div class="aq-product-card" data-category="onboarding" data-price="999">
                            <div class="aq-product-card-top">
                                <img src="{{ asset('assets/img/corporate/card_imges5.webp') }}" class="aq-product-card-img"
                                    alt="Starter Joining Box" />
                                <div class="aq-product-brand-badge">
                                    <img src="{{ asset('assets/img/corporate/Oudhyana_img/logo.png') }}" alt="B2B Gifts" />
                                </div>
                                <div class="aq-product-actions">
                                    <button class="aq-product-action-btn" title="Quick Consultation" data-bs-toggle="modal"
                                        data-bs-target="#bulkOrderModal">
                                        <i class="fa-regular fa-envelope"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="aq-product-card-info">
                                <span class="aq-product-card-brand-name">Premium Curation</span>
                                <h4 class="aq-product-card-title"><a href="#">Starter Joining Box</a></h4>
                                <p>Includes: Minimalist Notepad, Metal Keychain, & Soft Touch Ball Pen</p>
                                <div class="aq-product-card-bottom">
                                    <div class="aq-product-card-price">₹999 <span>/ unit</span></div>
                                    <button class="aq-product-card-cta aq-bulk-orders-btn" data-bs-toggle="modal"
                                        data-bs-target="#bulkOrderModal">Enquire</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col">
                        <div class="aq-product-card" data-category="onboarding" data-price="2999">
                            <div class="aq-product-card-top">
                                <img src="{{ asset('assets/img/corporate/stationery_gifts_1778668654881.webp') }}"
                                    class="aq-product-card-img" alt="Bespoke Smart Welcome Kit" />
                                <div class="aq-product-badges">
                                    <span class="aq-product-badge new">New</span>
                                </div>
                                <div class="aq-product-brand-badge">
                                    <img src="{{ asset('assets/img/corporate/microsoft_logo.webp') }}" alt="Microsoft Premium" />
                                </div>
                                <div class="aq-product-actions">
                                    <button class="aq-product-action-btn" title="Quick Consultation" data-bs-toggle="modal"
                                        data-bs-target="#bulkOrderModal">
                                        <i class="fa-regular fa-envelope"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="aq-product-card-info">
                                <span class="aq-product-card-brand-name">Swiss Military</span>
                                <h4 class="aq-product-card-title"><a href="#">Bespoke Smart Welcome Kit</a></h4>
                                <p>Includes: Tech Backpack, Temperature Smart Flask & Executive Planner</p>
                                <div class="aq-product-card-bottom">
                                    <div class="aq-product-card-price">₹2,999 <span>/ unit</span></div>
                                    <button class="aq-product-card-cta aq-bulk-orders-btn" data-bs-toggle="modal"
                                        data-bs-target="#bulkOrderModal">Enquire</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col">
                        <div class="aq-product-card" data-category="onboarding" data-price="3999">
                            <div class="aq-product-card-top">
                                <img src="{{ asset('assets/img/corporate/backpack_gifts_1778668040094.webp') }}"
                                    class="aq-product-card-img" alt="Prestige Leadership Kit" />
                                <div class="aq-product-badges">
                                    <span class="aq-product-badge bestseller">Best Seller</span>
                                </div>
                                <div class="aq-product-brand-badge">
                                    <img src="{{ asset('assets/img/corporate/apple_logo.webp') }}" alt="Apple Curation" />
                                </div>
                                <div class="aq-product-actions">
                                    <button class="aq-product-action-btn" title="Quick Consultation" data-bs-toggle="modal"
                                        data-bs-target="#bulkOrderModal">
                                        <i class="fa-regular fa-envelope"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="aq-product-card-info">
                                <span class="aq-product-card-brand-name">Tiger Leather</span>
                                <h4 class="aq-product-card-title"><a href="#">Prestige Leadership Curation</a></h4>
                                <p>Includes: Leatherette Travel Tote, Cross Rollerball Pen & Smart Wallet</p>
                                <div class="aq-product-card-bottom">
                                    <div class="aq-product-card-price">₹3,999 <span>/ unit</span></div>
                                    <button class="aq-product-card-cta aq-bulk-orders-btn" data-bs-toggle="modal"
                                        data-bs-target="#bulkOrderModal">Enquire</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="col">
                        <div class="aq-product-card" data-category="onboarding" data-price="1899">
                            <div class="aq-product-card-top">
                                <img src="{{ asset('assets/img/corporate/welcome_kit_1778668006890.webp') }}" class="aq-product-card-img"
                                    alt="Elite Executive Gift Set" />
                                <div class="aq-product-badges">
                                    <span class="aq-product-badge bestseller">Best Seller</span>
                                </div>
                                <div class="aq-product-brand-badge">
                                    <img src="{{ asset('assets/img/corporate/google_logo.webp') }}" alt="Google Premium" />
                                </div>
                                <div class="aq-product-actions">
                                    <button class="aq-product-action-btn" title="Quick Consultation" data-bs-toggle="modal"
                                        data-bs-target="#bulkOrderModal">
                                        <i class="fa-regular fa-envelope"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="aq-product-card-info">
                                <span class="aq-product-card-brand-name">Premium Curation</span>
                                <h4 class="aq-product-card-title"><a href="#">Elite Executive Onboarding Set</a></h4>
                                <p>Includes: Leatherette Journal, Matte Black Pen, Vacuum Flask & Keyring</p>
                                <div class="aq-product-card-bottom">
                                    <div class="aq-product-card-price">₹1,899 <span>/ unit</span></div>
                                    <button class="aq-product-card-cta aq-bulk-orders-btn" data-bs-toggle="modal"
                                        data-bs-target="#bulkOrderModal">Enquire</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- 4. Complete Product Listing Catalog (Bottom Showcase) -->
        <section class="aq-bottom-catalog-section pt-60 pb-80">
            <div class="container">
                <div class="row align-items-center mb-40">
                    <div class="col-12 text-center">
                        <div class="aq-creative-title-box">
                            <span class="aq-creative-subtitle">Premium Corporate Catalog</span>
                            <h2 class="aq-creative-title">Explore Our Complete Collection</h2>
                            <div class="aq-creative-title-line"></div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-12">

                        <!-- Header filter summary bar -->
                        <div class="aq-layout-header mb-30">
                            <span class="aq-layout-header-title">Corporate Gifting Premium Catalog</span>
                            <div class="aq-layout-header-options">
                                <span>Showing 4 Premium Collections</span>
                                <select class="aq-sort-select">
                                    <option value="popularity">Sort By: Popularity</option>
                                    <option value="price-low">Price: Low to High</option>
                                    <option value="price-high">Price: High to Low</option>
                                    <option value="newest">Sort By: Newest</option>
                                </select>
                            </div>
                        </div>

                        <!-- Product Cards Grid -->
                        <div class="aq-product-grid">

                            <!-- Item 1 -->
                            <div class="aq-product-card" data-category="onboarding" data-price="1899">
                                <div class="aq-product-card-top">
                                    <img src="{{ asset('assets/img/corporate/welcome_kit_1778668006890.webp') }}"
                                        class="aq-product-card-img" alt="Elite Executive Gift Set" />
                                    <div class="aq-product-badges">
                                        <span class="aq-product-badge bestseller">Best Seller</span>
                                    </div>
                                    <div class="aq-product-brand-badge">
                                        <img src="{{ asset('assets/img/corporate/google_logo.webp') }}" alt="Google Premium" />
                                    </div>
                                    <div class="aq-product-actions">
                                        <button class="aq-product-action-btn" title="Quick Consultation"
                                            data-bs-toggle="modal" data-bs-target="#bulkOrderModal">
                                            <i class="fa-regular fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="aq-product-card-info">
                                    <span class="aq-product-card-brand-name">Premium Curation</span>
                                    <h4 class="aq-product-card-title"><a href="#">Elite Executive Onboarding Set</a>
                                    </h4>
                                    <p>Includes: Leatherette Journal, Matte Black Pen, Vacuum Flask & Keyring</p>
                                    <div class="aq-product-card-bottom">
                                        <div class="aq-product-card-price">₹1,899 <span>/ unit</span></div>
                                        <button class="aq-product-card-cta aq-bulk-orders-btn" data-bs-toggle="modal"
                                            data-bs-target="#bulkOrderModal">Enquire</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Item 2 -->
                            <div class="aq-product-card" data-category="onboarding" data-price="2999">
                                <div class="aq-product-card-top">
                                    <img src="{{ asset('assets/img/corporate/stationery_gifts_1778668654881.webp') }}"
                                        class="aq-product-card-img" alt="Bespoke Smart Welcome Kit" />
                                    <div class="aq-product-badges">
                                        <span class="aq-product-badge new">New</span>
                                    </div>
                                    <div class="aq-product-brand-badge">
                                        <img src="{{ asset('assets/img/corporate/microsoft_logo.webp') }}" alt="Microsoft Premium" />
                                    </div>
                                    <div class="aq-product-actions">
                                        <button class="aq-product-action-btn" title="Quick Consultation"
                                            data-bs-toggle="modal" data-bs-target="#bulkOrderModal">
                                            <i class="fa-regular fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="aq-product-card-info">
                                    <span class="aq-product-card-brand-name">Swiss Military</span>
                                    <h4 class="aq-product-card-title"><a href="#">Bespoke Smart Welcome Kit</a></h4>
                                    <p>Includes: Tech Backpack, Temperature Smart Flask & Executive Planner</p>
                                    <div class="aq-product-card-bottom">
                                        <div class="aq-product-card-price">₹2,999 <span>/ unit</span></div>
                                        <button class="aq-product-card-cta aq-bulk-orders-btn" data-bs-toggle="modal"
                                            data-bs-target="#bulkOrderModal">Enquire</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Item 3 -->
                            <div class="aq-product-card" data-category="onboarding" data-price="999">
                                <div class="aq-product-card-top">
                                    <img src="{{ asset('assets/img/corporate/card_imges3.webp') }}" class="aq-product-card-img"
                                        alt="Starter Joining Box" />
                                    <div class="aq-product-brand-badge">
                                        <img src="{{ asset('assets/img/corporate/Oudhyana_img/logo.png') }}" alt="B2B Gifts" />
                                    </div>
                                    <div class="aq-product-actions">
                                        <button class="aq-product-action-btn" title="Quick Consultation"
                                            data-bs-toggle="modal" data-bs-target="#bulkOrderModal">
                                            <i class="fa-regular fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="aq-product-card-info">
                                    <span class="aq-product-card-brand-name">Premium Curation</span>
                                    <h4 class="aq-product-card-title"><a href="#">Starter Joining Box</a></h4>
                                    <p>Includes: Minimalist Notepad, Metal Keychain, & Soft Touch Ball Pen</p>
                                    <div class="aq-product-card-bottom">
                                        <div class="aq-product-card-price">₹999 <span>/ unit</span></div>
                                        <button class="aq-product-card-cta aq-bulk-orders-btn" data-bs-toggle="modal"
                                            data-bs-target="#bulkOrderModal">Enquire</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Item 4 -->
                            <div class="aq-product-card" data-category="onboarding" data-price="3999">
                                <div class="aq-product-card-top">
                                    <img src="{{ asset('assets/img/corporate/backpack_gifts_1778668040094.webp') }}"
                                        class="aq-product-card-img" alt="Prestige Leadership Kit" />
                                    <div class="aq-product-badges">
                                        <span class="aq-product-badge bestseller">Best Seller</span>
                                    </div>
                                    <div class="aq-product-brand-badge">
                                        <img src="{{ asset('assets/img/corporate/apple_logo.webp') }}" alt="Apple Curation" />
                                    </div>
                                    <div class="aq-product-actions">
                                        <button class="aq-product-action-btn" title="Quick Consultation"
                                            data-bs-toggle="modal" data-bs-target="#bulkOrderModal">
                                            <i class="fa-regular fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="aq-product-card-info">
                                    <span class="aq-product-card-brand-name">Tiger Leather</span>
                                    <h4 class="aq-product-card-title"><a href="#">Prestige Leadership Curation</a></h4>
                                    <p>Includes: Leatherette Travel Tote, Cross Rollerball Pen & Smart Wallet</p>
                                    <div class="aq-product-card-bottom">
                                        <div class="aq-product-card-price">₹3,999 <span>/ unit</span></div>
                                        <button class="aq-product-card-cta aq-bulk-orders-btn" data-bs-toggle="modal"
                                            data-bs-target="#bulkOrderModal">Enquire</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>


    <!-- Product Details Custom Interactive Logic Scripts -->
    <script>
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
            if (qtyInput) {
                let newVal = parseInt(qtyInput.value) + amount;
                if (newVal < 50) newVal = 50; // min MOQ is 50
                qtyInput.value = newVal;
                calculateTotalEstimate();
            }
        }

        function calculateTotalEstimate() {
            const qtyInput = document.getElementById('aqDetailQty');
            const totalDisplay = document.getElementById('aqTotalEstimateDisplay');
            if (qtyInput && totalDisplay) {
                const qty = parseInt(qtyInput.value) || 50;
                const pricePerUnit = 1899;
                const total = qty * pricePerUnit;
                totalDisplay.innerText = '₹' + total.toLocaleString('en-IN');
            }
        }

        function handleLogoUpload(input) {
            const label = document.getElementById('logoUploadLabel');
            if (input.files && input.files.length > 0) {
                const fileName = input.files[0].name;
                label.innerText = fileName;
                label.parentElement.style.borderColor = '#28a745';
                label.parentElement.style.color = '#28a745';
                label.parentElement.style.background = '#f4fbf6';
            }
        }

        function selectBrandingOption(option) {
            const btnP = document.getElementById('btnPersonalised');
            const btnE = document.getElementById('btnEmbossed');
            if (!btnP || !btnE) return;

            if (option === 'personalised') {
                // Active state for Personalised
                btnP.style.border = '2px solid #003108';
                btnP.style.background = '#003108';
                btnP.style.color = '#ffffff';
                btnP.style.boxShadow = '0 4px 10px rgba(0, 49, 8, 0.1)';

                // Inactive state for Embossed
                btnE.style.border = '1.5px solid rgba(0, 49, 8, 0.15)';
                btnE.style.background = '#ffffff';
                btnE.style.color = '#003108';
                btnE.style.boxShadow = 'none';
            } else {
                // Active state for Embossed
                btnE.style.border = '2px solid #003108';
                btnE.style.background = '#003108';
                btnE.style.color = '#ffffff';
                btnE.style.boxShadow = '0 4px 10px rgba(0, 49, 8, 0.1)';

                // Inactive state for Personalised
                btnP.style.border = '1.5px solid rgba(0, 49, 8, 0.15)';
                btnP.style.background = '#ffffff';
                btnP.style.color = '#003108';
                btnP.style.boxShadow = 'none';
            }
        }
    </script>
    <!-- collection area end -->


@endsection