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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

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
        $data['Companies'] = Companies::where('status', 1)->select('id', 'name', 'details','logo', 'status')->get(); 
        $data['JobIntType'] = JobIntType::where('status', 1)->select('id', 'int_type','status')->get();
        $data['JobCurrency'] = JobCurrency::where('status', 1)->select('id', 'currency', 'status')->get();
        $data['JobEducation'] = JobEducation::where('status', 1)->select('education_level','education', 'branch', 'status')->get();
        // $data['JobSalary'] = JobSalary::where('status', 1)->select('id', 'salary', 'status')->orderBy('salary', 'ASC')->get();

        $data['JobSalary'] = JobSalary::where('status', 1)
        ->orderByRaw('CAST(salary AS UNSIGNED) ASC') // Ensures numeric sorting
        ->get();
        // dd($data['JobEducation']);

        return view('recruiter.Jobpost',$data);
    }

    public function PostJobData(Request $request)
    {
        // dd($request->all());
  
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
            'max_experience' => 'required|string',
            'currency' => 'required|string',
            'min_salary' => 'required|integer',
            'max_salary' => 'required',
            'education' => 'required|string',
            'candidate_industry' => 'nullable|string',
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
                $JobPost->diversity = $request->input('diversity') ?? 'All';
                $JobPost->vacancies = $request->input('vacancies');
                $JobPost->int_type = $request->input('interview_type');
                $JobPost->com_name = $request->input('company_name');
                $JobPost->com_logo = $request->input('company_logo');
                $JobPost->com_details = $request->input('company_details');
                $JobPost->job_desc = $request->input('job_description');
                $JobPost->status = 0;
                $JobPost->created_at = now();

                $JobPost->save();

                return response()->json(['status_code' => 1, 'message' => 'Job Post added successfully']);
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

    public function JobList() {
        return view('recruiter.JobList');
    }

    public function getJobPost(Request $request)
    {
        // dd($request->all());
        $draw = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order = $request->input("order");
        $search = $request->input("search");
        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        );

        $query = JobPost::query();
        // Count Data

        if (!empty($search)) {
            $query->where('title', 'like', '%' . $search . '%');
        }
    
        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir = $order[0]['dir'];
            $query->orderBy($column, $dir);
        }

        $totalRecords = $query->count();

        $records = $query->offset($offset)->limit($limit)->orderBy('id', 'desc')->get();


        $data = [];
        foreach ($records as $record) {
            $dataArray = [];

            $dataArray[] = $record->id;
            $dataArray[] = ucfirst($record->title);

            $status = $record->status == 1
                ? '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
                : '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;


            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">

                                <div class="edit">
                                    <a href="' . route('Recruiter.ViewJobPost', ['id' => Crypt::encrypt($record->id)]) . '" class="edit-item-btn text-primary">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </div>

                                <div class="edit">
                                    <a href="' . route('Recruiter.EditJobPost', ['id' => Crypt::encrypt($record->id)]) . '" class="edit-item-btn text-primary">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </div>

                                <div class="remove">
                                    <a href="javascript:void(0);" class="remove-item-btn text-danger" onclick="deleteRecord(' . $record->id . ');">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>';

            $data[] = $dataArray;
        }

        return response()->json([
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
        ]);
    }

    public function changeJobPostStatus(Request $request)
    {
        $id = $request->input('id');
    
        if (!empty($id)) {
            // Find the record by ID
            $JobPost = JobPost::find($id);
    
           
            if ($JobPost) {
                // Toggle the status
                $JobPost->status = $JobPost->status == 1 ? 0 : 1;
    
                // Save the updated record
                if ($JobPost->save()) {
                    return response()->json(['status_code' => 1, 'message' => 'Status successfully changed']);
                } else {
                    return response()->json(['status_code' => 0, 'message' => 'Unable to change status']);
                }
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function deleteJobPost(Request $request)
    {
        $id = $request->input('id');
    
        if (!empty($id)) {
            // Attempt to find and delete the record
            $JobPost = JobPost::find($id);
    
            if ($JobPost) {
                $JobPost->delete();
                return response()->json(['status_code' => 1, 'message' => 'Job Post deleted successfully ']);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Job Post not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function viewJobPost($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $job = JobPost::findOrFail($decryptedId);
            return view('recruiter.job.ViewJob', compact('job'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid Job ID!');
        }
    }

    public function editJobPost($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $job = JobPost::findOrFail($decryptedId);
            return view('recruiter.EditJob', compact('job'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid Job ID!');
        }
    }
}
