<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Crypt;


class UsersListController extends Controller
{
    public function userList()
    {
        return view('admin.Users.UsersList');
    }

     public function getUsersList(Request $request)
    {
        $draw = intval($request->input("draw"));
        $offset = trim($request->input('start'));
        $limit = intval($request->input('length', 10));

        $order = $request->input("order");
        $search = $request->input("search");
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'phone',
            4 => 'logo',
            5 => 'status',
            6 => 'created_at',
        );

       $query = UserProfile::where('user_type', 0);

        // Apply search if provided
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%');
            });
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
            $dataArray[] = ucfirst($record->name.' ' .$record->lname);
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
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
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
        return view('admin.Users.EditUser',compact('user'));
    }
}
