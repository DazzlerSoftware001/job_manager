<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandSectionSetting;
use App\Models\EmailTemplates;
use App\Models\GeneralSetting;
use App\Models\HomePageSettings;
use App\Models\MailSetting;
use App\Models\MaintenanceMode;
use App\Models\NewsSectionSettings;
use App\Models\WhatWeAreSectionSettings;
use App\Models\WorkProcessSectionSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Crypt;
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
            // 'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Get or create the GeneralSetting record (assuming only one)
        $GeneralSetting = GeneralSetting::first() ?? new GeneralSetting();

        // Image handling
        foreach ([
            'image1' => 'logo',
            'image2' => 'light_logo',
            // 'image3' => 'dark_logo',
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
                // 'dark_logo'  => $GeneralSetting->dark_logo,
            ],
        ]);
    }

    public function favicon(Request $request)
    {
        // Define input and DB column name
        $inputName = 'favicon';
        $dbColumn  = 'favicon'; // Ensure this column exists in your GeneralSetting table

        // Validate inputs
        $request->validate([
            $inputName => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Get or create the GeneralSetting record (assuming only one row)
        $GeneralSetting = GeneralSetting::first() ?? new GeneralSetting();

        // Handle favicon upload
        if ($request->hasFile($inputName)) {
            // Delete the old favicon if it exists
            $oldPath = public_path($GeneralSetting->$dbColumn);
            if (! empty($GeneralSetting->$dbColumn) && file_exists($oldPath)) {
                if (! unlink($oldPath)) {
                    \Log::error("Failed to delete old favicon at: " . $oldPath);
                }
            }

            // Save the new favicon
            $image     = $request->file($inputName);
            $imageName = time() . '_' . $inputName . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('settings/favicon/'), $imageName);
            $GeneralSetting->$dbColumn = 'settings/favicon/' . $imageName;
        }

        $GeneralSetting->save();

        return response()->json([
            'status_code' => 1,
            'message'     => 'Favicon uploaded successfully',
            'data'        => [
                'favicon' => $GeneralSetting->$dbColumn,
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

    public function EmailSetting()
    {
        $mailSetting = MailSetting::first();
        return view('admin.Settings.EmailSetting', compact('mailSetting'));

    }

    // public function UpdateEmailSetting(Request $request)
    // {
    //     $rules = [
    //         'mail_mailer'        => 'nullable|string',
    //         'mail_host'          => 'nullable|string',
    //         'mail_port'          => 'nullable|integer',
    //         'mail_username'      => 'nullable|string',
    //         'mail_password'      => 'nullable|string',
    //         'mail_encryption'    => 'nullable|string',
    //         'mail_from_address'  => 'nullable|email',
    //         'mail_from_name'     => 'nullable|string',
    //     ];

    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status_code' => 0,
    //             'message' => 'Validation failed',
    //             'errors' => $validator->errors()
    //         ]);
    //     }

    //     $data = $validator->validated();

    //     $MailSetting = MailSetting::first();

    //     if (!$MailSetting) {
    //         $MailSetting = new MailSetting();
    //         $MailSetting->fill($data);
    //         $MailSetting->created_at = now();
    //         $action = 'saved';
    //     } else {
    //         $MailSetting->fill($data);
    //         $MailSetting->updated_at = now();
    //         $action = 'updated';
    //     }

    //     if ($MailSetting->save()) {
    //         return response()->json([
    //             'status_code' => 1,
    //             'message' => "Mail setting $action successfully"
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status_code' => 0,
    //             'message' => "Unable to $action mail setting"
    //         ]);
    //     }
    // }

    public function UpdateEmailSetting(Request $request)
    {
        $rules = [
            'mail_mailer'       => 'nullable|string',
            'mail_host'         => 'nullable|string',
            'mail_port'         => 'nullable|integer',
            'mail_username'     => 'nullable|string',
            'mail_password'     => 'nullable|string',
            'mail_encryption'   => 'nullable|string',
            'mail_from_address' => 'nullable|email',
            'mail_from_name'    => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 0,
                'message'     => 'Validation failed',
                'errors'      => $validator->errors(),
            ]);
        }

        $data = $validator->validated();

        // Encrypt mail_password if present
        if (! empty($data['mail_password'])) {
            $data['mail_password'] = Crypt::encryptString($data['mail_password']);
        }

        $MailSetting = MailSetting::first();

        if (! $MailSetting) {
            $MailSetting = new MailSetting();
            $MailSetting->fill($data);
            $MailSetting->created_at = now();
            $action                  = 'saved';
        } else {
            $MailSetting->fill($data);
            $MailSetting->updated_at = now();
            $action                  = 'updated';
        }

        if ($MailSetting->save()) {
            return response()->json([
                'status_code' => 1,
                'message'     => "Mail setting $action successfully",
            ]);
        } else {
            return response()->json([
                'status_code' => 0,
                'message'     => "Unable to $action mail setting",
            ]);
        }
    }

    public function EmailTemplates()
    {
        return view('admin.Settings.EmailTemplates');
    }

    public function getEmailTemplates(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'slug',
            2 => 'subject',
            3 => 'created_at',
            4 => 'id',
        ];

        // $query = Recruiter::query()->where('user_type', 2);
        $query = EmailTemplates::query();
        // dd($query);

        // Count Data
        if (! empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('slug', 'like', '%' . $search . '%')
                    ->orWhere('subject', 'like', '%' . $search . '%');
            });
        }

        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir    = $order[0]['dir'];
            $query->orderBy($column, $dir);
        }

        $totalRecords = $query->count();

        $records = $query->offset($offset)->limit($limit)->orderBy('id', 'desc')->get();

        $data = [];
        foreach ($records as $record) {
            $dataArray = [];

            $dataArray[] = $record->id;
            $dataArray[] = $record->name;
            $dataArray[] = '<label class="switch">
                                <input type="checkbox" class="status-toggle" ' . ($record->show_email ? 'checked' : '') . ' data-id="' . $record->id . '">
                                <span class="slider round"></span>
                            </label>';

            $dataArray[] = ucfirst($record->subject);

            $dataArray[] = date('d M Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
                                <div class="edit">
                                    <a href="' . route('Admin.EditEmailTemplates', ['id' => Crypt::encrypt($record->id)]) . '" class="edit-item-btn text-primary">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </div>
                            </div>';

            $data[] = $dataArray;
        }

        return response()->json([
            "draw"            => $draw,
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data"            => $data,
        ]);
    }

    public function sendEmail(Request $request) {
        $id = $request->id;

        $EmailTemplates = EmailTemplates::where('id', $id)->first();

        if (! $EmailTemplates) {
            EmailTemplates::create(['show_email' => '1']);
            $message = 'Maintenance mode enabled.';
        } else {
            $EmailTemplates->show_email = $EmailTemplates->show_email ? '0' : '1';
            $EmailTemplates->save();
            $message = $EmailTemplates->show_email ? 'Send Mail enabled.' : 'Send Mail disabled.';
        }

        // $status = $request->status ? 1 : 0;

        // $EmailTemplates = EmailTemplates::where('id', $id)->first();

        // if (! $EmailTemplates) {
        //     EmailTemplates::create(['show_email' => $status]);
        // } else {
        //     $EmailTemplates->show_email = $status;
        //     $EmailTemplates->save();
        // }

        return response()->json([
            'status_code' => 1,
            'message'     => $message,
        ]);

    }

    public function editEmailTemplates($id)
    {
        try {
            $decryptedId    = Crypt::decrypt($id);
            $EmailTemplates = EmailTemplates::findOrFail($decryptedId);
            return view('admin.Settings.EditEmailTemplates', compact('EmailTemplates'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid Job ID!');
        }
    }

    public function updateEmailTemplate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'edit-id'     => 'required',
            'subject'     => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 0,
                'message' => $validator->errors()->first(),
            ]);
        }

        $template = EmailTemplates::find($request->input('edit-id'));

        $template->subject = $request->input('subject');
        $template->body    = $request->input('description');

        if ($template->save()) {
            return response()->json([
                'status'  => 1,
                'message' => 'Email template updated successfully.',
            ]);
        } else {
            return response()->json([
                'status'  => 0,
                'message' => 'Failed to update template.',
            ]);
        }
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
        $BrandSectionSetting        = BrandSectionSetting::first();
        $WhatWeAreSectionSettings   = WhatWeAreSectionSettings::first();

        return view('admin.Settings.HomeSectionSettings', compact('HomeSection', 'NewsSection', 'WorkProcessSectionSettings', 'BrandSectionSetting', 'WhatWeAreSectionSettings'));
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

    public function showingWorkProcessSection(Request $request)
    {
        $status = $request->status ? '1' : '0';

        $mode = WorkProcessSectionSettings::first();

        if (! $mode) {
            WorkProcessSectionSettings::create(['show_section' => $status]);
        } else {
            $mode->show_section = $status;
            $mode->save();
        }

        $message = $status ? 'Section is now visible.' : 'Section is now hidden.';

        return response()->json([
            'status_code' => 1,
            'message'     => $message,
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

    public function showingBrandSection(Request $request)
    {
        $status = $request->status ? '1' : '0';

        $mode = BrandSectionSetting::first();

        if (! $mode) {
            BrandSectionSetting::create(['show_section' => $status]);
        } else {
            $mode->show_section = $status;
            $mode->save();
        }

        $message = $status ? 'Section is now visible.' : 'Section is now hidden.';

        return response()->json([
            'status_code' => 1,
            'message'     => $message,
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

        if (! $brandSection || ! is_array($brandSection->logos)) {
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

    public function showingWhatWeAreSection(Request $request)
    {
        $status = $request->status ? '1' : '0';

        $mode = WhatWeAreSectionSettings::first();

        if (! $mode) {
            WhatWeAreSectionSettings::create(['show_section' => $status]);
        } else {
            $mode->show_section = $status;
            $mode->save();
        }

        $message = $status ? 'Section is now visible.' : 'Section is now hidden.';

        return response()->json([
            'status_code' => 1,
            'message'     => $message,
        ]);
    }

    public function submitWhatWeAreSection(Request $request)
    {
        $rules = [
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'points'      => 'nullable|array|min:1',
            'points.*'    => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 2,
                'message'     => $validator->errors()->first(),
            ]);
        }

        // Get existing record or create new
        $data = WhatWeAreSectionSettings::first();
        if (! $data) {
            $data = new WhatWeAreSectionSettings();
        }

        // Custom image upload logic
        if ($request->hasFile('image')) {
            $oldPath = public_path($data->image);
            if (! empty($data->image) && file_exists($oldPath)) {
                @unlink($oldPath); // Delete old image if exists
            }

            $uploadedImage = $request->file('image');
            $imageName     = time() . '_what_we_are.' . $uploadedImage->getClientOriginalExtension();
            $uploadPath    = 'settings/WhatWeAre/';
            $uploadedImage->move(public_path($uploadPath), $imageName);

            $data->section_image = $uploadPath . $imageName; // Save path in DB
        }

        // Save other fields
        $data->title       = $request->title;
        $data->description = $request->description;
        $data->points      = $request->points; // stored as JSON
        $data->button_text = $request->button_text;
        $data->save();

        return response()->json([
            'status_code' => 1,
            'message'     => 'Section updated successfully!',
        ]);
    }

    public function showingNewsSection(Request $request)
    {
        $status = $request->status ? '1' : '0';

        $mode = NewsSectionSettings::first();

        if (! $mode) {
            NewsSectionSettings::create(['show_section' => $status]);
        } else {
            $mode->show_section = $status;
            $mode->save();
        }

        $message = $status ? 'Section is now visible.' : 'Section is now hidden.';

        return response()->json([
            'status_code' => 1,
            'message'     => $message,
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

}
