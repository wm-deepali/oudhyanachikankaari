<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        $query = Collection::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->status !== null && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $collections = $query->latest()->paginate(20);

        return view('admin.collections.index', compact('collections'));
    }

    public function create()
    {
        return view('admin.collections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:collections,name',
            'sort_order' => 'nullable|integer',
        ]);

        Collection::create([
            'name' => $request->name,
            'slug' => $request->slug ?: Str::slug($request->name),
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Collection created successfully.');
    }

    public function edit(Collection $collection)
    {
        return view('admin.collections.edit', compact('collection'));
    }

    public function update(Request $request, Collection $collection)
    {
        $request->validate([
            'name' => 'required|max:255|unique:collections,name,' . $collection->id,
            'sort_order' => 'nullable|integer',
        ]);

        $collection->update([
            'name' => $request->name,
            'slug' => $request->slug ?: Str::slug($request->name),
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Collection updated successfully.');
    }

    public function destroy(Collection $collection)
    {
        $collection->delete();

        return response()->json([
            'status' => true,
            'message' => 'Collection deleted successfully.'
        ]);
    }
}