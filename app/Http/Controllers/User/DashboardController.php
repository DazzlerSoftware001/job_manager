<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function Dashboard()
    {
        return view('User.Dasboard');
    }

    public function Profile()
    {
        return view('User.UserDash.Profile');
    }

    public function updateProfileImage(Request $request)
    {
        // dd('dcs');
        $user = Auth::user();

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Optional: delete old image if not default
            if ($user->logo && $user->logo != 'profile/default.png') {
                $oldImage = public_path('user/assets/img/' . $user->logo);
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }

            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('user/assets/img/profile/'), $imageName);

            $user->logo = 'profile/' . $imageName;
            $user->save();

            return response()->json([
                'status_code' => 1,
                'message'     => 'Image updated successfully',
                'image'       => $user->logo,
            ]);
        }

        return response()->json([
            'status_code' => 2,
            'message'     => 'No image file received',
        ], 400);
    }

    public function ProfileInsert(Request $request)
    {
        $rules = [
            'name'            => 'required|string|max:255',
            'lname'           => 'required|string|max:255',
            'email'           => 'required|email|max:255|unique:users,email',
            'phone'           => 'required|digits_between:10,15|unique:users,phone',
            'dob'             => 'required|date',
            'gender'          => 'required',
            'education_level' => 'required',
            'qualification'   => 'required',
            'branch'          => 'required',
            'lang'            => 'required|array',
            'experience'      => 'required',
            'show'            => 'required',
            'description'     => 'required|string',
            'social_link'     => 'required|array',
            'Country'         => 'required',
            'State'           => 'required',
            'address'         => 'required|string|min:10|max:255',
            'ps'              => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }

        try {
            $profile                = new UserProfile();
            $profile->name          = $request->input('name');
            $profile->lname         = $request->input('lname');
            $profile->email         = $request->input('email');
            $profile->phone         = $request->input('phone');
            $profile->dob           = $request->input('dob');
            $profile->gender        = $request->input('gender');
            $profile->education     = $request->input('education_level');
            $profile->qualification = $request->input('qualification');
            $profile->branch        = $request->input('branch');
            $profile->languages     = json_encode($request->input('lang'));
            $profile->experience    = $request->input('experience');
            $profile->job_ready     = $request->input('show');
            $profile->description   = $request->input('description');
            $profile->social        = json_encode($request->input('social_link'));
            $profile->country       = $request->input('Country');
            $profile->state         = $request->input('State');
            $profile->address       = $request->input('address');
            $profile->postal_code   = $request->input('ps');
            $profile->created_at    = now();
            $profile->save();

            return response()->json(['status_code' => 1, 'message' => 'Profile created successfully']);
        } catch (\Exception $e) {
            return response()->json(['status_code' => 0, 'message' => 'Unable to add data']);
        }
    }

}
