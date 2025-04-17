<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserJobController extends Controller
{
    public function appliedjob() {
        return view('User.UserDash.AppliedJob');
    }
}
