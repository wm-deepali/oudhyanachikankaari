<?php

use App\Http\Controllers\Admin\AwardController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactBranchController;
use App\Http\Controllers\Admin\ContactEnquiryController;
use App\Http\Controllers\Admin\CustomizationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DynamicPageController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GiftingOccasionController;
use App\Http\Controllers\Admin\HomeEnquiryController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\HomeTextSliderController;
use App\Http\Controllers\Admin\HomeWhyController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileSettingController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\SupplierEnquiryController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\PackageEnquiryController;
use App\Http\Controllers\Admin\OtherEnquiryController;
use App\Http\Controllers\Admin\VendorEnquiryController;
use App\Http\Controllers\Admin\VendorTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\HomeBrandSectionController;
use App\Http\Controllers\Admin\HomeBrandSectionImageController;
use App\Http\Controllers\Admin\HomeDealBannerController;
use App\Http\Controllers\Admin\HomeHeroSlideController;
use App\Http\Controllers\Admin\HomeHeroBannerController;
use App\Http\Controllers\Admin\FooterSettingController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\HomeFeatureCardController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\CategoryAttributeController;
use App\Http\Controllers\Frontend\Auth\CustomerAuthController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\InvoiceSettingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::controller(FrontController::class)->group(function () {

    Route::get('/', 'home')->name('home');
    Route::get('/search-suggestions', 'searchSuggestions')->name('search.suggestions');
    Route::get('/occasions', 'occasions')->name('occasions');
    Route::get('/categories', 'categories')->name('categories');
    Route::get('/category/{slug}', 'productListing')->name('products.listing');
    Route::post('/products/filter/{slug}', 'filterProducts')->name('products.filter');
    Route::get('/product/{slug}', 'productDetail')->name('product.details');

    Route::get('/about-us', 'aboutUs')->name('about-us');
    Route::get('/blogs', 'blogs')->name('blogs');
    Route::get('/blog/{slug}', 'blogDetails')->name('blog.details');
    Route::get('/bulk-enquiry', 'bulkEnquiry')->name('bulk-enquiry');
    Route::get('/contact-us', 'contactUs')->name('contact-us');
    Route::get('/faqs', 'faqs')->name('faqs');
    Route::view('/partners', 'front-pages.partners')->name('partners');
    Route::get('/page/{slug}', 'dynamicPage')->name('dynamic.page');
    Route::get('/thank-you/{id}', 'thankYou')->name('thank-you');
    Route::get('/why-us', 'whyUs')->name('why-us');

    // cart routes
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.update.quantity');
    Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.apply.coupon');
    Route::post('/cart/remove-coupon', [CartController::class, 'removeCoupon'])->name('cart.remove.coupon');

    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

    // wishlist routes
    Route::post('/wishlist/add', 'addToWishlist')->name('wishlist.add');
    Route::delete('/wishlist/{id}', 'removeWishlist')->name('wishlist.remove');



    Route::get('/vendors', 'vendors')->name('vendors');
    Route::get('/membership', 'membership')->name('membership');
    Route::get('/job-openings', 'jobOpenings')->name('job-openings');
    Route::get('/gallery', 'gallery')->name('gallery');
    Route::get('/careers', 'careers')->name('careers');


    Route::get('/awards', 'awards')->name('awards');
    Route::get('/personalised-engraving', 'personalisedEngraving')->name('personalised-engraving');
    Route::get('/recycling-pledge', 'recyclingPledge')->name('recycling-pledge');
    Route::get('/engraving-gallery', 'engravingGallery')->name('engraving-gallery');

    // enquiry routes
    Route::post('/home-enquiry', 'submitHomeEnquiry')->name('home.enquiry');
    Route::post('/enquiry/store', 'storeEnquiry')->name('enquiry.store');
    Route::post('/contact-submit', 'submitContact')->name('contact.submit');
    Route::post('/package-enquiry', 'submitPackageEnquiry')->name('package.enquiry');
    Route::post('/general-enquiry', 'submitGeneralEnquiry')->name('general.enquiry');
    Route::post('/vendor-enquiry', 'submitVendorEnquiry')->name('vendor.enquiry');
    Route::post('/supplier-enquiry', 'submitSupplierEnquiry')->name('supplier.enquiry');

});

Route::get('/auth/google', [CustomerAuthController::class, 'redirectToGoogle'])
    ->name('google.login');

Route::get('/auth/google/callback', [CustomerAuthController::class, 'handleGoogleCallback']);

