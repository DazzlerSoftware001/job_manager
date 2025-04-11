<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\JobCategory;
use Illuminate\Support\Facades\Crypt;

class JobController extends Controller
{

    public function JobList(Request $request)
    {
        $query = JobPost::where('status', 1);

        // Filter by category if selected
        if ($request->has('category') && $request->category !== '') {
            $query->where('industry', $request->category);
        }

        $jobs = $query->paginate(2); // Adjust pagination as needed
        // $JobCategory = JobCategory::all();
        $industries = JobPost::distinct()->pluck('industry');
        $type = JobPost::distinct()->pluck('type');
        // $data = JobPost::all();
        // dd($type);

        return view('User.JobList', compact('jobs','industries','type'));
    }

    public function JobDetails($id) {

        // dd($id);
        $decryptedId = Crypt::decrypt($id);
        $job = JobPost::find($decryptedId);
// dd($job);
        if (!$job) {
            return redirect()->back()->with('error', 'Job not found!');
        }

        return view('User.JobDetails', compact('job'));
    }

  
    


    




}
