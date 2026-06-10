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
                <h1 class="aq-catpage-title">Chikankari Luxury Collections</h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="index.html">Home</a>
                    <span>/</span>
                    <span>Product Listing</span>
                </div>
            </div>
        </section>



        <!-- 3. Interactive Catalog Viewport (Sidebar + Product Catalog) -->
        <section class="aq-catpage-main-layout" id="aq-catalog-section">
            <div class="container">
                <div class="row">
                    <!-- Left Sidebar Filter Console -->
                    <div class="col-lg-3 mb-4 mb-lg-0">
                        <div class="aq-filter-sidebar">
                            <button class="aq-filter-close-btn" id="aq-mobile-filter-close"
                                aria-label="Close Mobile Filters"
                                onclick="document.querySelector('.aq-filter-sidebar').classList.remove('active'); document.querySelector('.body-overlay').classList.remove('opened'); document.body.style.overflow='';"><i
                                    class="fa-solid fa-xmark"></i></button>
                            <!-- Widget Search -->
                            <div class="aq-sidebar-search">
                                <input type="text" id="aq-sidebar-search-input" placeholder="Search within results..." />
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>

                            <!-- Widget: Price Range -->
                            <div class="aq-filter-widget">
                                <button class="aq-filter-header" type="button">
                                    <span>Price Range</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </button>
                                <div class="aq-filter-content">
                                    <div class="aq-price-slider-wrap">
                                        <input type="range" class="aq-price-range-slider" id="priceRange" min="200"
                                            max="10000" step="100" value="10000" />
                                        <div class="aq-price-inputs">
                                            <div class="aq-price-box">Min: ₹200</div>
                                            <div class="aq-price-box" id="maxPriceLabel">Max: ₹10,000</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Widget: Co-Branding Options -->
                            <div class="aq-filter-widget">
                                <button class="aq-filter-header" type="button">
                                    <span>Fabric Type</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </button>
                                <div class="aq-filter-content">
                                    <ul class="aq-filter-list">
                                        <li class="aq-filter-item active" data-filter-type="branding">
                                            <div class="aq-filter-checkbox"><i class="fa-solid fa-check"></i></div>
                                            <span class="aq-filter-label">Cotton</span>
                                        </li>
                                        <li class="aq-filter-item" data-filter-type="branding">
                                            <div class="aq-filter-checkbox"><i class="fa-solid fa-check"></i></div>
                                            <span class="aq-filter-label">Georgette</span>
                                        </li>
                                        <li class="aq-filter-item" data-filter-type="branding">
                                            <div class="aq-filter-checkbox"><i class="fa-solid fa-check"></i></div>
                                            <span class="aq-filter-label">Silk</span>
                                        </li>
                                        <li class="aq-filter-item" data-filter-type="branding">
                                            <div class="aq-filter-checkbox"><i class="fa-solid fa-check"></i></div>
                                            <span class="aq-filter-label">Organza</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Widget: Premium Brands -->
                            <div class="aq-filter-widget">
                                <button class="aq-filter-header" type="button">
                                    <span>Collections</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </button>
                                <div class="aq-filter-content">
                                    <ul class="aq-filter-list">
                                        <li class="aq-filter-item" data-filter-type="brand">
                                            <div class="aq-filter-checkbox"><i class="fa-solid fa-check"></i></div>
                                            <span class="aq-filter-label">New Arrival</span>
                                        </li>
                                        <li class="aq-filter-item" data-filter-type="brand">
                                            <div class="aq-filter-checkbox"><i class="fa-solid fa-check"></i></div>
                                            <span class="aq-filter-label">Festive Wear</span>
                                        </li>
                                        <li class="aq-filter-item" data-filter-type="brand">
                                            <div class="aq-filter-checkbox"><i class="fa-solid fa-check"></i></div>
                                            <span class="aq-filter-label">Bridal Edit</span>
                                        </li>
                                        <li class="aq-filter-item" data-filter-type="brand">
                                            <div class="aq-filter-checkbox"><i class="fa-solid fa-check"></i></div>
                                            <span class="aq-filter-label">Exclusive Series</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Widget: Shop By Occasion -->
                            <div class="aq-filter-widget">
                                <button class="aq-filter-header" type="button">
                                    <span>Shop By Occasion</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </button>
                                <div class="aq-filter-content">
                                    <ul class="aq-filter-list">
                                        <li class="aq-filter-item" data-filter-type="occasion">
                                            <div class="aq-filter-checkbox"><i class="fa-solid fa-check"></i></div>
                                            <span class="aq-filter-label">Wedding</span>
                                        </li>
                                        <li class="aq-filter-item" data-filter-type="occasion">
                                            <div class="aq-filter-checkbox"><i class="fa-solid fa-check"></i></div>
                                            <span class="aq-filter-label text-nowrap">Party Wear</span>
                                        </li>
                                        <li class="aq-filter-item" data-filter-type="occasion">
                                            <div class="aq-filter-checkbox"><i class="fa-solid fa-check"></i></div>
                                            <span class="aq-filter-label">Casual Wear</span>
                                        </li>
                                        <li class="aq-filter-item" data-filter-type="occasion">
                                            <div class="aq-filter-checkbox"><i class="fa-solid fa-check"></i></div>
                                            <span class="aq-filter-label">Office Wear</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Clear all CTA -->
                            <button type="button" class="aq-btn-black w-100 mt-20" id="aq-clear-filters-btn"
                                style="border-radius:12px; font-size:13px; padding:10px;">
                                Reset All Filters
                            </button>
                        </div>

                        <div class="aq-category-grid-section-main">

                            <section class="aq-category-grid-section">

                                <button class="aq-filter-header mb-20 px-4" type="button">
                                    <span>Category</span>

                                </button>
                                <div class="container">


                                    <div class="aq-category-grid">
                                        <!-- 1. Cotton Anarkalis -->
                                        <div class="aq-category-card active" data-category-filter="onboarding">
                                            <div class="aq-category-card-thumb">
                                                <img src="assets/img/corporate/roohani_organza_saree.png"
                                                    alt="Product Image" />
                                            </div>
                                            <h4 class="aq-category-card-title">Cotton Anarkalis</h4>
                                            <span class="aq-category-card-count">140+ Products</span>
                                        </div>

                                        <!-- 2. Bridal Lehengas -->
                                        <div class="aq-category-card" data-category-filter="electronics">
                                            <div class="aq-category-card-thumb">
                                                <img src="assets/img/corporate/gallery_bridal_lehenga.png"
                                                    alt="Bridal Lehengas" />
                                            </div>
                                            <h4 class="aq-category-card-title">Bridal Lehengas</h4>
                                            <span class="aq-category-card-count">85+ Products</span>
                                        </div>

                                        <!-- 3. Silk Dupattas -->
                                        <div class="aq-category-card" data-category-filter="mobile">
                                            <div class="aq-category-card-thumb">
                                                <img src="assets/img/corporate/roohani_organza_saree.png"
                                                    alt="Product Image" />
                                            </div>
                                            <h4 class="aq-category-card-title">Silk Dupattas</h4>
                                            <span class="aq-category-card-count">90+ Products</span>
                                        </div>

                                        <!-- 4. Organza Sarees -->
                                        <div class="aq-category-card" data-category-filter="drinkware">
                                            <div class="aq-category-card-thumb">
                                                <img src="assets/img/corporate/gallery_bridal_lehenga.png"
                                                    alt="Product Image" />
                                            </div>
                                            <h4 class="aq-category-card-title">Luxury Organza Sarees</h4>
                                            <span class="aq-category-card-count">120+ Products</span>
                                        </div>

                                        <!-- 5. Chanderi Gowns -->
                                        <div class="aq-category-card" data-category-filter="stationery">
                                            <div class="aq-category-card-thumb">
                                                <img src="assets/img/corporate/ziba_chanderi_gown.png"
                                                    alt="Chanderi Gowns" />
                                            </div>
                                            <h4 class="aq-category-card-title">Chanderi Gowns</h4>
                                            <span class="aq-category-card-count">75+ Products</span>
                                        </div>

                                        <!-- 6. Unstitched Suits -->
                                        <div class="aq-category-card" data-category-filter="luxury">
                                            <div class="aq-category-card-thumb">
                                                <img src="assets/img/corporate/meher_silk_dupatta.png"
                                                    alt="Product Image" />
                                            </div>
                                            <h4 class="aq-category-card-title">Unstitched Suits</h4>
                                            <span class="aq-category-card-count">55+ Products</span>
                                        </div>

                                        <!-- 7. Mukaish Dupattas -->
                                        <div class="aq-category-card" data-category-filter="sustainable">
                                            <div class="aq-category-card-thumb">
                                                <img src="assets/img/corporate/gallery_mukaish_dupatta.png"
                                                    alt="Mukaish Dupattas" />
                                            </div>
                                            <h4 class="aq-category-card-title">Mukaish Dupattas</h4>
                                            <span class="aq-category-card-count">60+ Products</span>
                                        </div>

                                        <!-- 8. Georgette Kurtis -->
                                        <div class="aq-category-card" data-category-filter="travel">
                                            <div class="aq-category-card-thumb">
                                                <img src="assets/img/corporate/ziba_chanderi_gown.png"
                                                    alt="Product Image" />
                                            </div>
                                            <h4 class="aq-category-card-title">Georgette Kurtis</h4>
                                            <span class="aq-category-card-count">95+ Products</span>
                                        </div>

                                        <!-- 9. Palazzo Sets -->
                                        <div class="aq-category-card" data-category-filter="promo">
                                            <div class="aq-category-card-thumb">
                                                <img src="assets/img/corporate/gallery_palazzo_set.png"
                                                    alt="Product Image" />
                                            </div>
                                            <h4 class="aq-category-card-title">Palazzo Sets</h4>
                                            <span class="aq-category-card-count">180+ Products</span>
                                        </div>

                                        <!-- 10. Mens Kurtas -->
                                        <div class="aq-category-card" data-category-filter="wellness">
                                            <div class="aq-category-card-thumb">
                                                <img src="assets/img/corporate/meher_silk_dupatta.png"
                                                    alt="Product Image" />
                                            </div>
                                            <h4 class="aq-category-card-title">Mens Kurtas</h4>
                                            <span class="aq-category-card-count">45+ Products</span>
                                        </div>

                                        <!-- 11. Kids Wear -->
                                        <div class="aq-category-card" data-category-filter="decor">
                                            <div class="aq-category-card-thumb">
                                                <img src="assets/img/corporate/nazneen_georgette_kurti.png"
                                                    alt="Product Image" />
                                            </div>
                                            <h4 class="aq-category-card-title">Kids Wear</h4>
                                            <span class="aq-category-card-count">70+ Products</span>
                                        </div>

                                        <!-- 12. Accessories -->
                                        <div class="aq-category-card" data-category-filter="rewards">
                                            <div class="aq-category-card-thumb">
                                                <img src="assets/img/corporate/meher_silk_dupatta.png"
                                                    alt="Product Image" />
                                            </div>
                                            <h4 class="aq-category-card-title">Accessories</h4>
                                            <span class="aq-category-card-count">50+ Products</span>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>

                    <!-- Right Product Grid -->
                    <div class="col-lg-9">
                        <!-- Header filter summary bar -->
                        <div class="aq-layout-header">
                            <span class="aq-layout-header-title" id="aq-active-category-title">Cotton Anarkalis
                                Collection</span>
                            <div class="aq-layout-header-options">
                                <button type="button" class="btn btn-outline-dark d-lg-none" id="aq-mobile-filter-open-btn"
                                    style="border-radius: 8px; font-size: 13px; padding: 6px 12px; border: 1px solid #ddd;"
                                    onclick="document.querySelector('.aq-filter-sidebar').classList.add('active'); document.querySelector('.body-overlay').classList.add('opened'); document.body.style.overflow='hidden';">
                                    <i class="fa-solid fa-filter"></i> Filters
                                </button>
                                <span class="d-none d-sm-inline"
                                    style="font-family: Inter, sans-serif; font-size: 13px; color: #666;"
                                    id="aq-product-results-count">Showing 4 Products</span>
                                <select class="aq-sort-select">
                                    <option value="popularity">Sort By: Popularity</option>
                                    <option value="price-low">Price: Low to High</option>
                                    <option value="price-high">Price: High to Low</option>
                                    <option value="newest">Sort By: Newest</option>
                                </select>
                            </div>
                        </div>

                        <!-- Product Cards Grid -->
                        <div class="aq-product-grid" id="aq-product-catalog-grid">
                            <!-- Product items will render dynamically based on top category select triggers -->
                            <!-- Item 1 -->
                            <div class="aq-product-card" data-category="onboarding" data-price="1899">
                                <div class="aq-product-card-top">
                                    <div class="aq-product-media-wrapper">
                                        <img src="assets/img/corporate/gallery_cotton_anarkali.png"
                                            class="aq-product-card-img primary-img" alt="Elite Executive Gift Set" />
                                        <img src="assets/img/corporate/gallery_bridal_lehenga.png" class="secondary-img"
                                            alt="Second Image" />
                                        <img src="assets/img/corporate/meher_silk_dupatta.png" class="tertiary-img"
                                            alt="Third Image" />
                                        <video src="assets/img/corporate/reals_video.mp4" class="aq-product-card-video"
                                            muted loop playsinline></video>
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
                                        <img src="assets/img/corporate/gallery_cotton_anarkali.png" alt="Product Image" />
                                    </div>
                                    <div class="aq-product-actions">
                                        <button class="aq-product-action-btn" title="Quick Consultation"
                                            data-bs-toggle="modal" data-bs-target="#bulkOrderModal">
                                            <i class="fa-regular fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="aq-product-card-info">
                                    <span class="aq-product-card-brand-name">Oudhyana</span>
                                    <h4 class="aq-product-card-title"><a href="#">Roohani Organza Saree</a>
                                    </h4>
                                    <p
                                        style="font-family: Inter, sans-serif; font-size:12px; color:#777; margin-bottom:12px;">
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

                            <!-- Item 2 -->
                            <div class="aq-product-card" data-category="onboarding" data-price="2999">
                                <div class="aq-product-card-top">
                                    <div class="aq-product-media-wrapper">
                                        <img src="assets/img/corporate/stationery_gifts_1778668644555.png"
                                            class="aq-product-card-img primary-img" alt="Bespoke Smart Welcome Kit" />
                                        <img src="assets/img/corporate/roohani_organza_saree.png" class="secondary-img"
                                            alt="Second Image" />
                                        <img src="assets/img/corporate/gallery_mukaish_dupatta.png" class="tertiary-img"
                                            alt="Third Image" />
                                        <video src="assets/img/corporate/reals_video.mp4" class="aq-product-card-video"
                                            muted loop playsinline></video>
                                        <div class="aq-product-media-indicator">
                                            <span class="aq-media-dot active"></span>
                                            <span class="aq-media-dot"></span>
                                            <span class="aq-media-dot"></span>
                                            <span class="aq-media-dot"></span>
                                        </div>
                                    </div>
                                    <div class="aq-product-badges">
                                        <span class="aq-product-badge new">New</span>
                                    </div>
                                    <div class="aq-product-brand-badge">
                                        <img src="assets/img/corporate/gallery_cotton_anarkali.png" alt="Product Image" />
                                    </div>
                                    <div class="aq-product-actions">
                                        <button class="aq-product-action-btn" title="Quick Consultation"
                                            data-bs-toggle="modal" data-bs-target="#bulkOrderModal">
                                            <i class="fa-regular fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="aq-product-card-info">
                                    <span class="aq-product-card-brand-name">Oudhyana</span>
                                    <h4 class="aq-product-card-title"><a href="#">Mukaish Work Dupatta</a>
                                    </h4>
                                    <p
                                        style="font-family: Inter, sans-serif; font-size:12px; color:#777; margin-bottom:12px;">
                                        Premium handcrafted chikankari apparel with delicate embroidery.</p>
                                    <div class="aq-product-card-price-group">
                                        <span class="aq-product-card-price">₹2,999</span>
                                        <span class="aq-product-card-old-price">₹3,999</span>
                                        <span class="aq-product-card-discount">(25% OFF)</span>
                                    </div>
                                    <div class="aq-product-card-sizes">
                                        <span class="aq-size-badge">S</span>
                                        <span class="aq-size-badge active">M</span>
                                        <span class="aq-size-badge">L</span>
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

                            <!-- Item 3 -->
                            <div class="aq-product-card" data-category="onboarding" data-price="999">
                                <div class="aq-product-card-top">
                                    <div class="aq-product-media-wrapper">
                                        <img src="assets/img/corporate/media__1778668962634.png"
                                            class="aq-product-card-img primary-img" alt="Starter Joining Box" />
                                        <img src="assets/img/corporate/ziba_chanderi_gown.png" class="secondary-img"
                                            alt="Second Image" />
                                        <img src="assets/img/corporate/gallery_palazzo_set.png" class="tertiary-img"
                                            alt="Third Image" />
                                        <video src="assets/img/corporate/reals_video.mp4" class="aq-product-card-video"
                                            muted loop playsinline></video>
                                        <div class="aq-product-media-indicator">
                                            <span class="aq-media-dot active"></span>
                                            <span class="aq-media-dot"></span>
                                            <span class="aq-media-dot"></span>
                                            <span class="aq-media-dot"></span>
                                        </div>
                                    </div>
                                    <div class="aq-product-brand-badge">
                                        <img src="assets/img/corporate/ziba_chanderi_gown.png" alt="Product Image" />
                                    </div>
                                    <div class="aq-product-actions">
                                        <button class="aq-product-action-btn" title="Quick Consultation"
                                            data-bs-toggle="modal" data-bs-target="#bulkOrderModal">
                                            <i class="fa-regular fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="aq-product-card-info">
                                    <span class="aq-product-card-brand-name">Oudhyana</span>
                                    <h4 class="aq-product-card-title"><a href="#">Nafasat Warm Peach Chikankari</a>
                                    </h4>
                                    <p
                                        style="font-family: Inter, sans-serif; font-size:12px; color:#777; margin-bottom:12px;">
                                        Premium handcrafted chikankari apparel with delicate embroidery.</p>
                                    <div class="aq-product-card-price-group">
                                        <span class="aq-product-card-price">₹999</span>
                                        <span class="aq-product-card-old-price">₹1,299</span>
                                        <span class="aq-product-card-discount">(23% OFF)</span>
                                    </div>
                                    <div class="aq-product-card-sizes">
                                        <span class="aq-size-badge active">S</span>
                                        <span class="aq-size-badge">M</span>
                                        <span class="aq-size-badge">L</span>
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

                            <!-- Item 4 -->
                            <div class="aq-product-card" data-category="onboarding" data-price="3999">
                                <div class="aq-product-card-top">
                                    <div class="aq-product-media-wrapper">
                                        <img src="assets/img/corporate/nazneen_georgette_kurti.png"
                                            class="aq-product-card-img primary-img" alt="Prestige Leadership Kit" />
                                        <img src="assets/img/corporate/gallery_cotton_anarkali.png" class="secondary-img"
                                            alt="Second Image" />
                                        <img src="assets/img/corporate/meher_silk_dupatta.png" class="tertiary-img"
                                            alt="Third Image" />
                                        <video src="assets/img/corporate/reals_video.mp4" class="aq-product-card-video"
                                            muted loop playsinline></video>
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
                                        <img src="assets/img/corporate/ziba_chanderi_gown.png" alt="Product Image" />
                                    </div>
                                    <div class="aq-product-actions">
                                        <button class="aq-product-action-btn" title="Quick Consultation"
                                            data-bs-toggle="modal" data-bs-target="#bulkOrderModal">
                                            <i class="fa-regular fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="aq-product-card-info">
                                    <span class="aq-product-card-brand-name">Oudhyana</span>
                                    <h4 class="aq-product-card-title"><a href="#">Gents Cotton Kurta</a>
                                    </h4>
                                    <p
                                        style="font-family: Inter, sans-serif; font-size:12px; color:#777; margin-bottom:12px;">
                                        Premium handcrafted chikankari apparel with delicate embroidery.</p>
                                    <div class="aq-product-card-price-group">
                                        <span class="aq-product-card-price">₹3,999</span>
                                        <span class="aq-product-card-old-price">₹4,999</span>
                                        <span class="aq-product-card-discount">(20% OFF)</span>
                                    </div>
                                    <div class="aq-product-card-sizes">
                                        <span class="aq-size-badge">S</span>
                                        <span class="aq-size-badge">M</span>
                                        <span class="aq-size-badge">L</span>
                                        <span class="aq-size-badge active">XL</span>
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
            </div>
        </section>

        <!-- 4. Luxurious Occasions Grid (10 Custom Occasions Cards) -->
        <!-- <section class="aq-occasions-showcase">
                    <div class="container">
                        <div class="row align-items-center mb-50">
                            <div class="col-12 text-center">
                                <div class="aq-creative-title-box">
                                    <span class="aq-creative-subtitle">Solution Oriented</span>
                                    <h2 class="aq-creative-title" style="color: #003108;">Occasions Designed For Impact</h2>
                                    <div class="aq-creative-title-line" style="background: #003108; margin: 15px auto 0;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="aq-occasions-grid">

                            <div class="aq-occasion-card">
                                <div class="aq-occasion-card-bg"
                                    style="background: url('assets/img/corporate/gallery_unstitched_suit.png') center/cover no-repeat;">
                                </div>
                                <div class="aq-occasion-overlay">
                                    <div class="aq-occasion-icon"><i class="fa-solid fa-gift"></i></div>
                                    <h4 class="aq-occasion-title">Diwali & Festive</h4>
                                </div>
                            </div>


                            <div class="aq-occasion-card">
                                <div class="aq-occasion-card-bg"
                                    style="background: url('assets/img/corporate/gallery_cotton_anarkali.png') center/cover no-repeat;">
                                </div>
                                <div class="aq-occasion-overlay">
                                    <div class="aq-occasion-icon"><i class="fa-solid fa-circle-user"></i></div>
                                    <h4 class="aq-occasion-title">Employee Welcome</h4>
                                </div>
                            </div>

                            <div class="aq-occasion-card">
                                <div class="aq-occasion-card-bg"
                                    style="background: url('assets/img/corporate/gallery_palazzo_set.png') center/cover no-repeat;">
                                </div>
                                <div class="aq-occasion-overlay">
                                    <div class="aq-occasion-icon"><i class="fa-solid fa-store"></i></div>
                                    <h4 class="aq-occasion-title">Trade Shows</h4>
                                </div>
                            </div>


                            <div class="aq-occasion-card">
                                <div class="aq-occasion-card-bg"
                                    style="background: url('assets/img/corporate/gallery_bridal_lehenga.png') center/cover no-repeat;">
                                </div>
                                <div class="aq-occasion-overlay">
                                    <div class="aq-occasion-icon"><i class="fa-solid fa-rocket"></i></div>
                                    <h4 class="aq-occasion-title">Product Launches</h4>
                                </div>
                            </div>

                            <div class="aq-occasion-card">
                                <div class="aq-occasion-card-bg"
                                    style="background: url('assets/img/corporate/ziba_chanderi_gown.png') center/cover no-repeat;">
                                </div>
                                <div class="aq-occasion-overlay">
                                    <div class="aq-occasion-icon"><i class="fa-solid fa-microphone"></i></div>
                                    <h4 class="aq-occasion-title">Conferences</h4>
                                </div>
                            </div>


                            <div class="aq-occasion-card">
                                <div class="aq-occasion-card-bg"
                                    style="background: url('assets/img/corporate/meher_silk_dupatta.png') center/cover no-repeat;">
                                </div>
                                <div class="aq-occasion-overlay">
                                    <div class="aq-occasion-icon"><i class="fa-solid fa-trophy"></i></div>
                                    <h4 class="aq-occasion-title">Annual Day</h4>
                                </div>
                            </div>


                            <div class="aq-occasion-card">
                                <div class="aq-occasion-card-bg"
                                    style="background: url('assets/img/corporate/nazneen_georgette_kurti.png') center/cover no-repeat;">
                                </div>
                                <div class="aq-occasion-overlay">
                                    <div class="aq-occasion-icon"><i class="fa-solid fa-gem"></i></div>
                                    <h4 class="aq-occasion-title">Leadership Curation</h4>
                                </div>
                            </div>


                            <div class="aq-occasion-card">
                                <div class="aq-occasion-card-bg"
                                    style="background: url('assets/img/corporate/gallery_gents_kurta.png') center/cover no-repeat;">
                                </div>
                                <div class="aq-occasion-overlay">
                                    <div class="aq-occasion-icon"><i class="fa-solid fa-award"></i></div>
                                    <h4 class="aq-occasion-title">Rewards & Recognition</h4>
                                </div>
                            </div>


                            <div class="aq-occasion-card">
                                <div class="aq-occasion-card-bg"
                                    style="background: url('assets/img/corporate/nafasat_warm_peach_chikankari.png') center/cover no-repeat;">
                                </div>
                                <div class="aq-occasion-overlay">
                                    <div class="aq-occasion-icon"><i class="fa-solid fa-handshake"></i></div>
                                    <h4 class="aq-occasion-title">Bespoke Clients</h4>
                                </div>
                            </div>


                            <div class="aq-occasion-card">
                                <div class="aq-occasion-card-bg"
                                    style="background: url('assets/img/corporate/hero_gift_box_1778667986732.webp') center/cover no-repeat;">
                                </div>
                                <div class="aq-occasion-overlay">
                                    <div class="aq-occasion-icon"><i class="fa-regular fa-calendar-days"></i></div>
                                    <h4 class="aq-occasion-title">New Year Hampers</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> -->



        <!-- 6. Bottom Sticky Category Link Area (For SEO/Footer Links) -->
        <section class="aq-footer-categories-section">
            <div class="container">
                <div class="aq-footer-cat-container">
                    <div class="aq-footer-cat-group">
                        <span class="aq-footer-cat-label">Shop by Recipient</span>
                        <div class="aq-footer-cat-links">
                            <a href="#" class="aq-footer-cat-link">Gifts for Employees</a>
                            <a href="#" class="aq-footer-cat-link">Gifts for Clients</a>
                            <a href="#" class="aq-footer-cat-link">Gifts for Executives</a>
                            <a href="#" class="aq-footer-cat-link">Gifts for Managers</a>
                            <a href="#" class="aq-footer-cat-link">Gifts for Vendors</a>
                            <a href="#" class="aq-footer-cat-link">Gifts for New Joinees</a>
                            <a href="#" class="aq-footer-cat-link">Gifts for Leadership</a>
                            <a href="#" class="aq-footer-cat-link">Corporate Bundles</a>
                            <a href="#" class="aq-footer-cat-link">Team Kits</a>
                        </div>
                    </div>
                    <div class="aq-footer-cat-group">
                        <span class="aq-footer-cat-label">Shop by Occasion</span>
                        <div class="aq-footer-cat-links">
                            <a href="#" class="aq-footer-cat-link">Employee Appreciation</a>
                            <a href="#" class="aq-footer-cat-link">Company Milestones</a>
                            <a href="#" class="aq-footer-cat-link">Product Launches</a>
                            <a href="#" class="aq-footer-cat-link">Conferences & Events</a>
                            <a href="#" class="aq-footer-cat-link">Retirement Gifts</a>
                            <a href="#" class="aq-footer-cat-link">Festive Corporate Hampers</a>
                            <a href="#" class="aq-footer-cat-link">Joining Kits</a>
                            <a href="#" class="aq-footer-cat-link">Reward & Recognition</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>


        document.addEventListener("DOMContentLoaded", function () {
            // Sticky scrolled header transition to green background on scroll
            window.addEventListener('scroll', () => {
                const header = document.querySelector('.header-sticky');
                if (header) {
                    if (window.scrollY > 80) {
                        header.classList.add('scrolled-green');
                    } else {
                        header.classList.remove('scrolled-green');
                    }
                }
            });

            // 1. Sidebar accordion collapsible toggle listener
            const filterHeaders = document.querySelectorAll(".aq-filter-header");
            filterHeaders.forEach(header => {
                header.addEventListener("click", function () {
                    this.classList.toggle("collapsed");
                    const content = this.nextElementSibling;
                    if (content) {
                        if (content.style.maxHeight) {
                            content.style.maxHeight = null;
                        } else {
                            content.style.maxHeight = content.scrollHeight + "px";
                        }
                    }
                });

                // Initialize default height
                const content = header.nextElementSibling;
                if (content) {
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });

            // 2. Custom Checkbox Interactive Styling Click Trigger
            const filterItems = document.querySelectorAll(".aq-filter-item");
            filterItems.forEach(item => {
                item.addEventListener("click", function () {
                    this.classList.toggle("active");
                    simulateFilterProducts();
                });
            });

            // 3. Price slider dynamic value display
            const priceSlider = document.getElementById("priceRange");
            const maxPriceLabel = document.getElementById("maxPriceLabel");
            if (priceSlider && maxPriceLabel) {
                priceSlider.addEventListener("input", function () {
                    maxPriceLabel.innerText = "Max: ₹" + parseInt(this.value).toLocaleString('en-IN');
                    simulateFilterProducts();
                });
            }

            // 4. Products Data Repository Mapping for Interactive Live Filtering Simulation
            const productsData = {
                "onboarding": [
                    {
                        "title": "Signature Onboarding Curation 1",
                        "desc": "High-quality onboarding item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_mukaish_dupatta.png",
                        "price": 2988,
                        "brand": "Bridal Edit",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/netflix_logo.webp"
                    },
                    {
                        "title": "Bespoke Onboarding Pack 2",
                        "desc": "High-quality onboarding item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_bridal_lehenga.png",
                        "price": 6198,
                        "brand": "Bridal Edit",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Vanguard Onboarding Curation 3",
                        "desc": "High-quality onboarding item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_cotton_anarkali.png",
                        "price": 6044,
                        "brand": "Unstitched Suits",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/netflix_logo.webp"
                    },
                    {
                        "title": "Corporate Onboarding Box 4",
                        "desc": "High-quality onboarding item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_2.webp",
                        "price": 6685,
                        "brand": "Unstitched Suits",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    },
                    {
                        "title": "Premium Onboarding Set 5",
                        "desc": "High-quality onboarding item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/nazneen_georgette_kurti.png",
                        "price": 658,
                        "brand": "New Arrival",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/netflix_logo.webp"
                    },
                    {
                        "title": "Vanguard Onboarding Set 6",
                        "desc": "High-quality onboarding item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/nazneen_georgette_kurti.png",
                        "price": 1819,
                        "brand": "Festive Wear",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Bespoke Onboarding Set 7",
                        "desc": "High-quality onboarding item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_1.webp",
                        "price": 8825,
                        "brand": "New Arrival",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Advanced Onboarding Bundle 8",
                        "desc": "High-quality onboarding item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_mukaish_dupatta.png",
                        "price": 6508,
                        "brand": "Unstitched Suits",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Classic Onboarding Box 9",
                        "desc": "High-quality onboarding item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_2.webp",
                        "price": 5152,
                        "brand": "New Arrival",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Advanced Onboarding Curation 10",
                        "desc": "High-quality onboarding item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/meher_silk_dupatta.png",
                        "price": 2934,
                        "brand": "Festive Wear",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    }
                ],
                "electronics": [
                    {
                        "title": "Bespoke Electronics Collection 1",
                        "desc": "High-quality electronics item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_mukaish_dupatta.png",
                        "price": 7962,
                        "brand": "Bridal Edit",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Elite Electronics Bundle 2",
                        "desc": "High-quality electronics item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_mukaish_dupatta.png",
                        "price": 2076,
                        "brand": "Bridal Edit",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Eco Electronics Kit 3",
                        "desc": "High-quality electronics item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_cotton_anarkali.png",
                        "price": 7784,
                        "brand": "Bridal Edit",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Smart Electronics Box 4",
                        "desc": "High-quality electronics item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_mukaish_dupatta.png",
                        "price": 7418,
                        "brand": "Bridal Edit",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/netflix_logo.webp"
                    },
                    {
                        "title": "Modern Electronics Set 5",
                        "desc": "High-quality electronics item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_1.webp",
                        "price": 4516,
                        "brand": "New Arrival",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    },
                    {
                        "title": "Smart Electronics Pack 6",
                        "desc": "High-quality electronics item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_2.webp",
                        "price": 6204,
                        "brand": "Bridal Edit",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Modern Electronics Curation 7",
                        "desc": "High-quality electronics item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_gents_kurta.png",
                        "price": 6201,
                        "brand": "New Arrival",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Essential Electronics Box 8",
                        "desc": "High-quality electronics item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_mukaish_dupatta.png",
                        "price": 6024,
                        "brand": "Bridal Edit",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Essential Electronics Kit 9",
                        "desc": "High-quality electronics item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/roohani_organza_saree.png",
                        "price": 2529,
                        "brand": "Bridal Edit",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Corporate Electronics Curation 10",
                        "desc": "High-quality electronics item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_1.webp",
                        "price": 4185,
                        "brand": "Festive Wear",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    }
                ],
                "mobile": [
                    {
                        "title": "Advanced Mobile Hamper 1",
                        "desc": "High-quality mobile item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_unstitched_suit.png",
                        "price": 2564,
                        "brand": "Unstitched Suits",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Premium Mobile Collection 2",
                        "desc": "High-quality mobile item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/ziba_chanderi_gown.png",
                        "price": 7121,
                        "brand": "Unstitched Suits",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Elite Mobile Pack 3",
                        "desc": "High-quality mobile item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/bag-2.webp",
                        "price": 1887,
                        "brand": "Festive Wear",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/netflix_logo.webp"
                    },
                    {
                        "title": "Heritage Mobile Kit 4",
                        "desc": "High-quality mobile item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/card_imges1.webp",
                        "price": 7473,
                        "brand": "Bridal Edit",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Advanced Mobile Bundle 5",
                        "desc": "High-quality mobile item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_palazzo_set.png",
                        "price": 7257,
                        "brand": "Bridal Edit",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Luxury Mobile Set 6",
                        "desc": "High-quality mobile item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/meher_silk_dupatta.png",
                        "price": 7028,
                        "brand": "Unstitched Suits",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Eco Mobile Assortment 7",
                        "desc": "High-quality mobile item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/roohani_organza_saree.png",
                        "price": 1321,
                        "brand": "Unstitched Suits",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/netflix_logo.webp"
                    },
                    {
                        "title": "Vanguard Mobile Set 8",
                        "desc": "High-quality mobile item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_gents_kurta.png",
                        "price": 4024,
                        "brand": "Festive Wear",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Corporate Mobile Edition 9",
                        "desc": "High-quality mobile item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/ziba_chanderi_gown.png",
                        "price": 7192,
                        "brand": "Festive Wear",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    },
                    {
                        "title": "Luxury Mobile Collection 10",
                        "desc": "High-quality mobile item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_mukaish_dupatta.png",
                        "price": 4546,
                        "brand": "Unstitched Suits",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    }
                ],
                "drinkware": [
                    {
                        "title": "Classic Organza Sarees Bundle 1",
                        "desc": "High-quality drinkware item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/meher_silk_dupatta.png",
                        "price": 3040,
                        "brand": "Bridal Edit",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/netflix_logo.webp"
                    },
                    {
                        "title": "Executive Organza Sarees Bundle 2",
                        "desc": "High-quality drinkware item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/bag-2.webp",
                        "price": 4711,
                        "brand": "Unstitched Suits",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Luxury Organza Sarees Box 3",
                        "desc": "High-quality drinkware item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/card_imges1.webp",
                        "price": 1477,
                        "brand": "Festive Wear",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Smart Organza Sarees Box 4",
                        "desc": "High-quality drinkware item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_mukaish_dupatta.png",
                        "price": 2014,
                        "brand": "New Arrival",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/netflix_logo.webp"
                    },
                    {
                        "title": "Luxury Organza Sarees Hamper 5",
                        "desc": "High-quality drinkware item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/meher_silk_dupatta.png",
                        "price": 7269,
                        "brand": "Unstitched Suits",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Vanguard Organza Sarees Assortment 6",
                        "desc": "High-quality drinkware item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_palazzo_set.png",
                        "price": 7608,
                        "brand": "Bridal Edit",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    },
                    {
                        "title": "Corporate Organza Sarees Collection 7",
                        "desc": "High-quality drinkware item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/meher_silk_dupatta.png",
                        "price": 5181,
                        "brand": "Festive Wear",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Signature Organza Sarees Set 8",
                        "desc": "High-quality drinkware item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_2.webp",
                        "price": 3946,
                        "brand": "Festive Wear",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Bespoke Organza Sarees Bundle 9",
                        "desc": "High-quality drinkware item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_2.webp",
                        "price": 3788,
                        "brand": "Bridal Edit",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Executive Organza Sarees Bundle 10",
                        "desc": "High-quality drinkware item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_gents_kurta.png",
                        "price": 1716,
                        "brand": "Unstitched Suits",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    }
                ],
                "stationery": [
                    {
                        "title": "Essential Stationery Collection 1",
                        "desc": "High-quality stationery item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/card_imges2.webp",
                        "price": 6107,
                        "brand": "Unstitched Suits",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Classic Stationery Curation 2",
                        "desc": "High-quality stationery item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/ziba_chanderi_gown.png",
                        "price": 4712,
                        "brand": "Festive Wear",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Executive Stationery Set 3",
                        "desc": "High-quality stationery item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/bag-1.webp",
                        "price": 1800,
                        "brand": "Unstitched Suits",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Modern Stationery Pack 4",
                        "desc": "High-quality stationery item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/card_imges1.webp",
                        "price": 5588,
                        "brand": "Festive Wear",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Luxury Stationery Kit 5",
                        "desc": "High-quality stationery item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_1.webp",
                        "price": 5501,
                        "brand": "Unstitched Suits",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Signature Stationery Kit 6",
                        "desc": "High-quality stationery item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_gents_kurta.png",
                        "price": 1229,
                        "brand": "Festive Wear",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    },
                    {
                        "title": "Signature Stationery Pack 7",
                        "desc": "High-quality stationery item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_bridal_lehenga.png",
                        "price": 7653,
                        "brand": "New Arrival",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    },
                    {
                        "title": "Elite Stationery Set 8",
                        "desc": "High-quality stationery item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/card_imges2.webp",
                        "price": 8672,
                        "brand": "New Arrival",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Classic Stationery Assortment 9",
                        "desc": "High-quality stationery item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/meher_silk_dupatta.png",
                        "price": 5991,
                        "brand": "Bridal Edit",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Smart Stationery Bundle 10",
                        "desc": "High-quality stationery item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/bag-2.webp",
                        "price": 4377,
                        "brand": "New Arrival",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    }
                ],
                "luxury": [
                    {
                        "title": "Smart Luxury Assortment 1",
                        "desc": "High-quality luxury item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_palazzo_set.png",
                        "price": 4607,
                        "brand": "Unstitched Suits",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Eco Luxury Edition 2",
                        "desc": "High-quality luxury item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/bag-1.webp",
                        "price": 1602,
                        "brand": "New Arrival",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    },
                    {
                        "title": "Classic Luxury Pack 3",
                        "desc": "High-quality luxury item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/nazneen_georgette_kurti.png",
                        "price": 1827,
                        "brand": "Festive Wear",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/netflix_logo.webp"
                    },
                    {
                        "title": "Signature Luxury Collection 4",
                        "desc": "High-quality luxury item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/bag-2.webp",
                        "price": 2433,
                        "brand": "Unstitched Suits",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Modern Luxury Hamper 5",
                        "desc": "High-quality luxury item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/card_imges2.webp",
                        "price": 4554,
                        "brand": "Unstitched Suits",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    },
                    {
                        "title": "Luxury Luxury Curation 6",
                        "desc": "High-quality luxury item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_2.webp",
                        "price": 5304,
                        "brand": "New Arrival",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Modern Luxury Curation 7",
                        "desc": "High-quality luxury item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_cotton_anarkali.png",
                        "price": 4247,
                        "brand": "Unstitched Suits",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Premium Luxury Set 8",
                        "desc": "High-quality luxury item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/ziba_chanderi_gown.png",
                        "price": 7182,
                        "brand": "Unstitched Suits",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Executive Luxury Set 9",
                        "desc": "High-quality luxury item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_gents_kurta.png",
                        "price": 8206,
                        "brand": "Unstitched Suits",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    },
                    {
                        "title": "Elite Luxury Curation 10",
                        "desc": "High-quality luxury item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_1.webp",
                        "price": 8450,
                        "brand": "Unstitched Suits",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    }
                ],
                "sustainable": [
                    {
                        "title": "Advanced Sustainable Set 1",
                        "desc": "High-quality sustainable item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/ziba_chanderi_gown.png",
                        "price": 5656,
                        "brand": "New Arrival",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Modern Sustainable Set 2",
                        "desc": "High-quality sustainable item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_2.webp",
                        "price": 4879,
                        "brand": "Bridal Edit",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Luxury Sustainable Bundle 3",
                        "desc": "High-quality sustainable item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/bag-2.webp",
                        "price": 4539,
                        "brand": "Festive Wear",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Modern Sustainable Pack 4",
                        "desc": "High-quality sustainable item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/bag-1.webp",
                        "price": 6074,
                        "brand": "Festive Wear",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Vanguard Sustainable Collection 5",
                        "desc": "High-quality sustainable item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/bag-1.webp",
                        "price": 8949,
                        "brand": "Unstitched Suits",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Bespoke Sustainable Edition 6",
                        "desc": "High-quality sustainable item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/meher_silk_dupatta.png",
                        "price": 7096,
                        "brand": "New Arrival",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/netflix_logo.webp"
                    },
                    {
                        "title": "Eco Sustainable Pack 7",
                        "desc": "High-quality sustainable item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_cotton_anarkali.png",
                        "price": 4969,
                        "brand": "Festive Wear",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Elite Sustainable Curation 8",
                        "desc": "High-quality sustainable item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_mukaish_dupatta.png",
                        "price": 5479,
                        "brand": "Bridal Edit",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Modern Sustainable Edition 9",
                        "desc": "High-quality sustainable item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_2.webp",
                        "price": 929,
                        "brand": "New Arrival",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Advanced Sustainable Pack 10",
                        "desc": "High-quality sustainable item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_1.webp",
                        "price": 1375,
                        "brand": "Festive Wear",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    }
                ],
                "travel": [
                    {
                        "title": "Modern Travel Assortment 1",
                        "desc": "High-quality travel item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_cotton_anarkali.png",
                        "price": 7441,
                        "brand": "Unstitched Suits",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Smart Travel Pack 2",
                        "desc": "High-quality travel item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_2.webp",
                        "price": 1284,
                        "brand": "Bridal Edit",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Eco Travel Edition 3",
                        "desc": "High-quality travel item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_bridal_lehenga.png",
                        "price": 8246,
                        "brand": "New Arrival",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Luxury Travel Assortment 4",
                        "desc": "High-quality travel item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/nazneen_georgette_kurti.png",
                        "price": 2910,
                        "brand": "Bridal Edit",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Bespoke Travel Bundle 5",
                        "desc": "High-quality travel item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/card_imges1.webp",
                        "price": 3288,
                        "brand": "Unstitched Suits",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Essential Travel Kit 6",
                        "desc": "High-quality travel item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/card_imges1.webp",
                        "price": 1363,
                        "brand": "New Arrival",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/netflix_logo.webp"
                    },
                    {
                        "title": "Advanced Travel Set 7",
                        "desc": "High-quality travel item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_cotton_anarkali.png",
                        "price": 8446,
                        "brand": "Festive Wear",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Vanguard Travel Kit 8",
                        "desc": "High-quality travel item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/meher_silk_dupatta.png",
                        "price": 3065,
                        "brand": "Festive Wear",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Modern Travel Box 9",
                        "desc": "High-quality travel item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/ziba_chanderi_gown.png",
                        "price": 6934,
                        "brand": "Bridal Edit",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Essential Travel Set 10",
                        "desc": "High-quality travel item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/nazneen_georgette_kurti.png",
                        "price": 2258,
                        "brand": "Festive Wear",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    }
                ],
                "promo": [
                    {
                        "title": "Elite Promo Box 1",
                        "desc": "High-quality promo item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_1.webp",
                        "price": 7721,
                        "brand": "New Arrival",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    },
                    {
                        "title": "Advanced Promo Assortment 2",
                        "desc": "High-quality promo item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/nazneen_georgette_kurti.png",
                        "price": 1589,
                        "brand": "Festive Wear",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Elite Promo Box 3",
                        "desc": "High-quality promo item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_1.webp",
                        "price": 7140,
                        "brand": "Festive Wear",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Corporate Promo Edition 4",
                        "desc": "High-quality promo item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/ziba_chanderi_gown.png",
                        "price": 3867,
                        "brand": "Festive Wear",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Eco Promo Hamper 5",
                        "desc": "High-quality promo item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_bridal_lehenga.png",
                        "price": 2112,
                        "brand": "Bridal Edit",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Essential Promo Box 6",
                        "desc": "High-quality promo item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/card_imges2.webp",
                        "price": 5914,
                        "brand": "Bridal Edit",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Luxury Promo Curation 7",
                        "desc": "High-quality promo item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_1.webp",
                        "price": 2387,
                        "brand": "Unstitched Suits",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Corporate Promo Edition 8",
                        "desc": "High-quality promo item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_gents_kurta.png",
                        "price": 7471,
                        "brand": "Bridal Edit",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Eco Promo Collection 9",
                        "desc": "High-quality promo item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/bag-2.webp",
                        "price": 4892,
                        "brand": "Bridal Edit",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/netflix_logo.webp"
                    },
                    {
                        "title": "Luxury Promo Kit 10",
                        "desc": "High-quality promo item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/meher_silk_dupatta.png",
                        "price": 6002,
                        "brand": "Festive Wear",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    }
                ],
                "wellness": [
                    {
                        "title": "Luxury Wellness Edition 1",
                        "desc": "High-quality wellness item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_1.webp",
                        "price": 5453,
                        "brand": "New Arrival",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    },
                    {
                        "title": "Signature Wellness Curation 2",
                        "desc": "High-quality wellness item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_bridal_lehenga.png",
                        "price": 8924,
                        "brand": "Festive Wear",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Classic Wellness Box 3",
                        "desc": "High-quality wellness item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/bag-2.webp",
                        "price": 8464,
                        "brand": "Festive Wear",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Bespoke Wellness Edition 4",
                        "desc": "High-quality wellness item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/ziba_chanderi_gown.png",
                        "price": 7429,
                        "brand": "Festive Wear",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    },
                    {
                        "title": "Essential Wellness Set 5",
                        "desc": "High-quality wellness item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_palazzo_set.png",
                        "price": 6402,
                        "brand": "Unstitched Suits",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Essential Wellness Collection 6",
                        "desc": "High-quality wellness item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_unstitched_suit.png",
                        "price": 6611,
                        "brand": "Bridal Edit",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Classic Wellness Kit 7",
                        "desc": "High-quality wellness item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/card_imges1.webp",
                        "price": 4757,
                        "brand": "Unstitched Suits",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Bespoke Wellness Set 8",
                        "desc": "High-quality wellness item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_cotton_anarkali.png",
                        "price": 1778,
                        "brand": "Bridal Edit",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Heritage Wellness Bundle 9",
                        "desc": "High-quality wellness item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_2.webp",
                        "price": 2926,
                        "brand": "Festive Wear",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    },
                    {
                        "title": "Signature Wellness Curation 10",
                        "desc": "High-quality wellness item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/card_imges2.webp",
                        "price": 7392,
                        "brand": "New Arrival",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    }
                ],
                "decor": [
                    {
                        "title": "Advanced Decor Bundle 1",
                        "desc": "High-quality decor item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_2.webp",
                        "price": 1639,
                        "brand": "Bridal Edit",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Corporate Decor Kit 2",
                        "desc": "High-quality decor item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/bag-1.webp",
                        "price": 5136,
                        "brand": "Unstitched Suits",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Essential Decor Edition 3",
                        "desc": "High-quality decor item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/card_imges2.webp",
                        "price": 8595,
                        "brand": "Bridal Edit",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/google_logo.webp"
                    },
                    {
                        "title": "Eco Decor Collection 4",
                        "desc": "High-quality decor item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_gents_kurta.png",
                        "price": 4075,
                        "brand": "Unstitched Suits",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Modern Decor Box 5",
                        "desc": "High-quality decor item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_bridal_lehenga.png",
                        "price": 6792,
                        "brand": "Unstitched Suits",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/netflix_logo.webp"
                    },
                    {
                        "title": "Vanguard Decor Pack 6",
                        "desc": "High-quality decor item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_gents_kurta.png",
                        "price": 8947,
                        "brand": "New Arrival",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Elite Decor Edition 7",
                        "desc": "High-quality decor item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_cotton_anarkali.png",
                        "price": 1669,
                        "brand": "Unstitched Suits",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    },
                    {
                        "title": "Elite Decor Bundle 8",
                        "desc": "High-quality decor item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/unsplash_gift_2.webp",
                        "price": 1116,
                        "brand": "Festive Wear",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/netflix_logo.webp"
                    },
                    {
                        "title": "Signature Decor Curation 9",
                        "desc": "High-quality decor item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_gents_kurta.png",
                        "price": 3421,
                        "brand": "Bridal Edit",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/netflix_logo.webp"
                    },
                    {
                        "title": "Heritage Decor Edition 10",
                        "desc": "High-quality decor item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/meher_silk_dupatta.png",
                        "price": 1593,
                        "brand": "Festive Wear",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    }
                ],
                "rewards": [
                    {
                        "title": "Signature Rewards Assortment 1",
                        "desc": "High-quality rewards item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/card_imges2.webp",
                        "price": 3335,
                        "brand": "New Arrival",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/netflix_logo.webp"
                    },
                    {
                        "title": "Luxury Rewards Pack 2",
                        "desc": "High-quality rewards item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/meher_silk_dupatta.png",
                        "price": 6575,
                        "brand": "Festive Wear",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/netflix_logo.webp"
                    },
                    {
                        "title": "Corporate Rewards Edition 3",
                        "desc": "High-quality rewards item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_unstitched_suit.png",
                        "price": 4046,
                        "brand": "New Arrival",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/netflix_logo.webp"
                    },
                    {
                        "title": "Corporate Rewards Box 4",
                        "desc": "High-quality rewards item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_bridal_lehenga.png",
                        "price": 7869,
                        "brand": "Unstitched Suits",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    },
                    {
                        "title": "Corporate Rewards Hamper 5",
                        "desc": "High-quality rewards item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_mukaish_dupatta.png",
                        "price": 7182,
                        "brand": "Festive Wear",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    },
                    {
                        "title": "Essential Rewards Pack 6",
                        "desc": "High-quality rewards item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_mukaish_dupatta.png",
                        "price": 1956,
                        "brand": "New Arrival",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Corporate Rewards Edition 7",
                        "desc": "High-quality rewards item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_unstitched_suit.png",
                        "price": 2794,
                        "brand": "Bridal Edit",
                        "badge": "New",
                        "badgeClass": "new",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    },
                    {
                        "title": "Classic Rewards Curation 8",
                        "desc": "High-quality rewards item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/gallery_gents_kurta.png",
                        "price": 8802,
                        "brand": "Unstitched Suits",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/ibm_logo.webp"
                    },
                    {
                        "title": "Heritage Rewards Assortment 9",
                        "desc": "High-quality rewards item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/meher_silk_dupatta.png",
                        "price": 4676,
                        "brand": "Festive Wear",
                        "badge": "Best Seller",
                        "badgeClass": "bestseller",
                        "brandLogo": "assets/img/corporate/microsoft_logo.webp"
                    },
                    {
                        "title": "Bespoke Rewards Bundle 10",
                        "desc": "High-quality rewards item perfectly suited for corporate gifting. Includes premium packaging.",
                        "img": "assets/img/corporate/meher_silk_dupatta.png",
                        "price": 1441,
                        "brand": "Unstitched Suits",
                        "badge": "",
                        "badgeClass": "",
                        "brandLogo": "assets/img/corporate/apple_logo.webp"
                    }
                ]
            };

            let activeCategory = "onboarding";

            // Click listener for Category grid cards
            const categoryCards = document.querySelectorAll(".aq-category-card");
            const activeCategoryTitle = document.getElementById("aq-active-category-title");

            categoryCards.forEach(card => {
                card.addEventListener("click", function () {
                    // Update active styling class
                    categoryCards.forEach(c => c.classList.remove("active"));
                    this.classList.add("active");

                    activeCategory = this.getAttribute("data-category-filter");
                    const catName = this.querySelector(".aq-category-card-title").innerText;
                    if (activeCategoryTitle) {
                        activeCategoryTitle.innerText = catName + " Collection";
                    }

                    // Render dynamic content
                    renderProducts(activeCategory);

                    // Smooth scroll down to interactive catalog section
                    const section = document.getElementById("aq-catalog-section");
                    if (section) {
                        const topOffset = section.getBoundingClientRect().top + window.pageYOffset - 120;
                        window.scrollTo({
                            top: topOffset,
                            behavior: "smooth"
                        });
                    }
                });
            });

            // Function to render products
            function renderProducts(catKey) {
                const container = document.getElementById("aq-product-catalog-grid");
                const countBadge = document.getElementById("aq-product-results-count");
                if (!container) return;

                const items = productsData[catKey] || [];
                container.innerHTML = "";

                if (items.length === 0) {
                    container.innerHTML = `
                            <div class="col-12 text-center py-5">
                                <i class="fa-regular fa-folder-open mb-3" style="font-size:48px; color:#ccc;"></i>
                                <h5 style="font-family:Outfit,sans-serif; color:#666;">No Products Available</h5>
                                <p style="font-family:Inter,sans-serif; color:#888;">Select another category from the list above.</p>
                            </div>
                        `;
                    if (countBadge) countBadge.innerText = "Showing 0 Products";
                    return;
                }

                // Get filter query states
                const priceLimit = parseInt(priceSlider ? priceSlider.value : 10000);
                const searchInputEl = document.getElementById("aq-sidebar-search-input");
                const searchQuery = searchInputEl ? searchInputEl.value.toLowerCase() : "";

                // Get active brands
                const activeBrandEls = document.querySelectorAll('.aq-filter-item.active[data-filter-type="brand"]');
                const activeBrands = Array.from(activeBrandEls).map(item => {
                    const label = item.querySelector('.aq-filter-label');
                    return label ? label.innerText.trim().toLowerCase() : "";
                }).filter(b => b !== "");

                const filtered = items.filter(p => {
                    if (p.price > priceLimit) return false;
                    if (searchQuery && !p.title.toLowerCase().includes(searchQuery) && !p.desc.toLowerCase().includes(searchQuery)) return false;
                    if (activeBrands.length > 0 && !activeBrands.includes(p.brand.toLowerCase())) return false;
                    return true;
                });

                if (filtered.length === 0) {
                    container.innerHTML = `
                            <div class="col-12 text-center py-5">
                                <i class="fa-solid fa-filter-circle-xmark mb-3" style="font-size:48px; color:#ccc;"></i>
                                <h5 style="font-family:Outfit,sans-serif; color:#666;">No Products Match Filters</h5>
                                <p style="font-family:Inter,sans-serif; color:#888;">Try clearing active filters or adjusting the price slider.</p>
                            </div>
                        `;
                    if (countBadge) countBadge.innerText = "Showing 0 Products";
                    return;
                }

                filtered.forEach(p => {
                    const badgeHtml = p.badge ? `<span class="aq-product-badge ${p.badgeClass}">${p.badge}</span>` : "";
                    const cardHtml = `
                            <div class="aq-product-card" data-category="${catKey}" data-price="${p.price}">
                                <div class="aq-product-card-top">
                                    <div class="aq-product-media-wrapper">
                                        <img src="${p.img}" class="aq-product-card-img primary-img" alt="${p.title}" />
                                        <img src="assets/img/corporate/gallery_cotton_anarkali.png" class="secondary-img" alt="Second Image" />
                                        <img src="assets/img/corporate/meher_silk_dupatta.png" class="tertiary-img" alt="Third Image" />
                                        <video src="assets/img/corporate/reals_video.mp4" class="aq-product-card-video" muted loop playsinline></video>
                                        <div class="aq-product-media-indicator">
                                            <span class="aq-media-dot active"></span>
                                            <span class="aq-media-dot"></span>
                                            <span class="aq-media-dot"></span>
                                            <span class="aq-media-dot"></span>
                                        </div>
                                    </div>
                                    <div class="aq-product-badges">
                                        ${badgeHtml}
                                    </div>
                                    <div class="aq-product-brand-badge">
                                        <img src="${p.brandLogo}" alt="${p.brand}" />
                                    </div>
                                    <div class="aq-product-actions">
                                        <button class="aq-product-action-btn aq-consultation-trigger" title="Quick Consultation">
                                            <i class="fa-regular fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="aq-product-card-info">
                                    <span class="aq-product-card-brand-name">Oudhyana</span>
                                    <h4 class="aq-product-card-title"><a href="#">Mukaish Work Dupatta</a>
    </h4>
                                    <p style="font-family: Inter, sans-serif; font-size:12px; color:#777; margin-bottom:12px;">Premium handcrafted chikankari apparel with delicate embroidery.</p>
                                    <div class="aq-product-card-price-group">
                                        <span class="aq-product-card-price">₹${p.price.toLocaleString('en-IN')}</span>
                                        <span class="aq-product-card-old-price">₹${Math.round(p.price * 1.25).toLocaleString('en-IN')}</span>
                                        <span class="aq-product-card-discount">(20% OFF)</span>
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
                        `;
                    container.innerHTML += cardHtml;
                });

                if (countBadge) {
                    countBadge.innerText = `Showing ${filtered.length} Product${filtered.length > 1 ? 's' : ''}`;
                }

                // Re-bind click event to new enquiry buttons to trigger Bespoke Consultation Drawer
                const enquiryButtons = container.querySelectorAll(".aq-consultation-trigger, .aq-product-card-cta");
                enquiryButtons.forEach(btn => {
                    btn.addEventListener("click", function (e) {
                        e.preventDefault();
                        openEnquiryDrawer();
                    });
                });
            }

            // Simulate Filtering
            function simulateFilterProducts() {
                renderProducts(activeCategory);
            }

            // Search filtering listener
            const searchInput = document.getElementById("aq-sidebar-search-input");
            if (searchInput) {
                searchInput.addEventListener("input", function () {
                    simulateFilterProducts();
                });
            }

            // Reset filters logic
            const clearBtn = document.getElementById("aq-clear-filters-btn");
            if (clearBtn) {
                clearBtn.addEventListener("click", function () {
                    // Reset price range slider
                    if (priceSlider) {
                        priceSlider.value = 10000;
                        maxPriceLabel.innerText = "Max: ₹10,000";
                    }
                    // Reset search bar
                    if (searchInput) {
                        searchInput.value = "";
                    }
                    // Reset checked items list
                    filterItems.forEach(item => item.classList.remove("active"));

                    renderProducts(activeCategory);
                });
            }


            // Parse URL parameters for categories deep link
            const urlParams = new URLSearchParams(window.location.search);
            const catParam = urlParams.get('category');
            if (catParam) {
                const targetCard = document.querySelector(`.aq-category-card[data-category-filter="${catParam}"]`);
                if (targetCard) {
                    targetCard.click();
                }
            } else {
                // Initialize default view
                renderProducts(activeCategory);
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            function initProductHoverSliders() {
                document.querySelectorAll('.aq-product-card').forEach(card => {
                    const mediaItems = Array.from(card.querySelectorAll('.aq-product-media-wrapper > img, .aq-product-media-wrapper > video'));
                    const dots = card.querySelectorAll('.aq-media-dot');
                    let hoverInterval;
                    let currentIndex = 0;

                    card.addEventListener('mouseenter', () => {
                        if (mediaItems.length <= 1) return;

                        // Immediately show second image on hover
                        currentIndex = 1;
                        updateMedia();

                        // Then cycle every 2 seconds
                        hoverInterval = setInterval(() => {
                            currentIndex = (currentIndex + 1) % mediaItems.length;
                            updateMedia();
                        }, 2000);
                    });

                    card.addEventListener('mouseleave', () => {
                        clearInterval(hoverInterval);
                        currentIndex = 0;
                        updateMedia();
                    });

                    function updateMedia() {
                        mediaItems.forEach((item, index) => {
                            item.style.opacity = index === currentIndex ? '1' : '0';

                            // Play/Pause video logic
                            if (item.tagName === 'VIDEO') {
                                if (index === currentIndex) {
                                    item.play().catch(e => console.log('Autoplay prevented'));
                                } else {
                                    item.pause();
                                }
                            }
                        });

                        dots.forEach((dot, index) => {
                            if (index === currentIndex) {
                                dot.classList.add('active');
                            } else {
                                dot.classList.remove('active');
                            }
                        });
                    }
                });
            }

            initProductHoverSliders();

            // Re-init if new products are loaded (optional, for dynamic rendering)
            const grid = document.getElementById('aq-product-catalog-grid');
            if (grid) {
                const observer = new MutationObserver(initProductHoverSliders);
                observer.observe(grid, { childList: true });
            }
            // Close filter sidebar when body overlay is clicked
            const bodyOverlay = document.querySelector('.body-overlay');
            const filterSidebar = document.querySelector('.aq-filter-sidebar');
            if (bodyOverlay && filterSidebar) {
                bodyOverlay.addEventListener('click', function () {
                    filterSidebar.classList.remove('active');
                    bodyOverlay.classList.remove('opened');
                    document.body.style.overflow = '';
                });
            }
        });
    </script>

@endsection