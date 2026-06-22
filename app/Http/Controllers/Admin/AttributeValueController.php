<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttributeValueController extends Controller
{
    public function index()
    {
        $attributeValues = AttributeValue::with('attribute')
            ->latest()
            ->paginate(20);

        return view('admin.attribute-values.index', compact('attributeValues'));
    }

    public function create()
    {
        $attributes = Attribute::where('has_values', 1)
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('admin.attribute-values.create', compact('attributes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'attribute_id' => 'required|exists:attributes,id',
            'value' => 'required|max:255',
            'sort_order' => 'nullable|integer',
            'status' => 'required|boolean',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
        ]);

        AttributeValue::create([
            'attribute_id' => $request->attribute_id,
            'value' => trim($request->value),
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        return redirect()
            ->route('admin.attribute-values.index')
            ->with('success', 'Attribute value created successfully.');
    }

    public function edit(AttributeValue $attributeValue)
    {
        $attributes = Attribute::where('has_values', 1)
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view(
            'admin.attribute-values.edit',
            compact('attributeValue', 'attributes')
        );
    }

    public function update(Request $request, AttributeValue $attributeValue)
    {
        $request->validate([
            'attribute_id' => 'required|exists:attributes,id',
            'value' => 'required|max:255',
            'sort_order' => 'nullable|integer',
            'status' => 'required|boolean',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
        ]);

        $attributeValue->update([
            'attribute_id' => $request->attribute_id,
            'value' => trim($request->value),
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        return redirect()
            ->route('admin.attribute-values.index')
            ->with('success', 'Attribute value updated successfully.');
    }

    public function destroy(AttributeValue $attributeValue)
    {
        $attributeValue->delete();

        return response()->json([
            'status' => true,
            'message' => 'Attribute value deleted successfully.',
        ]);
    }
}