<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandSectionSetting;
use App\Models\GeneralSetting;
use App\Models\HomePageSettings;
use App\Models\MaintenanceMode;
use App\Models\NewsSectionSettings;
use App\Models\WorkProcessSectionSettings;
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

    public function homePageSettings()
    {
        $HomeSection                = HomePageSettings::first();
        $NewsSection                = NewsSectionSettings::first();
        $WorkProcessSectionSettings = WorkProcessSectionSettings::first();
        $BrandSectionSetting = BrandSectionSetting::first();

        return view('admin.Settings.HomeSectionSettings', compact('HomeSection', 'NewsSection', 'WorkProcessSectionSettings', 'BrandSectionSetting'));
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

    public function submitNewsSection(Request $request)
    {
        $data = $request->validate([
            'news_title'         => 'nullable|string|max:255',
            'news_message'       => 'nullable|string|max:255',
            'cards'              => 'nullable|array',
            'cards.*.date'       => 'nullable|string|max:255',
            'cards.*.author'     => 'nullable|string|max:255',
            'cards.*.title'      => 'nullable|string|max:255',
            'cards.*.link_text'  => 'nullable|string|max:255',
            'cards.*.image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cards.*.image_path' => 'nullable|string',
        ]);

        $newsSection = NewsSectionSettings::first() ?? new NewsSectionSettings();

        // Decode existing cards if any
        $existingCards = is_array($newsSection->cards) ? $newsSection->cards : [];

        $cards = [];

        if (! empty($request->cards)) {
            foreach ($request->cards as $index => $card) {
                $oldImagePath = $existingCards[$index]['image'] ?? null;

                $cardData = [
                    'date'      => $card['date'] ?? '',
                    'author'    => $card['author'] ?? '',
                    'title'     => $card['title'] ?? '',
                    'link_text' => $card['link_text'] ?? 'Read More',
                ];

                if (! empty($card['image'])) {
                    // Delete old image if a new one is uploaded
                    if ($oldImagePath && file_exists(public_path($oldImagePath))) {
                        @unlink(public_path($oldImagePath));
                    }

                    $image     = $card['image'];
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('settings/News/'), $imageName);
                    $cardData['image'] = 'settings/News/' . $imageName;

                } elseif (! empty($oldImagePath)) {
                    // Keep old image path
                    $cardData['image'] = $oldImagePath;

                } else {
                    // No image and no old image
                    $cardData['image'] = null;
                }

                $cards[] = $cardData;
            }
        }

        $newsSection->news_title   = $request->news_title;
        $newsSection->news_message = $request->news_message;
        $newsSection->cards        = $cards;
        $newsSection->save();

        return response()->json([
            'status_code' => 1,
            'message'     => 'News section saved successfully!',
        ]);
    }

    public function submitWorkProcessSection(Request $request)
    {
        $rules = [
            'section_title'       => 'required|string|max:255',
            'section_message'     => 'required|string|max:255',
            'cards'               => 'required|array',
            'cards.*.title'       => 'required|string|max:255',
            'cards.*.description' => 'required|string|max:255',
            'cards.*.icon'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 2,
                'message'     => $validator->errors()->first(),
            ]);
        }

        $section       = WorkProcessSectionSettings::first() ?? new WorkProcessSectionSettings();
        $existingCards = is_array($section->cards) ? $section->cards : [];

        $cards = [];

        foreach ($request->cards as $index => $card) {
            $oldImagePath = $existingCards[$index]['icon'] ?? null;

            $cardData = [
                'title'       => $card['title'] ?? '',
                'description' => $card['description'] ?? '',
                'button_text' => $card['button_text'] ?? 'Read More',
            ];

            if (isset($card['icon']) && is_object($card['icon'])) {
                // Delete old image
                if ($oldImagePath && file_exists(public_path($oldImagePath))) {
                    @unlink(public_path($oldImagePath));
                }

                $image     = $card['icon'];
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('settings/workProcess/'), $imageName);
                $cardData['icon'] = 'settings/workProcess/' . $imageName;
            } elseif (! empty($oldImagePath)) {
                $cardData['icon'] = $oldImagePath;
            } else {
                $cardData['icon'] = null;
            }

            $cards[] = $cardData;
        }

        $section->work_title   = $request->section_title;
        $section->work_message = $request->section_message;
        $section->cards        = $cards;
        $section->save();

        return response()->json([
            'status_code' => 1,
            'message'     => 'How Work Process Section saved successfully!',
        ]);
    }

    public function submitBrandSection(Request $request)
    {
        $rules = [
            'section_title' => 'nullable|string|max:255',
            'logos'         => 'nullable|array',
            'logos.*'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 2,
                'message'     => $validator->errors()->first(),
            ]);
        }

        $brandSection = BrandSectionSetting::first(); // Only one record expected

        $uploadedLogos = [];
        if ($request->hasFile('logos')) {
            foreach ($request->file('logos') as $file) {
                $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('settings/brands'), $name);
                $uploadedLogos[] = 'settings/brands/' . $name;
            }
        }

        if ($brandSection) {
            // Merge old logos with new ones
            $existingLogos = $brandSection->logos ?? [];
            $mergedLogos   = array_merge($existingLogos, $uploadedLogos);

            $brandSection->update([
                'title' => $request->section_title,
                'logos' => $mergedLogos,
            ]);
        } else {
            BrandSectionSetting::create([
                'title' => $request->section_title,
                'logos' => $uploadedLogos,
            ]);
        }

        return response()->json([
            'status_code' => 1,
            'message'     => 'Brand section updated successfully!',
        ]);
    }

    public function deleteBrandLogo(Request $request)
{
    $logoToDelete = $request->input('logo');

    $brandSection = BrandSectionSetting::first();

    if (!$brandSection || !is_array($brandSection->logos)) {
        return response()->json(['status_code' => 0, 'message' => 'No logos found.']);
    }

    $updatedLogos = array_filter($brandSection->logos, function ($logo) use ($logoToDelete) {
        return $logo !== $logoToDelete;
    });

    // Delete file from public directory
    $logoPath = public_path($logoToDelete);
    if (file_exists($logoPath)) {
        unlink($logoPath);
    }

    $brandSection->update(['logos' => array_values($updatedLogos)]); // re-index array

    return response()->json(['status_code' => 1, 'message' => 'Logo deleted successfully.']);
}

}
