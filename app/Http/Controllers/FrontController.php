<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Client;
use App\Models\ContactBranch;
use App\Models\ContactEnquiry;
use App\Models\Faq;
use App\Models\GiftingOccasion;
use App\Models\HomeEnquiry;
use App\Models\HomeSlider;
use App\Models\HomeTextSlider;
use App\Models\Package;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Enquiry;
use App\Models\EnquiryItem;
use App\Models\State;
use App\Models\DynamicPage;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use App\Models\Team;
use App\Models\PackageEnquiry;
use App\Models\GeneralEnquiry;
use App\Models\VendorType;
use App\Models\VendorEnquiry;
use App\Models\SupplierEnquiry;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Wishlist;
use App\Models\HomeBrandSection;
use Carbon\Carbon;
use App\Models\GalleryImage;
use App\Models\HomeDealBanner;
use App\Models\HomeHeroSlide;
use App\Models\HomeHeroBanner;

class FrontController extends Controller
{
    public function home(Request $request)
    {
        $sliders = HomeSlider::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        $textSliders = HomeTextSlider::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        $popularCategories = Category::withCount('children')
            ->whereNull('parent_id')   // ✅ only parent categories
            ->where('is_popular', 1)   // ✅ only popular
            ->where('status', 1)
            ->where('show_on_website', 1)
            ->take(10)
            ->orderBy('sort_order', 'asc')
            ->get();

        $newArrivals = Product::with(['images'])
            ->where('status', 1)
            ->where('new_arrival', 1)
            ->where('show_on_website', 1)
            ->latest()
            ->take(4)
            ->get();

        $bestSellers = Product::with(['images'])
            ->where('status', 1)
            ->where('best_seller', 1)
            ->where('show_on_website', 1)
            ->latest()
            ->take(4)
            ->get();

        $featuredProducts = Product::with(['images'])
            ->where('status', 1)
            ->where('show_on_website', 1)
            ->where('featured', 1)
            ->latest()
            ->take(4)
            ->get();

        $occasions = GiftingOccasion::where('status', 1)
            ->latest()
            ->take(5) // same number as UI cards
            ->get();

        $saleProducts = Product::with(['images'])
            ->where('status', 1)
            ->where('show_on_website', 1)
            ->where('sale', 1)
            ->latest()
            ->take(4)
            ->get();

        $featuredCategories = Category::with([
            'products.images'
        ])
            ->where('status', 1)
            ->where('show_on_website', 1)
            ->where('is_featured', 1) // or your featured flag
            ->take(5)
            ->get()
            ->map(function ($category) {

                $prices = $category->products->pluck('price')->filter();

                $category->min_price = $prices->min();
                $category->max_price = $prices->max();

                return $category;
            });

        $engravingProducts = Product::with('images')
            ->where('status', 1)
            ->where('show_on_website', 1)
            ->where('is_personalized_engraving', 1)
            ->latest()
            ->take(8)
            ->get();

        $reels = Testimonial::where('status', 1)
            ->where(function ($q) {
                $q->whereNotNull('reel_file')
                    ->orWhereNotNull('reel_url');
            })
            ->latest()
            ->get();

        $brandCategories = Category::with([
            'brands' => function ($q) {
                $q->where('status', 1);
            }
        ])
            ->where('status', 1)
            ->whereHas('brands')
            ->orderBy('sort_order')
            ->get();


        $testimonials = Testimonial::where('status', 1)
            ->where('type', 'Text')
            ->latest()
            ->get();

        $clients = Client::where('status', 1)
            ->latest()
            ->get();

        $wishlistIds = Wishlist::where('session_id', session()->getId())
            ->where('expires_at', '>', now())
            ->pluck('product_id')
            ->toArray();

        $galleryColumn1 = GalleryImage::where('status', 1)
            ->where('column_no', 1)
            ->orderBy('sort_order')
            ->get();

        $galleryColumn2 = GalleryImage::where('status', 1)
            ->where('column_no', 2)
            ->orderBy('sort_order')
            ->get();

        $galleryColumn3 = GalleryImage::where('status', 1)
            ->where('column_no', 3)
            ->orderBy('sort_order')
            ->get();

        $brandSection = HomeBrandSection::with([
            'images' => function ($q) {
                $q->where('status', 1)
                    ->orderBy('sort_order');
            }
        ])
            ->where('status', 1)
            ->first();

        $dealBanners = HomeDealBanner::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        $heroSlides = HomeHeroSlide::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        $heroBanners = HomeHeroBanner::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        return view('front-pages.home', compact(
            'sliders',
            'textSliders',
            'popularCategories',
            'newArrivals',
            'bestSellers',
            'featuredProducts',
            'occasions',
            'saleProducts',
            'featuredCategories',
            'engravingProducts',
            'reels',
            'brandCategories',
            'testimonials',
            'clients',
            'wishlistIds',
            'galleryColumn1',
            'galleryColumn2',
            'galleryColumn3',
            'brandSection',
            'dealBanners',
            'heroSlides',
            'heroBanners',
        ));
    }

