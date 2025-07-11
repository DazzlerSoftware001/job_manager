<?php
namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Mail\Recruiter\CandidateHire;
use App\Mail\Recruiter\CandidateReject;
use App\Mail\Recruiter\CandidateShortlist;
use App\Mail\Recruiter\JobPostedMail;
use App\Mail\Recruiter\JobPostedMailToAdmin;
use App\Mail\Recruiter\JobStatusChangedMail;
use App\Mail\Recruiter\JobStatusChangedMailToAdmin;
use App\Mail\Recruiter\JobUpdatedMail;
use App\Mail\Recruiter\JobUpdatedMailToAdmin;
use App\Models\Companies;
use App\Models\EmailTemplates;
use App\Models\JobApplication;
use App\Models\JobCategory;
use App\Models\JobCurrency;
use App\Models\JobDepartment;
use App\Models\JobEducation;
use App\Models\JobExperience;
use App\Models\JobIntType;
use App\Models\JobLocation;
use App\Models\JobMode;
use App\Models\JobPost;
use App\Models\JobRole;
use App\Models\JobSalary;
use App\Models\JobSkill;
use App\Models\JobTypes;
use App\Models\Recruiter;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Notification;
use App\Notifications\JobPostedByRecruiter;
use App\Notifications\JobUpdatedByRecruiter;
use App\Notifications\CandidateHireNotify;
use App\Notifications\CandidateRejectNotify;
use App\Notifications\CandidateShortListNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function jobpost()
    {
        $data['jobTypes']      = JobTypes::where('status', 1)->select('type', 'status')->get();
        $data['jobMode']       = JobMode::where('status', 1)->select('mode', 'status')->get();
        $data['jobSkill']      = JobSkill::where('status', 1)->select('skill', 'status')->get();
        $data['JobDepartment'] = JobDepartment::where('status', 1)->select('department', 'status')->get();
        $data['JobRole']       = JobRole::where('status', 1)->select('role', 'status')->get();
        $data['JobExperience'] = JobExperience::where('status', 1)->select('experience', 'status')->get();
        $data['JobLocation']   = JobLocation::where('status', 1)->select('country', 'city', 'status')->get();
        $data['JobCategory']   = JobCategory::where('status', 1)->select('name', 'status')->get();
        $data['Companies']     = Companies::where('status', 1)->select('id', 'name', 'details', 'logo', 'status')->get();
        $data['JobIntType']    = JobIntType::where('status', 1)->select('id', 'int_type', 'status')->get();
        $data['JobCurrency']   = JobCurrency::where('status', 1)->select('id', 'currency', 'status')->get();
        $data['JobEducation']  = JobEducation::where('status', 1)->select('education_level', 'education', 'branch', 'status')->get();
        // $data['JobSalary'] = JobSalary::where('status', 1)->select('id', 'salary', 'status')->orderBy('salary', 'ASC')->get();

        $data['JobSalary'] = JobSalary::where('status', 1)
            ->orderByRaw('CAST(salary AS UNSIGNED) ASC') // Ensures numeric sorting
            ->get();
        // dd($data['JobEducation']);

        return view('recruiter.job.Jobpost', $data);
    }

    public function PostJobData(Request $request)
    {
        // dd($request->input('company_logo'));

        // Define validation rules
        $rules = [
            'job_title'          => 'required|string|max:100|',
            'job_type'           => 'required|string',
            'skills'             => 'required',
            'industry'           => 'required|string',
            'department'         => 'required|string',
            'role'               => 'required|string',
            'work_mode'          => 'required|string',
            'location'           => 'required|string',
            'min_experience'     => 'required|integer',
            'max_experience'     => 'required|string',
            'currency'           => 'required|string',
            'min_salary'         => 'required|integer',
            'max_salary'         => 'required',
            'education_level'    => 'required|string',
            'education'          => 'required|string',
            'branch'             => 'nullable',
            'candidate_industry' => 'nullable|string',
            'vacancies'          => 'required|integer',
            'interview_type'     => 'required|string',
            'company_name'       => 'required|string',
            'company_details'    => 'required|string',
            'jobExp'             => 'required|date',
            'job_description'    => 'required|string',
            'job_resp'           => 'required|string',
            'job_req'            => 'required|string',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            // try {
            $recruiter_id = Auth::user()->id;
            $JobPost      = new JobPost();

            $JobPost->recruiter_id = $recruiter_id;
            $JobPost->title        = $request->input('job_title');
            $JobPost->type         = $request->input('job_type');
            // $JobPost->skills = $request->input('skills');
            $JobPost->skills          = implode(',', $request->input('skills'));
            $JobPost->industry        = $request->input('industry');
            $JobPost->department      = $request->input('department');
            $JobPost->role            = $request->input('role');
            $JobPost->mode            = $request->input('work_mode');
            $JobPost->location        = $request->input('location');
            $JobPost->min_exp         = $request->input('min_experience');
            $JobPost->max_exp         = $request->input('max_experience');
            $JobPost->currency        = $request->input('currency');
            $JobPost->min_sal         = $request->input('min_salary');
            $JobPost->max_sal         = $request->input('max_salary');
            $JobPost->sal_status      = $request->input('sal_status') ?? 'off';
            $JobPost->education_level = $request->input('education_level');
            $JobPost->education       = $request->input('education');
            // $JobPost->branch = implode(',', $request->input('branch',[]));
            $JobPost->branch             = implode(',', (array) $request->input('branch'));
            $JobPost->condidate_industry = $request->input('candidate_industry');
            $JobPost->diversity          = $request->input('diversity') ?? 'All';
            $JobPost->vacancies          = $request->input('vacancies');
            $JobPost->int_type           = $request->input('interview_type');
            $JobPost->com_name           = $request->input('company_name');
            $JobPost->com_logo           = $request->input('company_logo');
            $JobPost->com_details        = $request->input('company_details');
            $JobPost->jobexpiry          = $request->input('jobExp');
            $JobPost->job_desc           = $request->input('job_description');
            $JobPost->job_resp           = $request->input('job_resp');
            $JobPost->job_req            = $request->input('job_req');
            $JobPost->status             = 0;
            $JobPost->admin_verify       = 0;
            $JobPost->created_at         = now();

            // dd($JobPost);

            $JobPost->save();
            // Mail::to(Auth::user()->email)->send(new JobPostedMail($JobPost));

            $recruiterName = Auth::user()->name . ' ' . Auth::user()->lname;

            $templateRecruiter = EmailTemplates::find(14);
            if ($templateRecruiter && $templateRecruiter->show_email == '1') {
                Mail::to(Auth::user()->email)->send(new JobPostedMail($JobPost, $recruiterName));
            }

            $templateAdmin = EmailTemplates::find(15);
            if ($templateAdmin && $templateAdmin->show_email == '1') {
                $admin = UserProfile::where('user_type', 1)
                    ->where('user_details', 'Admin')
                    ->select('name', 'lname', 'email')
                    ->first();
                if ($admin) {
                    Mail::to($admin->email)->send(new JobPostedMailToAdmin($JobPost, $recruiterName));
                }
            }

            // confirmation mail to admin

            $adminProfile = UserProfile::where('user_type', 1)->where('user_details', 'Admin')->first();

            if ($adminProfile) {
                $adminProfile->notify(new JobPostedByRecruiter($JobPost, $recruiterName));
            }

            $message = (($templateRecruiter && $templateRecruiter->show_email == '1') || ($templateAdmin && $templateAdmin->show_email == '1')) ?
            'Job Posted and Email successfully wait for admin action.' :
            'Job Posted successfully wait for admin action.';

            return response()->json(['status_code' => 1, 'message' => $message]);
            // } catch (\Exception $e) {
            // Handle any exception that occurs during saving
            return response()->json(['status_code' => 0, 'message' => 'Unable to post job']);
            // }
        } else {
            // Return validation errors
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function getDepartment(Request $request)
    {

        if (! $request->has('category_name')) {
            return response()->json(['error' => 'Category Name is missing'], 400);
        }
        $JobDepartment = JobDepartment::where('category_name', $request->category_name)->select('department')->get();

        return response()->json($JobDepartment);

    }

    public function getRole(Request $request)
    {
        if (! $request->has('department_name')) {
            return response()->json(['error' => 'Department Name is missing'], 400);
        }

        $JobRole = JobRole::where('department_name', $request->department_name)
            ->select('role')
            ->get();

        return response()->json($JobRole);
    }

    public function getEducation(Request $request)
    {
        if (! $request->has('education_level')) {
            return response()->json(['error' => 'Education Level is missing'], 400);
        }

        $JobEducation = JobEducation::where('education_level', $request->education_level)
            ->select('education')
            ->distinct()
            ->get();

        return response()->json($JobEducation);
    }

    // Fetch Branches based on Selected Qualification
    public function getBranch(Request $request)
    {
        if (! $request->has('education')) {
            return response()->json(['error' => 'Education Name is missing'], 400);
        }

        $JobEducation = JobEducation::where('education', $request->education)
            ->whereNotNull('branch')
            ->select('branch')
            ->distinct()
            ->get();

        return response()->json($JobEducation);
    }

    // fetch job list
    public function JobList()
    {
        return view('recruiter.job.JobList');
    }

    public function getJobPost(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'title',
            2 => 'admin_verify',
            2 => 'status',
            3 => 'created_at',
            4 => 'jobexpiry',
            5 => 'id',
        ];

                                                            // $query = JobPost::query();
                                                            // $query = JobPost::withCount('applications');
        $query = JobPost::where('recruiter_id', Auth::id()) // or Auth::user()->id
            ->withCount('applications');

        // Count Data

        if (! empty($search)) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir    = $order[0]['dir'];
            $query->orderBy($column, $dir);
        }

        $totalRecords = $query->count();

        $records = $query->offset($offset)->limit($limit)->orderBy('id', 'desc')->get();

        $data = [];
        foreach ($records as $record) {
            $dataArray = [];

            $dataArray[] = $record->id;
            $dataArray[] = ucfirst($record->title);

            $admin_verify = '<div class="d-flex">
                    <span
                        class="badge ' . ($record->admin_verify == 1 ? 'bg-success' : ($record->admin_verify == 0 ? 'bg-warning' : 'bg-danger')) . ' text-uppercase">
                        ' . ($record->admin_verify == 1 ? 'Verified' : ($record->admin_verify == 0 ? 'Pending' : 'Rejected')) . '
                    </span>
                </div>';
            $dataArray[] = $admin_verify;

            $status = $record->status == 1
            ? '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));
            $dataArray[] = '<span style="color: red;">' . date('d-M-Y', strtotime($record->jobexpiry)) . '</span>';
            // $dataArray[] = '<span class="badge bg-warning">' . $record->applications_count . ' Applied</span>';
            $dataArray[] = '<a href="' . route('Recruiter.AllApplicants', ['job_id' => Crypt::encrypt($record->id)]) . '" class="badge bg-warning text-decoration-none" style="cursor: pointer;">' . $record->applications_count . ' Applied</a>';

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
            "draw"            => $draw,
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data"            => $data,
        ]);
    }

    public function changeJobPostStatus(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID
            $JobPost = JobPost::find($id);

            if ($JobPost) {
                // Toggle the status
                $JobPost->status = $JobPost->status == 1 ? 0 : 1;

                // Save the updated record
                if ($JobPost->save()) {

                    $recruiterName = Auth::user()->name . ' ' . Auth::user()->lname;

                    // Send mail to recruiter
                    $templateRecruiter = EmailTemplates::find(19);
                    if ($templateRecruiter && $templateRecruiter->show_email == '1') {
                        Mail::to(Auth::user()->email)->send(new JobStatusChangedMail($JobPost, $recruiterName));
                    }

                    // Send mail to admin
                    $adminMail     = UserProfile::where('user_type', 1)->where('user_details', 'Admin')->select('name', 'lname', 'email')->first();
                    $templateAdmin = EmailTemplates::find(16);
                    if ($templateAdmin && $templateAdmin->show_email == '1') {
                        if ($adminMail) {
                            Mail::to($adminMail->email)->send(new JobStatusChangedMailToAdmin($JobPost, $recruiterName));
                        }
                    }

                    $message = (($templateRecruiter && $templateRecruiter->show_email == '1') || ($templateAdmin && $templateAdmin->show_email == '1')) ?
                    'Status Changed and Email sent successfully.' :
                    'Status Changed Successfully.';

                    return response()->json(['status_code' => 1, 'message' => $message]);

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

        if (! empty($id)) {
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
            $job         = JobPost::findOrFail($decryptedId);
            $Recruiter   = Recruiter::where('id', $job->recruiter_id)->first();
            return view('recruiter.job.ViewJob', compact('job', 'Recruiter'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid Job ID!');
        }
    }

    public function editJobPost($id)
    {
        try {

            $data['jobTypes']      = JobTypes::where('status', 1)->select('type', 'status')->get();
            $data['jobMode']       = JobMode::where('status', 1)->select('mode', 'status')->get();
            $data['jobSkill']      = JobSkill::where('status', 1)->select('skill', 'status')->get();
            $data['JobDepartment'] = JobDepartment::where('status', 1)->select('department', 'status')->get();
            $data['JobRole']       = JobRole::where('status', 1)->select('role', 'status')->get();
            $data['JobExperience'] = JobExperience::where('status', 1)->select('experience', 'status')->get();
            $data['JobLocation']   = JobLocation::where('status', 1)->select('country', 'city', 'status')->get();
            $data['JobCategory']   = JobCategory::where('status', 1)->select('name', 'status')->get();
            $data['Companies']     = Companies::where('status', 1)->select('id', 'name', 'details', 'logo', 'status')->get();
            $data['JobIntType']    = JobIntType::where('status', 1)->select('id', 'int_type', 'status')->get();
            $data['JobCurrency']   = JobCurrency::where('status', 1)->select('id', 'currency', 'status')->get();
            $data['JobEducation']  = JobEducation::where('status', 1)->select('education_level', 'education', 'branch', 'status')->get();
            $data['JobSalary']     = JobSalary::where('status', 1)
                ->orderByRaw('CAST(salary AS UNSIGNED) ASC') // Ensures numeric sorting
                ->get();
            $decryptedId = Crypt::decrypt($id);
            $jobPost     = JobPost::findOrFail($decryptedId);
            return view('recruiter.job.EditJob', compact('jobPost') + $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid Job ID!');
        }
    }

    public function updateJobPost(Request $request)
    {
        // dd($request->input('edit-id'));

        // Validate request
        $rules = [
            'job_title'          => 'required|string|max:100|',
            'job_type'           => 'required|string',
            'skills'             => 'required',
            // 'industry' => 'required|string',
            // 'department' => 'required|string',
            // 'role' => 'required|string',
            'work_mode'          => 'required|string',
            'location'           => 'required|string',
            'min_experience'     => 'required|integer',
            'max_experience'     => 'required|string',
            'currency'           => 'required|string',
            'min_salary'         => 'required|integer',
            'max_salary'         => 'required',
            'education_level'    => 'required|string',
            'education'          => 'required|string',
            'branch'             => 'nullable',
            'candidate_industry' => 'nullable|string',
            'vacancies'          => 'required|integer',
            'interview_type'     => 'required|string',
            // 'company_name' => 'required|string',
            'company_details'    => 'required|string',
            // 'job_description'=> 'required|string',
            // 'job_resp' => 'required|string',
            // 'job_req' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {

            $id = $request->input('edit-id');

            // Find the record by ID
            $JobPost = JobPost::find($id);

            if ($JobPost) {
                // $recruiter_id = Auth::user()->id;
                // $JobPost->recruiter_id = $recruiter_id;
                $JobPost->title = $request->input('job_title');
                $JobPost->type  = $request->input('job_type');
                // $JobPost->skills = $request->input('skills');
                $JobPost->skills = implode(',', $request->input('skills'));
                // $JobPost->industry = $request->input('industry');
                // $JobPost->department = $request->input('department');
                // $JobPost->role = $request->input('role');
                $JobPost->mode            = $request->input('work_mode');
                $JobPost->location        = $request->input('location');
                $JobPost->min_exp         = $request->input('min_experience');
                $JobPost->max_exp         = $request->input('max_experience');
                $JobPost->currency        = $request->input('currency');
                $JobPost->min_sal         = $request->input('min_salary');
                $JobPost->max_sal         = $request->input('max_salary');
                $JobPost->sal_status      = $request->input('sal_status') ?? 'off';
                $JobPost->education_level = $request->input('education_level');
                $JobPost->education       = $request->input('education');
                // $JobPost->branch = implode(',', $request->input('branch',[]));
                $JobPost->branch             = implode(',', (array) $request->input('branch'));
                $JobPost->condidate_industry = $request->input('candidate_industry');
                $JobPost->diversity          = $request->input('diversity') ?? 'All';
                $JobPost->vacancies          = $request->input('vacancies');
                $JobPost->int_type           = $request->input('interview_type');
                // $JobPost->com_name = $request->input('company_name');
                // $JobPost->com_logo = $request->input('company_logo');
                $JobPost->com_details  = $request->input('company_details');
                $JobPost->jobexpiry    = $request->input('jobExp');
                $JobPost->job_desc     = $request->input('job_description');
                $JobPost->job_resp     = $request->input('job_resp');
                $JobPost->job_req      = $request->input('job_req');
                $JobPost->status       = 0;
                $JobPost->admin_verify = 0;
                $JobPost->updated_at   = now();

                $JobPost->save();

                if ($JobPost->save()) {

                   

                    $recruiterName = Auth::user()->name . ' ' . Auth::user()->lname;
                    $adminProfile = UserProfile::where('user_type', 1)->where('user_details', 'Admin')->first();
                    if ($adminProfile) {
                        $adminProfile->notify(new JobUpdatedByRecruiter($JobPost, $recruiterName));
                    }

                    // Send mail to recruiter
                    $templateRecruiter = EmailTemplates::find(20);
                    if ($templateRecruiter && $templateRecruiter->show_email == '1') {
                        Mail::to(Auth::user()->email)->send(new JobUpdatedMail($JobPost, $recruiterName));
                    }

                    // Send mail to admin
                    $adminMail = UserProfile::where('user_type', 1)->where('user_details', 'Admin')->select('name', 'lname', 'email')->first();
                    $templateAdmin = EmailTemplates::find(21);

                    
                    if ($templateAdmin && $templateAdmin->show_email == '1') {
                        if ($adminMail) {
                            Mail::to($adminMail->email)->send(new JobUpdatedMailToAdmin($JobPost, $recruiterName));
                        }
                    }

                    $message = (($templateRecruiter && $templateRecruiter->show_email == '1') || ($templateAdmin && $templateAdmin->show_email == '1')) ?
                    'JobPost Updated and Email sent successfully.' :
                    'JobPost Updated Successfully.';

                    return response()->json(['status_code' => 1, 'message' => $message]);
                } else {
                    return response()->json(['status_code' => 0, 'message' => 'Unable to update data']);
                }
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }

    }

//     public function JobApllicants($job_id)
//     {
//         try {
//             $decryptedId = Crypt::decrypt($job_id);
//         } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
//             abort(404, 'Invalid Job ID');
//         }

//         $job = JobPost::with(['applications.user.candidateProfile'])->findOrFail($decryptedId);

//         // dd($job->applications->recruiter_view);

//         $applicants = $job->applications->pluck('user');
//         // dd($job);
//         $sortedViews = $job->applications->sortBy('recruiter_view')->pluck('recruiter_view');
// dd($sortedViews);

//         return view('recruiter.applicants.JobApllicants', compact('job', 'applicants'));
//     }
    public function JobApllicants($job_id)
    {
        try {
            $decryptedId = Crypt::decrypt($job_id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404, 'Invalid Job ID');
        }

        $job = JobPost::with(['applications.user.candidateProfile'])->findOrFail($decryptedId);

        // Sort the applications by 'recruiter_view' (0 first, then 1)
        $sortedApplications = $job->applications->sortBy('recruiter_view');

        // Now you can pluck 'recruiter_view' from the sorted applications
        $sortedViews = $sortedApplications->pluck('recruiter_view');

        // You can also access other applicant details if needed
        $applicants = $sortedApplications->pluck('user');

        // For debugging, dd() will show sorted recruiter_view values
        // dd($sortedViews);

        return view('recruiter.applicants.JobApllicants', compact('job', 'applicants'));
    }

    public function ApllicantsDetails($userId, $jobId)
    {
        try {
            $decryptedId = Crypt::decrypt($userId);
            $DecJob_Id   = Crypt::decrypt($jobId);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404, 'Invalid User ID');
        }

        // Load user with candidate profile
        $user = UserProfile::with('candidateProfile', 'candidateQualification', 'candidateEmployment', 'candidateAward')->find($decryptedId);

        $application = JobApplication::where('user_id', $decryptedId)
            ->where('job_id', $DecJob_Id)
            ->first();

        // dd($user->candidateEmployment);

        // Check and increment view_profile if candidate profile exists
        if ($user && $user->candidateProfile) {
            if (is_null($user->candidateProfile->view_profile)) {
                $user->candidateProfile->view_profile = 1;
                $user->candidateProfile->save();
            } else {
                $user->candidateProfile->increment('view_profile');
            }
        }

        // dd($application);

        if ($application) {
            $application->update(['recruiter_view' => '1']);
        }

        // dd($application->recruiter_view);

        // dd($user->social_links);
        // dd($user->candidateProfile->resume);

        $JobPost = JobPost::findOrFail($DecJob_Id)->title;

        return view('recruiter.applicants.ApllicantsDetails', compact('user', 'DecJob_Id', 'application', 'JobPost'));
    }

    public function CandidateShortlist($userId, $Job_Id)
    {

        try {
            $decryptedId = Crypt::decrypt($userId);
            $DecJob_Id   = Crypt::decrypt($Job_Id);

            $application = JobApplication::where('user_id', $decryptedId)
                ->where('job_id', $DecJob_Id)
                ->first();

            if ($application) {
                $application->status = 'shortlisted';

                if ($application->save()) {
                    // send mail to candidate
                    $candidate  = UserProfile::where('id', $decryptedId)->first();
                    $AppliedJob = JobPost::where('id', $DecJob_Id)->select('title')->first();
                   
                    if ($candidate && $AppliedJob) {
                        $candidate->notify(new CandidateShortListNotify($AppliedJob,));
                    }
                    // Fetch email template for shortlist (assume ID 12 is for shortlist emails)
                    $template = EmailTemplates::find(13);

                    if ($template && $template->show_email == '1') {
                        try {
                            Mail::to($candidate->email)->send(new CandidateShortlist($candidate, $AppliedJob));
                        } catch (\Exception $mailException) {
                            DB::rollBack();
                            Log::error('Candidate Shortlist email send failed: ' . $mailException->getMessage());
                            return response()->json([
                                'status_code' => 0,
                                'message'     => 'Candidate shortlist failed while sending email.',
                            ]);
                        }
                    }

                    DB::commit();

                    $message = ($template && $template->show_email == '1') ?
                    'Candidate shortlisted and email sent successfully.' :
                    'Candidate shortlisted.';

                    return response()->json(['status_code' => 1, 'message' => $message]);
                } else {
                    return response()->json([
                        'status_code' => 0, 'message' => 'Failed to Candidate shortlist.']);
                }

            } else {
                return response()->json(['status_code' => 0, 'message' => 'Application not found.']);
            }

        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404, 'Invalid User ID');
        }

    }

    public function CandidateReject($userId, $Job_Id)
    {
        try {
            $decryptedId = Crypt::decrypt($userId);
            $DecJob_Id   = Crypt::decrypt($Job_Id);

            $application = JobApplication::where('user_id', $decryptedId)
                ->where('job_id', $DecJob_Id)
                ->first();

            if ($application) {
                $application->status = 'rejected';

                if ($application->save()) {
                    $candidate  = UserProfile::where('id', $decryptedId)->first();
                    $AppliedJob = JobPost::where('id', $DecJob_Id)->select('title')->first();

                    if ($candidate && $AppliedJob) {
                        $candidate->notify(new CandidateRejectNotify($AppliedJob,));
                    }

                    // Fetch email template for rejection (assume ID 11 is for rejection emails)
                    $template = EmailTemplates::find(12);

                    if ($template && $template->show_email == '1') {
                        try {
                            Mail::to($candidate->email)->send(new CandidateReject($candidate, $AppliedJob));
                        } catch (\Exception $mailException) {
                            DB::rollBack();
                            Log::error('Candidate Rejected email send failed: ' . $mailException->getMessage());
                            return response()->json([
                                'status_code' => 0,
                                'message'     => 'Candidate rejection failed while sending email.',
                            ]);
                        }
                    }

                    DB::commit();

                    $message = ($template && $template->show_email == '1') ?
                    'Candidate rejected and email sent successfully.' :
                    'Candidate rejected.';

                    return response()->json(['status_code' => 1, 'message' => $message]);
                } else {
                    return response()->json([
                        'status_code' => 0, 'message' => 'Failed to Candidate reject.']);
                }

            } else {
                return response()->json(['status_code' => 0, 'message' => 'Application not found.']);
            }

        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404, 'Invalid User ID');
        }
    }

    public function CandidateHire($userId, $Job_Id)
    {
        try {
            $decryptedId = Crypt::decrypt($userId);
            $DecJob_Id   = Crypt::decrypt($Job_Id);

            $application = JobApplication::where('user_id', $decryptedId)
                ->where('job_id', $DecJob_Id)
                ->first();

            if ($application) {
                $application->status = 'hired';

                if ($application->save()) {


                    $candidate  = UserProfile::where('id', $decryptedId)->first();
                    $AppliedJob = JobPost::where('id', $DecJob_Id)->select('title')->first();

                    
                    if ($candidate && $AppliedJob) {
                        $candidate->notify(new CandidateHireNotify($AppliedJob,));
                    }

                    

                    $template = EmailTemplates::find(11);

                    if ($template && $template->show_email == '1') {
                        try {
                            Mail::to($candidate->email)->send(new CandidateHire($candidate, $AppliedJob));
                        } catch (\Exception $mailException) {
                            DB::rollBack(); // rollback if email fails
                            Log::error('Candidate Hired email send failed: ' . $mailException->getMessage());
                            return response()->json([
                                'status_code' => 0,
                                'message'     => 'Candidate hiring failed while sending email.',
                            ]);
                        }
                    }

                    DB::commit(); // commit only if everything goes well

                    $message = ($template && $template->show_email == '1') ?
                    'Candidate hired and email sent successfully.' :
                    'Candidate hired without sending email.';

                    return response()->json(['status_code' => 1, 'message' => $message]);
                } else {
                    return response()->json([
                        'status_code' => 0, 'message' => 'Failed to Candidate hire.']);
                }

            } else {
                return response()->json(['status_code' => 0, 'message' => 'Application not found.']);
            }

        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404, 'Invalid User ID');
        }
    }

    public function CandidateCVDownload($userId)
    {
        try {
            $decryptedId = Crypt::decrypt($userId);
            // dd($decryptedId);

            $user   = UserProfile::with('candidateProfile')->findOrFail($decryptedId);
            $resume = $user->candidateProfile->resume;
            // dd($resume);
            if ($resume !== null) {

                $path = public_path($resume);

                // dd($path);

                if (file_exists($path)) {
                    // dd('path');

                    return response()->download($path);
                } else {
                    // dd('fdf');
                    return back()->with('error', 'File not found.');
                }
            } else {
                return back()->with('error', 'File not found.');
            }

        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404, 'Invalid User ID');
        }

    }

}
