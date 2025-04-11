<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\JobCategory;
use App\Models\JobLocation;
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

        if($request->has('location') && $request->location !== '') { 
            $query->where('location', $request->location);
        }

        $jobs = $query->paginate(2)->withQueryString(); // Adjust pagination as needed
        $JobCategory = JobCategory::all();
        // dd($jobs);

        $JobLocation = JobLocation::all(); 

        return view('User.JobList', compact('jobs', 'JobCategory', 'JobLocation'));
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
