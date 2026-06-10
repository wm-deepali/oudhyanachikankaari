<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Account Details | Chikankari Luxury Curation</title>
    <meta name="description"
        content="Manage your personal information and security settings for your premium Chikankari account." />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Critical CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/spacing.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom-luxury.css') }}" />

    <!-- Non-Critical CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" media="print" onload="this.media = 'all'" />
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}" media="print" onload="this.media = 'all'" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom-animation.css') }}" media="print"
        onload="this.media = 'all'" />
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.css') }}" media="print"
        onload="this.media = 'all'" />
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}" media="print"
        onload="this.media = 'all'" />
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-pro.css') }}" media="print"
        onload="this.media = 'all'" />

    <!-- Google Fonts for Luxury Aesthetics -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
</head>

<body class="aq-cart-page">
    <main>
        <div class="aq-modern-dashboard">
            <!-- Sidebar -->
            <aside class="aq-modern-sidebar">
                <button class="aq-sidebar-close-btn"
                    onclick="document.querySelector('.aq-modern-sidebar').classList.remove('open')">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="aq-sidebar-logo">
                    <img src="{{ asset('assets/img/corporate/logo.webp') }}" alt="Oudhyana Logo">
                </div>
                <div class="aq-sidebar-user">
                    <img src="{{ asset('assets/img/corporate/gallery_bridal_lehenga.png') }}" alt="User"
                        id="sidebarUserAvatar">
                    <div class="aq-sidebar-user-info">
                        <h4>Rahul Sharma</h4>
                        <p>Premium Member</p>
                    </div>
                </div>
                <nav class="aq-sidebar-nav">
                    <ul>
                        <li><a href="{{ route('user.dashboard') }}"><i class="fa-solid fa-border-all"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li><a href="{{ route('user.orders') }}"><i class="fa-solid fa-box-open"></i> <span>My
                                    Orders</span></a>
                        </li>
                        <li><a href="{{ route('user.wishlist') }}"><i class="fa-regular fa-heart"></i>
                                <span>Wishlist</span></a></li>
                        <li><a href="{{ route('user.address') }}"><i class="fa-solid fa-map-location-dot"></i>
                                <span>Addresses</span></a></li>
                        <li class="active"><a href="{{ route('user.account.details') }}"><i
                                    class="fa-regular fa-user"></i>
                                <span>Account Details</span></a></li>
                        <li><a href="{{ route('user.notifications') }}"><i class="fa-solid fa-bell"></i>
                                <span>Notifications</span> <span class="badge">3</span></a></li>
                    </ul>
                </nav>
                <div class="aq-sidebar-bottom">
                    <form action="{{ route('user.logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="aq-logout-btn">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="aq-modern-main">
                <!-- Topbar -->
                <header class="aq-modern-topbar">
                    <button class="aq-sidebar-toggle-btn"
                        onclick="document.querySelector('.aq-modern-sidebar').classList.add('open')">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div class="aq-topbar-search">
                        <i class="fa-solid fa-search"></i>
                        <input type="text" placeholder="Search settings...">
                    </div>
                    <div class="aq-topbar-actions">
                        <button class="aq-icon-btn"><i class="fa-regular fa-bell"></i><span
                                class="indicator"></span></button>
                        <button class="aq-btn-store" onclick="window.location.href='{{ route('home') }}'"><i
                                class="fa-solid fa-store"></i> Back to Store</button>
                    </div>
                </header>

                @yield('content')

            </div>
        </div>
    </main>

    <!-- JS here -->
    <script src="{{ asset('assets/js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-bundle.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>