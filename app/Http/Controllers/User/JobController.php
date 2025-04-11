<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

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
        $type       = JobPost::select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->get();

        $experience = JobPost::select('max_exp', DB::raw('count(*) as count'))
        ->groupBy('max_exp')
        ->get();

        // $data = JobPost::all();
        // dd($type);

        return view('User.JobList', compact('jobs', 'industries', 'type', 'experience'));
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
