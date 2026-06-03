<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fabric;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FabricController extends Controller
{
    public function index()
    {
        $fabrics = Fabric::latest()->paginate(20);

        return view('admin.fabrics.index', compact('fabrics'));
    }

    public function create()
    {
        return view('admin.fabrics.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:fabrics,name',
            'sort_order' => 'nullable|integer',
        ]);

        Fabric::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.fabrics.index')
            ->with('success', 'Fabric created successfully.');
    }

    public function edit(Fabric $fabric)
    {
        return view('admin.fabrics.edit', compact('fabric'));
    }

    public function update(Request $request, Fabric $fabric)
    {
        $request->validate([
            'name' => 'required|max:255|unique:fabrics,name,' . $fabric->id,
            'sort_order' => 'nullable|integer',
        ]);

        $fabric->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.fabrics.index')
            ->with('success', 'Fabric updated successfully.');
    }

    public function destroy(Fabric $fabric)
    {
        $fabric->delete();

        return redirect()
            ->route('admin.fabrics.index')
            ->with('success', 'Fabric deleted successfully.');
    }
}