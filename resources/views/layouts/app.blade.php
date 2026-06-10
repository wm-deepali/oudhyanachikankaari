<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
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
    <title>Oudhyana - Fashion eCommerce HTML, Bootstrap Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-animation.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-luxury.css') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
</head>



<body>

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
                        <img src="{{ asset('assets/img/corporate/Oudhyana_img/logo.png') }}" alt="Oudhyana">
                    </div>
                    <!-- <h3 class="aq-preloader-title">Oudhyana</h3> -->
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
        <button class="aq-search-close" aria-label="Close Search">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M12.75 0.75L0.75 12.75M0.75 0.75L12.75 12.75" stroke="currentcolor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
        <div class="aq-search-inner-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="aq-search-input p-relative mb-60">
                            <input type="text" placeholder="What are you looking for?" aria-label="Search query">
                            <button type="submit" class="aq-search-input-btn" aria-label="Submit Search">
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
                                <a href="#">Kurta Sets</a>
                                <a href="#">Anarkalis</a>
                                <a href="#">Shipping Policy</a>
                                <a href="#">Georgette Saree</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">
                        <div class="aq-search-product mb-30">
                            <h4 class="aq-search-cat-title mb-35">Recently Viewed Products</h4>
                            <div class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-2 row-cols-sm-2 row-cols-1">
                                <div class="col">
                                    <div class="aq-product-item aq-product-main mb-40" data-lazy="true">
                                        <div class="aq-product-thumb aq-img-hover-wrap p-relative mb-10">
                                            <a href="product-details-default.html">
                                                <img class="lazyload aq-product-img"
                                                    src="{{ asset('assets/img/corporate/nazneen_georgette_kurti.png') }}"
                                                    alt="Premium Kurti">
                                                <img class="aq-img-hover lazyload"
                                                    src="{{ asset('assets/img/corporate/shama_cotton_anarkali.png') }}"
                                                    alt="Premium Kurti Hover">
                                            </a>
                                        </div>
                                        <div class="aq-product-content">
                                            <span class="aqf-product-3-category">Premium Kurtis</span>
                                            <h4 class="aq-product-title mb-5"><a
                                                    href="product-details-default.html">Nazneen Georgette Kurti</a>
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
                                                    src="{{ asset('assets/img/corporate/gallery_cotton_anarkali.png') }}"
                                                    alt="Cotton Anarkali">
                                                <img class="aq-img-hover lazyload"
                                                    src="{{ asset('assets/img/corporate/media__1778668953904.webp') }}"
                                                    alt="Cotton Anarkali Hover">
                                            </a>
                                        </div>
                                        <div class="aq-product-content">
                                            <span class="aqf-product-3-category">Luxury Chikankari</span>
                                            <h4 class="aq-product-title mb-5"><a
                                                    href="product-details-default.html">Elite Handcrafted Suite</a></h4>
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
                                                    src="{{ asset('assets/img/corporate/gallery_chikan_kurta.png') }}"
                                                    alt="Luxury Handcrafted Kurtis">
                                                <img class="aq-img-hover lazyload"
                                                    src="{{ asset('assets/img/corporate/media__1778668979144.png') }}"
                                                    alt="Luxury Chanderi Gowns Hover">
                                            </a>
                                        </div>
                                        <div class="aq-product-content">
                                            <span class="aqf-product-3-category">Royal Court Wear</span>
                                            <h4 class="aq-product-title mb-5"><a
                                                    href="product-details-default.html">Premium Chikan Kurta</a></h4>
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
                                                    src="{{ asset('assets/img/corporate/gallery_georgette_saree.png') }}"
                                                    alt="Georgette Saree">
                                                <img class="aq-img-hover lazyload"
                                                    src="{{ asset('assets/img/corporate/media__1778668962634.png') }}"
                                                    alt="Georgette Saree Hover">
                                            </a>
                                        </div>
                                        <div class="aq-product-content">
                                            <span class="aqf-product-3-category">Travel</span>
                                            <h4 class="aq-product-title mb-5"><a
                                                    href="product-details-default.html">Executive Handcrafted Case</a>
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
            <i class="aq-cartmini-close aq-cartmini-close-icon fa-regular fa-xmark" role="button"
                aria-label="Close Cart" tabindex="0"></i>
            <h4 class="aq-cartmini-title">Shopping Cart</h4>
            <div class="aq-cartmini-shiping">
                <div class="aq-cartmini-shiping-message">
                    <p>Buy <b>$99.00</b> more to enjoy <b>Free Shipping</b></p>
                </div>
                <div class="aq-progress-bar">
                    <div style="width: 50%;">
                        <div class="progress-car">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="16" viewBox="0 0 19 16"
                                fill="none">
                                <path
                                    d="M18.1509 6.77558H18.8009C18.8009 6.668 18.7742 6.5621 18.7232 6.46738L18.1509 6.77558ZM9.77434 0.778871L9.9752 0.160685L9.9752 0.160684L9.77434 0.778871ZM11.4597 2.46428L10.8416 2.66514L10.8416 2.66514L11.4597 2.46428ZM11.6739 5.56632L11.0557 5.76718L11.0557 5.76718L11.6739 5.56632ZM12.7975 6.68992L12.5966 7.30811L12.5966 7.30811L12.7975 6.68992ZM3.24311 13.5259C3.60165 13.5437 3.90679 13.2676 3.92466 12.909C3.94254 12.5505 3.66637 12.2453 3.30783 12.2275L3.27547 12.8767L3.24311 13.5259ZM1.29111 12.26L0.831495 12.7197L0.831495 12.7197L1.29111 12.26ZM6.77553 12.2508C6.41654 12.2508 6.12555 12.5418 6.12558 12.9008C6.12561 13.2598 6.41664 13.5508 6.77563 13.5508L6.77558 12.9008L6.77553 12.2508ZM15.4935 12.2275C15.1349 12.2453 14.8588 12.5505 14.8767 12.909C14.8945 13.2676 15.1997 13.5437 15.5582 13.5259L15.5258 12.8767L15.4935 12.2275ZM0.650391 0.000390649C0.291406 0.000390649 0.000390649 0.291406 0.000390649 0.650391C0.000390649 1.00938 0.291406 1.30039 0.650391 1.30039V0.650391V0.000390649ZM1.32369 10.2433C1.30582 9.88478 1.00068 9.60862 0.642138 9.62649C0.283598 9.64436 0.00743206 9.9495 0.0253041 10.308L0.674498 10.2757L1.32369 10.2433ZM0.650569 3.5004C0.291584 3.5004 0.000568669 3.79142 0.000568669 4.1504C0.000568669 4.50939 0.291584 4.8004 0.650569 4.8004V4.1504V3.5004ZM5.90073 4.8004C6.25971 4.8004 6.55073 4.50939 6.55073 4.1504C6.55073 3.79142 6.25971 3.5004 5.90073 3.5004V4.1504V4.8004ZM0.650569 6.12516C0.291584 6.12516 0.000568669 6.41618 0.000568669 6.77516C0.000568669 7.13415 0.291584 7.42516 0.650569 7.42516V6.77516V6.12516ZM4.15068 7.42516C4.50966 7.42516 4.80068 7.13415 4.80068 6.77516C4.80068 6.41618 4.50966 6.12516 4.15068 6.12516V6.77516V7.42516ZM11.5881 1.7504C11.2291 1.7504 10.9381 2.04142 10.9381 2.4004C10.9381 2.75939 11.2291 3.0504 11.5881 3.0504V2.4004V1.7504ZM17.0339 4.70128L16.4616 5.00945L16.4616 5.00948L17.0339 4.70128ZM15.6101 2.70991L15.9434 2.15187L15.9434 2.15187L15.6101 2.70991ZM15.5265 12.9003H14.8765C14.8765 13.5079 14.3839 14.0004 13.7764 14.0004V14.6504V15.3004C15.1019 15.3004 16.1765 14.2259 16.1765 12.9003H15.5265ZM13.7764 14.6504V14.0004C13.1689 14.0004 12.6763 13.5079 12.6763 12.9003H12.0263H11.3763C11.3763 14.2259 12.4509 15.3004 13.7764 15.3004V14.6504ZM12.0263 12.9003H12.6763C12.6763 12.2928 13.1689 11.8003 13.7764 11.8003V11.1503V10.5003C12.4509 10.5003 11.3763 11.5748 11.3763 12.9003H12.0263ZM13.7764 11.1503V11.8003C14.3839 11.8003 14.8765 12.2928 14.8765 12.9003H15.5265H16.1765C16.1765 11.5748 15.1019 10.5003 13.7764 10.5003V11.1503ZM6.77665 12.9005H6.12665C6.12665 13.508 5.63414 14.0005 5.0266 14.0005V14.6505V15.3005C6.35211 15.3005 7.42665 14.226 7.42665 12.9005H6.77665ZM5.0266 14.6505V14.0005C4.41906 14.0005 3.92655 13.508 3.92655 12.9005H3.27655H2.62655C2.62655 14.226 3.70109 15.3005 5.0266 15.3005V14.6505ZM3.27655 12.9005H3.92655C3.92655 12.2929 4.41906 11.8004 5.0266 11.8004V11.1504V10.5004C3.70109 10.5004 2.62655 11.5749 2.62655 12.9005H3.27655ZM5.0266 11.1504V11.8004C5.63414 11.8004 6.12665 12.2929 6.12665 12.9005H6.77665H7.42665C7.42665 11.5749 6.35211 10.5004 5.0266 10.5004V11.1504ZM18.1509 6.77558H17.5009V8.52563H18.1509H18.8009V6.77558H18.1509ZM14.0383 6.77558V7.42558H18.1509V6.77558V6.12558H14.0383V6.77558ZM18.1509 8.52563H17.5009C17.5009 9.57523 17.4995 10.297 17.4266 10.8394C17.3562 11.363 17.23 11.621 17.0506 11.8004L17.5102 12.26L17.9698 12.7197C18.4311 12.2584 18.6253 11.6804 18.715 11.0126C18.8023 10.3635 18.8009 9.53848 18.8009 8.52563H18.1509ZM7.91311 0.650391V1.30039C8.94091 1.30039 9.30065 1.30841 9.57348 1.39706L9.77434 0.778871L9.9752 0.160684C9.45718 -0.00762862 8.83972 0.000390649 7.91311 0.000390649V0.650391ZM11.5882 4.3255H12.2382C12.2382 3.39889 12.2462 2.78143 12.0779 2.26341L11.4597 2.46428L10.8416 2.66514C10.9302 2.93797 10.9382 3.29771 10.9382 4.3255H11.5882ZM9.77434 0.778871L9.57348 1.39706C10.1748 1.59243 10.6462 2.06385 10.8416 2.66514L11.4597 2.46428L12.0779 2.26342C11.754 1.26636 10.9723 0.484649 9.9752 0.160685L9.77434 0.778871ZM11.5882 4.3255H10.9382C10.9382 4.92638 10.9302 5.38097 11.0557 5.76718L11.6739 5.56632L12.2921 5.36546C12.2462 5.22444 12.2382 5.02756 12.2382 4.3255H11.5882ZM14.0383 6.77558V6.12558C13.3362 6.12558 13.1394 6.11756 12.9983 6.07174L12.7975 6.68992L12.5966 7.30811C12.9828 7.4336 13.4374 7.42558 14.0383 7.42558V6.77558ZM11.6739 5.56632L11.0557 5.76718C11.2931 6.49785 11.866 7.0707 12.5966 7.30811L12.7975 6.68992L12.9983 6.07174C12.6634 5.96292 12.4009 5.70036 12.2921 5.36546L11.6739 5.56632ZM3.27547 12.8767L3.30783 12.2275C2.36654 12.1805 1.9913 12.041 1.75073 11.8004L1.29111 12.26L0.831495 12.7197C1.44298 13.3311 2.26508 13.4771 3.24311 13.5259L3.27547 12.8767ZM12.0263 12.9003L12.0263 12.2503L6.77553 12.2508L6.77558 12.9008L6.77563 13.5508L12.0264 13.5503L12.0263 12.9003ZM15.5258 12.8767L15.5582 13.5259C16.5362 13.4771 17.3583 13.3311 17.9698 12.7197L17.5102 12.26L17.0506 11.8004C16.81 12.041 16.4348 12.1805 15.4935 12.2275L15.5258 12.8767ZM0.650391 0.650391V1.30039H7.91311V0.650391V0.000390649H0.650391V0.650391ZM0.674498 10.2757L0.0253041 10.308C0.0740557 11.2861 0.220013 12.1082 0.831495 12.7197L1.29111 12.26L1.75073 11.8004C1.51017 11.5599 1.37061 11.1846 1.32369 10.2433L0.674498 10.2757ZM0.650569 4.1504V4.8004H5.90073V4.1504V3.5004H0.650569V4.1504ZM0.650569 6.77516V7.42516H4.15068V6.77516V6.12516H0.650569V6.77516ZM11.5881 2.4004V3.0504H13.1817V2.4004V1.7504H11.5881V2.4004ZM17.0339 4.70128L16.4616 5.00948L17.5786 7.08377L18.1509 6.77558L18.7232 6.46738L17.6062 4.39309L17.0339 4.70128ZM13.1817 2.4004V3.0504C13.8314 3.0504 14.2708 3.05116 14.6138 3.0858C14.9422 3.11896 15.1281 3.17913 15.2768 3.26794L15.6101 2.70991L15.9434 2.15187C15.5739 1.93117 15.1823 1.83659 14.7444 1.79238C14.3211 1.74964 13.8054 1.7504 13.1817 1.7504V2.4004ZM17.0339 4.70128L17.6062 4.39312C17.3105 3.84393 17.0666 3.3895 16.8283 3.03709C16.5818 2.67251 16.3129 2.37257 15.9434 2.15187L15.6101 2.70991L15.2768 3.26794C15.4254 3.35675 15.5665 3.49187 15.7514 3.7653C15.9445 4.05088 16.1535 4.43739 16.4616 5.00945L17.0339 4.70128Z"
                                    fill="currentcolor" fill-opacity="0.8"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="aq-cartmini-body">
            <div class="aq-cartmini-product-item mb-15 item-delete d-flex align-items-center">
                <div class="aq-cartmini-product-thumbnail">
                    <a href="product-details-default.html">
                        <img src="{{ asset('assets/img/corporate/nyra_antique_gold_chikankari.png') }}" alt="Anarkalis">
                    </a>
                </div>
                <div class="aq-cartmini-product-summary">
                    <h4 class="aq-product-title"><a href="product-details-default.html">Ribbed Tank Top - Orange</a>
                    </h4>
                    <span class="aq-cartmini-product-size"><label>Size:</label> M</span>
                    <span class="aq-cartmini-product-price">$18.00</span>
                    <div class="aq-product-details-quantity d-flex align-items-center">
                        <div class="aq-product-quantity">
                            <span class="aq-cart-minus">
                                <svg width="11" height="2" viewBox="0 0 11 2" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 1H10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <input class="aq-cart-input" type="text" value="1" aria-label="Quantity">
                            <span class="aq-cart-plus">
                                <svg width="11" height="12" viewBox="0 0 11 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 6H10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M5.5 10.5V1.5" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                        <button class="aq-line-anim aq-cartmini-remove aq-remove">Remove</button>
                    </div>
                </div>
            </div>
            <div class="aq-cartmini-product-item mb-15 item-delete d-flex align-items-center">
                <div class="aq-cartmini-product-thumbnail">
                    <a href="product-details-default.html">
                        <img src="{{ asset('assets/img/corporate/nafasat_warm_peach_chikankari.png') }}"
                            alt="Stationery Set">
                    </a>
                </div>
                <div class="aq-cartmini-product-summary">
                    <h4 class="aq-product-title"><a href="product-details-default.html">Anisa Handcrafted Kurti</a>
                    </h4>
                    <span class="aq-cartmini-product-size"><label>Size:</label> XL</span>
                    <span class="aq-cartmini-product-price">₹4,500</span>
                    <div class="aq-product-details-quantity d-flex align-items-center">
                        <div class="aq-product-quantity">
                            <span class="aq-cart-minus">
                                <svg width="11" height="2" viewBox="0 0 11 2" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 1H10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <input class="aq-cart-input" type="text" value="1" aria-label="Quantity">
                            <span class="aq-cart-plus">
                                <svg width="11" height="12" viewBox="0 0 11 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 6H10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M5.5 10.5V1.5" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                        <button class="aq-line-anim aq-cartmini-remove aq-remove">Remove</button>
                    </div>
                </div>
            </div>
            <div class="aq-cartmini-product-item mb-15 item-delete d-flex align-items-center">
                <div class="aq-cartmini-product-thumbnail">
                    <a href="product-details-default.html">
                        <img src="{{ asset('assets/img/corporate/shejali_onion_pink_chikankari.jpg') }}"
                            alt="Shejali Kurti">
                    </a>
                </div>
                <div class="aq-cartmini-product-summary">
                    <h4 class="aq-product-title"><a href="product-details-default.html">Shejali Handcrafted Kurti</a>
                    </h4>
                    <span class="aq-cartmini-product-size"><label>Size:</label> L</span>
                    <span class="aq-cartmini-product-price">₹4,800</span>
                    <div class="aq-product-details-quantity d-flex align-items-center">
                        <div class="aq-product-quantity">
                            <span class="aq-cart-minus">
                                <svg width="11" height="2" viewBox="0 0 11 2" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 1H10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <input class="aq-cart-input" type="text" value="1" aria-label="Quantity">
                            <span class="aq-cart-plus">
                                <svg width="11" height="12" viewBox="0 0 11 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 6H10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M5.5 10.5V1.5" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                        <button class="aq-line-anim aq-cartmini-remove aq-remove">Remove</button>
                    </div>
                </div>
            </div>
            <div class="cartmini-empty text-center d-none">
                <img src="{{ asset('assets/img/corporate/icon_empty-cart.webp') }}" alt="Empty Cart">
                <p>Your Cart is empty</p>
                <a href="product-default.html" class="aq-btn-black border-btn">Go to Shop</a>
            </div>
        </div>
        <div class="aq-cartmini-footer">
            <div class="aq-cartmini-btn-wrap">
                <button class="aq-cartmini-btn aq-note-btn aq-tooltip-top">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                            <path
                                d="M4.24818 0.75V2.85M9.85182 0.75V2.85M4.24818 7.05H9.84818M4.24818 10.5482H7.04818M13.35 5.3V11.25C13.35 13.35 12.3 14.75 9.85 14.75H4.25C1.8 14.75 0.75 13.35 0.75 11.25V5.3C0.75 3.2 1.8 1.8 4.25 1.8H9.85C12.3 1.8 13.35 3.2 13.35 5.3Z"
                                stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <span>Note</span>
                    <span class="aq-tooltip-item">Add note for seller</span>
                </button>
                <button class="aq-cartmini-btn aq-coupon-btn aq-tooltip-top">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none">
                            <path
                                d="M6.25 9.0625L10.75 4.5625M10.7446 9.0625H10.7536M6.24588 4.9375H6.25262M14.125 7.375C14.125 6.34 14.965 5.5 16 5.5V4.75C16 1.75 15.25 1 12.25 1H4.75C1.75 1 1 1.75 1 4.75V5.125C2.035 5.125 2.875 5.965 2.875 7C2.875 8.035 2.035 8.875 1 8.875V9.25C1 12.25 1.75 13 4.75 13H12.25C15.25 13 16 12.25 16 9.25C14.965 9.25 14.125 8.41 14.125 7.375Z"
                                stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                    </span>
                    <span>Coupon</span>
                    <span class="aq-tooltip-item">Add a discount code</span>
                </button>
                <button class="aq-cartmini-btn aq-shipping-btn aq-tooltip-top">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none">
                            <path
                                d="M15.6508 5.90014H16.3008C16.3008 5.79256 16.2741 5.68666 16.2231 5.59195L15.6508 5.90014ZM15.1017 10.6011L14.642 10.1414L14.642 10.1414L15.1017 10.6011ZM8.47092 0.76015L8.67178 0.141963L8.67178 0.141962L8.47092 0.76015ZM9.91555 2.20477L9.29736 2.40563L9.29736 2.40563L9.91555 2.20477ZM10.0991 4.86364L9.48091 5.0645L9.48091 5.06451L10.0991 4.86364ZM11.0622 5.82672L10.8613 6.44491L10.8613 6.44491L11.0622 5.82672ZM2.8681 11.7788C3.22664 11.7967 3.53178 11.5205 3.54965 11.162C3.56752 10.8034 3.29136 10.4983 2.93282 10.4804L2.90046 11.1296L2.8681 11.7788ZM1.19958 10.6011L0.739965 11.0607L0.739965 11.0607L1.19958 10.6011ZM13.3684 10.4804C13.0099 10.4983 12.7337 10.8034 12.7516 11.162C12.7695 11.5205 13.0746 11.7967 13.4331 11.7788L13.4008 11.1296L13.3684 10.4804ZM0.650391 2.44379e-05C0.291406 2.44379e-05 0.000390649 0.291039 0.000390649 0.650024C0.000390649 1.00901 0.291406 1.30002 0.650391 1.30002V0.650024V2.44379e-05ZM1.32025 8.86785C1.30238 8.50931 0.997234 8.23314 0.638694 8.25101C0.280154 8.26888 0.00398801 8.57403 0.0218602 8.93257L0.671054 8.90021L1.32025 8.86785ZM0.650543 3.00001C0.291558 3.00001 0.000543237 3.29102 0.000543237 3.65001C0.000543237 4.00899 0.291558 4.30001 0.650543 4.30001V3.65001V3.00001ZM5.15068 4.30001C5.50967 4.30001 5.80068 4.00899 5.80068 3.65001C5.80068 3.29102 5.50967 3.00001 5.15068 3.00001V3.65001V4.30001ZM0.650543 5.24978C0.291558 5.24978 0.000543237 5.5408 0.000543237 5.89978C0.000543237 6.25877 0.291558 6.54978 0.650543 6.54978V5.89978V5.24978ZM3.65063 6.54978C4.00962 6.54978 4.30063 6.25877 4.30063 5.89978C4.30063 5.5408 4.00962 5.24978 3.65063 5.24978V5.89978V6.54978ZM10.0255 1.50002C9.66656 1.50002 9.37554 1.79104 9.37554 2.15002C9.37554 2.50901 9.66656 2.80002 10.0255 2.80002V2.15002V1.50002ZM14.6934 4.12219L14.1211 4.43036L14.1211 4.43038L14.6934 4.12219ZM13.473 2.41531L13.8063 1.85727L13.8063 1.85727L13.473 2.41531ZM13.4013 11.1499H12.7513C12.7513 11.6194 12.3707 11.9999 11.9013 11.9999V12.6499V13.2999C13.0887 13.2999 14.0513 12.3373 14.0513 11.1499H13.4013ZM11.9013 12.6499V11.9999C11.4318 11.9999 11.0512 11.6194 11.0512 11.1499H10.4012H9.75121C9.75121 12.3373 10.7138 13.2999 11.9013 13.2999V12.6499ZM10.4012 11.1499H11.0512C11.0512 10.6804 11.4318 10.2999 11.9013 10.2999V9.64987V8.99987C10.7138 8.99987 9.75121 9.96246 9.75121 11.1499H10.4012ZM11.9013 9.64987V10.2999C12.3707 10.2999 12.7513 10.6804 12.7513 11.1499H13.4013H14.0513C14.0513 9.96246 13.0887 8.99987 11.9013 8.99987V9.64987ZM5.90147 11.15H5.25147C5.25147 11.6194 4.8709 12 4.40143 12V12.65V13.3C5.58886 13.3 6.55147 12.3374 6.55147 11.15H5.90147ZM4.40143 12.65V12C3.93195 12 3.55138 11.6194 3.55138 11.15H2.90138H2.25138C2.25138 12.3374 3.21399 13.3 4.40143 13.3V12.65ZM2.90138 11.15H3.55138C3.55138 10.6805 3.93195 10.3 4.40143 10.3V9.64996V8.99996C3.21399 8.99996 2.25138 9.96255 2.25138 11.15H2.90138ZM4.40143 9.64996V10.3C4.8709 10.3 5.25147 10.6805 5.25147 11.15H5.90147H6.55147C6.55147 9.96255 5.58886 8.99996 4.40143 8.99996V9.64996ZM15.6508 5.90014H15.0008V7.40017H15.6508H16.3008V5.90014H15.6508ZM12.1257 5.90014V6.55014H15.6508V5.90014V5.25014H12.1257V5.90014ZM15.6508 7.40017H15.0008C15.0008 8.30245 14.9995 8.91377 14.938 9.37099C14.879 9.80951 14.7757 10.0078 14.642 10.1414L15.1017 10.6011L15.5613 11.0607C15.9768 10.6452 16.1481 10.1269 16.2264 9.54421C16.3022 8.98024 16.3008 8.2657 16.3008 7.40017H15.6508ZM6.87558 0.650024V1.30002C7.76377 1.30002 8.05372 1.30804 8.27006 1.37834L8.47092 0.76015L8.67178 0.141962C8.21025 -0.00799471 7.66259 2.44379e-05 6.87558 2.44379e-05V0.650024ZM10.0257 3.80009H10.6757C10.6757 3.01309 10.6837 2.46543 10.5337 2.00391L9.91555 2.20477L9.29736 2.40563C9.36766 2.62197 9.37568 2.91191 9.37568 3.80009H10.0257ZM8.47092 0.76015L8.27006 1.37834C8.75718 1.53661 9.13909 1.91852 9.29736 2.40563L9.91555 2.20477L10.5337 2.00391C10.2469 1.12102 9.55467 0.428828 8.67178 0.141963L8.47092 0.76015ZM10.0257 3.80009H9.37568C9.37568 4.3079 9.36766 4.71596 9.48091 5.0645L10.0991 4.86364L10.7173 4.66278C10.6837 4.55942 10.6757 4.40908 10.6757 3.80009H10.0257ZM12.1257 5.90014V5.25014C11.5167 5.25014 11.3664 5.24212 11.263 5.20854L11.0622 5.82672L10.8613 6.44491C11.2099 6.55816 11.6179 6.55014 12.1257 6.55014V5.90014ZM10.0991 4.86364L9.48091 5.06451C9.69359 5.71906 10.2068 6.23223 10.8613 6.44491L11.0622 5.82672L11.263 5.20854C11.0043 5.12445 10.8014 4.92156 10.7173 4.66278L10.0991 4.86364ZM2.90046 11.1296L2.93282 10.4804C2.12862 10.4403 1.83891 10.3212 1.6592 10.1414L1.19958 10.6011L0.739965 11.0607C1.29059 11.6113 2.02716 11.7369 2.8681 11.7788L2.90046 11.1296ZM10.4012 11.1499L10.4012 10.4999L5.90146 10.5L5.90147 11.15L5.90148 11.8L10.4012 11.7999L10.4012 11.1499ZM13.4008 11.1296L13.4331 11.7788C14.2741 11.7369 15.0107 11.6113 15.5613 11.0607L15.1017 10.6011L14.642 10.1414C14.4623 10.3212 14.1726 10.4403 13.3684 10.4804L13.4008 11.1296ZM0.650391 0.650024V1.30002H6.87558V0.650024V2.44379e-05H0.650391V0.650024ZM0.671054 8.90021L0.0218602 8.93257C0.0637781 9.7735 0.189342 10.5101 0.739965 11.0607L1.19958 10.6011L1.6592 10.1414C1.4795 9.96175 1.36033 9.67204 1.32025 8.86785L0.671054 8.90021ZM0.650543 3.65001V4.30001H5.15068V3.65001V3.00001H0.650543V3.65001ZM0.650543 5.89978V6.54978H3.65063V5.89978V5.24978H0.650543V5.89978ZM10.0255 2.15002V2.80002H11.3915V2.15002V1.50002H10.0255V2.15002ZM14.6934 4.12219L14.1211 4.43038L15.0786 6.20834L15.6508 5.90014L16.2231 5.59195L15.2657 3.81399L14.6934 4.12219ZM11.3915 2.15002V2.80002C11.9503 2.80002 12.3214 2.80078 12.6097 2.82989C12.8834 2.85753 13.028 2.90664 13.1397 2.97335L13.473 2.41531L13.8063 1.85727C13.4738 1.65869 13.1234 1.57516 12.7403 1.53647C12.3718 1.49926 11.9243 1.50002 11.3915 1.50002V2.15002ZM14.6934 4.12219L15.2657 3.81402C15.0131 3.34493 14.8016 2.95057 14.5941 2.64373C14.3784 2.32473 14.1388 2.05586 13.8063 1.85727L13.473 2.41531L13.1397 2.97335C13.2513 3.04005 13.3631 3.14409 13.5172 3.37194C13.6795 3.61195 13.8562 3.93839 14.1211 4.43036L14.6934 4.12219Z"
                                fill="currentcolor"></path>
                        </svg>
                    </span>
                    <span>Shipping</span>
                    <span class="aq-tooltip-item">Add a discount code</span>
                </button>
            </div>
            <div class="aq-cartmini-total d-flex justify-content-between align-items-center">
                <span class="aq-cartmini-total-title">Subtotal</span>
                <span class="aq-cartmini-total-value">$49.99 USD</span>
            </div>
            <div class="aq-cartmini-main-btn d-flex justify-content-between">
                <a href="{{ route('cart') }}" class="aq-btn-black btn-red-bg text-center w-100">View Cart</a>
                <a href="{{ route('checkout') }}" class="aq-btn-black text-center w-100">Checkout</a>
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
                    <button class="aq-btn-black btn-cancel border-btn w-100 text-center ">Cancel</button>
                    <button class="aq-btn-black btn-red-bg w-100 text-center ">Save</button>
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
                        <input type="text" placeholder="Discount code">
                    </form>
                </div>
                <div class="aq-cartmini-tools-btn d-flex">
                    <button class="aq-btn-black btn-cancel border-btn w-100 text-center ">Cancel</button>
                    <button class="aq-btn-black btn-red-bg w-100 text-center ">Save</button>
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
                            <input type="text" placeholder="17080">
                        </div>
                    </form>
                </div>
                <div class="aq-cartmini-tools-btn d-flex">
                    <button class="aq-btn-black btn-cancel border-btn w-100 text-center ">Cancel</button>
                    <button class="aq-btn-black btn-red-bg w-100 text-center ">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Cartmini area -->

    <!-- wishlist popup -->
    <div class="aq-wishlist-popup-wrap aq-wishlist-popup aq-wishlist-active">
        <div class="aq-wishlist-popup-top d-flex justify-content-between align-items-center">
            <div>
                <span class="aq-wishlist-popup-name">Wishlist</span>
                <span class="aq-wishlist-popup-count">(2)</span>
            </div>
            <span class="aq-wishlist-popup-close aq-wishlist-close"><i class="fa-regular fa-xmark"></i></span>
        </div>
        <div class="aq-wishlist-popup-middle">
            <div
                class="aq-wishlist-popup-item d-flex justify-content-center justify-content-sm-between align-items-center">
                <div class="aq-wishlist-popup-thumb-wrap d-flex align-items-center">
                    <span class="aq-wishlist-popup-remove"><i class="fa-regular fa-xmark"></i></span>
                    <div class="aq-wishlist-popup-thumb  d-flex align-items-center">
                        <a href="product-details-default.html">
                            <img src="{{ asset('assets/img/corporate/nazneen_georgette_kurti.png') }}"
                                alt="Nazneen Kurti">
                        </a>
                        <div class="aq-wishlist-popup-thumb-info">
                            <h4 class="aq-wishlist-popup-title"><a href="product-details-default.html">Mosaic Vanity
                                    Bag</a></h4>
                            <span class="aq-wishlist-popup-price">₹8,500</span>
                        </div>
                    </div>
                </div>
                <div class="aq-wishlist-popup-btn">
                    <button class="aq-btn-black btn-red-bg  btn-h-40">Add to bag</button>
                </div>
            </div>
            <div
                class="aq-wishlist-popup-item d-flex justify-content-center justify-content-sm-between align-items-center">
                <div class="aq-wishlist-popup-thumb-wrap d-flex align-items-center">
                    <span class="aq-wishlist-popup-remove"><i class="fa-regular fa-xmark"></i></span>
                    <div class="aq-wishlist-popup-thumb  d-flex align-items-center">
                        <a href="product-details-default.html">
                            <img src="{{ asset('assets/img/corporate/shama_cotton_anarkali.png') }}"
                                alt="Shama Anarkali">
                        </a>
                        <div class="aq-wishlist-popup-thumb-info">
                            <h4 class="aq-wishlist-popup-title"><a href="product-details-default.html">Georgia Mini
                                    Bag</a></h4>
                            <span class="aq-wishlist-popup-price">578.00</span>
                        </div>
                    </div>
                </div>
                <div class="aq-wishlist-popup-btn">
                    <button class="aq-btn-black btn-red-bg  btn-h-40">Add to bag</button>
                </div>
            </div>
            <div
                class="aq-wishlist-popup-item d-flex justify-content-center justify-content-sm-between align-items-center">
                <div class="aq-wishlist-popup-thumb-wrap d-flex align-items-center">
                    <span class="aq-wishlist-popup-remove"><i class="fa-regular fa-xmark"></i></span>
                    <div class="aq-wishlist-popup-thumb  d-flex align-items-center">
                        <a href="product-details-default.html">
                            <img src="{{ asset('assets/img/corporate/gallery_unstitched_suit.png') }}" alt="Gift Box">
                        </a>
                        <div class="aq-wishlist-popup-thumb-info">
                            <h4 class="aq-wishlist-popup-title"><a href="product-details-default.html">Osette Backpack
                                    Bag</a></h4>
                            <span class="aq-wishlist-popup-price">578.00</span>
                        </div>
                    </div>
                </div>
                <div class="aq-wishlist-popup-btn">
                    <button class="aq-btn-black btn-red-bg  btn-h-40">Add to bag</button>
                </div>
            </div>
        </div>
        <div class="aq-wishlist-popup-bottom d-flex justify-content-between align-items-center">
            <a class="aq-line-anim" href="wishlist.html">Open wishlist page</a>
            <a class="aq-line-anim" href="product-default.html">Continue shopping</a>
        </div>
        <div class="aq-wishlist-popup-text">
            <p><b>Shama Cotton Anarkali</b> has been added to Wishlist.</p>
        </div>
    </div>
    <!-- wishlist popup -->


    <!-- compare canvas -->

    <!-- login modal -->
    <div class="aq-login-modal-style">
        <div class="modal fade" id="exampleModalToggle" role="dialog" aria-hidden="true"
            aria-labelledby="exampleModalToggle" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="aq-login-wrapper">
                        <div class="aq-login-top text-center mb-30">
                            <h3 class="aq-login-title">Sign in to Oudhyana.</h3>
                            <p>Please enter your details below to sign in.</p>
                        </div>
                        <div class="aq-login-option">
                            <div class="aq-login-input-wrapper">
                                <div class="aq-login-input-box">
                                    <label class="aq-form-label">Your Email <span>*</span></label>
                                    <input class="aq-form-control" type="email" placeholder="email@address.com">
                                </div>
                                <div class="aq-login-input-box">
                                    <label class="aq-form-label">Password <span>*</span></label>
                                    <div class="aq-login-input p-relative">
                                        <input class="aq_password aq-form-control" type="password"
                                            placeholder="6+ characters required">
                                        <div class="aq-login-input-eye password-show-toggle">
                                            <span class="open-eye">
                                                <svg width="18" height="14" viewBox="0 0 18 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1 6.77778C1 6.77778 3.90909 1 9 1C14.0909 1 17 6.77778 17 6.77778C17 6.77778 14.0909 12.5556 9 12.5556C3.90909 12.5556 1 6.77778 1 6.77778Z"
                                                        stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path
                                                        d="M9.00018 8.94466C10.2052 8.94466 11.182 7.97461 11.182 6.77799C11.182 5.58138 10.2052 4.61133 9.00018 4.61133C7.79519 4.61133 6.81836 5.58138 6.81836 6.77799C6.81836 7.97461 7.79519 8.94466 9.00018 8.94466Z"
                                                        stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                            <span class="close-eye">
                                                <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.8822 11.7457C6.72311 11.7457 6.56402 11.6871 6.43842 11.5615C5.7518 10.8749 5.375 9.9622 5.375 8.99926C5.375 6.99803 6.99943 5.3736 9.00066 5.3736C9.9636 5.3736 10.8763 5.7504 11.5629 6.43701C11.6801 6.55424 11.7471 6.71333 11.7471 6.8808C11.7471 7.04827 11.6801 7.20736 11.5629 7.32459L7.32599 11.5615C7.20039 11.6871 7.0413 11.7457 6.8822 11.7457ZM9.00066 6.6296C7.69442 6.6296 6.631 7.69302 6.631 8.99926C6.631 9.41793 6.73986 9.81985 6.94082 10.1715L10.1729 6.93941C9.82125 6.73845 9.41933 6.6296 9.00066 6.6296Z"
                                                        fill="currentcolor"></path>
                                                    <path opacity="0.5"
                                                        d="M3.63816 14.4503C3.49582 14.4503 3.3451 14.4001 3.22787 14.2996C2.33192 13.5376 1.52808 12.5998 0.841463 11.5112C-0.0461127 10.1296 -0.0461127 7.87721 0.841463 6.48723C2.88456 3.28861 5.8571 1.44647 8.99711 1.44647C10.8393 1.44647 12.6563 2.08285 14.2472 3.28024C14.5235 3.48957 14.5821 3.88312 14.3728 4.15944C14.1635 4.43576 13.7699 4.49437 13.4936 4.28504C12.1204 3.24674 10.5629 2.70248 8.99711 2.70248C6.29252 2.70248 3.70515 4.32691 1.89651 7.16547C1.2685 8.14516 1.2685 9.85332 1.89651 10.833C2.52451 11.8127 3.24462 12.6584 4.04009 13.345C4.29966 13.5711 4.33315 13.9646 4.10707 14.2326C3.98984 14.3749 3.814 14.4503 3.63816 14.4503Z"
                                                        fill="currentcolor"></path>
                                                    <path opacity="0.5"
                                                        d="M9.00382 16.552C7.89017 16.552 6.80163 16.3259 5.75496 15.8821C5.43678 15.7482 5.28606 15.3797 5.42003 15.0616C5.554 14.7434 5.92243 14.5927 6.24062 14.7266C7.12819 15.1034 8.05764 15.296 8.99545 15.296C11.7 15.296 14.2874 13.6716 16.0961 10.833C16.7241 9.85333 16.7241 8.14517 16.0961 7.16548C15.8365 6.75519 15.5518 6.36164 15.2503 5.99321C15.0326 5.72527 15.0745 5.33172 15.3425 5.10564C15.6104 4.88793 16.0039 4.92142 16.23 5.19775C16.5566 5.59967 16.8748 6.03508 17.1595 6.48724C18.047 7.86885 18.047 10.1213 17.1595 11.5113C15.1164 14.7099 12.1438 16.552 9.00382 16.552Z"
                                                        fill="currentcolor"></path>
                                                    <path
                                                        d="M9.58061 12.5747C9.28754 12.5747 9.01959 12.3654 8.96098 12.0639C8.89399 11.7206 9.12007 11.3941 9.46338 11.3355C10.3845 11.168 11.1548 10.3976 11.3223 9.47657C11.3893 9.13327 11.7158 8.91556 12.0591 8.97417C12.4024 9.04116 12.6285 9.36772 12.5615 9.71103C12.2936 11.1596 11.1381 12.3068 9.69783 12.5747C9.65597 12.5663 9.62247 12.5747 9.58061 12.5747Z"
                                                        fill="currentcolor"></path>
                                                    <path
                                                        d="M0.625908 18.0007C0.466815 18.0007 0.307721 17.9421 0.18212 17.8165C-0.0607068 17.5736 -0.0607068 17.1717 0.18212 16.9289L6.43702 10.674C6.67984 10.4312 7.08177 10.4312 7.32459 10.674C7.56742 10.9168 7.56742 11.3188 7.32459 11.5616L1.0697 17.8165C0.944096 17.9421 0.785002 18.0007 0.625908 18.0007Z"
                                                        fill="currentcolor"></path>
                                                    <path
                                                        d="M11.122 7.50881C10.9629 7.50881 10.8038 7.45019 10.6782 7.32459C10.4354 7.08177 10.4354 6.67984 10.6782 6.43702L16.9331 0.182121C17.1759 -0.0607068 17.5779 -0.0607068 17.8207 0.182121C18.0635 0.424948 18.0635 0.826869 17.8207 1.0697L11.5658 7.32459C11.4402 7.45019 11.2811 7.50881 11.122 7.50881Z"
                                                        fill="currentcolor"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="aq-login-suggetions d-sm-flex align-items-center justify-content-between mb-20">
                                <div class="aq-login-remeber">
                                    <input class="aq-form-checkbox" id="remeber" type="checkbox">
                                    <label class="aq-form-checkbox-label" for="remeber">Remember me</label>
                                </div>
                                <div class="aq-login-forgot">
                                    <a data-bs-target="#exampleModalToggle3" data-bs-toggle="modal"
                                        href="javascript:void(0);">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="aq-login-bottom-wrap mb-30">
                                <button class="aq-login-btn w-100 mb-10">Login</button>
                                <button data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                                    class="aq-login-btn btn-transparent w-100">Create Account</button>
                            </div>
                            <div class="aq-login-mail text-center mb-20">
                                <p>Or continue with</p>
                            </div>
                            <div class="aq-login-social d-flex flex-wrap align-items-center justify-content-center">
                                <div class="aq-login-option-item">
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 20 20" fill="none">
                                            <path
                                                d="M19.25 9.83876C19.25 9.04738 19.1845 8.46988 19.0427 7.871H9.82144V11.4429H15.2341C15.125 12.3306 14.5357 13.6674 13.2262 14.5657L13.2078 14.6852L16.1234 16.8987L16.3254 16.9185C18.1805 15.2395 19.25 12.769 19.25 9.83876Z"
                                                fill="#4285F4"></path>
                                            <path
                                                d="M9.82083 19.25C12.4726 19.25 14.6994 18.3943 16.3254 16.9185L13.2262 14.5657C12.3968 15.1325 11.2831 15.5282 9.82083 15.5282C7.22363 15.5282 5.01929 13.8493 4.23351 11.5285L4.11833 11.5381L1.08667 13.8375L1.04703 13.9455C2.66208 17.0896 5.97954 19.25 9.82083 19.25Z"
                                                fill="#34A853"></path>
                                            <path
                                                d="M4.23351 11.5285C4.02617 10.9297 3.90675 10.288 3.90675 9.62497C3.90675 8.96188 4.02674 8.32023 4.22317 7.72135L4.21768 7.59381L1.14803 5.25756L1.04759 5.30438C0.381948 6.60912 0 8.07428 0 9.62497C0 11.1757 0.381383 12.6407 1.04703 13.9455L4.23351 11.5285Z"
                                                fill="#FBBC05"></path>
                                            <path
                                                d="M9.82088 3.72164C11.6651 3.72164 12.9091 4.50233 13.6185 5.15474L16.3903 2.5025C14.688 0.951809 12.4726 0 9.82088 0C5.97957 0 2.66266 2.16024 1.04759 5.30438L4.22317 7.72135C5.01987 5.40066 7.22367 3.72164 9.82088 3.72164Z"
                                                fill="#EB4335"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="aq-login-option-item">
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="20"
                                            viewBox="0 0 17 20" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M15.4121 17.1597C15.9996 16.2597 16.2186 15.7997 16.6667 14.7897C13.361 13.5298 12.8333 8.79989 16.0991 6.98994C15.1034 5.72997 13.6995 5 12.3753 5C11.4194 5 10.7623 5.25 10.1748 5.48C9.67699 5.66999 9.22894 5.83997 8.67135 5.83997C8.07395 5.83997 7.54623 5.65 6.98865 5.45C6.38129 5.23001 5.74405 5 4.9475 5C3.46394 5 1.88081 5.90998 0.875176 7.46994C-0.53869 9.66988 -0.289768 13.7898 1.99034 17.3097C2.8068 18.5696 3.90205 19.9796 5.32587 19.9996C5.92328 20.0096 6.31159 19.8296 6.73973 19.6396C7.22762 19.4196 7.75532 19.1796 8.68131 19.1796C9.60729 19.1696 10.125 19.4196 10.6129 19.6396C11.0311 19.8296 11.4095 20.0096 11.9969 19.9996C13.4407 19.9796 14.5956 18.4196 15.4121 17.1597Z"
                                                fill="#010F1C"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12.1721 0C12.3314 1.09997 11.8833 2.18995 11.2959 2.94993C10.6686 3.76991 9.57333 4.40988 8.51791 4.36988C8.32873 3.30991 8.81661 2.21993 9.41402 1.48995C10.0811 0.689972 11.2062 0.0699982 12.1721 0Z"
                                                fill="#010F1C"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="aq-login-option-item">
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 20 20" fill="none">
                                            <path
                                                d="M20 10C20 4.5 15.5 0 10 0C4.5 0 0 4.5 0 10C0 15 3.625 19.125 8.375 19.875V12.875H5.875V10H8.375V7.75C8.375 5.25 9.875 3.875 12.125 3.875C13.25 3.875 14.375 4.125 14.375 4.125V6.625H13.125C11.875 6.625 11.5 7.375 11.5 8.125V10H14.25L13.75 12.875H11.375V20C16.375 19.25 20 15 20 10Z"
                                                fill="#2151F9"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="aq-login-option-item">
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15"
                                            viewBox="0 0 16 15" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M5.04202 0H0L5.97809 8.15716L0.38242 15H2.96778L7.19998 9.82455L10.958 14.9525H16L9.84822 6.55824L9.85911 6.57272L15.1559 0.0952909H12.5705L8.63704 4.90552L5.04202 0ZM2.78311 1.42858H4.35275L13.2169 13.5238H11.6472L2.78311 1.42858Z"
                                                fill="#B87333"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalToggle2" role="dialog" aria-hidden="true"
            aria-labelledby="exampleModalToggle2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="aq-login-wrapper">
                        <div class="aq-login-top text-center mb-30">
                            <h3 class="aq-login-title">Create Account</h3>
                            <p>Please register below to create an account.</p>
                        </div>
                        <div class="aq-login-option">
                            <div class="aq-login-input-wrapper">
                                <div class="aq-login-input-box">
                                    <label class="aq-form-label">Full Name <span>*</span></label>
                                    <input class="aq-form-control" type="text" placeholder="your name">
                                </div>
                                <div class="aq-login-input-box">
                                    <label class="aq-form-label">Your Email <span>*</span></label>
                                    <input class="aq-form-control" type="email" placeholder="email@address.com">
                                </div>
                                <div class="aq-login-input-box">
                                    <label class="aq-form-label">Password <span>*</span></label>
                                    <div class="aq-login-input p-relative">
                                        <input class="aq_password" type="password" placeholder="6+ characters required">
                                        <div class="aq-login-input-eye password-show-toggle">
                                            <span class="open-eye">
                                                <svg width="18" height="14" viewBox="0 0 18 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1 6.77778C1 6.77778 3.90909 1 9 1C14.0909 1 17 6.77778 17 6.77778C17 6.77778 14.0909 12.5556 9 12.5556C3.90909 12.5556 1 6.77778 1 6.77778Z"
                                                        stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path
                                                        d="M9.00018 8.94466C10.2052 8.94466 11.182 7.97461 11.182 6.77799C11.182 5.58138 10.2052 4.61133 9.00018 4.61133C7.79519 4.61133 6.81836 5.58138 6.81836 6.77799C6.81836 7.97461 7.79519 8.94466 9.00018 8.94466Z"
                                                        stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                            <span class="close-eye">
                                                <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.8822 11.7457C6.72311 11.7457 6.56402 11.6871 6.43842 11.5615C5.7518 10.8749 5.375 9.9622 5.375 8.99926C5.375 6.99803 6.99943 5.3736 9.00066 5.3736C9.9636 5.3736 10.8763 5.7504 11.5629 6.43701C11.6801 6.55424 11.7471 6.71333 11.7471 6.8808C11.7471 7.04827 11.6801 7.20736 11.5629 7.32459L7.32599 11.5615C7.20039 11.6871 7.0413 11.7457 6.8822 11.7457ZM9.00066 6.6296C7.69442 6.6296 6.631 7.69302 6.631 8.99926C6.631 9.41793 6.73986 9.81985 6.94082 10.1715L10.1729 6.93941C9.82125 6.73845 9.41933 6.6296 9.00066 6.6296Z"
                                                        fill="currentcolor"></path>
                                                    <path opacity="0.5"
                                                        d="M3.63816 14.4503C3.49582 14.4503 3.3451 14.4001 3.22787 14.2996C2.33192 13.5376 1.52808 12.5998 0.841463 11.5112C-0.0461127 10.1296 -0.0461127 7.87721 0.841463 6.48723C2.88456 3.28861 5.8571 1.44647 8.99711 1.44647C10.8393 1.44647 12.6563 2.08285 14.2472 3.28024C14.5235 3.48957 14.5821 3.88312 14.3728 4.15944C14.1635 4.43576 13.7699 4.49437 13.4936 4.28504C12.1204 3.24674 10.5629 2.70248 8.99711 2.70248C6.29252 2.70248 3.70515 4.32691 1.89651 7.16547C1.2685 8.14516 1.2685 9.85332 1.89651 10.833C2.52451 11.8127 3.24462 12.6584 4.04009 13.345C4.29966 13.5711 4.33315 13.9646 4.10707 14.2326C3.98984 14.3749 3.814 14.4503 3.63816 14.4503Z"
                                                        fill="currentcolor"></path>
                                                    <path opacity="0.5"
                                                        d="M9.00382 16.552C7.89017 16.552 6.80163 16.3259 5.75496 15.8821C5.43678 15.7482 5.28606 15.3797 5.42003 15.0616C5.554 14.7434 5.92243 14.5927 6.24062 14.7266C7.12819 15.1034 8.05764 15.296 8.99545 15.296C11.7 15.296 14.2874 13.6716 16.0961 10.833C16.7241 9.85333 16.7241 8.14517 16.0961 7.16548C15.8365 6.75519 15.5518 6.36164 15.2503 5.99321C15.0326 5.72527 15.0745 5.33172 15.3425 5.10564C15.6104 4.88793 16.0039 4.92142 16.23 5.19775C16.5566 5.59967 16.8748 6.03508 17.1595 6.48724C18.047 7.86885 18.047 10.1213 17.1595 11.5113C15.1164 14.7099 12.1438 16.552 9.00382 16.552Z"
                                                        fill="currentcolor"></path>
                                                    <path
                                                        d="M9.58061 12.5747C9.28754 12.5747 9.01959 12.3654 8.96098 12.0639C8.89399 11.7206 9.12007 11.3941 9.46338 11.3355C10.3845 11.168 11.1548 10.3976 11.3223 9.47657C11.3893 9.13327 11.7158 8.91556 12.0591 8.97417C12.4024 9.04116 12.6285 9.36772 12.5615 9.71103C12.2936 11.1596 11.1381 12.3068 9.69783 12.5747C9.65597 12.5663 9.62247 12.5747 9.58061 12.5747Z"
                                                        fill="currentcolor"></path>
                                                    <path
                                                        d="M0.625908 18.0007C0.466815 18.0007 0.307721 17.9421 0.18212 17.8165C-0.0607068 17.5736 -0.0607068 17.1717 0.18212 16.9289L6.43702 10.674C6.67984 10.4312 7.08177 10.4312 7.32459 10.674C7.56742 10.9168 7.56742 11.3188 7.32459 11.5616L1.0697 17.8165C0.944096 17.9421 0.785002 18.0007 0.625908 18.0007Z"
                                                        fill="currentcolor"></path>
                                                    <path
                                                        d="M11.122 7.50881C10.9629 7.50881 10.8038 7.45019 10.6782 7.32459C10.4354 7.08177 10.4354 6.67984 10.6782 6.43702L16.9331 0.182121C17.1759 -0.0607068 17.5779 -0.0607068 17.8207 0.182121C18.0635 0.424948 18.0635 0.826869 17.8207 1.0697L11.5658 7.32459C11.4402 7.45019 11.2811 7.50881 11.122 7.50881Z"
                                                        fill="currentcolor"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="aq-login-input-box">
                                    <label class="aq-form-label">Password confirmation <span>*</span></label>
                                    <div class="aq-login-input p-relative">
                                        <input class="aq_password" type="password" placeholder="Password confirmation">
                                        <div class="aq-login-input-eye password-show-toggle">
                                            <span class="open-eye">
                                                <svg width="18" height="14" viewBox="0 0 18 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1 6.77778C1 6.77778 3.90909 1 9 1C14.0909 1 17 6.77778 17 6.77778C17 6.77778 14.0909 12.5556 9 12.5556C3.90909 12.5556 1 6.77778 1 6.77778Z"
                                                        stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path
                                                        d="M9.00018 8.94466C10.2052 8.94466 11.182 7.97461 11.182 6.77799C11.182 5.58138 10.2052 4.61133 9.00018 4.61133C7.79519 4.61133 6.81836 5.58138 6.81836 6.77799C6.81836 7.97461 7.79519 8.94466 9.00018 8.94466Z"
                                                        stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                            <span class="close-eye">
                                                <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.8822 11.7457C6.72311 11.7457 6.56402 11.6871 6.43842 11.5615C5.7518 10.8749 5.375 9.9622 5.375 8.99926C5.375 6.99803 6.99943 5.3736 9.00066 5.3736C9.9636 5.3736 10.8763 5.7504 11.5629 6.43701C11.6801 6.55424 11.7471 6.71333 11.7471 6.8808C11.7471 7.04827 11.6801 7.20736 11.5629 7.32459L7.32599 11.5615C7.20039 11.6871 7.0413 11.7457 6.8822 11.7457ZM9.00066 6.6296C7.69442 6.6296 6.631 7.69302 6.631 8.99926C6.631 9.41793 6.73986 9.81985 6.94082 10.1715L10.1729 6.93941C9.82125 6.73845 9.41933 6.6296 9.00066 6.6296Z"
                                                        fill="currentcolor"></path>
                                                    <path opacity="0.5"
                                                        d="M3.63816 14.4503C3.49582 14.4503 3.3451 14.4001 3.22787 14.2996C2.33192 13.5376 1.52808 12.5998 0.841463 11.5112C-0.0461127 10.1296 -0.0461127 7.87721 0.841463 6.48723C2.88456 3.28861 5.8571 1.44647 8.99711 1.44647C10.8393 1.44647 12.6563 2.08285 14.2472 3.28024C14.5235 3.48957 14.5821 3.88312 14.3728 4.15944C14.1635 4.43576 13.7699 4.49437 13.4936 4.28504C12.1204 3.24674 10.5629 2.70248 8.99711 2.70248C6.29252 2.70248 3.70515 4.32691 1.89651 7.16547C1.2685 8.14516 1.2685 9.85332 1.89651 10.833C2.52451 11.8127 3.24462 12.6584 4.04009 13.345C4.29966 13.5711 4.33315 13.9646 4.10707 14.2326C3.98984 14.3749 3.814 14.4503 3.63816 14.4503Z"
                                                        fill="currentcolor"></path>
                                                    <path opacity="0.5"
                                                        d="M9.00382 16.552C7.89017 16.552 6.80163 16.3259 5.75496 15.8821C5.43678 15.7482 5.28606 15.3797 5.42003 15.0616C5.554 14.7434 5.92243 14.5927 6.24062 14.7266C7.12819 15.1034 8.05764 15.296 8.99545 15.296C11.7 15.296 14.2874 13.6716 16.0961 10.833C16.7241 9.85333 16.7241 8.14517 16.0961 7.16548C15.8365 6.75519 15.5518 6.36164 15.2503 5.99321C15.0326 5.72527 15.0745 5.33172 15.3425 5.10564C15.6104 4.88793 16.0039 4.92142 16.23 5.19775C16.5566 5.59967 16.8748 6.03508 17.1595 6.48724C18.047 7.86885 18.047 10.1213 17.1595 11.5113C15.1164 14.7099 12.1438 16.552 9.00382 16.552Z"
                                                        fill="currentcolor"></path>
                                                    <path
                                                        d="M9.58061 12.5747C9.28754 12.5747 9.01959 12.3654 8.96098 12.0639C8.89399 11.7206 9.12007 11.3941 9.46338 11.3355C10.3845 11.168 11.1548 10.3976 11.3223 9.47657C11.3893 9.13327 11.7158 8.91556 12.0591 8.97417C12.4024 9.04116 12.6285 9.36772 12.5615 9.71103C12.2936 11.1596 11.1381 12.3068 9.69783 12.5747C9.65597 12.5663 9.62247 12.5747 9.58061 12.5747Z"
                                                        fill="currentcolor"></path>
                                                    <path
                                                        d="M0.625908 18.0007C0.466815 18.0007 0.307721 17.9421 0.18212 17.8165C-0.0607068 17.5736 -0.0607068 17.1717 0.18212 16.9289L6.43702 10.674C6.67984 10.4312 7.08177 10.4312 7.32459 10.674C7.56742 10.9168 7.56742 11.3188 7.32459 11.5616L1.0697 17.8165C0.944096 17.9421 0.785002 18.0007 0.625908 18.0007Z"
                                                        fill="currentcolor"></path>
                                                    <path
                                                        d="M11.122 7.50881C10.9629 7.50881 10.8038 7.45019 10.6782 7.32459C10.4354 7.08177 10.4354 6.67984 10.6782 6.43702L16.9331 0.182121C17.1759 -0.0607068 17.5779 -0.0607068 17.8207 0.182121C18.0635 0.424948 18.0635 0.826869 17.8207 1.0697L11.5658 7.32459C11.4402 7.45019 11.2811 7.50881 11.122 7.50881Z"
                                                        fill="currentcolor"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="aq-login-suggetions d-sm-flex align-items-center justify-content-between mb-20">
                                <div class="aq-login-remeber">
                                    <input class="aq-form-checkbox" id="remeber1" type="checkbox">
                                    <label class="aq-form-checkbox-label" for="remeber1">Remember me</label>
                                </div>
                            </div>
                            <div class="aq-login-bottom-wrap mb-30 text-center">
                                <button class="aq-login-btn w-100 mb-15">Login</button>
                                <span class="aq-login-account">Already have an account? <button
                                        data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Login
                                        here</button></span>
                            </div>
                            <div class="aq-login-mail text-center mb-20">
                                <p>Or continue with</p>
                            </div>
                            <div class="aq-login-social d-flex flex-wrap align-items-center justify-content-center">
                                <div class="aq-login-option-item">
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 20 20" fill="none">
                                            <path
                                                d="M19.25 9.83876C19.25 9.04738 19.1845 8.46988 19.0427 7.871H9.82144V11.4429H15.2341C15.125 12.3306 14.5357 13.6674 13.2262 14.5657L13.2078 14.6852L16.1234 16.8987L16.3254 16.9185C18.1805 15.2395 19.25 12.769 19.25 9.83876Z"
                                                fill="#4285F4"></path>
                                            <path
                                                d="M9.82083 19.25C12.4726 19.25 14.6994 18.3943 16.3254 16.9185L13.2262 14.5657C12.3968 15.1325 11.2831 15.5282 9.82083 15.5282C7.22363 15.5282 5.01929 13.8493 4.23351 11.5285L4.11833 11.5381L1.08667 13.8375L1.04703 13.9455C2.66208 17.0896 5.97954 19.25 9.82083 19.25Z"
                                                fill="#34A853"></path>
                                            <path
                                                d="M4.23351 11.5285C4.02617 10.9297 3.90675 10.288 3.90675 9.62497C3.90675 8.96188 4.02674 8.32023 4.22317 7.72135L4.21768 7.59381L1.14803 5.25756L1.04759 5.30438C0.381948 6.60912 0 8.07428 0 9.62497C0 11.1757 0.381383 12.6407 1.04703 13.9455L4.23351 11.5285Z"
                                                fill="#FBBC05"></path>
                                            <path
                                                d="M9.82088 3.72164C11.6651 3.72164 12.9091 4.50233 13.6185 5.15474L16.3903 2.5025C14.688 0.951809 12.4726 0 9.82088 0C5.97957 0 2.66266 2.16024 1.04759 5.30438L4.22317 7.72135C5.01987 5.40066 7.22367 3.72164 9.82088 3.72164Z"
                                                fill="#EB4335"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="aq-login-option-item">
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="20"
                                            viewBox="0 0 17 20" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M15.4121 17.1597C15.9996 16.2597 16.2186 15.7997 16.6667 14.7897C13.361 13.5298 12.8333 8.79989 16.0991 6.98994C15.1034 5.72997 13.6995 5 12.3753 5C11.4194 5 10.7623 5.25 10.1748 5.48C9.67699 5.66999 9.22894 5.83997 8.67135 5.83997C8.07395 5.83997 7.54623 5.65 6.98865 5.45C6.38129 5.23001 5.74405 5 4.9475 5C3.46394 5 1.88081 5.90998 0.875176 7.46994C-0.53869 9.66988 -0.289768 13.7898 1.99034 17.3097C2.8068 18.5696 3.90205 19.9796 5.32587 19.9996C5.92328 20.0096 6.31159 19.8296 6.73973 19.6396C7.22762 19.4196 7.75532 19.1796 8.68131 19.1796C9.60729 19.1696 10.125 19.4196 10.6129 19.6396C11.0311 19.8296 11.4095 20.0096 11.9969 19.9996C13.4407 19.9796 14.5956 18.4196 15.4121 17.1597Z"
                                                fill="#010F1C"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12.1721 0C12.3314 1.09997 11.8833 2.18995 11.2959 2.94993C10.6686 3.76991 9.57333 4.40988 8.51791 4.36988C8.32873 3.30991 8.81661 2.21993 9.41402 1.48995C10.0811 0.689972 11.2062 0.0699982 12.1721 0Z"
                                                fill="#010F1C"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="aq-login-option-item">
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 20 20" fill="none">
                                            <path
                                                d="M20 10C20 4.5 15.5 0 10 0C4.5 0 0 4.5 0 10C0 15 3.625 19.125 8.375 19.875V12.875H5.875V10H8.375V7.75C8.375 5.25 9.875 3.875 12.125 3.875C13.25 3.875 14.375 4.125 14.375 4.125V6.625H13.125C11.875 6.625 11.5 7.375 11.5 8.125V10H14.25L13.75 12.875H11.375V20C16.375 19.25 20 15 20 10Z"
                                                fill="#2151F9"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="aq-login-option-item">
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15"
                                            viewBox="0 0 16 15" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M5.04202 0H0L5.97809 8.15716L0.38242 15H2.96778L7.19998 9.82455L10.958 14.9525H16L9.84822 6.55824L9.85911 6.57272L15.1559 0.0952909H12.5705L8.63704 4.90552L5.04202 0ZM2.78311 1.42858H4.35275L13.2169 13.5238H11.6472L2.78311 1.42858Z"
                                                fill="#B87333"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalToggle3" role="dialog" aria-hidden="true"
            aria-labelledby="exampleModalToggle3" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="aq-login-wrapper">
                        <div class="aq-login-top text-center mb-30">
                            <h3 class="aq-login-title">Forgot password</h3>
                            <p>No worries, weâ€™ll send you reset instructions.</p>
                        </div>
                        <div class="aq-login-option">
                            <div class="aq-login-input-wrapper">
                                <div class="aq-login-input-box">
                                    <label class="aq-form-label">Your Email <span>*</span></label>
                                    <input class="aq-form-control" type="email" placeholder="email@address.com">
                                </div>
                            </div>
                            <div class="aq-login-bottom-wrap text-center mb-20">
                                <button class="aq-login-btn w-100 mb-10">Reset Password</button>
                                <button class="aq-login-account color" data-bs-target="#exampleModalToggle"
                                    data-bs-toggle="modal"><span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                            viewBox="0 0 12 12" fill="none">
                                            <path d="M10.75 5.75H0.75M0.75 5.75L5.75 10.75M0.75 5.75L5.75 0.75"
                                                stroke="currentcolor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                    </span> Back to Log in</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- login modal -->

    <!-- Modal -->
    <div class="modal fade aq-product-modal" id="producQuickViewModal" role="dialog" tabindex="-1"
        aria-labelledby="producQuickViewModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="aq-product-modal-content">
                    <button type="button" class="aq-product-modal-close-btn" data-bs-toggle="modal"
                        data-bs-target="#producQuickViewModal"><i class="fa-regular fa-xmark"></i></button>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-10">
                        <div class="aq-modal-slider-wrap">
                            <div class="swiper aq-modal-slider-active p-relative">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="aq-modal-slider">
                                            <img class="w-100"
                                                src="{{ asset('assets/img/corporate/fashion1_product_product-1_front-img-1.webp') }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="aq-modal-slider">
                                            <img class="w-100"
                                                src="{{ asset('assets/img/corporate/fashion1_product_product-2_front-img-1.webp') }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="aq-modal-slider">
                                            <img class="w-100"
                                                src="{{ asset('assets/img/corporate/fashion1_product_product-3_front-img-1.webp') }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="aq-modal-slider">
                                            <img class="w-100"
                                                src="{{ asset('assets/img/corporate/fashion1_product_product-4_front-img-1.webp') }}"
                                                alt="">
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
                            <div class="aq-product-details-category"><span>Girls Clothes</span></div>
                            <h3 class="aq-product-details-title mb-10">Osette backpack Bags</h3>

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
                                <h4 class="aq-product-details-title-sm mb-15"><label>Size:</label> M</h4>
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
                                        <img src="{{ asset('assets/img/corporate/fashion1_product_product-1_front-img-1.webp') }}"
                                            alt="">
                                    </div>
                                    <div class="aq-product-details-variation-item">
                                        <img src="{{ asset('assets/img/corporate/fashion1_product_product-1_front-img-2.webp') }}"
                                            alt="">
                                    </div>
                                    <div class="aq-product-details-variation-item">
                                        <img src="{{ asset('assets/img/corporate/fashion1_product_product-1_front-img-3.webp') }}"
                                            alt="">
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
                                            <input class="aq-cart-input" type="text" value="1" aria-label="Quantity">
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
                                        <button
                                            class="aq-product-details-add-to-cart-btn aq-btn-black radius-30 w-100">Add
                                            To Cart</button>
                                        <button type="button"
                                            class="aq-product-action-btn aq-wishlist-btn aq-tooltip-top">
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
                                <button
                                    class="aq-product-details-buy-now-btn aq-btn-black btn-red-bg  radius-30 w-100">Buy
                                    Now</button>
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
                <a href="#">
                    <img src="{{ asset('assets/img/corporate/Oudhyana_img/logo.png') }}" alt="">
                    <div>AkankshaAgarwal</div>
                </a>
            </div>
            <button type="button" class="aq-offcanvas-close aq-menu-close" aria-label="Close Menu"
                style="cursor: pointer; z-index: 99;"
                onclick="document.querySelector('.aq-offcanvas-wrap')?.classList.remove('opened'); document.querySelector('.body-overlay')?.classList.remove('opened');">
                <i class="fal fa-times" style="font-size: 20px;"></i>
            </button>
        </div>
        <div class="aq-offcanvas-menu-wrap">
            <div class="aq-offcanvas-menu">
                <nav></nav>
            </div>
        </div>
        <div class="aq-offcanvas-bottom">
            <div class="aq-offcanvas-btn-wrap d-flex justify-content-between align-items-center">
                <a class="aq-offcanvas-btn" href="{{ route('user.login') }}">Login</a>
                <a class="aq-offcanvas-btn btn-black-bg" href="{{ route('user.wishlist') }}">Wishlist</a>
            </div>

        </div>
    </div>
    <!-- offcanvas area end -->

    <!-- Body Overlay -->
    <div class="body-overlay"
        onclick="document.querySelector('.aq-offcanvas-wrap')?.classList.remove('opened'); document.querySelector('.body-overlay')?.classList.remove('opened');">
    </div>
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
                    <a href="{{ route('user.account.details') }}">
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
                    <a href="{{ route('user.wishlist') }}">
                        <div class="aq-bottom-menu-item">
                            <button class="p-relative">
                                <span class="count-box">3</span>
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
                            <span class="count-box">3</span>
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

            <!-- <a href="#" class="track-order">
                ðŸšš Track your order
            </a> -->

        </div>


        <!-- top bar area end -->

        <div class="aq-header-top-area aq-header-top-bdr"
            style="background: rgb(255 246 246 / 43%); position: relative;">
            <div class="container container-1830">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-3 col-md-3 col-4">
                        <div class="aq-header-logo text-start pt-10 pb-10">
                            <a href="#"><img style="width: 150px; max-width: 100%; height: auto;"
                                    src="{{ asset('assets/img/corporate/Oudhyana_img/logo.png') }}" alt="">
                                <div>Akansha Agarwal</div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-6 col-md-6 d-none d-md-block">
                        <div class="aq-header-search-form" style="position: relative;">
                            <form action="{{ route('search.suggestions') }}" method="GET" autocomplete="off"
                                style="display: flex; align-items: center; border: 1px solid #ddd; border-radius: 30px; background: #fff; overflow: hidden; padding: 2px 2px 2px 20px;">
                                <input class="searchInput" name="q" type="text"
                                    placeholder="Search premium gifts, corporate hampers, brands..."
                                    style="border: none; outline: none; width: 100%; padding: 10px 0; font-size: 14px; background: transparent;box-shadow: none;">
                                <button type="submit"
                                    style="background: #c98f9d; color: #fff; border: none; border-radius: 50px; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; cursor: pointer; margin-left: 10px; margin-right: 2px;"><i
                                        class="fa fa-search"></i></button>
                                <div class="searchSuggestions search-suggestions"></div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-3 col-8">
                        <div class="aq-header-right-options text-end">
                            <ul style="display: flex; align-items: center; justify-content: flex-end; gap: 15px;">
                                <li class="d-md-none aq-mobile-search-btn-wrapper">
                                    <button type="button" class="aq-mobile-search-btn" aria-label="Search"
                                        style="position: relative; background: transparent; border: none; padding: 0; color: #1c1c1c; cursor: pointer;">
                                        <i>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="11" cy="11" r="8"></circle>
                                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                            </svg>
                                        </i>
                                    </button>
                                </li>
                                <li class="aq-header-top-wishlist d-none d-md-inline-block">
                                    <button class="aq-wishlist-btn" aria-label="Wishlist"
                                        style="position: relative; background: transparent; border: none; padding: 0;">
                                        <span class="count-box" style="background: #c98f9d; color: #fff;">2</span>
                                        <i>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
                                                viewBox="0 0 21 20" fill="none">
                                                <path
                                                    d="M6.50726 4.80303C5.44195 5.14334 4.68503 6.09974 4.59044 7.22502M10.4856 18.6038C12.6562 17.2679 14.6755 15.6957 16.5073 13.9152C17.7951 12.633 18.7756 11.0698 19.3735 9.3454C20.4494 6.00032 19.1927 2.17084 15.6755 1.03753C13.827 0.442448 11.8081 0.782566 10.2505 1.95149C8.69225 0.783989 6.67412 0.443991 4.82552 1.03753C1.30833 2.17084 0.0425004 6.00032 1.11845 9.3454C1.71636 11.0698 2.69679 12.633 3.98465 13.9152C5.81647 15.6957 7.83575 17.2679 10.0064 18.6038L10.2414 18.75L10.4856 18.6038Z"
                                                    stroke="currentcolor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </i>
                                    </button>
                                </li>
                                <li class="aq-header-top-cart aq-cart-btn">
                                    <button aria-label="Shopping Cart"
                                        style="position: relative; background: transparent; border: none; padding: 0;">
                                        <span class="count-box" style="background: #c98f9d; color: #fff;">3</span>
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

                                <li class="d-xl-none">
                                    <button type="button" class="aq-offcanvas-toggle" aria-label="Open Menu"
                                        style="position: relative; background: transparent; border: none; padding: 0; color: #1c1c1c; cursor: pointer; z-index: 99;"
                                        onclick="document.querySelector('.aq-offcanvas-wrap')?.classList.add('opened'); document.querySelector('.body-overlay')?.classList.add('opened');">
                                        <i>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path d="M4 12H20" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M4 6H20" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M4 18H20" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
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


        <!-- Mobile Search Drawer Overlay -->
        <div class="aq-mobile-search-drawer"
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100vh; background: rgba(0,0,0,0.6); z-index: 99999;">
            <div class="search-drawer-content"
                style="background: #fff; width: 100%; padding: 25px 20px; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); transform: translateY(-100%); transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h5
                        style="margin: 0; font-size: 20px; color: #222; font-family: var(--aq-ff-heading); font-weight: 600;">
                        What are you looking for?</h5>
                    <button class="close-search-drawer"
                        style="background: #f5f5f5; border: none; width: 32px; height: 32px; border-radius: 50%; font-size: 18px; cursor: pointer; color: #333; display: flex; align-items: center; justify-content: center; line-height: 1;">&times;</button>
                </div>
                <form action="#" class="aq-header-search-form"
                    style="display: flex; align-items: center; border: 2px solid #e5e5e5; border-radius: 8px; background: #fff; padding: 2px; transition: border-color 0.3s;">
                    <button type="submit"
                        style="background: transparent; color: #111; border: none; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; font-size: 18px;"><i
                            class="fal fa-search"></i></button>
                    <input class="searchInput" name="q" type="text"
                        placeholder="Search premium chikankari, products, brands..."
                        style="border: none; outline: none; width: 100%; padding: 12px 10px 12px 0; font-size: 15px; background: transparent; color: #333;">
                    <div class="searchSuggestions search-suggestions"></div>
                </form>
                <div class="search-suggestions" style="margin-top: 25px;">
                    <span
                        style="font-size: 11px; color: #999; text-transform: uppercase; font-weight: 700; letter-spacing: 1.5px;">Popular
                        Searches</span>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 15px;">
                        <a href="#"
                            style="padding: 8px 16px; background: #f9f9f9; border: 1px solid #eee; border-radius: 30px; font-size: 13px; color: #444; text-decoration: none; transition: all 0.2s;">Chikan
                            Kurti</a>
                        <a href="#"
                            style="padding: 8px 16px; background: #f9f9f9; border: 1px solid #eee; border-radius: 30px; font-size: 13px; color: #444; text-decoration: none; transition: all 0.2s;">Bridal
                            Lehenga</a>
                        <a href="#"
                            style="padding: 8px 16px; background: #f9f9f9; border: 1px solid #eee; border-radius: 30px; font-size: 13px; color: #444; text-decoration: none; transition: all 0.2s;">Mens
                            Kurta</a>
                        <a href="#"
                            style="padding: 8px 16px; background: #f9f9f9; border: 1px solid #eee; border-radius: 30px; font-size: 13px; color: #444; text-decoration: none; transition: all 0.2s;">Organza
                            Pieces</a>
                        <a href="#"
                            style="padding: 8px 16px; background: #f9f9f9; border: 1px solid #eee; border-radius: 30px; font-size: 13px; color: #444; text-decoration: none; transition: all 0.2s;">Bedsheet
                            Sets</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="aq-header-bottom-area d-none d-xl-block p-relative" data-bg-color="rgb(255 246 246 / 43%)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="aq-header-menu aq-header-dropdown text-center">
                            <nav class="aq-mobile-menu-active">
                                <ul>
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('about-us') }}">Our Heritage</a></li>
                                    <li class="has-dropdown p-static">
                                        <a href="#">Chikankari Luxury Curation</a>
                                        <div class="aq-megamenu-wrap aq-corp-megamenu mega-menu">
                                            <div class="container">
                                                <div class="aq-corp-megamenu-inner">

                                                    <div class="aq-corp-megamenu-col">
                                                        <h6 class="aq-corp-megamenu-heading">Shop By Fabrics</h6>
                                                        <ul>

                                                            @forelse($headerFabrics as $fabric)

                                                                <li>
                                                                    <a href="#">
                                                                        {{ $fabric->value }}
                                                                    </a>
                                                                </li>

                                                            @empty

                                                                <li>
                                                                    <a href="#">
                                                                        No Fabrics Found
                                                                    </a>
                                                                </li>

                                                            @endforelse

                                                        </ul>
                                                    </div>

                                                    <div class="aq-corp-megamenu-col">
                                                        <h6 class="aq-corp-megamenu-heading">
                                                            Shop By Collections
                                                        </h6>

                                                        <ul>

                                                            @foreach($headerCollections as $collection)

                                                                <li>
                                                                    <a href="#">
                                                                        {{ $collection->name }}
                                                                    </a>
                                                                </li>

                                                            @endforeach

                                                        </ul>
                                                    </div>

                                                    <div class="aq-corp-megamenu-col">
                                                        <h6 class="aq-corp-megamenu-heading">Price Range</h6>
                                                        <ul>
                                                            <li><a href="#">Under ₹2,999</a></li>
                                                            <li><a href="#">₹3,000 - ₹5,999</a></li>
                                                            <li><a href="#">₹6,000 - ₹9,999</a></li>
                                                            <li><a href="#">₹10,000 - ₹14,999</a></li>
                                                            <li><a href="#">₹15,000 and Above</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="aq-corp-megamenu-col">
                                                        <h6 class="aq-corp-megamenu-heading">Shop By Occasions</h6>
                                                        <ul>

                                                            @forelse($headerOccasions as $occasion)

                                                                <li>
                                                                    <a href="#">
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
                                                                <a href="#">
                                                                    <div class="aq-megamenu-img">
                                                                        @if($category->image)
                                                                            <img src="{{ asset('storage/' . $category->image) }}"
                                                                                alt="{{ $category->name }}">
                                                                        @else
                                                                            <img src="{{ asset('assets/images/no-image.png') }}"
                                                                                alt="{{ $category->name }}">
                                                                        @endif
                                                                    </div><span
                                                                        class="aq-megamenu-img-title">{{ $category->name }}</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @foreach($navbarCategories as $category)

                                        <li class="has-dropdown">

                                            <a href="#">
                                                {{ $category->name }}
                                            </a>

                                            @if($category->children->count())

                                                <ul class="submenu">

                                                    @foreach($category->children as $subcategory)

                                                        <li>
                                                            <a href="#">
                                                                {{ $subcategory->name }}
                                                            </a>
                                                        </li>

                                                    @endforeach

                                                </ul>

                                            @endif

                                        </li>

                                    @endforeach

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


        <style>
            @media (max-width: 767px) {
                .offer-item span {
                    font-size: 11px;
                    display: block;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }

                .aq-header-logo img {
                    max-width: 120px !important;
                }

                .aq-header-right-options ul {
                    gap: 10px !important;
                }
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var searchBtn = document.querySelector('.aq-mobile-search-btn');
                var searchDrawer = document.querySelector('.aq-mobile-search-drawer');
                var drawerContent = searchDrawer ? searchDrawer.querySelector('.search-drawer-content') : null;
                var closeBtn = document.querySelector('.close-search-drawer');
                var searchInput = searchDrawer ? searchDrawer.querySelector('input') : null;

                function openSearch() {
                    searchDrawer.style.display = 'block';
                    // Trigger reflow
                    void searchDrawer.offsetWidth;
                    drawerContent.style.transform = 'translateY(0)';
                    document.body.style.overflow = 'hidden'; // prevent background scrolling
                    if (searchInput) setTimeout(() => searchInput.focus(), 300);
                }

                function closeSearch() {
                    drawerContent.style.transform = 'translateY(-100%)';
                    document.body.style.overflow = '';
                    setTimeout(function () {
                        searchDrawer.style.display = 'none';
                    }, 300);
                }

                if (searchBtn && searchDrawer) {
                    searchBtn.addEventListener('click', function (e) {
                        e.preventDefault();
                        openSearch();
                    });
                }

                if (closeBtn) {
                    closeBtn.addEventListener('click', function (e) {
                        e.preventDefault();
                        closeSearch();
                    });
                }

                // Close on overlay click
                if (searchDrawer) {
                    searchDrawer.addEventListener('click', function (e) {
                        if (e.target === searchDrawer) {
                            closeSearch();
                        }
                    });
                }
            });
        </script>

    </header>


    @yield('content')

    <div class="aq-drawer-parent-wrap" id="aqEnquiryDrawerWrap">
        <div class="aq-drawer-overlay" id="aqDrawerOverlay"></div>
        <div class="aq-drawer-card-body">
            <button class="aq-drawer-close-btn" id="aqDrawerCloseBtn" aria-label="Close Enquiry Drawer"><i
                    class="fa-solid fa-xmark"></i></button>
            <div class="aq-drawer-header">
                <div class="aq-drawer-header-icon"><i class="fa-solid fa-gift"></i></div>
                <h3 class="aq-drawer-title">Bespoke Corporate Curation</h3>
                <p class="aq-drawer-subtitle">Premium custom branding packages. Receive tailored hampers & smart
                    proposal catalogs in 2 business hours.</p>
            </div>
            <div class="aq-drawer-form-scrollable">
                <form class="aq-drawer-form" id="aqDrawerForm" action="#">
                    <div class="aq-drawer-form-row">
                        <div class="aq-drawer-form-group">
                            <label class="aq-drawer-label" for="drawerFullName">Full Name *</label>
                            <div class="aq-drawer-input-wrapper">
                                <i class="fa-regular fa-user"></i>
                                <input type="text" id="drawerFullName" class="aq-drawer-input"
                                    placeholder="e.g. Rahul Sharma" required />
                            </div>
                        </div>
                    </div>
                    <div class="aq-drawer-form-row">
                        <div class="aq-drawer-form-group">
                            <label class="aq-drawer-label" for="drawerEmail">Corporate Email *</label>
                            <div class="aq-drawer-input-wrapper">
                                <i class="fa-regular fa-envelope"></i>
                                <input type="email" id="drawerEmail" class="aq-drawer-input"
                                    placeholder="e.g. rahul@company.com" required />
                            </div>
                        </div>
                    </div>
                    <div class="aq-drawer-form-row">
                        <div class="aq-drawer-form-group">
                            <label class="aq-drawer-label" for="drawerPhone">Contact Number *</label>
                            <div class="aq-drawer-input-wrapper">
                                <i class="fa-solid fa-phone-flip"></i>
                                <input type="tel" id="drawerPhone" class="aq-drawer-input"
                                    placeholder="e.g. +91 0000 000 000" required />
                            </div>
                        </div>
                    </div>
                    <div class="aq-drawer-form-row">
                        <div class="aq-drawer-form-group">
                            <label class="aq-drawer-label" for="drawerCompanyName">Company Name *</label>
                            <div class="aq-drawer-input-wrapper">
                                <i class="fa-solid fa-building"></i>
                                <input type="text" id="drawerCompanyName" class="aq-drawer-input"
                                    placeholder="e.g. Reliance" required />
                            </div>
                        </div>
                    </div>
                    <div class="aq-drawer-form-row two-cols">
                        <div class="aq-drawer-form-group">
                            <label class="aq-drawer-label" for="drawerQuantity">Quantity Range *</label>
                            <div class="aq-drawer-select-wrapper">
                                <i class="fa-solid fa-cubes"></i>
                                <select id="drawerQuantity" class="aq-drawer-select" required>
                                    <option value="" disabled selected>Select Units</option>
                                    <option value="10-50">10 to 50 pcs</option>
                                    <option value="51-200">51 to 200 pcs</option>
                                    <option value="201-500">201 to 500 pcs</option>
                                    <option value="500+">500+ pcs</option>
                                </select>
                            </div>
                        </div>
                        <div class="aq-drawer-form-group">
                            <label class="aq-drawer-label" for="drawerBudget">Budget per Gift *</label>
                            <div class="aq-drawer-select-wrapper">
                                <i class="fa-solid fa-indian-rupee-sign"></i>
                                <select id="drawerBudget" class="aq-drawer-select" required>
                                    <option value="" disabled selected>Select Budget</option>
                                    <option value="Under 500">Under ₹500</option>
                                    <option value="500-1500">₹500 - ₹1,500</option>
                                    <option value="1500-3000">₹1,500 - ₹3,000</option>
                                    <option value="3000+">Premium (₹3,000+)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="aq-drawer-form-footer">
                        <button type="submit" class="aq-drawer-submit-btn">
                            <span>Request Proposals</span>
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </button>
                    </div>
                </form>
                <div class="aq-drawer-success-state" id="aqDrawerSuccess">
                    <div class="aq-drawer-success-icon"><i class="fa-solid fa-circle-check"></i></div>
                    <h4 class="aq-drawer-success-title">Proposal Initiated!</h4>
                    <p class="aq-drawer-success-desc">Our curation experts will contact you with customized catalogs
                        shortly.</p>
                </div>
            </div>
        </div>
    </div>

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
                                            <img src="{{ asset($footerSetting->logo) }}" alt="Oudhyana India"
                                                style="filter: brightness(0) invert(1); width: 180px;">
                                        @endif
                                    </a>
                                </div>
                                @if(!empty($footerSetting?->about_text))
                                    <p class="aq-footer-intro-text">
                                        {!! $footerSetting->about_text !!}
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
                                <h4 class="aq-footer-title-luxury"><i class="fa-solid fa-building-columns mr-10"></i>
                                    Company</h4>
                                <ul class="aq-footer-menu-luxury">
                                    <li><a href="{{ route('about-us') }}"><i class="fa-solid fa-chevron-right"></i>
                                            About Us</a></li>
                                    <li><a href="{{ route('about-us') }}"><i class="fa-solid fa-chevron-right"></i> Our
                                            Heritage</a></li>
                                    <li><a href="{{ route('contact-us') }}"><i class="fa-solid fa-chevron-right"></i>
                                            Contact Us</a></li>
                                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Chikankari
                                            Craftsmanship</a></li>
                                    <li><a href="{{ route('blogs') }}"><i class="fa-solid fa-chevron-right"></i>
                                            Blogs</a></li>
                                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Size Guide</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 4: Quick Links -->
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                            <div class="aq-footer-widget mb-50">
                                <h4 class="aq-footer-title-luxury"><i class="fa-solid fa-link mr-10"></i> Quick
                                    Links</h4>
                                <ul class="aq-footer-menu-luxury">
                                    <li><a href="{{ route('categories') }}"><i class="fa-solid fa-chevron-right"></i>
                                            Shop All
                                            Collections</a></li>
                                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> New Arrivals</a></li>
                                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Track Order</a></li>
                                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Return & Exchange
                                            Policy</a></li>
                                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i> Shipping
                                            Information</a></li>
                                    <li><a href="{{ route('faqs') }}"><i class="fa-solid fa-chevron-right"></i> FAQs</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 2: Get in Touch -->
                        <div class="col-xl-4 col-lg-4 col-md-12">
                            <div class="aq-footer-widget mb-50">
                                <h4 class="aq-footer-title-luxury"><i class="fa-solid fa-headset mr-10"></i> GET IN
                                    TOUCH</h4>
                                <div class="aq-footer-contact-luxury">

                                    <div class="aq-contact-item-luxury d-flex align-items-start gap-3 mb-20">
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

                                    <div class="aq-contact-item-luxury d-flex align-items-start gap-3 mb-20">
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

                                    <div class="aq-contact-item-luxury d-flex align-items-start gap-3 mb-20">
                                        <a href="https://wa.me/0000000000" target="_blank">
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

                                    <div class="aq-contact-item-luxury d-flex align-items-start gap-3 mb-20">
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
                                <a href="#">Terms & Conditions</a>
                                <a href="#">Privacy Policy</a>
                                <a href="#">Return & Warranties</a>
                                <a href="#">Delivery</a>
                                <a href="#">Cookies</a>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12">
                            <div class="aq-footer-disclaimer mb-20 mt-10">
                                <p><strong>Disclaimer:</strong> Oudhyana India provides Chikankari Suiting solutions
                                    only to businesses, institutions, and registered entities. All prices are
                                    exclusive
                                    of taxes. Product images are for representation only. Actual product may vary
                                    slightly. We are not responsible for any typographical errors. All trademarks
                                    and
                                    brand names belong to their respective owners.</p>
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
                            <p class="copyright-text">Â© 2026 <span>Oudhyana India</span>. All Rights Reserved.</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <p class="copyright-create">Designed & Developed by <a href="#" target="_blank">Webmingo</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer area end -->
        <!-- footer area end -->

        <!-- footer area end -->

        </div>
        <!-- footer area end -->


        <div class="footer_whatspp">

            @if(!empty($footerSetting?->whatsapp))
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $footerSetting->whatsapp) }}" target="_blank"
                    class="social-whatspp" title="WhatsApp">

                    <i class="fa-brands fa-whatsapp"></i>

                </a>
            @endif

        </div>

    </footer>


    <style>
        .aqf-slider-height {
            height: 600px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        @media (max-width: 991px) {
            .aqf-slider-height {
                height: 500px;
            }
        }

        @media (max-width: 767px) {
            .aqf-slider-height {
                height: 400px;
            }
        }

        .aqf-slider-thumb.include-bg {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>
    <!-- Floating Action Buttons -->
    <div class="floating-buttons"
        style="position: fixed; bottom: 30px; right: 30px; z-index: 9999; display: flex; flex-direction: column; gap: 15px;">
        <!-- WhatsApp Button -->
        <!-- <a href="https://wa.me/0000000000" target="_blank" class="whatsapp-btn"
            style="background: #25D366; color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(0,0,0,0.2); transition: all 0.3s ease; text-decoration: none;">
            <i class="fa-brands fa-whatsapp" style="font-size: 30px;"></i>
        </a> -->
        <!-- Enquiry Button -->
        <!-- <a href="#bulk-enquiry" class="enquiry-btn"
            style="background: #800000; color: white; padding: 12px 25px; border-radius: 30px; font-weight: 600; text-decoration: none; box-shadow: 0 4px 15px rgba(0,0,0,0.2); transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;">
            <i class="fa-regular fa-envelope"></i> Bulk Enquiry
        </a> -->
    </div>

    <style>
        /* WhatsApp floating button styling with elegant scroll animation */
        .footer_whatspp {
            position: fixed;
            right: 40px;
            bottom: 40px;
            /* Positioned at 120px when at the top */
            z-index: 99999;
            opacity: 0;
            visibility: hidden;
            transform: scale(0.8);
            transition: bottom 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275),
                opacity 0.4s ease,
                visibility 0.4s ease,
                transform 0.4s ease;
        }

        /* Active class to fade and scale in */
        .footer_whatspp.whatspp-active {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
        }

        /* Scrolled class to move down to 40px */
        .footer_whatspp.whatspp-active.whatspp-scrolled {
            bottom: 120px;
        }

        .social-whatspp {
            transition: all 0.3s ease;
        }

        .social-whatspp:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.5);
        }

        /* Progress back-to-top button styling */
        .progress-wrap {
            position: fixed;
            right: 46px;
            bottom: 44px;
            height: 50px;
            width: 50px;
            cursor: pointer;
            display: block;
            border-radius: 50%;
            box-shadow: inset 0 0 0 2px rgba(128, 0, 0, 0.15);
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transform: translateY(15px);
            transition: all 200ms linear;
            background-color: #fff;
        }

        .progress-wrap.active-progress {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .progress-wrap::after {
            position: absolute;
            width: 50px !important;
            height: 50px !important;
            color: #800000 !important;
            /* Deep Maroon matching user palette */
            left: 0;
            top: 0;
            cursor: pointer;
            display: block;
            z-index: 1;
            transition: all 200ms linear;
            background-size: 14px 10px !important;
            /* Scale native SVG arrow beautifully */
        }

        .progress-wrap:hover::after {
            color: #B87333 !important;
            /* Copper/Gold hover */
        }

        .progress-wrap svg path {
            fill: none;
            stroke: #800000;
            /* Deep Maroon matching user palette */
            stroke-width: 4;
            box-sizing: border-box;
            transition: all 200ms linear;
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
            color: #B87333;
            padding-left: 30px;
        }

        /* Mobile adjustments for floating buttons */
        @media (max-width: 768px) {
            .footer_whatspp {
                right: 20px;
                bottom: 100px !important;
            }

            .footer_whatspp.whatspp-active.whatspp-scrolled {
                bottom: 20px !important;
            }

            .social-whatspp {
                width: 50px !important;
                height: 50px !important;
                font-size: 20px !important;
            }

            .progress-wrap {
                right: 85px !important;
                /* Side-by-side with WhatsApp on mobile */
                bottom: 20px !important;
                height: 40px !important;
                width: 40px !important;
            }

            .progress-wrap::after {
                height: 40px !important;
                width: 40px !important;
                background-size: 11px 8px !important;
                /* Scale SVG arrow beautifully for mobile */
            }

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
    <script src="{{ asset('assets/js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-bundle.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('assets/js/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/js/nice-select.js') }}"></script>
    <script src="{{ asset('assets/js/purecounter.js') }}"></script>
    <script src="{{ asset('assets/js/isotope-pkgd.js') }}"></script>
    <script src="{{ asset('assets/js/lazysize.min.js') }}"></script>
    <script src="{{ asset('assets/js/slider-active.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded-pkgd.js') }}"></script>
    <script src="{{ asset('assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- WhatsApp scroll behavior script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var whatsappBtn = document.querySelector(".footer_whatspp");
            if (whatsappBtn) {
                // Check initial scroll position on page load
                if (window.scrollY > 10) {
                    whatsappBtn.classList.add("whatspp-active", "whatspp-scrolled");
                }
                window.addEventListener("scroll", function () {
                    if (window.scrollY > 10) {
                        // Scrolled state: make active and slide down to bottom: 40px
                        whatsappBtn.classList.add("whatspp-active", "whatspp-scrolled");
                    } else {
                        // Back at the top: keep active but slide back up to bottom: 120px
                        whatsappBtn.classList.add("whatspp-active");
                        whatsappBtn.classList.remove("whatspp-scrolled");
                    }
                }, { passive: true });
            }
        });

        // Bind Side Consultation Drawer Controller
        const drawerWrap = document.getElementById("aqEnquiryDrawerWrap");
        const drawerOverlay = document.getElementById("aqDrawerOverlay");
        const drawerCloseBtn = document.getElementById("aqDrawerCloseBtn");
        const drawerForm = document.getElementById("aqDrawerForm");
        const drawerSuccess = document.getElementById("aqDrawerSuccess");

        // Open Drawer function
        function openEnquiryDrawer() {
            // Safely close Bootstrap quick-view modal if active
            const activeModal = document.querySelector('.modal.show');
            if (activeModal) {
                try {
                    const modalInstance = bootstrap.Modal.getInstance(activeModal);
                    if (modalInstance) modalInstance.hide();
                } catch (e) { }
            }

            drawerWrap.classList.add("active");
            document.body.style.overflow = "hidden";
        }

        // Close Drawer function
        function closeEnquiryDrawer() {
            drawerWrap.classList.remove("active");
            document.body.style.overflow = "";

            setTimeout(() => {
                if (drawerForm) drawerForm.classList.remove("hidden");
                if (drawerSuccess) drawerSuccess.classList.remove("active");
                if (drawerForm) drawerForm.reset();
            }, 500);
        }

        if (drawerOverlay) drawerOverlay.addEventListener("click", closeEnquiryDrawer);
        if (drawerCloseBtn) drawerCloseBtn.addEventListener("click", closeEnquiryDrawer);

        // Bind click to standard page buttons
        const triggers = document.querySelectorAll(".aq-bulk-orders-btn, .enquiry-btn");
        triggers.forEach(btn => {
            btn.addEventListener("click", function (e) {
                e.preventDefault();
                // Don't trigger Bootstrap modal if drawer open is preferred
                btn.removeAttribute("data-bs-toggle");
                btn.removeAttribute("data-bs-target");
                openEnquiryDrawer();
            });
        });

        // Form Submit handler in drawer
        if (drawerForm) {
            drawerForm.addEventListener("submit", function (e) {
                e.preventDefault();
                drawerForm.classList.add("hidden");
                setTimeout(() => {
                    drawerSuccess.classList.add("active");
                }, 250);
            });
        }

    </script>

    <script>
        $(document).ready(function () {

            const storagePath = "{{ asset('storage') }}";
            const noImage = "{{ asset('assets/images/no-image.png') }}";

            let searchRequest = null;

            $(document).on('keyup', '.searchInput', function () {

                let input = $(this);
                let query = input.val().trim();

                let suggestionsBox = input
                    .closest('.aq-header-search-form')
                    .find('.searchSuggestions');

                if (query.length < 2) {
                    suggestionsBox.hide().empty();
                    return;
                }

                // Abort previous request
                if (searchRequest) {
                    searchRequest.abort();
                }

                searchRequest = $.ajax({
                    url: "{{ route('search.suggestions') }}",
                    type: "GET",
                    data: {
                        q: query
                    },
                    success: function (response) {

                        let html = '';

                        // Products
                        if (response.products?.length) {

                            html += '<div class="section-title">Products</div>';

                            response.products.forEach(item => {

                                let image = item.image || noImage;

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
                        if (response.categories?.length) {

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
                        if (response.subcategories?.length) {

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
                        if (response.occasions?.length) {

                            html += '<div class="section-title">Occasions</div>';

                            response.occasions.forEach(item => {

                                let image = item.image
                                    ? `${storagePath}/${item.image}`
                                    : noImage;

                                html += `
                            <a href="/products?occasion=${item.slug}"
                               class="d-flex align-items-center gap-2">
                                <img src="${image}"
                                     width="40"
                                     height="40"
                                     style="object-fit:cover;border-radius:6px;">
                                <span>${item.title}</span>
                            </a>
                        `;
                            });
                        }

                        suggestionsBox.html(
                            html ||
                            `<div class="p-3 text-center">No results found</div>`
                        ).show();
                    },
                    error: function (xhr, status) {
                        if (status !== 'abort') {
                            suggestionsBox.hide().empty();
                        }
                    }
                });
            });

            // Hide suggestions when clicking outside
            $(document).on('click', function (e) {
                if (!$(e.target).closest('.aq-header-search-form').length) {
                    $('.searchSuggestions').hide();
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

    <!-- Video Lightbox -->
    <div id="aqf-video-lightbox" class="aqf-video-lightbox">
        <div class="aqf-lightbox-overlay"></div>
        <button class="aqf-lightbox-close" aria-label="Close Lightbox"><i class="fa-solid fa-xmark"></i></button>
        <button class="aqf-lightbox-prev" aria-label="Previous Video"><i class="fa-solid fa-chevron-left"></i></button>
        <button class="aqf-lightbox-next" aria-label="Next Video"><i class="fa-solid fa-chevron-right"></i></button>

        <div class="aqf-lightbox-content">
            <div class="aqf-lightbox-video-wrapper">
                <video id="aqf-lightbox-video" controls autoplay playsinline></video>
            </div>
        </div>
    </div>

</body>

</html>