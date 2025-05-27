<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Models\UserProfile;
use App\Models\Recruiter;
use App\Models\Jobpost;
use App\Models\JobApplication;
use Illuminate\Support\Carbon;


class UsersListController extends Controller
{
    public function userList()
    {
        return view('admin.Users.UsersList');
    }

    public function getUsersList(Request $request)
    {
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        $limit  = intval($request->input('length', 10));

        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'phone',
            4 => 'logo',
            5 => 'status',
            6 => 'created_at',
        ];

        $query = UserProfile::where('user_type', 0);

        // Apply search if provided
        if (! empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir    = $order[0]['dir'];
            $query->orderBy($column, $dir);
        }

        $totalRecords = $query->count();

        $records = $query->offset($offset)->limit($limit)->orderBy('id', 'desc')->get();

        $data = [];
        foreach ($records as $record) {
            $dataArray = [];

            $dataArray[] = $record->id;
            $dataArray[] = ucfirst($record->name . ' ' . $record->lname);
            $dataArray[] = $record->email;
            $dataArray[] = $record->phone;
            $dataArray[] = '<img src="' . asset($record->logo) . '" alt="Logo" style="height: 50px; width: 50px; border-radius:50%; object-fit: cover; cursor: pointer;" onclick="openImageModal(\'' . asset($record->logo) . '\')">';

            $status = $record->status == 1
            ? '<div class="d-flex"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
                                <div class="edit">
                                    <a href="' . route('Admin.EditUser', ['id' => Crypt::encrypt($record->id)]) . '" class="edit-item-btn text-primary">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </div>
                                <div class="remove">
                                    <a href="javascript:void(0);" class="remove-item-btn text-danger" onclick="deleteRecord(' . $record->id . ');">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>';

            $data[] = $dataArray;
        }

        return response()->json([
            "draw"            => $draw,
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data"            => $data,
        ]);
    }

    public function ChangeUserStatus(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID
            $User = UserProfile::find($id);

            if ($User) {
                // Toggle the status
                $User->status = $User->status == 1 ? 0 : 1;

                // Save the updated record
                if ($User->save()) {
                    return response()->json(['status_code' => 1, 'message' => 'Status successfully changed']);
                } else {
                    return response()->json(['status_code' => 0, 'message' => 'Unable to change status']);
                }
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function EditUser($id)
    {

        $decryptedId = Crypt::decrypt($id);
        // dd($decryptedId);

        $user = UserProfile::findOrFail($decryptedId);
        return view('admin.Users.EditUser', compact('user'));
    }

    

    public function UpdateUser(Request $request)
    {
        $rules = [
            'edit_id'          => 'required|exists:users,id',
            'fname'            => 'required|string|max:100',
            'lname'            => 'required|string|max:100',
            'img'              => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'dob'              => 'required|date',
            'gender'           => 'required|in:Male,Female,Other',
            'password'         => 'nullable|string|min:6|same:confirm_password',
            'confirm_password' => 'nullable|string|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 2,
                'message'     => $validator->errors()->first(),
            ]);
        }

        try {
            $profile = UserProfile::find($request->edit_id);
            if (! $profile) {
                return response()->json(['status_code' => 0, 'message' => 'Profile not found']);
            }

            // Image upload
            if ($request->hasFile('img')) {
                if ($profile->logo && file_exists(public_path($profile->logo))) {
                    unlink(public_path($profile->logo));
                }

                $imageName = time() . '.' . $request->img->extension();
                $request->img->move(public_path('user/assets/img/profile/'), $imageName);
                $profile->logo = 'user/assets/img/profile/' . $imageName;
            }

            // Update profile fields
            $profile->name          = $request->fname;
            $profile->lname         = $request->lname;
            $profile->date_of_birth = $request->dob;
            $profile->gender        = $request->gender;
            $profile->updated_at    = now();
            $profile->save();

            // Update password if given
            if ($request->filled('password')) {
                $user           = UserProfile::find($request->edit_id);
                $user->password = bcrypt($request->password);
                $user->save();
            }

            return response()->json([
                'status_code' => 1,
                'message'     => 'Updated successfully',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 0,
                'message'     => 'Something went wrong while updating.',
            ]);
        }
    }

    public function DeleteUser(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Attempt to find and delete the record
            $User = UserProfile::find($id);

            if ($User) {
                $User->delete();
                return response()->json(['status_code' => 1, 'message' => 'User deleted successfully ']);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'User not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }


    public function AllApplicants()
    {

        $Recruiters = Recruiter::select('id', 'name','email')->where('user_type',2)->where('status', 1)->get();
        $today       = Carbon::today();

        $joblist     = JobPost::select('id', 'title')->where('status', 1)->where('admin_verify', 1)->whereDate('jobexpiry', '>=', $today)->get();

        return view('admin.Users.AllApplicants',compact('Recruiters'));
    }


    public function getJobsByRecruiter(Request $request)
    {
        $jobs = JobPost::select('id', 'title')
                    ->where('status', 1)
                    ->where('admin_verify', 1)
                    ->where('recruiter_id', $request->recruiter_id)
                    ->whereDate('jobexpiry', '>=', now())
                    ->get();
        return response()->json($jobs);
    }


    public function GetApplicants(Request $request)
    {
        
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        $limit  = intval($request->input('length', 10));

        $order   = $request->input("order");

        $JobFilter  = $request->input("JobFilter");

         if (empty($JobFilter)) {
        return response()->json([
            "draw"            => $draw,
            "recordsTotal"    => 0,
            "recordsFiltered" => 0,
            "data"            => [],
        ]);
    }

        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'phone',
            4 => 'logo',
            5 => 'status',
            6 => 'created_at',
        ];

        // $query = Jobpost::where('id', $JobFilter)->get();

        $query = JobApplication::with([
            'user:id,name,lname,email,logo,education_level,city',
            'user.candidateProfile:skill',
            'jobPost:id,title',
        ]) 
            ->select(['id', 'user_id', 'job_id', 'status', 'recruiter_view', 'created_at']);


            if (!empty($JobFilter)) {
                $query->where('job_id', $JobFilter);
            }


        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir    = $order[0]['dir'];
            $query->orderBy($column, $dir);
        }

        $totalRecords = $query->count();

        $records = $query->offset($offset)->limit($limit)->orderBy('id', 'desc')->get();

        $data = [];
        foreach ($records as $record) {
            $dataArray = [];

            $dataArray[] = $record->user_id;
            // $dataArray[] = ucfirst($record->name . ' ' . $record->lname);
            $dataArray[] = ucfirst($record->user->name) .' '.$record->user->lname;

            $dataArray[] = $record->user->email;
            $dataArray[] = $record->user->phone;
            $dataArray[] = '<img src="' . asset($record->user->logo) . '" alt="Logo" style="height: 50px; width: 50px; border-radius:50%; object-fit: cover; cursor: pointer;" onclick="openImageModal(\'' . asset($record->logo) . '\')">';

            // $status = $record->status == 1
            // ? '<div class="d-flex"><span onclick="changeStatus(' . $record->user->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            // : '<div class="d-flex"><span onclick="changeStatus(' . $record->user->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            // $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->user->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
                                <div class="edit">
                                    <a href="' . route('Admin.EditUser', ['id' => Crypt::encrypt($record->id)]) . '" class="edit-item-btn text-primary">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </div>
                                <div class="remove">
                                    <a href="javascript:void(0);" class="remove-item-btn text-danger" onclick="deleteRecord(' . $record->id . ');">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>';

            $data[] = $dataArray;
        }

        return response()->json([
            "draw"            => $draw,
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data"            => $data,
        ]);
    }

}
