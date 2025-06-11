<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Admin\AddRecruiterMailToRecruiter;
use App\Mail\Admin\RecruiterStatusMailToRecruiter;
use App\Mail\Admin\RecruiterUpdateMailToRecruiter;
use App\Models\EmailTemplates;
use App\Models\Jobpost;
use App\Models\Recruiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RecruiterController extends Controller
{
    public function recruiters()
    {
        // $recruiters = Recruiter::where('user_type', 2)->get();
        $recruiters = Recruiter::where('user_type', 2)
            ->where('status', 1) // assuming 1 means active
            ->get();

        return view('admin.recruiter.recruiters', compact('recruiters'));
    }

    public function getRecruiters(Request $request)
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
            2 => 'lname',
            3 => 'email',
            4 => 'phone',
            5 => 'logo',
            6 => 'status',
            7 => 'job post',
            8 => 'created_at',
            9 => 'id',
        ];

        // $query = Recruiter::query()->where('user_type', 2);
        $query = Recruiter::withCount('JobPost')->where('user_type', 2);
        // dd($query);

        // Count Data
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
            $dataArray[] = ucfirst($record->name);
            $dataArray[] = ucfirst($record->lname);
            $dataArray[] = $record->email;
            $dataArray[] = $record->phone;
            // $dataArray[] = $record->logo;
            // $dataArray[] = '<img src="' . asset( $record->logo) . '" alt="Logo" style="height: 100px; width: 100px;">';
            $dataArray[] = '<img src="' . asset($record->logo) . '" alt="Logo" style="height: 100px; width: 100px;" onclick="openImageModal(\'' . asset($record->logo) . '\')">';

            $status = $record->status == 1
            ? '<div class="d-flex"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-success text-uppercase"  style="cursor: pointer;">Active</span></div>'
            : '<div class="d-flex"><span onclick="changeStatus(' . $record->id . ');" class="badge bg-danger text-uppercase" style="cursor: pointer;">Inactive</span></div>';

            $dataArray[] = $status;

            $dataArray[] = $record->job_post_count;

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

    public function addRecruiter(Request $request)
    {
        $rules = [
            'name'     => 'required|string|max:255',
            'lname'    => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'phone'    => 'required|digits_between:10,15|unique:users,phone',
            'logo'     => 'required|image|max:2048',
            'password' => 'required|min:8|max:100|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()]);
        }

        DB::beginTransaction();

        try {
            // Upload logo
            $logoPath = null;
            if ($request->hasFile('logo')) {
                $logo     = $request->file('logo');
                $logoName = time() . '.' . $logo->getClientOriginalExtension();
                $logo->move(public_path('recruiter/logo'), $logoName);
                $logoPath = 'recruiter/logo/' . $logoName;
            }

            // Create Recruiter
            $Recruiter               = new Recruiter();
            $Recruiter->user_type    = 2;
            $Recruiter->user_details = 'Recruiter';
            $Recruiter->name         = $request->input('name');
            $Recruiter->lname        = $request->input('lname');
            $Recruiter->email        = $request->input('email');
            $Recruiter->phone        = $request->input('phone');
            $Recruiter->logo         = $logoPath;
            $Recruiter->password     = Hash::make($request->input('password'));
            $Recruiter->status       = 0;
            $Recruiter->created_at   = now();
            $Recruiter->save();

            // Send email only if template allows
            $template = EmailTemplates::find(1);
            if ($template && $template->show_email == '1') {
                try {
                    Mail::to($Recruiter->email)->send(new AddRecruiterMailToRecruiter($Recruiter));
                } catch (\Exception $mailException) {
                    DB::rollBack();
                    Log::error('Recruiter email send failed: ' . $mailException->getMessage());
                    return response()->json([
                        'status_code' => 0,
                        'message'     => 'Recruiter creation failed while sending email.',
                    ]);
                }
            }

            DB::commit();
            $message = ($template && $template->show_email == '1') ?
            'Recruiter created and email sent successfully.' :
            'Recruiter created successfully.';

            return response()->json(['status_code' => 1, 'message' => $message]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Recruiter creation error: ' . $e->getMessage());

            return response()->json([
                'status_code' => 0,
                'message'     => 'Unable to add recruiter.',
            ]);
        }
    }

    public function changeRecruiterStatus(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID
            $Recruiter = Recruiter::find($id);

            if ($Recruiter) {
                // Toggle the status
                $Recruiter->status = $Recruiter->status == 1 ? 0 : 1;

                // Save the updated record
                if ($Recruiter->save()) {
                    // Send email only if template allows
                    $template = EmailTemplates::find(6);
                    if ($template && $template->show_email == '1') {
                        try {
                            Mail::to($Recruiter->email)->send(new RecruiterStatusMailToRecruiter($Recruiter));
                        } catch (\Exception $mailException) {
                            DB::rollBack();
                            Log::error('Status Change email send failed: ' . $mailException->getMessage());
                            return response()->json([
                                'status_code' => 0,
                                'message'     => 'Status Change failed while sending email.',
                            ]);
                        }
                    }

                    $message = ($template && $template->show_email == '1') ?
                    'Status Change and email sent successfully.' :
                    'Status Change successfully.';

                    return response()->json(['status_code' => 1, 'message' => $message]);
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

    public function deleteRecruiter(Request $request)
    {
        $id             = $request->input('id');
        $newRecruiterId = $request->input('new_recruiter_id');

        if (! $id || ! $newRecruiterId) {
            return response()->json(['status_code' => 2, 'message' => 'Both Recruiter ID and New Recruiter ID are required.']);
        }

        if ($id == $newRecruiterId) {
            return response()->json(['status_code' => 0, 'message' => 'Cannot reassign jobs to the same recruiter.']);
        }

        $recruiter    = Recruiter::find($id);
        $newRecruiter = Recruiter::find($newRecruiterId);

        if (! $recruiter || ! $newRecruiter) {
            return response()->json(['status_code' => 0, 'message' => 'Recruiter not found.']);
        }

        // Step 1: Reassign job posts
        Jobpost::where('recruiter_id', $id)->update([
            'recruiter_id' => $newRecruiterId,
        ]);

        // Step 2: Attempt to delete the recruiter
        if ($recruiter->delete()) {
            // Step 3: Only unlink logo if recruiter deleted successfully
            if ($recruiter->logo && file_exists(public_path($recruiter->logo))) {
                unlink(public_path($recruiter->logo));
            }

            return response()->json(['status_code' => 1, 'message' => 'Recruiter deleted and jobs reassigned.']);
        } else {
            return response()->json(['status_code' => 0, 'message' => 'Recruiter deletion failed.']);
        }
    }

    public function editRecruiter(Request $request)
    {
        $id = $request->input('id');

        if (! empty($id)) {
            // Find the record by ID

            $editRecruiter = Recruiter::find($id);

            if ($editRecruiter) {
                return response()->json(['data' => $editRecruiter]);
            } else {
                return response()->json(['status_code' => 0, 'message' => 'Invalid id found']);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => 'Id is required']);
        }
    }

    public function updateRecruiter(Request $request)
    {
        $rules = [
            'edit-id'   => 'required|exists:users,id',
            'editname'  => 'required|string|max:255',
            'editlname' => 'required|string|max:255',
            'editemail' => 'required|email|max:255',
            'editphone' => 'required|digits_between:10,15',
            'editlogo'  => 'nullable|image|max:2048',
            'password'  => 'nullable|min:8|max:100|confirmed',

        ];

        $validator = Validator::make($request->all(), $rules);

        if (! $validator->fails()) {

            $logoPath = null;

            if ($request->hasFile('editlogo')) {
                $logo     = $request->file('editlogo');
                $logoName = time() . '.' . $logo->getClientOriginalExtension();
                $logo->move(public_path('recruiter/logo'), $logoName);
                $logoPath = ('recruiter/logo/' . $logoName);
            }

            $id = $request->input('edit-id');

            // Find the record by ID
            $Recruiter = Recruiter::find($id);

            if ($Recruiter) {
                $Recruiter->name  = $request->input('editname');
                $Recruiter->lname = $request->input('editlname');
                $Recruiter->email = $request->input('editemail');
                $Recruiter->phone = $request->input('editphone');
                // $Recruiter->status     = 0;
                // Update logoPath if provided
                if ($logoPath) {
                    $Recruiter->logo = $logoPath;
                }

                if ($request->filled('password')) {
                    $Recruiter->password = Hash::make($request->input('password'));
                }

                $Recruiter->updated_at = now();

                $Recruiter->save();

                if ($Recruiter->save()) {
                    Mail::to($Recruiter->email)->send(new RecruiterUpdateMailToRecruiter($Recruiter));
                    return response()->json(['status_code' => 1, 'message' => 'Recruiter updated successfully']);
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
