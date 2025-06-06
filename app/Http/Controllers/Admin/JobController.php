<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CandidateProfile;
use App\Models\Companies;
use App\Models\JobApplication;
use App\Models\JobCategory;
use App\Models\JobCurrency;
use App\Models\JobDepartment;
use App\Models\JobEducation;
use App\Models\JobExperience;
use App\Models\JobIntType;
use App\Models\JobLocation;
use App\Models\JobMode;
use App\Models\JobPost;
use App\Models\JobRole;
use App\Models\JobSalary;
use App\Models\JobShift;
use App\Models\JobSkill;
use App\Models\JobTypes;
use App\Models\Recruiter;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\JobPostMailToRecruiter;
use App\Mail\Admin\JobVerifyMailToRecruiter;
use App\Mail\Admin\JobStatusMailToRecruiter;
use App\Mail\Admin\JobUpdateMailToRecruiter;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class JobController extends Controller
{

    public function JobSkill()
    {
        return view('admin.job.Jobskill');
    }

    public function getJobSkill(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'skill',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        ];

        $query = JobSkill::query();
        // Count Data

        if (! empty($search)) {
            $query->where('skill', 'like', '%' . $search . '%');
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
            $dataArray[] = ucfirst($record->skill);

            $status = $record->status == 1
            ? '<div class="d-flex"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
                                <div class="edit">
                                    <a href="javascript:void(0);" class="edit-item-btn text-primary" data-bs-toggle="modal" data-bs-target="#EditModal" onclick="edit(' . $record->id . ');"><i class="far fa-edit"></i></a>
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

    public function addJobSkill(Request $request)
    {

        // Define validation rules
        $rules = [
            'skill' => 'required|string|max:100|unique:job_skill,skill',

        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            try {
                $JobSkill             = new JobSkill();
                $JobSkill->skill      = $request->input('skill');
                $JobSkill->status     = 0;
                $JobSkill->created_at = now();

                $JobSkill->save();

                return response()->json(['status_code' => 1, 'message' => 'Job Skill successfully added']);
            } catch (\Exception $e) {
                // Handle any exception that occurs during saving
                return response()->json(['status_code' => 0, 'message' => 'Unable to add data']);
            }
        } else {
            // Return validation errors
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function changeJobSkillStatus(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID
            $JobSkill = JobSkill::find($id);

            if ($JobSkill) {
                // Toggle the status
                $JobSkill->status = $JobSkill->status == 1 ? 0 : 1;

                // Save the updated record
                if ($JobSkill->save()) {
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

    public function deleteJobSkill(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Attempt to find and delete the record
            $JobSkill = JobSkill::find($id);

            if ($JobSkill) {
                $JobSkill->delete();
                return response()->json(['status_code' => 1, 'message' => 'Skill deleted successfully ']);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Skill not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function editJobSkill(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID

            $JobSkill = JobSkill::find($id);

            if ($JobSkill) {
                return response()->json(['data' => $JobSkill]);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function updateJobSkill(Request $request)
    {
        $rules = [
            'edit-id'   => 'required|exists:job_skill,id',
            'EditSkill' => 'required|max:100|unique:job_skill,skill',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            $id = $request->input('edit-id');

            // Find the record by ID
            $JobSkill = JobSkill::find($id);

            if ($JobSkill) {
                $JobSkill->skill      = $request->input('EditSkill');
                $JobSkill->updated_at = now();

                if ($JobSkill->save()) {
                    return response()->json(['status_code' => 1, 'message' => 'Skill updated successfully']);
                } else {
                    return response()->json(['status_code' => 0, 'message' => 'Unable to update data']);
                }
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    // Department
    public function JobDepartment()
    {
        $data['JobCategory'] = JobCategory::select('name')->get();
        return view('admin.job.Jobdepartment', $data);
    }

    public function getJobDepartment(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'category_name',
            2 => 'department',
            3 => 'status',
            4 => 'created_at',
            5 => 'id',
        ];

        $query = JobDepartment::query();
        // Count Data

        if (! empty($search)) {
            $query->where('department', 'like', '%' . $search . '%');
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
            $dataArray[] = ucfirst($record->category_name);
            $dataArray[] = ucfirst($record->department);

            $status = $record->status == 1
            ? '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
                                <div class="edit">
                                    <a href="javascript:void(0);" class="edit-item-btn text-primary" data-bs-toggle="modal" data-bs-target="#EditModal" onclick="edit(' . $record->id . ');"><i class="far fa-edit"></i></a>
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

    public function addJobDepartment(Request $request)
    {

        // // Define validation rules
        // $rules = [
        //     'category'   => 'required',
        //     'department' => 'required|string|max:100|unique:job_department,department',
        // ];
        $rules = [
            'category'   => 'required',
            'department' => [
                'required',
                'string',
                'max:100',
                Rule::unique('job_department', 'department')->where(function ($query) use ($request) {
                    return $query->where('category_name', $request->input('category'));
                }),
            ],
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            try {
                $JobDepartment                = new JobDepartment();
                $JobDepartment->category_name = $request->input('category');
                $JobDepartment->department    = $request->input('department');
                $JobDepartment->status        = 0;
                $JobDepartment->created_at    = now();

                $JobDepartment->save();

                return response()->json(['status_code' => 1, 'message' => 'Department successfully added']);
            } catch (\Exception $e) {
                // Handle any exception that occurs during saving
                return response()->json(['status_code' => 0, 'message' => 'Unable to add Department']);
            }
        } else {
            // Return validation errors
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function changeJobDepartmentStatus(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID
            $JobDepartment = JobDepartment::find($id);

            if ($JobDepartment) {
                // Toggle the status
                $JobDepartment->status = $JobDepartment->status == 1 ? 0 : 1;

                // Save the updated record
                if ($JobDepartment->save()) {
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

    public function deleteJobDepartment(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Attempt to find and delete the record
            $JobDepartment = JobDepartment::find($id);

            if ($JobDepartment) {
                $JobDepartment->delete();
                return response()->json(['status_code' => 1, 'message' => 'JobDepartment deleted successfully ']);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'JobDepartment not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function editJobDepartment(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID

            $JobDepartment = JobDepartment::find($id);

            if ($JobDepartment) {
                return response()->json(['data' => $JobDepartment]);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function updateJobDepartment(Request $request)
    {
        $rules = [
            'edit-id'        => 'required|exists:job_department,id',
            'editcategory'   => 'required',
            'editdepartment' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            $id = $request->input('edit-id');

            // Find the record by ID
            $JobDepartment = JobDepartment::find($id);

            if ($JobDepartment) {
                $JobDepartment->category_name = $request->input('editcategory');
                $JobDepartment->department    = $request->input('editdepartment');
                $JobDepartment->updated_at    = now();

                if ($JobDepartment->save()) {
                    return response()->json(['status_code' => 1, 'message' => 'JobDepartment updated successfully']);
                } else {
                    return response()->json(['status_code' => 0, 'message' => 'Unable to update data']);
                }
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    // Role
    public function JobRole()
    {
        // $data['JobDepartment'] = JobDepartment::select('department')->get();
        $data['JobDepartment'] = JobDepartment::where('status', '!=', 0)->select('department')->get();

        return view('admin.job.Jobrole', $data);
    }

    public function getJobRole(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'department_name',
            2 => 'role',
            3 => 'status',
            4 => 'created_at',
            5 => 'id',
        ];

        $query = JobRole::query();
        // Count Data

        if (! empty($search)) {
            $query->where('role', 'like', '%' . $search . '%');
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
            $dataArray[] = ucfirst($record->department_name);
            $dataArray[] = ucfirst($record->role);

            $status = $record->status == 1
            ? '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
                                <div class="edit">
                                    <a href="javascript:void(0);" class="edit-item-btn text-primary" data-bs-toggle="modal" data-bs-target="#EditModal" onclick="edit(' . $record->id . ');"><i class="far fa-edit"></i></a>
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

    public function addJobRole(Request $request)
    {

        // Define validation rules
        // $rules = [
        //     'department' => 'required',
        //     'role'       => 'required|string|max:100|unique:job_role,role',
        // ];

        $rules = [
            'department'   => 'required',
            'role' => [
                'required',
                'string',
                'max:100',
                Rule::unique('job_role', 'role')->where(function ($query) use ($request) {
                    return $query->where('department_name', $request->input('department'));
                }),
            ],
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            try {
                $JobRole                  = new JobRole();
                $JobRole->department_name = $request->input('department');
                $JobRole->role            = $request->input('role');
                $JobRole->status          = 0;
                $JobRole->created_at      = now();

                $JobRole->save();

                return response()->json(['status_code' => 1, 'message' => 'Role successfully added']);
            } catch (\Exception $e) {
                // Handle any exception that occurs during saving
                return response()->json(['status_code' => 0, 'message' => 'Unable to add Role']);
            }
        } else {
            // Return validation errors
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function changeJobRoleStatus(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID
            $JobRole = JobRole::find($id);

            if ($JobRole) {
                // Toggle the status
                $JobRole->status = $JobRole->status == 1 ? 0 : 1;

                // Save the updated record
                if ($JobRole->save()) {
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

    public function deleteJobRole(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Attempt to find and delete the record
            $JobRole = JobRole::find($id);

            if ($JobRole) {
                $JobRole->delete();
                return response()->json(['status_code' => 1, 'message' => 'JobRole deleted successfully ']);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'JobRole not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function editJobRole(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID

            $JobRole = JobRole::find($id);

            if ($JobRole) {
                return response()->json(['data' => $JobRole]);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function updateJobRole(Request $request)
    {
        $rules = [
            'edit-id'        => 'required|exists:job_role,id',
            'editdepartment' => 'required',
            'editrole'       => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            $id = $request->input('edit-id');

            // Find the record by ID
            $JobRole = JobRole::find($id);

            if ($JobRole) {
                $JobRole->department_name = $request->input('editdepartment');
                $JobRole->role            = $request->input('editrole');
                $JobRole->updated_at      = now();

                if ($JobRole->save()) {
                    return response()->json(['status_code' => 1, 'message' => 'JobRole updated successfully']);
                } else {
                    return response()->json(['status_code' => 0, 'message' => 'Unable to update data']);
                }
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    // Location
    public function JobLocation()
    {
        return view('admin.job.Joblocation');
    }

    public function getJobLocation(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'country',
            2 => 'city',
            3 => 'status',
            4 => 'created_at',
            5 => 'id',
        ];

        $query = JobLocation::query();
        // Count Data

        if (! empty($search)) {
            $query->where('country', 'like', '%' . $search . '%')
                ->orwhere('city', 'like', '%' . $search . '%');
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
            $dataArray[] = ucfirst($record->country);
            $dataArray[] = ucfirst($record->city);

            $status = $record->status == 1
            ? '<div class="d-flex justify-content-center"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex justify-content-center"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
                                <div class="edit">
                                    <a href="javascript:void(0);" class="edit-item-btn text-primary" data-bs-toggle="modal" data-bs-target="#EditModal" onclick="edit(' . $record->id . ');"><i class="far fa-edit"></i></a>
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

    public function addJobLocation(Request $request)
    {

        // Define validation rules
        $rules = [
            'country' => 'required|string|max:100',
            'city'    => 'required|string|max:100',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            try {
                $JobLocation             = new JobLocation();
                $JobLocation->country    = $request->input('country');
                $JobLocation->city       = $request->input('city');
                $JobLocation->status     = 0;
                $JobLocation->created_at = now();

                $JobLocation->save();

                return response()->json(['status_code' => 1, 'message' => 'JobLocation successfully added']);
            } catch (\Exception $e) {
                // Handle any exception that occurs during saving
                return response()->json(['status_code' => 0, 'message' => 'Unable to add data']);
            }
        } else {
            // Return validation errors
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function changeJobLocationStatus(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID
            $JobLocation = JobLocation::find($id);

            if ($JobLocation) {
                // Toggle the status
                $JobLocation->status = $JobLocation->status == 1 ? 0 : 1;

                // Save the updated record
                if ($JobLocation->save()) {
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

    public function deleteJobLocation(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Attempt to find and delete the record
            $JobLocation = JobLocation::find($id);

            if ($JobLocation) {
                $JobLocation->delete();
                return response()->json(['status_code' => 1, 'message' => 'Location deleted successfully ']);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Location not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function editJobLocation(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID

            $JobLocation = JobLocation::find($id);

            if ($JobLocation) {
                return response()->json(['data' => $JobLocation]);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function updateJobLocation(Request $request)
    {
        $rules = [
            'edit-id'     => 'required|exists:job_location,id',
            'editcountry' => 'required|max:100',
            'editcity'    => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            $id = $request->input('edit-id');

            // Find the record by ID
            $JobLocation = JobLocation::find($id);

            if ($JobLocation) {
                $JobLocation->country    = $request->input('editcountry');
                $JobLocation->city       = $request->input('editcity');
                $JobLocation->updated_at = now();

                if ($JobLocation->save()) {
                    return response()->json(['status_code' => 1, 'message' => 'Location updated successfully']);
                } else {
                    return response()->json(['status_code' => 0, 'message' => 'Unable to update data']);
                }
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    // Category
    public function jobCategory()
    {
        return view('admin.job.Jobcategory');
    }

    public function getJobCategory(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        ];

        $query = JobCategory::query();
        // Count Data

        if (! empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
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
            $dataArray[] = ucfirst($record->name);

            $status = $record->status == 1
            ? '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
                                <div class="edit">
                                    <a href="javascript:void(0);" class="edit-item-btn text-primary" data-bs-toggle="modal" data-bs-target="#EditModal" onclick="edit(' . $record->id . ');"><i class="far fa-edit"></i></a>
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

    public function addJobCategory(Request $request)
    {

        // Define validation rules
        $rules = [
            'category' => 'required|string|max:100|unique:job_category,name',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            try {
                $JobLocation             = new JobCategory();
                $JobLocation->name       = $request->input('category');
                $JobLocation->status     = 0;
                $JobLocation->created_at = now();

                $JobLocation->save();

                return response()->json(['status_code' => 1, 'message' => 'Category successfully added']);
            } catch (\Exception $e) {
                // Handle any exception that occurs during saving
                return response()->json(['status_code' => 0, 'message' => 'Unable to add Category']);
            }
        } else {
            // Return validation errors
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function changeJobCategoryStatus(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID
            $JobCategory = JobCategory::find($id);

            if ($JobCategory) {
                // Toggle the status
                $JobCategory->status = $JobCategory->status == 1 ? 0 : 1;

                // Save the updated record
                if ($JobCategory->save()) {
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

    public function deleteJobCategory(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Attempt to find and delete the record
            $JobCategory = JobCategory::find($id);

            if ($JobCategory) {
                $JobCategory->delete();
                return response()->json(['status_code' => 1, 'message' => 'Category deleted successfully ']);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Category not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function editJobCategory(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID

            $JobCategory = JobCategory::find($id);

            if ($JobCategory) {
                return response()->json(['data' => $JobCategory]);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function updateJobCategory(Request $request)
    {
        $rules = [
            'edit-id'      => 'required|exists:job_category,id',
            'editcategory' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            $id = $request->input('edit-id');

            // Find the record by ID
            $JobCategory = JobCategory::find($id);

            if ($JobCategory) {
                $JobCategory->name       = $request->input('editcategory');
                $JobCategory->updated_at = now();

                if ($JobCategory->save()) {
                    return response()->json(['status_code' => 1, 'message' => 'Category updated successfully']);
                } else {
                    return response()->json(['status_code' => 0, 'message' => 'Unable to update data']);
                }
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    // Types
    public function jobTypes()
    {
        return view('admin.job.Jobtypes');
    }

    public function getJobTypes(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit   = intval($request->input('length', 10));
        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'type',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        ];

        $query = JobTypes::query();
        // Count Data

        if (! empty($search)) {
            $query->where('type', 'like', '%' . $search . '%');
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
            $dataArray[] = ucfirst($record->type);

            $status = $record->status == 1
            ? '<div class="d-flex justify-content-center"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex justify-content-center"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
                                <div class="edit">
                                    <a href="javascript:void(0);" class="edit-item-btn text-primary" data-bs-toggle="modal" data-bs-target="#EditModal" onclick="edit(' . $record->id . ');"><i class="far fa-edit"></i></a>
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

    public function addJobTypes(Request $request)
    {

        // Define validation rules
        $rules = [
            'types' => 'required|string|max:100|unique:job_types,type',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            try {
                $JobTypes             = new JobTypes();
                $JobTypes->type       = $request->input('types');
                $JobTypes->status     = 0;
                $JobTypes->created_at = now();

                $JobTypes->save();

                return response()->json(['status_code' => 1, 'message' => 'Types added successfully ']);
            } catch (\Exception $e) {
                // Handle any exception that occurs during saving
                return response()->json(['status_code' => 0, 'message' => 'Unable to add Category']);
            }
        } else {
            // Return validation errors
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function changeJobTypesStatus(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID
            $JobTypes = JobTypes::find($id);

            if ($JobTypes) {
                // Toggle the status
                $JobTypes->status = $JobTypes->status == 1 ? 0 : 1;

                // Save the updated record
                if ($JobTypes->save()) {
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

    public function deleteJobTypes(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Attempt to find and delete the record
            $JobTypes = JobTypes::find($id);

            if ($JobTypes) {
                $JobTypes->delete();
                return response()->json(['status_code' => 1, 'message' => 'Types deleted successfully ']);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Types not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function editJobTypes(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID

            $JobTypes = JobTypes::find($id);

            if ($JobTypes) {
                return response()->json(['data' => $JobTypes]);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function updateJobTypes(Request $request)
    {
        $rules = [
            'edit-id'  => 'required|exists:job_types,id',
            'editType' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            $id = $request->input('edit-id');

            // Find the record by ID
            $JobTypes = JobTypes::find($id);

            if ($JobTypes) {
                $JobTypes->type       = $request->input('editType');
                $JobTypes->updated_at = now();

                if ($JobTypes->save()) {
                    return response()->json(['status_code' => 1, 'message' => 'Type updated successfully']);
                } else {
                    return response()->json(['status_code' => 0, 'message' => 'Unable to update data']);
                }
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function jobMode()
    {
        return view('admin.job.Jobmode');
    }

    public function getJobMode(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit   = intval($request->input('length', 10));
        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'mode',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        ];

        $query = JobMode::query();
        // Count Data

        if (! empty($search)) {
            $query->where('mode', 'like', '%' . $search . '%');
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
            $dataArray[] = ucfirst($record->mode);

            $status = $record->status == 1
            ? '<div class="d-flex justify-content-center"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex justify-content-center"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
                                <div class="edit">
                                    <a href="javascript:void(0);" class="edit-item-btn text-primary" data-bs-toggle="modal" data-bs-target="#EditModal" onclick="edit(' . $record->id . ');"><i class="far fa-edit"></i></a>
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

    public function addJobMode(Request $request)
    {

        // Define validation rules
        $rules = [
            'mode' => 'required|string|max:100|unique:job_mode,mode',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            try {
                $JobMode             = new JobMode();
                $JobMode->mode       = $request->input('mode');
                $JobMode->status     = 0;
                $JobMode->created_at = now();

                $JobMode->save();

                return response()->json(['status_code' => 1, 'message' => 'Job mode added successfully ']);
            } catch (\Exception $e) {
                // Handle any exception that occurs during saving
                return response()->json(['status_code' => 0, 'message' => 'Unable to add mode']);
            }
        } else {
            // Return validation errors
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function changeJobModeStatus(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID
            $JobMode = JobMode::find($id);

            if ($JobMode) {
                // Toggle the status
                $JobMode->status = $JobMode->status == 1 ? 0 : 1;

                // Save the updated record
                if ($JobMode->save()) {
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

    public function deleteJobMode(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Attempt to find and delete the record
            $JobMode = JobMode::find($id);

            if ($JobMode) {
                $JobMode->delete();
                return response()->json(['status_code' => 1, 'message' => 'Job mode deleted successfully ']);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Job mode not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function editJobMode(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID

            $JobMode = JobMode::find($id);

            if ($JobMode) {
                return response()->json(['data' => $JobMode]);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function updateJobMode(Request $request)
    {
        $rules = [
            'edit-id'  => 'required|exists:job_mode,id',
            'editMode' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            $id = $request->input('edit-id');

            // Find the record by ID
            $JobMode = JobMode::find($id);

            if ($JobMode) {
                $JobMode->mode       = $request->input('editMode');
                $JobMode->updated_at = now();

                if ($JobMode->save()) {
                    return response()->json(['status_code' => 1, 'message' => 'Mode updated successfully']);
                } else {
                    return response()->json(['status_code' => 0, 'message' => 'Unable to update data']);
                }
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    // Shift
    public function jobShift()
    {
        return view('admin.job.Jobshift');
    }

    public function getJobShift(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit   = intval($request->input('length', 10));
        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'shift',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        ];

        $query = JobShift::query();
        // Count Data

        if (! empty($search)) {
            $query->where('shift', 'like', '%' . $search . '%');
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
            $dataArray[] = ucfirst($record->shift);

            $status = $record->status == 1
            ? '<div class="d-flex justify-content-center"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex justify-content-center"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
                                <div class="edit">
                                    <a href="javascript:void(0);" class="edit-item-btn text-primary" data-bs-toggle="modal" data-bs-target="#EditModal" onclick="edit(' . $record->id . ');"><i class="far fa-edit"></i></a>
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

    public function addJobShift(Request $request)
    {

        // Define validation rules
        $rules = [
            'shift' => 'required|string|max:100|unique:job_shift,shift',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            try {
                $JobShift             = new JobShift();
                $JobShift->shift      = $request->input('shift');
                $JobShift->status     = 0;
                $JobShift->created_at = now();

                $JobShift->save();

                return response()->json(['status_code' => 1, 'message' => 'Shift added successfully ']);
            } catch (\Exception $e) {
                // Handle any exception that occurs during saving
                return response()->json(['status_code' => 0, 'message' => 'Unable to add Shift']);
            }
        } else {
            // Return validation errors
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function changeJobShiftStatus(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID
            $JobShift = JobShift::find($id);

            if ($JobShift) {
                // Toggle the status
                $JobShift->status = $JobShift->status == 1 ? 0 : 1;

                // Save the updated record
                if ($JobShift->save()) {
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

    public function deleteJobShift(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Attempt to find and delete the record
            $JobShift = JobShift::find($id);

            if ($JobShift) {
                $JobShift->delete();
                return response()->json(['status_code' => 1, 'message' => 'JobShift deleted successfully ']);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'JobShift not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function editJobShift(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID

            $JobShift = JobShift::find($id);

            if ($JobShift) {
                return response()->json(['data' => $JobShift]);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function updateJobShift(Request $request)
    {
        $rules = [
            'edit-id'   => 'required|exists:job_shift,id',
            'editShift' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            $id = $request->input('edit-id');

            // Find the record by ID
            $JobShift = JobShift::find($id);

            if ($JobShift) {
                $JobShift->shift      = $request->input('editShift');
                $JobShift->updated_at = now();

                if ($JobShift->save()) {
                    return response()->json(['status_code' => 1, 'message' => 'Shift updated successfully']);
                } else {
                    return response()->json(['status_code' => 0, 'message' => 'Unable to update data']);
                }
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    // Experience
    public function jobExperience()
    {
        return view('admin.job.Jobexperience');
    }

    public function getJobExperience(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit   = intval($request->input('length', 10));
        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'experience',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        ];

        $query = JobExperience::query();
        // Count Data

        if (! empty($search)) {
            $query->where('experience', 'like', '%' . $search . '%');
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
            $dataArray[] = ucfirst($record->experience) . ' ' . ($record->experience == 1 ? 'year' : 'years');

            $status = $record->status == 1
            ? '<div class="d-flex justify-content"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex justify-content"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
                                <div class="edit">
                                    <a href="javascript:void(0);" class="edit-item-btn text-primary" data-bs-toggle="modal" data-bs-target="#EditModal" onclick="edit(' . $record->id . ');"><i class="far fa-edit"></i></a>
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

    public function addJobExperience(Request $request)
    {

        // Define validation rules
        $rules = [
            'experience' => 'required|integer|max:100|unique:job_experience,experience',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            try {
                $Jobexp             = new JobExperience();
                $Jobexp->experience = $request->input('experience');
                $Jobexp->status     = 0;
                $Jobexp->created_at = now();

                $Jobexp->save();

                return response()->json(['status_code' => 1, 'message' => 'Experience added successfully ']);
            } catch (\Exception $e) {
                // Handle any exception that occurs during saving
                return response()->json(['status_code' => 0, 'message' => 'Unable to add Experience']);
            }
        } else {
            // Return validation errors
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function changeJobExperienceStatus(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID
            $JobExp = JobExperience::find($id);

            if ($JobExp) {
                // Toggle the status
                $JobExp->status = $JobExp->status == 1 ? 0 : 1;

                // Save the updated record
                if ($JobExp->save()) {
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

    public function deleteJobExperience(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Attempt to find and delete the record
            $JobExp = JobExperience::find($id);

            if ($JobExp) {
                $JobExp->delete();
                return response()->json(['status_code' => 1, 'message' => 'Experience deleted successfully ']);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Experience not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function editJobExperience(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID

            $JobExp = JobExperience::find($id);

            if ($JobExp) {
                return response()->json(['data' => $JobExp]);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function updateJobExperience(Request $request)
    {
        $rules = [
            'edit-id' => 'required|exists:job_experience,id',
            'editExp' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            $id = $request->input('edit-id');

            // Find the record by ID
            $JobExp = JobExperience::find($id);

            if ($JobExp) {
                $JobExp->experience = $request->input('editExp');
                $JobExp->updated_at = now();

                if ($JobExp->save()) {
                    return response()->json(['status_code' => 1, 'message' => 'Experience updated successfully']);
                } else {
                    return response()->json(['status_code' => 0, 'message' => 'Unable to update data']);
                }
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    // Currency
    public function jobCurrency()
    {
        return view('admin.job.JobCurrency');
    }

    public function getJobCurrency(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit   = intval($request->input('length', 10));
        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'currency',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        ];

        $query = JobCurrency::query();
        // Count Data

        if (! empty($search)) {
            $query->where('currency', 'like', '%' . $search . '%');
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
            $dataArray[] = ucfirst($record->currency);

            $status = $record->status == 1
            ? '<div class="d-flex justify-content"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex justify-content"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
                                <div class="edit">
                                    <a href="javascript:void(0);" class="edit-item-btn text-primary" data-bs-toggle="modal" data-bs-target="#EditModal" onclick="edit(' . $record->id . ');"><i class="far fa-edit"></i></a>
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

    public function addJobCurrency(Request $request)
    {

        // Define validation rules
        $rules = [
            'currency' => 'required|string|max:50|unique:currency,currency',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            try {
                $JobCurrency             = new JobCurrency();
                $JobCurrency->currency   = $request->input('currency');
                $JobCurrency->status     = 0;
                $JobCurrency->created_at = now();

                $JobCurrency->save();

                return response()->json(['status_code' => 1, 'message' => 'Currency added successfully ']);
            } catch (\Exception $e) {
                // Handle any exception that occurs during saving
                return response()->json(['status_code' => 0, 'message' => 'Unable to add Currency']);
            }
        } else {
            // Return validation errors
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function changeJobCurrencyStatus(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID
            $JobCurrency = JobCurrency::find($id);

            if ($JobCurrency) {
                // Toggle the status
                $JobCurrency->status = $JobCurrency->status == 1 ? 0 : 1;

                // Save the updated record
                if ($JobCurrency->save()) {
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

    public function deleteJobCurrency(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Attempt to find and delete the record
            $JobCurrency = JobCurrency::find($id);

            if ($JobCurrency) {
                $JobCurrency->delete();
                return response()->json(['status_code' => 1, 'message' => 'Currency deleted successfully ']);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Currency not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function editJobCurrency(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID

            $JobCurrency = JobCurrency::find($id);

            if ($JobCurrency) {
                return response()->json(['data' => $JobCurrency]);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function updateJobCurrency(Request $request)
    {
        $rules = [
            'edit-id'      => 'required|exists:currency,id',
            'editcurrency' => 'required|string|unique:currency,currency',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            $id = $request->input('edit-id');

            // Find the record by ID
            $JobCurrency = JobCurrency::find($id);

            if ($JobCurrency) {
                $JobCurrency->currency   = $request->input('editcurrency');
                $JobCurrency->updated_at = now();

                if ($JobCurrency->save()) {
                    return response()->json(['status_code' => 1, 'message' => 'Currency updated successfully']);
                } else {
                    return response()->json(['status_code' => 0, 'message' => 'Unable to update data']);
                }
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    // Annual Salary
    public function jobSalary()
    {
        return view('admin.job.Jobsalary');
    }

    public function getJobSalary(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit   = intval($request->input('length', 10));
        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'salary',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        ];

        $query = JobSalary::query();
        // Count Data

        if (! empty($search)) {
            $query->where('salary', 'like', '%' . $search . '%');
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
            $dataArray[] = ucfirst($record->salary);

            $status = $record->status == 1
            ? '<div class="d-flex justify-content"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex justify-content"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
                                <div class="edit">
                                    <a href="javascript:void(0);" class="edit-item-btn text-primary" data-bs-toggle="modal" data-bs-target="#EditModal" onclick="edit(' . $record->id . ');"><i class="far fa-edit"></i></a>
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

    public function addJobSalary(Request $request)
    {

        // Define validation rules
        $rules = [
            'salary' => 'required|integer|min:1000|max:10000000|unique:annual_salary,salary',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            try {
                $JobSalary             = new JobSalary();
                $JobSalary->salary     = $request->input('salary');
                $JobSalary->status     = 0;
                $JobSalary->created_at = now();

                $JobSalary->save();

                return response()->json(['status_code' => 1, 'message' => 'Salary added successfully ']);
            } catch (\Exception $e) {
                // Handle any exception that occurs during saving
                return response()->json(['status_code' => 0, 'message' => 'Unable to add Salary']);
            }
        } else {
            // Return validation errors
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function changeJobSalaryStatus(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID
            $JobSalary = JobSalary::find($id);

            if ($JobSalary) {
                // Toggle the status
                $JobSalary->status = $JobSalary->status == 1 ? 0 : 1;

                // Save the updated record
                if ($JobSalary->save()) {
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

    public function deleteJobSalary(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Attempt to find and delete the record
            $JobSalary = JobSalary::find($id);

            if ($JobSalary) {
                $JobSalary->delete();
                return response()->json(['status_code' => 1, 'message' => 'Salary deleted successfully ']);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Salary not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function editJobSalary(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID

            $JobSalary = JobSalary::find($id);

            if ($JobSalary) {
                return response()->json(['data' => $JobSalary]);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function updateJobSalary(Request $request)
    {
        $rules = [
            'edit-id'    => 'required|exists:annual_salary,id',
            'editsalary' => 'required|integer|min:1000|max:10000000|unique:annual_salary,salary',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            $id = $request->input('edit-id');

            // Find the record by ID
            $JobSalary = JobSalary::find($id);

            if ($JobSalary) {
                $JobSalary->salary     = $request->input('editsalary');
                $JobSalary->updated_at = now();

                if ($JobSalary->save()) {
                    return response()->json(['status_code' => 1, 'message' => 'Salary updated successfully']);
                } else {
                    return response()->json(['status_code' => 0, 'message' => 'Unable to update data']);
                }
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    // Interview Type
    public function JobIntType()
    {
        return view('admin.job.Jobinttype');
    }

    public function getJobIntType(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'int_type',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        ];

        $query = JobIntType::query();
        // Count Data

        if (! empty($search)) {
            $query->where('int_type', 'like', '%' . $search . '%');
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
            $dataArray[] = ucfirst($record->int_type);

            $status = $record->status == 1
            ? '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
                                <div class="edit">
                                    <a href="javascript:void(0);" class="edit-item-btn text-primary" data-bs-toggle="modal" data-bs-target="#EditModal" onclick="edit(' . $record->id . ');"><i class="far fa-edit"></i></a>
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

    public function addJobIntType(Request $request)
    {

        // Define validation rules
        $rules = [
            'IntType' => 'required|string|max:100|unique:interview_type,int_type',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            try {
                $JobIntType             = new JobIntType();
                $JobIntType->int_type   = $request->input('IntType');
                $JobIntType->status     = 0;
                $JobIntType->created_at = now();

                $JobIntType->save();

                return response()->json(['status_code' => 1, 'message' => 'Interview Type successfully added']);
            } catch (\Exception $e) {
                // Handle any exception that occurs during saving
                return response()->json(['status_code' => 0, 'message' => 'Unable to add Department']);
            }
        } else {
            // Return validation errors
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function changeJobIntTypeStatus(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID
            $JobIntType = JobIntType::find($id);

            if ($JobIntType) {
                // Toggle the status
                $JobIntType->status = $JobIntType->status == 1 ? 0 : 1;

                // Save the updated record
                if ($JobIntType->save()) {
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

    public function deleteJobIntType(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Attempt to find and delete the record
            $JobIntType = JobIntType::find($id);

            if ($JobIntType) {
                $JobIntType->delete();
                return response()->json(['status_code' => 1, 'message' => 'Interview Type deleted successfully ']);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Interview Type not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function editJobIntType(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID

            $JobIntType = JobIntType::find($id);

            if ($JobIntType) {
                return response()->json(['data' => $JobIntType]);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function updateJobIntType(Request $request)
    {
        $rules = [
            'edit-id'     => 'required|exists:interview_type,id',
            'editIntType' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            $id = $request->input('edit-id');

            // Find the record by ID
            $JobIntType = JobIntType::find($id);

            if ($JobIntType) {
                $JobIntType->int_type   = $request->input('editIntType');
                $JobIntType->updated_at = now();

                if ($JobIntType->save()) {
                    return response()->json(['status_code' => 1, 'message' => 'Interview Type updated successfully']);
                } else {
                    return response()->json(['status_code' => 0, 'message' => 'Unable to update data']);
                }
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    // Educational Qualifications
    public function jobEducation()
    {
        return view('admin.job.Jobeducation');
    }

    public function getJobEducation(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'education',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        ];

        $query = JobEducation::query();
        // Count Data

        if (! empty($search)) {
            $query->where('education', 'like', '%' . $search . '%');
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
            $dataArray[] = ucfirst($record->education_level);
            $dataArray[] = ucfirst($record->education);
            $dataArray[] = $record->branch ? ucfirst($record->branch) : '-';

            $status = $record->status == 1
            ? '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
                                <div class="edit">
                                    <a href="javascript:void(0);" class="edit-item-btn text-primary" data-bs-toggle="modal" data-bs-target="#EditModal" onclick="edit(' . $record->id . ');"><i class="far fa-edit"></i></a>
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

    public function addJobEducation(Request $request)
    {

        // Define validation rules
        $rules = [
            'education_level' => 'required|string',
            'education'       => 'required|string|max:100|unique:education,education',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            try {
                $JobEducation                  = new JobEducation();
                $JobEducation->education_level = $request->input('education_level');
                $JobEducation->education       = $request->input('education');
                $JobEducation->branch          = $request->input('branch') ?? null;
                $JobEducation->status          = 0;
                $JobEducation->created_at      = now();

                $JobEducation->save();

                return response()->json(['status_code' => 1, 'message' => 'Educational Qualification successfully added']);
            } catch (\Exception $e) {
                // Handle any exception that occurs during saving
                return response()->json(['status_code' => 0, 'message' => 'Unable to add Educational Qualification']);
            }
        } else {
            // Return validation errors
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function changeJobEducationStatus(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID
            $JobEducation = JobEducation::find($id);

            if ($JobEducation) {
                // Toggle the status
                $JobEducation->status = $JobEducation->status == 1 ? 0 : 1;

                // Save the updated record
                if ($JobEducation->save()) {
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

    public function deleteJobEducation(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Attempt to find and delete the record
            $JobEducation = JobEducation::find($id);

            if ($JobEducation) {
                $JobEducation->delete();
                return response()->json(['status_code' => 1, 'message' => 'Educational Qualification deleted successfully ']);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Educational Qualification not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function editJobEducation(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID

            $JobEducation = JobEducation::find($id);

            if ($JobEducation) {
                return response()->json(['data' => $JobEducation]);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function updateJobEducation(Request $request)
    {
        $rules = [
            'edit-id'              => 'required|exists:education,id',
            'edit_education_level' => 'required|string',
            'editeducation'        => 'required|string|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            $id = $request->input('edit-id');

            // Find the record by ID
            $JobEducation = JobEducation::find($id);

            if ($JobEducation) {
                $JobEducation->education_level = $request->input('edit_education_level');
                $JobEducation->education       = $request->input('editeducation');
                $JobEducation->branch          = $request->input('edit_branch');
                $JobEducation->updated_at      = now();

                if ($JobEducation->save()) {
                    return response()->json(['status_code' => 1, 'message' => 'Educational Qualification updated successfully']);
                } else {
                    return response()->json(['status_code' => 0, 'message' => 'Unable to update data']);
                }
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    public function createJob()
    {
        $data['jobTypes']      = JobTypes::where('status', 1)->select('type', 'status')->get();
        $data['jobMode']       = JobMode::where('status', 1)->select('mode', 'status')->get();
        $data['jobSkill']      = JobSkill::where('status', 1)->select('skill', 'status')->get();
        $data['JobDepartment'] = JobDepartment::where('status', 1)->select('department', 'status')->get();
        $data['JobRole']       = JobRole::where('status', 1)->select('role', 'status')->get();
        $data['JobExperience'] = JobExperience::where('status', 1)->select('experience', 'status')->get();
        $data['JobLocation']   = JobLocation::where('status', 1)->select('country', 'city', 'status')->get();
        $data['JobCategory']   = JobCategory::where('status', 1)->select('name', 'status')->get();
        $data['Companies']     = Companies::where('status', 1)->select('id', 'name', 'details', 'logo', 'status')->get();
        $data['JobIntType']    = JobIntType::where('status', 1)->select('id', 'int_type', 'status')->get();
        $data['JobCurrency']   = JobCurrency::where('status', 1)->select('id', 'currency', 'status')->get();
        $data['JobEducation']  = JobEducation::where('status', 1)->select('education_level', 'education', 'branch', 'status')->get();
        $data['JobSalary']     = JobSalary::where('status', 1)
            ->orderByRaw('CAST(salary AS UNSIGNED) ASC') // Ensures numeric sorting
            ->get();
        $data['Recruiter'] = Recruiter::where('user_type', 2)->where('status', 1)->get();
        return view('admin.job.CreateJob', $data);
    }

    public function getDepartment(Request $request)
    {

        if (! $request->has('category_name')) {
            return response()->json(['error' => 'Category Name is missing'], 400);
        }
        $JobDepartment = JobDepartment::where('category_name', $request->category_name)->select('department')->get();

        return response()->json($JobDepartment);

    }

    public function getRole(Request $request)
    {
        if (! $request->has('department_name')) {
            return response()->json(['error' => 'Department Name is missing'], 400);
        }

        $JobRole = JobRole::where('department_name', $request->department_name)
            ->select('role')
            ->get();

        return response()->json($JobRole);
    }

    public function getEducation(Request $request)
    {
        if (! $request->has('education_level')) {
            return response()->json(['error' => 'Education Level is missing'], 400);
        }

        $JobEducation = JobEducation::where('education_level', $request->education_level)
            ->select('education')
            ->distinct()
            ->get();

        return response()->json($JobEducation);
    }

    // Fetch Branches based on Selected Qualification
    public function getBranch(Request $request)
    {
        if (! $request->has('education')) {
            return response()->json(['error' => 'Education Name is missing'], 400);
        }

        $JobEducation = JobEducation::where('education', $request->education)
            ->whereNotNull('branch')
            ->select('branch')
            ->distinct()
            ->get();

        return response()->json($JobEducation);
    }

    public function submitJob(Request $request)
    {
        // dd($request->all());
        // Define validation rules
        $rules = [
            'recruiter_id'       => 'required',
            'job_title'          => 'required|string|max:100|',
            'job_type'           => 'required|string',
            'skills'             => 'required',
            'industry'           => 'required|string',
            'department'         => 'required|string',
            'role'               => 'required|string',
            'work_mode'          => 'required|string',
            'location'           => 'required|string',
            'min_experience'     => 'required|integer',
            'max_experience'     => 'required|string',
            'currency'           => 'required|string',
            'min_salary'         => 'required|integer',
            'max_salary'         => 'required',
            'education_level'    => 'required|string',
            'education'          => 'required|string',
            'branch'             => 'nullable',
            'candidate_industry' => 'nullable|string',
            'diversity'          => 'nullable|in:Male,Female',
            'vacancies'          => 'required|integer',
            'interview_type'     => 'required|string',
            'company_name'       => 'required|string',
            'company_details'    => 'required|string',
            'jobExp'             => 'required|date',
            'job_description'    => 'required|string',
            'job_resp'           => 'required|string',
            'job_req'            => 'required|string',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {
            // try {
                $JobPost = new JobPost();

                $JobPost->recruiter_id = $request->input('recruiter_id');
                $JobPost->title        = $request->input('job_title');
                $JobPost->type         = $request->input('job_type');
                // $JobPost->skills = $request->input('skills');
                $JobPost->skills          = implode(',', $request->input('skills'));
                $JobPost->industry        = $request->input('industry');
                $JobPost->department      = $request->input('department');
                $JobPost->role            = $request->input('role');
                $JobPost->mode            = $request->input('work_mode');
                $JobPost->location        = $request->input('location');
                $JobPost->min_exp         = $request->input('min_experience');
                $JobPost->max_exp         = $request->input('max_experience');
                $JobPost->currency        = $request->input('currency');
                $JobPost->min_sal         = $request->input('min_salary');
                $JobPost->max_sal         = $request->input('max_salary');
                $JobPost->sal_status      = $request->input('sal_status') ?? 'off';
                $JobPost->education_level = $request->input('education_level');
                $JobPost->education       = $request->input('education');
                // $JobPost->branch = implode(',', $request->input('branch',[]));
                $JobPost->branch             = implode(',', (array) $request->input('branch'));
                $JobPost->condidate_industry = $request->input('candidate_industry');
                $JobPost->diversity          = $request->input('diversity') ?? 'All';
                $JobPost->vacancies          = $request->input('vacancies');
                $JobPost->int_type           = $request->input('interview_type');
                $JobPost->com_name           = $request->input('company_name');
                $JobPost->com_logo           = $request->input('company_logo');
                $JobPost->com_details        = $request->input('company_details');
                $JobPost->jobexpiry          = $request->input('jobExp');
                $JobPost->job_desc           = $request->input('job_description');
                $JobPost->job_resp           = $request->input('job_resp');
                $JobPost->job_req            = $request->input('job_req');
                $JobPost->status             = 0;
                $JobPost->admin_verify       = 0;
                $JobPost->created_at         = now();

                // dd($JobPost);

                $JobPost->save();
                // $adminMail = UserProfile::where('user_type', 1)->where('user_details', 'Admin')->select('name', 'lname', 'email')->first();
                $recuiter = UserProfile::where('id',$request->input('recruiter_id'))->select('name','lname','email')->first();
                Mail::to($recuiter->email)->send(new JobPostMailToRecruiter($JobPost, $recuiter));


                return response()->json(['status_code' => 1, 'message' => 'Job Post added successfully']);
            // } catch (\Exception $e) {
            //     // Handle any exception that occurs during saving
            //     return response()->json(['status_code' => 0, 'message' => 'Unable to post Job']);
            // }
        } else {
            // Return validation errors
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }
    }

    // Job Post
    public function jobList()
    {
        return view('admin.job.JobList');
    }

    public function getJobPost(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'title',
            2 => 'admin_verify',
            3 => 'status',
            4 => 'recruiter_id',
            5 => 'created_at',
            6 => 'jobexpiry',
            7 => 'id',
        ];

        $query = JobPost::withCount('recruiter', 'applications');
        // Count Data

        if (! empty($search)) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir    = $order[0]['dir'];
            $query->orderBy($column, $dir);
        }

        $totalRecords = $query->count();

        $records = $query->offset($offset)->limit($limit)->orderBy('id', 'desc')->get();
        // dd($records);

        $data = [];
        foreach ($records as $record) {
            $dataArray = [];

            $dataArray[] = $record->id;
            $dataArray[] = ucfirst($record->title);

            $admin_verify = '<div class="d-flex">
                    <span onclick="toggleVerifyOptions(' . $record->id . ');"
                          class="badge ' . ($record->admin_verify == 1 ? 'bg-success' : ($record->admin_verify == 0 ? 'bg-warning' : 'bg-danger')) . ' text-uppercase"
                          style="cursor: pointer;">
                        ' . ($record->admin_verify == 1 ? 'Verified' : ($record->admin_verify == 0 ? 'Pending' : 'Rejected')) . '
                    </span>
                </div>';

            if ($record->admin_verify == 0) {
                $admin_verify .= '<div id="verify-options-' . $record->id . '" style="display: none; margin-top: 5px;">
                                    <div class="d-flex gap-2">
                                        <button class="badge bg-success text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(' . $record->id . ', 1)">Verify</button>
                                        <button class="badge bg-danger text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(' . $record->id . ', 2)">Reject</button>
                                    </div>
                                </div>';
            } elseif ($record->admin_verify == 1) {
                $admin_verify .= '<div id="verify-options-' . $record->id . '" style="display: none; margin-top: 5px;">
                                    <div class="d-flex gap-2">
                                        <button class="badge bg-danger text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(' . $record->id . ', 2)">Reject</button>
                                    </div>
                                </div>';
            } else {
                $admin_verify .= '<div id="verify-options-' . $record->id . '" style="display: none; margin-top: 5px;">
                                    <div class="d-flex gap-2">
                                        <button class="badge bg-success text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(' . $record->id . ', 1)">Verify</button>
                                    </div>
                                </div>';
            }

            $dataArray[] = $admin_verify;

            $status = $record->status == 1
            ? '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            // $dataArray[] = $record->recruiter->name ?? 'N/A' - $record->recruiter->email ?? 'N/A';
            $dataArray[] = ($record->recruiter->name ?? 'N/A') . ' - ' . ($record->recruiter->email ?? 'N/A');

            $dataArray[] = '<a href="' . route('Admin.AppliedUserList', ['job_id' => Crypt::encrypt($record->id)]) . '" class="badge bg-warning text-decoration-none" style="cursor: pointer;">' . $record->applications_count . ' Applied</a>';

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));
            // $dataArray[] = date('d-M-Y', strtotime($record->jobexpiry));
            $dataArray[] = '<span style="color: red;">' . date('d-M-Y', strtotime($record->jobexpiry)) . '</span>';

            $dataArray[] = '<div class="d-flex gap-2">

                                <div class="edit">
                                    <a href="' . route('Admin.ViewJobPost', ['id' => Crypt::encrypt($record->id)]) . '" class="edit-item-btn text-primary">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </div>
                                <div class="edit">
                                    <a href="' . route('Admin.EditJobPost', ['id' => Crypt::encrypt($record->id)]) . '" class="edit-item-btn text-primary">
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

    public function verifyStatus(Request $request)
    {
        $id     = $request->input('id');
        $status = $request->input('status');

        if (! empty($id)) {
            // Check if the record exists
            $JobPost = JobPost::find($id);
            if ($JobPost) {
                
                // JobPost::where('id', $id)->update(['admin_verify' => $status]);

                $JobPost->admin_verify = $status;
                $JobPost->save();

                $message = $status == 1 ? 'Job Post verified successfully' : 'Job Post rejected successfully';
               
                $recuiter = UserProfile::where('id',$JobPost->recruiter_id)->select('name','lname','email')->first();
               
                Mail::to($recuiter->email)->send(new JobVerifyMailToRecruiter($JobPost, $recuiter));
                
                return response()->json(['status_code' => 1, 'message' => $message]);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Job Post not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'ID is required']);
        }
    }

    public function changeJobPostStatus(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID
            $JobPost = JobPost::find($id);

            if ($JobPost) {
                // Toggle the status
                $JobPost->status = $JobPost->status == 1 ? 0 : 1;

                // Save the updated record
                if ($JobPost->save()) {

                    $recruiter = UserProfile::where('id',$JobPost->recruiter_id)->select('name','lname','email')->first();
                    Mail::to($recruiter->email)->send(new JobStatusMailToRecruiter($JobPost, $recruiter));
                   
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

    public function appliedUserList(Request $request)
    {

        // dd($request->all());
        $job_id      = $request->job_id;
        $decryptedId = null;
        if (! empty($job_id)) {
            $decryptedId = Crypt::decrypt($job_id);
        }
        // dd($decryptedId);
        $PostName = JobPost::where('id', $decryptedId)->value('title');
        // dd($PostName);
        $today   = Carbon::today();
        $joblist = JobPost::select('id', 'title')->where('status', 1)->where('admin_verify', 1)->whereDate('jobexpiry', '>=', $today)->get();
        $cities  = JobApplication::with('user')->get()->pluck('user.city')->filter()->unique()->values();
        $skills  = CandidateProfile::pluck('skill')
            ->filter()
            ->flatMap(function ($item) {
                // Remove square brackets and quotes
                $item = str_replace(['[', ']', '"'], '', $item);

                // Split and clean each skill
                $skills  = explode(',', $item);
                $cleaned = [];

                foreach ($skills as $skill) {
                    $skill = strtolower(trim($skill));
                    if (! empty($skill)) {
                        $cleaned[] = $skill;
                    }
                }

                return $cleaned;
            })
            ->unique()
            ->sort()
            ->values();

        // dd($skills);

        $data = [
            'qualifications' => UserProfile::select('qualification')->distinct()->pluck('qualification')->filter(),
            'branches'       => UserProfile::select('branch')->distinct()->pluck('branch')->filter(),
        ];

        $experience = JobExperience::pluck('experience');

        return view('admin.job.AppliedUserList', compact('joblist', 'cities', 'skills', 'data', 'decryptedId', 'experience', 'PostName'));
    }

    public function getAppliedUserList(Request $request)
    {
        $draw        = intval($request->input("draw"));
        $offset      = intval($request->input("start", 0));
        $limit       = intval($request->input('length', 10));
        $order       = $request->input("order");
        $decryptedId = $request->input('decryptedId');
        $jobId       = $request->input('job_id');
        // dd($jobId,$decryptedId);

        $education_level = $request->input('education_level');
        $Qualification   = $request->input('Qualification');
        $Branch          = $request->input('Branch');

        $city   = $request->input('city');
        $status = $request->input('status');
        $search = $request->input("search");

        $ProfileStatus = $request->input('Profilestatus');

        $skills = $request->input('skills'); // array
                                             // $experience = $request->input('experience'); // array
        $experience = $request->input('experience', []);

        // dd($Qualification);
        // If no job is selected, return empty result
        // if (empty($jobId)) {
        //     return response()->json([
        //         "draw"            => $draw,
        //         "recordsTotal"    => 0,
        //         "recordsFiltered" => 0,
        //         "data"            => [],
        //     ]);
        // }

        $columns = [
            0 => 'job_applications.id',
            1 => 'job_applications.user_id',
            2 => 'job_applications.user_id',
            3 => 'job_applications.user_id',
            4 => 'job_applications.user_id',
            5 => 'job_applications.status',
            6 => 'job_applications.created_at',
            7 => 'job_applications.recruiter_view',

        ];

        // dd($decryptedId);
        $query = JobApplication::with([
            'user:id,name,lname,email,logo,education_level,city,experience',
            'user.candidateProfile:skill',
            'jobPost:id,title',
        ])
            ->select(['id', 'user_id', 'job_id', 'status', 'recruiter_view', 'created_at']);

        if (! empty($jobId)) {
            $query->where('job_id', $jobId);
        } else {
            $query->where('job_id', $decryptedId);
        }

        // ->where('job_id', !empty($jobId) ? $jobId : $decryptedId);

        if (! empty($education_level)) {
            $query->whereHas('user', function ($q) use ($education_level) {
                $q->where('education_level', $education_level);
            });
        }

        if (! empty($Qualification)) {
            $query->whereHas('user', function ($q) use ($Qualification) {
                $q->where('qualification', 'like', '%' . $Qualification . '%');
            });
        }

        if (! empty($Branch)) {
            $query->whereHas('user', function ($q) use ($Branch) {
                $q->where('branch', 'like', '%' . $Branch . '%');
            });
        }

        if (! empty($city)) {
            $query->whereHas('user', function ($q) use ($city) {
                $q->where('city', $city);
            });
        }

        if (! empty($status)) {
            $query->where('status', $status);
        }

        if (isset($ProfileStatus)) {
            $query->where('recruiter_view', $ProfileStatus);
        }

        if (! empty($search)) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%');
            });
        }

        if (! empty($skills)) {
            $query->whereHas('user.candidateProfile', function ($q) use ($skills) {
                foreach ($skills as $skill) {
                    $q->where('skill', 'like', '%' . $skill . '%');
                }
            });
        }

        // if (! empty($experience)) {
        //     $query->whereHas('user', function ($q) use ($experience) {
        //         $q->where('experience', '<=', $experience);
        //     });
        // }
        if (! empty($experience) && is_array($experience)) {
            $experience = array_map('intval', $experience);
            $min        = min($experience);
            $max        = max($experience);

            $query->whereHas('user', function ($q) use ($min, $max) {
                $q->whereBetween('experience', [$min, $max]);
            });
        }

        if ($order) {
            $columnIndex = $order[0]['column'];
            $columnName  = $columns[$columnIndex];
            $dir         = $order[0]['dir'];

            // Sort with recruiter_view = '0' first (as string)
            $query->orderByRaw("recruiter_view = '0' DESC")->orderBy($columnName, $dir);
        } else {
            $query->orderByRaw("recruiter_view = '0' DESC")->orderBy('created_at', 'desc');
        }

        $totalRecords = $query->count();
        $records      = $query->offset($offset)->limit($limit)->get();
        // dd($records);
        $data = [];
        foreach ($records as $record) {
            $dataArray = [];

            $dataArray[] = $record->id;
            // $dataArray[] = '<a href="' . route('Recruiter.ViewJobPost', ['id' => Crypt::encrypt($record->jobPost->id)]) . '" class="text-primary"> '.ucfirst($record->jobPost->title).'</a>';

            $dataArray[] = '<div class="d-flex gap-2">
                <a href="' . route('Recruiter.ApllicantsDetails', [
                'userId' => Crypt::encrypt($record->user->id),
                'jobId'  => Crypt::encrypt($record->jobPost->id),
            ]) . '" class="text-primary text-decoration-none" data-bs-toggle="tooltip" title="View Profile">'
            . ucfirst($record->user->name) . ' ' . $record->user->lname .
                '</a>
            </div>';

            // $dataArray[] = ucfirst($record->user->name) .' '.$record->user->lname;
            $dataArray[] = $record->user->email ?? 'N/A';
            $dataArray[] = '<img src="' . asset($record->user->logo) . '" alt="Logo" style="height: 50px; width: 50px;border-radius:50px;" onclick="openImageModal(\'' . asset($record->user->logo) . '\')">';

            $dataArray[] = $record->user->city ?? 'N/A';

            // rejected shortlisted hired
            if ($record->status === 'pending') {
                $dataArray[] = '<span class="badge bg-warning text-dark">Applied</span>';

            } elseif ($record->status === 'shortlisted') {
                $dataArray[] = '<span class="badge bg-primary">' . ucfirst($record->status) . '</span>';

            } elseif ($record->status === 'rejected') {
                $dataArray[] = '<span class="badge bg-danger">' . ucfirst($record->status) . '</span>';
            } elseif ($record->status === 'hired') {
                $dataArray[] = '<span class="badge bg-success">' . ucfirst($record->status) . '</span>';
            }

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            // $dataArray[] = '<div class="d-flex gap-2">
            //   <a href="' . route('Recruiter.ApllicantsDetails', [
            //     'userId' => Crypt::encrypt($record->user->id),
            //     'jobId'  => Crypt::encrypt($record->jobPost->id),
            // ]) . '" class="badge bg-primary">View Profile</a>
            // </div>';

            $buttonClass = $record->recruiter_view == 1 ? 'bg-success text-white' : 'bg-warning text-dark';
            $buttonLabel = $record->recruiter_view == 1 ? 'Viewed' : 'Not Viewed';

            $dataArray[] = '<div class="d-flex gap-2">
                                <span class="badge ' . $buttonClass . '">' . $buttonLabel . '</span>
                            </div>';

            $dataArray[] = '<div class="d-flex gap-2">
                            <a href="' . route('Admin.ApllicantsDetails', [
                'userId' => Crypt::encrypt($record->user->id),
                'jobId'  => Crypt::encrypt($record->jobPost->id),
            ]) . '" class="badge bg-success">View Profile</a>
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

    public function getUserListQualifications(Request $request)
    {
        $education_level = $request->input('education_level');

        // Replace with your actual logic for fetching qualifications
        $qualifications = UserProfile::where('education_level', $education_level)
            ->pluck('qualification')
            ->unique()
            ->values();

        return response()->json($qualifications);
    }

    public function getUserListBranches(Request $request)
    {
        $qualification = $request->input('qualification');

        $branches = UserProfile::where('qualification', $qualification)
            ->pluck('branch')
            ->unique()
            ->filter() // optional: removes null values
            ->values();

        return response()->json($branches);
    }

    public function deleteJobPost(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Attempt to find and delete the record
            $JobPost = JobPost::find($id);

            if ($JobPost) {
                $JobPost->delete();
                return response()->json(['status_code' => 1, 'message' => 'Job Post deleted successfully ']);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Job Post not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function viewJobPost($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $job         = JobPost::findOrFail($decryptedId);
            // dd($job);
            $Recruiter = Recruiter::where('id', $job->recruiter_id)->first();
            // dd($Recruiter);

            return view('admin.job.ViewJob', compact('job', 'Recruiter'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid Job ID!');
        }
    }

    public function editJobPost($id)
    {
        try {

            $data['jobTypes']      = JobTypes::where('status', 1)->select('type', 'status')->get();
            $data['jobMode']       = JobMode::where('status', 1)->select('mode', 'status')->get();
            $data['jobSkill']      = JobSkill::where('status', 1)->select('skill', 'status')->get();
            $data['JobDepartment'] = JobDepartment::where('status', 1)->select('department', 'status')->get();
            $data['JobRole']       = JobRole::where('status', 1)->select('role', 'status')->get();
            $data['JobExperience'] = JobExperience::where('status', 1)->select('experience', 'status')->get();
            $data['JobLocation']   = JobLocation::where('status', 1)->select('country', 'city', 'status')->get();
            $data['JobCategory']   = JobCategory::where('status', 1)->select('name', 'status')->get();
            $data['Companies']     = Companies::where('status', 1)->select('id', 'name', 'details', 'logo', 'status')->get();
            $data['JobIntType']    = JobIntType::where('status', 1)->select('id', 'int_type', 'status')->get();
            $data['JobCurrency']   = JobCurrency::where('status', 1)->select('id', 'currency', 'status')->get();
            $data['JobEducation']  = JobEducation::where('status', 1)->select('education_level', 'education', 'branch', 'status')->get();
            $data['JobSalary']     = JobSalary::where('status', 1)
                ->orderByRaw('CAST(salary AS UNSIGNED) ASC') // Ensures numeric sorting
                ->get();
            $data['Recruiter'] = Recruiter::where('user_type', 2)->where('status', 1)->get();
            $decryptedId       = Crypt::decrypt($id);
            $jobPost           = JobPost::findOrFail($decryptedId);
            return view('admin.job.EditJob', compact('jobPost') + $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid Job ID!');
        }
    }

    public function updateJobPost(Request $request)
    {
        // dd($request->input('edit-id'));

        // Validate request
        $rules = [
            'job_title'          => 'required|string|max:100|',
            'job_type'           => 'required|string',
            'skills'             => 'required',
            'industry'           => 'required|string',
            'department'         => 'required|string',
            'role'               => 'required|string',
            'work_mode'          => 'required|string',
            'location'           => 'required|string',
            'min_experience'     => 'required|integer',
            'max_experience'     => 'required|string',
            'currency'           => 'required|string',
            'min_salary'         => 'required|integer',
            'max_salary'         => 'required',
            'education_level'    => 'required|string',
            'education'          => 'required|string',
            'branch'             => 'nullable',
            'candidate_industry' => 'nullable|string',
            'diversity'          => 'nullable|in:Male,Female',
            'vacancies'          => 'required|integer',
            'interview_type'     => 'required|string',
            'company_name'       => 'required|string',
            'company_details'    => 'required|string',
            'jobExp'             => 'required|date',
            'job_description'    => 'required|string',
            'job_resp'           => 'required|string',
            'job_req'            => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {

            $id = $request->input('edit-id');

            // Find the record by ID
            $JobPost = JobPost::find($id);

            if ($JobPost) {
                $JobPost->recruiter_id = $request->input('recruiter_id');
                $JobPost->title        = $request->input('job_title');
                $JobPost->type         = $request->input('job_type');
                // $JobPost->skills = $request->input('skills');
                $JobPost->skills = implode(',', $request->input('skills'));
                // $JobPost->industry = $request->input('industry');
                // $JobPost->department = $request->input('department');
                // $JobPost->role = $request->input('role');
                $JobPost->mode            = $request->input('work_mode');
                $JobPost->location        = $request->input('location');
                $JobPost->min_exp         = $request->input('min_experience');
                $JobPost->max_exp         = $request->input('max_experience');
                $JobPost->currency        = $request->input('currency');
                $JobPost->min_sal         = $request->input('min_salary');
                $JobPost->max_sal         = $request->input('max_salary');
                $JobPost->sal_status      = $request->input('sal_status') ?? 'off';
                $JobPost->education_level = $request->input('education_level');
                $JobPost->education       = $request->input('education');
                // $JobPost->branch = implode(',', $request->input('branch',[]));
                $JobPost->branch             = implode(',', (array) $request->input('branch'));
                $JobPost->condidate_industry = $request->input('candidate_industry');
                $JobPost->diversity          = $request->input('diversity') ?? 'All';
                $JobPost->vacancies          = $request->input('vacancies');
                $JobPost->int_type           = $request->input('interview_type');
                // $JobPost->com_name = $request->input('company_name');
                // $JobPost->com_logo = $request->input('company_logo');
                $JobPost->com_details  = $request->input('company_details');
                $JobPost->jobexpiry    = $request->input('jobExp');
                $JobPost->job_desc     = $request->input('job_description');
                $JobPost->job_resp     = $request->input('job_resp');
                $JobPost->job_req      = $request->input('job_req');
                $JobPost->status       = 0;
                $JobPost->admin_verify = 0;
                $JobPost->updated_at   = now();

                $JobPost->save();

                if ($JobPost->save()) {

                    $recruiter = UserProfile::where('id',$request->input('recruiter_id'))->select('name','lname','email')->first();
                    Mail::to($recruiter->email)->send(new JobUpdateMailToRecruiter($JobPost, $recruiter));
                    return response()->json(['status_code' => 1, 'message' => 'JobPost updated successfully']);
                } else {
                    return response()->json(['status_code' => 0, 'message' => 'Unable to update data']);
                }
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }

    }

    public function showverifiedjobs()
    {
        return view('admin.job.VerifiedJobs');
    }

    public function verifiedJobs(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'title',
            2 => 'admin_verify',
            3 => 'status',
            4 => 'created_at',
            5 => 'jobexpiry',
            6 => 'id',
        ];

        $query = JobPost::query()->where('admin_verify', 1);
        // Count Data

        if (! empty($search)) {
            $query->where('title', 'like', '%' . $search . '%');
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
            $dataArray[] = ucfirst($record->title);

            $admin_verify = '<div class="d-flex">
                    <span onclick="toggleVerifyOptions(' . $record->id . ');"
                          class="badge ' . ($record->admin_verify == 1 ? 'bg-success' : ($record->admin_verify == 0 ? 'bg-warning' : 'bg-danger')) . ' text-uppercase"
                          style="cursor: pointer;">
                        ' . ($record->admin_verify == 1 ? 'Verified' : ($record->admin_verify == 0 ? 'Pending' : 'Rejected')) . '
                    </span>
                </div>';

            if ($record->admin_verify == 0) {
                $admin_verify .= '<div id="verify-options-' . $record->id . '" style="display: none; margin-top: 5px;">
                                    <div class="d-flex gap-2">
                                        <button class="badge bg-success text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(' . $record->id . ', 1)">Verify</button>
                                        <button class="badge bg-danger text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(' . $record->id . ', 2)">Reject</button>
                                    </div>
                                </div>';
            } elseif ($record->admin_verify == 1) {
                $admin_verify .= '<div id="verify-options-' . $record->id . '" style="display: none; margin-top: 5px;">
                                    <div class="d-flex gap-2">
                                        <button class="badge bg-danger text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(' . $record->id . ', 2)">Reject</button>
                                    </div>
                                </div>';
            } else {
                $admin_verify .= '<div id="verify-options-' . $record->id . '" style="display: none; margin-top: 5px;">
                                    <div class="d-flex gap-2">
                                        <button class="badge bg-success text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(' . $record->id . ', 1)">Verify</button>
                                    </div>
                                </div>';
            }

            $dataArray[] = $admin_verify;

            $status = $record->status == 1
            ? '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));
            $dataArray[] = '<span style="color: red;">' . date('d-M-Y', strtotime($record->jobexpiry)) . '</span>';

            $dataArray[] = '<div class="d-flex gap-2">

                                <div class="edit">
                                    <a href="' . route('Admin.ViewJobPost', ['id' => Crypt::encrypt($record->id)]) . '" class="edit-item-btn text-primary">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </div>

                                <div class="edit">
                                    <a href="' . route('Admin.EditJobPost', ['id' => Crypt::encrypt($record->id)]) . '" class="edit-item-btn text-primary">
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

    public function showrejectedjobs()
    {
        return view('admin.job.RejectedJobs');
    }

    public function rejectedJobs(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'title',
            2 => 'admin_verify',
            3 => 'status',
            4 => 'created_at',
            5 => 'jobexpiry',
            6 => 'id',
        ];

        $query = JobPost::query()->where('admin_verify', 2);
        // Count Data

        if (! empty($search)) {
            $query->where('title', 'like', '%' . $search . '%');
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
            $dataArray[] = ucfirst($record->title);

            $admin_verify = '<div class="d-flex">
                    <span onclick="toggleVerifyOptions(' . $record->id . ');"
                          class="badge ' . ($record->admin_verify == 1 ? 'bg-success' : ($record->admin_verify == 0 ? 'bg-warning' : 'bg-danger')) . ' text-uppercase"
                          style="cursor: pointer;">
                        ' . ($record->admin_verify == 1 ? 'Verified' : ($record->admin_verify == 0 ? 'Pending' : 'Rejected')) . '
                    </span>
                </div>';

            if ($record->admin_verify == 0) {
                $admin_verify .= '<div id="verify-options-' . $record->id . '" style="display: none; margin-top: 5px;">
                                    <div class="d-flex gap-2">
                                        <button class="badge bg-success text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(' . $record->id . ', 1)">Verify</button>
                                        <button class="badge bg-danger text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(' . $record->id . ', 2)">Reject</button>
                                    </div>
                                </div>';
            } elseif ($record->admin_verify == 1) {
                $admin_verify .= '<div id="verify-options-' . $record->id . '" style="display: none; margin-top: 5px;">
                                    <div class="d-flex gap-2">
                                        <button class="badge bg-danger text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(' . $record->id . ', 2)">Reject</button>
                                    </div>
                                </div>';
            } else {
                $admin_verify .= '<div id="verify-options-' . $record->id . '" style="display: none; margin-top: 5px;">
                                    <div class="d-flex gap-2">
                                        <button class="badge bg-success text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(' . $record->id . ', 1)">Verify</button>
                                    </div>
                                </div>';
            }

            $dataArray[] = $admin_verify;

            $status = $record->status == 1
            ? '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));
            $dataArray[] = '<span style="color: red;">' . date('d-M-Y', strtotime($record->jobexpiry)) . '</span>';

            $dataArray[] = '<div class="d-flex gap-2">

                                <div class="edit">
                                    <a href="' . route('Admin.ViewJobPost', ['id' => Crypt::encrypt($record->id)]) . '" class="edit-item-btn text-primary">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </div>

                                <div class="edit">
                                    <a href="' . route('Admin.EditJobPost', ['id' => Crypt::encrypt($record->id)]) . '" class="edit-item-btn text-primary">
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

    public function showpendingjobs()
    {
        return view('admin.job.PendingJobs');
    }

    public function pendingJobs(Request $request)
    {
        // dd($request->all());
        $draw   = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order   = $request->input("order");
        $search  = $request->input("search");
        $columns = [
            0 => 'id',
            1 => 'title',
            2 => 'admin_verify',
            3 => 'status',
            4 => 'created_at',
            5 => 'jobexpiry',
            6 => 'id',
        ];

        $query = JobPost::query()->where('admin_verify', 0);
        // Count Data

        if (! empty($search)) {
            $query->where('title', 'like', '%' . $search . '%');
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
            $dataArray[] = ucfirst($record->title);

            $admin_verify = '<div class="d-flex">
                    <span onclick="toggleVerifyOptions(' . $record->id . ');"
                          class="badge ' . ($record->admin_verify == 1 ? 'bg-success' : ($record->admin_verify == 0 ? 'bg-warning' : 'bg-danger')) . ' text-uppercase"
                          style="cursor: pointer;">
                        ' . ($record->admin_verify == 1 ? 'Verified' : ($record->admin_verify == 0 ? 'Pending' : 'Rejected')) . '
                    </span>
                </div>';

            if ($record->admin_verify == 0) {
                $admin_verify .= '<div id="verify-options-' . $record->id . '" style="display: none; margin-top: 5px;">
                                    <div class="d-flex gap-2">
                                        <button class="badge bg-success text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(' . $record->id . ', 1)">Verify</button>
                                        <button class="badge bg-danger text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(' . $record->id . ', 2)">Reject</button>
                                    </div>
                                </div>';
            } elseif ($record->admin_verify == 1) {
                $admin_verify .= '<div id="verify-options-' . $record->id . '" style="display: none; margin-top: 5px;">
                                    <div class="d-flex gap-2">
                                        <button class="badge bg-danger text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(' . $record->id . ', 2)">Reject</button>
                                    </div>
                                </div>';
            } else {
                $admin_verify .= '<div id="verify-options-' . $record->id . '" style="display: none; margin-top: 5px;">
                                    <div class="d-flex gap-2">
                                        <button class="badge bg-success text-uppercase" style="cursor: pointer; border: none; padding: 5px 10px;" onclick="changeVerifyStatus(' . $record->id . ', 1)">Verify</button>
                                    </div>
                                </div>';
            }

            $dataArray[] = $admin_verify;

            $status = $record->status == 1
            ? '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = date('d-M-Y', strtotime($record->created_at));
            $dataArray[] = '<span style="color: red;">' . date('d-M-Y', strtotime($record->jobexpiry)) . '</span>';

            $dataArray[] = '<div class="d-flex gap-2">

                                <div class="edit">
                                    <a href="' . route('Admin.ViewJobPost', ['id' => Crypt::encrypt($record->id)]) . '" class="edit-item-btn text-primary">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </div>

                                <div class="edit">
                                    <a href="' . route('Admin.EditJobPost', ['id' => Crypt::encrypt($record->id)]) . '" class="edit-item-btn text-primary">
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
