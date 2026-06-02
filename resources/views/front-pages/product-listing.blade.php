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
                <h1 class="aq-catpage-title">
                    {{ $category->name }}
                </h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <span>Product Listing</span>
                </div>
            </div>
        </section>

        <!-- 2. Interactive Category Cards Section (12 Category Grid) -->
        <section class="aq-category-grid-section">
            <div class="container">
                <div class="row align-items-center mb-40">
                    <div class="col-12 text-center">
                        <div class="aq-creative-title-box">
                            <span class="aq-creative-subtitle">Premium Collections</span>
                            <h2 class="aq-creative-title" style="color: #003108;">Explore Corporate Segments</h2>
                            <div class="aq-creative-title-line" style="background: #003108; margin: 15px auto 0;"></div>
                        </div>
                    </div>
                </div>

                <div class="aq-category-grid">
                     
                    @foreach($subcategories as $subcategory)

                        <div class="aq-category-card" data-category-filter="{{ $subcategory->slug }}">
                            <div class="aq-category-card-thumb">
                                <img src="{{ asset('storage/' . $subcategory->image) }}" alt="{{ $subcategory->name }}">
                            </div>

                            <h4 class="aq-category-card-title">
                                {{ $subcategory->name }}
                            </h4>

                            <span class="aq-category-card-count">
                                {{ $subcategory->subcategory_products_count }} Products
                            </span>
                        </div>

                    @endforeach

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
                                aria-label="Close Mobile Filters"><i class="fa-solid fa-xmark"></i></button>
                            <!-- Widget Search -->
                            <div class="aq-sidebar-search">
                                <input type="text" id="aq-sidebar-search-input" placeholder="Search within results..." />
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>

                            <!-- Widget: Price Range -->
                            <div class="aq-filter-widget">
                                <button class="aq-filter-header" type="button">
                                    <span>Price Range (Bulk)</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </button>
                                <div class="aq-filter-content">
                                    <div class="aq-price-slider-wrap">
                                        <input type="range" class="aq-price-range-slider" id="priceRange" min="200"
                                            max="10000" step="100" value="10000" />
                                        <div class="aq-price-inputs">
                                            <div class="aq-price-box">Min: ₹200</div>
                                           <div class="aq-price-box" id="maxPriceLabel">
    Max: ₹10,000
</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Widget: Co-Branding Options -->
                          <div class="aq-filter-widget">
    <button class="aq-filter-header" type="button">
        <span>Featured Collections</span>
        <i class="fa-solid fa-chevron-down"></i>
    </button>

    <div class="aq-filter-content">
        <ul class="aq-filter-list">

            <li class="aq-filter-item" data-filter-type="marketing" data-marketing="featured">
                <div class="aq-filter-checkbox">
                    <i class="fa-solid fa-check"></i>
                </div>
                <span class="aq-filter-label">
                    Featured Products
                </span>
            </li>

            <li class="aq-filter-item" data-filter-type="marketing" data-marketing="new_arrival">
                <div class="aq-filter-checkbox">
                    <i class="fa-solid fa-check"></i>
                </div>
                <span class="aq-filter-label">
                    New Arrivals
                </span>
            </li>

            <li class="aq-filter-item" data-filter-type="marketing" data-marketing="sale">
                <div class="aq-filter-checkbox">
                    <i class="fa-solid fa-check"></i>
                </div>
                <span class="aq-filter-label">
                    Exclusive on Sale
                </span>
            </li>

            <li class="aq-filter-item" data-filter-type="marketing" data-marketing="best_seller">
                <div class="aq-filter-checkbox">
                    <i class="fa-solid fa-check"></i>
                </div>
                <span class="aq-filter-label">
                    Best Sellers
                </span>
            </li>
 <li class="aq-filter-item" data-filter-type="collection" data-collection="is_premium">
                <div class="aq-filter-checkbox">
                    <i class="fa-solid fa-check"></i>
                </div>
                <span class="aq-filter-label">
                    Premium Products
                </span>
            </li>

            <li class="aq-filter-item" data-filter-type="collection" data-collection="is_engraving">
                <div class="aq-filter-checkbox">
                    <i class="fa-solid fa-check"></i>
                </div>
                <span class="aq-filter-label">
                    Engravings
                </span>
            </li>

            <li class="aq-filter-item" data-filter-type="collection" data-collection="is_personalized_engraving">
                <div class="aq-filter-checkbox">
                    <i class="fa-solid fa-check"></i>
                </div>
                <span class="aq-filter-label">
                    Personalized Engraving
                </span>
            </li>

        </ul>
    </div>
</div>

