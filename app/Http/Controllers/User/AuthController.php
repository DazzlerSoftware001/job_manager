<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\User\VerifyEmail;
use App\Models\EmailTemplates;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SignUp;

class AuthController extends Controller
{
    public function register()
    {
        return view('User.Auth.register');
    }

    // public function RegisterUser(Request $request)
    // {
    //     // Define validation rules
    //     $rules = [
    //         'sname'    => 'required|string|max:100',
    //         'lname'    => 'required|string|max:100',
    //         'email'    => 'required|email|unique:users,email',
    //         'password' => 'required|min:6',
    //     ];

    //     // Validate the input
    //     $validator = Validator::make($request->all(), $rules);
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status_code' => 2,
    //             'message'     => $validator->errors()->first(),
    //         ]);
    //     }

    //     try {
    //         // Save the user
    //         $user               = new UserProfile();
    //         $user->user_type    = 0;
    //         $user->user_details = 'User';
    //         $user->name         = $request->sname;
    //         $user->lname        = $request->lname;
    //         $user->email        = $request->email;
    //         $user->password     = bcrypt($request->password); // Hash the password
    //         $user->created_at   = now();
    //         $user->save();

    //         return response()->json([
    //             'status_code'  => 1,
    //             'message'      => 'Registration successful',
    //             'redirect_url' => route('User.login'),

    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status_code' => 0,
    //             'message'     => 'Something went wrong while registering.',
    //         ]);
    //     }
    // }

    // public function RegisterUser(Request $request)
    // {
    //     $rules = [
    //         'sname'    => 'required|string|max:100',
    //         'lname'    => 'required|string|max:100',
    //         'email'    => 'required|email|unique:users,email',
    //         'password' => 'required|min:6|confirmed',
    //     ];

    //     $validator = Validator::make($request->all(), $rules);
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status_code' => 2,
    //             'message'     => $validator->errors()->first(),
    //         ]);
    //     }

    //     try {
    //         $user               = new UserProfile();
    //         $user->user_type    = 0;
    //         $user->user_details = 'User';
    //         $user->name         = $request->sname;
    //         $user->lname        = $request->lname;
    //         $user->email        = $request->email;
    //         $user->password     = bcrypt($request->password);
    //         $user->created_at   = now();

    //         // Generate OTP
    //         $otp = rand(100000, 999999);

    //         // Save OTP and expiration time
    //         $user->otp_email         = $otp;
    //         $user->email_verified_at = now()->addMinutes(5);

    //         $user->save();

    //         // Send OTP email
    //         Mail::to($user->email)->send(new VerifyEmail($otp));

    //         return response()->json([
    //             'status_code' => 1,
    //             'message'     => 'OTP sent to your email.',
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status_code' => 0,
    //             'message'     => 'Something went wrong while registering.',
    //         ]);
    //     }
    // }

