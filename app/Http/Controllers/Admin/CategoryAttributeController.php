<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\CategoryAttribute;
use Illuminate\Http\Request;

class CategoryAttributeController extends Controller
{
    public function index()
    {
        $categoryAttributes = CategoryAttribute::with([
            'category',
            'attribute'
        ])
        ->latest()
        ->paginate(20);

        return view(
            'admin.category-attributes.index',
            compact('categoryAttributes')
        );
    }

    public function create()
    {
        $categories = Category::where('status', 1)
            ->orderBy('name')
            ->get();

        $attributes = Attribute::where('status', 1)
            ->orderBy('name')
            ->get();

        return view(
            'admin.category-attributes.create',
            compact(
                'categories',
                'attributes'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'      => 'required|exists:categories,id',
            'attribute_id'     => 'required|exists:attributes,id',

            'is_required'      => 'required|boolean',
            'used_for_variant' => 'required|boolean',
            'show_in_filter'   => 'required|boolean',
            'show_on_listing'  => 'required|boolean',

            'sort_order'       => 'nullable|integer',
            'status'           => 'required|boolean',
        ]);

        $exists = CategoryAttribute::where(
            'category_id',
            $request->category_id
        )
        ->where(
            'attribute_id',
            $request->attribute_id
        )
        ->exists();

        if ($exists) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Mapping already exists.'
                );
        }

        CategoryAttribute::create([

            'category_id'      => $request->category_id,

            'attribute_id'     => $request->attribute_id,

            'is_required'      => $request->is_required,

            'used_for_variant' => $request->used_for_variant,

            'show_in_filter'   => $request->show_in_filter,

            'show_on_listing'  => $request->show_on_listing,

            'sort_order'       => $request->sort_order ?? 0,

            'status'           => $request->status,

        ]);

        return redirect()
            ->route('admin.category-attributes.index')
            ->with(
                'success',
                'Category Attribute created successfully.'
            );
    }

    public function edit(CategoryAttribute $categoryAttribute)
    {
        $categories = Category::where('status', 1)
            ->orderBy('name')
            ->get();

        $attributes = Attribute::where('status', 1)
            ->orderBy('name')
            ->get();

        return view(
            'admin.category-attributes.edit',
            compact(
                'categoryAttribute',
                'categories',
                'attributes'
            )
        );
    }

    public function update(
        Request $request,
        CategoryAttribute $categoryAttribute
    ) {

        $request->validate([
            'category_id'      => 'required|exists:categories,id',
            'attribute_id'     => 'required|exists:attributes,id',

            'is_required'      => 'required|boolean',
            'used_for_variant' => 'required|boolean',
            'show_in_filter'   => 'required|boolean',
            'show_on_listing'  => 'required|boolean',

            'sort_order'       => 'nullable|integer',
            'status'           => 'required|boolean',
        ]);

        $exists = CategoryAttribute::where(
            'category_id',
            $request->category_id
        )
        ->where(
            'attribute_id',
            $request->attribute_id
        )
        ->where(
            'id',
            '!=',
            $categoryAttribute->id
        )
        ->exists();

        if ($exists) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Mapping already exists.'
                );
        }

        $categoryAttribute->update([

            'category_id'      => $request->category_id,

            'attribute_id'     => $request->attribute_id,

            'is_required'      => $request->is_required,

            'used_for_variant' => $request->used_for_variant,

            'show_in_filter'   => $request->show_in_filter,

            'show_on_listing'  => $request->show_on_listing,

            'sort_order'       => $request->sort_order ?? 0,

            'status'           => $request->status,

        ]);

        return redirect()
            ->route('admin.category-attributes.index')
            ->with(
                'success',
                'Category Attribute updated successfully.'
            );
    }

    public function destroy(CategoryAttribute $categoryAttribute)
    {
        $categoryAttribute->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Deleted successfully.'
        ]);
    }
}