<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\JobPost;

class DashboardController extends Controller
{

  

    public function dashboard() {
        return view('admin.dashboard');
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
            if ($user->logo && file_exists(public_path('admin/' . $user->logo))) {
                unlink(public_path('admin/' . $user->logo));
            }
            
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin/logo/'), $imageName);
            $user->logo = 'logo/' . $imageName;
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
