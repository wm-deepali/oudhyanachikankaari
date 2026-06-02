<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use Illuminate\Http\Request;

class FooterSettingController extends Controller
{
    public function index()
    {
        $footer = FooterSetting::first();

        return view('admin.footer-settings.index', compact('footer'));
    }

    public function store(Request $request)
    {
        $footer = FooterSetting::first();

        if (!$footer) {
            $footer = new FooterSetting();
        }

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/footer'), $filename);

            $footer->logo = 'uploads/footer/'.$filename;
        }

        $footer->about_text = $request->about_text;
        $footer->address = $request->address;
        $footer->phone = $request->phone;
        $footer->whatsapp = $request->whatsapp;
        $footer->email = $request->email;
        $footer->email2 = $request->email2;
        $footer->facebook = $request->facebook;
        $footer->twitter = $request->twitter;
        $footer->linkedin = $request->linkedin;
        $footer->instagram = $request->instagram;
        $footer->status = 1;

        $footer->save();

        return back()->with('success', 'Footer settings updated successfully.');
    }
}