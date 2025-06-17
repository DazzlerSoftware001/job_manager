<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\JobPost;
use App\Models\Recruiter;
use App\Models\UserProfile;
use App\Models\JobApplication;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{

  

    public function dashboard() {

        $currentWeek = collect();
        $previousWeek = collect();

            foreach (range(0, 6) as $i) {
                // Current week
                $day = Carbon::now()->startOfWeek()->addDays($i);
                

                $count = UserProfile::where('user_type', 0)->whereDate('created_at', $day)->count();
                $currentWeek->push($count);

                // Previous week
                $prevDay = Carbon::now()->subWeek()->startOfWeek()->addDays($i);
                $prevCount = UserProfile::where('user_type', 0)
                    ->whereDate('created_at', $prevDay)
                    ->count();
                $previousWeek->push($prevCount);

             
            }

            $totalThisMonth = UserProfile::where('user_type', 0)
            ->whereMonth('created_at', now()->month)
            ->count();

            $recentJob = JobPost::select('id', 'title','role','location','min_exp','max_exp','education')
                ->where('admin_verify', 1)->where('status', 1)->latest()->take(10)->get();

            $RecentApplicant = JobApplication::with([
                'user:id,name,lname,email,phone,logo,education_level,qualification,branch,city,experience',
                'user.candidateProfile:skill',
                'jobPost:id,title',
            ])
            ->select(['id', 'user_id', 'job_id', 'status', 'recruiter_view', 'created_at'])->latest()->take(10)->get();


            $tomorrow = Carbon::tomorrow(); // Gets tomorrow's date

            $jobExpiry = JobPost::where('admin_verify', 1)
                ->where('status', 1)
                ->whereDate('jobexpiry', $tomorrow)
                ->get();

             $weeklyApplications = [];

    // Loop through each day of the current week (Monday to Sunday)
    foreach (range(0, 6) as $i) {
        $date = Carbon::now()->startOfWeek()->addDays($i)->startOfDay();
        $nextDate = (clone $date)->endOfDay();

        $count = JobApplication::whereBetween('created_at', [$date, $nextDate])->count();

        $weeklyApplications[] = [
            'x' => $date->toDateString(), // For x-axis (date)
            'y' => $count                // Number of applications
        ];
    }

            $JobApplicationMonth = JobApplication::whereMonth('created_at', now()->month)->count();

            $JobApplicationYear = JobApplication::whereYear('created_at', now()->year)->count();


        return view('admin.dashboard',compact('currentWeek','previousWeek','totalThisMonth','recentJob','RecentApplicant','jobExpiry','weeklyApplications','JobApplicationMonth','JobApplicationYear'));
    }

    public function getDashboardData() {
        // Get user and job counts
        $userCount = User::where('user_type', 0)->count();
        $jobCount = JobPost::count();

        $user = Auth::user();
        $RecruiterCount = Recruiter::where('user_type', 2)->count();

        // for user activity
           
        // 

        return response()->json([
            'userCount' => $userCount,
            'jobCount' => $jobCount,
            'logo' => $user->logo,
            'name' => $user->name,
            'email' => $user->email,
            'RecruiterCount' => $RecruiterCount,
            
        ]);


       
    }

    public function updateProfileImage (Request $request) {
        $user = Auth::user();

        if ($request->hasFile('image')) {
            if ($user->logo && file_exists(public_path( $user->logo))) {
                unlink(public_path( $user->logo));
            }
            
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin/logo/'), $imageName);
            $user->logo = 'admin/logo/' . $imageName;
            $user->save();
            return response()->json(['status_code' => 1,'message' => 'Image updated successfully', 'image' => $user->logo]);
        }
    
        return response()->json(['status_code' => 2,
                  'message' => 'Failed to update image'], 400);
    }

    public function updateProfileName(Request $request) {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $user->name = $request->name;
        $user->save();
    
        return response()->json(['success' => true, 'message' => 'Name updated successfully']);
    }
    



}
