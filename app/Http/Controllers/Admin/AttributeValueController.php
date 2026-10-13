<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    /**
     * Meta title templates per attribute name, per spec. Falls back to a
     * generic pattern for any attribute not explicitly listed (e.g. Size,
     * which isn't SEO-required anyway so this path is rarely hit for it).
     */
    private function buildValueMetaTitle(string $attributeName, string $valueName): string
    {
        $attributeName = strtolower(trim($attributeName));

        return match ($attributeName) {
            'fabric' => "{$valueName} Chikankari Clothing Online | Oudhyaana",
            'colour', 'color' => "{$valueName} Chikankari Clothing for Women | Oudhyaana",
            'style' => "{$valueName} Chikankari for Women | Oudhyaana",
            default => "{$valueName} | Oudhyaana Chikankaari",
        };
    }

    private function buildValueMetaDescription(string $attributeName, string $valueName): string
    {
        $attributeName = strtolower(trim($attributeName));

        return match ($attributeName) {
            'fabric' => "Shop {$valueName} Chikankari at Oudhyaana. Explore handcrafted Lucknowi Chikankari styles in premium {$valueName} for timeless ethnic wear.",
            'colour', 'color' => "Shop {$valueName} Chikankari clothing at Oudhyaana. Explore handcrafted Lucknowi Chikankari kurta sets, sarees, anarkalis and more in elegant {$valueName} shades.",
            'style' => "Shop {$valueName} Chikankari at Oudhyaana. Explore handcrafted Lucknowi Chikankari designs crafted in premium fabrics for elegant ethnic wear.",
            default => "Shop {$valueName} at Oudhyaana. Discover authentic handcrafted Lucknowi Chikankari.",
        };
    }

    /**
     * H1 heading autofill — generic pattern regardless of attribute type:
     * "{Value} Chikankari Collection".
     */
    private function buildValueH1(string $valueName): string
    {
        return "{$valueName} Chikankari Collection";
    }

    private function generateUniqueValueSlug(string $value, ?int $ignoreId = null): string
    {
        $slug = Str::slug($value);
        $original = $slug;
        $count = 1;

        while (
            AttributeValue::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function store(Request $request)
    {
        $attribute = Attribute::findOrFail($request->attribute_id);

        $rules = [
            'attribute_id' => 'required|exists:attributes,id',
            'value' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'sort_order' => 'nullable|integer',
            'status' => 'required|boolean',
            'h1' => 'nullable|max:255',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
            'meta_status' => 'nullable|in:index_follow,noindex_unfollow',
        ];

        if ($attribute->type === 'color_swatch') {
            $rules['hex_code'] = 'required|max:20';
        }

        $request->validate($rules);

        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')
                ->store('attribute-values', 'public');
        }

        $valueName = trim($request->value);
        $slug = $this->generateUniqueValueSlug($valueName);

        $data = [
            'attribute_id' => $request->attribute_id,
            'value' => $valueName,
            'slug' => $slug,
            'image' => $image,
            'hex_code' => $attribute->type === 'color_swatch'
                ? $request->hex_code
                : null,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
            'meta_status' => $request->meta_status ?: 'index_follow',
        ];

        // SEO fields (including H1) only populate when the parent Attribute
        // is flagged seo_required (e.g. Fabric/Colour/Style — not Size).
        if ($attribute->seo_required) {
            $data['h1'] = $request->filled('h1')
                ? $request->h1
                : $this->buildValueH1($valueName);

            $data['meta_title'] = $request->filled('meta_title')
                ? $request->meta_title
                : $this->buildValueMetaTitle($attribute->name, $valueName);

            $data['meta_description'] = $request->filled('meta_description')
                ? $request->meta_description
                : $this->buildValueMetaDescription($attribute->name, $valueName);

            $data['canonical'] = $attribute->slug . '/' . $slug;
            $data['og_title'] = $data['meta_title'];
            $data['og_description'] = $data['meta_description'];
            $data['og_image'] = $image;
            $data['twitter_card'] = 'summary_large_image';
            $data['twitter_title'] = $data['meta_title'];
            $data['twitter_description'] = $data['meta_description'];
            $data['twitter_image'] = $image;
        }

        AttributeValue::create($data);

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
        $attribute = Attribute::findOrFail($request->attribute_id);

        $rules = [
            'attribute_id' => 'required|exists:attributes,id',
            'value' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'sort_order' => 'nullable|integer',
            'status' => 'required|boolean',
            'h1' => 'nullable|max:255',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
            'meta_status' => 'nullable|in:index_follow,noindex_unfollow',
        ];

        if ($attribute->type === 'color_swatch') {
            $rules['hex_code'] = 'required|max:20';
        }

        $request->validate($rules);

        $image = $attributeValue->image;

        if ($request->hasFile('image')) {

            if ($attributeValue->image && Storage::disk('public')->exists($attributeValue->image)) {
                Storage::disk('public')->delete($attributeValue->image);
            }

            $image = $request->file('image')
                ->store('attribute-values', 'public');
        }

        $valueName = trim($request->value);

        // Only regenerate the slug if the value text actually changed.
        $slug = Str::slug($valueName) === $attributeValue->slug
            ? $attributeValue->slug
            : $this->generateUniqueValueSlug($valueName, $attributeValue->id);

        $data = [
            'attribute_id' => $request->attribute_id,
            'value' => $valueName,
            'slug' => $slug,
            'image' => $image,
            'hex_code' => $attribute->type === 'color_swatch'
                ? $request->hex_code
                : null,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
            'meta_status' => $request->meta_status ?: 'index_follow',
        ];

        if ($attribute->seo_required) {
            $data['h1'] = $request->filled('h1')
                ? $request->h1
                : $this->buildValueH1($valueName);

            $data['meta_title'] = $request->filled('meta_title')
                ? $request->meta_title
                : $this->buildValueMetaTitle($attribute->name, $valueName);

            $data['meta_description'] = $request->filled('meta_description')
                ? $request->meta_description
                : $this->buildValueMetaDescription($attribute->name, $valueName);

            $data['canonical'] = $attribute->slug . '/' . $slug;
            $data['og_title'] = $data['meta_title'];
            $data['og_description'] = $data['meta_description'];
            $data['og_image'] = $image;
            $data['twitter_card'] = 'summary_large_image';
            $data['twitter_title'] = $data['meta_title'];
            $data['twitter_description'] = $data['meta_description'];
            $data['twitter_image'] = $image;
        } else {
            // Attribute isn't SEO-required (or was unflagged) — clear stale
            // SEO data rather than leaving orphaned tags nobody can edit.
            $data['h1'] = null;
            $data['meta_title'] = null;
            $data['meta_description'] = null;
            $data['canonical'] = null;
            $data['og_title'] = null;
            $data['og_description'] = null;
            $data['og_image'] = null;
            $data['twitter_title'] = null;
            $data['twitter_description'] = null;
            $data['twitter_image'] = null;
        }

        $attributeValue->update($data);

        return redirect()
            ->route('admin.attribute-values.index')
            ->with('success', 'Attribute value updated successfully.');
    }

    public function destroy(AttributeValue $attributeValue)
    {
        if (
            $attributeValue->image &&
            Storage::disk('public')->exists($attributeValue->image)
        ) {

            Storage::disk('public')->delete($attributeValue->image);
        }

        $attributeValue->delete();

        return response()->json([
            'status' => true,
            'message' => 'Attribute value deleted successfully.',
        ]);
    }
}