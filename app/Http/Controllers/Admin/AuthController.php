<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\JobPost;

class AuthController extends Controller
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

    public function logout(Request $request) {
        $request->session()->flush(); // Clear all session data
        return response()->json([
            'status_code' => 1,
            'message' => 'Logout successful',
            'redirect_url' => route('Admin.login')
        ]);
    }
}
