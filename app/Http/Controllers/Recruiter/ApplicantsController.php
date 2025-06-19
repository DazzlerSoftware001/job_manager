<?php
namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\CandidateProfile;
use App\Models\JobApplication;
use App\Models\JobExperience;
use App\Models\JobPost;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;

class ApplicantsController extends Controller
{
    public function allApplicants(Request $request)
    {
        // dd($request->all());
        $job_id      = $request->job_id;
        $decryptedId = null;
        if (! empty($job_id)) {
            $decryptedId = Crypt::decrypt($job_id);
        }
        $today   = Carbon::today();
        $joblist = JobPost::select('id', 'title')->where('status', 1)->where('admin_verify', 1)->whereDate('jobexpiry', '>=', $today)->get();
        $cities  = JobApplication::with('user')->get()->pluck('user.city')->filter()->unique()->values();
        $skills  = CandidateProfile::pluck('skill')
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

        // dd($skills);

        $data = [
            'qualifications' => UserProfile::select('qualification')->distinct()->pluck('qualification')->filter(),
            'branches'       => UserProfile::select('branch')->distinct()->pluck('branch')->filter(),
        ];

        $experience = JobExperience::pluck('experience');

        // dd($data['qualifications']);

        return view('recruiter.applicants.AllApplicants', compact('joblist', 'cities', 'skills', 'data', 'decryptedId', 'experience'));
    }

