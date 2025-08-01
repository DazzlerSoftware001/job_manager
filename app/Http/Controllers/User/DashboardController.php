<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\User\ChangeEmail;
use App\Models\CandidateAward;
use App\Models\CandidateEmployment;
use App\Models\CandidateProfile;
use App\Models\CandidateQualifications;
use App\Models\JobApplication;
use App\Models\UserProfile;
use App\Models\EmailTemplates;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Notifications\DatabaseNotification;


class DashboardController extends Controller
{
    public function Dashboard()
    {
            $distributeViews = function ($total, $parts) {
                if ($total == 0) {
                    return array_fill(0, $parts, 0);
                }

                $weights = [];
                for ($i = 0; $i < $parts; $i++) {
                    $weights[] = rand(1, 100);
                }

                $weightSum = array_sum($weights);
                $distribution = array_map(function ($weight) use ($weightSum, $total) {
                    return round(($weight / $weightSum) * $total);
                }, $weights);

                $difference = $total - array_sum($distribution);
                if ($difference !== 0) {
                    $distribution[0] += $difference;
                }

                return $distribution;
            };


        $userId          = Auth::id();
        $appliedJobCount = JobApplication::where('user_id', $userId)->count();

        $ShortlistedJobCount = JobApplication::where('user_id', $userId)->where('status', 'shortlisted')->count();

        $viewProfile = CandidateProfile::where('user_id', $userId)->sum('view_profile');


         $viewProfileCount = CandidateProfile::where('user_id', $userId)->value('view_profile') ?? 0;

    // Distribute views
    $weeklyData  = $distributeViews($viewProfileCount, 7);
    $monthlyData = $distributeViews($viewProfileCount, 4);
    $yearlyData  = $distributeViews($viewProfileCount, 12);

    $weeklyLabels  = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    $monthlyLabels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
    $yearlyLabels  = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];


