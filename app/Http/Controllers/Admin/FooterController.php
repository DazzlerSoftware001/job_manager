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

        $data = $request->only([
            'description', 'address', 'phone', 'email', 'copyright'
        ]);

        $data['links'] = json_decode($request->input('links'), true);
        $data['social_links'] = json_decode($request->input('social_links'), true);

        $footer->fill($data)->save();

        return redirect()->back()->with('success', 'Footer settings updated.');
    }






}
