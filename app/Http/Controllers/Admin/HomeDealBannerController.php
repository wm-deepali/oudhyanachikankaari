<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeDealBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeDealBannerController extends Controller
{
    public function index()
    {
        $items = HomeDealBanner::latest()
            ->paginate(20);

        return view(
            'admin.home-deal-banners.index',
            compact('items')
        );
    }

    public function create()
    {
        return view(
            'admin.home-deal-banners.create'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'title' => 'nullable|string|max:255',
            'highlight_text' => 'nullable|string|max:255',
            'offer_text' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
        ]);

        $image = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image')
                ->store('deal-banners', 'public');
        }

        HomeDealBanner::create([
            'image' => $image,
            'title' => $request->title,
            'highlight_text' => $request->highlight_text,
            'offer_text' => $request->offer_text,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.home-deal-banners.index')
            ->with('success', 'Banner added successfully.');
    }

    public function edit($id)
    {
        $item = HomeDealBanner::findOrFail($id);

        return view(
            'admin.home-deal-banners.edit',
            compact('item')
        );
    }

    public function update(Request $request, $id)
    {
        $item = HomeDealBanner::findOrFail($id);

        $image = $item->image;

        if ($request->hasFile('image')) {

            if (
                $item->image &&
                Storage::disk('public')->exists($item->image)
            ) {
                Storage::disk('public')->delete($item->image);
            }

            $image = $request->file('image')
                ->store('deal-banners', 'public');
        }

        $item->update([
            'image' => $image,
            'title' => $request->title,
            'highlight_text' => $request->highlight_text,
            'offer_text' => $request->offer_text,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.home-deal-banners.index')
            ->with('success', 'Banner updated successfully.');
    }

    public function destroy($id)
    {
        $item = HomeDealBanner::findOrFail($id);

        if (
            $item->image &&
            Storage::disk('public')->exists($item->image)
        ) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return response()->json([
            'status' => true,
            'message' => 'Banner deleted successfully.'
        ]);
    }
}