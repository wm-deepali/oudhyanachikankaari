<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeoPage;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

class SeoController extends Controller
{
    public function index()
    {
        $pages = SeoPage::orderBy('id')->get();
        return view('admin.seo.index', compact('pages'));
    }

    public function update(Request $request, $id)
    {
        $page = SeoPage::findOrFail($id);

        $data = [
            'slug'              => $request->slug,
            'meta_title'        => $request->meta_title,
            'meta_description'  => $request->meta_description,
            'canonical_url'     => $request->canonical_url,
            'og_title'          => $request->og_title,
            'og_description'    => $request->og_description,
            'og_url'            => $request->og_url,
            'twitter_card'      => $request->twitter_card,
            'scripts'           => $request->scripts,
        ];

        if ($request->hasFile('og_image')) {
            $data['og_image'] = $this->storeSeoImage($request->file('og_image'), 'og');
        }

        if ($request->hasFile('twitter_image')) {
            $data['twitter_image'] = $this->storeSeoImage($request->file('twitter_image'), 'twitter');
        } elseif ($request->hasFile('og_image')) {
            // Twitter image OG image jaisa hi rakhna hai agar alag se nahi diya
            $data['twitter_image'] = $data['og_image'];
        }

        $page->update($data);

        return back()->with('success', 'SEO Updated Successfully');
    }

    private function storeSeoImage($file, string $prefix): string
    {
        // Same Intervention Image v4 -> WebP pattern jo Product images me use ho raha hai
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file)->scale(width: 1200);

        $filename = 'seo/' . $prefix . '_' . uniqid() . '.webp';
        Storage::disk('public')->put($filename, (string) $image->encode(new WebpEncoder(quality: 82)));

        return Storage::url($filename);
    }
    
}