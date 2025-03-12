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
use App\Models\JobCurrency;
use App\Models\JobSalary;
use App\Models\JobLocation;
use App\Models\JobCategory;
use App\Models\Companies;
use App\Models\JobIntType;
use App\Models\JobEducation;
use App\Models\JobPost;

use Illuminate\Support\Facades\Validator;

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
        $data['JobCurrency'] = JobCurrency::where('status', 1)->select('id', 'currency', 'status')->get();
        $data['JobEducation'] = JobEducation::where('status', 1)->select('education', 'status')->get();
        // $data['JobSalary'] = JobSalary::where('status', 1)->select('id', 'salary', 'status')->orderBy('salary', 'ASC')->get();

        $data['JobSalary'] = JobSalary::where('status', 1)
        ->orderByRaw('CAST(salary AS UNSIGNED) ASC') // Ensures numeric sorting
        ->get();

        return view('recruiter.Jobpost',$data);
    }

    public function PostJobData(Request $request)
    {
        // dd($request->skills);
  
        // Define validation rules
        $rules = [
            'job_title' => 'required|string|max:100|',
            'job_type' => 'required|string',
            'skills' => 'required',
            'industry' => 'required|string',
            'department' => 'required|string',
            'role' => 'required|string',
            'work_mode' => 'required|string',
            'location' => 'required|string',
            'min_experience' => 'required|integer',
            'max_experience' => 'required|integer',
            'currency' => 'required|string',
            'min_salary' => 'required|integer',
            'max_salary' => 'required|integer',
            'education' => 'required|string',
            'candidate_industry' => 'required|string',
            'diversity' => 'required|string',
            'vacancies' => 'required|integer',
            'interview_type' => 'required|string',
            'company_name' => 'required|string',
            'company_details' => 'required|string',
            'job_description'=> 'required|string',

        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            // try {
                $JobPost = new JobPost();
                $JobPost->title = $request->input('job_title');
                $JobPost->type = $request->input('job_type');
                // $JobPost->skills = $request->input('skills');
                $JobPost->skills = implode(',', $request->input('skills'));
                $JobPost->industry = $request->input('industry');
                $JobPost->department = $request->input('department');
                $JobPost->role = $request->input('role');
                $JobPost->mode = $request->input('work_mode');
                $JobPost->location = $request->input('location');
                $JobPost->min_exp = $request->input('min_experience');
                $JobPost->max_exp = $request->input('max_experience');
                $JobPost->currency = $request->input('currency');
                $JobPost->min_sal = $request->input('min_salary');
                $JobPost->max_sal = $request->input('max_salary');
                $JobPost->education = $request->input('education');
                $JobPost->condidate_industry = $request->input('candidate_industry');
                $JobPost->diversity = $request->input('diversity');
                $JobPost->vacancies = $request->input('vacancies');
                $JobPost->int_type = $request->input('interview_type');
                $JobPost->com_name = $request->input('company_name');
                $JobPost->com_details = $request->input('company_details');
                $JobPost->job_desc = $request->input('job_description');
                $JobPost->status = 0;
                $JobPost->created_at = now();

                $JobPost->save();

                return response()->json(['status_code' => 1, 'message' => 'Experience added successfully ']);
            // } catch (\Exception $e) {
            //     // Handle any exception that occurs during saving
            //     return response()->json(['status_code' => 0, 'message' => 'Unable to add Experience']);
            // }
        } else {
            // Return validation errors
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function getDepartment(Request $request) {

        if (!$request->has('category_name')) {
            return response()->json(['error' => 'Category Name is missing'], 400);
        }
        $JobDepartment = JobDepartment::where('category_name', $request->category_name)->select('department')->get();
    
        return response()->json($JobDepartment);

    }

    public function getRole(Request $request) {
        if (!$request->has('department_name')) {
            return response()->json(['error' => 'Department Name is missing'], 400);
        }
    
        $JobRole = JobRole::where('department_name', $request->department_name)
                            ->select('role')
                            ->get();
    
        return response()->json($JobRole);
    }
}
