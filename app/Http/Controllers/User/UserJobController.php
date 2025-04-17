<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\JobApplication;
use Illuminate\Support\Carbon;
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
        // $user_id = Auth::id();
        $user_id =3;


        // ✅ Check if the job exists and is still active
        $today = Carbon::today();
        $job = JobPost::where('status', 1)
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
            'job_id' => $job_id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your application has been submitted successfully!');
    }

    public function appliedjob() {
        return view('User.UserDash.AppliedJob');
    }

    public function ShortList()
    {   $user_id = Auth::user()->id;
        $ShortList=JobApplication::where('user_id', $user_id)
            ->where('status','shortlisted')
            ->get();
        
    }
}
