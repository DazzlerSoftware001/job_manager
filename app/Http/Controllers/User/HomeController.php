<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomPage;

class HomeController extends Controller
{
    public function Home()
    {
        return view('User.Home');
    }

    public function ViewPage($slug)
    {
        $page = CustomPage::where('slug', $slug)->firstOrFail();

        return view('user.CustomPage', compact('page'));
    }
}
