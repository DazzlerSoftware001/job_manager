<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CandidateProfile;
use App\Models\JobApplication;
use App\Models\JobExperience;
use App\Models\Jobpost;
use App\Models\Recruiter;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class UsersListController extends Controller
{
    public function userList()
    {
        $cities = JobApplication::with('user')->get()->pluck('user.city')->filter()->unique()->values();
        $skills = CandidateProfile::pluck('skill')
            ->filter()
            ->flatMap(function ($item) {
                // Remove square brackets and quotes
                $item = str_replace(['[', ']', '"'], '', $item);

                // Split and clean each skill
                $skills  = explode(',', $item);
                $cleaned = [];

                foreach ($skills as $skill) {
                    $skill = strtolower(trim($skill));
                    if (! empty($skill)) {
                        $cleaned[] = $skill;
                    }
                }

                return $cleaned;
            })
            ->unique()
            ->sort()
            ->values();

        $experience = JobExperience::pluck('experience');
        // dd($experience);

        return view('admin.Users.UsersList', compact('cities', 'skills', 'experience'));
    }

    public function getUsersList(Request $request)
    {
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        $limit  = intval($request->input('length', 10));

        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'phone',
            4 => 'logo',
            5 => 'status',
            6 => 'created_at',
        ];

        $city   = $request->input('city');
        $skills = $request->input('skills'); // should be an array

        $education_level = $request->input('education_level');
        $Qualification   = $request->input('Qualification');
        $Branch          = $request->input('Branch');

        // $experience = $request->input('experience');
        // $experience = array_map(function ($val) {
        //     return (int) filter_var($val, FILTER_SANITIZE_NUMBER_INT);
        // }, $request->input('experience') ?? []);
        $experience = $request->input('experience', []);

        // $query = UserProfile::where('user_type', 0);

        $query = UserProfile::with('candidateProfile')
            ->where('user_type', 0);

        if (! empty($city)) {
            $query->where('city', $city);
        }

        if (! empty($skills) && is_array($skills)) {
            $query->whereHas('candidateProfile', function ($q) use ($skills) {
                foreach ($skills as $skill) {
                    $q->where('skill', 'like', '%' . $skill . '%');
                }
            });
        }

        if (! empty($education_level)) {
            $query->where('education_level', $education_level);
        }

        if (! empty($Qualification)) {
            $query->where('qualification', 'like', '%' . $Qualification . '%');
        }

        if (! empty($Branch)) {
            $query->where('branch', 'like', '%' . $Branch . '%');
        }

        // if (! empty($experience) && is_array($experience)) {
        //     $maxExperience = max($experience); // Assumes numeric values
        //     $query->where('experience', '<=', $maxExperience);
        // }
        // if (! empty($experience)) {
        //     $query->whereIn('experience', $experience);
        // }
        if (! empty($experience) && is_array($experience)) {
            // Clean and cast to int
            $experience = array_map('intval', $experience);

            $min = min($experience);
            $max = max($experience);

            $query->whereBetween('experience', [$min, $max]);
        }

        // Apply search if provided
        if (! empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%');
            });
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
            $dataArray[] = ucfirst($record->name . ' ' . $record->lname);
            $dataArray[] = $record->email;
            $dataArray[] = $record->phone;
            $dataArray[] = '<img src="' . asset($record->logo) . '" alt="Logo" style="height: 50px; width: 50px; border-radius:50%; object-fit: cover; cursor: pointer;" onclick="openImageModal(\'' . asset($record->logo) . '\')">';

            $status = $record->status == 1
            ? '<div class="d-flex"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
                                <div class="edit">
                                    <a href="' . route('Admin.EditUser', ['id' => Crypt::encrypt($record->id)]) . '" class="edit-item-btn text-primary">
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

    public function getQualifications(Request $request)
    {
        $education_level = $request->input('education_level');

        // Replace with your actual logic for fetching qualifications
        $qualifications = UserProfile::where('education_level', $education_level)
            ->pluck('qualification')
            ->unique()
            ->values();

        return response()->json($qualifications);
    }

    public function getBranches(Request $request)
    {
        $qualification = $request->input('qualification');

        $branches = UserProfile::where('qualification', $qualification)
            ->pluck('branch')
            ->unique()
            ->filter() // optional: removes null values
            ->values();

        return response()->json($branches);
    }

    public function ChangeUserStatus(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID
            $User = UserProfile::find($id);

            if ($User) {
                // Toggle the status
                $User->status = $User->status == 1 ? 0 : 1;

                // Save the updated record
                if ($User->save()) {
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

    public function EditUser($id)
    {

        $decryptedId = Crypt::decrypt($id);
        // dd($decryptedId);

        $user = UserProfile::findOrFail($decryptedId);
        return view('admin.Users.EditUser', compact('user'));
    }

    public function UpdateUser(Request $request)
    {
        $rules = [
            'edit_id'          => 'required|exists:users,id',
            'fname'            => 'required|string|max:100',
            'lname'            => 'required|string|max:100',
            'img'              => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'dob'              => 'required|date',
            'gender'           => 'required|in:Male,Female,Other',
            'password'         => 'nullable|string|min:6|same:confirm_password',
            'confirm_password' => 'nullable|string|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 2,
                'message'     => $validator->errors()->first(),
            ]);
        }

        try {
            $profile = UserProfile::find($request->edit_id);
            if (! $profile) {
                return response()->json(['status_code' => 0, 'message' => 'Profile not found']);
            }

            // Image upload
            if ($request->hasFile('img')) {
                if ($profile->logo && file_exists(public_path($profile->logo))) {
                    unlink(public_path($profile->logo));
                }

                $imageName = time() . '.' . $request->img->extension();
                $request->img->move(public_path('user/assets/img/profile/'), $imageName);
                $profile->logo = 'user/assets/img/profile/' . $imageName;
            }

            // Update profile fields
            $profile->name          = $request->fname;
            $profile->lname         = $request->lname;
            $profile->date_of_birth = $request->dob;
            $profile->gender        = $request->gender;
            $profile->updated_at    = now();
            $profile->save();

            // Update password if given
            if ($request->filled('password')) {
                $user           = UserProfile::find($request->edit_id);
                $user->password = bcrypt($request->password);
                $user->save();
            }

            return response()->json([
                'status_code' => 1,
                'message'     => 'Updated successfully',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 0,
                'message'     => 'Something went wrong while updating.',
            ]);
        }
    }

    public function DeleteUser(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Attempt to find and delete the record
            $User = UserProfile::find($id);

            if ($User) {
                $User->delete();
                return response()->json(['status_code' => 1, 'message' => 'User deleted successfully ']);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'User not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function AllApplicants()
    {

        $Recruiters = Recruiter::select('id', 'name', 'email')->where('user_type', 2)->where('status', 1)->get();
        $today      = Carbon::today();

        $joblist = JobPost::select('id', 'title')->where('status', 1)->where('admin_verify', 1)->whereDate('jobexpiry', '>=', $today)->get();

        return view('admin.Users.AllApplicants', compact('Recruiters'));
    }

    public function getJobsByRecruiter(Request $request)
    {
        $jobs = JobPost::select('id', 'title')
            ->where('status', 1)
            ->where('admin_verify', 1)
            ->where('recruiter_id', $request->recruiter_id)
            ->whereDate('jobexpiry', '>=', now())
            ->get();
        return response()->json($jobs);
    }

    public function GetApplicants(Request $request)
    {
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        $limit  = intval($request->input('length', 10));

        $order = $request->input("order");

        $JobFilter = $request->input("JobFilter");

        if (empty($JobFilter)) {
            return response()->json([
                "draw"            => $draw,
                "recordsTotal"    => 0,
                "recordsFiltered" => 0,
                "data"            => [],
            ]);
        }

        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'phone',
            4 => 'logo',
            5 => 'status',
            6 => 'created_at',
        ];

        // $query = Jobpost::where('id', $JobFilter)->get();

        $query = JobApplication::with([
            'user:id,name,lname,email,logo,education_level,city',
            'user.candidateProfile:skill',
            'jobPost:id,title',
        ])
            ->select(['id', 'user_id', 'job_id', 'status', 'recruiter_view', 'created_at']);

        if (! empty($JobFilter)) {
            $query->where('job_id', $JobFilter);
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

            $dataArray[] = $record->user->id;
            // $dataArray[] = ucfirst($record->name . ' ' . $record->lname);
            $dataArray[] = ucfirst($record->user->name) . ' ' . $record->user->lname;

            $dataArray[] = $record->user->email;
            $dataArray[] = $record->user->phone;
            $dataArray[] = '<img src="' . asset($record->user->logo) . '" alt="Logo" style="height: 50px; width: 50px; border-radius:50%; object-fit: cover; cursor: pointer;" onclick="openImageModal(\'' . asset($record->logo) . '\')">';

            // $status = $record->status == 1
            // ? '<div class="d-flex"><span onclick="changeStatus(' . $record->user->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            // : '<div class="d-flex"><span onclick="changeStatus(' . $record->user->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            // $dataArray[] = $status;

            // $dataArray[] = date('d-M-Y', strtotime($record->user->created_at));

            // $dataArray[] = '<div class="d-flex gap-2">
            //                     <div class="edit">
            //                         <a href="' . route('Admin.EditUser', ['id' => Crypt::encrypt($record->id)]) . '" class="edit-item-btn text-primary">
            //                             <i class="far fa-edit"></i>
            //                         </a>
            //                     </div>
            //                     <div class="remove">
            //                         <a href="javascript:void(0);" class="remove-item-btn text-danger" onclick="deleteRecord(' . $record->id . ');">
            //                             <i class="far fa-trash-alt"></i>
            //                         </a>
            //                     </div>
            //                 </div>';

            $dataArray[] = '<div class="d-flex gap-2">
                                <a href="' . route('Admin.ApllicantsDetails', [
                'userId' => Crypt::encrypt($record->user->id),
                'jobId'  => Crypt::encrypt($record->jobPost->id),
            ]) . '" class="badge bg-success">View Profile</a>
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

        // if ($application) {
        //     $application->update(['recruiter_view' => '1']);
        // }

        // dd($application->recruiter_view);

        // dd($user->social_links);
        // dd($user->candidateProfile->resume);

        $JobPost = JobPost::findOrFail($DecJob_Id)->title;

        return view('admin.Users.ApllicantsDetails', compact('user', 'DecJob_Id', 'application', 'JobPost'));
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
                    return response()->json(['status_code' => 1, 'message' => 'Candidate shortlisted.']);
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
                    return response()->json(['status_code' => 1, 'message' => 'Candidate rejected.']);
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
                    return response()->json(['status_code' => 1, 'message' => 'Candidate hired.']);
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
