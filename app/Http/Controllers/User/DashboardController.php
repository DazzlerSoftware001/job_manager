<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Dashboard()
    {
        return view('User.Dasboard');
    }

    public function Profile() {
        return view('User.UserDash.Profile');
    }

    public function ProfileInsert(Request $request)
    {
  
        // Define validation rules
        $rules = [
            'logo' => 'required|image|max:2048',
            'name' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|digits_between:10,15|unique:users,phone',
            'dob' => 'required',
            'gender' => 'required',
            'education_level' => 'required',
            'qualification' => 'required',
            'branch' => 'required',
            'lang' => 'required',
            'experience' => 'required',
            'show' => 'required',
            'description' => 'required',
            'social_link' => 'required',
            'Country' => 'required',
            'State' => 'required',
            'address' => 'required|string|min:10|max:255',
            'ps' => 'required',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            try {

                if ($request->hasFile('logo')) {
                    $logo = $request->file('logo');
                    $logoName = time() . '.' . $logo->getClientOriginalExtension(); 
                    $logo->move(public_path('company/logo'), $logoName);
                    $logoPath = ('company/logo/'. $logoName);
                }

                $Companies = new Companies();
                $Companies->name = $request->input('name');
                $Companies->email = $request->input('email');
                $Companies->phone = $request->input('phone');
                $Companies->website = $request->input('website');
                $Companies->details = $request->input('details');
                $Companies->address = $request->input('address');
                $Companies->logo = $logoPath;
                $Companies->status = 0;
                $Companies->created_at = now();

                $Companies->save();

                return response()->json(['status_code' => 1, 'message' => 'Company created successfully']);
            } catch (\Exception $e) {
                // Handle any exception that occurs during saving
                return response()->json(['status_code' => 0, 'message' => 'Unable to add data']);
            }
        } else {
            // Return validation errors
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }
}
