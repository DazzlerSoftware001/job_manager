<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recruiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\JobPost;
use App\Models\JobApplication;



class DashboardController extends Controller
{
    public function dashboard() {

        $appliedCount = JobApplication::where('status', 'pending')->count();
        $shortlistedCount = JobApplication::where('status', 'shortlisted')->count();
        $hiredCount = JobApplication::where('status', 'hired')->count();

        return view('recruiter.dashboard',compact('appliedCount','shortlistedCount','hiredCount'));
    }

    public function getDashboardData() {
        // Get user and job counts
        $userCount = User::where('user_type', 0)->count();
        $jobCount = JobPost::count();

        $user = Auth::user();

        return response()->json([
            'userCount' => $userCount,
            'jobCount' => $jobCount,
            'logo' => $user->logo,
            'name' => $user->name,
            'email' => $user->email
        ]);
    }

    public function updateProfileImage (Request $request) {
        $user = Auth::user();

        if ($request->hasFile('image')) {
            if ($user->logo && file_exists(public_path( $user->logo))) {
                unlink(public_path( $user->logo));
            }
            
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('recruiter/logo/'), $imageName);
            $user->logo = 'recruiter/logo/' . $imageName;
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