    public function RegisterUser(Request $request)
    {
        $rules = [
            'sname'    => 'required|string|max:100',
            'lname'    => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 2,
                'message'     => $validator->errors()->first(),
            ]);
        }

        try {
            DB::beginTransaction(); // Start DB transaction

            $user               = new UserProfile();
            $user->user_type    = 0;
            $user->user_details = 'User';
            $user->name         = $request->sname;
            $user->lname        = $request->lname;
            $user->email        = $request->email;
            $user->password     = bcrypt($request->password);
            $user->created_at   = now();

            // Generate OTP
            $otp                     = rand(100000, 999999);
            $user->otp_email         = $otp;
            $user->email_verified_at = now()->addMinutes(5);

            if (! $user->save()) {
                DB::rollBack();
                return response()->json([
                    'status_code' => 0,
                    'message'     => 'Failed to register user.',
                ]);
            }

            // Fetch email template for rejection (assume ID 11 is for rejection emails)
            $template = EmailTemplates::find(24);

            // if ($template && $template->show_email == '1') {
            try {
                Mail::to($user->email)->send(new VerifyEmail($otp));

                $adminProfile = UserProfile::where('user_type', 1)->where('user_details', 'Admin')->first();
                if ($adminProfile) {
                    $adminProfile->notify(new SignUp($user));
                }

            } catch (\Exception $mailException) {
                DB::rollBack();
                Log::error('Registration email send failed: ' . $mailException->getMessage());
                return response()->json([
                    'status_code' => 0,
                    'message'     => 'Registration failed while sending email.',
                ]);
            }
            // }

            DB::commit();

            return response()->json(['status_code' => 1, 'message' => 'OTP sent to your email.']);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in RegisterUser: ' . $e->getMessage());
            return response()->json([
                'status_code' => 0,
                'message'     => 'Something went wrong while registering.',
            ]);
        }
    }

    

    public function verifyOtp(Request $request)
    {
        $email = $request->email;
        $otp   = $request->otp;

        $user = UserProfile::where('email', $email)
            ->where('otp_email', $otp)
            ->where('email_verified_at', '>=', now())
            ->first();

        if ($user) {
            $user->email_verified_at = now(); // confirmed
            $user->otp_email         = null;  // clear OTP
            $user->email_verified    = '1';
            $user->save();

            // Prepare inline HTML welcome email
            //     $emailBody = "
            //     <h2>Hello {$user->name} {$user->lname},</h2>
            //     <p>Your email has been successfully verified!</p>
            //     <p>Welcome to our platform. We're excited to have you on board.</p>
            //     <p>If you have any questions or need support, feel free to contact us anytime.</p>
            //     <p>Regards,<br>The Team</p>
            // ";

            //     // Send welcome email
            //     Mail::send([], [], function ($message) use ($user, $emailBody) {
            //         $message->to($user->email)
            //             ->subject('Welcome! Your Email Has Been Verified')
            //             ->html($emailBody);
            //     });

            return response()->json([
                'status_code'  => 1,
                'message'      => 'Email verified successfully!',
                'redirect_url' => route('User.login'), // or home
            ]);
        } else {
            return response()->json([
                'status_code' => 0,
                'message'     => 'Invalid or expired OTP.',
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
        $rules = [
            'email'    => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 2,
                'message'     => $validator->errors()->first(),
            ]);
        }

        try {
            $credentials = $request->only('email', 'password');
            $remember    = $request->has('remember'); // true if checkbox is checked

            if (Auth::attempt($credentials, $remember)) {
                $user = Auth::user();

                if ($user->user_type == 0 && $user->email_verified == 1) {
                    $redirectUrl = session()->pull('url.intended', route('User.Dashboard'));

                    return response()->json([
                        'status_code'  => 1,
                        'message'      => 'Login Successful',
                        'redirect_url' => $redirectUrl,
                    ]);
                } else {
                    Auth::logout();
                    return response()->json([
                        'status_code' => 2,
                        'message'     => 'Email not verified or user type mismatch.',
                    ]);
                }
            } else {
                return response()->json([
                    'status_code' => 2,
                    'message'     => 'Invalid credentials',
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return response()->json([
                'status_code' => 0,
                'message'     => 'Something went wrong during login.',
            ]);
        }
    }

    // public function logout(Request $request)
    // {
    //     $request->session()->flush(); // Clear all session data
    //     return response()->json([
    //         'status_code'  => 1,
    //         'message'      => 'Logout successful',
    //         'redirect_url' => route('User.Home'),
    //     ]);
    // }

    public function logout(Request $request)
    {
        // If user is logged in
        if (Auth::check()) {
            // Remove remember_token from DB
            $user = Auth::user();
            $user->setRememberToken(null);
            $user->save();

            // Log out
            Auth::logout();
        }

        // Clear all session data
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'status_code'  => 1,
            'message'      => 'Logout successful',
            'redirect_url' => route('User.Home'),
        ]);
    }
}
