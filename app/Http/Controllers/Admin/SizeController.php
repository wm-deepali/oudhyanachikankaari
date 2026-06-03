<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use App\Models\SizeGroup;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index(Request $request)
    {
        $query = Size::with('sizeGroup');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $sizes = $query->latest()->paginate(20);

        return view('admin.sizes.index', compact('sizes'));
    }

    public function create()
    {
        $sizeGroups = SizeGroup::where('status',1)
            ->orderBy('name')
            ->get();

        return view('admin.sizes.create', compact('sizeGroups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'size_group_id' => 'required|exists:size_groups,id',
            'name' => 'required|max:50',
        ]);

        Size::create([
            'size_group_id' => $request->size_group_id,
            'name' => $request->name,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.sizes.index')
            ->with('success', 'Size created successfully.');
    }

    public function edit(Size $size)
    {
        $sizeGroups = SizeGroup::where('status',1)
            ->orderBy('name')
            ->get();

        return view('admin.sizes.edit', compact('size','sizeGroups'));
    }

    public function update(Request $request, Size $size)
    {
        $request->validate([
            'size_group_id' => 'required|exists:size_groups,id',
            'name' => 'required|max:50',
        ]);

        $size->update([
            'size_group_id' => $request->size_group_id,
            'name' => $request->name,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.sizes.index')
            ->with('success', 'Size updated successfully.');
    }

    public function destroy(Size $size)
    {
        $size->delete();

        return response()->json([
            'status' => true,
            'message' => 'Size deleted successfully.'
        ]);
    }
}