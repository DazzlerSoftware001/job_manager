<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobTypes;
use App\Models\JobMode;
use App\Models\JobSkill;
use App\Models\JobDepartment;
use App\Models\JobRole;
use App\Models\JobExperience;
use App\Models\JobSalary;
use App\Models\JobLocation;
use App\Models\JobCategory;
use App\Models\Companies;
use App\Models\JobIntType;


class JobController extends Controller
{
    public function jobpost() {
        $data['jobTypes'] = JobTypes::where('status', 1)->select('type','status')->get(); 
        $data['jobMode'] = JobMode::where('status', 1)->select('mode','status')->get(); 
        $data['jobSkill'] = JobSkill::where('status', 1)->select('skill','status')->get(); 
        $data['JobDepartment'] = JobDepartment::where('status', 1)->select('department','status')->get(); 
        $data['JobRole'] = JobRole::where('status', 1)->select('role','status')->get(); 
        $data['JobExperience'] = JobExperience::where('status', 1)->select('experience','status')->get(); 
        $data['JobLocation'] = JobLocation::where('status', 1)->select('country','city','status')->get(); 
        $data['JobCategory'] = JobCategory::where('status', 1)->select('name','status')->get(); 
        $data['Companies'] = Companies::where('status', 1)->select('id', 'name', 'details', 'status')->get(); 
        $data['JobIntType'] = JobIntType::where('status', 1)->select('id', 'int_type','status')->get();
        $data['JobSalary'] = JobSalary::where('status', 1)->select('id', 'salary', 'status')->get();
        // dd($data);
        return view('recruiter.Jobpost',$data);
    }

    public function postjobdata(Request $request) {
        dd($request->all());
    }
}
