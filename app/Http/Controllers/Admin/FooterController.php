<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FooterLogo;

class FooterController extends Controller
{
    public function footer() {
        return view('admin.Settings.footer');
    }


public function FooterProfilelogo(Request $request)
{

    // Validate inputs (you can make them optional if needed)
    $request->validate([
        'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    ]);

    $paths = [];

    foreach (['image1', 'image2', 'image3'] as $imageField) {
        if ($request->hasFile($imageField)) {
            $imageFile = $request->file($imageField);
            $imageName = time() . '_' . $imageField . '.' . $imageFile->extension();
            $imageFile->move(public_path('settings/footer/logo/'), $imageName);
            $paths[$imageField] = 'settings/footer/logo/' . $imageName;
        }
    }

    // Save to user_images table
    $FooterLogo = new FooterLogo();
    $FooterLogo->logo = $paths['image1'] ?? null;
    $FooterLogo->loght_logo = $paths['image2'] ?? null;
    $FooterLogo->dark_logo = $paths['image3'] ?? null;
    $FooterLogo->save();

    return response()->json([
        'status_code' => 1,
        'message' => 'Images uploaded successfully',
        'data' => $paths,
    ]);
}




}
