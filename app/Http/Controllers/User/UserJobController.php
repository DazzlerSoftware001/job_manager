<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\SaveJob;

class UserJobController extends Controller
{

    // public function applyjob(Request $request, $job_id)
    // {
    //     // $user_id = Auth::id();
    //     $user_id = 3;

    //     // ✅ Check if the job exists
    //     $job = JobPost::findOrFail($job_id);

    //     // ✅ Check if job is expired
    //     if (now()->toDateString() > $job->jobexpiry) {
    //         return back()->with('error', 'This job posting has expired.');
    //     }

    //     // ✅ Check if already applied
    //     $alreadyApplied = JobApplication::where('user_id', $user_id)
    //                                     ->where('job_id', $job_id)
    //                                     ->exists();

    //     if ($alreadyApplied) {
    //         return back()->with('error', 'You have already applied to this job.');
    //     }

    //     // ✅ Store the application
    //     JobApplication::create([
    //         'user_id' => $user_id,
    //         'job_id' => $job_id,
    //         'status' => 'pending',
    //     ]);

    //     return back()->with('success', 'Your application has been submitted successfully!');
    // }

    public function applyjob(Request $request, $job_id)
    {
        // ✅ Get the authenticated user ID
        $user_id = Auth::user()->id;
        // $user_id = 3;

        // ✅ Check if the job exists and is still active
        $today = Carbon::today();
        $job   = JobPost::where('status', 1)
            ->whereDate('jobexpiry', '>=', $today)
            ->where('id', $job_id)
            ->firstOrFail();

        // ✅ Check if the user already applied to this job
        $alreadyApplied = JobApplication::where('user_id', $user_id)
            ->where('job_id', $job_id)
            ->exists();

        if ($alreadyApplied) {
            return back()->with('error', 'You have already applied to this job.');
        }

        // ✅ Store the application
        JobApplication::create([
            'user_id' => $user_id,
            'job_id'  => $job_id,
            'status'  => 'pending',
        ]);

        return back()->with('success', 'Your application has been submitted successfully!');
    }

    public function appliedjob()
    {

        // $userId = Auth::user()->id;
        // $appliedjob = JobApplication::with([
        //     'user:id,name,email',
        //     'jobPost:id,title',
        // ])->select(['id', 'user_id', 'job_id', 'status', 'created_at']);
        // // dd($userId,$appliedjob);

        $userId     = Auth::user()->id;
        // dd($userId);
        $appliedjob = JobApplication::where('user_id', $userId)
            ->where('status', 'pending')
            ->get();

        // Extract the job IDs from the applications
        $jobIds = $appliedjob->pluck('job_id')->all();

        // Now paginate over all job posts with these IDs
        $jobDetails = JobPost::whereIn('id', $jobIds)
            ->paginate(1)
            ->withQueryString();
            // dd($jobDetails);

        // Pass $jobDetails to your view for pagination links and processing

        return view('User.UserDash.AppliedJob', compact('jobDetails'));
    }

    public function ShortList()
    {
        // $user_id = Auth::user()->id;
        // $ShortList                          = JobApplication::where('user_id', $user_id)
        //     ->where('status', 'shortlisted')
        //     ->get();
        $userId     = Auth::user()->id;
        $appliedjob = JobApplication::where('user_id', $userId)
            ->where('status', 'shortlisted')
            ->get();

        // Extract the job IDs from the applications
        $jobIds = $appliedjob->pluck('job_id')->all();

        // Now paginate over all job posts with these IDs
        $jobDetails = JobPost::whereIn('id', $jobIds)
            ->paginate(1)
            ->withQueryString();

        // Pass $jobDetails to your view for pagination links and processing

        return view('User.UserDash.ShortlistJob', compact('jobDetails'));

    }

    public function GetSavedJob()
    {
        $userId = Auth::id();

        // Assuming there is a 'job' relationship in your SaveJob model
        $savedJobs = SaveJob::with('jobPost')->where('user_id', $userId)->get()->toArray();
        // dd($savedJobs);

        return view('User.UserDash.SavedJob', compact('savedJobs'));
    }
}
