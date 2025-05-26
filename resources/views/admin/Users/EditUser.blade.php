@extends('admin.adminlayout.main')
@section('title')
    Admin-Users List
@endsection
@section('page-title')
    Users List
@endsection

@section('main-container')

   
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                           <div class="card-body pb-0">
                                <form method="POST" action="javascript:void(0)" id="UpdateUser" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <input type="hidden" name="edit-id" id="edit-id" value="{{ $user->id }}">
                                        <div class="col-4">

                                            <label for="fname">Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="fname" name="fname"value="{{ $user->name ?? '' }}" placeholder="Enter First Name">
                                        </div>

                                        <div class="col-4">
                                            <label for="lname">Last Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="lname" name="lname"value="{{ $user->lname ?? '' }}" placeholder="Enter Last Name">
                                        </div>

                                        <div class="col-4">
                                            <label for="img">Profile Image<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" id="img" name="img">
                                        </div>

                                        <div class="col-4">
                                            <label for="dob">Date of Birth<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="dob" name="dob" value="{{$user->date_of_birth ?? ''}}"  placeholder="Enter  DOB">
                                        </div>

                                        <div class="col-4">
                                            <label for="gender">Gender<span class="text-danger">*</span></label>
                                            <select class="form-control" id="gender" name="gender" required>
                                                <option value="Male" {{ (isset($user->gender) && $user->gender == 'Male') ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ (isset($user->gender) && $user->gender == 'Female') ? 'selected' : '' }}>Female</option>
                                                <option value="Other" {{ (isset($user->gender) && $user->gender == 'Other') ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>

                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        
    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @section('script')
        {{-- Get Job list --}}
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    // DataTable options
                    "paging": true,
                    "lengthMenu": [10, 25, 50, 100],
                    "serverSide": true,
                    "processing": true,
                    "searching": false,
                    "lengthChange": true,
                    "fixedHeader": true,
                    "order": [
                        [0, "desc"]
                    ],
                    "ajax": {
                        url: "{{ route('Admin.GetUsersList') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: function(data) {
                            data.search = $('#search').val();
                        }
                    },
                    "language": {
                        "emptyTable": "<div><lord-icon src='https://cdn.lordicon.com/msoeawqm.json' trigger='loop' style='width:75px;height:75px'></div> <div class='mt-2 noresult'><b>Sorry! No Result Found</b></div>"
                    }
                });

                $('#search').on('keyup', function(e) {
                    e.preventDefault();
                    $('#myTable').DataTable().draw();
                });
            });
        </script>

      



      

    @endsection
