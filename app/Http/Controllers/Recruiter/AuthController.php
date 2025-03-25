<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recruiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        return view('recruiter.login');
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
            
            if ($user->user_type == 2) {
                return response()->json([
                    'status_code' => 1,
                    'message' => 'Login Successful As Recruiter',
                    'redirect_url' => route('Recruiter.dashboard')
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
            'redirect_url' => route('Recruiter.login')
        ]);
    }
}
