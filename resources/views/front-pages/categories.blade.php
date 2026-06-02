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
                <h1 class="aq-catpage-title">Corporate Gifting Categories</h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <span>Categories</span>
                </div>
            </div>
        </section>
        <!-- categories area start -->
        <section class="aqf-categories-area">
            <div class="aqf-cat-floating-shape aqf-cat-shape-1">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
            </div>
            <div class="aqf-cat-floating-shape aqf-cat-shape-2">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect x="3" y="8" width="18" height="13" rx="2" ry="2" />
                    <path d="M12 8V21M3 13h18M12 8L7 2M12 8l5-6" />
                </svg>
            </div>
            <div class="container">
                <div class="row align-items-center mb-40">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                        <div class="aq-creative-title-box">
                            <span class="aq-creative-subtitle">Curated For You</span>
                            <h4 class="aq-creative-title">Shop by Category</h4>
                            <div class="aq-creative-title-line"></div>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4 pb-30" id="category-container">
                    @include('front-pages.partials.category-items', ['categories' => $categories])
                </div>

                <div class="readmore-btn">
                    <div class="aq-header-top-bulk-orders d-none d-lg-inline-block">
                        @if($categories->hasMorePages())

                            <a href="javascript:void(0)" class="aq-load-more-btn" id="load-more-categories" data-page="2">

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

                                <span>LOAD MORE CATEGORIES</span>

                            </a>

                        @endif

                    </div>
                </div>

            </div>
        </section>
        <!-- categories area end -->
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       $(document).on('click', '#load-more-categories', function () {

            let btn = $(this);
            let page = btn.data('page');

            btn.find('span').text('Loading...');

            $.ajax({
                url: "{{ route('categories') }}",
                type: "GET",
                data: {
                    page: page
                },
                success: function (response) {

                    if ($.trim(response) === '') {
                        btn.remove();
                        return;
                    }

                    $('#category-container').append(response);

                    btn.data('page', page + 1);
                    btn.find('span').text('LOAD MORE CATEGORIES');
                }
            });

        });
    </script>
@endsection