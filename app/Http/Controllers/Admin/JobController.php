<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobSkill;
use App\Models\JobRole;
use App\Models\JobLocation;
use App\Models\JobCategory;
use App\Models\JobTypes;
use App\Models\JobShift;
use App\Models\JobExperience;
use App\Models\JobMode;

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



    // Role
    public function JobRole() {
        return view('admin.job.Jobrole');
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
            1 => 'role',
            2 => 'status',
            3 => 'created_at',
            4 => 'id',
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
            'role' => 'required|string|max:100|unique:job_role,role',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            try {
                $JobRole = new JobRole();
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
            'editrole' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $id = $request->input('edit-id');


            // Find the record by ID
            $JobRole = JobRole::find($id);

            if ($JobRole) {
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
            'experience' => 'required|string|max:100|unique:job_experience,experience',
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







}
