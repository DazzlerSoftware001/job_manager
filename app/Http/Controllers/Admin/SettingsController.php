<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
   public function footer() {
    dd('dff');
    return view('admin.Settings.footer');
   }
}
