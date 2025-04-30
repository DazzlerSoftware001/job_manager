<?php
namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Support\Carbon;
use App\Models\JobPost;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ApplicantsController extends Controller
{
    public function allApplicants()
    { 
        $today = Carbon::today();
        $joblist = JobPost::select('id','title')->where('status', 1)->where('admin_verify', 1)->whereDate('jobexpiry', '>=', $today)->get();
        $cities = JobApplication::with('user')->get()->pluck('user.city')->filter()->unique()->values();
       
        $data = [
            'qualifications' => UserProfile::select('qualification')->distinct()->pluck('qualification')->filter(),
            'branches' => UserProfile::select('branch')->distinct()->pluck('branch')->filter(),
        ];
        
        // dd($data['qualifications']);

        
        return view('recruiter.applicants.AllApplicants',compact('joblist','cities','data'));
    }

    // public function getAllApplicants(Request $request)
    // {
    //     $draw   = intval($request->input("draw"));
    //     $offset = intval($request->input("start", 0));
    //     $limit  = intval($request->input('length', 10));
    //     $order  = $request->input("order");
    //     $search = $request->input("search")['value'] ?? '';

    //     // Column mapping
    //     $columns = [
    //         0 => 'job_applications.id',
    //         1 => 'job_post.title',
    //         2 => 'users.name',
    //         3 => 'users.email',
    //         4 => 'job_applications.status',
    //         5 => 'job_applications.created_at',
    //         6 => 'job_applications.id',
    //     ];

    //     // Base query with joins
    //     $query = JobApplication::with([
    //         'user:id,name,email',
    //         'jobPost:id,title',
    //     ])->select(['id', 'user_id', 'job_id', 'status', 'created_at']);

    //     // Search filter
    //     if (! empty($search)) {
    //         $query->where(function ($q) use ($search) {
    //             $q->where('users.name', 'like', '%' . $search . '%')
    //                 ->orWhere('users.email', 'like', '%' . $search . '%')
    //                 ->orWhere('job_post.title', 'like', '%' . $search . '%');
    //         });
    //     }

    //     // Ordering
    //     if ($order) {
    //         $columnIndex = $order[0]['column'];
    //         $columnName  = $columns[$columnIndex];
    //         $dir         = $order[0]['dir'];
    //         $query->orderBy($columnName, $dir);
    //     } else {
    //         $query->orderBy('job_applications.id', 'desc');
    //     }

    //     // Count total before pagination
    //     $totalRecords = $query->count();

    //     // Paginate
    //     $records = $query->offset($offset)->limit($limit)->get();

    //     $data = [];
    //     foreach ($records as $record) {
    //         $dataArray = [];

    //         $dataArray[] = $record->id;
    //         $dataArray[] = ucfirst($record->jobPost->title ?? 'N/A');
    //         $dataArray[] = ucfirst($record->user->name ?? 'N/A');
    //         $dataArray[] = $record->user->email ?? 'N/A';

    //         $badgeClass = [
    //             'pending'     => 'bg-warning',
    //             'shortlisted' => 'bg-info',
    //             'rejected'    => 'bg-danger',
    //             'hired'       => 'bg-success',
    //         ];

    //         $badgeText  = ucfirst($record->status); // Capitalize first letter
    //         $badgeColor = $badgeClass[$record->status] ?? 'bg-secondary';

    //         $status = '<div class="d-flex">
    //             <span onclick="toggleVerifyOptions(\'' . $record->id . '\');"
    //                   class="badge ' . $badgeColor . ' text-uppercase"
    //                   style="cursor: pointer;">' . $badgeText . '</span>
    //         </div>';

    //         if ($record->status == 'pending') {
    //             $status .= '<div id="verify-options-' . $record->id . '" style="display: none; margin-top: 5px;">
    //                             <div class="d-flex gap-2">
    //                                 <button class="badge bg-info text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(\'' . $record->id . '\', \'shortlisted\')">Shortlist</button>
    //                                 <button class="badge bg-danger text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(\'' . $record->id . '\', \'rejected\')">Reject</button>
    //                             </div>
    //                         </div>';
    //         } elseif ($record->status == 'shortlisted') {
    //             $status .= '<div id="verify-options-' . $record->id . '" style="display: none; margin-top: 5px;">
    //                             <div class="d-flex gap-2">
    //                                 <button class="badge bg-success text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(\'' . $record->id . '\', \'hired\')">Hire</button>
    //                                 <button class="badge bg-danger text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(\'' . $record->id . '\', \'rejected\')">Reject</button>
    //                             </div>
    //                         </div>';
    //         } elseif ($record->status == 'rejected') {
    //             $status .= '<div id="verify-options-' . $record->id . '" style="display: none; margin-top: 5px;">
    //                             <div class="d-flex gap-2">
    //                                 <button class="badge bg-info text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(\'' . $record->id . '\', \'shortlisted\')">Shortlist</button>
    //                             </div>
    //                         </div>';
    //         }

    //         $dataArray[] = $status;

    //         $dataArray[] = date('d-M-Y', strtotime($record->created_at));

    //         $dataArray[] = '<div class="d-flex gap-2">
    //         <div class="edit">
    //             <a href="' . route('Recruiter.ViewJobPost', ['id' => Crypt::encrypt($record->jobPost->id)]) . '" class="edit-item-btn text-primary">

    //                 <i class="far fa-eye"></i>
    //             </a>
    //         </div>
    //         <div class="remove">
    //             <a href="javascript:void(0);" class="remove-item-btn text-danger" onclick="deleteRecord(' . $record->id . ');">
    //                 <i class="far fa-trash-alt"></i>
    //             </a>
    //         </div>
    //     </div>';

    //         $data[] = $dataArray;
    //     }

    //     return response()->json([
    //         "draw"            => $draw,
    //         "recordsTotal"    => $totalRecords,
    //         "recordsFiltered" => $totalRecords,
    //         "data"            => $data,
    //     ]);
    // }

    public function getAllApplicants(Request $request)
    {
        $draw   = intval($request->input("draw"));
        $offset = intval($request->input("start", 0));
        $limit  = intval($request->input('length', 10));
        $order  = $request->input("order");
        $jobId  = $request->input('job_id');

        $education_level  = $request->input('education_level');
        $Qualification  = $request->input('Qualification');
        $Branch  = $request->input('Branch');
        
        $city = $request->input('city');
        $status = $request->input('status');
        $search = $request->input("search");

// dd($Qualification);
        // If no job is selected, return empty result
        if (empty($jobId)) {
            return response()->json([
                "draw" => $draw,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => [],
            ]);
        }

        $columns = [
            0 => 'job_applications.id',
            1 => 'job_post.title',
            2 => 'users.name',
            3 => 'users.email',
            4 => 'job_applications.status',
            5 => 'job_applications.created_at',
            6 => 'job_applications.id',
        ];

        $query = JobApplication::with([
            'user:id,name,lname,email,logo,education_level,city',
            'jobPost:id,title',
        ])
            ->where('job_id', $jobId)
            ->select(['id', 'user_id', 'job_id', 'status', 'created_at']);


        if (!empty($education_level)) {
            $query->whereHas('user', function ($q) use ($education_level) {
                $q->where('education_level', $education_level);
            });
        }

        if (!empty($Qualification)) {
            $query->whereHas('user', function ($q) use ($Qualification) {
                $q->where('qualification', 'like', '%' . $Qualification . '%');
            });
        }

        if (!empty($Branch)) {
            $query->whereHas('user', function ($q) use ($Branch) {
                $q->where('branch', 'like', '%' . $Branch . '%');
            });
        }

        
        if (!empty($city)) {
            $query->whereHas('user', function ($q) use ($city) {
                $q->where('city', $city);
            });
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }

       
        

        if (!empty($search)) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('city', 'like', '%' . $search . '%');
            });
        }

        if ($order) {
            $columnIndex = $order[0]['column'];
            $columnName = $columns[$columnIndex];
            $dir = $order[0]['dir'];
            $query->orderBy($columnName, $dir);
        } else {
            $query->orderBy('job_applications.id', 'desc');
        }

        $totalRecords = $query->count();
        $records = $query->offset($offset)->limit($limit)->get();

        $data = [];
        foreach ($records as $record) {
            $dataArray = [];

            $dataArray[] = $record->id;
            // $dataArray[] = ucfirst($record->jobPost->title ?? 'N/A');
            $dataArray[] = '<a href="' . route('Recruiter.ViewJobPost', ['id' => Crypt::encrypt($record->jobPost->id)]) . '" class="text-primary"> '.ucfirst($record->jobPost->title).'</a>';
            $dataArray[] = ucfirst($record->user->name) .' '.$record->user->lname;
            $dataArray[] = $record->user->email ?? 'N/A';
            $dataArray[] = '<img src="' . asset($record->user->logo) . '" alt="Logo" style="height: 100px; width: 100px;" onclick="openImageModal(\'' . asset($record->user->logo) . '\')">';
            $dataArray[] = $record->user->city ?? 'N/A';

            
            // rejected shortlisted hired
            if ($record->status === 'pending') {
                $dataArray[] = '<span class="badge bg-warning text-dark">Applied</span>';

            } elseif ($record->status === 'shortlisted'){
                $dataArray[] = '<span class="badge bg-primary">' . ucfirst($record->status) . '</span>';

            }elseif ($record->status === 'rejected'){
                $dataArray[] = '<span class="badge bg-danger">' . ucfirst($record->status) . '</span>';
            }elseif ($record->status === 'hired'){
                $dataArray[] = '<span class="badge bg-success">' . ucfirst($record->status) . '</span>';
            }
            

            $dataArray[] =  '<div class="d-flex gap-2">
                <a href="'. route('Recruiter.ApllicantsDetails', [
                    'userId' => Crypt::encrypt($record->user->id),
                    'jobId' => Crypt::encrypt($record->jobPost->id)
                ]).'" class="badge bg-primary">View Profile</a>
              </div>';
              $dataArray[] = date('d-M-Y', strtotime($record->created_at));


            $dataArray[] = '<div class="d-flex gap-2">
               
                <a href="javascript:void(0);" class="text-danger" onclick="deleteRecord(' . $record->id . ');"><i class="far fa-trash-alt"></i></a>
            </div>';

            $data[] = $dataArray;
        }

        return response()->json([
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data,
        ]);
    }


    public function verifyStatus(Request $request)
    {
        $id     = $request->id;
        $status = $request->status;

        $application = JobApplication::find($id);
        if ($application) {
            $application->status = $status;
            $application->save();

            return response()->json(['status_code' => 1, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['status_code' => 0, 'message' => 'Application not found.']);
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

}
