<?php

use App\Http\Controllers\Admin\AwardController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
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
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\HomeEnquiryController;
use App\Http\Controllers\Admin\HomeFeatureController;
use App\Http\Controllers\Admin\HomeHeroController;
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
use App\Http\Controllers\Admin\FabricController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\SizeGroupController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\CategoryAttributeController;

Route::controller(FrontController::class)->group(function () {

    Route::get('/', 'home')->name('home');
    Route::get('/search-suggestions', 'searchSuggestions')->name('search.suggestions');
    Route::get('/categories', 'categories')->name('categories');
    Route::get('/category/{slug}', 'categoryListing')->name('category.products');
    Route::get('/category/{slug}/filter', 'filterProducts')->name('category.filter.products');
    Route::get('/products', 'products')->name('products');
    Route::get('/product/{slug}', 'productDetail')->name('product.details');
    Route::get('/occasions', 'occasions')->name('occasions');

    // cart routes
    Route::post('/cart/add', 'addToCart')->name('cart.add');
    Route::get('/shopping-cart', 'shoppingCart')->name('shopping-cart');
    Route::post('/cart/remove', 'removeFromCart')->name('cart.remove');
    Route::post('/cart/update-quantity', 'updateQuantity')->name('cart.update.quantity');
    Route::get('/thank-you/{id}', 'thankYou')->name('thank-you');

    // wishlist routes
    Route::post('/wishlist/add', 'addToWishlist')->name('wishlist.add');
    Route::get('/wishlist', 'wishlist')->name('wishlist');
    Route::delete('/wishlist/{id}', 'removeWishlist')->name('wishlist.remove');

    Route::get('/faqs', 'faqs')->name('faqs');
    Route::get('/blogs', 'blogs')->name('blogs');
    Route::get('/blog/{slug}', 'blogDetails')->name('blog.details');
    Route::get('/contact-us', 'contactUs')->name('contact-us');
    Route::get('/page/{slug}', 'dynamicPage')->name('dynamic.page');
    Route::get('/why-us', 'whyUs')->name('why-us');
    Route::get('/vendors', 'vendors')->name('vendors');
    Route::get('/membership', 'membership')->name('membership');
    Route::get('/job-openings', 'jobOpenings')->name('job-openings');
    Route::get('/gallery', 'gallery')->name('gallery');
    Route::get('/careers', 'careers')->name('careers');
    Route::get('/bulk-order', 'bulkOrder')->name('bulk-order');
    Route::get('/about-us', 'aboutUs')->name('about-us');
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

        // brand routes
        Route::get('brands/import', [BrandController::class, 'import'])->name('brands.import');
        Route::post('brands/import', [BrandController::class, 'importStore'])->name('brands.import.store');
        Route::get('brands/import/sample', [BrandController::class, 'downloadSample'])->name('brands.import.sample');
        Route::post('brands/upload-images', [BrandController::class, 'uploadImagesZip'])->name('brands.images.upload');
        Route::get('brands/import/category-reference', [BrandController::class, 'downloadCategoryReference'])->name('brands.category.reference');
        Route::resource('brands', BrandController::class)->names('brands');

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

        // ================= HERO =================
        Route::get('/home-hero', [HomeHeroController::class, 'edit'])
            ->name('home.hero.edit');

        Route::post('/home-hero', [HomeHeroController::class, 'update'])
            ->name('home.hero.update');


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


        // ================= BANNERS =================
        Route::get('/home-banners', [HomeBannerController::class, 'index'])
            ->name('home.banners.index');

        Route::post('/home-banners', [HomeBannerController::class, 'store'])
            ->name('home.banners.store');

        Route::put('/home-banners/{id}', [HomeBannerController::class, 'update'])
            ->name('home.banners.update');

        Route::delete('/home-banners/{id}', [HomeBannerController::class, 'delete'])
            ->name('home.banners.delete');

        Route::get('/home-features', [HomeFeatureController::class, 'index'])
            ->name('home.features.index');

        Route::post('/home-features', [HomeFeatureController::class, 'store'])
            ->name('home.features.store');

        Route::put('/home-features/{id}', [HomeFeatureController::class, 'update'])
            ->name('home.features.update');

        Route::delete('/home-features/{id}', [HomeFeatureController::class, 'delete'])
            ->name('home.features.delete');

        Route::get('/footer-settings', [FooterSettingController::class, 'index'])
            ->name('footer-settings.index');

        Route::post('/footer-settings', [FooterSettingController::class, 'store'])
            ->name('footer-settings.store');

        Route::get('/seo', [SeoController::class, 'index'])->name('seo.index');
        Route::put('/seo/{id}', [SeoController::class, 'update'])->name('seo.update');

        Route::resource('fabrics', FabricController::class);

        Route::resource('colors', ColorController::class);

        Route::resource('collections', CollectionController::class);
        Route::resource('size-groups', SizeGroupController::class);

        Route::resource('sizes', SizeController::class);

        Route::resource('attributes', AttributeController::class);
        Route::resource('attribute-values', AttributeValueController::class);

        Route::resource('category-attributes', CategoryAttributeController::class);

        Route::resource('announcements', AnnouncementController::class);


    });
});
