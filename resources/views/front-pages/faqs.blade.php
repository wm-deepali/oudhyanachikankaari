@extends('layouts.app')
@section('content')
 
  <main class="aq-faq-page">
  
        <!-- FAQ Hero Section -->
        <section class="aq-catpage-hero aq-apparel-hero">
            <div class="aq-hero-glow"></div>
            <div class="aq-floating-gift-box aq-floating-shape-1">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
            </div>
            <div class="aq-floating-gift-box aq-floating-shape-2">
                <i class="fa-regular fa-star"></i>
            </div>
            <div class="aq-catpage-hero-content">
                <h1 class="aq-catpage-title">Frequently Asked Questions</h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="index.html">Home</a>
                    <span>/</span>
                    <span>FAQ</span>
                </div>
            </div>
        </section>

        <div class="aq-faq-parent-wrapper pt-120 pb-120">
            <div class="container">

                <div class="row justify-content-center text-center mb-50">
                    <div class="col-lg-8">
                        <span class="aq-section-title-sm">Client Services</span>
                        <h2 class="aq-section-title force-center-line text-center mt-10">How Can We Help You?</h2>
                        <p class="aq-section-desc mt-15">Find answers to the most common questions about our Chikankari collections, shipping, returns, and bespoke orders.</p>
                    </div>
                </div>
                <div class="aq-faq-content-wrapper">

                    <div class="row justify-content-center">
                        <div class="col-lg-10">

                            <!-- FAQ Category 1 -->
                            <div class="faq-category mb-50">
                                <h3 class="mb-30"
                                    style="color: #C98F9D; font-family: 'Outfit', sans-serif; font-weight: 500; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                                    Product & Care</h3>

                                <div class="accordion accordion-luxury" id="faqProductCare">
                                    <div class="accordion-item border-0 mb-4 rounded-4 shadow-sm overflow-hidden"
                                        style="transition: all 0.3s ease;">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button
                                                class="accordion-button fw-md-bold fw-semibold  fs-5 text-dark collapsed"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                aria-expanded="false" aria-controls="collapseOne"
                                                style="background-color: #fff; padding: 25px 30px; box-shadow: none;">
                                                <i class="fa-solid fa-circle-question me-3" style="color: #C98F9D;"></i>
                                                Are all your products authentically handcrafted?
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse"
                                            aria-labelledby="headingOne" data-bs-parent="#faqProductCare">
                                            <div class="accordion-body bg-white lh-lg fs-6"
                                                style="padding: 0 30px 30px 65px; border-top: 1px solid rgba(0,0,0,0.03); color: #666;">
                                                Yes, absolutely. We pride ourselves on offering authentic Chikankari.
                                                Every single piece is meticulously hand-embroidered by skilled artisans
                                                in Lucknow, ensuring genuine craftsmanship and superior quality.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item border-0 mb-4 rounded-4 shadow-sm overflow-hidden"
                                        style="transition: all 0.3s ease;">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button
                                                class="accordion-button fw-md-bold fw-semibold  fs-5 text-dark collapsed"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo"
                                                style="background-color: #fff; padding: 25px 30px; box-shadow: none;">
                                                <i class="fa-solid fa-circle-question me-3" style="color: #C98F9D;"></i>
                                                How should I wash and care for my Chikankari apparel?
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo" data-bs-parent="#faqProductCare">
                                            <div class="accordion-body bg-white lh-lg fs-6"
                                                style="padding: 0 30px 30px 65px; border-top: 1px solid rgba(0,0,0,0.03); color: #666;">
                                                Due to the delicate nature of hand embroidery, we highly recommend dry
                                                cleaning for all our Silk, Organza, Georgette, and Chanderi garments.
                                                For cotton pieces, a gentle hand wash in cold water with mild detergent
                                                is advised. Never wring the fabric or dry it in direct sunlight.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Category 2 -->
                            <div class="faq-category mb-50">
                                <h3 class="mb-30"
                                    style="color: #C98F9D; font-family: 'Outfit', sans-serif; font-weight: 500; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                                    Orders & Shipping</h3>

                                <div class="accordion accordion-luxury" id="faqShipping">
                                    <div class="accordion-item border-0 mb-4 rounded-4 shadow-sm overflow-hidden"
                                        style="transition: all 0.3s ease;">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button
                                                class="accordion-button fw-md-bold fw-semibold  fs-5 text-dark collapsed"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree"
                                                style="background-color: #fff; padding: 25px 30px; box-shadow: none;">
                                                <i class="fa-solid fa-circle-question me-3" style="color: #C98F9D;"></i>
                                                Do you ship internationally?
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#faqShipping">
                                            <div class="accordion-body bg-white lh-lg fs-6"
                                                style="padding: 0 30px 30px 65px; border-top: 1px solid rgba(0,0,0,0.03); color: #666;">
                                                Yes, we ship our luxury collections worldwide. International shipping
                                                charges are calculated at checkout based on the destination and parcel
                                                weight. Please note that customs duties (if applicable in your country)
                                                are the responsibility of the customer.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item border-0 mb-4 rounded-4 shadow-sm overflow-hidden"
                                        style="transition: all 0.3s ease;">
                                        <h2 class="accordion-header" id="headingFour">
                                            <button
                                                class="accordion-button fw-md-bold fw-semibold  fs-5 text-dark collapsed"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                aria-expanded="false" aria-controls="collapseFour"
                                                style="background-color: #fff; padding: 25px 30px; box-shadow: none;">
                                                <i class="fa-solid fa-circle-question me-3" style="color: #C98F9D;"></i>
                                                How long will it take to receive my order?
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse"
                                            aria-labelledby="headingFour" data-bs-parent="#faqShipping">
                                            <div class="accordion-body bg-white lh-lg fs-6"
                                                style="padding: 0 30px 30px 65px; border-top: 1px solid rgba(0,0,0,0.03); color: #666;">
                                                Ready-to-ship items are typically dispatched within 48 hours and arrive
                                                within 4-7 business days domestically. Custom or bespoke orders may take
                                                2-4 weeks to complete due to the intricate hand embroidery process.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Category 3 -->
                            <div class="faq-category">
                                <h3 class="mb-30"
                                    style="color: #C98F9D; font-family: 'Outfit', sans-serif; font-weight: 500; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                                    Bespoke & Sizing</h3>

                                <div class="accordion accordion-luxury" id="faqBespoke">
                                    <div class="accordion-item border-0 mb-4 rounded-4 shadow-sm overflow-hidden"
                                        style="transition: all 0.3s ease;">
                                        <h2 class="accordion-header" id="headingFive">
                                            <button
                                                class="accordion-button fw-md-bold fw-semibold  fs-5 text-dark collapsed"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                aria-expanded="false" aria-controls="collapseFive"
                                                style="background-color: #fff; padding: 25px 30px; box-shadow: none;">
                                                <i class="fa-solid fa-circle-question me-3" style="color: #C98F9D;"></i>
                                                Can I customize the size or color of an outfit?
                                            </button>
                                        </h2>
                                        <div id="collapseFive" class="accordion-collapse collapse"
                                            aria-labelledby="headingFive" data-bs-parent="#faqBespoke">
                                            <div class="accordion-body bg-white lh-lg fs-6"
                                                style="padding: 0 30px 30px 65px; border-top: 1px solid rgba(0,0,0,0.03); color: #666;">
                                                Yes, we offer bespoke tailoring services. If you fall outside our
                                                standard size chart or wish for a specific color palette, please contact
                                                our design consultants before placing your order. Additional charges and
                                                extended delivery times may apply.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Contact CTA -->
                    <div class="text-center mt-60">
                        <p style="font-size: 16px; color: #555; margin-bottom: 20px;">Still have questions? Our design
                            consultants are here to assist you.</p>
                        <a href="contact.html" class="aq-btn-black"
                            style="background-color: #C98F9D; border-radius: 30px; padding: 12px 30px;">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection

