<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;

class JobController extends Controller
{
    public function JobList()
    {
        $jobs = JobPost::paginate(5);
        return view('User.JobList',compact('jobs'));
    }

    // public function getJobs(Request $request) {
    //     $query = JobPost::query();

    //     return response()->json($query);
    // }




}
