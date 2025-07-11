@extends('admin.adminlayout.main')
@section('title')
    Admin-Companies
@endsection
@section('page-title')
    <div class="breadcrumb mt-2">
        {!! Breadcrumbs::render('Admin.Companies') !!}
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Companies</h4>
                            </div>

                            <div class="px-3 mt-3 d-flex align-items-center gap-2">
                                <input type="text" id="search" name="search" class="form-control form-control-sm bg-light rounded w-25" placeholder="Search...">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Add Company</button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table  id="myTable" class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Website</th>
                                                <th>Details</th>
                                                <th>Address</th>
                                                <th>Logo</th>
                                                <th>Status</th>
                                                <th>Created</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    <!-- Modal to view image -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="imageModalLabel">Logo Image</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
            <img id="modalImage" src="" alt="Logo" class="img-fluid">
            </div>
        </div>
        </div>
    </div>

  

    <!--ada company -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Company</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- form -->
                <form method="POST" action="javascript:void(0)" id="AddCompany">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="phone" id="phone" required>
                    </div>

                    <div class="mb-3">
                        <label for="website" class="form-label">Website<span class="text-danger">*</span></label>
                        <input type="url" class="form-control" name="website" id="website" required>
                        <small id="websiteHelp" class="form-text text-muted">Enter a valid website URL (e.g., https://example.com).</small>
                    </div>

                    <div class="mb-3">
                        <label for="details" class="form-label">Details<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="details" id="details" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="address" id="address" required>
                    </div>

                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo<span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="logo" id="logo" accept="image/*" required>
                    </div>

                    {{-- <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control pe-5" name="password" id="password" required>
                            <span class="position-absolute end-0 top-50 translate-middle-y me-3" onclick="togglePassword('password', 'toggleIcon1')" style="cursor: pointer;">
                                <i class="far fa-eye" id="toggleIcon1"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="mb-3 position-relative">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control pe-5" name="password_confirmation" id="password_confirmation" required>
                            <span class="position-absolute end-0 top-50 translate-middle-y me-3" onclick="togglePassword('password_confirmation', 'toggleIcon2')" style="cursor: pointer;">
                                <i class="far fa-eye" id="toggleIcon2"></i>
                            </span>
                        </div>
                    </div> --}}
                    
                    
            </div>
                    
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>

        </div>
        </div>
    </div>

    <!--edit Modal -->
    <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Company</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- form -->
                <form method="POST" action="javascript:void(0)" id="EditCompany">

                    <div class="mb-3" id="modal-id" style="display: none;">
                        <label for="edit-id" class="form-label">ID</label>
                        <input type="text" name="edit-id" id="edit-id" class="form-control" placeholder="ID" />
                    </div>

                    <div class="mb-3">
                        <label for="editname" class="form-label">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="editname" id="editname" required>
                    </div>

                    <div class="mb-3">
                        <label for="editemail" class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="editemail" id="editemail" required>
                    </div>

                    <div class="mb-3">
                        <label for="editphone" class="form-label">Phone<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="editphone" id="editphone" required>
                    </div>

                    <div class="mb-3">
                        <label for="editwebsite" class="form-label">Website<span class="text-danger">*</span></label>
                        <input type="url" class="form-control" name="editwebsite" id="editwebsite" required>
                        <small id="websiteHelp" class="form-text text-muted">Enter a valid website URL (e.g., https://example.com).</small>
                    </div>

                    <div class="mb-3">
                        <label for="editdetails" class="form-label">Details<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="editdetails" id="editdetails" required>
                    </div>

                    <div class="mb-3">
                        <label for="editaddress" class="form-label">Address<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="editaddress" id="editaddress" required>
                    </div>

                    <div class="mb-3">
                        <label for="editlogo" class="form-label">Logo<span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="editlogo" id="editlogo" accept="image/*">
                    </div>

                    {{-- <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control pe-5" name="password" id="password" >
                            <span class="position-absolute end-0 top-50 translate-middle-y me-3" onclick="togglePassword('password', 'toggleIcon1')" style="cursor: pointer;">
                                <i class="far fa-eye" id="toggleIcon1"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="mb-3 position-relative">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control pe-5" name="password_confirmation" id="password_confirmation" >
                            <span class="position-absolute end-0 top-50 translate-middle-y me-3" onclick="togglePassword('password_confirmation', 'toggleIcon2')" style="cursor: pointer;">
                                <i class="far fa-eye" id="toggleIcon2"></i>
                            </span>
                        </div>
                    </div> --}}

            </div>
                    
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>

        </div>
        </div>
    </div>

  
    <!--Details Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailsModalLabel">Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detailsModalBody">
                    <!-- Details content will be inserted here -->
                </div>
            </div>
        </div>
    </div>



@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('script')

    {{-- password toggle --}}
    {{-- <script>
        function togglePassword(inputId, iconId) {
            let passwordInput = document.getElementById(inputId);
            let toggleIcon = document.getElementById(iconId);
        
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script> --}}

    {{--  copy website--}}
    <script>
        function copyToClipboard(text) {
            // Create a temporary input element to copy the text
            var tempInput = document.createElement('input');
            document.body.appendChild(tempInput);
            tempInput.value = text; // Set the value to the website URL
            tempInput.select(); // Select the input value
            document.execCommand('copy'); // Copy the selected text
            document.body.removeChild(tempInput); // Remove the temporary input element
            
            // alert('Website URL copied to clipboard!');

            Toastify({
                text: 'Website URL copied to clipboard!',
                duration: 3000,
                gravity: "top",
                position: "right",
                style:{
                    background:"green",
                    color: "white",
                }
            }).showToast();
        }
    </script>

    {{-- For Showing Details --}}
    <script>
        function openDetailsModal(details) {
            document.getElementById('detailsModalBody').innerHTML = details;
            var myModal = new bootstrap.Modal(document.getElementById('detailsModal'));
            myModal.show();
        }
    </script>
    
    



    {{--  open the image modal --}}
    <script>
        function openImageModal(imageSrc) {
            // Set the modal image source to the clicked image
            document.getElementById('modalImage').src = imageSrc;
            // Open the modal
            $('#imageModal').modal('show');
        }
    </script>

    {{-- Get Company List --}}
    <script>
        $(document).ready(function () {
        $('#myTable').DataTable({
            // DataTable options
            "paging": true,
            "lengthMenu": [10, 25, 50, 100],
            "serverSide": true,
            "processing": true,
            "searching": false,
            "lengthChange": true,
            "fixedHeader": true,
            "order": [[0, "desc"]],
            "ajax": {
                url: "{{ route('Admin.GetCompanies') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (data) {
                    data.search = $('#search').val();
                }
            },
            "language": {
                "emptyTable": "<div><lord-icon src='https://cdn.lordicon.com/msoeawqm.json' trigger='loop' style='width:75px;height:75px'></div> <div class='mt-2 noresult'><b>Sorry! No Result Found</b></div>"
            }
        });

        $('#search').on('keyup', function (e) {
            e.preventDefault();
            $('#myTable').DataTable().draw();
        });
        });
    </script>


        {{-- AddCompany --}}
    <script>
        $(document).ready(function() {
            $('#AddCompany').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
        
                var url = "{{ route('Admin.AddCompany') }}";
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
                            $('#exampleModal').modal('hide');
                            $('#AddCompany').trigger("reset");
                            $('#myTable').DataTable().ajax.reload(null, false);
                            Toastify({
                                text: result.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style:{
                                    background:"green",
                                    color: "white",
                                }
                            }).showToast();
                            
                        } else if (result.status_code === 2) {
                            Toastify({
                                text: result.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style:{
                                    background:"#c7ac14",
                                    color: "white",
                                }
                            }).showToast();
                        } else {
                            Toastify({
                                text: result.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style:{
                                    background:"red",
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
                            style:{
                                    background:"red",
                                    color: "white",
                                }
                        }).showToast();
                    }
                });
            });
        });
    </script>

     {{-- change Status --}}
     <script>
        function changeStatus(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to change the status of this company?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'No, cancel!',
                background: '#ffc107',
            }).then((response) => {
                if (response.isConfirmed) {
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Please wait while we update the status.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: "{{ route('Admin.ChangeCompanyStatus') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: { id: id },
                        dataType: 'json',
                        success: function(result) {
                            Swal.close(); // Close loading alert

                            if (result.status_code == 1) {
                                $('#myTable').DataTable().ajax.reload(null, false);
                                Toastify({
                                    text: result.message,
                                    duration: 3000,
                                    gravity: "top",
                                    position: "right",
                                    style: {
                                        background: "green",
                                        color: "white",
                                    }
                                }).showToast();
                            } else if (result.status_code == 2) {
                                Toastify({
                                    text: result.message,
                                    duration: 3000,
                                    gravity: "top",
                                    position: "right",
                                    style: {
                                        background: "yellow",
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
                                        background: "red",
                                        color: "white",
                                    }
                                }).showToast();
                            }
                        }
                    });

                } else {
                    Swal.fire({
                        title: 'Cancelled',
                        text: 'The company status was not changed.',
                        icon: 'info',
                        confirmButtonText: 'Okay',
                        background: '#17a2b8'
                    });
                }
            });
        }
    </script>

    
    {{-- DeleteCompany --}}
    <script>
        function deleteRecord(id) {
            // First AJAX to show confirmation modal
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you really want to delete this record?',
                icon: 'warning',
                showCancelButton: true, // Show cancel button
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                background: '#28a745',
            }).then((response) => {
                // If user clicks "Yes, delete it!"
                if (response.isConfirmed) {
                    // Second AJAX for actual deletion
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('Admin.DeleteCompany') }}",
                        data: { id: id },
                        dataType: 'json',
                        success: function (deleteResult) {
                            if (deleteResult.status_code == 1) {
                                // Reload the DataTable after successful deletion
                                $('#myTable').DataTable().ajax.reload(null, false);
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Record deleted successfully!',
                                    icon: 'success',
                                    confirmButtonText: 'Okay',
                                    background: '#28a745'
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: deleteResult.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    background: '#dc3545'
                                });
                            }
                        }
                    });
                } else {
                    // If user clicks "Cancel", show the info message and no deletion happens
                    Swal.fire({
                        title: 'Cancelled',
                        text: 'Your record was not deleted.',
                        icon: 'info',
                        confirmButtonText: 'Okay',
                        background: '#17a2b8'
                    });
                }
            });
        }
    </script>

    {{--editCompany --}}
    <script>
        function edit(id)
        {
        $.ajax({
            type:'POST',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('Admin.EditCompany') }}",
            data:{ id:id },
            dataType:'json',
            success:function(result)
            {   

            var record = result.data;
            $('#edit-id').val(record.id);
            $('#editname').val(record.name);
            $('#editemail').val(record.email);
            $('#editphone').val(record.phone);
            $('#editwebsite').val(record.website);
            $('#editdetails').val(record.details);
            $('#editaddress').val(record.address);
            },
        });
        }
    </script>

    {{-- UpdateCompany --}}
    <script>
        $(document).ready(function() {
            $('#EditCompany').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
        
                var url = "{{ route('Admin.UpdateCompany') }}";
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
                            $('#EditModal').modal('hide');
                            $('#EditCompany').trigger("reset");
                            $('#myTable').DataTable().ajax.reload(null, false);
                            Toastify({
                                text: result.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                background: "#28a745", 
                            },
                            }).showToast();
                        } else if (result.status_code === 2) {
                            Toastify({
                                text: result.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "#c7ac14",
                                },
                            }).showToast();
                        } else {
                            Toastify({
                                text: result.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                background: "#c7ac14",
                            },
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
              