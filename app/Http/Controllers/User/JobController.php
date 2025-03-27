<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;

class JobController extends Controller
{
    public function JobList()
    {
        $jobs = JobPost::where('status',1)->paginate(5);
        return view('User.JobList',compact('jobs'));
    }




}
