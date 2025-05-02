<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CandidateAward;
use App\Models\CandidateEmployment;
use App\Models\CandidateProfile;
use App\Models\CandidateQualifications;
use App\Models\JobApplication;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function Dashboard()
    {
        $userId          = Auth::id();
        $appliedJobCount = JobApplication::where('user_id', $userId)->count();

        $ShortlistedJobCount = JobApplication::where('user_id', $userId)->where('status', 'shortlisted')->count();

        $viewProfile = CandidateProfile::where('user_id', $userId)->sum('view_profile');

        return view('User.Dasboard', compact('appliedJobCount', 'ShortlistedJobCount', 'viewProfile'));
    }

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
            if ($user->logo && file_exists(public_path($user->logo))) {
                unlink(public_path($user->logo));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('user/assets/img/profile/'), $imageName);
            $user->logo = 'user/assets/img/profile/' . $imageName;
            $user->save();
            return response()->json(['status_code' => 1, 'message' => 'Image updated successfully', 'image' => $user->logo]);
        }

        return response()->json(['status_code' => 2, 'message' => 'Failed to update image'], 400);
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
            'city'            => 'required|string',
            'postalCode'      => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {

            $profile = UserProfile::where('id', Auth::id())->first();

            if (! $profile) {
                return response()->json(['status_code' => 0, 'message' => 'Profile not found']);
            }
            // dd($request->all());

            $years  = $request->input('exp_year');
            $months = $request->input('exp_months');
            // dd($years,$months);

            if (! empty($months) && $months > 0) {
                // Ensure months like '5' becomes '05'
                $formattedMonths     = str_pad($months, 2, '0', STR_PAD_LEFT);
                $profile->experience = floatval($years . '.' . $formattedMonths);
            } else {
                $profile->experience = floatval($years);
            }

            $socialNames = $request->input('social_name');
            $socialLinks = $request->input('social_link');

            $socialData = [];

            if ($socialNames && $socialLinks) {
                foreach ($socialNames as $index => $name) {
                    $link = $socialLinks[$index] ?? null;
                    if ($name && $link) {
                        $socialData[$name] = $link;
                    }
                }
            }

            $profile->social_links = json_encode($socialData);

            $profile->name  = $request->input('name');
            $profile->lname = $request->input('lname');
            $profile->email = $request->input('email');
            // $profile->phone           = $request->input('phone.code') . $request->input('phone.number');
            $profile->date_of_birth   = $request->input('dob');
            $profile->gender          = $request->input('gender');
            $profile->education_level = $request->input('education_level');
            $profile->qualification   = $request->input('qualification');
            $profile->branch          = $request->input('branch');
            $profile->language        = json_encode($request->input('lang'));
            // $profile->experience      = $years . $months;
            $profile->look_job    = $request->input('jobSearch');
            $profile->description = $request->input('description');
            // $profile->social_links = json_encode($request->input('social_link'));
            $profile->country     = $request->input('country');
            $profile->state       = $request->input('state');
            $profile->city        = $request->input('city');
            $profile->address     = $request->input('address');
            $profile->postal_code = $request->input('postalCode');
            $profile->updated_at  = now(); // update timestamp

            $profile->save();

            return response()->json(['status_code' => 1, 'message' => 'Profile updated successfully']);

        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);

        }

    }

    // resume
    public function resume()
    {
        $id = Auth::user()->id;

        $candidate = CandidateProfile::where('user_id', $id)->first();

        $resumeName = null;
        $resumePath = null;

        if ($candidate && $candidate->resume) {
            $resumeName = basename($candidate->resume);
            $resumePath = asset($candidate->resume);
        }

        $can_exp = CandidateEmployment::where('user_id', $id)->get();

        $educations = CandidateQualifications::where('user_id', $id)->get();

        $awards = CandidateAward::where('user_id', $id)->get();

        return view('User.UserDash.Resume', compact('resumeName', 'resumePath', 'candidate', 'can_exp', 'educations', 'awards'));
    }

    public function UploadResume(Request $request)
    {
        $rules = [
            'resume' => ['required', 'mimes:pdf',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->hasFile('resume')) {
                        $fileName = $request->file('resume')->getClientOriginalName();
                        if (strlen($fileName) > 255) {
                            $fail('The resume file name must not exceed 255 characters.');
                        }
                    }
                },
            ],
        ];

        $valid = Validator::make($request->all(), $rules);

        $user = Auth::user()->only(['id', 'name']);

        if (! $valid->fails()) {

            // Try to find existing profile or create new one
            $candidate = CandidateProfile::where('user_id', $user['id'])->first();

            if (! $candidate) {
                $candidate          = new CandidateProfile();
                $candidate->user_id = $user['id'];
            } else {
                // Delete old resume if it exists
                if ($candidate->resume && file_exists(public_path($candidate->resume))) {
                    unlink(public_path($candidate->resume));
                }
            }

            if ($request->hasFile('resume')) {
                $file     = $request->file('resume');
                $filename = time() . '_' . preg_replace('/\s+/', '_', $user['name']) . '_Resume.pdf';

                $file->move(public_path('user/assets/resume/'), $filename);
                $candidate->resume = 'user/assets/resume/' . $filename;
            }

            $candidate->save();

            return response()->json([
                'status_code' => 1,
                'message'     => 'Resume uploaded successfully',
            ]);

        } else {
            return response()->json([
                'status_code' => 0,
                'message'     => $valid->errors()->first(),
            ]);
        }
    }

    public function UploadCoverLetter(Request $request)
    {
        $rules = [
            'cover_letter' => 'required|string|max:5000',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {

            $user = Auth::user()->id;

            // Find existing candidate profile or create new
            $candidate = CandidateProfile::where('user_id', $user)->first();

            if (! $candidate) {
                $candidate          = new CandidateProfile();
                $candidate->user_id = $user;
            }

            $candidate->cover_letter = $request->cover_letter;
            $candidate->save();

            return response()->json([
                'status_code' => 1,
                'message'     => 'Cover letter Updated successfully.',
            ]);
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function addSkill(Request $request)
    {
        $rules = [
            'skills'   => 'required|array',
            'skills.*' => 'string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {

            $userId    = Auth::id();
            $candidate = CandidateProfile::where('user_id', $userId)->first();

            if (! $candidate) {
                return response()->json([
                    'status_code' => 0,
                    'message'     => 'Candidate profile not found.',
                ]);
            }

            // Normalize existing skills to array
            $candidateSkills = is_array($candidate->skill)
            ? $candidate->skill
            : json_decode($candidate->skill, true);

            if (! is_array($candidateSkills)) {
                $candidateSkills = [];
            }

            // Clean new skills (remove null, empty values)
            $newSkills = array_filter($request->skills, function ($skill) {
                return ! is_null($skill) && $skill !== '';
            });

            // Check for duplicates
            $existingSkills = array_intersect($newSkills, $candidateSkills);

            if ($existingSkills) {
                return response()->json([
                    'status_code' => 0,
                    'message'     => 'Skill Already Exist',
                ]);
            }

            // Merge and make unique
            $combinedSkills = array_unique(array_merge($candidateSkills, $newSkills));

            // Save as JSON
            $candidate->skill = json_encode(array_values($combinedSkills));
            $candidate->save();

            return response()->json([
                'status_code' => 1,
                'message'     => 'Skills added successfully!',
            ]);
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }

    }

    public function removeSkill(Request $request)
    {
        $request->validate([
            'skill' => 'required|string',
        ]);

        $userId    = Auth::id();
        $candidate = CandidateProfile::where('user_id', $userId)->first();

        if (! $candidate) {
            return response()->json(['status_code' => 0, 'message' => 'Candidate not found.']);
        }

        // Decode skills
        $skills = is_array($candidate->skill)
        ? $candidate->skill
        : json_decode($candidate->skill, true);

        if (! is_array($skills)) {
            $skills = [];
        }

        // Remove the skill
        $updatedSkills = array_filter($skills, fn($item) => $item !== $request->skill);

        // Save back as JSON
        $candidate->skill = json_encode(array_values($updatedSkills));
        $candidate->save();

        return response()->json(['status_code' => 1, 'message' => 'Skill removed successfully.']);
    }

    public function uploadDesignation(Request $request)
    {
        $rules = [
            'designation' => 'required|string|max:255',
            'expected'    => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {

            $profile = UserProfile::with('candidateProfile')->where('id', Auth::id())->first();

            if (! $profile) {
                return response()->json(['status_code' => 0, 'message' => 'Profile not found']);
            }

            // If candidateProfile exists, update it
            if ($profile->candidateProfile) {
                $candidateProfile = $profile->candidateProfile;
            } else {
                // If not exists, create a new instance
                $candidateProfile          = new CandidateProfile();
                $candidateProfile->user_id = $profile->id;
            }

            $candidateProfile->position   = $request->input('designation');
            $candidateProfile->expect_sal = $request->input('expected');
            $candidateProfile->updated_at = now(); // only needed if timestamps are off
            $candidateProfile->save();

            return response()->json(['status_code' => 1, 'message' => 'Designation updated successfully']);

        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function candidateExp(Request $request)
    {
        $rules = [
            'company'    => 'required|string|max:255',
            'position'   => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'desc'       => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {

            CandidateEmployment::create([
                'user_id'      => Auth::user()->id, // or your custom user_profile_id if needed
                'company_name' => $request->company,
                'position'     => $request->position,
                'experience'   => $request->experience,
                'description'  => $request->desc,
            ]);

            return response()->json([
                'status_code' => 1,
                'message'     => 'Experience saved successfully!',
            ]);

        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function UpdateExperience(Request $request)
    {
        // dd($request->all());
        // Step 1: Validate the request
        $validator = Validator::make($request->all(), [
            'exp_id'       => 'required|exists:candidate_employment,id',
            'company_name' => 'required|string|max:255',
            'position'     => 'required|string|max:255',
            'experience'   => 'required|string|max:255',
            'desc'         => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 0,
                'message'     => 'Validation failed',
                'errors'      => $validator->errors(),
            ]);
        }

        try {
            // Step 2: Get current user's education info
            $experience = CandidateEmployment::where('user_id', Auth::id())->where('id', $request->exp_id)->first();

            // If record not found, optionally create it
            if (! $experience) {
                return response()->json([
                    'status_code' => 0,
                    'message'     => 'Experience record not found.',
                ]);
            }

            CandidateEmployment::where('id', $request->exp_id)
                ->update([
                    'company_name' => $request->company_name,
                    'position'     => $request->position,
                    'experience'   => $request->experience,
                    'description'  => $request->desc,
                ]);

            return response()->json([
                'status_code' => 1,
                'message'     => 'Candidate Experience updated successfully!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 0,
                'message'     => 'Error: ' . $e->getMessage(),
            ]);
        }
    }

    // public function deleteExperience($id)
    // {
    //     $experience = CandidateEmployment::where('id', $id)->first();

    //     if (! $experience) {
    //         return response()->json(['status_code' =>0, 'message' => 'Experience record not found.']);
    //     }

    //     CandidateEmployment::where('id', $id)->delete();

    //     return response()->json(['status_code' => 1 ,'message' => 'Experience deleted successfully.'], 200);
    // }


    public function deleteExperience($id)
    {
        $experience = CandidateEmployment::find($id);

        if (! $experience) {
            return response()->json(['status_code' => 0, 'message' => 'Experience record not found.']);
        }

        $experience->delete();

        return response()->json(['status_code' => 1, 'message' => 'Experience deleted successfully.'], 200);
    }


    public function CandidateEducation(Request $request)
    {
        $rules = [
            'level'            => 'required|string',
            'board_university' => 'required|string',
            'school_college'   => 'required|string',
            'stream'           => 'nullable|string',
            'starting_year'    => 'required|numeric|max:' . date('Y'),
            'passing_year'     => 'required|numeric|max:' . date('Y'),
            'percentage'       => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 2,
                'message'     => $validator->errors()->first(),
            ]);
        }

        // Check if user already has this level of education
        $exists = CandidateQualifications::where('user_id', Auth::id())
            ->where('level', $request->level)
            ->exists();

        if ($exists) {
            return response()->json([
                'status_code' => 3,
                'message'     => 'You have already added this education level.',
            ]);
        }

        $education                   = new CandidateQualifications();
        $education->user_id          = Auth::id();
        $education->level            = $request->level;
        $education->board_university = $request->board_university;
        $education->school_college   = $request->school_college;
        $education->stream           = $request->stream;
        $education->starting_year    = $request->starting_year;
        $education->passing_year     = $request->passing_year;
        $education->percentage       = $request->percentage;
        $education->save();

        return response()->json([
            'status_code' => 1,
            'message'     => 'Education added successfully.',
        ]);
    }

    public function updateEducation(Request $request)
    {
        // Step 1: Validate the request
        $validator = Validator::make($request->all(), [
            'education_id'     => 'required|exists:education_qualifications,id',
            'level'            => 'required|string|max:255',
            'board_university' => 'required|string|max:255',
            'school_college'   => 'required|string|max:255',
            'starting_year'    => 'required|digits:4',
            'passing_year'     => 'required|digits:4',
            'percentage'       => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 0,
                'message'     => 'Validation failed',
                'errors'      => $validator->errors(),
            ]);
        }

        try {
            // Step 2: Get current user's education info
            $education = CandidateQualifications::where('user_id', Auth::id())->where('id', $request->education_id)->first();

            // If record not found, return an error
            if (! $education) {
                return response()->json([
                    'status_code' => 0,
                    'message'     => 'Education record not found.',
                ]);
            }

            // Step 3: Check if the user already has a record with the same level
            $levelExists = CandidateQualifications::where('user_id', Auth::id())
                ->where('level', $request->level)
                ->where('id', '!=', $request->education_id) // Exclude the current record from the check
                ->exists();

            if ($levelExists) {
                return response()->json([
                    'status_code' => 0,
                    'message'     => 'You have already added this level of education.',
                ]);
            }

            // Step 4: Update the education record
            CandidateQualifications::where('id', $request->education_id)
                ->update([
                    'level'            => $request->level,
                    'board_university' => $request->board_university,
                    'school_college'   => $request->school_college,
                    'stream'           => $request->stream,
                    'starting_year'    => $request->starting_year,
                    'passing_year'     => $request->passing_year,
                    'percentage'       => $request->percentage,
                ]);

            return response()->json([
                'status_code' => 1,
                'message'     => 'Candidate Qualification updated successfully!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 0,
                'message'     => 'Error: ' . $e->getMessage(),
            ]);
        }
    }

    public function deleteEducation($id)
    {
        $education = CandidateQualifications::where('id', $id)->first();

        if (! $education) {
            return response()->json(['message' => 'Education record not found.'], 404);
        }

        CandidateQualifications::where('id', $id)->delete();

        return response()->json(['message' => 'Education deleted successfully.'], 200);
    }

    public function CandidateAward(Request $request)
    {
        $rules = [
            'award_title' => 'required|string|max:255',
            'award_date'  => 'required',
            'award_desc'  => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {

            // If not exists, create a new instance
            $candidateAward              = new CandidateAward();
            $candidateAward->user_id     = Auth::user()->id;
            $candidateAward->award_title = $request->input('award_title');
            $candidateAward->award_date  = $request->input('award_date');
            $candidateAward->award_desc  = $request->input('award_desc');
            $candidateAward->updated_at  = now(); // only needed if timestamps are off
            $candidateAward->save();

            return response()->json(['status_code' => 1, 'message' => 'Award Added successfully']);

        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function updateAward(Request $request)
    {
        // Step 1: Validate the request
        $validator = Validator::make($request->all(), [
            'award_id'    => 'required|exists:candidate_award,id',
            'award_title' => 'required|string|max:255',
            'award_date'  => 'required',
            'award_desc'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 0,
                'message'     => 'Validation failed',
                'errors'      => $validator->errors(),
            ]);
        }

        try {
            // Step 2: Get current user's education info
            $award = CandidateAward::where('user_id', Auth::id())->where('id', $request->award_id)->first();

            // If record not found, optionally create it
            if (! $award) {
                return response()->json([
                    'status_code' => 0,
                    'message'     => 'Education record not found.',
                ]);
            }

            CandidateAward::where('id', $request->award_id)
                ->update([
                    'award_title' => $request->award_title,
                    'award_date'  => $request->award_date,
                    'award_desc'  => $request->award_desc,
                ]);

            return response()->json([
                'status_code' => 1,
                'message'     => 'Candidate Award updated successfully!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 0,
                'message'     => 'Error: ' . $e->getMessage(),
            ]);
        }
    }

    public function deleteAward($id)
    {
        $award = CandidateAward::find($id);
        // dd($award);

        if (! $award) {
            return response()->json(['status_code' => 0, 'message' => 'Award record not found.']);
        }

        $award->delete();

        return response()->json(['status_code' => 1, 'message' => 'Award deleted successfully.'], 200);
    }

    // end resume

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

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {

            $userId = Auth::id();
            $user   = UserProfile::find($userId);

            if ($user != null) {
                $user->password = Hash::make($request->password);
                $user->save();

                return response()->json(['status_code' => 1, 'message' => 'Password Changed Succesfully', 'redirect_url' => route('User.login'),

                ]);
            } else {
                return response()->json(['status_code' => 2, 'message' => 'Not found']);
            }

        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

}
