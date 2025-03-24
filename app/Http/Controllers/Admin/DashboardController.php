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

  public function login() {
    return view('admin.login');
  }

  public function loginInsert(Request $request)
  {
      // Define validation rules
      $rules = [
          'email' => 'required|email',
          'password' => 'required',
      ];

      // Validate the input
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
          return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
      }

      $credentials = $request->only('email', 'password');

      if (Auth::attempt($credentials)) {
          $user = Auth::user(); 
          
          if ($user->user_type == 1) {
              return response()->json([
                  'status_code' => 1,
                  'message' => 'Login Successful As Admin',
                  'redirect_url' => route('Admin.dashboard')
              ]);
          }            
          else
          {
              return response()->json([
                  'status_code' => 2,
                  'message' => 'Somethis went Wrong',
                
              ]);
          }
      } else {
          return response()->json(['status_code' => 2, 'message' => 'Invalid credentials']);
      }
  }

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
            'name' => $user->name
        ]);
    }

    public function updateProfileImage (Request $request) {
        $user = Auth::user();

        if ($request->hasFile('image')) {
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
    


  public function logout(Request $request) {
    $request->session()->flush(); // Clear all session data
    return response()->json([
        'status_code' => 1,
        'message' => 'Logout successful',
        'redirect_url' => route('Admin.login')
    ]);
}
}
