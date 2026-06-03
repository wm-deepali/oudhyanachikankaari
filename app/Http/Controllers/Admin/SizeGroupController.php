<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SizeGroup;
use Illuminate\Http\Request;

class SizeGroupController extends Controller
{
    public function index(Request $request)
    {
        $query = SizeGroup::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->status !== '' && $request->status !== null) {
            $query->where('status', $request->status);
        }

        $sizeGroups = $query->latest()->paginate(20);

        return view('admin.size-groups.index', compact('sizeGroups'));
    }

    public function create()
    {
        return view('admin.size-groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:size_groups,name',
        ]);

        SizeGroup::create([
            'name' => $request->name,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.size-groups.index')
            ->with('success', 'Size Group created successfully.');
    }

    public function edit(SizeGroup $sizeGroup)
    {
        return view('admin.size-groups.edit', compact('sizeGroup'));
    }

    public function update(Request $request, SizeGroup $sizeGroup)
    {
        $request->validate([
            'name' => 'required|unique:size_groups,name,' . $sizeGroup->id,
        ]);

        $sizeGroup->update([
            'name' => $request->name,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.size-groups.index')
            ->with('success', 'Size Group updated successfully.');
    }

    public function destroy(SizeGroup $sizeGroup)
    {
        $sizeGroup->delete();

        return response()->json([
            'status' => true,
            'message' => 'Size Group deleted successfully.'
        ]);
    }
}