<div class="aq-filter-widget">
    <button class="aq-filter-header" type="button">
        <span>Availability</span>
        <i class="fa-solid fa-chevron-down"></i>
    </button>

    <div class="aq-filter-content">
        <ul class="aq-filter-list">

            <li class="aq-filter-item"
                data-filter-type="availability"
                data-availability="ready_to_ship">

                <div class="aq-filter-checkbox">
                    <i class="fa-solid fa-check"></i>
                </div>

                <span class="aq-filter-label">
                    Ready to Ship
                </span>
            </li>

            <li class="aq-filter-item"
                data-filter-type="availability"
                data-availability="bulk_available">

                <div class="aq-filter-checkbox">
                    <i class="fa-solid fa-check"></i>
                </div>

                <span class="aq-filter-label">
                    For Bulk Orders
                </span>
            </li>

            <li class="aq-filter-item"
                data-filter-type="availability"
                data-availability="gift_hamper">

                <div class="aq-filter-checkbox">
                    <i class="fa-solid fa-check"></i>
                </div>

                <span class="aq-filter-label">
                    Gift Hampers
                </span>
            </li>

        </ul>
    </div>
</div>

                            <!-- Widget: Premium Brands -->
                            <div class="aq-filter-widget">
                                <button class="aq-filter-header" type="button">
                                    <span>Top Brands</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </button>
                                <div class="aq-filter-content">
                                    <ul class="aq-filter-list">

                                        @foreach($category->brands as $brand)

                                            <li class="aq-filter-item" data-filter-type="brand" data-brand="{{ $brand->id }}">

                                                <div class="aq-filter-checkbox">
                                                    <i class="fa-solid fa-check"></i>
                                                </div>

                                                <span class="aq-filter-label">
                                                    {{ $brand->name }}
                                                </span>

                                            </li>

                                        @endforeach

                                    </ul>

                                </div>
                            </div>

                            <!-- Widget: Gifting Occasion -->
                            <div class="aq-filter-widget">
                                <button class="aq-filter-header" type="button">
                                    <span>Gifting Occasion</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </button>
                                <div class="aq-filter-content">
                                    <ul class="aq-filter-list">

                                        @foreach($occasions as $occasion)

                                            <li class="aq-filter-item" data-filter-type="occasion"
                                                data-occasion="{{ $occasion->slug }}">

                                                <div class="aq-filter-checkbox">
                                                    <i class="fa-solid fa-check"></i>
                                                </div>

                                                <span class="aq-filter-label">
                                                    {{ $occasion->title }}
                                                </span>

                                            </li>

                                        @endforeach

                                    </ul>
                                </div>
                            </div>

                            <!-- Clear all CTA -->
                            <button type="button" class="aq-btn-black w-100 mt-20" id="aq-clear-filters-btn"
                                style="border-radius:12px; font-size:13px; padding:10px;">
                                Reset All Filters
                            </button>
                        </div>
                        
                          
                    </div>

                    <!-- Right Product Grid -->
                    <div class="col-lg-9">
                        <!-- Header filter summary bar -->
                        <div class="aq-layout-header">
                            <span class="aq-layout-header-title" id="aq-active-category-title">
                                {{ $category->name }} Collection
                            </span>
                            <div class="aq-layout-header-options">
                                <span class="d-none d-sm-inline"
                                    style="font-family: Inter, sans-serif; font-size: 13px; color: #666;"
                                    id="aq-product-results-count">Showing {{ $products->total() }} Products</span>
                                <select class="aq-sort-select">
                                    <option value="popularity">Sort By: Popularity</option>
                                    <option value="price-low">Price: Low to High</option>
                                    <option value="price-high">Price: High to Low</option>
                                    <option value="newest">Sort By: Newest</option>
                                </select>
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
                            @foreach($occasions->take(10) as $occasion)
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
const filterUrl =
"{{ route('category.filter.products', $category->slug) }}";
let activeCategory = '';

     function loadProducts(page = 1)
{
    let brands = [];
let occasions = [];
let marketing = [];
let collections = [];
let availability = [];

    document.querySelectorAll(
        '[data-filter-type="brand"].active'
    ).forEach(item => {
        brands.push(item.dataset.brand);
    });

    document.querySelectorAll(
        '[data-filter-type="occasion"].active'
    ).forEach(item => {
        occasions.push(item.dataset.occasion);
    });

    document.querySelectorAll(
    '[data-filter-type="marketing"].active'
).forEach(item => {
    marketing.push(item.dataset.marketing);
});

document.querySelectorAll(
    '[data-filter-type="collection"].active'
).forEach(item => {
    collections.push(item.dataset.collection);
});

document.querySelectorAll(
    '[data-filter-type="availability"].active'
).forEach(item => {
    availability.push(item.dataset.availability);
});

    $.ajax({

        url: filterUrl,

        type: 'GET',

        data: {

    page: page,

    search: document.getElementById(
        'aq-sidebar-search-input'
    ).value,

    max_price: document.getElementById(
        'priceRange'
    ).value,

    brands: brands,

    occasions: occasions,

    marketing: marketing,

    collections: collections,

    availability: availability,

    subcategory: activeCategory,

    sort: document.querySelector(
        '.aq-sort-select'
    ).value
},

        success: function(response)
        {
            document.getElementById(
                'aq-product-catalog-grid'
            ).innerHTML = response.html;

            document.getElementById(
                'pagination-wrapper'
            ).innerHTML =
                response.pagination;

            document.getElementById(
                'aq-product-results-count'
            ).innerText =
                'Showing ' +
                response.total +
                ' Products';
        }
    });
}

