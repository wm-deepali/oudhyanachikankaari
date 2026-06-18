<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
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
use App\Models\Testimonial;
use App\Models\Team;
use App\Models\PackageEnquiry;
use App\Models\GeneralEnquiry;
use App\Models\VendorType;
use App\Models\VendorEnquiry;
use App\Models\SupplierEnquiry;
use Illuminate\Support\Facades\Validator;
use App\Models\Wishlist;
use App\Models\HomeBrandSection;
use Carbon\Carbon;
use App\Models\GalleryImage;
use App\Models\HomeDealBanner;
use App\Models\HomeHeroSlide;
use App\Models\HomeHeroBanner;
use App\Models\HomeWhy;
use App\Models\HomeWhyCard;
use App\Models\HomeFeatureCard;
use App\Models\Collection;


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

        $featureCards = HomeFeatureCard::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        $popularCategories = Category::withCount('children')
            ->whereNull('parent_id')
            ->where('is_popular', 1)
            ->where('status', 1)
            ->take(10)
            ->orderBy('sort_order', 'asc')
            ->get();

        $occasions = GiftingOccasion::where('status', 1)
            ->latest()
            ->get();

        $saleProducts = Product::with(['images'])
            ->where('status', 1)
            ->latest()
            ->take(4)
            ->get();

        $newArrivalProducts = Product::whereHas('collections', function ($query) {
            $query->where('code', 'new_arrival');
        })
            ->where('status', 1)
            ->latest()
            ->take(4)
            ->get();

        $bestSellers = Product::whereHas('collections', function ($q) {
            $q->where('code', 'best_seller');
        })
            ->where('status', 1)
            ->latest()
            ->take(4)
            ->get();

        $premiumCollections = Product::whereHas('collections', function ($q) {
            $q->where('code', 'premium_collection');
        })
            ->where('status', 1)
            ->latest()
            ->take(4)
            ->get();

        $exclusiveCollections = Product::whereHas('collections', function ($q) {
            $q->where('code', 'exclusive_collection');
        })
            ->where('status', 1)
            ->latest()
            ->take(8)
            ->get();


        $featuredCategories = Category::with([
            'products.images'
        ])
            ->where('status', 1)
            ->where('is_featured', 1) // or your featured flag
            ->take(5)
            ->get()
            ->map(function ($category) {

                $prices = $category->products->pluck('price')->filter();

                $category->min_price = $prices->min();
                $category->max_price = $prices->max();

                return $category;
            });

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

        $reels = Testimonial::where('status', 1)
            ->where(function ($q) {
                $q->whereNotNull('reel_file')
                    ->orWhereNotNull('reel_url');
            })
            ->latest()
            ->get();

        $testimonials = Testimonial::where('status', 1)
            ->where('type', 'Text')
            ->latest()
            ->get();

        $why = HomeWhy::first();

        $whyCards = HomeWhyCard::orderBy('id')->get();

        $wishlistIds = Wishlist::current()
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->pluck('product_id')
            ->toArray();


        return view('front-pages.home', compact(
            'sliders',
            'textSliders',
            'featureCards',
            'popularCategories',
            'occasions',
            'galleryColumn1',
            'galleryColumn2',
            'galleryColumn3',
            'brandSection',
            'heroSlides',
            'heroBanners',
            'reels',
            'testimonials',
            'dealBanners',
            'saleProducts',
            'newArrivalProducts',
            'bestSellers',
            'premiumCollections',
            'featuredCategories',
            'exclusiveCollections',
            'why',
            'whyCards',
            'wishlistIds'
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
                $q->where('status', 1);
            }
        ])
            ->whereNull('parent_id')
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('front-pages.categories', compact('categories'));
    }

    public function productListing(Request $request, $slug)
    {
        $category = Category::with([
            'children',
            'categoryAttributes.attribute.values'
        ])
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $subcategories = $category->children()
            ->withCount('subCategoryProducts')
            ->get();

        $collections = Collection::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        $occasions = GiftingOccasion::where('status', 1)
            ->get();

        $products = Product::with([
            'images',
            'category',
            'subcategory',
            'collections',
            'occasions'
        ]);

        if ($request->filled('subcategory')) {

            $subcategory = Category::where(
                'slug',
                $request->subcategory
            )->first();

            if ($subcategory) {
                $products->where('subcategory_id', $subcategory->id);
            }

        } else {

            $products->where(function ($query) use ($category, $subcategories) {
                $query->where('category_id', $category->id)
                    ->orWhereIn(
                        'subcategory_id',
                        $subcategories->pluck('id')
                    );
            });
        }

        $products = $products->latest()->paginate(12);

        return view(
            'front-pages.products',
            compact(
                'category',
                'subcategories',
                'products',
                'collections',
                'occasions'
            )
        );
    }

    public function filterProducts(Request $request, $slug)
    {
        $category = Category::with('children')
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $subcategories = $category->children()->pluck('id');

        $products = Product::with([
            'images',
            'category',
            'subcategory',
            'collections',
            'occasions',
            'attributeValues'
        ]);

        // Category Products
        $products->where(function ($query) use ($category, $subcategories) {
            $query->where('category_id', $category->id)
                ->orWhereIn('subcategory_id', $subcategories);
        });

        // Subcategory Filter
        if (!empty($request->subcategory_id)) {
            $products->where('subcategory_id', $request->subcategory_id);
        }

        // Collection Filter
        if (!empty($request->collections)) {

            $products->whereHas('collections', function ($query) use ($request) {

                $query->whereIn(
                    'collections.id',
                    $request->collections
                );

            });
        }

        // Occasion Filter
        if (!empty($request->occasions)) {

            $products->whereHas('occasions', function ($query) use ($request) {

                $query->whereIn(
                    'gifting_occasions.id',
                    $request->occasions
                );

            });
        }

        if (!empty($request->search)) {

            $search = trim($request->search);

            $products->where(function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%");

            });
        }

        if (!empty($request->min_price)) {
            $products->where('price', '>=', $request->min_price);
        }

        if (!empty($request->max_price)) {
            $products->where('price', '<=', $request->max_price);
        }

        switch ($request->sort_by) {

            case 'price-low':
                $products->orderBy('price', 'asc');
                break;

            case 'price-high':
                $products->orderBy('price', 'desc');
                break;

            case 'newest':
                $products->latest();
                break;

            case 'oldest':
                $products->oldest();
                break;

            default:
                $products->latest();
                break;
        }

        if (!empty($request->attribute_values)) {

            $products->whereHas('attributeValues', function ($query) use ($request) {

                $query->whereIn(
                    'attribute_value_id',
                    $request->attribute_values
                );

            });
        }

        $products = $products->paginate(12);

        return response()->json([
            'html' => view(
                'front-pages.partials.product-grid',
                compact('products')
            )->render(),

            'pagination' => $products->links()->render(),

            'count' => $products->total()
        ]);
    }

    public function productDetail($slug)
    {
        $product = Product::with([
            'images',
            'category',
            'subcategory',
            'occasions',
            'collections',

            'attributeValues.attribute',
            'attributeValues.value',

            'variants.values.attributeValue.attribute'
        ])
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $newArrivals = Product::with([
            'images',
            'category',
            'subcategory',
            'collections'
        ])
            ->where('status', 1)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        $relatedProducts = Product::with([
            'images',
            'category',
            'subcategory',
            'collections'
        ])
            ->where('status', 1)
            ->where('id', '!=', $product->id)
            ->where(function ($query) use ($product) {

                $query->where('category_id', $product->category_id);

                if ($product->subcategory_id) {
                    $query->orWhere(
                        'subcategory_id',
                        $product->subcategory_id
                    );
                }
            })
            ->take(4)
            ->get();

        $variantAttributes = [];

        foreach ($product->variants as $variant) {

            foreach ($variant->values as $value) {

                $attributeName =
                    $value->attributeValue->attribute->name;

                $attributeId =
                    $value->attributeValue->attribute->id;

                $variantAttributes[$attributeId]['name']
                    = $attributeName;

                $variantAttributes[$attributeId]['values'][
                    $value->attributeValue->id
                ] = $value->attributeValue->value;
            }
        }

        $variantsJson = $product->variants->map(function ($variant) {
            return [
                'id' => $variant->id,
                'sku' => $variant->sku,
                'mrp' => $variant->mrp,
                'price' => $variant->price,
                'stock' => $variant->stock,
                'image' => $variant->image,

                'values' => $variant->values
                    ->pluck('attribute_value_id')
                    ->values()
                    ->toArray(),
            ];
        });

        return view('front-pages.product-detail', compact(
            'product',
            'newArrivals',
            'relatedProducts',
            'variantAttributes',
            'variantsJson'
        ));
    }


    public function thankYou($id)
    {
        // $enquiry = Enquiry::with([
        //     'state',
        //     'city',
        //     'items.product',
        //     'items.customization'
        // ])->findOrFail($id);

        return view(
            'front-pages.thank-you',
            // compact('enquiry')
        );
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
        // $blog = Blog::where('slug', $slug)
        //     ->where('status', 1)
        //     ->firstOrFail();

        // $latestBlogs = Blog::where('status', 1)
        //     ->where('id', '!=', $blog->id)
        //     ->latest()
        //     ->take(3)
        //     ->get();

        // $searchResults = collect();

        // if ($request->filled('search')) {

        //     $searchResults = Blog::where('status', 1)
        //         ->where(function ($q) use ($request) {

        //             $q->where('title', 'like', '%' . $request->search . '%')
        //                 ->orWhere('short_description', 'like', '%' . $request->search . '%')
        //                 ->orWhere('content', 'like', '%' . $request->search . '%');

        //         })
        //         ->latest()
        //         ->take(10)
        //         ->get();

        // }

        return view(
            'front-pages.blog-details',
            // compact(
            //     'blog',
            //     'latestBlogs',
            //     'searchResults'
            // )
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
        // $page = DynamicPage::where('status', 1)
        //     ->get()
        //     ->first(function ($p) use ($slug) {
        //         return Str::slug($p->page_name) === $slug;
        //     });

        // if (!$page) {
        //     abort(404);
        // }

        return view(
            'front-pages.dynamic-page'
            // , compact('page')
        );
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

    public function bulkEnquiry(Request $request)
    {
        $categories = Category::where('status', 1)->whereNull('parent_id')->get();

        return view('front-pages.bulk-enquiry', compact('categories'));
    }

    public function aboutUs(Request $request)
    {
        $teams = Team::where('status', 1)
            ->latest()
            ->get();

        return view('front-pages.about', compact('teams'));
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
            ->latest()
            ->get();

        return view('front-pages.occasions', compact('occasions'));
    }


}