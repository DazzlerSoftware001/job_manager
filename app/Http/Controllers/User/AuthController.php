<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register()
    {
        return view('User.Auth.register');
    }

    public function RegisterUser(Request $request)
    {
        // Define validation rules
        $rules = [
            'sname'    => 'required|string|max:100',
            'lname'    => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ];

        // Validate the input
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 2,
                'message'     => $validator->errors()->first(),
            ]);
        }

        try {
            // Save the user
            $user               = new UserProfile();
            $user->user_type    = 0;
            $user->user_details = 'User';
            $user->name         = $request->sname;
            $user->lname        = $request->lname;
            $user->email        = $request->email;
            $user->password     = bcrypt($request->password); // Hash the password
            $user->created_at   = now();
            $user->save();

            return response()->json([
                'status_code'  => 1,
                'message'      => 'Registration successful',
                'redirect_url' => route('User.login'),

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 0,
                'message'     => 'Something went wrong while registering.',
            ]);
        }
    }

    public function login()
    {
        session(['url.intended' => url()->previous()]);
        return view('User.Auth.login');
    }

    public function loginInsert(Request $request)
    {
        // Define validation rules
        $rules = [
            'email'    => 'required|email',
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
                $redirectUrl = session()->pull('url.intended', route('User.Dashboard'));

                return response()->json([
                    'status_code'  => 1,
                    'message'      => 'Login Successful',
                    'redirect_url' => $redirectUrl,
                ]);
            } else {
                return response()->json([
                    'status_code' => 2,
                    'message'     => 'Somethis went Wrong',

                ]);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Invalid credentials']);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush(); // Clear all session data
        return response()->json([
            'status_code'  => 1,
            'message'      => 'Logout successful',
            'redirect_url' => route('User.Home'),
        ]);
    }
}
