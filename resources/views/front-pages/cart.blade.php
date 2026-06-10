@extends('layouts.app')
@section('content')

    <main class="aq-cart-page">

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
                <h1 class="aq-catpage-title">Cart </h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="index.html">Home</a>
                    <span>/</span>
                    <span>Cart</span>
                </div>
            </div>
        </section>

        <!-- Breadcrumb Bar -->




        <section class="aq-cart-wrapper" id="aqCartMainSection">
            <div class="container">
                <div class="row">
                    <!-- Left: Your Cart -->
                    <div class="col-xl-8 col-lg-8 col-12 mb-40">
                        <h1 class="aq-cart-title">Your Cart</h1>
                        <div class="aq-cart-items-list" id="aqCartItemsList">

                            <!-- Cart Row 1: Bespoke Welcome Kit -->
                            <div class="aq-cart-item-row" data-id="item-welcome-kit">
                                <div class="aq-cart-item-thumb">
                                    <img src="assets/img/corporate/p-01.jpg" alt="Welcome Kit" />
                                </div>
                                <div class="aq-cart-item-details">
                                    <span class="aq-cart-item-category">Women's Wear</span>
                                    <h4 class="aq-cart-item-title"><a href="product_details.html">Roohani Organza
                                            Saree</a></h4>
                                    <div class="aq-cart-customization-badges">
                                        <span class="aq-cart-badge engrave"><i class="fa-solid fa-pen-nib mr-5"></i>
                                            Handcrafted Embroidery</span>
                                        <span class="aq-cart-badge"><i class="fa-solid fa-sparkles mr-5"></i> Premium
                                            Silk Fabric</span>
                                    </div>
                                </div>
                                <div class="aq-cart-item-price-qty">
                                    <!-- Qty Selector -->
                                    <div class="aq-cart-qty-selector">
                                        <button class="aq-cart-qty-btn qty-minus" aria-label="Decrease quantity"><i
                                                class="fa-solid fa-minus"></i></button>
                                        <input type="text" class="aq-cart-qty-input" value="100" />
                                        <button class="aq-cart-qty-btn qty-plus" aria-label="Increase quantity"><i
                                                class="fa-solid fa-plus"></i></button>
                                    </div>
                                    <!-- Price & Actions -->
                                    <div class="aq-cart-price-block d-flex flex-column align-items-start align-items-md-end text-start text-md-end"
                                        style="gap: 4px;">
                                        <span class="aq-cart-discount-tag"
                                            style="background: #eef6ee; color: #2e8b57; padding: 3px 8px; border-radius: 4px; font-size: 11px;">24%
                                            OFF</span>
                                        <div class="aq-cart-mrp-row" style="display: flex; align-items: center; gap: 10px;">
                                            <span class="aq-cart-mrp"
                                                style="font-size: 13px; color: #999; text-decoration: line-through;">₹1,950</span>
                                            <button class="aq-cart-item-remove" aria-label="Remove item"
                                                style="color: #d9534f; border: none; background: transparent; padding: 0;"><i
                                                    class="fa-regular fa-trash-can"></i></button>
                                        </div>
                                        <span class="aq-cart-price" data-base-price="1482"
                                            style="font-size: 20px; font-weight: 700; color: #C98F9D;">₹1,48,200</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Cart Row 2: Elite Tech Suite -->
                            <div class="aq-cart-item-row" data-id="item-tech-suite">
                                <div class="aq-cart-item-thumb">
                                    <img src="assets/img/corporate/p-02.jpg" alt="Tech Gadgets" />
                                </div>
                                <div class="aq-cart-item-details">
                                    <span class="aq-cart-item-category">Women's Wear</span>
                                    <h4 class="aq-cart-item-title"><a href="product_details.html">Meher Silk Dupatta</a>
                                    </h4>
                                    <div class="aq-cart-customization-badges">
                                        <span class="aq-cart-badge engrave"><i class="fa-solid fa-signature mr-5"></i>
                                            Intricate Zari Work</span>
                                        <span class="aq-cart-badge"><i class="fa-solid fa-battery-three-quarters mr-5"></i>
                                            Vibrant
                                            Color</span>
                                    </div>
                                </div>
                                <div class="aq-cart-item-price-qty">
                                    <!-- Qty Selector -->
                                    <div class="aq-cart-qty-selector">
                                        <button class="aq-cart-qty-btn qty-minus" aria-label="Decrease quantity"><i
                                                class="fa-solid fa-minus"></i></button>
                                        <input type="text" class="aq-cart-qty-input" value="50" />
                                        <button class="aq-cart-qty-btn qty-plus" aria-label="Increase quantity"><i
                                                class="fa-solid fa-plus"></i></button>
                                    </div>
                                    <!-- Price & Actions -->
                                    <div class="aq-cart-price-block d-flex flex-column align-items-start align-items-md-end text-start text-md-end"
                                        style="gap: 4px;">
                                        <span class="aq-cart-discount-tag"
                                            style="background: #eef6ee; color: #2e8b57; padding: 3px 8px; border-radius: 4px; font-size: 11px;">15%
                                            OFF</span>
                                        <div class="aq-cart-mrp-row" style="display: flex; align-items: center; gap: 10px;">
                                            <span class="aq-cart-mrp"
                                                style="font-size: 13px; color: #999; text-decoration: line-through;">₹3,500</span>
                                            <button class="aq-cart-item-remove" aria-label="Remove item"
                                                style="color: #d9534f; border: none; background: transparent; padding: 0;"><i
                                                    class="fa-regular fa-trash-can"></i></button>
                                        </div>
                                        <span class="aq-cart-price" data-base-price="2975"
                                            style="font-size: 20px; font-weight: 700; color: #C98F9D;">₹1,48,750</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Right: Order Summary sticky card -->
                    <div class="col-xl-4 col-lg-4 col-12">
                        <div class="aq-summary-card">
                            <h3 class="aq-summary-title">Order Summary</h3>

                            <div class="aq-summary-row">
                                <span>Cart Subtotal</span>
                                <span id="summarySubtotal">₹2,96,950</span>
                            </div>
                            <div class="aq-summary-row">
                                <span>Shipping & Handling</span>
                                <span class="text-success font-weight-bold">Free</span>
                            </div>
                            <div class="aq-summary-row">
                                <span>GST (Taxes)</span>
                                <span id="summaryGST">Included</span>
                            </div>

                            <div class="aq-summary-row total-row">
                                <span>Total Amount</span>
                                <span id="summaryTotal">₹2,96,950</span>
                            </div>

                            <button type="button" class="aq-btn-final-quote"
                                style="background: #C98F9D; border-color: #C98F9D;" data-bs-toggle="modal"
                                data-bs-target="#finalQuoteModal">
                                <span>Proceed to Checkout</span>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>

                            <div class="aq-summary-perks">
                                <div class="aq-summary-perk-item">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>Secure Checkout with SSL Encryption</span>
                                </div>
                                <div class="aq-summary-perk-item">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>Free Shipping on Pre-paid Orders</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


    </main>

      <!-- Final Quote Modal -->
    <div class="modal fade aq-premium-modal final-quote-modal" id="finalQuoteModal" tabindex="-1"
        aria-labelledby="finalQuoteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal"
                    aria-label="Close"></button>

                <div class="row g-0">
                    <!-- Left: Creative Visual Side -->
                    <div class="col-lg-5 d-none d-lg-block aq-modal-left-panel">
                        <div>
                            <div class="mb-5">
                                <i class="fa-solid fa-gem aq-modal-icon"></i>
                            </div>
                            <h3 class="font-family-heading mb-3 aq-modal-title">
                                Finalize Your <br><span>Curated Experience</span>
                            </h3>
                            <p class="aq-modal-desc">
                                Provide your details to receive the final customized quotation and digital proofs for
                                your selected luxury gifts.
                            </p>
                        </div>
                        <div class="aq-modal-left-features">
                            <div class="aq-modal-feature-item">
                                <i class="fa-solid fa-check text-success mr-10"></i>
                                <span>Dedicated Corporate Manager</span>
                            </div>
                            <div class="aq-modal-feature-item">
                                <i class="fa-solid fa-check text-success mr-10"></i>
                                <span>Free Mockups & Virtual Proofs</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Form Side -->
                    <div class="col-lg-7 col-12 aq-modal-right-panel">
                        <div class="aq-login-top mb-30">
                            <h3 class="font-family-heading aq-modal-title">Submit Enquiry</h3>
                            <p class="aq-modal-desc">We'll get back to you within 2 business hours.</p>
                        </div>

                        <form id="aqFinalQuoteForm" onsubmit="handleFinalQuoteSubmit(event)">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="aq-form-label">Business Name *</label>
                                    <div class="position-relative">
                                        <i class="fa-solid fa-building position-absolute input-icon"></i>
                                        <input type="text" class="form-control with-icon" required
                                            placeholder="XYZ Corp" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="aq-form-label">Owner Name *</label>
                                    <div class="position-relative">
                                        <i class="fa-regular fa-user position-absolute input-icon"></i>
                                        <input type="text" class="form-control with-icon" required
                                            placeholder="Rajesh Kumar" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="aq-form-label">Email *</label>
                                    <div class="position-relative">
                                        <i class="fa-regular fa-envelope position-absolute input-icon"></i>
                                        <input type="email" class="form-control with-icon" required
                                            placeholder="rajesh@company.com" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="aq-form-label">Mobile *</label>
                                    <div class="position-relative">
                                        <i class="fa-solid fa-phone position-absolute input-icon"></i>
                                        <input type="tel" class="form-control with-icon" required
                                            placeholder="+91 0000 000 000" />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="aq-form-label">Full Address *</label>
                                <textarea class="form-control" required
                                    placeholder="Enter building, street, and area details" rows="2"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="aq-form-label">State *</label>
                                    <select class="form-select" required>
                                        <option value="" disabled selected>Select State</option>
                                        <option value="Delhi">Delhi</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                        <option value="Karnataka">Karnataka</option>
                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                        <option value="Gujarat">Gujarat</option>
                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="aq-form-label">City *</label>
                                    <select class="form-select" required>
                                        <option value="" disabled selected>Select City</option>
                                        <option value="New Delhi">New Delhi</option>
                                        <option value="Mumbai">Mumbai</option>
                                        <option value="Bangalore">Bangalore</option>
                                        <option value="Chennai">Chennai</option>
                                        <option value="Ahmedabad">Ahmedabad</option>
                                        <option value="Noida">Noida</option>
                                        <option value="Gurgaon">Gurgaon</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="aq-btn-submit">
                                <span>Submit Enquiry</span>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

