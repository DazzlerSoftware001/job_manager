<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomPage;
use App\Models\HomePageSettings;
use App\Models\JobPost;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\MaintenanceMode;

class HomeController extends Controller
{
    public function Home()
    {
        $HomeSection = HomePageSettings::first();

        $today = Carbon::today();

        $location = JobPost::select('location')->where('status', 1)->where('admin_verify', 1)->whereDate('jobexpiry', '>=', $today)->distinct()->get();
        $type        = JobPost::select('type', DB::raw('count(*) as count'))->where('status', 1)->where('admin_verify', 1)->whereDate('jobexpiry', '>=', $today)->groupBy('type')->get();
        return view('User.Home', compact('HomeSection','location','type'));
    }

    public function ViewPage($slug)
    {
        $page = CustomPage::where('slug', $slug)->firstOrFail();

        return view('user.CustomPage', compact('page'));
    }

    public function maintenanceMode() {
        $maintenance = MaintenanceMode::first();
        return view('User.MaintenanceMode', compact('maintenance'));
    }
}
