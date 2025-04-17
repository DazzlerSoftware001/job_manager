<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function Dashboard()
    {
        return view('User.Dasboard');
    }

    public function Profile()
    {
        $user = UserProfile::find(Auth::user()->id);

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

        return response()->json(['status_code' => 2,
            'message'                              => 'Failed to update image'], 400);
    }

    public function updateProfile(Request $request)
    {
        $rules = [
            'name'            => 'required|string|max:255',
            'lname'           => 'required|string|max:255',
            'email'           => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'phone'           => 'required|digits_between:10,15|unique:users,phone,' . Auth::id(),
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

        // try {
            $profile = UserProfile::where('id', Auth::id())->first();

            if (! $profile) {
                $profile     = new UserProfile();
                $profile->id = Auth::id(); // Set user ID if primary key
            }

            $profile->name          = $request->input('name');
            $profile->lname         = $request->input('lname');
            $profile->email         = $request->input('email');
            $profile->phone         = $request->input('phone');
            $profile->date_of_birth           = $request->input('dob');
            $profile->gender        = $request->input('gender');
            $profile->education_level     = $request->input('education_level');
            $profile->qualification = $request->input('qualification');
            $profile->branch        = $request->input('branch');
            $profile->language     = json_encode($request->input('lang'));
            $profile->experience    = $request->input('experience');
            $profile->look_job     = $request->input('show');
            $profile->description   = $request->input('description');
            $profile->social_links        = json_encode($request->input('social_link'));
            $profile->country       = $request->input('Country');
            $profile->state         = $request->input('State');
            $profile->address       = $request->input('address');   
            $profile->postal_code   = $request->input('ps');
            $profile->updated_at    = now(); // update timestamp

            $profile->save();

            return response()->json(['status_code' => 1, 'message' => 'Profile updated successfully']);
        // } catch (\Exception $e) {
        //     return response()->json(['status_code' => 0, 'message' => 'Unable to update profile']);
        // }
    }

}
