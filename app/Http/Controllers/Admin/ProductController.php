<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\GiftingOccasion;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryAttribute;
use App\Models\ProductSummary;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use Symfony\Component\HttpFoundation\StreamedResponse;
use ZipArchive;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['categories', 'images']);

        // Categories dropdown
        $categories = Category::whereNull('parent_id')
            ->orderBy('name')
            ->get();

        // Subcategories dropdown
        $subCategories = collect();

        if ($request->filled('category_id')) {
            $subCategories = Category::where('parent_id', $request->category_id)
                ->orderBy('name')
                ->get();
        }

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Category Filter
        if ($request->filled('category_id')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category_id);
            });
        }

        // Sub Category Filter
        if ($request->filled('subcategory_id')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->subcategory_id);
            });
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'desc');

        $allowedSorts = [
            'id',
            'name',
            'price',
            'status'
        ];

        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $products = $query
            ->paginate(10)
            ->appends($request->all());

        return view('admin.products.index', compact(
            'products',
            'categories',
            'subCategories'
        ));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('admin.products.create', compact(
            'categories',
        ));

    }

    public function subcategories(Category $category)
    {
        return response()->json(

            Category::where('parent_id', $category->id)
                ->where('status', 1)
                ->orderBy('name')
                ->get([
                    'id',
                    'name'
                ])

        );
    }

    public function categoryAttributes(Category $category)
    {
        $attributes = CategoryAttribute::with([
            'attribute.values'
        ])
            ->where('category_id', $category->id)
            ->where('status', 1)
            ->orderBy('sort_order')
            ->get();

        return response()->json($attributes);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'video_url' => 'nullable|string',
            'min_qty' => 'required|integer|min:1',
        ]);

        // CREATE PRODUCT
        $product = Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'brand_id' => $request->brand_id,

            'sub_title' => $request->sub_title,
            'summary' => $request->summary,

            'video_url' => $request->video_url,

            'sku' => $request->sku,
            'min_qty' => $request->min_qty,
            'delivery_time' => $request->delivery_time,

            'quality' => $request->quality ? 1 : 0,
            'pan_india' => $request->pan_india ? 1 : 0,

            'mrp' => $request->mrp ?? 0,
            'discount' => $request->discount ?? 0,
            'discount_type' => $request->discount_type,
            'price' => $request->price ?? 0,

            // FLAGS
            'featured' => $request->featured ? 1 : 0,
            'new_arrival' => $request->new_arrival ? 1 : 0,
            'sale' => $request->sale ? 1 : 0,
            'best_seller' => $request->best_seller ? 1 : 0,

            'ready_to_ship' => $request->ready_to_ship ? 1 : 0,
            'bulk_available' => $request->bulk_available ? 1 : 0,
            'gift_hamper' => $request->gift_hamper ? 1 : 0,

            'is_premium' => $request->is_premium ? 1 : 0,
            'is_engraving' => $request->is_engraving ? 1 : 0,
            'is_personalized_engraving' => $request->is_personalized_engraving ? 1 : 0,
            'show_on_website' => $request->show_on_website ? 1 : 0,

            'details' => $request->details,
            'delivery_returns' => $request->delivery_returns,

            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,

            'cart' => $request->cart ? 1 : 0,
            'whatsapp' => $request->whatsapp ? 1 : 0,
            'call' => $request->call ? 1 : 0,

            'status' => $request->status ?? 1,
            'product_code' => $request->product_code,
            'sort_order' => $request->sort_order ?? 0,
            'added_by' => $request->added_by,
        ]);

        // MULTIPLE IMAGES SAVE
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $index => $img) {

                $path = $img->store('products', 'public');

                \App\Models\ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'is_default' => ($request->default_image == $index) ? 1 : 0
                ]);
            }
        }

        // RELATIONS
        $product->categories()->sync($request->categories ?? []);
        $product->subcategories()->sync($request->sub_categories ?? []);
        $product->occasions()->sync($request->occasions ?? []);
        $product->customizations()->sync($request->customizations ?? []);

        // INCLUSIONS
        if ($request->inclusions) {
            foreach ($request->inclusions as $inc) {
                if (!empty($inc)) {
                    ProductSummary::create([
                        'product_id' => $product->id,
                        'title' => $inc
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product Created Successfully');
    }

    public function edit(Request $request, $id)
    {
        $product = Product::with([
            'categories',
            'subcategories',
            'occasions',
            'customizations',
            'inclusions',
            'images'
        ])->findOrFail($id);

        $redirect = $request->redirect;

        return view('admin.products.edit', [
            'product' => $product,
            'redirect' => $redirect,

            'categories' => Category::whereNull('parent_id')
                ->where('status', 1)
                ->get(),

            'occasions' => GiftingOccasion::where('status', 1)->get(),
            'brands' => Brand::where('status', 1)->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'video_url' => 'nullable|string',
            'min_qty' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($id);

        // UPDATE PRODUCT (NO SINGLE IMAGE)
        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'brand_id' => $request->brand_id,

            'sub_title' => $request->sub_title,
            'summary' => $request->summary,

            'video_url' => $request->video_url,

            'sku' => $request->sku,
            'min_qty' => $request->min_qty,
            'delivery_time' => $request->delivery_time,

            'quality' => $request->quality ? 1 : 0,
            'pan_india' => $request->pan_india ? 1 : 0,

            'mrp' => $request->mrp ?? 0,
            'discount' => $request->discount ?? 0,
            'discount_type' => $request->discount_type,
            'price' => $request->price ?? 0,

            'featured' => $request->featured ? 1 : 0,
            'new_arrival' => $request->new_arrival ? 1 : 0,
            'sale' => $request->sale ? 1 : 0,
            'best_seller' => $request->best_seller ? 1 : 0,

            'ready_to_ship' => $request->ready_to_ship ? 1 : 0,
            'bulk_available' => $request->bulk_available ? 1 : 0,
            'gift_hamper' => $request->gift_hamper ? 1 : 0,

            'is_premium' => $request->is_premium ? 1 : 0,
            'is_engraving' => $request->is_engraving ? 1 : 0,
            'is_personalized_engraving' => $request->is_personalized_engraving ? 1 : 0,
            'show_on_website' => $request->show_on_website ? 1 : 0,

            'details' => $request->details,
            'delivery_returns' => $request->delivery_returns,

            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,

            'cart' => $request->cart ? 1 : 0,
            'whatsapp' => $request->whatsapp ? 1 : 0,
            'call' => $request->call ? 1 : 0,

            'status' => $request->status ?? 1,
            'product_code' => $request->product_code,
            'sort_order' => $request->sort_order ?? 0,
            'added_by' => $request->added_by,
        ]);

        // ✅ ADD NEW IMAGES (OLD DELETE NAHI KAR RAHE - SAFE APPROACH)
        $defaultType = $request->default_type;

        // RESET ALL DEFAULTS
        $product->images()->update(['is_default' => 0]);

        // ✅ EXISTING DEFAULT
        if ($defaultType && str_starts_with($defaultType, 'old_')) {

            $id = str_replace('old_', '', $defaultType);

            \App\Models\ProductImage::where('id', $id)
                ->where('product_id', $product->id)
                ->update(['is_default' => 1]);
        }

        // ✅ NEW IMAGES
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $img) {

                $path = $img->store('products', 'public');

                $isDefault = 0;

                if ($defaultType === "new_" . $index) {
                    $isDefault = 1;
                }

                \App\Models\ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'is_default' => $isDefault
                ]);
            }
        }

        // DELETE SELECTED IMAGES
        if ($request->delete_images) {
            foreach ($request->delete_images as $imgId) {

                $img = \App\Models\ProductImage::find($imgId);

                if ($img) {
                    if (Storage::disk('public')->exists($img->image)) {
                        Storage::disk('public')->delete($img->image);
                    }
                    $img->delete();
                }
            }
        }

        // RELATIONS
        $product->categories()->sync($request->categories ?? []);
        $product->subcategories()->sync($request->sub_categories ?? []);
        $product->occasions()->sync($request->occasions ?? []);
        $product->customizations()->sync($request->customizations ?? []);

        // INCLUSIONS
        $product->inclusions()->delete();

        if ($request->inclusions) {
            foreach ($request->inclusions as $inc) {
                if (!empty($inc)) {
                    ProductSummary::create([
                        'product_id' => $product->id,
                        'title' => $inc
                    ]);
                }
            }
        }
        return redirect(
            $request->redirect ?? route('admin.products.index')
        )->with('success', 'Product Updated Successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product Deleted Successfully'
        ]);
    }

    public function import()
    {
        return view('admin.products.import');
    }

    public function importStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimetypes:text/plain,text/csv,application/vnd.ms-excel'
        ]);
        try {

            Excel::import(
                new ProductImport,
                $request->file('file')
            );

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Products imported successfully.');

        } catch (\Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function downloadSample()
    {
        $headers = [
            'name',
            'image_name',

            'brand',

            'sub_title',
            'summary',

            'video_url',

            'sku',
            'product_code',

            'mrp',
            'discount',
            'discount_type',
            'price',

            'min_qty',
            'delivery_time',

            'quality',
            'pan_india',

            'featured',
            'new_arrival',
            'sale',
            'best_seller',

            'ready_to_ship',
            'bulk_available',
            'gift_hamper',

            'is_premium',
            'is_engraving',
            'is_personalized_engraving',

            'show_on_website',

            'details',
            'delivery_returns',

            'meta_title',
            'meta_description',

            'cart',
            'whatsapp',
            'call',

            'status',
            'sort_order',
            'added_by',

            'categories',
            'sub_categories',

            'occasions',
            'customizations',

            'inclusions'
        ];

        $sampleRow = [
            'Leather Diary',
            'SKU001.jpg',

            'Parker',

            'Premium Leather Diary',
            'Corporate Gift Diary',

            'https://youtube.com/watch?v=abc123',

            'SKU001',
            'PRD001',

            '500',
            '10',
            'percentage',
            '450',

            '1',
            '5 Days',

            '1',
            '1',

            '1',
            '1',
            '0',
            '1',

            '1',
            '1',
            '0',

            '1',
            '0',
            '0',

            '1',

            'Product Description',
            'Branding Available',

            'Leather Diary',
            'Premium Leather Diary Description',

            '1',
            '1',
            '0',

            '1',
            '1',
            'Admin',

            'Corporate Gifts',
            'Diaries',

            'Diwali, New Year',
            'Laser Engraving, Printing',

            'Gift Box, User Manual'
        ];

        $response = new StreamedResponse(function () use ($headers, $sampleRow) {

            $handle = fopen('php://output', 'w');

            fputcsv($handle, $headers);
            fputcsv($handle, $sampleRow);

            fclose($handle);
        });

        $response->headers->set(
            'Content-Type',
            'text/csv'
        );

        $response->headers->set(
            'Content-Disposition',
            'attachment; filename=product_import_sample.csv'
        );

        return $response;
    }

    public function uploadImagesZip(Request $request)
    {
        $request->validate([
            'zip_file' => 'required|mimes:zip'
        ]);

        $zipFile = $request->file('zip_file');

        $zipPath = $zipFile->getRealPath();

        $zip = new ZipArchive();

        if ($zip->open($zipPath) === TRUE) {

            $zip->extractTo(
                storage_path('app/public/products')
            );

            $zip->close();

            return back()->with(
                'success',
                'Images extracted successfully.'
            );
        }

        return back()->with(
            'error',
            'Unable to extract zip.'
        );
    }

    public function downloadCategoryReference()
    {
        $categories = Category::whereNull('parent_id')
            ->orWhere('parent_id', 0)
            ->orderBy('id')
            ->get(['id', 'name']);

        $response = new StreamedResponse(function () use ($categories) {

            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['id', 'name']);

            foreach ($categories as $category) {

                fputcsv($handle, [
                    $category->id,
                    $category->name
                ]);
            }

            fclose($handle);
        });

        $response->headers->set(
            'Content-Type',
            'text/csv'
        );

        $response->headers->set(
            'Content-Disposition',
            'attachment; filename=categories_reference.csv'
        );

        return $response;
    }

    public function downloadSubCategoryReference()
    {
        $subCategories = Category::with('parent')
            ->whereNotNull('parent_id')
            ->orderBy('id')
            ->get();

        $response = new StreamedResponse(function () use ($subCategories) {

            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'id',
                'name',
                'parent_category'
            ]);

            foreach ($subCategories as $subCategory) {

                fputcsv($handle, [
                    $subCategory->id,
                    $subCategory->name,
                    optional($subCategory->parent)->name
                ]);
            }

            fclose($handle);
        });

        $response->headers->set(
            'Content-Type',
            'text/csv'
        );

        $response->headers->set(
            'Content-Disposition',
            'attachment; filename=subcategories_reference.csv'
        );

        return $response;
    }

    public function downloadBrandReference()
    {
        $brands = Brand::orderBy('id')
            ->get(['id', 'name']);

        $response = new StreamedResponse(function () use ($brands) {

            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['id', 'name']);

            foreach ($brands as $brand) {

                fputcsv($handle, [
                    $brand->id,
                    $brand->name
                ]);
            }

            fclose($handle);
        });

        $response->headers->set(
            'Content-Type',
            'text/csv'
        );

        $response->headers->set(
            'Content-Disposition',
            'attachment; filename=brands_reference.csv'
        );

        return $response;
    }


    public function downloadOccasionReference()
    {
        $occasions = GiftingOccasion::orderBy('id')
            ->get(['id', 'title']);

        $response = new StreamedResponse(function () use ($occasions) {

            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'id',
                'title'
            ]);

            foreach ($occasions as $occasion) {

                fputcsv($handle, [
                    $occasion->id,
                    $occasion->title
                ]);
            }

            fclose($handle);
        });

        $response->headers->set(
            'Content-Type',
            'text/csv'
        );

        $response->headers->set(
            'Content-Disposition',
            'attachment; filename=occasions_reference.csv'
        );

        return $response;
    }

}