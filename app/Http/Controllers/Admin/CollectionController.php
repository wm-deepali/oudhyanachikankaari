<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        $query = Collection::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $collections = $query
            ->orderBy('sort_order')
            ->paginate(10);

        return view(
            'admin.collections.index',
            compact('collections')
        );
    }

    public function create()
    {
        return view('admin.collections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'h1_heading' => 'required|max:255',
            'meta_title' => 'required|max:255',
            'meta_description' => 'required',
            'slug' => 'nullable|max:255|unique:collections,slug',
            'canonical' => 'nullable|max:255',
            'og_title' => 'nullable|max:255',
            'og_description' => 'nullable',
            'image_alt' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $slug = $request->slug
            ? Str::slug($request->slug)
            : Str::slug($request->name);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('collections', 'public');
        }

        Collection::create([
            'name' => $request->name,
            'h1_heading' => $request->h1_heading,
            'slug' => $slug,
            'code' => $slug,
            'image' => $imagePath,
            // falls back to name if left blank
            'image_alt' => $request->image_alt ?: $request->name,
            'status' => $request->status ?? 1,
            'sort_order' => $request->sort_order ?? 0,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            // falls back to slug if left blank
            'canonical' => $request->canonical ?: $slug,
            // fall back to meta title/description if left blank
            'og_title' => $request->og_title ?: $request->meta_title,
            'og_description' => $request->og_description ?: $request->meta_description,
        ]);

        return redirect()
            ->route('admin.collections.index')
            ->with(
                'success',
                'Collection created successfully.'
            );
    }

    public function edit($id)
    {
        $collection = Collection::findOrFail($id);

        return view(
            'admin.collections.edit',
            compact('collection')
        );
    }

    public function update(Request $request, $id)
    {
        $collection = Collection::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'h1_heading' => 'required|max:255',
            'meta_title' => 'required|max:255',
            'meta_description' => 'required',
            'slug' => 'nullable|max:255|unique:collections,slug,' . $collection->id,
            'canonical' => 'nullable|max:255',
            'og_title' => 'nullable|max:255',
            'og_description' => 'nullable',
            'image_alt' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $slug = $request->slug
            ? Str::slug($request->slug)
            : Str::slug($request->name);

        $imagePath = $collection->image;
        if ($request->hasFile('image')) {
            if ($collection->image) {
                Storage::disk('public')->delete($collection->image);
            }
            $imagePath = $request->file('image')->store('collections', 'public');
        }

        $collection->update([
            'name' => $request->name,
            'h1_heading' => $request->h1_heading,
            'slug' => $slug,
            'code' => $slug,
            'image' => $imagePath,
            'image_alt' => $request->image_alt ?: $request->name,
            'status' => $request->status ?? 1,
            'sort_order' => $request->sort_order ?? 0,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'canonical' => $request->canonical ?: $slug,
            'og_title' => $request->og_title ?: $request->meta_title,
            'og_description' => $request->og_description ?: $request->meta_description,
        ]);

        return redirect()
            ->route('admin.collections.index')
            ->with(
                'success',
                'Collection updated successfully.'
            );
    }

    public function destroy($id)
    {
        $collection = Collection::findOrFail($id);

        if ($collection->image) {
            Storage::disk('public')->delete($collection->image);
        }

        $collection->delete();

        return response()->json([
            'message' => 'Collection deleted successfully.'
        ]);
    }
}