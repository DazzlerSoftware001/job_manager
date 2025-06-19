<?php
namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // $appliedCount = JobApplication::with('jobPost:id,recruiter_id')->where('jobPost.recruiter_id', Auth::user()->id)->where('status', 'pending')->count();
        $appliedCount = JobApplication::whereHas('jobPost', function ($query) {
            $query->where('recruiter_id', Auth::id());
        })->where('status', 'pending')->count();
        $shortlistedCount = JobApplication::whereHas('jobPost', function ($query) {
            $query->where('recruiter_id', Auth::id());
        })->where('status', 'shortlisted')->count();
        $hiredCount       = JobApplication::whereHas('jobPost', function ($query) {
            $query->where('recruiter_id', Auth::id());
        })->where('status', 'hired')->count();

        $currentWeek = collect();
        $previousWeek = collect();

        foreach (range(0, 6) as $i) {
            // Current week
            $day = Carbon::now()->startOfWeek()->addDays($i);
            // dd($day);
            

            $count = JobApplication::whereDate('created_at', $day)->count();
            $currentWeek->push($count);

            // Previous week
            $prevDay = Carbon::now()->subWeek()->startOfWeek()->addDays($i);
            // $prevCount = UserProfile::where('user_type', 0)
            //     ->whereDate('created_at', $prevDay)
            //     ->count();
            $prevCount = JobApplication::whereDate('created_at', $prevDay)->count();
            $previousWeek->push($prevCount);

            
        }

        $totalThisMonth = JobApplication::whereMonth('created_at', now()->month)->count();

        $recentJob = JobPost::select('id', 'title','role','location','min_exp','max_exp','education')->where('recruiter_id', Auth::id())
                ->where('admin_verify', 1)->where('status', 1)->latest()->take(10)->get();

        $RecentApplicant = JobApplication::with([
            'user:id,name,lname,email,phone,logo,education_level,qualification,branch,city,experience',
            'user.candidateProfile:skill,user_id',
            'jobPost:id,title'
        ])
        ->whereHas('jobPost', function ($query) {
            $query->where('recruiter_id', Auth::id());
        })
        ->select(['id', 'user_id', 'job_id', 'status', 'recruiter_view', 'created_at'])
        ->latest()
        ->take(10)
        ->get();

        $tomorrow = Carbon::tomorrow();     // One day before expiry
        $today = Carbon::today();           // For comparison to find expired jobs

        $jobExpiry = JobPost::where('admin_verify', 1)
            ->where('recruiter_id', Auth::id())
            ->where('status', 1)
            ->where(function ($query) use ($tomorrow, $today) {
                $query->whereDate('jobexpiry', $tomorrow)
                    ->orWhereDate('jobexpiry', '<=', $today);
            })
            ->get();
        // dd($jobExpiry);

        return view('recruiter.dashboard', compact('appliedCount', 'shortlistedCount', 'hiredCount', 'currentWeek','previousWeek','totalThisMonth', 'recentJob','RecentApplicant','jobExpiry'));
    }

    public function getDashboardData()
    {
        // Get user and job counts
        $userCount = User::where('user_type', 0)->count();
        $jobCount  = JobPost::count();

        $user = Auth::user();

        return response()->json([
            'userCount' => $userCount,
            'jobCount'  => $jobCount,
            'logo'      => $user->logo,
            'name'      => $user->name,
            'email'     => $user->email,
        ]);
    }

    public function updateProfileImage(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('image')) {
            if ($user->logo && file_exists(public_path($user->logo))) {
                unlink(public_path($user->logo));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('recruiter/logo/'), $imageName);
            $user->logo = 'recruiter/logo/' . $imageName;
            $user->save();
            return response()->json(['status_code' => 1, 'message' => 'Image updated successfully', 'image' => $user->logo]);
        }

        return response()->json(['status_code' => 2,
            'message'                              => 'Failed to update image'], 400);
    }

    public function updateProfileName(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user->name = $request->name;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Name updated successfully']);
    }

}
