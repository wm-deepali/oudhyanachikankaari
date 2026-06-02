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
                <h1 class="aq-catpage-title">Gifting Occasions</h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="index.html">Home</a>
                    <span>/</span>
                    <span>occasions</span>
                </div>
            </div>
        </section> <!-- collection area start -->
        <section>
            <div class="aqf-collection-area fix">
                <div class="container">
                    <!-- Section Title -->
                    <div class="aqf-collection-top mb-40">
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <div class="aq-creative-title-box">
                                    <span class="aq-creative-subtitle">Celebrate Moments</span>
                                    <h4 class="aq-creative-title">Gifting Occasions</h4>
                                    <div class="aq-creative-title-line"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Occasions 4x2 Grid -->
                    <!-- <div class="aq-occasion-grid">


                                                </div> -->

                    <div class="gifting_occasions">
                        <div class="aq-occasion-grid" id="occasion-container">

                            @include('front-pages.partials.occasion-items', ['occasions' => $occasions])

                        </div>

                        <div class="readmore-btn">
                            <div class="aq-header-top-bulk-orders d-none d-lg-inline-block">
                                @if($occasions->hasMorePages())

                                    <a href="javascript:void(0)" class="aq-load-more-btn"id="load-more-occasions" data-page="2">

                                        <i>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path
                                                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                                </path>
                                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                            </svg>
                                        </i>

                                        <span>LOAD MORE OCCASIONS</span>

                                    </a>

                                @endif

                            </div>
                        </div>


                    </div>
                </div>
        </section>
        <!-- collection area end -->
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '#load-more-occasions', function () {

            let btn = $(this);
            let page = btn.data('page');

            btn.find('span').text('Loading...');

            $.ajax({
                url: "{{ route('occasions') }}",
                type: "GET",
                data: {
                    page: page
                },
                success: function (response) {

                    if ($.trim(response) === '') {
                        btn.remove();
                        return;
                    }

                    $('#occasion-container').append(response);

                    btn.data('page', page + 1);
                    btn.find('span').text('LOAD MORE OCCASIONS');
                }
            });

        });
    </script>

@endsection