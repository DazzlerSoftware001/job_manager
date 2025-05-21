<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function generalSetting()
    {
        $GeneralSetting = GeneralSetting::first();
        return view('admin.Settings.GeneralSetting', compact('GeneralSetting'));
    }

    public function Profilelogo(Request $request)
    {
        // Validate inputs
        $request->validate([
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Get or create the GeneralSetting record (assuming only one)
        $GeneralSetting = GeneralSetting::first() ?? new GeneralSetting();

        // Image handling
        foreach ([
            'image1' => 'logo',
            'image2' => 'light_logo',
            'image3' => 'dark_logo',
        ] as $inputName => $dbColumn) {

            if ($request->hasFile($inputName)) {
                // Delete the old image if it exists
                $oldPath = public_path($GeneralSetting->$dbColumn);
                if (! empty($GeneralSetting->$dbColumn) && file_exists($oldPath)) {
                    if (! unlink($oldPath)) {
                        \Log::error("Failed to delete old image at: " . $oldPath);
                    }
                }

                // Save the new image
                $image     = $request->file($inputName);
                $imageName = time() . '_' . $inputName . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('settings/footer/logo/'), $imageName);
                $GeneralSetting->$dbColumn = 'settings/footer/logo/' . $imageName;
            }
        }

        $GeneralSetting->save();

        return response()->json([
            'status_code' => 1,
            'message'     => 'Images uploaded successfully',
            'data'        => [
                'logo'       => $GeneralSetting->logo,
                'light_logo' => $GeneralSetting->light_logo,
                'dark_logo'  => $GeneralSetting->dark_logo,
            ],
        ]);
    }

    public function SiteTitle(Request $request)
    {
        $request->validate([
            'site_title' => 'required|string|max:255',
        ]);

        $setting = GeneralSetting::first();
        if (! $setting) {
            $setting = new GeneralSetting();
        }

        $setting->site_title = $request->site_title;
        $setting->save();

        return response()->json([
            'status_code' => 1,
            'message'     => 'Site title updated successfully.',
        ]);
    }

    public function updateTimezone(Request $request)
    {
        $request->validate([
            'timezone' => 'required|in:' . implode(',', timezone_identifiers_list()),
        ]);

        $setting = GeneralSetting::first();
        if (! $setting) {
            $setting = new GeneralSetting();
        }

        $setting->timezone = $request->timezone;
        $setting->save();

        return response()->json([
            'status_code' => 1,
            'message'  => 'Timezone updated successfully.',
        ]);
    }

}