Route::prefix('user')->name('user.')->group(function () {

    Route::get('/register', [CustomerAuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [CustomerAuthController::class, 'register'])->name('register.store');
    Route::get('/login', [CustomerAuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [CustomerAuthController::class, 'login'])->name('login.store');

    Route::middleware('customer')->group(function () {

        Route::view('/dashboard', 'front-pages.dashboard')->name('dashboard');
        Route::view('/account-details', 'front-pages.account-details')->name('account.details');
        Route::view('/address', 'front-pages.address')->name('address');
        Route::view('/orders', 'front-pages.orders')->name('orders');
        Route::view('/wishlist', 'front-pages.wishlist')->name('wishlist');
        Route::view('/notifications', 'front-pages.notifications')->name('notifications');
        Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('logout');

    });

});


Route::get('/get-cities/{state}', function ($id) {
    return \App\Models\City::where('state_id', $id)->orderBy('name')->get();
});

// Admin Routes list
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('auth')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/profile-setting', ProfileSettingController::class);
        Route::post('/resetpassword', [ProfileSettingController::class, 'resetPassword'])->name('reset.password');

        // category routes
        Route::get('categories/import', [CategoryController::class, 'import'])->name('categories.import');
        Route::post('categories/import', [CategoryController::class, 'importStore'])->name('categories.import.store');
        Route::get('categories/import/sample', [CategoryController::class, 'downloadSample'])->name('categories.import.sample');
        Route::post('categories/upload-images', [CategoryController::class, 'uploadImagesZip'])->name('categories.images.upload');
        Route::get('categories/import/parent-reference', [CategoryController::class, 'downloadParentCategoryReference'])->name('categories.parent.reference');
        Route::resource('categories', CategoryController::class);

        // occasion routes
        Route::get('gifting-occasions/import', [GiftingOccasionController::class, 'import'])->name('gifting-occasions.import');
        Route::post('gifting-occasions/import', [GiftingOccasionController::class, 'importStore'])->name('gifting-occasions.import.store');
        Route::get('gifting-occasions/import/sample', [GiftingOccasionController::class, 'downloadSample'])->name('gifting-occasions.import.sample');
        Route::post('gifting-occasions/upload-images', [GiftingOccasionController::class, 'uploadImagesZip'])->name('gifting-occasions.images.upload');
        Route::resource('gifting-occasions', GiftingOccasionController::class);

        // product routes
        Route::get('products/subcategories/{category}', [ProductController::class, 'subcategories'])->name('products.subcategories');
        Route::get('products/category-attributes/{category}', [ProductController::class, 'categoryAttributes'])->name('products.category-attributes');
        Route::post('/products/upload-images-zip', [ProductController::class, 'uploadImagesZip'])->name('products.images.upload');
        Route::get('/products/import', [ProductController::class, 'import'])->name('products.import');
        Route::post('/products/import', [ProductController::class, 'importStore'])->name('products.import.store');
        Route::get('products/import/sample', [ProductController::class, 'downloadSample'])->name('products.import.sample');
        Route::get('products/reference/categories', [ProductController::class, 'downloadCategoryReference'])->name('products.reference.categories');
        Route::get('products/reference/subcategories', [ProductController::class, 'downloadSubCategoryReference'])->name('products.reference.subcategories');
        Route::get('products/reference/brands', [ProductController::class, 'downloadBrandReference'])->name('products.reference.brands');
        Route::get('products/reference/occasions', [ProductController::class, 'downloadOccasionReference'])->name('products.reference.occasions');
        Route::get('products/reference/customizations', [ProductController::class, 'downloadCustomizationReference'])->name('products.reference.customizations');
        Route::resource('products', ProductController::class)->names('products');

        Route::resource('customizations', CustomizationController::class);

        Route::resource('pages', DynamicPageController::class)->names('pages');

        Route::resource('faqs', FaqController::class)->names('faqs');

        Route::resource('blogs', BlogController::class)->names('blogs');


        Route::resource('clients', ClientController::class)->names('clients');

        Route::resource('testimonials', TestimonialController::class)->names('testimonials');

        Route::resource('contact-branches', ContactBranchController::class);

        Route::resource('enquiries', EnquiryController::class)->names('enquiries');

        Route::resource('contact-enquiries', ContactEnquiryController::class);

        Route::resource('home-enquiries', HomeEnquiryController::class);

        Route::resource('package-enquiries', PackageEnquiryController::class);

        Route::resource('other-enquiries', OtherEnquiryController::class);

        Route::resource('packages', PackageController::class);

        Route::resource('vendor-enquiries', VendorEnquiryController::class);

        Route::resource('supplier-enquiries', SupplierEnquiryController::class);

        Route::resource('awards', AwardController::class);

        Route::resource('teams', TeamController::class);

        Route::resource('vendor-types', VendorTypeController::class);

        Route::get('/logout', [LogoutController::class, 'logout']);


        // ✅ MAIN DASHBOARD
        Route::get('/home-page', [HomePageController::class, 'index'])
            ->name('home-page.index');

        Route::prefix('home/sliders')->name('home.sliders.')->group(function () {

            Route::get('/', [HomeSliderController::class, 'index'])->name('index');

            Route::get('/create', [HomeSliderController::class, 'create'])->name('create');

            Route::post('/store', [HomeSliderController::class, 'store'])->name('store');

            Route::get('/edit/{id}', [HomeSliderController::class, 'edit'])->name('edit');

            Route::put('/update/{id}', [HomeSliderController::class, 'update'])->name('update');

            Route::delete('/delete/{id}', [HomeSliderController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('home/text-sliders')->name('home.text-sliders.')->group(function () {

            Route::get('/', [HomeTextSliderController::class, 'index'])->name('index');

            Route::get('/create', [HomeTextSliderController::class, 'create'])->name('create');

            Route::post('/store', [HomeTextSliderController::class, 'store'])->name('store');

            Route::get('/edit/{id}', [HomeTextSliderController::class, 'edit'])->name('edit');

            Route::put('/update/{id}', [HomeTextSliderController::class, 'update'])->name('update');

            Route::delete('/delete/{id}', [HomeTextSliderController::class, 'destroy'])->name('destroy');
        });

        Route::resource('gallery-images', GalleryImageController::class)->names('gallery-images');

        Route::get('home/brand-section', [HomeBrandSectionController::class, 'edit'])->name('home.brand-section.edit');
        Route::post('home/brand-section', [HomeBrandSectionController::class, 'update'])->name('home.brand-section.update');
        Route::resource('home-brand-section-images', HomeBrandSectionImageController::class);

        Route::resource('home-deal-banners', HomeDealBannerController::class)->names('home-deal-banners');
        Route::delete('home-deal-banners/delete/{id}', [HomeDealBannerController::class, 'destroy'])->name('home-deal-banners.delete');

        Route::resource('home-hero-slides', HomeHeroSlideController::class)->names('home-hero-slides');
        Route::resource('home-hero-banners', HomeHeroBannerController::class)->names('home-hero-banners');




        // ================= WHY SECTION =================
        Route::get('/home-why', [HomeWhyController::class, 'index'])
            ->name('home.why.index');

        Route::post('/home-why/update', [HomeWhyController::class, 'updateSection'])
            ->name('home.why.update');

        Route::post('/home-why/card/store', [HomeWhyController::class, 'storeCard'])
            ->name('home.why.card.store');

        Route::get('/home-why/card/{id}', [HomeWhyController::class, 'editCard'])
            ->name('home.why.card.edit');

        Route::post('/home-why/card/{id}', [HomeWhyController::class, 'updateCard'])
            ->name('home.why.card.update');

        Route::delete('/home-why/card/{id}', [HomeWhyController::class, 'deleteCard'])
            ->name('home.why.card.delete');

        Route::resource('home-feature-cards', HomeFeatureCardController::class);


        Route::get('/footer-settings', [FooterSettingController::class, 'index'])
            ->name('footer-settings.index');

        Route::post('/footer-settings', [FooterSettingController::class, 'store'])
            ->name('footer-settings.store');

        Route::get('/seo', [SeoController::class, 'index'])->name('seo.index');
        Route::put('/seo/{id}', [SeoController::class, 'update'])->name('seo.update');

        Route::resource('collections', CollectionController::class);

        Route::resource('attributes', AttributeController::class);
        Route::resource('attribute-values', AttributeValueController::class);

        Route::resource('category-attributes', CategoryAttributeController::class);

        Route::resource('announcements', AnnouncementController::class);

      Route::resource('coupons', CouponController::class);

        Route::get('/invoice-settings', [InvoiceSettingController::class, 'index'])->name('invoice-settings.index');
        Route::post('/invoice-settings', [InvoiceSettingController::class, 'store'])->name('invoice-settings.store');
        Route::get('/get-cities', [InvoiceSettingController::class, 'getCities'])->name('get-cities');

Route::view('/orders', 'admin.orders-and-payments.index')->name('orders.index');

    Route::view('/payments',
    'admin.orders-and-payments.payments-and-transaction')
        ->name('payments.index');

    Route::view('/order-detail/{id?}', 'admin.orders-and-payments.view-order-details')
        ->name('orders.detail');

    Route::view('/customers', 'admin.customers.index')
        ->name('customers.index');
        
         Route::view('/customer/{id?}', 'admin.customers.view-customer-detail')
        ->name('customers.detail');

    Route::view('/returns', 'admin.orders-and-payments.return-order')
        ->name('returns.index');

    Route::view('/refunds', 'admin.orders-and-payments.payment-refunds')->name('refunds.index');

    Route::view('/address-book', 'admin.customers.customer-address-book')
        ->name('address-book.index');
        
         Route::view('/customer-cart', 'admin.customers.customer-cart')
        ->name('customer-cart.index');
        
        Route::view('/product-reviews', 'admin.products.product-reviews')
        ->name('product-reviews.index');
        Route::view('/stock-management', 'admin.products.stock-management')
        ->name('stock-management.index');
        
        Route::view('/stock-alerts', 'admin.products.stock-alerts')
        ->name('stock-alerts.index');
        
        Route::view('/admin-setting', 'admin.admin-settings.admin-setting')
        ->name('admin-setting.index');
        
        Route::view('/sales-report', 'admin.reports.sales-report')
        ->name('sales-report.index');
        Route::view('/customer-report', 'admin.reports.customer-report')
        ->name('customer-report.index');
        Route::view('/product-report', 'admin.reports.product-report')
        ->name('product-report.index');
        
    });
});
