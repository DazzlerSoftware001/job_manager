<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
        $today = Carbon::today();
        $query = JobPost::where('status', 1)->where('admin_verify', 1)->whereDate('jobexpiry', '>=', $today);

        if ($request->has('title') && $request->title !== '') {
            $query->where('title', $request->title);
        }

        // Filter by category if selected
        if ($request->has('category') && $request->category !== '') {
            $query->where('industry', $request->category);
        }

        $jobs = $query->paginate(1)->withQueryString(); // Adjust pagination as needed
                                                        // $JobCategory = JobCategory::all();
        $industries = JobPost::distinct()->pluck('industry');
        $type       = JobPost::select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->get();

        $experience = JobPost::select('max_exp', DB::raw('count(*) as count'))
            ->groupBy('max_exp')
            ->get();

        $location = JobPost::select('location')->distinct()->get();

        $savedJobs = SaveJob::where('user_id', Auth::id())->pluck('job_id')->toArray();

        // $data = JobPost::all();
        // dd($jobs);

        return view('User.JobList', compact('jobs', 'industries', 'type', 'experience', 'location', 'savedJobs'));
    }

    public function saveJob(Request $request)
    {
        $userId = Auth::id();
        $jobId  = $request->input('job_id');

        $exists = SaveJob::where('user_id', $userId)->where('job_id', $jobId)->first();

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
        $jobId  = $request->input('job_id');

        $deleted = SaveJob::where('user_id', $userId)->where('job_id', $jobId)->delete();

        if ($deleted) {
            return response()->json([
                'status_code' => 1,
                'message'     => 'Job removed successfully.',
            ]);
        } else {
            return response()->json([
                'status_code' => 2,
                'message'     => 'Job not found or already removed.',
            ]);
        }
    }

    public function JobDetails($id)
    {

        // dd($id);
        $decryptedId = Crypt::decrypt($id);
        $job         = JobPost::find($decryptedId);
        // dd($job);
        if (! $job) {
            return redirect()->back()->with('error', 'Job not found!');
        }

        return view('User.JobDetails', compact('job'));
    }

}
