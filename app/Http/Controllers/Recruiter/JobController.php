<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobTypes;


class JobController extends Controller
{
    public function jobpost() {
        $data['jobTypes'] = JobTypes::where('status', 1)->select('type','status')->get(); 
        // dd($data);
        return view('recruiter.Jobpost',$data);
    }
}
