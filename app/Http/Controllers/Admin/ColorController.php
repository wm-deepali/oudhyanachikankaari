<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ColorController extends Controller
{
    public function index(Request $request)
    {
        $query = Color::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->status !== null && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $colors = $query->latest()->paginate(20);

        return view('admin.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|max:255|unique:colors,name',
            'hex_code'   => 'nullable|max:20',
            'sort_order' => 'nullable|integer',
        ]);

        Color::create([
            'name'       => $request->name,
            'slug'       => $request->slug ?: Str::slug($request->name),
            'hex_code'   => $request->hex_code,
            'sort_order' => $request->sort_order ?? 0,
            'status'     => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.colors.index')
            ->with('success', 'Color created successfully.');
    }

    public function show(Color $color)
    {
        //
    }

    public function edit(Color $color)
    {
        return view('admin.colors.edit', compact('color'));
    }

    public function update(Request $request, Color $color)
    {
        $request->validate([
            'name'       => 'required|max:255|unique:colors,name,' . $color->id,
            'hex_code'   => 'nullable|max:20',
            'sort_order' => 'nullable|integer',
        ]);

        $color->update([
            'name'       => $request->name,
            'slug'       => $request->slug ?: Str::slug($request->name),
            'hex_code'   => $request->hex_code,
            'sort_order' => $request->sort_order ?? 0,
            'status'     => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.colors.index')
            ->with('success', 'Color updated successfully.');
    }

    public function destroy(Color $color)
    {
        try {

            $color->delete();

            if (request()->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Color deleted successfully.'
                ]);
            }

            return redirect()
                ->route('admin.colors.index')
                ->with('success', 'Color deleted successfully.');

        } catch (\Exception $e) {

            if (request()->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => $e->getMessage()
                ], 500);
            }

            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }
}