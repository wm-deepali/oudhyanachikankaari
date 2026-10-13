<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;

class HomeSliderController extends Controller
{
    public function index()
    {
        $sliders = HomeSlider::orderBy('sort_order')
            ->latest()
            ->paginate(10);

        return view('admin.home.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.home.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'mobile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'link' => ['nullable', 'url'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:0,1'],
        ]);

        $image = $this->compressAndStore(
            $request->file('image'),
            'home-sliders'
        );

        $mobileImage = null;

        if ($request->hasFile('mobile_image')) {
            $mobileImage = $this->compressAndStore(
                $request->file('mobile_image'),
                'home-sliders/mobile',
                1080
            );
        }

        HomeSlider::create([
            'image' => $image,
            'mobile_image' => $mobileImage,
            'link' => $request->link,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.home.sliders.index')
            ->with('success', 'Slider created successfully.');
    }

    public function edit($id)
    {
        $slider = HomeSlider::findOrFail($id);

        return view('admin.home.sliders.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'mobile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'link' => ['nullable', 'url'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:0,1'],
        ]);

        $slider = HomeSlider::findOrFail($id);

        $image = $slider->image;
        $mobileImage = $slider->mobile_image;

        if ($request->hasFile('image')) {
            $this->deleteFile($slider->image);

            $image = $this->compressAndStore(
                $request->file('image'),
                'home-sliders'
            );
        }

        if ($request->hasFile('mobile_image')) {
            $this->deleteFile($slider->mobile_image);

            $mobileImage = $this->compressAndStore(
                $request->file('mobile_image'),
                'home-sliders/mobile',
                1080
            );
        }

        $slider->update([
            'image' => $image,
            'mobile_image' => $mobileImage,
            'link' => $request->link,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.home.sliders.index')
            ->with('success', 'Slider updated successfully.');
    }

    public function destroy($id)
    {
        $slider = HomeSlider::findOrFail($id);

        $this->deleteFile($slider->image);
        $this->deleteFile($slider->mobile_image);

        $slider->delete();

        return response()->json([
            'message' => 'Slider deleted successfully.'
        ]);
    }

    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Compress & store an uploaded image as WebP.
     * Desktop sliders default to 1920px wide; mobile ones pass a smaller maxWidth.
     */
    private function compressAndStore(
        UploadedFile $file,
        string $folder,
        int $maxWidth = 1920,
        int $quality = 80
    ): string {
        $manager = ImageManager::usingDriver(Driver::class);

        $image = $manager->decode($file);

        // Only downscale, never upscale
        if ($image->width() > $maxWidth) {
            $image->scale(width: $maxWidth);
        }

        $encoded = $image->encodeUsingFormat(Format::WEBP, quality: $quality);

        $filename = Str::uuid() . '.webp';
        $path = trim($folder, '/') . '/' . $filename;

        Storage::disk('public')->put($path, (string) $encoded);

        return $path;
    }
}