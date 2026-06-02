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
    My Wishlist
</h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <span>My Wishlist</span>
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
                      <span class="aq-layout-header-title">
    Wishlist Products
</span>
                            <div class="aq-layout-header-options">
                                <span class="d-none d-sm-inline"
                                    style="font-family: Inter, sans-serif; font-size: 13px; color: #666;"
                                    id="aq-product-results-count">Showing {{ $products->total() }} Wishlist Items</span>
                            </div>
                        </div>

                        <!-- Product Cards Grid -->
                         <div id="aq-product-catalog-grid">
                             
                                  @if($products->count())
     <div class="aq-product-grid" >
 

        @foreach($products as $product)


            @php
                $badge = '';
                $badgeClass = '';

                if ($product->best_seller) {
                    $badge = 'Best Seller';
                    $badgeClass = 'bestseller';
                } elseif ($product->new_arrival) {
                    $badge = 'New';
                    $badgeClass = 'new';
                } elseif ($product->sale) {
                    $badge = 'Sale';
                    $badgeClass = 'sale';
                }
            @endphp

            <div class="aq-product-card" data-category="{{ $activeCategory ?? '' }}" data-price="{{ $product->price }}">

                <div class="aq-product-card-top">

                    <img src="{{ $product->display_image
                    ? asset('storage/' . $product->display_image)
                    : asset('assets/img/no-image.webp') }}" class="aq-product-card-img" alt="{{ $product->name }}" />

                    <div class="aq-product-badges">
                        @if($badge)
                            <span class="aq-product-badge {{ $badgeClass }}">
                                {{ $badge }}
                            </span>
                        @endif
                    </div>

                    <div class="aq-product-brand-badge">
                        @if(optional($product->brand)->logo)
                            <img src="{{ asset('storage/' . $product->brand->logo) }}" alt="{{ $product->brand->name }}" />
                        @endif
                    </div>

                  <div class="aq-product-actions">
    <button class="aq-product-action-btn remove-wishlist"
            data-id="{{ $product->id }}"
            title="Remove Wishlist">

        <i class="fa-solid fa-trash"></i>

    </button>
</div>

                </div>

                <div class="aq-product-card-info">

                    <span class="aq-product-card-brand-name">
                        {{ optional($product->brand)->name }}
                    </span>

                    <h4 class="aq-product-card-title">
                        <a href="{{ route('product.details', $product->slug) }}">
                            {{ $product->name }}
                        </a>
                    </h4>

                    <p style="font-family: Inter, sans-serif; font-size:12px; color:#777; margin-bottom:12px;">
                        {{ Str::limit(strip_tags($product->sub_title), 120) }}
                    </p>

                    <div class="aq-product-card-bottom">

                        <div class="aq-product-card-price">
                            ₹{{ number_format($product->price) }}
                            <span>/ unit</span>
                        </div>

                       <button class="aq-product-card-cta remove-wishlist"
        data-id="{{ $product->id }}">
    Remove
</button>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

 @if($products->hasPages())
    <div id="pagination-wrapper"
         class="d-flex justify-content-center align-items-center gap-3" style="margin-top: 40px;">

        {{-- Previous --}}
        @if($products->onFirstPage())
            <button class="btn btn-secondary" disabled>
                ← Previous
            </button>
        @else
            <a href="{{ $products->previousPageUrl() }}"
               class="btn btn-dark">
                ← Previous
            </a>
        @endif

        {{-- Page Numbers --}}
        <div class="d-flex align-items-center gap-2">

            @for($i = 1; $i <= $products->lastPage(); $i++)

                @if($i == $products->currentPage())

                    <span class="btn btn-dark">
                        {{ $i }}
                    </span>

                @elseif(
                    $i == 1 ||
                    $i == $products->lastPage() ||
                    abs($i - $products->currentPage()) <= 1
                )

                    <a href="{{ $products->url($i) }}"
                       class="btn btn-outline-dark">
                        {{ $i }}
                    </a>

                @elseif(
                    $i == $products->currentPage() - 2 ||
                    $i == $products->currentPage() + 2
                )

                    <span>...</span>

                @endif

            @endfor 
        </div>

        {{-- Next --}}
        @if($products->hasMorePages())
            <a href="{{ $products->nextPageUrl() }}"
               class="btn btn-dark">
                Next →
            </a>
        @else
            <button class="btn btn-secondary" disabled>
                Next →
            </button>
        @endif

    </div>
@endif


@else

    <div class="col-12 text-center py-5">
        <i class="fa-solid fa-filter-circle-xmark mb-3" style="font-size:48px; color:#ccc;"></i>
       <h5 style="font-family:Outfit,sans-serif; color:#666;">
    Your Wishlist is Empty
</h5>

<p style="font-family:Inter,sans-serif; color:#888;">
    No products have been added to your wishlist yet.
</p>

<a href="{{ route('products') }}"
   class="btn btn-dark mt-3">
    Continue Shopping
</a>
    </div>

@endif
                                

                         </div></div>
                </div>
            </div>
        </section>



    </main>
 
<script>

document.addEventListener('click', function(e){

    if(e.target.closest('.remove-wishlist')){

        let btn = e.target.closest('.remove-wishlist');
        let productId = btn.dataset.id;

        fetch(`/wishlist/${productId}`,{
            method:'DELETE',
            headers:{
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {

            Swal.fire({
                icon:'success',
                title:'Removed',
                text:data.message
            });

           const card = btn.closest('.aq-product-card');
card.remove();

if(document.querySelectorAll('.aq-product-card').length === 0){
    location.reload();
}

        });

    }

});

</script>

@endsection