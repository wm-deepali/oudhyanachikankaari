<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\GiftingOccasion;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryAttribute;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use Symfony\Component\HttpFoundation\StreamedResponse;
use ZipArchive;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use App\Models\ProductAttributeValue;
use App\Models\ProductVariant;
use App\Models\ProductVariantValue;
use App\Models\Collection;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('images');

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

        $occasions = GiftingOccasion::where('status', 1)->get();

        $collections = Collection::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        return view('admin.products.create', compact(
            'categories',
            'occasions',
            'collections'
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
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'mrp' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:amount,percentage',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'min_qty' => 'nullable|integer|min:1',
            'sku' => 'nullable|string|max:255',
            'product_code' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();

        try {

            $product = Product::create([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'name' => $request->name,
                'slug' => $request->slug ?: Str::slug($request->name),
                'short_description' => $request->short_description,
                'description' => $request->description,
                'delivery_returns' => $request->delivery_returns,
                'fabric_care' => $request->fabric_care,

                // ✅ blank MRP/Discount/Price never get inserted as '' into decimal columns
                'mrp' => $request->mrp !== null && $request->mrp !== '' ? $request->mrp : 0,
                'discount_type' => $request->discount_type ?: 'amount',
                'discount' => $request->discount !== null && $request->discount !== '' ? $request->discount : 0,
                'price' => $request->price !== null && $request->price !== '' ? $request->price : ($request->mrp ?: 0),

                'sku' => $request->sku,
                'stock' => $request->stock !== null && $request->stock !== '' ? $request->stock : 0,
                'min_qty' => $request->min_qty !== null && $request->min_qty !== '' ? $request->min_qty : 1,
                'product_code' => $request->product_code,
                'delivery_time' => $request->delivery_time,

                'quality' => $request->has('quality'),
                'pan_india' => $request->has('pan_india'),

                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,

                'status' => $request->status,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Product Images
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $index => $image) {

                    $path = $image->store(
                        'products',
                        'public'
                    );

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $path,
                        'is_default' => $request->default_image == $index ? 1 : 0,
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Product Attributes
            |--------------------------------------------------------------------------
            */

            if ($request->filled('attribute_values')) {

                foreach ($request->attribute_values as $attributeId => $values) {

                    foreach ($values as $valueId) {

                        ProductAttributeValue::create([
                            'product_id' => $product->id,
                            'attribute_id' => $attributeId,
                            'attribute_value_id' => $valueId,
                        ]);
                    }
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Variants
            |--------------------------------------------------------------------------
            */

            if ($request->filled('variants')) {

                foreach ($request->variants as $variantData) {

                    $variantImage = null;

                    if (
                        isset($variantData['image']) &&
                        $variantData['image'] instanceof \Illuminate\Http\UploadedFile
                    ) {

                        $variantImage = $variantData['image']->store(
                            'product-variants',
                            'public'
                        );
                    }

                    $variant = ProductVariant::create([

                        'product_id' => $product->id,

                        'sku' => $variantData['sku'] ?? null,

                        'mrp' => $variantData['mrp'] ?? 0,

                        'discount_type' => $variantData['discount_type'] ?? 'amount',

                        'discount' => $variantData['discount'] ?? 0,

                        'price' => $variantData['price'] ?? 0,

                        'stock' => $variantData['stock'] ?? 0,

                        'image' => $variantImage,

                    ]);

                    if (!empty($variantData['values'])) {

                        foreach ($variantData['values'] as $valueId) {

                            ProductVariantValue::create([
                                'variant_id' => $variant->id,
                                'attribute_value_id' => $valueId,
                            ]);
                        }
                    }
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Occasions
            |--------------------------------------------------------------------------
            */

            if ($request->filled('occasions')) {

                $product->occasions()->sync(
                    $request->occasions
                );
            }

            if ($request->filled('collections')) {

                $product->collections()->sync(
                    $request->collections
                );

            }

            DB::commit();

            return redirect()
                ->route('admin.products.index')
                ->with(
                    'success',
                    'Product created successfully.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            dd(
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
        }
    }

    public function edit(Product $product)
    {
        $product->load([

            'images',

            'attributeValues.attribute',
            'attributeValues.value',

            'variants.values.attributeValue',

            'occasions',

        ]);

        $categories = Category::whereNull('parent_id')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        $subcategories = Category::where(
            'parent_id',
            $product->category_id
        )
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        $occasions = GiftingOccasion::where('status', 1)->get();
        $attributes = CategoryAttribute::with([
            'attribute.values'
        ])
            ->where('category_id', $product->category_id)
            ->where('status', 1)
            ->orderBy('sort_order')
            ->get();

        $selectedAttributeValues = $product
            ->attributeValues
            ->pluck('attribute_value_id')
            ->toArray();

        $selectedOccasions = $product
            ->occasions
            ->pluck('id')
            ->toArray();


        $existingVariants = $product->variants
            ->map(function ($variant) {

                return [

                    'id' => $variant->id,

                    'sku' => $variant->sku,

                    'mrp' => $variant->mrp,

                    'discount_type' => $variant->discount_type,

                    'discount' => $variant->discount,

                    'price' => $variant->price,

                    'stock' => $variant->stock,

                    'image' => $variant->image,
                    'variant_name' => $variant->values
                        ->map(function ($v) {
                            return $v->attributeValue->value;
                        })
                        ->implode(' / '),

                ];

            })
            ->values();

        $collections = Collection::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        return view(
            'admin.products.edit',
            compact(
                'product',
                'categories',
                'subcategories',
                'attributes',
                'selectedAttributeValues',
                'selectedOccasions',
                'occasions',
                'existingVariants',
                'collections'
            )
        );
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'mrp' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:amount,percentage',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'min_qty' => 'nullable|integer|min:1',
            'sku' => 'nullable|string|max:255',
            'product_code' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();

        try {

            $product->update([

                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,

                'name' => $request->name,
                'slug' => $request->slug ?: Str::slug($request->name),

                'short_description' => $request->short_description,
                'description' => $request->description,
                'delivery_returns' => $request->delivery_returns,
                'fabric_care' => $request->fabric_care,

                // ✅ blank MRP/Discount/Price never get written as '' into decimal columns
                'mrp' => $request->mrp !== null && $request->mrp !== '' ? $request->mrp : 0,
                'discount_type' => $request->discount_type ?: 'amount',
                'discount' => $request->discount !== null && $request->discount !== '' ? $request->discount : 0,
                'price' => $request->price !== null && $request->price !== '' ? $request->price : ($request->mrp ?: 0),

                'sku' => $request->sku,
                'stock' => $request->stock !== null && $request->stock !== '' ? $request->stock : 0,
                'min_qty' => $request->min_qty !== null && $request->min_qty !== '' ? $request->min_qty : 1,
                'product_code' => $request->product_code,
                'delivery_time' => $request->delivery_time,

                'quality' => $request->has('quality'),
                'pan_india' => $request->has('pan_india'),

                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,

                'status' => $request->status,
            ]);


            // ✅ ADD NEW IMAGES (OLD DELETE NAHI KAR RAHE - SAFE APPROACH)
            $defaultType = $request->default_type;

            // RESET ALL DEFAULTS
            $product->images()->update(['is_default' => 0]);

            // ✅ EXISTING DEFAULT
            if ($defaultType && str_starts_with($defaultType, 'old_')) {

                $id = str_replace('old_', '', $defaultType);

                ProductImage::where('id', $id)
                    ->where('product_id', $product->id)
                    ->update(['is_default' => 1]);
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $img) {

                    $path = $img->store('products', 'public');

                    $isDefault = 0;

                    if ($defaultType === "new_" . $index) {
                        $isDefault = 1;
                    }

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $path,
                        'is_default' => $isDefault
                    ]);
                }
            }

            // DELETE SELECTED IMAGES
            if ($request->delete_images) {
                foreach ($request->delete_images as $imgId) {

                    $img = ProductImage::find($imgId);

                    if ($img) {
                        if (Storage::disk('public')->exists($img->image)) {
                            Storage::disk('public')->delete($img->image);
                        }
                        $img->delete();
                    }
                }
            }


            /*
|--------------------------------------------------------------------------
| Product Attributes (SYNC)
|--------------------------------------------------------------------------
*/

            $currentAttributes = ProductAttributeValue::where(
                'product_id',
                $product->id
            )->get();

            $currentKeys = $currentAttributes
                ->map(function ($row) {
                    return $row->attribute_id . '-' . $row->attribute_value_id;
                })
                ->toArray();

            $newKeys = [];

            foreach ($request->attribute_values ?? [] as $attributeId => $values) {

                foreach ($values as $valueId) {

                    $newKeys[] = $attributeId . '-' . $valueId;

                    ProductAttributeValue::firstOrCreate([
                        'product_id' => $product->id,
                        'attribute_id' => $attributeId,
                        'attribute_value_id' => $valueId,
                    ]);
                }
            }

            foreach ($currentAttributes as $row) {

                $key = $row->attribute_id . '-' . $row->attribute_value_id;

                if (!in_array($key, $newKeys)) {

                    $row->delete();
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Variants
            |--------------------------------------------------------------------------
            */

            $existingVariantIds = [];

            if ($request->filled('variants')) {

                foreach ($request->variants as $variantData) {

                    if (!empty($variantData['id'])) {

                        $variant = ProductVariant::where(
                            'product_id',
                            $product->id
                        )->where(
                                'id',
                                $variantData['id']
                            )->first();

                        if (!$variant) {
                            continue;
                        }

                        $existingVariantIds[] = $variant->id;

                    } else {

                        $variant = new ProductVariant();

                        $variant->product_id = $product->id;
                    }

                    $variantImage = $variant->image;

                    if (
                        isset($variantData['image']) &&
                        $variantData['image'] instanceof \Illuminate\Http\UploadedFile
                    ) {

                        if ($variant->image) {

                            Storage::disk('public')->delete(
                                $variant->image
                            );
                        }

                        $variantImage = $variantData['image']->store(
                            'product-variants',
                            'public'
                        );
                    }

                    $variant->fill([

                        'sku' => $variantData['sku'] ?? null,

                        'mrp' => $variantData['mrp'] ?? 0,

                        'discount_type' => $variantData['discount_type'] ?? 'amount',

                        'discount' => $variantData['discount'] ?? 0,

                        'price' => $variantData['price'] ?? 0,

                        'stock' => $variantData['stock'] ?? 0,

                        'image' => $variantImage,

                    ]);

                    $variant->save();

                    /*
                    |--------------------------------------------------------------------------
                    | New Variant Only
                    |--------------------------------------------------------------------------
                    */

                    if (
                        empty($variantData['id']) &&
                        !empty($variantData['values'])
                    ) {

                        foreach ($variantData['values'] as $valueId) {

                            ProductVariantValue::create([

                                'variant_id' => $variant->id,

                                'attribute_value_id' => $valueId,

                            ]);
                        }
                    }
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Delete Removed Variants
            |--------------------------------------------------------------------------
            */

            $variantsToDelete = ProductVariant::where(
                'product_id',
                $product->id
            );

            if (!empty($existingVariantIds)) {

                $variantsToDelete->whereNotIn(
                    'id',
                    $existingVariantIds
                );
            }

            $variantsToDelete = $variantsToDelete->get();

            foreach ($variantsToDelete as $variant) {

                if ($variant->image) {

                    Storage::disk('public')->delete(
                        $variant->image
                    );
                }

                ProductVariantValue::where(
                    'variant_id',
                    $variant->id
                )->delete();

                $variant->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | Occasions
            |--------------------------------------------------------------------------
            */

            $product->occasions()->sync(
                $request->occasions ?? []
            );

            $product->collections()->sync(
                $request->collections ?? []
            );

            DB::commit();

            return redirect()
                ->route('admin.products.index')
                ->with(
                    'success',
                    'Product updated successfully.'
                );

        } catch (\Exception $e) {


            DB::rollBack();

            dd(
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
        }
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