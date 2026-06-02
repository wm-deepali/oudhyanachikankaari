<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeHero;
use Illuminate\Support\Facades\Storage;

class HomeHeroController extends Controller
{
    // Show form
    public function edit()
    {
        $hero = HomeHero::first();
        return view('admin.home.hero', compact('hero'));
    }

    // Update data
    public function update(Request $request)
    {
        $request->validate([
            'trusted_text' => 'nullable|string',
            'title_black_1' => 'required',
            'title_gradient' => 'required',
            'title_black_2' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $hero = HomeHero::first() ?? new HomeHero();

        if ($request->hasFile('image')) {
            if ($hero->image) {
                Storage::disk('public')->delete($hero->image);
            }
            
            $path = $request->file('image')->store('home', 'public');
            $hero->image = $path;

        }

        $hero->trusted_text = $request->trusted_text;
        $hero->title_black_1 = $request->title_black_1;
        $hero->title_gradient = $request->title_gradient;
        $hero->title_black_2 = $request->title_black_2;
        $hero->description = $request->description;

        $hero->save();

        return back()->with('success', 'Hero updated successfully');
    }
}
