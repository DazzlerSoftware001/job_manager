<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\HomePageSettings;
use App\Models\MaintenanceMode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

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
                $image->move(public_path('settings/logo/'), $imageName);
                $GeneralSetting->$dbColumn = 'settings/logo/' . $imageName;
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
            'message'     => 'Timezone updated successfully.',
        ]);
    }

    public function Maintenance()
    {
        $settings = MaintenanceMode::first();
        return view('admin.Settings.MaintenanceMode', compact('settings'));
    }

    public function ChangeMaintenanceStatus(Request $request)
    {

        $mode = MaintenanceMode::first();
        //  dd($mode);
        // dd($mode->maintenance);

        if (! $mode) {
            MaintenanceMode::create(['maintenance' => '1']);
            $message = 'Maintenance mode enabled.';
        } else {
            $mode->maintenance = $mode->maintenance ? '0' : '1';
            $mode->save();
            $message = $mode->maintenance ? 'Maintenance mode enabled.' : 'Maintenance mode disabled.';
        }

        $status = $request->status ? 1 : 0;

        $mode = MaintenanceMode::first();

        if (! $mode) {
            MaintenanceMode::create(['maintenance' => $status]);
        } else {
            $mode->maintenance = $status;
            $mode->save();
        }

        return response()->json([
            'status_code' => 1,
            'message'     => $message,
        ]);
    }

    public function saveMaintenanceSettings(Request $request)
    {
        $rules = [
            'title'              => 'required|string|max:255',
            'description'        => 'nullable|string',
            'additional_message' => 'nullable|string',
            'image'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 2,
                'message'     => $validator->errors()->first(),
            ]);
        }

        // Get existing or new instance
        $settings = MaintenanceMode::first() ?? new MaintenanceMode();

        $settings->title              = $request->title;
        $settings->description        = $request->description;
        $settings->additional_message = $request->additional_message;

        // Handle image
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            $oldPath = public_path($settings->image);
            if (! empty($settings->image) && file_exists($oldPath)) {
                @unlink($oldPath);
            }

            // Save new image
            $image     = $request->file('image');
            $imageName = time() . '_maintenance.' . $image->getClientOriginalExtension();
            $image->move(public_path('settings/maintenance/'), $imageName);

            $settings->image = 'settings/maintenance/' . $imageName;
        }

        $settings->save();

        return response()->json([
            'status_code' => 1,
            'message'     => 'Settings saved successfully!',
        ]);
    }

    public function clearCache()
    {
        try {
            $cacheCleared = Artisan::call('cache:clear');
            $viewCleared  = Artisan::call('view:clear');
            $routeCleared = Artisan::call('route:clear');

            // You can optionally check the exit code (0 means success)
            if ($cacheCleared === 0 && $viewCleared === 0 && $routeCleared === 0) {

                return response()->json(['status_code' => 1, 'message' => 'Cache, views, and routes cleared successfully']);
            } else {
                return response()->json(['status_code' => 0, 'Unable to Clear Cache']);
            }

        } catch (\Exception $e) {
            return response()->json(['status_code' => 0, 'message' => 'Unable to Clear Cache']);
        }
    }

    // Front Page Settings
    public function frontPageSettings()
    {
        return view('admin.Settings.FrontPageSettings');
    }

    public function homeSectionSettings()
    {
        $HomeSection = HomePageSettings::first();
        return view('admin.Settings.HomeSectionSettings', compact('HomeSection'));
    }

    public function submitHomeSection(Request $request)
    {
        $rules = [
            'banner_title'  => 'required|string|max:255',
            'banner_desc'   => 'required|string|max:500',
            'banner_filter' => 'required|max:255',
            'banner_image'  => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            // 'banner_image'  => 'image|mimes:png,svg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 2,
                'message'     => $validator->errors()->first(),
            ]);
        }

        $HomePageSettings = HomePageSettings::first() ?? new HomePageSettings();

        // Assign other fields
        $HomePageSettings->banner_title  = $request->banner_title;
        $HomePageSettings->banner_desc   = $request->banner_desc;
        $HomePageSettings->banner_filter = $request->banner_filter;

        // Handle image upload
        $inputName = 'banner_image';
        $dbColumn  = 'banner_image';

        if ($request->hasFile($inputName)) {
            // Delete old image
            $oldPath = public_path($HomePageSettings->$dbColumn);
            if (! empty($HomePageSettings->$dbColumn) && file_exists($oldPath)) {
                @unlink($oldPath); // Suppressed error handling, optional logging can be added
            }

            // Save new image
            $image     = $request->file($inputName);
            $imageName = time() . '_' . $inputName . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('settings/Banner/'), $imageName);
            $HomePageSettings->$dbColumn = 'settings/Banner/' . $imageName;
        }

        $HomePageSettings->save();

        return response()->json([
            'status_code' => 1,
            'message'     => 'Home section updated successfully!',
        ]);
    }

    public function newsSectionSettings () {
        return view('admin.Settings.NewsSectionSettings');
    }

}
