@extends('layouts.app')



@section('content')

    <style>
        .accordion-luxury .accordion-button:not(.collapsed) {
            background-color: #ffffff !important;
            color: #D4AF37 !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;
        }

        .accordion-luxury .accordion-button:not(.collapsed) .text-gold {
            color: #003108 !important;
        }

        .accordion-luxury .accordion-button:focus {
            border-color: transparent !important;
            box-shadow: none !important;
        }

        .accordion-luxury .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }

        .accordion-luxury .accordion-button:not(.collapsed)::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23D4AF37'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }
    </style>
    <main class="aq-faq-page">

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
                <h1 class="aq-catpage-title">FAQ</h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="index.html">Home</a>
                    <span>/</span>
                    <span>FAQ</span>
                </div>
            </div>
        </section>

        <div class="aq-faq-parent-wrapper pt-120 pb-120">
            <div class="container">

                <div class="aq-faq-content-wrapper">
                    <div class="aq-faq-header text-center mb-50">
                        <h2 class="aq-faq-main-title">Frequently Asked Questions</h2>
                        <p class="aq-faq-subtitle">Find answers to the most common questions about our corporate gifting
                            solutions.</p>
                    </div>
                    <div class="col-md-10 mx-auto">
                        <div class="accordion accordion-luxury" id="faqAccordion">

                            @foreach($faqs as $faq)

                                <div class="accordion-item border-0 mb-4 rounded-4 shadow-sm overflow-hidden"
                                    style="transition: all 0.3s ease;">

                                    <h2 class="accordion-header" id="heading{{ $faq->id }}">

                                        <button class="accordion-button fw-bold fs-5 text-dark collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}"
                                            aria-expanded="false" aria-controls="collapse{{ $faq->id }}"
                                            style="background-color: #00310814; padding: 25px 30px; box-shadow: none;">

                                            <i class="fa-solid fa-circle-question text-gold me-3"></i>

                                            {{ $faq->question }}

                                        </button>

                                    </h2>

                                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#faqAccordion">

                                        <div class="accordion-body bg-white text-secondary lh-lg fs-6"
                                            style="padding: 0 30px 30px 65px; border-top: 1px solid rgba(0,0,0,0.03);">

                                            {!! nl2br(e($faq->answer)) !!}

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>



@endsection