<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomPage;
use App\Models\HomePageSettings;

class HomeController extends Controller
{
    public function Home()
    {
        $HomeSection = HomePageSettings::first();
        return view('User.Home', compact('HomeSection'));
    }

    public function ViewPage($slug)
    {
        $page = CustomPage::where('slug', $slug)->firstOrFail();

        return view('user.CustomPage', compact('page'));
    }

    public function maintenanceMode() {
        return view('User.MaintenanceMode');
    }
}
