<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\JobCategory;

class JobController extends Controller
{
    public function JobList(Request $request)
    {

        dd($request->all());
        $query = JobPost::where('status', 1);
    
        // Filter by category if selected
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
    
        $jobs = $query->paginate(2); // Adjust pagination as needed
        $JobCategory = JobCategory::all();
    
        return view('User.JobList', compact('jobs', 'JobCategory'));
    }
    




}
