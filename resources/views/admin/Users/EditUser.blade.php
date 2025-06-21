@extends('admin.adminlayout.main')
@section('title')
    Admin-Users List
@endsection
@section('page-title')
    <div class="breadcrumb mt-2">
        {!! Breadcrumbs::render('Admin.EditUser', $decryptedId) !!}
    </div>

    <style>
        .breadcrumb {
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
@endsection

@section('main-container')

   
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                           <div class="card-body pb-0">
                                <form method="POST" action="javascript:void(0)" id="UpdateUser" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <input type="hidden" name="edit_id" id="edit_id" value="{{ $user->id }}">
                                      
                                        <div class="col-6">

                                            <label for="fname">Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="fname" name="fname"value="{{ $user->name ?? '' }}" placeholder="Enter First Name" required>
                                        </div>

                                        <div class="col-6">
                                            <label for="lname">Last Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="lname" name="lname"value="{{ $user->lname ?? '' }}" placeholder="Enter Last Name" required>
                                        </div>

                                        <div class="col-6">
                                            <label for="img">Profile Image<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" id="img" name="img" accept=".jpeg,.jpg,.png,.gif,.svg,.webp">
                                        </div>

                                        <div class="col-6">
                                            <label for="dob">Date of Birth<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="dob" name="dob" value="{{$user->date_of_birth ?? ''}}"  placeholder="Enter  DOB" required>
                                        </div>

                                        <div class="col-6">
                                            <label for="gender">Gender<span class="text-danger">*</span></label>
                                            <select class="form-control" id="gender" name="gender" required>
                                                <option value="Male" {{ (isset($user->gender) && $user->gender == 'Male') ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ (isset($user->gender) && $user->gender == 'Female') ? 'selected' : '' }}>Female</option>
                                                <option value="Other" {{ (isset($user->gender) && $user->gender == 'Other') ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <label for="password">Password<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="password" name="password"  placeholder="Enter Password">
                                        </div>

                                        <div class="col-6">
                                            <label for="confirm_password">Confirm Password<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="confirm_password" name="confirm_password"  placeholder="Enter Confirm Password">
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


        {{-- Update User --}}
        
         <script>
            $(document).ready(function() {
                $('#UpdateUser').on('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    var url = "{{ route('Admin.UpdateUser') }}";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function(result) {
                            if (result.status_code === 1) {
                                $('#UpdateUser').trigger("reset");
                                Toastify({
                                    text: result.message,
                                    duration: 3000,
                                    gravity: "top",
                                    position: "right",
                                    style: {
                                        background: "#28a745",
                                    },
                                }).showToast();

                                setTimeout(function() {
            window.location.reload();
        }, 1000);
                            } else if (result.status_code === 2) {
                                Toastify({
                                    text: result.message,
                                    duration: 3000,
                                    gravity: "top",
                                    position: "right",
                                    style: {
                                        background: "#c7ac14",
                                        color: "white",
                                    }
                                }).showToast();
                            } else {
                                Toastify({
                                    text: result.message,
                                    duration: 3000,
                                    gravity: "top",
                                    position: "right",
                                    style: {
                                        background: "#c7ac14",
                                        color: "white",
                                    }
                                }).showToast();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', error);
                            Toastify({
                                text: 'An error occurred. Please try again.',
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "#dc3545",
                                },
                            }).showToast();
                        }
                    });
                });
            });
        </script>
      



      

    @endsection