    public function searchSuggestions(Request $request)
    {
        $query = trim($request->q);

        if (!$query) {
            return response()->json([]);
        }

        $products = Product::with('images')
            ->where('status', 1)
            ->where('show_on_website', 1)
            ->where('name', 'LIKE', "%{$query}%")
            ->take(5)
            ->get([
                'id',
                'name',
                'slug'
            ])
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'image' => $product->display_image, // accessor
                ];
            });

        // Parent Categories
        $categories = Category::whereNull('parent_id')
            ->where('status', 1)
            ->where('show_on_website', 1)
            ->where('name', 'LIKE', "%{$query}%")
            ->take(5)
            ->get([
                'id',
                'name',
                'slug',
                'image'
            ]);

        // Sub Categories
        $subCategories = Category::with('parent')
            ->whereNotNull('parent_id')
            ->where('status', 1)
            ->where('show_on_website', 1)
            ->where('name', 'LIKE', "%{$query}%")
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'slug' => $item->slug,
                    'image' => $item->image,
                    'parent_slug' => $item->parent?->slug,
                ];
            });

        // Occasions
        $occasions = GiftingOccasion::where('status', 1)
            ->where('title', 'LIKE', "%{$query}%")
            ->take(5)
            ->get([
                'id',
                'title',
                'slug',
                'image'
            ]);

        return response()->json([
            'products' => $products,
            'categories' => $categories,
            'subcategories' => $subCategories,
            'occasions' => $occasions,
        ]);
    }

    public function categories(Request $request)
    {
        $categories = Category::with([
            'children' => function ($q) {
                $q->where('status', 1)
                    ->where('show_on_website', 1);
            }
        ])
            ->withCount([
                'products as direct_products_count' => function ($q) {
                    $q->where('status', 1)
                        ->where('show_on_website', 1);
                }
            ])
            ->whereNull('parent_id')
            ->where('status', 1)
            ->where('show_on_website', 1)
            ->orderBy('sort_order', 'asc')
            ->paginate(15);

        foreach ($categories as $category) {

            $subcategoryIds = $category->children->pluck('id');

            $subcategoryProductsCount = DB::table('product_subcategories')
                ->join('products', 'products.id', '=', 'product_subcategories.product_id')
                ->whereIn('product_subcategories.subcategory_id', $subcategoryIds)
                ->where('products.status', 1)
                ->where('products.show_on_website', 1)
                ->distinct()
                ->count('product_subcategories.product_id');

            $category->products_count =
                $category->direct_products_count + $subcategoryProductsCount;
        }

        // AJAX Load More
        if ($request->ajax()) {
            return view(
                'front-pages.partials.category-items',
                compact('categories')
            )->render();
        }

        return view('front-pages.categories', compact('categories'));
    }

    public function categoryListing($slug)
    {
        $category = Category::with([
            'children',
            'brands'
        ])
            ->where('slug', $slug)
            ->where('status', 1)
            ->where('show_on_website', 1)
            ->firstOrFail();

        $products = Product::with(['images', 'categories', 'subcategories'])

            ->where(function ($q) use ($category) {

                // products attached directly to category
                $q->whereHas('categories', function ($query) use ($category) {
                    $query->where('categories.id', $category->id);
                });

                // products attached to subcategories
                $q->orWhereHas('subcategories', function ($query) use ($category) {
                    $query->where('parent_id', $category->id);
                });
            })

            ->where('status', 1)
            ->where('show_on_website', 1)
            ->paginate(12);

        $subcategories = $category->children()
            ->withCount('subcategoryProducts')
            ->orderBy('sort_order')
            ->get();

        $occasionIds = $products->pluck('id');

        $occasions = GiftingOccasion::whereHas('products', function ($q) use ($occasionIds) {
            $q->whereIn('products.id', $occasionIds);
        })
            ->where('status', 1)
            ->orderBy('title')
            ->get();

        $footerCategories = Category::where('status', 1)
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->take(10)
            ->get();

        // dd($products->toArray(), $category->toArray(), $subcategories->toArray());
        return view(
            'front-pages.product-listing',
            compact(
                'category',
                'subcategories',
                'products',
                'occasions',
                'footerCategories'
            )
        );
    }

    public function filterProducts(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)
            ->where('status', 1)
            ->where('show_on_website', 1)
            ->firstOrFail();

        $products = Product::with([
            'images',
            'brand',
            'categories',
            'subcategories',
            'occasions'
        ])
            ->where('status', 1)
            ->where('show_on_website', 1)

            ->where(function ($q) use ($category) {

                // Products linked directly to category
                $q->whereHas('categories', function ($query) use ($category) {

                    $query->where(
                        'categories.id',
                        $category->id
                    );

                });

                // Products linked through subcategories
                $q->orWhereHas('subcategories', function ($query) use ($category) {

                    $query->where(
                        'parent_id',
                        $category->id
                    );

                });
            });

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->search);

            $products->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('sub_title', 'like', "%{$search}%")
                    ->orWhere('summary', 'like', "%{$search}%");

            });
        }

        /*
        |--------------------------------------------------------------------------
        | Brand Filter
        |--------------------------------------------------------------------------
        */

        if (!empty($request->brands)) {

            $products->whereHas('brand', function ($q) use ($request) {

                $q->whereIn(
                    'id',
                    (array) $request->brands
                );

            });
        }

        /*
        |--------------------------------------------------------------------------
        | Occasion Filter
        |--------------------------------------------------------------------------
        */

        if (!empty($request->occasions)) {

            $products->whereHas('occasions', function ($q) use ($request) {

                $q->whereIn(
                    'slug',
                    (array) $request->occasions
                );

            });
        }

        /*
|--------------------------------------------------------------------------
| Marketing Filter
|--------------------------------------------------------------------------
*/

        if (!empty($request->marketing)) {

            foreach ((array) $request->marketing as $flag) {

                if (
                    in_array($flag, [
                        'featured',
                        'new_arrival',
                        'sale',
                        'best_seller'
                    ])
                ) {

                    $products->where($flag, 1);
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Collection Filter
        |--------------------------------------------------------------------------
        */

        if (!empty($request->collections)) {

            foreach ((array) $request->collections as $flag) {

                if (
                    in_array($flag, [
                        'is_premium',
                        'is_engraving',
                        'is_personalized_engraving'
                    ])
                ) {

                    $products->where($flag, 1);
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Availability Filter
        |--------------------------------------------------------------------------
        */

        if (!empty($request->availability)) {

            foreach ((array) $request->availability as $flag) {

                if (
                    in_array($flag, [
                        'ready_to_ship',
                        'bulk_available',
                        'gift_hamper'
                    ])
                ) {

                    $products->where($flag, 1);
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Subcategory Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('subcategory')) {

            $products->whereHas('subcategories', function ($q) use ($request) {

                $q->where(
                    'categories.slug',
                    $request->subcategory
                );

            });
        }

        /*
        |--------------------------------------------------------------------------
        | Price Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('max_price')) {

            $products->where(
                'price',
                '<=',
                $request->max_price
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */

        switch ($request->sort) {

            case 'price-low':
                $products->orderBy('price', 'asc');
                break;

            case 'price-high':
                $products->orderBy('price', 'desc');
                break;

            case 'newest':
                $products->latest();
                break;

            default:
                $products->latest();
                break;
        }

        $products = $products->paginate(12);

        return response()->json([

            'success' => true,

            'html' => view(
                'front-pages.partials.product-grid',
                compact('products')
            )->render(),

            'pagination' => $products->links()->render(),

            'total' => $products->total()

        ]);
    }


    public function products(Request $request)
    {
        $query = Product::with(['images', 'categories', 'subcategories'])
            ->where('status', 1)
            ->where('show_on_website', 1);

        $title = 'Products Collection';

        switch ($request->filter) {

            case 'featured':
                $query->where('is_featured', 1);
                $title = 'Featured Products';
                break;

            case 'new_arrivals':
                $query->latest();
                $title = 'New Arrivals';
                break;

            case 'sale':
                $query->where('is_sale', 1);
                $title = 'Exclusive on Sale';
                break;

            case 'best_sellers':
                $query->orderByDesc('sales_count');
                $title = 'Best Sellers';
                break;
        }
        if ($request->filled('occasion')) {

            $query->whereHas('occasions', function ($q) use ($request) {
                $q->where('slug', $request->occasion);
            });

            $occasion = GiftingOccasion::where('slug', $request->occasion)->first();

            if ($occasion) {
                $title = $occasion->title;
            }
        }

        // Budget Filter
        if ($request->filled('budget')) {

            switch ($request->budget) {

                case 'under-500':
                    $query->where('sale_price', '<', 500);
                    $title = 'Products Under ₹500';
                    break;

                case '500-1000':
                    $query->whereBetween('sale_price', [500, 1000]);
                    $title = 'Products ₹500 – ₹1,000';
                    break;

                case '1000-2000':
                    $query->whereBetween('sale_price', [1000, 2000]);
                    $title = 'Products ₹1,000 – ₹2,000';
                    break;

                case '2000-5000':
                    $query->whereBetween('sale_price', [2000, 5000]);
                    $title = 'Products ₹2,000 – ₹5,000';
                    break;

                case 'above-5000':
                    $query->where('sale_price', '>', 5000);
                    $title = 'Products Above ₹5,000';
                    break;
            }
        }


        // Collection Filter
        if ($request->filled('collection')) {

            switch ($request->collection) {

                case 'premium':
                    $query->where('is_premium', 1);
                    $title = 'Premium Products';
                    break;

                case 'engravings':
                    $query->where('is_engraving', 1);
                    $title = 'Engravings';
                    break;

                case 'personalized-engraving':
                    $query->where('is_personalized_engraving', 1);
                    $title = 'Personalized Engraving';
                    break;
            }
        }


        $products = $query->paginate(12)->withQueryString();

        $footerCategories = Category::where('status', 1)
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->take(10)
            ->get();

        $footerOccasions = GiftingOccasion::where('status', 1)
            ->orderBy('title')
            ->get();

        return view(
            'front-pages.products',
            compact(
                'products',
                'footerCategories',
                'footerOccasions',
                'title'
            )
        );
    }

    public function productDetail($slug)
    {
        $product = Product::with([
            'brand',
            'images',
            'categories',
            'subcategories',
            'occasions',
            'customizations',
            'inclusions'
        ])
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $subcategoryIds = $product->subcategories->pluck('id');
        $categoryIds = $product->categories->pluck('id');

        $relatedProducts = Product::with(['brand', 'images'])
            ->where('id', '!=', $product->id)
            ->where(function ($query) use ($subcategoryIds, $categoryIds) {

                if ($subcategoryIds->count()) {

                    $query->whereHas('subcategories', function ($q) use ($subcategoryIds) {
                        $q->whereIn('categories.id', $subcategoryIds);
                    });

                } elseif ($categoryIds->count()) {

                    $query->whereHas('categories', function ($q) use ($categoryIds) {
                        $q->whereIn('categories.id', $categoryIds);
                    });

                }

            })
            ->latest()
            ->take(4)
            ->get();

        $newArrivals = Product::with(['brand', 'images'])
            ->where('new_arrival', 1)
            ->where('status', 1)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        $faqs = Faq::where('status', 1)
            ->get();

        $otherCategories = Category::where('status', 1)
            ->whereNull('parent_id')
            ->where('show_on_website', 1)
            ->whereNotIn(
                'id',
                $product->categories->pluck('id')
            )
            ->take(8)
            ->get();

        return view(
            'front-pages.product-detail',
            compact('product', 'relatedProducts', 'faqs', 'newArrivals', 'otherCategories')
        );
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $customizationId = $request->customization_id;

        // Get session id
        $sessionId = session()->getId();

        // Get or create cart
        $cart = Cart::firstOrCreate(
            ['session_id' => $sessionId],
            ['total_amount' => 0]
        );

        // Same product + same customization
        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->where('customization_id', $customizationId)
            ->first();

        if ($item) {

            $item->quantity += 1;
            $item->total = $item->quantity * $item->price;
            $item->save();

        } else {

            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'customization_id' => $customizationId,
                'quantity' => 1,
                'price' => $product->price,
                'total' => $product->price,
            ]);
        }

        $cart->total_amount = $cart->items()->sum('total');
        $cart->save();

        return response()->json([
            'status' => true,
            'message' => 'Product added to cart',
            'cart_count' => $cart->items()->count()
        ]);
    }

    public function shoppingCart(Request $request)
    {
        $sessionId = session()->getId();

        $cart = Cart::with([
            'items.product.categories',
            'items.product.subcategories',
            'items.product.images',
            'items.customization'
        ])
            ->where('session_id', $sessionId)
            ->first();

        $cartItems = $cart ? $cart->items : collect();

        $subtotal = $cartItems->sum('total');
        $totalItems = $cartItems->sum('quantity');

        $shipping = 0;
        $customization = 0;
        $grandTotal = $subtotal + $shipping + $customization;

        // ✅ ADD THIS
        $states = State::orderBy('name')->get();

        return view('front-pages.cart', compact(
            'cartItems',
            'subtotal',
            'totalItems',
            'shipping',
            'customization',
            'grandTotal',
            'states' // 🔥 IMPORTANT
        ));
    }

    public function removeFromCart(Request $request)
    {
        $item = CartItem::find($request->item_id);

        if ($item) {
            $cart = Cart::find($item->cart_id);

            $item->delete();

            // Update cart total
            if ($cart) {
                $cart->total_amount = $cart->items()->sum('total');
                $cart->save();
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Item removed successfully'
        ]);
    }

    public function updateQuantity(Request $request)
    {
        $item = CartItem::findOrFail($request->item_id);

        $quantity = max(1, (int) $request->quantity);

        $item->quantity = $quantity;
        $item->total = $item->price * $quantity;
        $item->save();

        $cart = Cart::find($item->cart_id);

        if ($cart) {
            $cart->total_amount = $cart->items()->sum('total');
            $cart->save();
        }

        return response()->json([
            'status' => true,
            'quantity' => $item->quantity,
            'item_total' => number_format($item->total),
            'cart_total' => number_format($cart->total_amount)
        ]);
    }

    public function thankYou($id)
    {
        $enquiry = Enquiry::with([
            'state',
            'city',
            'items.product',
            'items.customization'
        ])->findOrFail($id);

        return view('front-pages.thank-you', compact('enquiry'));
    }

    public function faqs(Request $request)
    {
        $faqs = Faq::where('status', 1)->get();

        return view('front-pages.faqs', compact('faqs'));
    }

    public function blogs(Request $request)
    {
        $blogs = Blog::where('status', 1)
            ->latest()
            ->paginate(6);

        return view('front-pages.blogs', compact('blogs'));
    }

    public function blogDetails(Request $request, $slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $latestBlogs = Blog::where('status', 1)
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(3)
            ->get();

        $searchResults = collect();

        if ($request->filled('search')) {

            $searchResults = Blog::where('status', 1)
                ->where(function ($q) use ($request) {

                    $q->where('title', 'like', '%' . $request->search . '%')
                        ->orWhere('short_description', 'like', '%' . $request->search . '%')
                        ->orWhere('content', 'like', '%' . $request->search . '%');

                })
                ->latest()
                ->take(10)
                ->get();

        }

        return view(
            'front-pages.blog-details',
            compact(
                'blog',
                'latestBlogs',
                'searchResults'
            )
        );
    }

    public function contactUs()
    {
        $branches = ContactBranch::where('status', 1)->get();

        $inquiryTypes = [
            'Bulk Corporate Order',
            'Customization Inquiry',
            'Sample Request',
            'Partnership Opportunity',
            'General Inquiry'
        ];

        return view('front-pages.contact-us', compact('branches', 'inquiryTypes'));
    }

    public function dynamicPage($slug)
    {
        // match slug with page_name
        $page = DynamicPage::where('status', 1)
            ->get()
            ->first(function ($p) use ($slug) {
                return Str::slug($p->page_name) === $slug;
            });

        if (!$page) {
            abort(404);
        }

        return view('front-pages.dynamic-page', compact('page'));
    }

    public function whyUs(Request $request)
    {
        $brands = Brand::where('status', 1)->get();
        return view('front-pages.why-us', compact('brands'));
    }

    public function vendors(Request $request)
    {
        $vendorTypes = VendorType::where('status', 1)->get();

        return view('front-pages.vendors', compact('vendorTypes'));
    }

    public function membership(Request $request)
    {
        $packages = Package::with('features')->get();
        return view('front-pages.membership', compact('packages'));
    }

    public function jobOpenings(Request $request)
    {
        return view('front-pages.job-opening');
    }

    public function gallery(Request $request)
    {
        return view('front-pages.gallery');
    }


    public function careers(Request $request)
    {
        return view('front-pages.careers');
    }

    public function bulkOrder(Request $request)
    {
        $categories = Category::where('status', 1)->where('show_on_website', 1)->whereNull('parent_id')->get();

        return view('front-pages.bulk-order', compact('categories'));
    }

    public function aboutUs(Request $request)
    {
        $teams = Team::where('status', 1)
            ->latest()
            ->get();

        return view('front-pages.about-us', compact('teams'));
    }

    public function awards(Request $request)
    {
        $awards = Award::where('status', 1)
            ->latest()
            ->get();

        return view('front-pages.awards', compact('awards'));
    }

    public function personalisedEngraving(Request $request)
    {
        $products = Product::where('is_personalized_engraving', 1)
            ->where('status', 1)
            ->where('show_on_website', 1)
            ->latest()
            ->take(6)
            ->get();

        // dd($products->toArray());
        return view('front-pages.personalised-engraving', compact('products'));
    }

    public function recyclingPledge(Request $request)
    {
        return view('front-pages.recycling-pledge');
    }

    public function engravingGallery(Request $request)
    {
        $products = Product::where('is_engraving', 1)
            ->where('status', 1)
            ->where('show_on_website', 1)
            ->latest()
            ->take(6)
            ->get();

        return view('front-pages.engraving-gallery', compact('products'));
    }

    public function storeEnquiry(Request $request)
    {
        try {

            // ✅ VALIDATION (AJAX SAFE)
            $validator = Validator::make($request->all(), [
                'business_name' => 'required|string|max:255',
                'owner_name' => 'required|string|max:255',
                'email' => 'required|email:rfc,dns|max:255',
                'mobile' => 'required|regex:/^[6-9]\d{9}$/',
                'address' => 'required|string',
                'state' => 'required|exists:states,id',
                'city' => 'required|exists:cities,id',
                'g-recaptcha-response' => 'required'
            ], [
                'mobile.regex' => 'Enter valid 10-digit mobile number',
                'g-recaptcha-response.required' => 'Please verify captcha'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // ✅ CAPTCHA VERIFY
            $captchaResponse = Http::asForm()->post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'secret' => env('RECAPTCHA_SECRET_KEY'),
                    'response' => $request->input('g-recaptcha-response'),
                    'remoteip' => $request->ip(),
                ]
            );

            if (!($captchaResponse->json()['success'] ?? false)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Captcha verification failed'
                ], 422);
            }

            // ✅ CART CHECK
            $sessionId = session()->getId();

            $cart = Cart::with('items')
                ->where('session_id', $sessionId)
                ->first();

            if (!$cart || $cart->items->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Your cart is empty'
                ], 400);
            }

            // ✅ SAVE ENQUIRY
            $enquiry = Enquiry::create([
                'business_name' => $request->business_name,
                'owner_name' => $request->owner_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'state_id' => $request->state,
                'city_id' => $request->city,
                'session_id' => $sessionId,
            ]);

            foreach ($cart->items as $item) {

                EnquiryItem::create([
                    'enquiry_id' => $enquiry->id,
                    'product_id' => $item->product_id,
                    'customization_id' => $item->customization_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->total,
                ]);

            }

            // ✅ CLEAR CART
            $cart->items()->delete();
            $cart->update(['total_amount' => 0]);

            return response()->json([
                'status' => true,
                'redirect' => route('thank-you', $enquiry->id),
                'message' => 'Enquiry submitted successfully!'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
            ], 500);
        }
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'mobile' => 'required|regex:/^[6-9]\d{9}$/',
            'message' => 'required',
            'g-recaptcha-response' => 'required',
        ], [
            'name.required' => 'Please enter your name',
            'email.required' => 'Email is required',
            'email.email' => 'Enter a valid email address',
            'mobile.required' => 'Mobile number is required',
            'mobile.regex' => 'Enter valid 10-digit mobile number',
            'message.required' => 'Message cannot be empty',
            'g-recaptcha-response.required' => 'Please verify captcha',
        ]);

        // ✅ CAPTCHA VERIFY
        $captchaResponse = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]
        );

        if (!($captchaResponse->json()['success'] ?? false)) {
            return back()
                ->withErrors(['g-recaptcha-response' => 'Captcha verification failed'])
                ->withInput();
        }

        // ✅ SAVE
        ContactEnquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'company' => $request->company,
            'inquiry_type' => $request->inquiry_type,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Enquiry sent successfully!');
    }

    public function submitHomeEnquiry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => 'required|regex:/^[6-9]\d{9}$/',
            'message' => 'required',
            'g-recaptcha-response' => 'required',
        ], [
            'name.required' => 'Please enter your name',
            'email.required' => 'Email is required',
            'email.email' => 'Enter a valid email address',
            'phone.required' => 'Mobile number is required',
            'phone.regex' => 'Enter valid 10-digit mobile number',
            'message.required' => 'Message cannot be empty',
            'g-recaptcha-response.required' => 'Please verify captcha',
        ]);

        // CAPTCHA
        $response = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip()
            ]
        );

        if (!($response->json()['success'] ?? false)) {
            return back()
                ->withErrors(['captcha' => 'Captcha verification failed'])
                ->withInput();
        }

        HomeEnquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'message' => $request->message,
            'ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
        ]);

        return back()->with('success', 'Thanks! We will contact you soon.');
    }

    public function submitPackageEnquiry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|exists:packages,id',
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => 'required|regex:/^[6-9]\d{9}$/',
            'g-recaptcha-response' => 'required',
        ], [
            'name.required' => 'Please enter your name',
            'company.required' => 'Company name is required',
            'email.email' => 'Enter valid email address',
            'phone.regex' => 'Enter valid 10-digit mobile number',
            'g-recaptcha-response.required' => 'Please verify captcha',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'packageForm') // ✅ IMPORTANT
                ->withInput();
        }

        // CAPTCHA
        $response = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip()
            ]
        );

        if (!($response->json()['success'] ?? false)) {
            return back()
                ->withErrors(['captcha' => 'Captcha verification failed'], 'packageForm')
                ->withInput();
        }

        PackageEnquiry::create($request->all());

        return back()->with('success_package', 'Enquiry submitted successfully');
    }

    public function submitGeneralEnquiry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => 'required|regex:/^[6-9]\d{9}$/',
            'g-recaptcha-response' => 'required',
        ], [
            'name.required' => 'Please enter your name',
            'company.required' => 'Company name is required',
            'email.email' => 'Enter valid email address',
            'phone.regex' => 'Enter valid 10-digit mobile number',
            'g-recaptcha-response.required' => 'Please verify captcha',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'generalForm') // ✅ IMPORTANT
                ->withInput();
        }

        // CAPTCHA
        $response = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip()
            ]
        );

        if (!($response->json()['success'] ?? false)) {
            return back()
                ->withErrors(['captcha' => 'Captcha verification failed'], 'generalForm')
                ->withInput();
        }

        GeneralEnquiry::create([
            'name' => $request->name,
            'company' => $request->company,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'source' => $request->source,
        ]);

        return back()->with('success_general', 'Enquiry submitted successfully!');
    }

    public function submitVendorEnquiry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => 'required|regex:/^[6-9]\d{9}$/',
            'vendor_type_id' => 'required|exists:vendor_types,id',
            'catalogue' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'g-recaptcha-response' => 'required',
        ], [
            'name.required' => 'Please enter your name',
            'company.required' => 'Company name is required',
            'email.email' => 'Enter valid email address',
            'phone.regex' => 'Enter valid 10-digit mobile number',
            'vendor_type_id.required' => 'Please select business type',
            'catalogue.mimes' => 'File must be PDF, DOC, JPG or PNG',
            'catalogue.max' => 'File size must be under 2MB',
            'g-recaptcha-response.required' => 'Please verify captcha',
        ]);

        // CAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
        ]);

        if (!$response->json('success')) {
            return back()
                ->withErrors(['g-recaptcha-response' => 'Captcha verification failed'])
                ->withInput();
        }

        // FILE UPLOAD
        $filePath = null;
        if ($request->hasFile('catalogue')) {
            $filePath = $request->file('catalogue')->store('catalogues', 'public');
        }

        // SAVE
        VendorEnquiry::create([
            'name' => $request->name,
            'company' => $request->company,
            'email' => $request->email,
            'phone' => $request->phone,
            'vendor_type_id' => $request->vendor_type_id,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'city' => $request->city,
            'catalogue' => $filePath,
        ]);

        return back()->with('success', 'Enquiry submitted successfully!');
    }


    public function submitSupplierEnquiry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => 'required|regex:/^[6-9]\d{9}$/',
            'category_id' => 'required|exists:categories,id',
            'catalogue' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'g-recaptcha-response' => 'required',
        ], [
            'name.required' => 'Please enter your name',
            'company.required' => 'Company name is required',
            'email.email' => 'Enter valid email address',
            'phone.regex' => 'Enter valid 10-digit mobile number',
            'category_id.required' => 'Please select category',
            'catalogue.mimes' => 'File must be PDF, DOC, JPG or PNG',
            'catalogue.max' => 'File must be under 2MB',
            'g-recaptcha-response.required' => 'Please verify captcha',
        ]);

        // CAPTCHA
        $captcha = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->input('g-recaptcha-response'),
            ]
        );

        if (!$captcha->json('success')) {

            return back()
                ->withErrors([
                    'g-recaptcha-response' => 'Captcha failed'
                ])
                ->withInput();
        }

        // FILE UPLOAD
        $filePath = null;

        if ($request->hasFile('catalogue')) {

            $filePath = $request->file('catalogue')
                ->store('catalogues', 'public');
        }

        SupplierEnquiry::create([
            'name' => $request->name,
            'company' => $request->company,
            'email' => $request->email,
            'phone' => $request->phone,
            'category_id' => $request->category_id,

            // NEW FORM FIELDS
            'quantity' => $request->quantity,
            'delivery_date' => $request->delivery_date,

            // EXISTING
            'description' => $request->description,
            'city' => $request->city,

            'catalogue' => $filePath,
        ]);

        return back()->with(
            'success',
            'Bulk enquiry submitted successfully!'
        );
    }

    public function occasions(Request $request)
    {
        $occasions = GiftingOccasion::where('status', 1)
            ->orderBy('title')
            ->paginate(8);

        // AJAX request
        if ($request->ajax()) {
            return view(
                'front-pages.partials.occasion-items',
                compact('occasions')
            )->render();
        }

        return view('front-pages.occasions', compact('occasions'));
    }

    public function addToWishlist(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        Wishlist::firstOrCreate(
            [
                'session_id' => session()->getId(),
                'product_id' => $request->product_id,
            ],
            [
                'expires_at' => Carbon::now()->addDay()
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Product added to wishlist'
        ]);
    }

    public function wishlist()
    {
        Wishlist::where('expires_at', '<', now())->delete();

        $products = Product::with(['images'])
            ->whereIn(
                'id',
                Wishlist::where('session_id', session()->getId())
                    ->pluck('product_id')
            )
            ->paginate(12);

        return view('front-pages.wishlist', compact('products'));
    }


    public function removeWishlist($id)
    {
        Wishlist::where('session_id', session()->getId())
            ->where('product_id', $id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Removed from wishlist'
        ]);
    }

}