        return view('User.Dasboard', compact('appliedJobCount', 'ShortlistedJobCount', 'viewProfile', 'viewProfileCount',
        'weeklyData', 'weeklyLabels',
    'monthlyData', 'monthlyLabels',
    'yearlyData', 'yearlyLabels'));
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
            // 'exp_months'      => 'nullable',
            'jobSearch'       => 'required',
            'description'     => 'required|string',
            'social_link'     => 'nullable|array',
            'social_name'     => 'nullable|array',
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

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        try {
            DB::beginTransaction();

            $email = $request->email;
            $otp   = rand(100000, 999999);

            // Store OTP in DB with expiry
            $updated = UserProfile::where('email', Auth::user()->email)->update([
                'otp_email'         => $otp,
                'email_verified_at' => now()->addMinutes(1),
            ]);

            if (! $updated) {
                DB::rollBack();
                return response()->json([
                    'status_code' => 0,
                    'message'     => 'Failed to generate OTP.',
                ]);
            }

            // Check if sending email is enabled via template (ID 22 assumed)
            $template = EmailTemplates::find(22);

            // if ($template && $template->show_email == '1') {
                try {
                    Mail::to($email)->send(new ChangeEmail($otp));
                } catch (\Exception $mailException) {
                    DB::rollBack();
                    Log::error('OTP email send failed: ' . $mailException->getMessage());
                    return response()->json([
                        'status_code' => 0,
                        'message'     => 'Failed to send OTP email.',
                    ]);
                }
            // }

            DB::commit();

            $message = ($template && $template->show_email == '1') ?
            'OTP sent successfully to your email.' :
            'OTP generated but email not sent (disabled).';

            return response()->json([
                'status_code' => 1,
                'message'     => $message,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('sendOtp error: ' . $e->getMessage());
            return response()->json([
                'status_code' => 0,
                'message'     => 'Something went wrong while sending OTP.',
            ]);
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required',
        ]);

        // Find the user by OTP and check expiration
        $user = UserProfile::where('otp_email', $request->otp)
            ->where('email_verified_at', '>', now()) // check not expired
            ->first();

        if ($user) {
            // Update the email and clear the otp
            $user->email             = $request->email;
            $user->otp_email         = null;
            $user->email_verified_at = now(); // verified now
            $user->save();

            return response()->json(['success' => true, 'message' => 'Email updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid or expired OTP']);
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
            'resume' => [
                'required',
                'mimes:pdf',
                'max:2048',
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
            $candidate = CandidateProfile::firstOrCreate(
                ['user_id' => $userId],
                ['skill' => json_encode([])]
            );

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
            'designation'     => 'required|string|max:255',
            'currency'        => 'required',
            'expected_salary' => 'required|numeric',
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
            $candidateProfile->currency   = $request->input('currency');
            $candidateProfile->expect_sal = $request->input('expected_salary');
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
            'company'           => 'required|string|max:255',
            'position'          => 'required|string|max:255',
            'starting_date'     => 'required|date',
            'ending_date'       => 'nullable|date|after_or_equal:starting_date',
            'currently_working' => 'nullable',
            'notice_period'     => 'nullable|string|max:50',
            'desc'              => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {

            CandidateEmployment::create([
                'user_id'           => Auth::user()->id, // or your custom user_profile_id if needed
                'company_name'      => $request->company,
                'position'          => $request->position,
                'starting_date'     => $request->starting_date,
                'ending_date'       => $request->ending_date ?? null,
                'currently_working' => $request->currently_working ?? '0',
                'notice_period'     => $request->notice_period ?? null,
                'description'       => $request->desc,
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
        $validator = Validator::make($request->all(), [
            'exp_id'            => 'required|exists:candidate_employment,id',
            'company_name'      => 'required|string|max:255',
            'position'          => 'required|string|max:255',
            'starting_date'     => 'required|date',
            'ending_date'       => 'nullable|date|after_or_equal:starting_date',
            'currently_working' => 'nullable|in:0,1',
            'notice_period'     => 'nullable|string|max:255',
            'desc'              => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 0,
                'message'     => $validator->errors()->first(),
            ]);
        }

        $experience = CandidateEmployment::where('user_id', Auth::id())->where('id', $request->exp_id)->first();

        if (! $experience) {
            return response()->json([
                'status_code' => 0,
                'message'     => 'Experience record not found.',
            ]);
        }

        if ($request->ending_date == null && $request->currently_working == '0') {
            return response()->json([
                'status_code' => 2,
                'message'     => 'Please select your ending date',
            ]);
        } elseif ($request->currently_working == '1' && $request->notice_period == null) {
            return response()->json([
                'status_code' => 2,
                'message'     => 'Select your notice period.',
            ]);
        }

        $experience->update([
            'company_name'      => $request->company_name,
            'position'          => $request->position,
            'starting_date'     => $request->starting_date,
            'ending_date'       => $request->currently_working ? null : $request->ending_date,
            'currently_working' => $request->currently_working ?? 0,
            'notice_period'     => $request->currently_working ? $request->notice_period : null,
            'description'       => $request->desc,
        ]);

        return response()->json([
            'status_code' => 1,
            'message'     => 'Candidate Experience updated successfully!',
        ]);
    }

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
            'certificate' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'award_desc'  => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {

            // If not exists, create a new instance
            $candidateAward = new CandidateAward();

            if ($request->hasFile('certificate')) {

                $imageName = time() . '.' . $request->certificate->extension();
                $request->certificate->move(public_path('user/assets/img/award_certificate/'), $imageName);
                $candidateAward->certificate = 'user/assets/img/award_certificate/' . $imageName;
            }

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
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'award_id'         => 'required|exists:candidate_award,id',
            'award_title'      => 'required|string|max:255',
            'award_date'       => 'required',
            'award_desc'       => 'required',
            'edit_certificate' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 0,
                'message'     => $validator->errors()->first(),
            ]);
        }

        // try {
        $award = CandidateAward::where('user_id', Auth::id())
            ->where('id', $request->award_id)
            ->first();

        if (! $award) {
            return response()->json([
                'status_code' => 0,
                'message'     => 'Award record not found.',
            ]);
        }

        // Handle certificate upload if present
        if ($request->hasFile('edit_certificate')) {

            if ($award->certificate && file_exists(public_path($award->certificate))) {
                unlink(public_path($award->certificate));
            }

            $imageName = time() . '.' . $request->edit_certificate->extension();
            $request->edit_certificate->move(public_path('user/assets/award_certificate/'), $imageName);
            $award->certificate = 'user/assets/award_certificate/' . $imageName;
        }

        // Update other fields
        $award->award_title = $request->award_title;
        $award->award_date  = $request->award_date;
        $award->award_desc  = $request->award_desc;
        $award->updated_at  = now();

        $award->save();

        return response()->json([
            'status_code' => 1,
            'message'     => 'Candidate Award updated successfully!',
        ]);

        // } catch (\Exception $e) {
        //     return response()->json([
        //         'status_code' => 0,
        //         'message'     => 'Error: ' . $e->getMessage(),
        //     ]);
        // }
    }

    public function deleteAward($id)
    {
        $award = CandidateAward::find($id);
        // dd($award);

        if (! $award) {
            return response()->json(['status_code' => 0, 'message' => 'Award record not found.']);
        }

        if ($award->certificate && file_exists(public_path($award->certificate))) {
            unlink(public_path($award->certificate));
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


    public function destroy($id)
    {
        // dd($id);
        $notification = DatabaseNotification::findOrFail($id);
        $notification->delete();

        return response()->json(['success' => true, 'id' => $id]);
    }

}