$(document).on(
    'click',
    '#pagination-wrapper a',
    function (e)
    {
        e.preventDefault();

        let page =
            $(this)
            .attr('href')
            .split('page=')[1];

        loadProducts(page);
    }
);

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
        loadProducts(1);
    });
});

            // 3. Price slider dynamic value display
            const priceSlider = document.getElementById("priceRange");
            const maxPriceLabel = document.getElementById("maxPriceLabel");
            if (priceSlider && maxPriceLabel) {
                priceSlider.addEventListener("change", function () {

    maxPriceLabel.innerText =
        "Max: ₹" +
        parseInt(this.value).toLocaleString('en-IN');

    loadProducts(1);
});

            }

    

            // Click listener for Category grid cards
            const categoryCards = document.querySelectorAll(".aq-category-card");
            const activeCategoryTitle = document.getElementById("aq-active-category-title");

            categoryCards.forEach(card => {
                card.addEventListener("click", function () {
                    // Update active styling class
                    categoryCards.forEach(c => c.classList.remove("active"));
                    this.classList.add("active");

                    activeCategory = this.getAttribute("data-category-filter");

const catName =
    this.querySelector(".aq-category-card-title").innerText;

if (activeCategoryTitle) {
    activeCategoryTitle.innerText =
        catName + " Collection";
}

loadProducts(1);
                    

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

            // Simulate Filtering
         

            // Search filtering listener
            const searchInput = document.getElementById("aq-sidebar-search-input");
            if (searchInput) {
                searchInput.addEventListener("input", function () {
                    loadProducts(1);
                });
            }

            const sortSelect = document.querySelector('.aq-sort-select');

if (sortSelect) {

    sortSelect.addEventListener('change', function () {

        loadProducts(1);

    });

}

            // Reset filters logic
            const clearBtn = document.getElementById("aq-clear-filters-btn");

if (clearBtn) {

    clearBtn.addEventListener("click", function () {

        if (priceSlider) {
            priceSlider.value = 10000;
            maxPriceLabel.innerText = "Max: ₹10,000";
        }

        if (searchInput) {
            searchInput.value = "";
        }

        filterItems.forEach(item => {
            item.classList.remove("active");
        });

        categoryCards.forEach(card => {
            card.classList.remove("active");
        });

        activeCategory = '';

        loadProducts(1);
    });

}

         
            // Mobile filters offcanvas toggle handlers
            const mobileFilterOpenBtn = document.getElementById("aq-mobile-filter-open-btn");
            const mobileFilterCloseBtn = document.getElementById("aq-mobile-filter-close");
            const filterSidebar = document.querySelector(".aq-filter-sidebar");

            if (mobileFilterOpenBtn && filterSidebar) {
                mobileFilterOpenBtn.addEventListener("click", function (event) {
                    event.stopPropagation(); // Prevent immediate closing
                    filterSidebar.classList.add("active");
                    document.body.style.overflow = "hidden";
                });
            }

            if (mobileFilterCloseBtn && filterSidebar) {
                mobileFilterCloseBtn.addEventListener("click", function () {
                    filterSidebar.classList.remove("active");
                    document.body.style.overflow = "";
                });
            }

            // Close sidebar when clicking outside
            if (filterSidebar) {
                document.addEventListener("click", function (event) {
                    if (filterSidebar.classList.contains("active")) {
                        const isClickInsideSidebar = filterSidebar.contains(event.target);
                        const isClickOnOpenBtn = mobileFilterOpenBtn && mobileFilterOpenBtn.contains(event.target);
                        
                        if (!isClickInsideSidebar && !isClickOnOpenBtn) {
                            filterSidebar.classList.remove("active");
                            document.body.style.overflow = "";
                        }
                    }
                });
            }

            // Parse URL parameters for categories deep link
            const urlParams = new URLSearchParams(window.location.search);
const subcategoryParam = urlParams.get('subcategory');

if (subcategoryParam) {

    const targetCard = document.querySelector(
        `.aq-category-card[data-category-filter="${subcategoryParam}"]`
    );

    if (targetCard) {

        targetCard.classList.add('active');

        activeCategory = subcategoryParam;

        const activeCategoryTitle =
            document.getElementById('aq-active-category-title');

        const catName =
            targetCard.querySelector('.aq-category-card-title').innerText;

        if (activeCategoryTitle) {
            activeCategoryTitle.innerText =
                catName + ' Collection';
        }

        loadProducts(1);

        setTimeout(() => {

            const section =
                document.getElementById('aq-catalog-section');

            if (section) {
                const topOffset =
                    section.getBoundingClientRect().top +
                    window.pageYOffset - 120;

                window.scrollTo({
                    top: topOffset,
                    behavior: 'smooth'
                });
            }

        }, 300);
    }
}

        });
    </script>
    <div class="aq-mobile-filter-trigger-bar">
        <button type="button" class="aq-mobile-filter-btn" id="aq-mobile-filter-open-btn">
            <i class="fa-solid fa-sliders"></i>
            <span>Filter Results</span>
        </button>
    </div>
@endsection