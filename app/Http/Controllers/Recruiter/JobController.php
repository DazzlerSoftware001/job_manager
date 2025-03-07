<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobTypes;
use App\Models\JobMode;
use App\Models\JobSkill;
use App\Models\JobRole;
use App\Models\JobExperience;
use App\Models\JobLocation;
use App\Models\JobCategory;
use App\Models\Companies;


class JobController extends Controller
{
    public function jobpost() {
        $data['jobTypes'] = JobTypes::where('status', 1)->select('type','status')->get(); 
        $data['jobMode'] = JobMode::where('status', 1)->select('mode','status')->get(); 
        $data['jobSkill'] = JobSkill::where('status', 1)->select('skill','status')->get(); 
        $data['JobRole'] = JobRole::where('status', 1)->select('role','status')->get(); 
        $data['JobExperience'] = JobExperience::where('status', 1)->select('experience','status')->get(); 
        $data['JobLocation'] = JobLocation::where('status', 1)->select('country','city','status')->get(); 
        $data['JobCategory'] = JobCategory::where('status', 1)->select('name','status')->get(); 
        $data['Companies'] = Companies::where('status', 1)->select('id', 'name','status')->first(); 
        // dd($data);
        return view('recruiter.Jobpost',$data);
    }

    public function postjobdata(Request $request) {
        dd($request->all());
    }
}
