<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
class DashboardController extends Controller
{
    public function Dashboard()
    {
        return view('User.Dasboard');
    }

    // public function Profile()
    // {

    //     // Getting country code
    //     $response = Http::get('https://restcountries.com/v3.1/all');

    //     if ($response->failed()) {
    //         abort(500, 'Failed to fetch country data');
    //     }
        
    //     $data = collect($response->json());
        
    //     // Get countries with dial codes
    //     $countries = $data->map(function ($country) {
    //         return [
    //             'name' => $country['name']['common'] ?? '',
    //             'code' => $country['cca2'] ?? '',
    //             'dial_code' => ($country['idd']['root'] ?? '') . ($country['idd']['suffixes'][0] ?? ''),
    //             'flag' => $country['flag'] ?? '',
    //         ];
    //     })->filter(function ($country) {
    //         return !empty($country['dial_code']);
    //     });
        
    //     // Get all unique languages
    //     $languages = $data->flatMap(function ($country) {
    //         return $country['languages'] ?? [];
    //     })->unique()->sort()->values();
        
    //     $user = UserProfile::find(Auth::user()->id);

    //     $countryList = $data->map(function ($country) {
    //         return [
    //             'name' => $country['name']['common'] ?? '',
    //             'code' => $country['cca2'] ?? '',
    //             'flag' => $country['flag'] ?? '',
    //         ];
    //     })->sortBy('name')->values();
        
    //     return view('User.UserDash.Profile', compact('user', 'countries', 'languages','countryList'));
        
    // }
    public function Profile()
    {
        $user = UserProfile::find(Auth::id());
    
        return view('User.UserDash.Profile', compact('user'));
    }

    public function updateProfileImage(Request $request)
    {
        $user = Auth::user();

        // Validate the image input
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // max 2MB
        ]);

        if ($request->hasFile('image')) {
            if ($user->logo && file_exists(public_path('user/assets/img/' . $user->logo))) {
                unlink(public_path('user/assets/img/' . $user->logo));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('user/assets/img/profile/'), $imageName);
            $user->logo = 'profile/' . $imageName;
            $user->save();
            return response()->json(['status_code' => 1, 'message' => 'Image updated successfully', 'image' => $user->logo]);
        }

        return response()->json(['status_code' => 2,'message'=> 'Failed to update image'], 400);
    }

    public function updateProfile(Request $request)
    {
        // dd($request->all());
        $rules = [
            'name'            => 'required|string|max:255',
            'lname'           => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'country_code'    => 'required',
            // 'phone'           => 'required|digits_between:10,15',
            'dob'             => 'required|date',
            'gender'          => 'required|in:Male,Female',
            'education_level' => 'required',
            'qualification'   => 'required',
            'branch'          => 'nullable',
            'lang'            => 'required|array',
            'exp_year'        => 'required',
            'exp_months'      => 'required',
            'jobSearch'       => 'required',
            'description'     => 'required|string',
            'social_link'     => 'required|array',
            'social_name'     => 'required|array',
            'country'         => 'required',
            'address'         => 'required|string|min:10|max:255',
            'state'           => 'required',
            'postalCode'      => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
       

        if (!$validator->fails()) {

           
            $profile = UserProfile::where('id', Auth::id())->first();

            if (! $profile) {
                return response()->json(['status_code' => 0, 'message' => 'Profile not found']);
            }
            // dd($request->all());

            $years  = $request->input('exp_year');
            $months = $request->input('exp_months');
            // dd($years,$months);

            if (!empty($months) && $months > 0) {
                // Ensure months like '5' becomes '05'
                $formattedMonths = str_pad($months, 2, '0', STR_PAD_LEFT);
                $profile->experience = floatval($years . '.' . $formattedMonths);
            } else {
                $profile->experience = floatval($years);
            }


            $profile->name            = $request->input('name');
            $profile->lname           = $request->input('lname');
            $profile->email           = $request->input('email');
            $profile->phone           = $request->input('phone.code') . $request->input('phone.number');
            $profile->date_of_birth   = $request->input('dob');
            $profile->gender          = $request->input('gender');
            $profile->education_level = $request->input('education_level');
            $profile->qualification   = $request->input('qualification');
            $profile->branch          = $request->input('branch');  
            $profile->language        = json_encode($request->input('lang'));
            // $profile->experience      = $years . $months;
            $profile->look_job        = $request->input('jobSearch');
            $profile->description     = $request->input('description');
            $profile->social_links    = json_encode($request->input('social_link'));
            $profile->country         = $request->input('country');
            $profile->state           = $request->input('state');
            $profile->address         = $request->input('address');
            $profile->postal_code     = $request->input('ps');
            $profile->updated_at      = now(); // update timestamp

            $profile->save();

            return response()->json(['status_code' => 1, 'message' => 'Profile updated successfully']);
            

        }else{
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);

        }

        
    }

    public function ChangePassword()
    {
        return view('User.UserDash.ChangePassword');
    }

    public function UpdatePassword(Request $request)
    {
        // dd($request->all());
            $rules = [
                'password' => 'required|string|min:8|confirmed',
            ];

            $validator = Validator::make($request->all(),$rules);

            if(!$validator->fails())
            {

                $userId =Auth::id(); 
                $user = UserProfile::find($userId);

                if($user !=null)
                { 
                    $user->password = Hash::make($request->password);
                    $user->save();
            
                    return response()->json(['status_code' => 1,'message'=> 'Password Changed Succesfully','redirect_url' => route('User.login')
            
                    ]);
                }else{
                    return response()->json(['status_code' => 2,'message'=> 'Not found']);
                }

            }else{
                return response()->json(['status_code' => 2,'message'=> $validator->errors()->first()]);
            }
    }

}
