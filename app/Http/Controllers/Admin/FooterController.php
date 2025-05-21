<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FooterLogo;
use App\Models\FooterSetting;

class FooterController extends Controller
{
    public function footer() {

        $footerLogo = FooterLogo::first();
        $footer = FooterSetting::first();
        return view('admin.Settings.footer', compact('footerLogo','footer'));
    }


public function FooterProfilelogo(Request $request)
{
    // Validate inputs
    $request->validate([
        'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    ]);

    // Get or create the FooterLogo record (assuming only one)
    $FooterLogo = FooterLogo::first() ?? new FooterLogo();

    // Image handling
    foreach ([
        'image1' => 'logo',
        'image2' => 'light_logo',
        'image3' => 'dark_logo'
    ] as $inputName => $dbColumn) {

        if ($request->hasFile($inputName)) {
            // Delete the old image if it exists
            $oldPath = public_path($FooterLogo->$dbColumn);
            if (!empty($FooterLogo->$dbColumn) && file_exists($oldPath)) {
                if (!unlink($oldPath)) {
                    \Log::error("Failed to delete old image at: " . $oldPath);
                }
            }

            // Save the new image
            $image = $request->file($inputName);
            $imageName = time() . '_' . $inputName . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('settings/footer/logo/'), $imageName);
            $FooterLogo->$dbColumn = 'settings/footer/logo/' . $imageName;
        }
    }

    $FooterLogo->save();

    return response()->json([
        'status_code' => 1,
        'message' => 'Images uploaded successfully',
        'data' => [
            'logo' => $FooterLogo->logo,
            'light_logo' => $FooterLogo->light_logo,
            'dark_logo' => $FooterLogo->dark_logo,
        ],
    ]);
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
