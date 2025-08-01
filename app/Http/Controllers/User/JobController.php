<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobPost;
use App\Models\SaveJob;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{

    public function JobList(Request $request)
    {
        // dd($request->all());
        $today = Carbon::today();
        $query = JobPost::where('status', 1)->where('admin_verify', 1)->whereDate('jobexpiry', '>=', $today);

        if ($request->has('title') && $request->title !== '') {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // Filter by category if selected
        if ($request->has('category') && $request->category !== '') {
            $query->where('industry', 'like', '%' . $request->category . '%');
        }

        if ($request->has('location') && $request->location !== '') {
            $query->where('location', $request->location);
        }

        if ($request->has('date_posted') && $request->date_posted !== '') {
            $dateOnly = \Carbon\Carbon::parse($request->date_posted)->toDateString();
            $query->whereDate('created_at', '=', $dateOnly);
        }

        if($request->has('job_type') && $request->job_type !== '') {
            // dd($request->job_type); 
            $query->where('type', $request->job_type);
        }

        if ($request->has('experience') && $request->experience !== '') {
            $query->where('max_exp', '<=', $request->experience);
        }
        

        $jobs = $query->paginate(5)->withQueryString(); // Adjust pagination as needed
                                                        // $JobCategory = JobCategory::all();
        $location = JobPost::select('location')->where('status', 1)->where('admin_verify', 1)->whereDate('jobexpiry', '>=', $today)->distinct()->get();
        $industry = JobPost::select('industry')->where('status', 1)->where('admin_verify', 1)->whereDate('jobexpiry', '>=', $today)->distinct()->get();
        $DatePost = JobPost::selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as created_at")
            ->where('status', 1)
            ->where('admin_verify', 1)
            ->whereDate('jobexpiry', '>=', $today)
            ->distinct()
            ->get();
        $type        = JobPost::select('type', DB::raw('count(*) as count'))->where('status', 1)->where('admin_verify', 1)->whereDate('jobexpiry', '>=', $today)->groupBy('type')->get();
        $experience  = JobPost::select('max_exp', DB::raw('count(*) as count'))->where('status', 1)->where('admin_verify', 1)->whereDate('jobexpiry', '>=', $today)->groupBy('max_exp')->get();
        $salaryoffer = JobPost::select('max_sal', DB::raw('count(*) as count'))->where('sal_status', '!=', 'off')->where('status', 1)->where('admin_verify', 1)->whereDate('jobexpiry', '>=', $today)->groupBy('max_sal')->get();

        $filters = JobPost::where('status', 1)->where('admin_verify', 1)->whereDate('jobexpiry', '>=', $today)->distinct()->get();

        $savedJobs = SaveJob::where('user_id', Auth::id())->pluck('job_id')->toArray();

        // $data = JobPost::all();
        // dd($DatePost);

        return view('User.JobList', compact('jobs', 'location', 'industry', 'DatePost', 'type', 'experience', 'salaryoffer', 'filters', 'savedJobs'));
    }

    // public function saveJob(Request $request)
    // {
    //     $userId = Auth::id();
    //     $jobId  = $request->input('id');

    //     $exists = SaveJob::where('user_id', $userId)->where('job_id', $jobId)->first();

    //     SaveJob::create([
    //         'user_id' => $userId,
    //         'job_id'  => $jobId,
    //     ]);

    //     return response()->json([
    //         'status_code' => 1,
    //         'message'     => 'Job saved successfully!',
    //     ]);
    // }

    public function saveJob(Request $request)
    {
        $userId = Auth::id();
        $jobId  = $request->input('id');

        SaveJob::create([
            'user_id' => $userId,
            'job_id'  => $jobId,
        ]);

        return response()->json([
            'status_code' => 1,
            'message'     => 'Job saved successfully!',
        ]);
    }

    public function removeSavedJob(Request $request)
    {
        $userId = Auth::id();
        $jobId  = $request->input('id');

        $deleted = SaveJob::where('user_id', $userId)->where('job_id', $jobId)->delete();

        if ($deleted) {
            return response()->json([
                'status_code' => 1,
                'message'     => 'Job Unsaved successfully.',
            ]);
        } else {
            return response()->json([
                'status_code' => 2,
                'message'     => 'Job not found or already Unsaved.',
            ]);
        }
    }

    // public function JobDetails($id)
    // {
        

    //     // dd($id);
    //     $decryptedId = Crypt::decrypt($id);
    //     $job         = JobPost::find($decryptedId);

        
    //     // dd($status, $userId,$decryptedId);
    //     if (! $job) {
    //         return redirect()->back()->with('error', 'Job not found!');
    //     }
        
    //     if(Auth::user()->id) {
    //         $userId = Auth::user()->id;
    //         $status = JobApplication::where('job_id', $decryptedId)
    //         ->where('user_id', $userId)
    //         ->value('status');
    //         return view('User.JobDetails', compact('job', 'status'));
    //     } else {
    //         return view('User.JobDetails', compact('job'));
    //     }

    // }

    public function JobDetails($id)
{
    $decryptedId = Crypt::decrypt($id);
    $job = JobPost::find($decryptedId);

    if (! $job) {
        return redirect()->back()->with('error', 'Job not found!');
    }

    $status = null;

    if (Auth::check()) {
        $userId = Auth::id();
        $status = JobApplication::where('job_id', $decryptedId)
            ->where('user_id', $userId)
            ->value('status');
        return view('User.JobDetails', compact('job', 'status'));
    }

    return view('User.JobDetails', compact('job', 'status'));
}


}
