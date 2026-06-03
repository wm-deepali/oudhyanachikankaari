<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    @php
        require_once app_path('Helpers/seo.php');
        $seo = getSeo();
    @endphp

    <title>
        @yield('meta_title', $seo->meta_title ?? 'Oudhyana Chikankaari')
    </title>

    <meta name="description" content="@yield('meta_description', $seo->meta_description ?? '')">

    @if($seo && $seo->scripts)
        {!! $seo->scripts !!}
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Place favicon.ico in the root directory -->
    <!-- <link rel="shortcut icon" type="image/x-icon" href="public/assets/img/corporate/favicon.webp"> -->

    <!-- Critical CSS (Synchronous for immediate above-the-fold paint) -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/spacing.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom-luxury.css')}}" />

    <!-- Non-Critical CSS (Deferred to eliminate render-blocking requests) -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css')}}" media="print" onload="this.media = 'all'" />
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.min.css')}}" media="print"
        onload="this.media = 'all'" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom-animation.min.css')}}" media="print"
        onload="this.media = 'all'" />
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css')}}" media="print"
        onload="this.media = 'all'" />
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css')}}" media="print"
        onload="this.media = 'all'" />
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-pro.min.css')}}" media="print"
        onload="this.media = 'all'" />
</head>

<body class="aq-product-details-page">
    <!-- pre loader area start -->
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="aq-preloader-content">
                    <div class="aq-preloader-logo">
                        <div class="aq-preloader-circle">
                            <svg width="190" height="190" viewBox="0 0 380 380" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle stroke="#D9D9D9" cx="190" cy="190" r="180" stroke-width="6"
                                    stroke-linecap="round"></circle>
                                <circle stroke="red" cx="190" cy="190" r="180" stroke-width="6" stroke-linecap="round">
                                </circle>
                            </svg>
                        </div>
                        <img src="public/assets/img/corporate/favicon.webp" alt="" loading="lazy" />
                    </div>
                    <!-- <h3 class="aq-preloader-title">B2B Gifts</h3> -->
                    <!-- <p class="aq-preloader-subtitle">Loading..</p> -->
                </div>
            </div>
        </div>
    </div>
    <!-- pre loader area end -->

    <!-- back to top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
        </svg>
    </div>
    <!-- back to top end -->

    <!-- search area -->
    <div class="aq-search-wrap aq-search-area">
        <div class="aq-search-close">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M12.75 0.75L0.75 12.75M0.75 0.75L12.75 12.75" stroke="currentcolor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </div>
        <div class="aq-search-inner-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="aq-search-input p-relative mb-60">
                            <input type="text" placeholder="What are you looking for?" />
                            <button type="submit" class="aq-search-input-btn" aria-label="Submit Search Query">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                    fill="none">
                                    <path
                                        d="M13.6792 12.6197C13.3863 12.3268 12.9114 12.3268 12.6185 12.6197C12.3256 12.9126 12.3256 13.3875 12.6185 13.6804L13.1489 13.15L13.6792 12.6197ZM13.1489 13.15L12.6185 13.6804L16.2185 17.2803L16.7489 16.75L17.2792 16.2197L13.6792 12.6197L13.1489 13.15ZM15.1499 7.94997H15.8999C15.8999 3.55932 12.3406 0 7.94997 0V0.75V1.5C11.5122 1.5 14.3999 4.38775 14.3999 7.94997H15.1499ZM7.94997 0.75V0C3.55932 0 0 3.55932 0 7.94997H0.75H1.5C1.5 4.38775 4.38775 1.5 7.94997 1.5V0.75ZM0.75 7.94997H0C0 12.3406 3.55932 15.8999 7.94997 15.8999V15.1499V14.3999C4.38775 14.3999 1.5 11.5122 1.5 7.94997H0.75ZM7.94997 15.1499V15.8999C12.3406 15.8999 15.8999 12.3406 15.8999 7.94997H15.1499H14.3999C14.3999 11.5122 11.5122 14.3999 7.94997 14.3999V15.1499Z"
                                        fill="currentcolor"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3">
                        <div class="aq-search-cat-wrap mb-30">
                            <h4 class="aq-search-cat-title mb-35">Popular Searches</h4>
                            <div class="aq-search-cat">
                                <a href="#">Hampers</a>
                                <a href="#">Welcome Kits</a>
                                <a href="#">Tech Gadgets</a>
                                <a href="#">Business Bags</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">
                        <div class="aq-search-product mb-30">
                            <h4 class="aq-search-cat-title mb-35">
                                Recently Viewed Products
                            </h4>
                            <div class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-2 row-cols-sm-2 row-cols-1">
                                <div class="col">
                                    <div class="aq-product-item aq-product-main mb-40" data-lazy="true">
                                        <div class="aq-product-thumb aq-img-hover-wrap p-relative mb-10">
                                            <a href="product-details-default.html">
                                                <img class="lazyload aq-product-img"
                                                    src="public/assets/img/corporate/custom_gift_hampers1.webp"
                                                    alt="Corporate Hamper" loading="lazy" />
                                                <img class="aq-img-hover lazyload"
                                                    src="public/assets/img/corporate/custom_gift_hampers2.webp"
                                                    alt="Corporate Hamper Hover" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="aq-product-content">
                                            <span class="aqf-product-3-category">Premium Hampers</span>
                                            <h4 class="aq-product-title mb-5">
                                                <a href="product-details-default.html">Bespoke Corporate Hamper</a>
                                            </h4>
                                            <div class="aq-product-price">
                                                <ins><span class="aq-product-new-price">$85.00</span></ins>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="aq-product-item aq-product-main mb-40" data-lazy="true">
                                        <div class="aq-product-thumb aq-img-hover-wrap p-relative mb-10">
                                            <div class="aq-product-badge">
                                                <span class="clr-sale">-10%</span>
                                            </div>
                                            <a href="product-details-default.html">
                                                <img class="lazyload aq-product-img"
                                                    src="public/assets/img/corporate/premium_gadgets_1778668027534.webp"
                                                    alt="Tech Gadgets" loading="lazy" />
                                                <img class="aq-img-hover lazyload"
                                                    src="public/assets/img/corporate/media__1778668953904.webp"
                                                    alt="Tech Gadgets Hover" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="aq-product-content">
                                            <span class="aqf-product-3-category">Tech & Gadgets</span>
                                            <h4 class="aq-product-title mb-5">
                                                <a href="product-details-default.html">Elite Tech Suite</a>
                                            </h4>
                                            <div class="aq-product-price">
                                                <ins><span class="aq-product-new-price">$145.00</span></ins>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="aq-product-item aq-product-main mb-40" data-lazy="true">
                                        <div class="aq-product-thumb aq-img-hover-wrap p-relative mb-10">
                                            <a href="product-details-default.html">
                                                <img class="lazyload aq-product-img"
                                                    src="public/assets/img/corporate/apparel_gifts_1778668621245.webp"
                                                    alt="Corporate Apparel" loading="lazy" />
                                                <img class="aq-img-hover lazyload"
                                                    src="public/assets/img/corporate/media__1778668979144.png"
                                                    alt="Corporate Apparel Hover" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="aq-product-content">
                                            <span class="aqf-product-3-category">Corporate Wear</span>
                                            <h4 class="aq-product-title mb-5">
                                                <a href="product-details-default.html">Premium Branded Polo</a>
                                            </h4>
                                            <div class="aq-product-price">
                                                <ins><span class="aq-product-new-price">$30.00</span></ins>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="aq-product-item aq-product-main mb-40" data-lazy="true">
                                        <div class="aq-product-thumb aq-img-hover-wrap p-relative mb-10">
                                            <div class="aq-product-badge">
                                                <span class="clr-new">New</span>
                                            </div>
                                            <a href="product-details-default.html">
                                                <img class="lazyload aq-product-img"
                                                    src="public/assets/img/corporate/backpack_gifts_1778668040094.webp"
                                                    alt="Business Bag" loading="lazy" />
                                                <img class="aq-img-hover lazyload"
                                                    src="public/assets/img/corporate/media__1778668962634.png"
                                                    alt="Business Bag Hover" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="aq-product-content">
                                            <span class="aqf-product-3-category">Travel</span>
                                            <h4 class="aq-product-title mb-5">
                                                <a href="product-details-default.html">Executive Travel Case</a>
                                            </h4>
                                            <div class="aq-product-price">
                                                <ins><span class="aq-product-new-price">$44.00</span></ins>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- search area -->

    <!-- Cartmini area -->
    <div class="aq-cartmini-area aq-cartmini-active d-flex flex-column justify-content-between">
        <div class="aq-cartmini-header">
            <i class="aq-cartmini-close aq-cartmini-close-icon fa-regular fa-xmark"></i>
            <h4 class="aq-cartmini-title">Shopping Cart</h4>

        </div>
        <div class="aq-cartmini-body">

            @if($miniCart && $miniCart->items->count())

                @foreach($miniCart->items as $item)

                    <div class="aq-cartmini-product-item mb-15 item-delete d-flex align-items-center">

                        <div class="aq-cartmini-product-thumbnail">
                            <a href="{{ route('product.details', $item->product->slug) }}">
                                <img src="{{ asset('storage/' . $item->product->display_image) }}"
                                    alt="{{ $item->product->name }}" loading="lazy">
                            </a>
                        </div>

                        <div class="aq-cartmini-product-summary">

                            <h4 class="aq-product-title">
                                <a href="{{ route('product.details', $item->product->slug) }}">
                                    {{ $item->product->name }}
                                </a>
                            </h4>

                            @if($item->customization)
                                <span class="aq-cartmini-product-size">
                                    <label>Customization:</label>
                                    {{ $item->customization->name }}
                                </span>
                            @endif

                            <span class="aq-cartmini-product-price">
                                ₹{{ number_format($item->price, 2) }}
                            </span>

                            <div class="aq-product-details-quantity d-flex align-items-center">

                                <div class="aq-product-quantity">

                                    <span class="aq-cart-minus update-cart-qty" data-id="{{ $item->id }}" data-action="minus">
                                        -
                                    </span>

                                    <input class="aq-cart-input" type="text" value="{{ $item->quantity }}" readonly>

                                    <span class="aq-cart-plus update-cart-qty" data-id="{{ $item->id }}" data-action="plus">
                                        +
                                    </span>

                                </div>

                                <button class="aq-line-anim aq-cartmini-remove remove-cart-item" data-id="{{ $item->id }}">
                                    Remove
                                </button>

                            </div>

                        </div>

                    </div>

                @endforeach

            @else

                <div class="cartmini-empty text-center">

                    <img src="{{ asset('assets/img/corporate/empty-cart.webp') }}" alt="Empty Cart" loading="lazy">

                    <p>Your Cart is empty</p>

                    <a href="{{ route('categories') }}" class="aq-btn-black border-btn">
                        Continue Shopping
                    </a>

                </div>

            @endif

        </div>
        <div class="aq-cartmini-footer">
            <div class="aq-cartmini-total d-flex justify-content-between align-items-center">
                <span class="aq-cartmini-total-title">Subtotal</span>
                <span class="aq-cartmini-total-value">
                    ₹{{ number_format($miniCart->total_amount ?? 0, 2) }}
                </span>
            </div>
            <div class="aq-cartmini-main-btn d-flex justify-content-between">
                <a href="{{ route('shopping-cart') }}" class="aq-btn-black btn-red-bg text-center w-100">
                    View Cart
                </a>

                <a href="{{ route('shopping-cart') }}" class="aq-btn-black text-center w-100">
                    Request Quote
                </a>
            </div>
            <div class="aq-cartmini-tools-box note-active">
                <h4 class="aq-cartmini-tools-text mb-10">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                            <path
                                d="M4.24818 0.75V2.85M9.85182 0.75V2.85M4.24818 7.05H9.84818M4.24818 10.5482H7.04818M13.35 5.3V11.25C13.35 13.35 12.3 14.75 9.85 14.75H4.25C1.8 14.75 0.75 13.35 0.75 11.25V5.3C0.75 3.2 1.8 1.8 4.25 1.8H9.85C12.3 1.8 13.35 3.2 13.35 5.3Z"
                                stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <span>Note</span>
                </h4>
                <div class="aq-cartmini-tools-field mb-10">
                    <form action="#">
                        <textarea placeholder="Add special instructions for your order..."></textarea>
                    </form>
                </div>
                <div class="aq-cartmini-tools-btn d-flex">
                    <button class="aq-btn-black btn-cancel border-btn w-100 text-center">
                        Cancel
                    </button>
                    <button class="aq-btn-black btn-red-bg w-100 text-center">
                        Save
                    </button>
                </div>
            </div>
            <div class="aq-cartmini-tools-box coupon-active">
                <h4 class="aq-cartmini-tools-text mb-10">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none">
                            <path
                                d="M6.25 9.0625L10.75 4.5625M10.7446 9.0625H10.7536M6.24588 4.9375H6.25262M14.125 7.375C14.125 6.34 14.965 5.5 16 5.5V4.75C16 1.75 15.25 1 12.25 1H4.75C1.75 1 1 1.75 1 4.75V5.125C2.035 5.125 2.875 5.965 2.875 7C2.875 8.035 2.035 8.875 1 8.875V9.25C1 12.25 1.75 13 4.75 13H12.25C15.25 13 16 12.25 16 9.25C14.965 9.25 14.125 8.41 14.125 7.375Z"
                                stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                    </span>
                    <span>Add A Coupon Code</span>
                </h4>
                <div class="aq-cartmini-tools-field mb-10">
                    <form action="#">
                        <label>Enter Code</label>
                        <input type="text" placeholder="Discount code" />
                    </form>
                </div>
                <div class="aq-cartmini-tools-btn d-flex">
                    <button class="aq-btn-black btn-cancel border-btn w-100 text-center">
                        Cancel
                    </button>
                    <button class="aq-btn-black btn-red-bg w-100 text-center">
                        Save
                    </button>
                </div>
            </div>
            <div class="aq-cartmini-tools-box shipping-active">
                <h4 class="aq-cartmini-tools-text mb-10">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none">
                            <path
                                d="M15.6508 5.90014H16.3008C16.3008 5.79256 16.2741 5.68666 16.2231 5.59195L15.6508 5.90014ZM15.1017 10.6011L14.642 10.1414L14.642 10.1414L15.1017 10.6011ZM8.47092 0.76015L8.67178 0.141963L8.67178 0.141962L8.47092 0.76015ZM9.91555 2.20477L9.29736 2.40563L9.29736 2.40563L9.91555 2.20477ZM10.0991 4.86364L9.48091 5.0645L9.48091 5.06451L10.0991 4.86364ZM11.0622 5.82672L10.8613 6.44491L10.8613 6.44491L11.0622 5.82672ZM2.8681 11.7788C3.22664 11.7967 3.53178 11.5205 3.54965 11.162C3.56752 10.8034 3.29136 10.4983 2.93282 10.4804L2.90046 11.1296L2.8681 11.7788ZM1.19958 10.6011L0.739965 11.0607L0.739965 11.0607L1.19958 10.6011ZM13.3684 10.4804C13.0099 10.4983 12.7337 10.8034 12.7516 11.162C12.7695 11.5205 13.0746 11.7967 13.4331 11.7788L13.4008 11.1296L13.3684 10.4804ZM0.650391 2.44379e-05C0.291406 2.44379e-05 0.000390649 0.291039 0.000390649 0.650024C0.000390649 1.00901 0.291406 1.30002 0.650391 1.30002V0.650024V2.44379e-05ZM1.32025 8.86785C1.30238 8.50931 0.997234 8.23314 0.638694 8.25101C0.280154 8.26888 0.00398801 8.57403 0.0218602 8.93257L0.671054 8.90021L1.32025 8.86785ZM0.650543 3.00001C0.291558 3.00001 0.000543237 3.29102 0.000543237 3.65001C0.000543237 4.00899 0.291558 4.30001 0.650543 4.30001V3.65001V3.00001ZM5.15068 4.30001C5.50967 4.30001 5.80068 4.00899 5.80068 3.65001C5.80068 3.29102 5.50967 3.00001 5.15068 3.00001V3.65001V4.30001ZM0.650543 5.24978C0.291558 5.24978 0.000543237 5.5408 0.000543237 5.89978C0.000543237 6.25877 0.291558 6.54978 0.650543 6.54978V5.89978V5.24978ZM3.65063 6.54978C4.00962 6.54978 4.30063 6.25877 4.30063 5.89978C4.30063 5.5408 4.00962 5.24978 3.65063 5.24978V5.89978V6.54978ZM10.0255 1.50002C9.66656 1.50002 9.37554 1.79104 9.37554 2.15002C9.37554 2.50901 9.66656 2.80002 10.0255 2.80002V2.15002V1.50002ZM14.6934 4.12219L14.1211 4.43036L14.1211 4.43038L14.6934 4.12219ZM13.473 2.41531L13.8063 1.85727L13.8063 1.85727L13.473 2.41531ZM13.4013 11.1499H12.7513C12.7513 11.6194 12.3707 11.9999 11.9013 11.9999V12.6499V13.2999C13.0887 13.2999 14.0513 12.3373 14.0513 11.1499H13.4013ZM11.9013 12.6499V11.9999C11.4318 11.9999 11.0512 11.6194 11.0512 11.1499H10.4012H9.75121C9.75121 12.3373 10.7138 13.2999 11.9013 13.2999V12.6499ZM10.4012 11.1499H11.0512C11.0512 10.6804 11.4318 10.2999 11.9013 10.2999V9.64987V8.99987C10.7138 8.99987 9.75121 9.96246 9.75121 11.1499H10.4012ZM11.9013 9.64987V10.2999C12.3707 10.2999 12.7513 10.6804 12.7513 11.1499H13.4013H14.0513C14.0513 9.96246 13.0887 8.99987 11.9013 8.99987V9.64987ZM5.90147 11.15H5.25147C5.25147 11.6194 4.8709 12 4.40143 12V12.65V13.3C5.58886 13.3 6.55147 12.3374 6.55147 11.15H5.90147ZM4.40143 12.65V12C3.93195 12 3.55138 11.6194 3.55138 11.15H2.90138H2.25138C2.25138 12.3374 3.21399 13.3 4.40143 13.3V12.65ZM2.90138 11.15H3.55138C3.55138 10.6805 3.93195 10.3 4.40143 10.3V9.64996V8.99996C3.21399 8.99996 2.25138 9.96255 2.25138 11.15H2.90138ZM4.40143 9.64996V10.3C4.8709 10.3 5.25147 10.6805 5.25147 11.15H5.90147H6.55147C6.55147 9.96255 5.58886 8.99996 4.40143 8.99996V9.64996ZM15.6508 5.90014H15.0008V7.40017H15.6508H16.3008V5.90014H15.6508ZM12.1257 5.90014V6.55014H15.6508V5.90014V5.25014H12.1257V5.90014ZM15.6508 7.40017H15.0008C15.0008 8.30245 14.9995 8.91377 14.938 9.37099C14.879 9.80951 14.7757 10.0078 14.642 10.1414L15.1017 10.6011L15.5613 11.0607C15.9768 10.6452 16.1481 10.1269 16.2264 9.54421C16.3022 8.98024 16.3008 8.2657 16.3008 7.40017H15.6508ZM6.87558 0.650024V1.30002C7.76377 1.30002 8.05372 1.30804 8.27006 1.37834L8.47092 0.76015L8.67178 0.141962C8.21025 -0.00799471 7.66259 2.44379e-05 6.87558 2.44379e-05V0.650024ZM10.0257 3.80009H10.6757C10.6757 3.01309 10.6837 2.46543 10.5337 2.00391L9.91555 2.20477L9.29736 2.40563C9.36766 2.62197 9.37568 2.91191 9.37568 3.80009H10.0257ZM8.47092 0.76015L8.27006 1.37834C8.75718 1.53661 9.13909 1.91852 9.29736 2.40563L9.91555 2.20477L10.5337 2.00391C10.2469 1.12102 9.55467 0.428828 8.67178 0.141963L8.47092 0.76015ZM10.0257 3.80009H9.37568C9.37568 4.3079 9.36766 4.71596 9.48091 5.0645L10.0991 4.86364L10.7173 4.66278C10.6837 4.55942 10.6757 4.40908 10.6757 3.80009H10.0257ZM12.1257 5.90014V5.25014C11.5167 5.25014 11.3664 5.24212 11.263 5.20854L11.0622 5.82672L10.8613 6.44491C11.2099 6.55816 11.6179 6.55014 12.1257 6.55014V5.90014ZM10.0991 4.86364L9.48091 5.06451C9.69359 5.71906 10.2068 6.23223 10.8613 6.44491L11.0622 5.82672L11.263 5.20854C11.0043 5.12445 10.8014 4.92156 10.7173 4.66278L10.0991 4.86364ZM2.90046 11.1296L2.93282 10.4804C2.12862 10.4403 1.83891 10.3212 1.6592 10.1414L1.19958 10.6011L0.739965 11.0607C1.29059 11.6113 2.02716 11.7369 2.8681 11.7788L2.90046 11.1296ZM10.4012 11.1499L10.4012 10.4999L5.90146 10.5L5.90147 11.15L5.90148 11.8L10.4012 11.7999L10.4012 11.1499ZM13.4008 11.1296L13.4331 11.7788C14.2741 11.7369 15.0107 11.6113 15.5613 11.0607L15.1017 10.6011L14.642 10.1414C14.4623 10.3212 14.1726 10.4403 13.3684 10.4804L13.4008 11.1296ZM0.650391 0.650024V1.30002H6.87558V0.650024V2.44379e-05H0.650391V0.650024ZM0.671054 8.90021L0.0218602 8.93257C0.0637781 9.7735 0.189342 10.5101 0.739965 11.0607L1.19958 10.6011L1.6592 10.1414C1.4795 9.96175 1.36033 9.67204 1.32025 8.86785L0.671054 8.90021ZM0.650543 3.65001V4.30001H5.15068V3.65001V3.00001H0.650543V3.65001ZM0.650543 5.89978V6.54978H3.65063V5.89978V5.24978H0.650543V5.89978ZM10.0255 2.15002V2.80002H11.3915V2.15002V1.50002H10.0255V2.15002ZM14.6934 4.12219L14.1211 4.43038L15.0786 6.20834L15.6508 5.90014L16.2231 5.59195L15.2657 3.81399L14.6934 4.12219ZM11.3915 2.15002V2.80002C11.9503 2.80002 12.3214 2.80078 12.6097 2.82989C12.8834 2.85753 13.028 2.90664 13.1397 2.97335L13.473 2.41531L13.8063 1.85727C13.4738 1.65869 13.1234 1.57516 12.7403 1.53647C12.3718 1.49926 11.9243 1.50002 11.3915 1.50002V2.15002ZM14.6934 4.12219L15.2657 3.81402C15.0131 3.34493 14.8016 2.95057 14.5941 2.64373C14.3784 2.32473 14.1388 2.05586 13.8063 1.85727L13.473 2.41531L13.1397 2.97335C13.2513 3.04005 13.3631 3.14409 13.5172 3.37194C13.6795 3.61195 13.8562 3.93839 14.1211 4.43036L14.6934 4.12219Z"
                                fill="currentcolor"></path>
                        </svg>
                    </span>
                    <span>Estimate shipping rates</span>
                </h4>
                <div class="aq-cartmini-tools-field mb-10">
                    <div class="aq-cartmini-select aq-select mb-10">
                        <label>State / County</label>
                        <select>
                            <option>New York US</option>
                            <option>Berlin Germany</option>
                            <option>Paris France</option>
                            <option>Tokiyo Japan</option>
                        </select>
                    </div>
                    <form action="#">
                        <div class="aq-cartmini-tools-input">
                            <label>Postal/Zip Code</label>
                            <input type="text" placeholder="17080" />
                        </div>
                    </form>
                </div>
                <div class="aq-cartmini-tools-btn d-flex">
                    <button class="aq-btn-black btn-cancel border-btn w-100 text-center">
                        Cancel
                    </button>
                    <button class="aq-btn-black btn-red-bg w-100 text-center">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Cartmini area -->


    <!-- compare canvas -->

    <!-- Modal -->
    <div class="modal fade aq-product-modal" id="producQuickViewModal" role="dialog" tabindex="-1"
        aria-labelledby="producQuickViewModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="aq-product-modal-content">
                    <button type="button" class="aq-product-modal-close-btn" data-bs-toggle="modal"
                        data-bs-target="#producQuickViewModal" aria-label="Close product quick view modal">
                        <i class="fa-regular fa-xmark"></i>
                    </button>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-10">
                        <div class="aq-modal-slider-wrap">
                            <div class="swiper aq-modal-slider-active p-relative">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="aq-modal-slider">
                                            <img class="w-100"
                                                src="public/assets/img/corporate/product_1_front_img_1.webp" alt=""
                                                loading="lazy" />
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="aq-modal-slider">
                                            <img class="w-100"
                                                src="public/assets/img/corporate/product_2_front_img_1.webp" alt=""
                                                loading="lazy" />
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="aq-modal-slider">
                                            <img class="w-100"
                                                src="public/assets/img/corporate/product_3_front_img_1.webp" alt=""
                                                loading="lazy" />
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="aq-modal-slider">
                                            <img class="w-100"
                                                src="public/assets/img/corporate/product_4_front_img_1.webp" alt=""
                                                loading="lazy" />
                                        </div>
                                    </div>
                                </div>
                                <div class="aq-modal-slider-arrow">
                                    <button class="aq-modal-prev">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                viewBox="0 0 12 12" fill="none">
                                                <path d="M10.75 5.75H0.75M0.75 5.75L5.75 10.75M0.75 5.75L5.75 0.75"
                                                    stroke="currentcolor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </button>
                                    <button class="aq-modal-next">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                viewBox="0 0 12 12" fill="none">
                                                <path d="M0.75 5.75H10.75M10.75 5.75L5.75 0.75M10.75 5.75L5.75 10.75"
                                                    stroke="currentcolor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="aq-product-details-wrap pt-20">
                            <!-- product info  -->
                            <div class="aq-product-details-category">
                                <span>Girls Clothes</span>
                            </div>
                            <h3 class="aq-product-details-title mb-10">
                                Osette backpack Bags
                            </h3>

                            <!-- inventory details  -->
                            <div class="tp-product-details-inventory">
                                <div class="aq-product-details-rating-wrapper d-flex align-items-center">
                                    <div class="aq-product-details-rating-box d-flex align-items-center mb-10">
                                        <div class="aq-product-details-rating">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="13"
                                                    viewBox="0 0 14 13" fill="none">
                                                    <path
                                                        d="M6.6574 0L8.50892 4.4516L13.3148 4.83688L9.65322 7.9734L10.7719 12.6631L6.6574 10.15L2.5429 12.6631L3.66157 7.9734L0 4.83688L4.80587 4.4516L6.6574 0Z"
                                                        fill="currentcolor"></path>
                                                </svg>
                                            </span>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="13"
                                                    viewBox="0 0 14 13" fill="none">
                                                    <path
                                                        d="M6.6574 0L8.50892 4.4516L13.3148 4.83688L9.65322 7.9734L10.7719 12.6631L6.6574 10.15L2.5429 12.6631L3.66157 7.9734L0 4.83688L4.80587 4.4516L6.6574 0Z"
                                                        fill="currentcolor"></path>
                                                </svg>
                                            </span>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="13"
                                                    viewBox="0 0 14 13" fill="none">
                                                    <path
                                                        d="M6.6574 0L8.50892 4.4516L13.3148 4.83688L9.65322 7.9734L10.7719 12.6631L6.6574 10.15L2.5429 12.6631L3.66157 7.9734L0 4.83688L4.80587 4.4516L6.6574 0Z"
                                                        fill="currentcolor"></path>
                                                </svg>
                                            </span>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="13"
                                                    viewBox="0 0 14 13" fill="none">
                                                    <path
                                                        d="M6.6574 0L8.50892 4.4516L13.3148 4.83688L9.65322 7.9734L10.7719 12.6631L6.6574 10.15L2.5429 12.6631L3.66157 7.9734L0 4.83688L4.80587 4.4516L6.6574 0Z"
                                                        fill="currentcolor"></path>
                                                </svg>
                                            </span>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="13"
                                                    viewBox="0 0 14 13" fill="none">
                                                    <path
                                                        d="M6.6574 0L8.50892 4.4516L13.3148 4.83688L9.65322 7.9734L10.7719 12.6631L6.6574 10.15L2.5429 12.6631L3.66157 7.9734L0 4.83688L4.80587 4.4516L6.6574 0Z"
                                                        fill="currentcolor"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="aq-product-details-reviews">
                                            <span>( 1 review )</span>
                                        </div>
                                    </div>
                                    <div class="aq-product-details-fomo-mesg mb-10">
                                        <span><i>ðŸ”¥</i> 41 sold in last 16 hours</span>
                                    </div>
                                </div>
                            </div>

                            <!-- price info  -->
                            <div class="aq-product-details-price-wrap mb-30">
                                <ins><span class="aq-product-details-price new-price">$160.00</span></ins>
                            </div>

                            <!-- product-variation -->
                            <div class="aq-product-details-size mb-20">
                                <h4 class="aq-product-details-title-sm mb-15">
                                    <label>Size:</label> M
                                </h4>
                                <div class="aq-product-details-size-list">
                                    <button>XS</button>
                                    <button>S</button>
                                    <button>L</button>
                                    <button>M</button>
                                </div>
                            </div>

                            <!-- product-variation -->
                            <div class="aq-product-details-variation mb-30">
                                <h4 class="aq-product-details-title-sm mb-15">
                                    <label>Color:</label> Chestnut
                                </h4>
                                <div class="aq-product-details-variation-wrap d-flex align-items-center">
                                    <div class="aq-product-details-variation-item active">
                                        <img src="public/assets/img/corporate/product_1_front_img_1.webp" alt=""
                                            loading="lazy" />
                                    </div>
                                    <div class="aq-product-details-variation-item">
                                        <img src="public/assets/img/corporate/product_1_front_img_2.webp" alt=""
                                            loading="lazy" />
                                    </div>
                                    <div class="aq-product-details-variation-item">
                                        <img src="public/assets/img/corporate/product_1_front_img_3.webp" alt=""
                                            loading="lazy" />
                                    </div>
                                </div>
                            </div>

                            <!-- product-action -->
                            <div class="aq-product-details-action-wrapper mb-20">
                                <div class="aq-product-details-action-item-wrapper d-sm-flex align-items-center">
                                    <div class="aq-product-details-quantity">
                                        <div class="aq-product-quantity mb-10 mr-10">
                                            <span class="aq-cart-minus">
                                                <svg width="11" height="2" viewBox="0 0 11 2" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 1H10" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                            <input class="aq-cart-input" type="text" value="1" />
                                            <span class="aq-cart-plus">
                                                <svg width="11" height="12" viewBox="0 0 11 12" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 6H10" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M5.5 10.5V1.5" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div
                                        class="aq-product-details-add-to-cart product-btn-style-2 d-flex align-items-center mb-10 w-100">
                                        <button class="aq-product-details-add-to-cart-btn aq-btn-black radius-30 w-100">
                                            Add To Cart
                                        </button>
                                        <button type="button" class="aq-product-action-btn aq-tooltip-top">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16"
                                                viewBox="0 0 18 16" fill="none">
                                                <path
                                                    d="M14.7197 1.52347C12.5744 0.244089 10.7019 0.759666 9.57712 1.58092C9.11591 1.91766 8.88531 2.08602 8.74963 2.08602C8.61396 2.08602 8.38336 1.91766 7.92215 1.58092C6.79733 0.759666 4.9249 0.244089 2.77958 1.52347C-0.0359114 3.20253 -0.67299 8.7418 5.82126 13.4151C7.05821 14.3052 7.67668 14.7502 8.74963 14.7502C9.82258 14.7502 10.4411 14.3052 11.678 13.4151C18.1723 8.7418 17.5352 3.20253 14.7197 1.52347Z"
                                                    stroke="currentcolor" stroke-width="1.5" stroke-linecap="round">
                                                </path>
                                            </svg>
                                            <span class="aq-tooltip-item">Wishlist</span>
                                        </button>
                                        <button type="button"
                                            class="aq-product-action-btn aq-compare-btn aq-tooltip-top">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14"
                                                viewBox="0 0 16 14" fill="none">
                                                <path
                                                    d="M11.6755 5.91828L14.2612 3.33412M14.2612 3.33412L11.6755 0.75M14.2612 3.33412L1.74999 3.33374M3.33562 8.07153L0.75 10.6557L3.33562 13.2398M13.7724 10.75H1.26122"
                                                    stroke="currentcolor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                            <span class="aq-tooltip-item">Compare</span>
                                        </button>
                                    </div>
                                </div>
                                <button class="aq-product-details-buy-now-btn aq-btn-black btn-red-bg radius-30 w-100">
                                    Buy Now
                                </button>
                            </div>

                            <!-- product view details btn -->
                            <a class="product-view-details-btn aq-line-anim" href="#">
                                View Full Details
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"
                                        fill="none">
                                        <path d="M0.75 5.75H10.75M10.75 5.75L5.75 0.75M10.75 5.75L5.75 10.75"
                                            stroke="currentcolor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <!-- offcanvas area start -->
    <div class="aq-offcanvas-wrap">
        <div class="aq-offcanvas-top d-flex align-items-center justify-content-between">
            <div class="aq-offcanvas-logo">
                <a href="#"><img width="115" src="public/assets/img/corporate/logo.webp" alt="" /></a>
            </div>
            <div class="aq-offcanvas-close">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M10.75 0.75L0.75 10.75" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M0.75 0.75L10.75 10.75" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>
                </span>
            </div>
        </div>
        <div class="aq-offcanvas-menu-wrap">
            <div class="aq-offcanvas-menu">
                <nav></nav>
            </div>
        </div>
        <div class="aq-offcanvas-bottom">
            <div class="aq-offcanvas-btn-wrap d-flex justify-content-between align-items-center">
                <a class="aq-offcanvas-btn" href="#">Login</a>
                <a class="aq-offcanvas-btn btn-black-bg" href="#">Wishlist</a>
            </div>

        </div>
    </div>
    <!-- offcanvas area end -->

    <!-- Body Overlay -->
    <div class="body-overlay"></div>
    <!-- Body Overlay -->

    <!-- bottom-sticky header -->
    <div class="aq-bottom-menu d-md-none">
        <div class="container">
            <div class="row row-cols-5">
                <div class="col">
                    <a href="{{ route('home') }}">
                        <div class="aq-bottom-menu-item">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16"
                                    fill="none">
                                    <path
                                        d="M14.6336 6.77452L8.38359 0.374602C8.1492 0.13474 7.83138 0 7.5 0C7.16862 0 6.8508 0.13474 6.61641 0.374602L0.366414 6.77452C0.249777 6.89307 0.157319 7.03418 0.0944167 7.18964C0.0315145 7.34511 -0.000577075 7.51183 7.85428e-06 7.68011V15.36C7.85428e-06 15.5297 0.0658559 15.6925 0.183066 15.8126C0.300276 15.9326 0.459247 16 0.625007 16H5.625C5.79076 16 5.94973 15.9326 6.06694 15.8126C6.18415 15.6925 6.25 15.5297 6.25 15.36V10.8801H8.75V15.36C8.75 15.5297 8.81585 15.6925 8.93306 15.8126C9.05027 15.9326 9.20924 16 9.375 16H14.375C14.5408 16 14.6997 15.9326 14.8169 15.8126C14.9341 15.6925 15 15.5297 15 15.36V7.68011C15.0006 7.51183 14.9685 7.34511 14.9056 7.18964C14.8427 7.03418 14.7502 6.89307 14.6336 6.77452ZM13.75 14.72H10V10.2401C10 10.0703 9.93415 9.90755 9.81694 9.78753C9.69973 9.66751 9.54076 9.60008 9.375 9.60008H5.625C5.45924 9.60008 5.30027 9.66751 5.18306 9.78753C5.06585 9.90755 5 10.0703 5 10.2401V14.72H1.25001V7.68011L7.5 1.28019L13.75 7.68011V14.72Z"
                                        fill="#343330"></path>
                                </svg>
                            </i>
                            <span>Home</span>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="#">
                        <div class="aq-bottom-menu-item">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15"
                                    fill="none">
                                    <path
                                        d="M15.9093 14.0873C14.7389 12.1146 12.9352 10.7001 10.8303 10.0295C11.8715 9.42526 12.6804 8.50449 13.1329 7.40862C13.5854 6.31276 13.6563 5.10239 13.3349 3.9634C13.0135 2.82441 12.3174 1.81978 11.3537 1.10378C10.3899 0.387776 9.2117 0 8 0C6.7883 0 5.6101 0.387776 4.64633 1.10378C3.68257 1.81978 2.98653 2.82441 2.6651 3.9634C2.34368 5.10239 2.41464 6.31276 2.8671 7.40862C3.31955 8.50449 4.12848 9.42526 5.16965 10.0295C3.06476 10.6993 1.26112 12.1138 0.0907097 14.0873C0.0477887 14.1555 0.0193195 14.2314 0.00698187 14.3106C-0.00535579 14.3897 -0.00131202 14.4704 0.0188746 14.548C0.0390612 14.6256 0.0749818 14.6984 0.124517 14.7623C0.174052 14.8261 0.236198 14.8796 0.307289 14.9196C0.37838 14.9597 0.456975 14.9854 0.538437 14.9954C0.6199 15.0053 0.702579 14.9992 0.781598 14.9775C0.860616 14.9558 0.934373 14.9189 0.998516 14.8689C1.06266 14.819 1.11589 14.757 1.15507 14.6866C2.6029 12.2472 5.16197 10.7907 8 10.7907C10.838 10.7907 13.3971 12.2472 14.8449 14.6866C14.8841 14.757 14.9373 14.819 15.0015 14.8689C15.0656 14.9189 15.1394 14.9558 15.2184 14.9775C15.2974 14.9992 15.3801 15.0053 15.4616 14.9954C15.543 14.9854 15.6216 14.9597 15.6927 14.9196C15.7638 14.8796 15.8259 14.8261 15.8755 14.7623C15.925 14.6984 15.9609 14.6256 15.9811 14.548C16.0013 14.4704 16.0054 14.3897 15.993 14.3106C15.9807 14.2314 15.9522 14.1555 15.9093 14.0873ZM3.69646 5.39639C3.69646 4.56657 3.94886 3.7554 4.42174 3.06543C4.89462 2.37547 5.56674 1.83771 6.35311 1.52015C7.13948 1.2026 8.00478 1.11951 8.83958 1.2814C9.67438 1.44329 10.4412 1.84288 11.0431 2.42965C11.6449 3.01641 12.0548 3.764 12.2208 4.57786C12.3869 5.39173 12.3017 6.23533 11.976 7.00197C11.6502 7.76862 11.0986 8.42388 10.3909 8.8849C9.6832 9.34592 8.85116 9.59199 8 9.59199C6.85901 9.5908 5.76509 9.14838 4.95829 8.36181C4.15148 7.57524 3.69768 6.50876 3.69646 5.39639Z"
                                        fill="#343330"></path>
                                </svg>
                            </i>
                            <span>Account</span>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('categories') }}">
                        <div class="aq-bottom-menu-item">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15"
                                    fill="none">
                                    <path
                                        d="M16 5C16.0003 4.94189 15.9925 4.88403 15.9769 4.82812L14.8731 0.90625C14.7989 0.646027 14.6438 0.417159 14.431 0.253823C14.2182 0.0904875 13.959 0.00144761 13.6923 0H2.30769C2.04095 0.00144761 1.78182 0.0904875 1.56901 0.253823C1.3562 0.417159 1.20112 0.646027 1.12692 0.90625L0.0238466 4.82812C0.00795568 4.88399 -7.25706e-05 4.94185 4.94245e-07 5V6.25C4.94245e-07 6.73514 0.111216 7.21362 0.32484 7.64754C0.538463 8.08147 0.848627 8.45892 1.23077 8.75V14.375C1.23077 14.5408 1.2956 14.6997 1.41101 14.8169C1.52642 14.9342 1.68294 15 1.84615 15H14.1538C14.317 15 14.4736 14.9342 14.589 14.8169C14.7044 14.6997 14.7692 14.5408 14.7692 14.375V8.75C15.1514 8.45892 15.4615 8.08147 15.6751 7.64754C15.8888 7.21362 16 6.73514 16 6.25V5ZM2.30769 1.25H13.6923L14.5708 4.375H1.43154L2.30769 1.25ZM6.15384 5.625H9.84615V6.25C9.84615 6.74728 9.65164 7.22419 9.30542 7.57583C8.9592 7.92746 8.48963 8.125 8 8.125C7.51037 8.125 7.04079 7.92746 6.69457 7.57583C6.34835 7.22419 6.15384 6.74728 6.15384 6.25V5.625ZM4.92307 5.625V6.25C4.92296 6.57243 4.84099 6.88938 4.68507 7.17023C4.52915 7.45109 4.30455 7.68637 4.03297 7.85334C3.76139 8.02031 3.452 8.11333 3.13469 8.12342C2.81738 8.13351 2.50287 8.06033 2.22154 7.91094C2.17873 7.87709 2.13164 7.84924 2.08154 7.82812C1.82083 7.65861 1.60627 7.42524 1.4576 7.14947C1.30894 6.8737 1.23093 6.5644 1.23077 6.25V5.625H4.92307ZM13.5385 13.75H2.46154V9.3125C2.66412 9.35398 2.87026 9.37491 3.07692 9.375C3.5546 9.375 4.02572 9.26205 4.45296 9.04508C4.88021 8.82812 5.25185 8.51311 5.53846 8.125C5.82506 8.51311 6.19671 8.82812 6.62395 9.04508C7.0512 9.26205 7.52232 9.375 8 9.375C8.47767 9.375 8.94879 9.26205 9.37604 9.04508C9.80328 8.82812 10.1749 8.51311 10.4615 8.125C10.7481 8.51311 11.1198 8.82812 11.547 9.04508C11.9743 9.26205 12.4454 9.375 12.9231 9.375C13.1297 9.37491 13.3359 9.35398 13.5385 9.3125V13.75ZM13.9177 7.82812C13.8682 7.84928 13.8217 7.87686 13.7792 7.91016C13.4979 8.0597 13.1834 8.13304 12.866 8.12307C12.5487 8.11311 12.2392 8.0202 11.9675 7.85329C11.6959 7.68639 11.4712 7.45115 11.3152 7.1703C11.1591 6.88944 11.0771 6.57247 11.0769 6.25V5.625H14.7692V6.25C14.769 6.56447 14.6909 6.87382 14.542 7.1496C14.3932 7.42537 14.1785 7.6587 13.9177 7.82812Z"
                                        fill="#343330"></path>
                                </svg>
                            </i>
                            <span>Shop</span>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('wishlist') }}">
                        <div class="aq-bottom-menu-item">
                            <button class="p-relative">
                                <span class="count-box">{{ $wishlistCount ?? 0 }}</span>
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="15" viewBox="0 0 18 15"
                                        fill="none">
                                        <path
                                            d="M13.0179 0C11.3585 0 9.90563 0.693914 9 1.86685C8.09437 0.693914 6.64152 0 4.98214 0C3.66125 0.00144779 2.39489 0.512355 1.46088 1.42064C0.52687 2.32892 0.00148881 3.56039 0 4.84489C0 10.3149 8.34027 14.7425 8.69545 14.9254C8.78906 14.9744 8.8937 15 9 15C9.1063 15 9.21094 14.9744 9.30455 14.9254C9.65973 14.7425 18 10.3149 18 4.84489C17.9985 3.56039 17.4731 2.32892 16.5391 1.42064C15.6051 0.512355 14.3387 0.00144779 13.0179 0ZM9 13.6595C7.53268 12.828 1.28571 9.04041 1.28571 4.84489C1.28699 3.89193 1.67684 2.97835 2.36978 2.3045C3.06272 1.63065 4.00218 1.25154 4.98214 1.25029C6.54509 1.25029 7.85732 2.05986 8.40536 3.36017C8.45379 3.47483 8.53618 3.57289 8.64206 3.64191C8.74794 3.71093 8.87253 3.74778 9 3.74778C9.12747 3.74778 9.25206 3.71093 9.35794 3.64191C9.46382 3.57289 9.54621 3.47483 9.59464 3.36017C10.1427 2.05752 11.4549 1.25029 13.0179 1.25029C13.9978 1.25154 14.9373 1.63065 15.6302 2.3045C16.3232 2.97835 16.713 3.89193 16.7143 4.84489C16.7143 9.03416 10.4657 12.8272 9 13.6595Z"
                                            fill="#343330"></path>
                                    </svg>
                                </i>
                            </button>
                            <span>Wishlist</span>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <div class="aq-bottom-menu-item aq-cart-btn">
                        <button class="p-relative">
                            <span class="count-box">
                                {{ \App\Models\Cart::where('session_id', session()->getId())
    ->first()?->items()->sum('quantity') ?? 0 }}
                            </span>
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14"
                                    fill="none">
                                    <path
                                        d="M15.6923 0H1.30769C0.960871 0 0.628254 0.13409 0.383014 0.372773C0.137774 0.611456 0 0.935179 0 1.27273V12.7273C0 13.0648 0.137774 13.3885 0.383014 13.6272C0.628254 13.8659 0.960871 14 1.30769 14H15.6923C16.0391 14 16.3717 13.8659 16.617 13.6272C16.8622 13.3885 17 13.0648 17 12.7273V1.27273C17 0.935179 16.8622 0.611456 16.617 0.372773C16.3717 0.13409 16.0391 0 15.6923 0ZM15.6923 12.7273H1.30769V1.27273H15.6923V12.7273ZM12.4231 3.81818C12.4231 4.83083 12.0098 5.802 11.274 6.51804C10.5383 7.23409 9.54046 7.63636 8.5 7.63636C7.45954 7.63636 6.46169 7.23409 5.72597 6.51804C4.99025 5.802 4.57692 4.83083 4.57692 3.81818C4.57692 3.64941 4.64581 3.48755 4.76843 3.3682C4.89105 3.24886 5.05736 3.18182 5.23077 3.18182C5.40418 3.18182 5.57049 3.24886 5.69311 3.3682C5.81573 3.48755 5.88462 3.64941 5.88462 3.81818C5.88462 4.49328 6.16016 5.14072 6.65064 5.61809C7.14112 6.09546 7.80636 6.36364 8.5 6.36364C9.19364 6.36364 9.85888 6.09546 10.3494 5.61809C10.8398 5.14072 11.1154 4.49328 11.1154 3.81818C11.1154 3.64941 11.1843 3.48755 11.3069 3.3682C11.4295 3.24886 11.5958 3.18182 11.7692 3.18182C11.9426 3.18182 12.109 3.24886 12.2316 3.3682C12.3542 3.48755 12.4231 3.64941 12.4231 3.81818Z"
                                        fill="#343330"></path>
                                </svg>
                            </i>
                        </button>
                        <span>Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bottom-sticky header -->

    <header>
        <!-- header area start -->
        <!-- top bar area start -->

        <!-- Offer Bar -->

        <div class="offer-bar">

            <div class="offer-slider">

                @foreach($announcements as $announcement)

                    <div class="offer-item {{ $loop->first ? 'active' : '' }}">

                        @if($announcement->link)

                            <a href="{{ $announcement->link }}" style="color: inherit; text-decoration:none;">

                                <span>
                                    {{ $announcement->title }}
                                </span>

                            </a>

                        @else

                            <span>
                                {{ $announcement->title }}
                            </span>

                        @endif

                    </div>

                @endforeach

            </div>

        </div>
        <!-- top bar area end -->

        <div class="aq-header-top-area aq-header-top-bdr" style="background: #00310814">
            <div class="container container-1830">
                <div class="row align-items-center">
                    <div class="col-2">
                        <div class="aq-header-logo text-center pt-10 pb-10">
                            <a href="{{ url('/') }}">
                                <img data-width="100" src="{{ asset('assets/img/corporate/logo.webp') }}" alt="Logo" />
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6 col-7">
                        <div class="aq-header-search-box">
                            <form action="{{ route('search.suggestions') }}" method="GET" autocomplete="off">
                                <div class="aq-search-input-wrap">
                                    <input type="text" id="searchInput" name="q"
                                        placeholder="Search premium gifts, corporate hampers, brands..." />

                                    <button type="submit" class="aq-search-btn">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>

                                    <div id="searchSuggestions" class="search-suggestions"></div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-4 col-3">
                        <div class="aq-header-right-options text-end">
                            <ul class="d-flex justify-content-center align-items-center">
                                <li class="aq-header-top-bulk-orders d-none d-lg-inline-block">
                                    <a href="{{ route('bulk-order') }}" class="aq-bulk-orders-btn">
                                        <i>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path
                                                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                                </path>
                                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                            </svg>
                                        </i>
                                        <span>Bulk Orders</span>
                                    </a>
                                </li>
                                <li class="aq-header-top-wishlist d-none d-md-inline-block">
                                    <a href="{{ route('wishlist') }}">

                                        <span class="count-box">
                                            {{ $wishlistCount ?? 0 }}
                                        </span>

                                        <i>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
                                                viewBox="0 0 21 20" fill="none">
                                                <path
                                                    d="M6.50726 4.80303C5.44195 5.14334 4.68503 6.09974 4.59044 7.22502M10.4856 18.6038C12.6562 17.2679 14.6755 15.6957 16.5073 13.9152C17.7951 12.633 18.7756 11.0698 19.3735 9.3454C20.4494 6.00032 19.1927 2.17084 15.6755 1.03753C13.827 0.442448 11.8081 0.782566 10.2505 1.95149C8.69225 0.783989 6.67412 0.443991 4.82552 1.03753C1.30833 2.17084 0.0425004 6.00032 1.11845 9.3454C1.71636 11.0698 2.69679 12.633 3.98465 13.9152C5.81647 15.6957 7.83575 17.2679 10.0064 18.6038L10.2414 18.75L10.4856 18.6038Z"
                                                    stroke="currentcolor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                </path>
                                            </svg>
                                        </i>

                                    </a>
                                </li>
                                <li class="aq-header-top-cart aq-cart-btn">
                                    <button>
                                        <span class="count-box">
                                            {{ \App\Models\Cart::where('session_id', session()->getId())
    ->first()?->items()->sum('quantity') ?? 0 }}
                                        </span>
                                        <i>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21"
                                                viewBox="0 0 20 21" fill="none">
                                                <path
                                                    d="M5.48681 5.07041C5.48681 2.68433 7.4211 0.750039 9.80717 0.750039C10.9562 0.74517 12.0598 1.1982 12.874 2.00895C13.6882 2.81971 14.1459 3.92139 14.1458 5.07041M6.84107 9.57384H6.88684M12.6721 9.57388H12.7179M5.62368 19.972H13.9715C17.0379 19.972 19.3903 18.8645 18.7221 14.4068L17.944 8.3656C17.5321 6.14134 16.1134 5.29008 14.8685 5.29008H4.69004C3.42688 5.29008 2.0905 6.20542 1.61453 8.3656L0.836493 14.4068C0.268988 18.361 2.55732 19.972 5.62368 19.972Z"
                                                    stroke="currentcolor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $menuOccasions = \App\Models\GiftingOccasion::where('status', 1)
                ->orderBy('title')
                ->get();

            $menuCategories = \App\Models\Category::whereNull('parent_id')
                ->where('status', 1)
                ->where('show_on_website', 1)
                ->orderBy('sort_order')
                ->get();
        @endphp

        <div class="aq-header-bottom-area p-relative" data-bg-color="rgba(0, 49, 8, 0.08)">
            <div class="container">
                <!-- Mobile Menu Toggle -->
                <div class="row align-items-center d-xl-none py-2">
                    <div class="col-12 text-center">
                        <button
                            class="aq-offcanvas-toggle d-flex align-items-center justify-content-center gap-2 m-auto"
                            style="background: transparent; border: none; font-size: 16px; font-weight: 600; cursor: pointer; color: #000;">
                            <i class="fa-solid fa-bars"></i> Menu
                        </button>
                    </div>
                </div>
                <!-- Desktop Menu -->
                <div class="row justify-content-center d-none d-xl-flex">
                    <div class="col-xl-12">
                        <div class="aq-header-menu aq-header-dropdown text-center">
                            <nav class="aq-mobile-menu-active">
                                <ul>
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('about-us') }}">About Us</a></li>
                                    <li class="has-dropdown p-static">
                                        <a href="#">Corporate Gifting</a>
                                        <div class="aq-megamenu-wrap aq-corp-megamenu mega-menu">
                                            <div class="container">
                                                <div class="aq-corp-megamenu-inner">
                                                    <div class="aq-corp-megamenu-col">
                                                        <h6 class="aq-corp-megamenu-heading">
                                                            MARKETING OPTIONS
                                                        </h6>

                                                        <ul>
                                                            <li>
                                                                <a
                                                                    href="{{ route('products', ['filter' => 'featured']) }}">
                                                                    Featured Products
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a
                                                                    href="{{ route('products', ['filter' => 'new_arrivals']) }}">
                                                                    New Arrivals
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('products', ['filter' => 'sale']) }}">
                                                                    Exclusive on Sale
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a
                                                                    href="{{ route('products', ['filter' => 'best_sellers']) }}">
                                                                    Best Sellers
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="aq-corp-megamenu-col">
                                                        <h6 class="aq-corp-megamenu-heading">
                                                            BY OCCASION
                                                        </h6>

                                                        <ul>
                                                            @forelse($menuOccasions as $occasion)
                                                                <li>
                                                                    <a
                                                                        href="{{ route('products', ['occasion' => $occasion->slug]) }}">
                                                                        {{ $occasion->title }}
                                                                    </a>
                                                                </li>
                                                            @empty
                                                                <li>
                                                                    <a href="#">No Occasions Found</a>
                                                                </li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                    <div class="aq-corp-megamenu-col">
                                                        <h6 class="aq-corp-megamenu-heading">
                                                            BY BUDGET
                                                        </h6>

                                                        <ul>
                                                            <li>
                                                                <a
                                                                    href="{{ route('products', ['budget' => 'under-500']) }}">
                                                                    Under ₹500
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a
                                                                    href="{{ route('products', ['budget' => '500-1000']) }}">
                                                                    ₹500 – ₹1,000
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a
                                                                    href="{{ route('products', ['budget' => '1000-2000']) }}">
                                                                    ₹1,000 – ₹2,000
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a
                                                                    href="{{ route('products', ['budget' => '2000-5000']) }}">
                                                                    ₹2,000 – ₹5,000
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a
                                                                    href="{{ route('products', ['budget' => 'above-5000']) }}">
                                                                    Above ₹5,000
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="aq-corp-megamenu-col">
                                                        <div class="aq-corp-megamenu-col">
                                                            <h6 class="aq-corp-megamenu-heading">
                                                                BY COLLECTIONS
                                                            </h6>

                                                            <ul>
                                                                <li>
                                                                    <a
                                                                        href="{{ route('products', ['collection' => 'premium']) }}">
                                                                        Premium Products
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a
                                                                        href="{{ route('products', ['collection' => 'engravings']) }}">
                                                                        Engravings
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a
                                                                        href="{{ route('products', ['collection' => 'personalized-engraving']) }}">
                                                                        Personalized Engraving
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="has-dropdown p-static">
                                        <a href="#">Categories</a>

                                        <div class="aq-megamenu-wrap aq-megamenu-img-wrap mega-menu">
                                            <div class="container">

                                                <div
                                                    class="row row-cols-xl-6 row-cols-lg-3 row-cols-md-2 row-cols-1 gx-20">

                                                    @foreach($menuCategories as $category)

                                                        <div class="col">
                                                            <div class="aq-megamenu-img-item mb-20">

                                                                <a href="{{ url('category/' . $category->slug) }}">

                                                                    <div class="aq-megamenu-img">

                                                                        @if($category->image)
                                                                            <img src="{{ asset('storage/' . $category->image) }}"
                                                                                alt="{{ $category->name }}" loading="lazy">
                                                                        @else
                                                                            <img src="{{ asset('assets/images/no-image.png') }}"
                                                                                alt="{{ $category->name }}" loading="lazy">
                                                                        @endif

                                                                    </div>

                                                                    <span class="aq-megamenu-img-title">
                                                                        {{ $category->name }}
                                                                    </span>

                                                                </a>

                                                            </div>
                                                        </div>

                                                    @endforeach

                                                </div>

                                            </div>
                                        </div>
                                    </li>


                                    <li class="has-dropdown">
                                        <a href="#">Occasions</a>

                                        <ul class="submenu">

                                            @forelse($menuOccasions as $occasion)

                                                <li>
                                                    <a href="{{ route('products', ['occasion' => $occasion->slug]) }}">
                                                        {{ $occasion->title }}
                                                    </a>
                                                </li>

                                            @empty

                                                <li>
                                                    <a href="#">No Occasions Found</a>
                                                </li>

                                            @endforelse

                                        </ul>
                                    </li>
                                    <li><a href="{{ route('personalised-engraving') }}">Custom Gifting</a></li>
                                    <li><a href="{{ route('bulk-order') }}">Bulk Orders</a></li>
                                    <li><a href="{{ route('blogs') }}">Blogs</a></li>
                                    <li><a href="{{ route('contact-us') }}">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header area end -->
    </header>

    @yield('content')

    <footer>
        <!-- footer area start -->
        <div class="aq-footer-area-luxury p-relative">
            <div class="aq-footer-shape-top"></div>

            <div class="container">
                <div class="aq-footer-main pt-30 pb-30">
                    <div class="row">
                        <!-- Column 1: Branding & Intro -->
                        <div class="col-xl-4 col-lg-4 col-md-12">
                            <div class="aq-footer-widget footer-col-brand mb-50">
                                <div class="aq-footer-logo-luxury mb-35">
                                    <a href="{{ route('home') }}">
                                        @if(!empty($footerSetting?->logo))
                                            <img src="{{ asset($footerSetting->logo) }}" alt="Logo"
                                                style="filter: brightness(0) invert(1); width:180px">
                                        @endif
                                    </a>
                                </div>
                                @if(!empty($footerSetting?->about_text))
                                    <p class="aq-footer-intro-text">
                                        {!! nl2br(e($footerSetting->about_text)) !!}
                                    </p>
                                @endif
                                <div class="aq-footer-social-luxury mt-40">

                                    @if($footerSetting->facebook)
                                        <a href="{{ $footerSetting->facebook }}" target="_blank" class="social-icon">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a>
                                    @endif

                                    @if($footerSetting->twitter)
                                        <a href="{{ $footerSetting->twitter }}" target="_blank" class="social-icon">
                                            <i class="fa-brands fa-twitter"></i>
                                        </a>
                                    @endif

                                    @if($footerSetting->linkedin)
                                        <a href="{{ $footerSetting->linkedin }}" target="_blank" class="social-icon">
                                            <i class="fa-brands fa-linkedin-in"></i>
                                        </a>
                                    @endif

                                    @if($footerSetting->instagram)
                                        <a href="{{ $footerSetting->instagram }}" target="_blank" class="social-icon">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <!-- Column 3: Company -->
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                            <div class="aq-footer-widget mb-50">
                                <h4 class="aq-footer-title-luxury">
                                    <i class="fa-solid fa-building-columns mr-10"></i> Company
                                </h4>
                                <ul class="aq-footer-menu-luxury">
                                    <li>
                                        <a href="{{ route('about-us') }}"><i class="fa-solid fa-chevron-right"></i>
                                            About Us</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('why-us') }}"><i class="fa-solid fa-chevron-right"></i> Why
                                            Choose
                                            Us</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('contact-us') }}"><i class="fa-solid fa-chevron-right"></i>
                                            Contact Us</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('awards') }}"><i class="fa-solid fa-chevron-right"></i> Awards
                                            &
                                            Recognition</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blogs') }}"><i class="fa-solid fa-chevron-right"></i>
                                            Blogs</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('recycling-pledge') }}"><i
                                                class="fa-solid fa-chevron-right"></i> Recycling
                                            Pledge</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('engraving-gallery') }}"><i
                                                class="fa-solid fa-chevron-right"></i> Engraving
                                            Gallery</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('personalised-engraving') }}"><i
                                                class="fa-solid fa-chevron-right"></i> Personalised
                                            Engraving</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 4: Quick Links -->
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                            <div class="aq-footer-widget mb-50">
                                <h4 class="aq-footer-title-luxury">
                                    <i class="fa-solid fa-link mr-10"></i> Quick Links
                                </h4>
                                <ul class="aq-footer-menu-luxury">
                                    <li>
                                        <a href="{{ route('categories') }}"><i class="fa-solid fa-chevron-right"></i>
                                            Browse All
                                            Categories</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('products', ['filter' => 'new_arrivals']) }}"><i
                                                class="fa-solid fa-chevron-right"></i> New
                                            Arrivals</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('membership') }}"><i class="fa-solid fa-chevron-right"></i>
                                            B2B Club
                                            Membership</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('vendors') }}"><i class="fa-solid fa-chevron-right"></i>
                                            Partner /
                                            Vendor Inquiry</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('bulk-order') }}"><i class="fa-solid fa-chevron-right"></i>
                                            Bulk Order
                                            Inquiry</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('faqs') }}"><i class="fa-solid fa-chevron-right"></i> FAQ</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 2: Get in Touch -->
                        <div class="col-xl-4 col-lg-4 col-md-12">
                            <div class="aq-footer-widget mb-50">
                                <h4 class="aq-footer-title-luxury">
                                    <i class="fa-solid fa-headset mr-10"></i> GET IN TOUCH
                                </h4>
                                <div class="aq-footer-contact-luxury">
                                    <div class="aq-contact-item-luxury">
                                        <div class="aq-contact-icon-box">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </div>
                                        <div class="aq-contact-content-luxury">
                                            <h6>ADDRESS</h6>
                                            @if(!empty($footerSetting?->address))
                                                <p>{{ $footerSetting->address }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="aq-contact-item-luxury">
                                        <div class="aq-contact-icon-box">
                                            <i class="fa-solid fa-phone"></i>
                                        </div>
                                        <div class="aq-contact-content-luxury">
                                            <h6>PHONE</h6>
                                            @if(!empty($footerSetting?->phone))
                                                <p>{{ $footerSetting->phone }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="aq-contact-item-luxury">
                                        <a href="https://wa.me/91XXXXXXXXXX" target="_blank">
                                            <div class="aq-contact-icon-box">
                                                <i class="fa-brands fa-whatsapp"></i>
                                            </div>
                                        </a>
                                        <div class="aq-contact-content-luxury">
                                            <h6>WHATSAPP</h6>
                                            @if(!empty($footerSetting?->whatsapp))
                                                <p>
                                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $footerSetting->whatsapp) }}"
                                                        target="_blank">

                                                        {{ $footerSetting->whatsapp }}

                                                    </a>
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="aq-contact-item-luxury">
                                        <div class="aq-contact-icon-box">
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                        <div class="aq-contact-content-luxury">
                                            <h6>EMAIL</h6>
                                            @if(!empty($footerSetting?->email))
                                                <p>{{ $footerSetting->email }}</p>
                                            @endif

                                            @if(!empty($footerSetting?->email2))
                                                <p>{{ $footerSetting->email2 }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="aq-footer-divider my-40"></div>

                    <!-- Lower Footer: Disclaimer & Policies -->
                    <div class="row align-items-center">
                        <div class="col-xl-12 col-lg-12">
                            <div class="aq-footer-policy-links text-center mb-20 mt-10">
                                @foreach($footerPages as $page)
                                    <a href="{{ route('dynamic.page', \Illuminate\Support\Str::slug($page->page_name)) }}">
                                        {{ $page->page_name }}</a>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12">
                            <div class="aq-footer-disclaimer mb-20 mt-10">
                                <p>
                                    <strong>Disclaimer:</strong> Oudhyana Chikankaari provides
                                    corporate gifting solutions only to businesses,
                                    institutions, and registered entities. All prices are
                                    exclusive of taxes. Product images are for representation
                                    only. Actual product may vary slightly. We are not
                                    responsible for any typographical errors. All trademarks and
                                    brand names belong to their respective owners.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="aq-footer-bottom-luxury">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center text-md-start">
                            <p class="copyright-text">
                                Â© 2026 <span>Oudhyana Chikankaari</span>. All Rights Reserved.
                            </p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <p class="copyright-create">
                                Designed & Developed by
                                <a href="#" target="_blank">Webmingo</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer area end -->
        <!-- footer area end -->

        <!-- footer area end -->

        <div class="footer_whatspp">

            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $footerSetting->whatsapp) }}" target="_blank"
                class="social-whatspp" title="WhatsApp">

                <i class="fa-brands fa-whatsapp"></i>

            </a>
        </div>
    </footer>

    <!-- Floating Action Buttons -->
    <div class="floating-buttons" style="
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 15px;
      ">

    </div>

    <style>
        /* Header Bulk Orders Button Styles */
        .aq-load-more-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: var(--aq-color-#003108, #003108);
            padding: 8px 18px;
            border-radius: 30px;
            font-family: var(--aq-ff-heading), sans-serif;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(104, 71, 66, 0.2);
            text-decoration: none;
            margin-right: 15px;
            border: 1px solid var(--aq-color-#003108, #003108);
        }

        .aq-load-more-btn:hover {
            background-color: #000000;
            border-color: #000000;
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
        }

        .aq-load-more-btn i {
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        .aq-load-more-btn:hover i {
            transform: scale(1.1) rotate(5deg);
        }

        .aq-bulk-orders-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: var(--aq-color-#003108, #003108);
            color: #ffffff !important;
            padding: 8px 18px;
            border-radius: 30px;
            font-family: var(--aq-ff-heading), sans-serif;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(104, 71, 66, 0.2);
            text-decoration: none;
            margin-right: 15px;
            border: 1px solid var(--aq-color-#003108, #003108);
        }

        .aq-bulk-orders-btn:hover {
            background-color: #000000;
            border-color: #000000;
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
        }

        .aq-bulk-orders-btn i {
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        .aq-bulk-orders-btn:hover i {
            transform: scale(1.1) rotate(5deg);
        }

        /* Bulk Order Form Focus Styling */
        #bulkOrderModal .form-control:focus,
        #bulkOrderModal .form-select:focus {
            border-color: var(--aq-color-#003108, #003108) !important;
            box-shadow: 0 0 0 0.25rem rgba(104, 71, 66, 0.15) !important;
            outline: 0;
        }

        /* Floating WhatsApp Button Premium Styles */
        .footer_whatspp {
            position: fixed;
            right: 40px;
            bottom: 40px;
            z-index: 9999;
            transition:
                bottom 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275),
                opacity 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .footer_whatspp.scrolled {
            bottom: 120px;
        }

        .social-whatspp {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #25d366;
            /* background: linear-gradient(135deg, #25D366 0%, #128C7E 100%); */
            color: #ffffff !important;
            font-size: 32px;
            box-shadow: 0 8px 24px rgba(37, 211, 102, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            text-decoration: none;
        }

        /* Glowing Pulse Wave Effect for Premium Feel */
        .social-whatspp::before,
        .social-whatspp::after {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: #25d366;
            opacity: 0.4;
            z-index: -1;
            transition: all 0.3s ease;
        }

        .social-whatspp::before {
            animation: wa-pulse 2s infinite;
        }

        .social-whatspp::after {
            animation: wa-pulse 2s infinite 0.6s;
        }

        @keyframes wa-pulse {
            0% {
                transform: scale(1);
                opacity: 0.4;
            }

            100% {
                transform: scale(1.6);
                opacity: 0;
            }
        }

        .social-whatspp:hover {
            transform: scale(1.1) rotate(8deg);
            box-shadow: 0 12px 30px rgba(37, 211, 102, 0.55);
            background: linear-gradient(135deg, #2ae06d 0%, #149b8b 100%);
        }

        .social-whatspp i {
            transition: transform 0.3s ease;
        }

        .social-whatspp:hover i {
            transform: scale(1.05);
        }

        /* Mobile adjustment for WhatsApp button position */
        @media (max-width: 768px) {
            .footer_whatspp {
                right: 20px;
                bottom: 30px;
            }

            .footer_whatspp.scrolled {
                bottom: 95px;
                /* Slightly lower on mobile to fit the mobile layout perfectly */
            }

            .social-whatspp {
                width: 50px;
                height: 50px;
                font-size: 26px;
            }
        }

        .whatsapp-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
        }

        .enquiry-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(184, 115, 51, 0.4);
            background: #9e622b;
        }

        .submenu {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;

            min-width: 220px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            list-style: none;
            padding: 15px 0;
            text-align: left;
            z-index: 99;
        }

        li.has-dropdown:hover>.submenu {
            opacity: 1;
            visibility: visible;
            top: 110%;
        }

        .submenu li a {
            display: block;
            padding: 8px 25px;
            color: #333;
            font-size: 14px;
            transition: all 0.3s;
        }

        .submenu li a:hover {
            color: #003108;
            padding-left: 30px;
        }

        /* Mobile adjustments for floating buttons */
        @media (max-width: 768px) {
            .floating-buttons {
                bottom: 20px;
                right: 20px;
                gap: 10px;
            }

            .enquiry-btn {
                padding: 10px 18px;
                font-size: 13px;
            }

            .whatsapp-btn {
                width: 50px;
                height: 50px;
            }
        }
    </style>

    <!-- JS here -->
    <script src="{{ asset('assets/js/vendor/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap-bundle.min.js')}}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js')}}"></script>
    <script src="{{ asset('assets/js/magnific-popup.min.js')}}"></script>
    <script src="{{ asset('assets/js/nice-select.min.js')}}"></script>
    <script src="{{ asset('assets/js/purecounter.min.js')}}"></script>
    <script src="{{ asset('assets/js/isotope-pkgd.min.js')}}"></script>
    <script src="{{ asset('assets/js/lazysize.min.js')}}"></script>
    <script src="{{ asset('assets/js/slider-active.min.js')}}"></script>
    <script src="{{ asset('assets/js/imagesloaded-pkgd.min.js')}}"></script>
    <script src="{{ asset('assets/js/ajax-form.min.js')}}"></script>
    <script src="{{ asset('assets/js/main.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Premium Creative Hero Slider Controller -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const slides = document.querySelectorAll(".aqf-hero-slide");
            const dots = document.querySelectorAll(".aqf-hero-dot");
            let currentSlide = 0;
            const slideInterval = 6500; // 6.5 seconds per slide
            let slideTimer;

            function showSlide(index) {
                // Reset zoom state on current active slide bg before switching
                const activeSlideBg = document.querySelector(
                    ".aqf-hero-slide.active .aqf-hero-bg",
                );
                if (activeSlideBg) {
                    activeSlideBg.style.transition = "none";
                    activeSlideBg.style.transform = "scale(1.18)";
                    // Force layout repaint
                    activeSlideBg.offsetHeight;
                }

                // Remove active classes
                slides.forEach((slide) => slide.classList.remove("active"));
                dots.forEach((dot) => dot.classList.remove("active"));

                // Set new active slide
                currentSlide = index;
                slides[currentSlide].classList.add("active");
                dots[currentSlide].classList.add("active");

                // Set smooth transition back for the active slide bg
                const newActiveBg =
                    slides[currentSlide].querySelector(".aqf-hero-bg");
                if (newActiveBg) {
                    newActiveBg.style.transition =
                        "transform 7.5s cubic-bezier(0.1, 0.1, 0.25, 1)";
                    // Force layout repaint
                    newActiveBg.offsetHeight;
                    newActiveBg.style.transform = "scale(1)";
                }

                // Reset and start timer
                resetTimer();
            }

            function nextSlide() {
                let next = (currentSlide + 1) % slides.length;
                showSlide(next);
            }

            function resetTimer() {
                clearInterval(slideTimer);
                slideTimer = setInterval(nextSlide, slideInterval);
            }

            // Add click events to dots
            dots.forEach((dot) => {
                dot.addEventListener("click", function () {
                    const slideIndex = parseInt(this.getAttribute("data-slide"));
                    showSlide(slideIndex);
                });
            });

            // Initialize the zoom animation on first active slide
            setTimeout(() => {
                const firstBg = slides[0].querySelector(".aqf-hero-bg");
                if (firstBg) {
                    firstBg.style.transition =
                        "transform 7.5s cubic-bezier(0.1, 0.1, 0.25, 1)";
                    firstBg.style.transform = "scale(1)";
                }
            }, 150);

            // Start slideshow
            resetTimer();

            // ==========================================
            // Premium Deals Banner Slider Controller
            // ==========================================
            const dealsSlides = document.querySelectorAll(
                ".aqf-deals-banner-slide",
            );
            const dealsDots = document.querySelectorAll(".aqf-deals-banner-dot");
            let currentDealsSlide = 0;
            const dealsSlideInterval = 5500; // 5.5 seconds per slide
            let dealsSlideTimer;

            function showDealsSlide(index) {
                // Reset scale on current active slide img before switching
                const activeImg = document.querySelector(
                    ".aqf-deals-banner-slide.active .aqf-deals-banner-thumb img",
                );
                if (activeImg) {
                    activeImg.style.transition = "none";
                    activeImg.style.transform = "scale(1.15)";
                    activeImg.offsetHeight; // force repaint
                }

                // Remove classes
                dealsSlides.forEach((slide) => slide.classList.remove("active"));
                dealsDots.forEach((dot) => dot.classList.remove("active"));

                // Set active classes
                currentDealsSlide = index;
                dealsSlides[currentDealsSlide].classList.add("active");
                dealsDots[currentDealsSlide].classList.add("active");

                // Set transition on new active slide img
                const newImg = dealsSlides[currentDealsSlide].querySelector(
                    ".aqf-deals-banner-thumb img",
                );
                if (newImg) {
                    newImg.style.transition =
                        "transform 6s cubic-bezier(0.1, 0.1, 0.25, 1)";
                    newImg.offsetHeight; // force repaint
                    newImg.style.transform = "scale(1)";
                }

                // Reset and start timer
                resetDealsTimer();
            }

            function nextDealsSlide() {
                let next = (currentDealsSlide + 1) % dealsSlides.length;
                showDealsSlide(next);
            }

            function resetDealsTimer() {
                clearInterval(dealsSlideTimer);
                dealsSlideTimer = setInterval(nextDealsSlide, dealsSlideInterval);
            }

            // Add clicks to deals dots
            dealsDots.forEach((dot) => {
                dot.addEventListener("click", function () {
                    const slideIndex = parseInt(this.getAttribute("data-deals-slide"));
                    showDealsSlide(slideIndex);
                });
            });

            // Initialize zoom on first active deals slide
            setTimeout(() => {
                const firstDealsImg = dealsSlides[0].querySelector(
                    ".aqf-deals-banner-thumb img",
                );
                if (firstDealsImg) {
                    firstDealsImg.style.transition =
                        "transform 6s cubic-bezier(0.1, 0.1, 0.25, 1)";
                    firstDealsImg.style.transform = "scale(1)";
                }
            }, 200);

            // Start deals timer
            resetDealsTimer();

            // ==========================================
            // Floating WhatsApp Scroll Behavior
            // ==========================================
            const whatsappBtn = document.querySelector(".footer_whatspp");
            if (whatsappBtn) {
                // Check initial scroll position in case of page refresh/restore
                if (window.scrollY > 12) {
                    whatsappBtn.classList.add("scrolled");
                }

                window.addEventListener(
                    "scroll",
                    function () {
                        if (window.scrollY > 12) {
                            whatsappBtn.classList.add("scrolled");
                        } else {
                            whatsappBtn.classList.remove("scrolled");
                        }
                    },
                    { passive: true },
                );
            }
        });
    </script>

    <!-- Video Lightbox -->
    <div id="aqf-video-lightbox" class="aqf-video-lightbox">
        <div class="aqf-lightbox-overlay"></div>
        <button class="aqf-lightbox-close" aria-label="Close video lightbox">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <button class="aqf-lightbox-prev" aria-label="Previous video">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button class="aqf-lightbox-next" aria-label="Next video">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        <div class="aqf-lightbox-content">
            <div class="aqf-lightbox-video-wrapper">
                <video id="aqf-lightbox-video" controls autoplay playsinline></video>
            </div>
        </div>
    </div>

    <!-- Lazy-Loading Video Observer -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var lazyVideos = [].slice.call(
                document.querySelectorAll(".aqf-reel-video video"),
            );

            if ("IntersectionObserver" in window) {
                var videoObserver = new IntersectionObserver(
                    function (entries, observer) {
                        entries.forEach(function (videoEntry) {
                            if (videoEntry.isIntersecting) {
                                var video = videoEntry.target;
                                if (video.dataset.src) {
                                    video.src = video.dataset.src;
                                    video.load();
                                    video.play().catch(function (e) {
                                        console.log("Video autoplay prevented: ", e);
                                    });
                                    videoObserver.unobserve(video);
                                }
                            }
                        });
                    },
                    {
                        rootMargin: "0px 0px 300px 0px", // Load 300px before coming into view
                    },
                );

                lazyVideos.forEach(function (video) {
                    videoObserver.observe(video);
                });
            } else {
                // Fallback for older browsers
                lazyVideos.forEach(function (video) {
                    if (video.dataset.src) {
                        video.src = video.dataset.src;
                        video.load();
                    }
                });
            }
        });
    </script>

    <!-- Bulk Orders Modal -->
    <div class="modal fade" id="bulkOrderModal" role="dialog" aria-hidden="true" aria-labelledby="bulkOrderModalLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="
            border-radius: 20px;
            overflow: hidden;
            border: none;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
          ">
                <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close"
                    style="
              top: 20px;
              right: 20px;
              z-index: 10;
              filter: grayscale(1) invert(0);
              background-color: rgba(255, 255, 255, 0.8);
              border-radius: 50%;
              padding: 10px;
            "></button>
                <div class="row g-0">
                    <!-- Modal Left Image/Theme Column -->
                    <div class="col-lg-5 d-none d-lg-block" style="
                background:
                  linear-gradient(
                    135deg,
                    rgba(104, 71, 66, 0.95) 0%,
                    rgba(0, 0, 0, 0.9) 100%
                  ),
                  url(&quot;assets/img/corporate/hero_gift_box_1778667986732.webp&quot;)
                    center/cover no-repeat;
                padding: 40px;
                color: #fff;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                position: relative;
              ">
                        <div>
                            <div class="mb-4">
                                <img src="public/assets/img/corporate/logo.webp" alt="B2B Gifts Logo"
                                    style="max-width: 120px; filter: brightness(0) invert(1)" />
                            </div>
                            <h3 class="font-family-heading mb-3" style="font-weight: 700; color: #fff; font-size: 26px">
                                Luxury Volume Curation
                            </h3>
                            <p style="
                    color: rgba(255, 255, 255, 0.8);
                    font-size: 14px;
                    line-height: 1.6;
                  ">
                                Partner with India's leading corporate design team for bespoke
                                gifting experiences that elevate your brand prestige.
                            </p>
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div style="
                      width: 40px;
                      height: 40px;
                      background: rgba(255, 255, 255, 0.1);
                      border-radius: 50%;
                      display: flex;
                      align-items: center;
                      justify-content: center;
                      font-size: 18px;
                      color: #ffffff;
                    ">
                                    <i class="fa-solid fa-percent"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0" style="
                        font-size: 13px;
                        font-weight: 700;
                        text-transform: uppercase;
                        color: #ffffff;
                      ">
                                        Volume Benefits
                                    </h6>
                                    <p class="mb-0" style="font-size: 12px; color: rgba(255, 255, 255, 0.65)">
                                        Save up to 35% on custom bulk orders
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div style="
                      width: 40px;
                      height: 40px;
                      background: rgba(255, 255, 255, 0.1);
                      border-radius: 50%;
                      display: flex;
                      align-items: center;
                      justify-content: center;
                      font-size: 18px;
                      color: #ffffff;
                    ">
                                    <i class="fa-solid fa-truck-fast"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0" style="
                        font-size: 13px;
                        font-weight: 700;
                        text-transform: uppercase;
                        color: #ffffff;
                      ">
                                        Pan-India Delivery
                                    </h6>
                                    <p class="mb-0" style="font-size: 12px; color: rgba(255, 255, 255, 0.65)">
                                        Express shipping to all major metros
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Right Form Column -->
                    <div class="col-lg-7 col-12" style="background: #ffffff; padding: 40px">
                        <div class="aq-login-top mb-30">
                            <h3 class="font-family-heading" style="
                    font-weight: 700;
                    color: #000;
                    font-size: 24px;
                    margin-bottom: 8px;
                  ">
                                Bulk Quote Request
                            </h3>
                            <p style="color: #666; font-size: 14px">
                                Receive customized pricing and elegant PDF catalogs within 1
                                hour.
                            </p>
                        </div>
                        <form id="aqBulkOrderForm" onsubmit="handleBulkOrderSubmit(event)">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="aq-form-label" style="
                        font-size: 12px;
                        font-weight: 600;
                        text-transform: uppercase;
                        color: #333;
                        margin-bottom: 6px;
                        display: block;
                      ">Full Name
                                        <span style="color: var(--aq-color-#003108)">*</span></label>
                                    <input type="text" class="form-control" required placeholder="E.g. Rajesh Kumar"
                                        style="
                        border-radius: 8px;
                        padding: 10px 15px;
                        font-size: 14px;
                        border: 1.5px solid rgba(0, 0, 0, 0.1);
                        background-color: #fcfbf9;
                        width: 100%;
                      " />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="aq-form-label" style="
                        font-size: 12px;
                        font-weight: 600;
                        text-transform: uppercase;
                        color: #333;
                        margin-bottom: 6px;
                        display: block;
                      ">Corporate Email
                                        <span style="color: var(--aq-color-#003108)">*</span></label>
                                    <input type="email" class="form-control" required
                                        placeholder="E.g. rajesh@company.com" style="
                        border-radius: 8px;
                        padding: 10px 15px;
                        font-size: 14px;
                        border: 1.5px solid rgba(0, 0, 0, 0.1);
                        background-color: #fcfbf9;
                        width: 100%;
                      " />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="aq-form-label" style="
                        font-size: 12px;
                        font-weight: 600;
                        text-transform: uppercase;
                        color: #333;
                        margin-bottom: 6px;
                        display: block;
                      ">Contact Number
                                        <span style="color: var(--aq-color-#003108)">*</span></label>
                                    <input type="tel" class="form-control" required placeholder="E.g. +91 98765 43210"
                                        style="
                        border-radius: 8px;
                        padding: 10px 15px;
                        font-size: 14px;
                        border: 1.5px solid rgba(0, 0, 0, 0.1);
                        background-color: #fcfbf9;
                        width: 100%;
                      " />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="aq-form-label" style="
                        font-size: 12px;
                        font-weight: 600;
                        text-transform: uppercase;
                        color: #333;
                        margin-bottom: 6px;
                        display: block;
                      ">Company Name
                                        <span style="color: var(--aq-color-#003108)">*</span></label>
                                    <input type="text" class="form-control" required
                                        placeholder="E.g. Tata Consultancy Services" style="
                        border-radius: 8px;
                        padding: 10px 15px;
                        font-size: 14px;
                        border: 1.5px solid rgba(0, 0, 0, 0.1);
                        background-color: #fcfbf9;
                        width: 100%;
                      " />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="aq-form-label" style="
                        font-size: 12px;
                        font-weight: 600;
                        text-transform: uppercase;
                        color: #333;
                        margin-bottom: 6px;
                        display: block;
                      ">Estimated Quantity
                                        <span style="color: var(--aq-color-#003108)">*</span></label>
                                    <select class="form-select" required style="
                        border-radius: 8px;
                        padding: 10px 15px;
                        font-size: 14px;
                        border: 1.5px solid rgba(0, 0, 0, 0.1);
                        background-color: #fcfbf9;
                        width: 100%;
                        height: 45px;
                      ">
                                        <option value="" disabled selected>
                                            Select Quantity Range
                                        </option>
                                        <option value="50-100">50 - 100 Units</option>
                                        <option value="100-250">100 - 250 Units</option>
                                        <option value="250-500">250 - 500 Units</option>
                                        <option value="500+">500+ Units (Enterprise)</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="aq-form-label" style="
                        font-size: 12px;
                        font-weight: 600;
                        text-transform: uppercase;
                        color: #333;
                        margin-bottom: 6px;
                        display: block;
                      ">Target Delivery Date</label>
                                    <input type="date" class="form-control" style="
                        border-radius: 8px;
                        padding: 10px 15px;
                        font-size: 14px;
                        border: 1.5px solid rgba(0, 0, 0, 0.1);
                        background-color: #fcfbf9;
                        width: 100%;
                      " />
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="aq-form-label" style="
                      font-size: 12px;
                      font-weight: 600;
                      text-transform: uppercase;
                      color: #333;
                      margin-bottom: 6px;
                      display: block;
                    ">Gifting Requirements / Notes</label>
                                <textarea class="form-control" rows="2"
                                    placeholder="Tell us more about your ideal hamper selection, theme, custom branding needs, etc."
                                    style="
                      border-radius: 8px;
                      padding: 10px 15px;
                      font-size: 14px;
                      border: 1.5px solid rgba(0, 0, 0, 0.1);
                      background-color: #fcfbf9;
                      width: 100%;
                    "></textarea>
                            </div>
                            <button type="submit" class="aq-btn-black btn-red-bg w-100" style="
                    border-radius: 8px !important;
                    padding: 14px !important;
                    text-transform: uppercase;
                    font-weight: 700;
                    font-size: 14px;
                    letter-spacing: 1px;
                  ">
                                Submit Quote Request
                            </button>
                        </form>
                        <!-- Form Success Message -->
                        <div id="aqBulkSuccessMessage" style="display: none; text-align: center; padding: 30px 10px">
                            <div style="
                    width: 70px;
                    height: 70px;
                    background: rgba(40, 167, 69, 0.1);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 36px;
                    color: #28a745;
                    margin: 0 auto 20px;
                  ">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <h4 class="font-family-heading" style="
                    font-weight: 700;
                    color: #000;
                    font-size: 22px;
                    margin-bottom: 10px;
                  ">
                                Request Submitted!
                            </h4>
                            <p style="
                    color: #666;
                    font-size: 14px;
                    line-height: 1.6;
                    max-width: 320px;
                    margin: 0 auto;
                  ">
                                Thank you for your bulk enquiry. Our corporate curators are
                                already preparing your customized options and will contact you
                                shortly.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Premium Bespoke Bulk Enquiry Side Drawer Markup -->
    <div class="aq-drawer-parent-wrap" id="aqEnquiryDrawerWrap">
        <div class="aq-drawer-overlay" id="aqDrawerOverlay"></div>
        <div class="aq-drawer-card-body">
            <!-- Close Button -->
            <button class="aq-drawer-close-btn" id="aqDrawerCloseBtn" aria-label="Close Enquiry Drawer">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <!-- Drawer Header -->
            <div class="aq-drawer-header">
                <div class="aq-drawer-header-icon">
                    <i class="fa-solid fa-gift"></i>
                </div>
                <h3 class="aq-drawer-title">Bespoke Corporate Curation</h3>
                <p class="aq-drawer-subtitle">Connect with our luxury design consultants. Receive curated hampers,
                    custom branded tech & premium PDF proposals within 2 hours.</p>
            </div>

            <!-- Scrollable Content -->
            <div class="aq-drawer-form-scrollable">
                <!-- Form State -->
                <form class="aq-drawer-form" id="aqDrawerForm" method="POST" action="{{ route('general.enquiry') }}">
                    @csrf

                    <input type="hidden" name="source" id="global_source">

                    <div class="aq-drawer-form-row">
                        <div class="aq-drawer-form-group">
                            <label class="aq-drawer-label">Full Name *</label>
                            <div class="aq-drawer-input-wrapper">
                                <i class="fa-regular fa-user"></i>
                                <input type="text" name="name" value="{{ old('name') }}" class="aq-drawer-input"
                                    placeholder="Enter your name" required>
                            </div>
                        </div>
                    </div>

                    <div class="aq-drawer-form-row">
                        <div class="aq-drawer-form-group">
                            <label class="aq-drawer-label">Company Name *</label>
                            <div class="aq-drawer-input-wrapper">
                                <i class="fa-solid fa-building"></i>
                                <input type="text" name="company" value="{{ old('company') }}" class="aq-drawer-input"
                                    placeholder="Your Company Name" required>
                            </div>
                        </div>
                    </div>

                    <div class="aq-drawer-form-row">
                        <div class="aq-drawer-form-group">
                            <label class="aq-drawer-label">Email Address *</label>
                            <div class="aq-drawer-input-wrapper">
                                <i class="fa-regular fa-envelope"></i>
                                <input type="email" name="email" value="{{ old('email') }}" class="aq-drawer-input"
                                    placeholder="you@company.com" required>
                            </div>
                        </div>
                    </div>

                    <div class="aq-drawer-form-row">
                        <div class="aq-drawer-form-group">
                            <label class="aq-drawer-label">Mobile Number *</label>
                            <div class="aq-drawer-input-wrapper">
                                <i class="fa-solid fa-phone-flip"></i>
                                <input type="tel" name="phone" value="{{ old('phone') }}" class="aq-drawer-input"
                                    placeholder="+91 98765 43210" pattern="[6-9]{1}[0-9]{9}" maxlength="10" required>
                            </div>
                        </div>
                    </div>

                    <div class="aq-drawer-form-row">
                        <div class="aq-drawer-form-group">
                            <label class="aq-drawer-label">
                                Message / Special Requirement
                            </label>

                            <div class="aq-drawer-input-wrapper textarea-wrapper">
                                <i class="fa-regular fa-comment-dots"></i>

                                <textarea name="message" class="aq-drawer-textarea"
                                    placeholder="Any specific requirement or customization needed?">{{ old('message') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}">
                        </div>
                    </div>

                    <div class="aq-drawer-form-footer">

                        <button type="submit" class="aq-drawer-submit-btn">

                            <span>Submit Enquiry</span>

                            <i class="fa-solid fa-arrow-right-long"></i>

                        </button>

                        <div class="aq-drawer-secure-note">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>Corporate privacy guarantee. No spam.</span>
                        </div>

                    </div>

                </form>


                <!-- Success State -->
                <div class="aq-drawer-success-state" id="aqDrawerSuccess">
                    <div class="aq-drawer-success-icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <h4 class="aq-drawer-success-title">Proposal Initiated!</h4>
                    <p class="aq-drawer-success-desc">
                        Your bulk inquiry was transmitted. A dedicated corporate curator will assemble custom gifting
                        ideas and email you digital catalogs within <strong>2 business hours</strong>.
                    </p>
                    <button type="button" class="aq-drawer-success-close-btn" id="aqDrawerSuccessClose">
                        Return to Site
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    @if(session('success_general'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const drawerWrap = document.getElementById("aqEnquiryDrawerWrap");
                const drawerForm = document.getElementById("aqDrawerForm");
                const drawerSuccess = document.getElementById("aqDrawerSuccess");

                // Open drawer
                if (drawerWrap) {
                    drawerWrap.classList.add("active");
                }

                // Hide form
                if (drawerForm) {
                    drawerForm.classList.add("hidden");
                }

                // Show success state
                setTimeout(() => {
                    if (drawerSuccess) {
                        drawerSuccess.classList.add("active");
                    }
                }, 250);

            });
        </script>
    @endif

    @if($errors->generalForm->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const drawerWrap = document.getElementById('aqEnquiryDrawerWrap');

                if (drawerWrap) {
                    drawerWrap.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: `{!! implode('<br>', $errors->generalForm->all()) !!}`
                });

            });
        </script>
    @endif

    <!-- Bulk Orders Submission Handler & Drawer Controller -->
    <script>


        document.addEventListener("DOMContentLoaded", function () {
            const drawerWrap = document.getElementById("aqEnquiryDrawerWrap");
            const drawerOverlay = document.getElementById("aqDrawerOverlay");
            const drawerCloseBtn = document.getElementById("aqDrawerCloseBtn");
            const drawerForm = document.getElementById("aqDrawerForm");
            const drawerSuccess = document.getElementById("aqDrawerSuccess");
            const drawerSuccessClose = document.getElementById("aqDrawerSuccessClose");

            window.openGlobalDrawer = function (source = 'general') {

                const sourceField = document.getElementById('global_source');

                if (sourceField) {
                    sourceField.value = source;
                }

                // Hide any open bootstrap modal if present safely
                const activeModal = document.querySelector('.modal.show');
                if (activeModal) {
                    try {
                        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                            const modalInstance = bootstrap.Modal.getInstance(activeModal);
                            if (modalInstance) {
                                modalInstance.hide();
                            }
                        } else if (typeof jQuery !== 'undefined' && jQuery.fn && jQuery.fn.modal) {
                            jQuery(activeModal).modal('hide');
                        } else if (typeof $ !== 'undefined' && $.fn && $.fn.modal) {
                            $(activeModal).modal('hide');
                        }
                    } catch (err) {
                        console.warn("Bootstrap modal close warning: ", err);
                    }
                }


                drawerWrap.classList.add('active');
                document.body.style.overflow = "hidden";
            };

            // Close Drawer Function
            function closeEnquiryDrawer() {
                drawerWrap.classList.remove("active");
                document.body.style.overflow = ""; // Re-enable scroll

                // Reset form state after transition completes
                setTimeout(() => {
                    drawerForm.classList.remove("hidden");
                    drawerSuccess.classList.remove("active");
                    drawerForm.reset();
                    // Reset input focus wrappers
                    document.querySelectorAll('.aq-drawer-input-wrapper, .aq-drawer-select-wrapper').forEach(wrap => {
                        wrap.classList.remove("focus");
                    });
                }, 500);
            }

            // Setup input wrapper active state indicators
            function setupInputEffects() {
                const inputs = document.querySelectorAll(
                    '.aq-drawer-input, .aq-drawer-select, .aq-drawer-textarea'
                );

                inputs.forEach(input => {
                    const wrapper = input.closest('.aq-drawer-input-wrapper, .aq-drawer-select-wrapper');
                    if (!wrapper) return;

                    input.addEventListener("focus", () => {
                        wrapper.classList.add("focus");
                    });

                    input.addEventListener("blur", () => {
                        wrapper.classList.remove("focus");
                    });
                });
            }

            // Bind click events for closing
            if (drawerCloseBtn) drawerCloseBtn.addEventListener("click", closeEnquiryDrawer);
            if (drawerOverlay) drawerOverlay.addEventListener("click", closeEnquiryDrawer);
            if (drawerSuccessClose) drawerSuccessClose.addEventListener("click", closeEnquiryDrawer);

            // ESC key closes drawer
            document.addEventListener("keydown", function (e) {
                if (e.key === "Escape" && drawerWrap.classList.contains("active")) {
                    closeEnquiryDrawer();
                }
            });

            // Initialize Setup
            setupInputEffects();
            observer.observe(document.body, { childList: true, subtree: true });
        });
    </script>

    <script>
        function handleBulkOrderSubmit(event) {
            event.preventDefault();
            document.getElementById("aqBulkOrderForm").style.display = "none";
            document.getElementById("aqBulkSuccessMessage").style.display = "block";
        }

        document.addEventListener("DOMContentLoaded", function () {
            const tabBtns = document.querySelectorAll(".aq-brands-tab-btn");
            const tabPanes = document.querySelectorAll(".aq-brands-tab-pane");

            tabBtns.forEach(btn => {
                btn.addEventListener("click", function (e) {
                    e.preventDefault();

                    // Get targeted tab ID
                    const targetTab = this.getAttribute("data-tab");
                    if (!targetTab) return;

                    // Deactivate all buttons
                    tabBtns.forEach(b => {
                        b.classList.remove("active");
                        b.setAttribute("aria-selected", "false");
                    });

                    // Deactivate all panes
                    tabPanes.forEach(p => {
                        p.classList.remove("active");
                    });

                    // Activate clicked button
                    this.classList.add("active");
                    this.setAttribute("aria-selected", "true");

                    // Activate corresponding pane
                    const activePane = document.getElementById(targetTab);
                    if (activePane) {
                        activePane.classList.add("active");
                    }
                });
            });
        });

        document.querySelectorAll('.remove-cart-item').forEach(btn => {
            btn.addEventListener('click', function () {

                let itemId = this.getAttribute('data-id');

                fetch("{{ route('cart.remove') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        item_id: itemId
                    })
                })
                    .then(res => res.json())
                    .then(data => {

                        Swal.fire({
                            icon: 'success',
                            title: 'Removed!',
                            text: data.message,
                            timer: 1200,
                            showConfirmButton: false
                        });

                        // ✅ Remove item from UI instantly
                        this.closest('.aq-cartmini-product-item').remove();

                        // ✅ Reload page (to update totals + header count)
                        setTimeout(() => {
                            location.reload();
                        }, 800);

                    });

            });
        });


        document.querySelectorAll('.aq-cart-plus').forEach(btn => {

            btn.addEventListener('click', function () {

                let row = this.closest('.aq-cartmini-product-item');

                let input = row.querySelector('.aq-cart-input');

                let qty = parseInt(input.value) + 1;

                updateCartQty(this.dataset.id, qty);
            });

        });

        document.querySelectorAll('.aq-cart-minus').forEach(btn => {

            btn.addEventListener('click', function () {

                let row = this.closest('.aq-cartmini-product-item');

                let input = row.querySelector('.aq-cart-input');

                let qty = parseInt(input.value) - 1;

                if (qty < 1) qty = 1;

                updateCartQty(this.dataset.id, qty);
            });

        });

        function updateCartQty(itemId, qty) {
            fetch("{{ route('cart.update.quantity') }}", {

                method: "POST",

                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },

                body: JSON.stringify({
                    item_id: itemId,
                    quantity: qty
                })

            })
                .then(res => res.json())
                .then(data => {

                    location.reload();

                });
        }


    </script>
    <script>
        $(document).ready(function () {

            const storagePath = "{{ asset('storage') }}";
            const noImage = "{{ asset('assets/images/no-image.png') }}";

            $('#searchInput').on('keyup', function () {

                let query = $(this).val().trim();

                if (query.length < 2) {
                    $('#searchSuggestions').hide().html('');
                    return;
                }

                $.ajax({
                    url: "{{ route('search.suggestions') }}",
                    type: "GET",
                    data: {
                        q: query
                    },
                    success: function (response) {

                        let html = '';

                        // Products
                        if (response.products && response.products.length) {

                            html += '<div class="section-title">Products</div>';

                            response.products.forEach(item => {

                                let image = item.image
                                    ? `${storagePath}/${item.image}`
                                    : noImage;

                                html += `
                                <a href="/product/${item.slug}" class="d-flex align-items-center gap-2">
                                    <img src="${image}"
                                         width="40"
                                         height="40"
                                         style="object-fit:cover;border-radius:6px;">
                                    <span>${item.name}</span>
                                </a>
                            `;
                            });
                        }

                        // Categories
                        if (response.categories && response.categories.length) {

                            html += '<div class="section-title">Categories</div>';

                            response.categories.forEach(item => {

                                let image = item.image
                                    ? `${storagePath}/${item.image}`
                                    : noImage;

                                html += `
                                <a href="/category/${item.slug}" class="d-flex align-items-center gap-2">
                                    <img src="${image}"
                                         width="40"
                                         height="40"
                                         style="object-fit:cover;border-radius:6px;">
                                    <span>${item.name}</span>
                                </a>
                            `;
                            });
                        }

                        // Sub Categories
                        if (response.subcategories && response.subcategories.length) {

                            html += '<div class="section-title">Sub Categories</div>';

                            response.subcategories.forEach(item => {

                                let image = item.image
                                    ? `${storagePath}/${item.image}`
                                    : noImage;

                                html += `
                               <a href="/category/${item.parent_slug}?subcategory=${item.slug}"
   class="d-flex align-items-center gap-2">
                                    <img src="${image}"
                                         width="40"
                                         height="40"
                                         style="object-fit:cover;border-radius:6px;">
                                    <span>${item.name}</span>
                                </a>
                            `;
                            });
                        }

                        // Occasions
                        if (response.occasions && response.occasions.length) {

                            html += '<div class="section-title">Occasions</div>';

                            response.occasions.forEach(item => {

                                let image = item.image
                                    ? `${storagePath}/${item.image}`
                                    : noImage;

                                let url = `/products?occasion=${item.slug}`;

                                html += `
            <a href="${url}" class="d-flex align-items-center gap-2">
                <img src="${image}"
                     width="40"
                     height="40"
                     style="object-fit:cover;border-radius:6px;">
                <span>${item.title}</span>
            </a>
        `;
                            });
                        }

                        if (html !== '') {
                            $('#searchSuggestions').html(html).show();
                        } else {
                            $('#searchSuggestions').html(`
                            <div class="p-3 text-center">
                                No results found
                            </div>
                        `).show();
                        }
                    },
                    error: function () {
                        $('#searchSuggestions').hide().html('');
                    }
                });
            });

            $(document).on('click', function (e) {
                if (!$(e.target).closest('.aq-search-input-wrap').length) {
                    $('#searchSuggestions').hide();
                }
            });

        });
    </script>
    <style>
        .search-suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            max-height: 400px;
            overflow-y: auto;
            z-index: 9999;
            display: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .08);
        }

        .search-suggestions a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
        }

        .search-suggestions a:hover {
            background: #f8f8f8;
        }

        .search-suggestions .section-title {
            font-size: 12px;
            font-weight: 700;
            color: #999;
            padding: 10px 15px 5px;
            text-transform: uppercase;
        }
    </style>
</body>

</html>