<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BrandSectionSetting;
use App\Models\CustomPage;
use App\Models\HomePageSettings;
use App\Models\JobPost;
use App\Models\MaintenanceMode;
use App\Models\NewsSectionSettings;
use App\Models\WhatWeAreSectionSettings;
use App\Models\WorkProcessSectionSettings;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function Home()
    {
        $HomeSection = HomePageSettings::first();

        $today = Carbon::today();

        $location = JobPost::select('location')->where('status', 1)->where('admin_verify', 1)->whereDate('jobexpiry', '>=', $today)->distinct()->get();
        $type     = JobPost::select('type', DB::raw('count(*) as count'))->where('status', 1)->where('admin_verify', 1)->whereDate('jobexpiry', '>=', $today)->groupBy('type')->get();

        $WorkProcessSectionSettings = WorkProcessSectionSettings::first();
        $BrandSectionSetting        = BrandSectionSetting::first();
        $WhatWeAreSectionSettings   = WhatWeAreSectionSettings::first();
        $NewsSection                = NewsSectionSettings::first();

        return view('User.Home', compact('HomeSection', 'location', 'type', 'WorkProcessSectionSettings', 'BrandSectionSetting', 'WhatWeAreSectionSettings', 'NewsSection'));
    }

    public function ViewPage($slug)
    {
        $page = CustomPage::where('slug', $slug)->firstOrFail();

        return view('user.CustomPage', compact('page'));
    }

    public function maintenanceMode()
    {
        $maintenance = MaintenanceMode::first();
        return view('User.MaintenanceMode', compact('maintenance'));
    }
}
