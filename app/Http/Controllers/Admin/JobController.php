<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobSkill;
use App\Models\JobDepartment;
use App\Models\JobRole;
use App\Models\JobLocation;
use App\Models\JobCategory;
use App\Models\JobTypes;
use App\Models\JobShift;
use App\Models\JobExperience;
use App\Models\JobCurrency;
use App\Models\JobSalary;
use App\Models\JobMode;
use App\Models\JobIntType;
use App\Models\JobEducation;
use App\Models\JobPost;
use App\Models\Companies;
use Illuminate\Support\Str;



use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{

    public function JobSkill()
    {
        return view('admin.job.Jobskill');
    }

    public function getJobSkill(Request $request)
    {
        // dd($request->all());
        $draw = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order = $request->input("order");
        $search = $request->input("search");
        $columns = array(
            0 => 'id',
            1 => 'skill',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        );

        $query = JobSkill::query();
        // Count Data

        if (!empty($search)) {
            $query->where('skill', 'like', '%' . $search . '%');
        }
    
        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir = $order[0]['dir'];
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
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
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

        if (!$validator->fails()) {
            try {
                $JobSkill = new JobSkill();
                $JobSkill->skill = $request->input('skill');
                $JobSkill->status = 0;
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
    
        if (!empty($id)) {
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
    
        if (!empty($id)) {
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

        if (!empty($id)) {
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
            'edit-id' => 'required|exists:job_skill,id',
            'EditSkill' => 'required|max:100|unique:job_skill,skill',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $id = $request->input('edit-id');


            // Find the record by ID
            $JobSkill = JobSkill::find($id);

            if ($JobSkill) {
                $JobSkill->skill = $request->input('EditSkill');
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
    public function JobDepartment() {
        $data['JobCategory'] = JobCategory::select('name')->get(); 
        return view('admin.job.Jobdepartment',$data);
    }

    public function getJobDepartment(Request $request)
    {
        // dd($request->all());
        $draw = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order = $request->input("order");
        $search = $request->input("search");
        $columns = array(
            0 => 'id',
            1 => 'category_name',
            2 => 'department',
            3 => 'status',
            4 => 'created_at',
            5 => 'id',
        );

        $query = JobDepartment::query();
        // Count Data

        if (!empty($search)) {
            $query->where('department', 'like', '%' . $search . '%');
        }
    
        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir = $order[0]['dir'];
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
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
        ]);
    }

    public function addJobDepartment(Request $request)
    {
  
        // Define validation rules
        $rules = [
            'category' => 'required',
            'department' => 'required|string|max:100|unique:job_department,department',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            try {
                $JobDepartment = new JobDepartment();
                $JobDepartment->category_name = $request->input('category');
                $JobDepartment->department = $request->input('department');
                $JobDepartment->status = 0;
                $JobDepartment->created_at = now();

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
    
        if (!empty($id)) {
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
    
        if (!empty($id)) {
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

        if (!empty($id)) {
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
            'edit-id' => 'required|exists:job_department,id',
            'editcategory' => 'required',
            'editdepartment' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $id = $request->input('edit-id');


            // Find the record by ID
            $JobDepartment = JobDepartment::find($id);

            if ($JobDepartment) {
                $JobDepartment->category_name = $request->input('editcategory');
                $JobDepartment->department = $request->input('editdepartment');
                $JobDepartment->updated_at = now();

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
    public function JobRole() {
        $data['JobDepartment'] = JobDepartment::select('department')->get(); 
        return view('admin.job.Jobrole',$data);
    }

    public function getJobRole(Request $request)
    {
        // dd($request->all());
        $draw = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order = $request->input("order");
        $search = $request->input("search");
        $columns = array(
            0 => 'id',
            1 => 'department_name',
            2 => 'role',
            3 => 'status',
            4 => 'created_at',
            5 => 'id',
        );

        $query = JobRole::query();
        // Count Data

        if (!empty($search)) {
            $query->where('role', 'like', '%' . $search . '%');
        }
    
        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir = $order[0]['dir'];
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
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
        ]);
    }

    public function addJobRole(Request $request)
    {
  
        // Define validation rules
        $rules = [
            'department' => 'required',
            'role' => 'required|string|max:100|unique:job_role,role',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            try {
                $JobRole = new JobRole();
                $JobRole->department_name = $request->input('department');
                $JobRole->role = $request->input('role');
                $JobRole->status = 0;
                $JobRole->created_at = now();

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
    
        if (!empty($id)) {
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
    
        if (!empty($id)) {
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

        if (!empty($id)) {
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
            'edit-id' => 'required|exists:job_role,id',
            'editdepartment' => 'required',
            'editrole' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $id = $request->input('edit-id');


            // Find the record by ID
            $JobRole = JobRole::find($id);

            if ($JobRole) {
                $JobRole->department_name = $request->input('editdepartment');
                $JobRole->role = $request->input('editrole');
                $JobRole->updated_at = now();

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
        $draw = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order = $request->input("order");
        $search = $request->input("search");
        $columns = array(
            0 => 'id',
            1 => 'country',
            2 => 'city',
            3 => 'status',
            4 => 'created_at',
            5 => 'id',
        );

        $query = JobLocation::query();
        // Count Data

        if (!empty($search)) {
            $query->where('country', 'like', '%' . $search . '%')
                ->orwhere('city', 'like', '%' . $search . '%');
        }
    
        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir = $order[0]['dir'];
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
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
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

        if (!$validator->fails()) {
            try {
                $JobLocation = new JobLocation();
                $JobLocation->country = $request->input('country');
                $JobLocation->city = $request->input('city');
                $JobLocation->status = 0;
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
    
        if (!empty($id)) {
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
    
        if (!empty($id)) {
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

        if (!empty($id)) {
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
            'edit-id' => 'required|exists:job_location,id',
            'editcountry' => 'required|max:100',
            'editcity' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $id = $request->input('edit-id');


            // Find the record by ID
            $JobLocation = JobLocation::find($id);

            if ($JobLocation) {
                $JobLocation->country = $request->input('editcountry');
                $JobLocation->city = $request->input('editcity');
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
        $draw = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order = $request->input("order");
        $search = $request->input("search");
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        );

        $query = JobCategory::query();
        // Count Data

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }
    
        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir = $order[0]['dir'];
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
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
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

        if (!$validator->fails()) {
            try {
                $JobLocation = new JobCategory();
                $JobLocation->name = $request->input('category');
                $JobLocation->status = 0;
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
    
        if (!empty($id)) {
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
    
        if (!empty($id)) {
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

        if (!empty($id)) {
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
            'edit-id' => 'required|exists:job_category,id',
            'editcategory' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $id = $request->input('edit-id');


            // Find the record by ID
            $JobCategory = JobCategory::find($id);

            if ($JobCategory) {
                $JobCategory->name = $request->input('editcategory');
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
        $draw = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));
        $order = $request->input("order");
        $search = $request->input("search");
        $columns = array(
            0 => 'id',
            1 => 'type',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        );

        $query = JobTypes::query();
        // Count Data

        if (!empty($search)) {
            $query->where('type', 'like', '%' . $search . '%');
        }
    
        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir = $order[0]['dir'];
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
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
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

        if (!$validator->fails()) {
            try {
                $JobTypes = new JobTypes();
                $JobTypes->type = $request->input('types');
                $JobTypes->status = 0;
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
    
        if (!empty($id)) {
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
    
        if (!empty($id)) {
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

        if (!empty($id)) {
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
            'edit-id' => 'required|exists:job_types,id',
            'editType' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $id = $request->input('edit-id');


            // Find the record by ID
            $JobTypes = JobTypes::find($id);

            if ($JobTypes) {
                $JobTypes->type = $request->input('editType');
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
        $draw = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));
        $order = $request->input("order");
        $search = $request->input("search");
        $columns = array(
            0 => 'id',
            1 => 'mode',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        );

        $query = JobMode::query();
        // Count Data

        if (!empty($search)) {
            $query->where('mode', 'like', '%' . $search . '%');
        }
    
        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir = $order[0]['dir'];
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
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
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

        if (!$validator->fails()) {
            try {
                $JobMode = new JobMode();
                $JobMode->mode = $request->input('mode');
                $JobMode->status = 0;
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
    
        if (!empty($id)) {
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
    
        if (!empty($id)) {
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

        if (!empty($id)) {
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
            'edit-id' => 'required|exists:job_mode,id',
            'editMode' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $id = $request->input('edit-id');


            // Find the record by ID
            $JobMode = JobMode::find($id);

            if ($JobMode) {
                $JobMode->mode = $request->input('editMode');
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
        $draw = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));
        $order = $request->input("order");
        $search = $request->input("search");
        $columns = array(
            0 => 'id',
            1 => 'shift',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        );

        $query = JobShift::query();
        // Count Data

        if (!empty($search)) {
            $query->where('shift', 'like', '%' . $search . '%');
        }
    
        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir = $order[0]['dir'];
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
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
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

        if (!$validator->fails()) {
            try {
                $JobShift = new JobShift();
                $JobShift->shift = $request->input('shift');
                $JobShift->status = 0;
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
    
        if (!empty($id)) {
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
    
        if (!empty($id)) {
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

        if (!empty($id)) {
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
            'edit-id' => 'required|exists:job_shift,id',
            'editShift' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $id = $request->input('edit-id');


            // Find the record by ID
            $JobShift = JobShift::find($id);

            if ($JobShift) {
                $JobShift->shift = $request->input('editShift');
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
        $draw = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));
        $order = $request->input("order");
        $search = $request->input("search");
        $columns = array(
            0 => 'id',
            1 => 'experience',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        );

        $query = JobExperience::query();
        // Count Data

        if (!empty($search)) {
            $query->where('experience', 'like', '%' . $search . '%');
        }
    
        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir = $order[0]['dir'];
            $query->orderBy($column, $dir);
        }

        $totalRecords = $query->count();

        $records = $query->offset($offset)->limit($limit)->orderBy('id', 'desc')->get();


        $data = [];
        foreach ($records as $record) {
            $dataArray = [];

            $dataArray[] = $record->id;
            $dataArray[] = ucfirst($record->experience);

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
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
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

        if (!$validator->fails()) {
            try {
                $Jobexp = new JobExperience();
                $Jobexp->experience = $request->input('experience');
                $Jobexp->status = 0;
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
    
        if (!empty($id)) {
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
    
        if (!empty($id)) {
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

        if (!empty($id)) {
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

        if (!$validator->fails()) {
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
        $draw = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));
        $order = $request->input("order");
        $search = $request->input("search");
        $columns = array(
            0 => 'id',
            1 => 'currency',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        );

        $query = JobCurrency::query();
        // Count Data

        if (!empty($search)) {
            $query->where('currency', 'like', '%' . $search . '%');
        }
    
        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir = $order[0]['dir'];
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
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
        ]);
    }

    public function addJobCurrency(Request $request)
    {
  
        // Define validation rules
        $rules = [
            'currency' => 'required|string|unique:currency,currency',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            try {
                $JobCurrency = new JobCurrency();
                $JobCurrency->currency = $request->input('currency');
                $JobCurrency->status = 0;
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
    
        if (!empty($id)) {
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
    
        if (!empty($id)) {
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

        if (!empty($id)) {
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
            'edit-id' => 'required|exists:currency,id',
            'editcurrency' => 'required|string|unique:currency,currency',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $id = $request->input('edit-id');

            // Find the record by ID
            $JobCurrency = JobCurrency::find($id);

            if ($JobCurrency) {
                $JobCurrency->currency = $request->input('editcurrency');
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
        $draw = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));
        $order = $request->input("order");
        $search = $request->input("search");
        $columns = array(
            0 => 'id',
            1 => 'salary',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        );

        $query = JobSalary::query();
        // Count Data

        if (!empty($search)) {
            $query->where('salary', 'like', '%' . $search . '%');
        }
    
        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir = $order[0]['dir'];
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
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
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

        if (!$validator->fails()) {
            try {
                $JobSalary = new JobSalary();
                $JobSalary->salary = $request->input('salary');
                $JobSalary->status = 0;
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
    
        if (!empty($id)) {
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
    
        if (!empty($id)) {
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

        if (!empty($id)) {
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
            'edit-id' => 'required|exists:annual_salary,id',
            'editsalary' => 'required|integer|min:1000|max:10000000|unique:annual_salary,salary',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $id = $request->input('edit-id');

            // Find the record by ID
            $JobSalary = JobSalary::find($id);

            if ($JobSalary) {
                $JobSalary->salary = $request->input('editsalary');
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
    public function JobIntType() {
        return view('admin.job.Jobinttype');
    }

    public function getJobIntType(Request $request)
    {
        // dd($request->all());
        $draw = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order = $request->input("order");
        $search = $request->input("search");
        $columns = array(
            0 => 'id',
            1 => 'int_type',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        );

        $query = JobIntType::query();
        // Count Data

        if (!empty($search)) {
            $query->where('int_type', 'like', '%' . $search . '%');
        }
    
        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir = $order[0]['dir'];
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
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
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

        if (!$validator->fails()) {
            try {
                $JobIntType = new JobIntType();
                $JobIntType->int_type = $request->input('IntType');
                $JobIntType->status = 0;
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
    
        if (!empty($id)) {
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
    
        if (!empty($id)) {
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

        if (!empty($id)) {
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
            'edit-id' => 'required|exists:interview_type,id',
            'editIntType' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $id = $request->input('edit-id');


            // Find the record by ID
            $JobIntType = JobIntType::find($id);

            if ($JobIntType) {
                $JobIntType->int_type = $request->input('editIntType');
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
        $draw = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order = $request->input("order");
        $search = $request->input("search");
        $columns = array(
            0 => 'id',
            1 => 'education',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
        );

        $query = JobEducation::query();
        // Count Data

        if (!empty($search)) {
            $query->where('education', 'like', '%' . $search . '%');
        }
    
        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir = $order[0]['dir'];
            $query->orderBy($column, $dir);
        }

        $totalRecords = $query->count();

        $records = $query->offset($offset)->limit($limit)->orderBy('id', 'desc')->get();


        $data = [];
        foreach ($records as $record) {
            $dataArray = [];

            $dataArray[] = $record->id;
            $dataArray[] = ucfirst($record->education);

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
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
        ]);
    }


    public function addJobEducation(Request $request)
    {
  
        // Define validation rules
        $rules = [
            'education' => 'required|string|max:100|unique:education,education',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            try {
                $JobEducation = new JobEducation();
                $JobEducation->education = $request->input('education');
                $JobEducation->status = 0;
                $JobEducation->created_at = now();

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
    
        if (!empty($id)) {
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
    
        if (!empty($id)) {
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

        if (!empty($id)) {
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
            'edit-id' => 'required|exists:education,id',
            'editeducation' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $id = $request->input('edit-id');


            // Find the record by ID
            $JobEducation = JobEducation::find($id);

            if ($JobEducation) {
                $JobEducation->education = $request->input('editeducation');
                $JobEducation->updated_at = now();

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


    // Job Post
    public function jobPost()
    {
        $data['jobTypes'] = JobTypes::where('status', 1)->select('type','status')->get(); 
        $data['jobMode'] = JobMode::where('status', 1)->select('mode','status')->get(); 
        $data['jobSkill'] = JobSkill::where('status', 1)->select('skill','status')->get(); 
        $data['JobDepartment'] = JobDepartment::where('status', 1)->select('department','status')->get(); 
        $data['JobRole'] = JobRole::where('status', 1)->select('role','status')->get(); 
        $data['JobExperience'] = JobExperience::where('status', 1)->select('experience','status')->get(); 
        $data['JobLocation'] = JobLocation::where('status', 1)->select('country','city','status')->get(); 
        $data['JobCategory'] = JobCategory::where('status', 1)->select('name','status')->get(); 
        $data['Companies'] = Companies::where('status', 1)->select('id', 'name', 'details', 'status')->get(); 
        $data['JobIntType'] = JobIntType::where('status', 1)->select('id', 'int_type','status')->get();
        $data['JobCurrency'] = JobCurrency::where('status', 1)->select('id', 'currency', 'status')->get();
        $data['JobEducation'] = JobEducation::where('status', 1)->select('education', 'status')->get();
        // $data['JobSalary'] = JobSalary::where('status', 1)->select('id', 'salary', 'status')->orderBy('salary', 'ASC')->get();

        $data['JobSalary'] = JobSalary::where('status', 1)
        ->orderByRaw('CAST(salary AS UNSIGNED) ASC') // Ensures numeric sorting
        ->get();
        return view('admin.job.Jobpost',$data);
    }

    public function getJobPost(Request $request)
    {
        // dd($request->all());
        $draw = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        // $limit = 10;
        $limit = intval($request->input('length', 10));

        $order = $request->input("order");
        $search = $request->input("search");
        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'admin_verify',
            3 => 'status',
            4 => 'created_at',
            5 => 'id',
        );

        $query = JobPost::query();
        // Count Data

        if (!empty($search)) {
            $query->where('title', 'like', '%' . $search . '%');
        }
    
        if ($order) {
            $column = $columns[$order[0]['column']];
            $dir = $order[0]['dir'];
            $query->orderBy($column, $dir);
        }

        $totalRecords = $query->count();

        $records = $query->offset($offset)->limit($limit)->orderBy('id', 'desc')->get();


        $data = [];
        foreach ($records as $record) {
            $dataArray = [];

            $dataArray[] = $record->id;
            $dataArray[] = ucfirst($record->title);

            $admin_verify = $record->admin_verify == 1
                ? '<div class="d-flex"><span onclick="changeVerifyStatus(' . $record->id . ');" class="badge bg-success text-uppercase" style="cursor: pointer;">Verified</span></div>'
                : ($record->admin_verify == 2
                    ? '<div class="d-flex"><span onclick="changeVerifyStatus(' . $record->id . ');" class="badge bg-warning text-uppercase" style="cursor: pointer;">Pending</span></div>'
                    : '<div class="d-flex"><span onclick="changeVerifyStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Rejected</span></div>');
                    
            $dataArray[] = $admin_verify;
        

            $status = $record->status == 1
                ? '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
                : '<div class="d-flex "><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;


            $dataArray[] = date('d-M-Y', strtotime($record->created_at));

            $dataArray[] = '<div class="d-flex gap-2">
                                <div class="edit">
                                    <a href="' . route('Recruiter.EditJobPost', ['id' => Crypt::encrypt($record->id)]) . '" class="edit-item-btn text-primary">
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
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
        ]);
    }

    public function changeJobPostStatus(Request $request)
    {
        $id = $request->input('id');
    
        if (!empty($id)) {
            // Find the record by ID
            $JobPost = JobPost::find($id);
    
           
            if ($JobPost) {
                // Toggle the status
                $JobPost->status = $JobPost->status == 1 ? 0 : 1;
    
                // Save the updated record
                if ($JobPost->save()) {
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

    public function deleteJobPost(Request $request)
    {
        $id = $request->input('id');
    
        if (!empty($id)) {
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


}
