<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Companies;


class CompanyController extends Controller
{
    public function Companies()
    {
        return view('admin.Company');
    }
    public function getCompanies(Request $request)
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
            2 => 'email',
            3 => 'phone',
            4 => 'website',
            5 => 'details',
            6 => 'address',
            7 => 'logo',
            8 => 'status',
            9 => 'created_at',
            10 => 'id',
        );

        $query = Companies::query();
        // Count Data

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%')
                    ->orwhere('email', 'like', '%' . $search . '%')
                    ->orwhere('phone', 'like', '%' . $search . '%')
                    ->orwhere('website', 'like', '%' . $search . '%')
                    ->orwhere('address', 'like', '%' . $search . '%');
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
            $dataArray[] = $record->email;
            $dataArray[] = $record->phone;
            // $dataArray[] = $record->website;
            $dataArray[] = '<a href="javascript:void(0);" onclick="copyToClipboard(\'' . $record->website . '\')">' . $record->website . '</a>';

            // Details with "View More" Popup
            $shortDetails = Str::limit($record->details, 40, '...');
            $dataArray[] = '<span>' . $shortDetails . '</span>
                    <a href="javascript:void(0);" class="view-more" onclick="openDetailsModal(\'' . htmlspecialchars($record->details, ENT_QUOTES) . '\')">View More</a>';


            $dataArray[] = $record->address;
            // $dataArray[] = $record->logo;
            // $dataArray[] = '<img src="' . asset( $record->logo) . '" alt="Logo" style="height: 100px; width: 100px;">';
            $dataArray[] = '<img src="' . asset($record->logo) . '" alt="Logo" style="height: 100px; width: 100px;" onclick="openImageModal(\'' . asset($record->logo) . '\')">';

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

    public function addCompany(Request $request)
    {
  
        // Define validation rules
        $rules = [
            'name' => 'required|string|max:255|unique:companies,name',
            'email' => 'required|email|max:255|unique:companies,email',
            'phone' => 'required|digits_between:10,15|unique:companies,phone',
            'website' => 'required|url|max:255|unique:companies,website',
            'details' => 'required|string|min:10|max:255|unique:companies,website',
            'address' => 'required|string|min:10|max:255',
            'logo' => 'required|image|max:2048',
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

    public function changeCompanyStatus(Request $request)
    {
        $id = $request->input('id');
    
        if (!empty($id)) {
            // Find the record by ID
            $Companies = Companies::find($id);
    
           
            if ($Companies) {
                // Toggle the status
                $Companies->status = $Companies->status == 1 ? 0 : 1;
    
                // Save the updated record
                if ($Companies->save()) {
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

    public function deleteCompany(Request $request)
    {
        $id = $request->input('id');
    
        if (!empty($id)) {
            // Attempt to find and delete the record
            $Companies = Companies::find($id);
    
            if ($Companies) {
                $Companies->delete();
                return response()->json(['status_code' => 1, 'message' => 'Company deleted successfully ']);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Company not found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function editCompany(Request $request)
    {
        $id = $request->input('id');

        if (!empty($id)) {
            // Find the record by ID
         
            $Companies = Companies::find($id);

            if ($Companies) {
                return response()->json(['data' => $Companies]);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function updateCompany(Request $request)
    {
        $rules = [
            'edit-id' => 'required|exists:companies,id',
            'editname' => 'required|string|max:255',
            'editemail' => 'required|email|max:255',
            'editphone' => 'required|digits_between:10,15',
            'editwebsite' => 'required|url|max:255',
            'editdetails' => 'required|string|min:10|max:255',
            'editaddress' => 'required|string|min:10|max:255',
            'editlogo' => 'nullable|image|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {

            $logoPath = null;

            if ($request->hasFile('editlogo')) {
                $logo = $request->file('editlogo');
                $logoName = time() . '.' . $logo->getClientOriginalExtension(); 
                $logo->move(public_path('company/logo'), $logoName);
                $logoPath = ('company/logo/'. $logoName);
            }

            $id = $request->input('edit-id');

            // Find the record by ID
            $Company = Companies::find($id);

            if ($Company) {
                $Company->name = $request->input('editname');
                $Company->email = $request->input('editemail');
                $Company->phone = $request->input('editphone');
                $Company->website = $request->input('editwebsite');
                $Company->details = $request->input('editdetails');
                $Company->address = $request->input('editaddress');

                // Update logoPath if provided
                if ($logoPath) {
                    $Company->logo = $logoPath;
                }
        
                $Company->updated_at = now();

                $Company->save();

                if ($Company->save()) {
                    return response()->json(['status_code' => 1, 'message' => 'Company updated successfully']);
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
