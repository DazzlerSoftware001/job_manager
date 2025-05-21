<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FooterSetting;

class FooterController extends Controller
{
    public function footer() {

        $footer = FooterSetting::first();
        return view('admin.Settings.footer', compact('footer'));
    }

 public function FooterSettings(Request $request)
{
    $footer = FooterSetting::firstOrNew([]);

    // Validate basic inputs
    $request->validate([
        'description' => 'nullable|string',
        'address' => 'nullable|string',
        'phone' => 'nullable|string',
        'email' => 'nullable|email',
        'copyright' => 'nullable|string',
        'link_name' => 'array',
        'link_url' => 'array',
        'social_name' => 'array',
        'social_link' => 'array',
    ]);

    // Build links array
    $links = [];
    if ($request->link_name && $request->link_url) {
        foreach ($request->link_name as $i => $name) {
            if (!empty($name) && !empty($request->link_url[$i])) {
                $links[$name] = $request->link_url[$i];
            }
        }
    }

    // Build social_links array
    $social_links = [];
    if ($request->social_name && $request->social_link) {
        foreach ($request->social_name as $i => $name) {
            if (!empty($name) && !empty($request->social_link[$i])) {
                $social_links[$name] = $request->social_link[$i];
            }
        }
    }

    // Save all footer data
    $footer->description = $request->description;
    $footer->address = $request->address;
    $footer->phone = $request->phone;
    $footer->email = $request->email;
    $footer->copyright = $request->copyright;
    $footer->links = $links;
    $footer->social_links = $social_links;
    $footer->save();

    return redirect()->back()->with('success', 'Footer settings updated.');
}







}
