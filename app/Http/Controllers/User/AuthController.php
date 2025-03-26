<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
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
            
            if ($user->user_type == 0) {
                return response()->json([
                    'status_code' => 1,
                    'message' => 'Login Successful',
                    // 'redirect_url' => route('User.dashboard')
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
            'redirect_url' => route('User.Home')
        ]);
    }
}
