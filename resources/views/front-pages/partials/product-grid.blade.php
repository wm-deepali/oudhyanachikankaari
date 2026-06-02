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
                        <button class="aq-product-action-btn aq-consultation-trigger" title="Quick Consultation"
                            onclick="openGlobalDrawer('product-listing')">
                            <i class="fa-regular fa-envelope"></i>
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

                        <button class="aq-product-card-cta aq-consultation-trigger" onclick="openGlobalDrawer('product-listing')">
                            Enquire
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
        <h5 style="font-family:Outfit,sans-serif; color:#666;">No Products Match Filters</h5>
        <p style="font-family:Inter,sans-serif; color:#888;">Try clearing active filters or adjusting the price slider.</p>
    </div>

@endif