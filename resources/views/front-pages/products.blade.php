@extends('layouts.app')

@section('content')

<style>
    .aq-product-nav-btn{
    display:inline-block;
    padding:12px 30px;
    margin:0 8px;
    border-radius:50px;
    background:#000;
    color:#fff;
    text-decoration:none;
    font-weight:600;
    transition:.3s;
}

.aq-product-nav-btn:hover{
    color:#fff;
    transform:translateY(-2px);
}
</style>
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
                <h1 class="aq-catpage-title">
                    {{ $title ?? 'Products' }}
                </h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <span>Product Listing</span>
                </div>
            </div>
        </section>

        <!-- 3. Interactive Catalog Viewport (Sidebar + Product Catalog) -->
        <section class="aq-catpage-main-layout" id="aq-catalog-section">
            <div class="container">
                <div class="row">

                    <!-- Right Product Grid -->
                    <div class="col-lg-12">
                        <!-- Header filter summary bar -->
                        <div class="aq-layout-header">
                           <span class="aq-layout-header-title" id="aq-active-category-title">
    {{ $title ?? 'Products Collection' }}
</span>
                            <div class="aq-layout-header-options">
                                <span class="d-none d-sm-inline"
                                    style="font-family: Inter, sans-serif; font-size: 13px; color: #666;"
                                    id="aq-product-results-count">Showing {{ $products->total() }} Products</span>
                            </div>
                        </div>

                        <!-- Product Cards Grid -->
                         <div id="aq-product-catalog-grid">
                             
                                     @include(
                                         'front-pages.partials.product-grid',
                                         ['products' => $products]
                                     )
                             
                                

                         </div></div>
                </div>
            </div>
        </section>


        <!-- 6. Bottom Sticky Category Link Area (For SEO/Footer Links) -->
        <section class="aq-footer-categories-section">
            <div class="container">
                <div class="aq-footer-cat-container">
                    <div class="aq-footer-cat-group">
                        <span class="aq-footer-cat-label">Shop by Recipient</span>
                        <div class="aq-footer-cat-links">
                            @foreach($footerCategories as $footerCategory)
                                <a href="{{ route('category.products', $footerCategory->slug) }}" class="aq-footer-cat-link">
                                    {{ $footerCategory->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="aq-footer-cat-group">
                        <span class="aq-footer-cat-label">Shop by Occasion</span>
                        <div class="aq-footer-cat-links">
                            @foreach($footerOccasions as $occasion)
                                <a href="{{ route('products', ['occasion' => $occasion->slug]) }}" class="aq-footer-cat-link">
                                    {{ $occasion->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
 
@endsection