    public function getAllApplicants(Request $request)
    {
        $draw        = intval($request->input("draw"));
        $offset      = intval($request->input("start", 0));
        $limit       = intval($request->input('length', 10));
        $order       = $request->input("order");
        $decryptedId = $request->input('decryptedId');
        $jobId       = $request->input('job_id');
        // dd($jobId,$decryptedId);

        $education_level = $request->input('education_level');
        $Qualification   = $request->input('Qualification');
        $Branch          = $request->input('Branch');

        $city   = $request->input('city');
        $status = $request->input('status');
        $search = $request->input("search");

        $ProfileStatus = $request->input('Profilestatus');

        $skills = $request->input('skills'); // array
                                             // $experience = $request->input('experience'); // array
        $experience = $request->input('experience', []);

        // dd($Qualification);
        // If no job is selected, return empty result
        // if (empty($jobId)) {
        //     return response()->json([
        //         "draw"            => $draw,
        //         "recordsTotal"    => 0,
        //         "recordsFiltered" => 0,
        //         "data"            => [],
        //     ]);
        // }

        $columns = [
            0 => 'job_applications.id',
            1 => 'job_applications.user_id',
            2 => 'job_applications.user_id',
            3 => 'job_applications.user_id',
            4 => 'job_applications.user_id',
            5 => 'job_applications.status',
            6 => 'job_applications.created_at',
            7 => 'job_applications.recruiter_view',

        ];

        // dd($decryptedId);
        $query = JobApplication::with([
            'user:id,name,lname,email,logo,education_level,city,experience',
            'user.candidateProfile:skill',
            'jobPost:id,title',
        ])
            ->select(['id', 'user_id', 'job_id', 'status', 'recruiter_view', 'created_at']);

        if (! empty($jobId)) {
            $query->where('job_id', $jobId);
        } else {
            $query->where('job_id', $decryptedId);
        }

        // ->where('job_id', !empty($jobId) ? $jobId : $decryptedId);

        if (! empty($education_level)) {
            $query->whereHas('user', function ($q) use ($education_level) {
                $q->where('education_level', $education_level);
            });
        }

        if (! empty($Qualification)) {
            $query->whereHas('user', function ($q) use ($Qualification) {
                $q->where('qualification', 'like', '%' . $Qualification . '%');
            });
        }

        if (! empty($Branch)) {
            $query->whereHas('user', function ($q) use ($Branch) {
                $q->where('branch', 'like', '%' . $Branch . '%');
            });
        }

        if (! empty($city)) {
            $query->whereHas('user', function ($q) use ($city) {
                $q->where('city', $city);
            });
        }

        if (! empty($status)) {
            $query->where('status', $status);
        }

        if (isset($ProfileStatus)) {
            $query->where('recruiter_view', $ProfileStatus);
        }

        if (! empty($search)) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%');
            });
        }

        if (! empty($skills)) {
            $query->whereHas('user.candidateProfile', function ($q) use ($skills) {
                foreach ($skills as $skill) {
                    $q->where('skill', 'like', '%' . $skill . '%');
                }
            });
        }

        // if (! empty($experience)) {
        //     $query->whereHas('user', function ($q) use ($experience) {
        //         $q->where('experience', '<=', $experience);
        //     });
        // }
        if (! empty($experience) && is_array($experience)) {
            $experience = array_map('intval', $experience);
            $min        = min($experience);
            $max        = max($experience);

            $query->whereHas('user', function ($q) use ($min, $max) {
                $q->whereBetween('experience', [$min, $max]);
            });
        }

        if ($order) {
            $columnIndex = $order[0]['column'];
            $columnName  = $columns[$columnIndex];
            $dir         = $order[0]['dir'];

            // Sort with recruiter_view = '0' first (as string)
            $query->orderByRaw("recruiter_view = '0' DESC")->orderBy($columnName, $dir);
        } else {
            $query->orderByRaw("recruiter_view = '0' DESC")->orderBy('created_at', 'desc');
        }

        $totalRecords = $query->count();
        $records      = $query->offset($offset)->limit($limit)->get();
        // dd($records);
        $data = [];
        foreach ($records as $record) {
            $dataArray = [];

            $dataArray[] = $record->id;
            // $dataArray[] = '<a href="' . route('Recruiter.ViewJobPost', ['id' => Crypt::encrypt($record->jobPost->id)]) . '" class="text-primary"> '.ucfirst($record->jobPost->title).'</a>';

            $dataArray[] = '<div class="d-flex gap-2">
                <a href="' . route('Recruiter.ApllicantsDetails', [
                'userId' => Crypt::encrypt($record->user->id),
                'jobId'  => Crypt::encrypt($record->jobPost->id),
            ]) . '" class="text-primary text-decoration-none" data-bs-toggle="tooltip" title="View Profile">'
            . ucfirst($record->user->name) . ' ' . $record->user->lname .
                '</a>
            </div>';

            // $dataArray[] = ucfirst($record->user->name) .' '.$record->user->lname;
            $dataArray[] = $record->user->email ?? 'N/A';
            $dataArray[] = '<img src="' . asset($record->user->logo) . '" alt="Logo" style="height: 50px; width: 50px;border-radius:50px;" onclick="openImageModal(\'' . asset($record->user->logo) . '\')">';

            $dataArray[] = $record->user->city ?? 'N/A';

            // rejected shortlisted hired
            if ($record->status === 'pending') {
                $dataArray[] = '<span class="badge bg-warning text-dark">Applied</span>';

            } elseif ($record->status === 'shortlisted') {
                $dataArray[] = '<span class="badge bg-primary">' . ucfirst($record->status) . '</span>';

            } elseif ($record->status === 'rejected') {
                $dataArray[] = '<span class="badge bg-danger">' . ucfirst($record->status) . '</span>';
            } elseif ($record->status === 'hired') {
                $dataArray[] = '<span class="badge bg-success">' . ucfirst($record->status) . '</span>';
            }

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            // $dataArray[] = '<div class="d-flex gap-2">
            //   <a href="' . route('Recruiter.ApllicantsDetails', [
            //     'userId' => Crypt::encrypt($record->user->id),
            //     'jobId'  => Crypt::encrypt($record->jobPost->id),
            // ]) . '" class="badge bg-primary">View Profile</a>
            // </div>';

            $buttonClass = $record->recruiter_view == 1 ? 'bg-success text-white' : 'bg-warning text-dark';
            $buttonLabel = $record->recruiter_view == 1 ? 'Viewed' : 'Not Viewed';

            $dataArray[] = '<div class="d-flex gap-2">
                                <span class="badge ' . $buttonClass . '">' . $buttonLabel . '</span>
                            </div>';

            $dataArray[] = '<div class="d-flex gap-2">
                            <a href="' . route('Recruiter.ApllicantsDetails', [
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

    public function shortlistApplicants()
    {
        return view('recruiter.applicants.ShortlistApplicants');
    }

    public function GetShortlistApplicants(Request $request)
    {
        $draw   = intval($request->input("draw"));
        $offset = intval($request->input("start", 0));
        $limit  = intval($request->input('length', 10));
        $order  = $request->input("order");
        $search = $request->input("search")['value'] ?? '';

        // Column mapping
        $columns = [
            0 => 'job_applications.id',
            1 => 'job_post.title',
            2 => 'users.name',
            3 => 'users.email',
            4 => 'job_applications.status',
            5 => 'job_applications.created_at',
            6 => 'job_applications.id',
        ];

        // Base query with joins
        $query = JobApplication::with([
            'user:id,name,email',
            'jobPost:id,title',
        ])->select(['id', 'user_id', 'job_id', 'status', 'created_at'])
            ->where('status', 'shortlisted');

        // Search filter
        if (! empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'like', '%' . $search . '%')
                    ->orWhere('users.email', 'like', '%' . $search . '%')
                    ->orWhere('job_post.title', 'like', '%' . $search . '%');
            });
        }

        // Ordering
        if ($order) {
            $columnIndex = $order[0]['column'];
            $columnName  = $columns[$columnIndex];
            $dir         = $order[0]['dir'];
            $query->orderBy($columnName, $dir);
        } else {
            $query->orderBy('job_applications.id', 'desc');
        }

        // Count total before pagination
        $totalRecords = $query->count();

        // Paginate
        $records = $query->offset($offset)->limit($limit)->get();

        $data = [];
        foreach ($records as $record) {
            $dataArray = [];

            $dataArray[] = $record->id;
            $dataArray[] = ucfirst($record->jobPost->title ?? 'N/A');
            $dataArray[] = ucfirst($record->user->name ?? 'N/A');
            $dataArray[] = $record->user->email ?? 'N/A';

            $badgeClass = [
                'pending'     => 'bg-warning',
                'shortlisted' => 'bg-info',
                'rejected'    => 'bg-danger',
                'hired'       => 'bg-success',
            ];

            $badgeText  = ucfirst($record->status); // Capitalize first letter
            $badgeColor = $badgeClass[$record->status] ?? 'bg-secondary';

            $status = '<div class="d-flex">
                <span onclick="toggleVerifyOptions(\'' . $record->id . '\');"
                      class="badge ' . $badgeColor . ' text-uppercase"
                      style="cursor: pointer;">' . $badgeText . '</span>
            </div>';

            if ($record->status == 'shortlisted') {
                $status .= '<div id="verify-options-' . $record->id . '" style="display: none; margin-top: 5px;">
                                <div class="d-flex gap-2">
                                    <button class="badge bg-success text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(\'' . $record->id . '\', \'hired\')">Hire</button>
                                    <button class="badge bg-danger text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(\'' . $record->id . '\', \'rejected\')">Reject</button>
                                </div>
                            </div>';
            }

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
            <div class="edit">
                <a href="' . route('Recruiter.ViewJobPost', ['id' => Crypt::encrypt($record->jobPost->id)]) . '" class="edit-item-btn text-primary">

                    <i class="far fa-eye"></i>
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

    public function verifyStatus(Request $request)
    {
        $id     = $request->input('id');
        $status = $request->input('status'); // 1 = Verified, 0 = Rejected

        if (empty($id)) {
            return response()->json(['status_code' => 2, 'message' => 'Job ID is required']);
        }

        $JobPost = JobPost::find($id);
        if (! $JobPost) {
            return response()->json(['status_code' => 0, 'message' => 'Job Post not found']);
        }

        $JobPost->admin_verify = $status;

        if (! $JobPost->save()) {
            return response()->json([
                'status_code' => 0,
                'message'     => 'Unable to update job verification status.',
            ]);
        }

        $recruiter = UserProfile::where('id', $JobPost->recruiter_id)
            ->select('name', 'lname', 'email')
            ->first();

        $template = EmailTemplates::find(8); // Template 8 for job verification email

        if ($template && $template->show_email === '1' && $recruiter) {
            try {
                Mail::to($recruiter->email)->send(new JobVerifyMailToRecruiter($JobPost, $recruiter));
            } catch (\Exception $e) {
                \Log::error('Email failed: ' . $e->getMessage());

                return response()->json([
                    'status_code' => 0,
                    'message'     => 'Job status updated, but failed to send email.',
                ]);
            }
        }

        $msg = $status == 1
        ? 'Job Post verified successfully'
        : 'Job Post rejected successfully';

        if ($template && $template->show_email === '1') {
            $msg .= ' and email sent to recruiter.';
        }

        return response()->json([
            'status_code' => 1,
            'message'     => $msg,
        ]);
    }

}
