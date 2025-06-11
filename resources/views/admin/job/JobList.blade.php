@extends('admin.adminlayout.main')
@section('title')
    Admin-Job List
@endsection
@section('page-title')
    Job List
@endsection

@section('main-container')
    <style>
        .choices {
            border: var(--bs-border-width) solid var(--bs-border-color);
            border-radius: var(--bs-border-radius);
            overflow: hidden;
            line-height: 0.8;
            height: 38px;
        }

        .choices__inner {
            background-color: var(--bs-secondary-bg);
            color: var(--bs-body-color);
        }

        .choices__list--single .choices__item {
            color: #000000;
        }

        .choices[data-type*=select-one] .choices__input {
            display: block;
            width: 100%;
            border: 1px solid #a29898 !important;
            background-color: #ffffff;
            border-radius: 10px;
        }

        .is-focused .choices__inner,
        .is-open .choices__inner {
            border: var(--bs-border-width) solid var(--bs-border-color);
            border-radius: var(--bs-border-radius);
        }

        .choices[data-type*="select-one"]::after {
            content: "";
            width: 12px;
            /* Adjust based on your icon size */
            height: 12px;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2322354e' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            position: absolute;
            right: 15px;
            top: 60%;
            /* Keep it centered */
            transform: translateY(-50%);
            /* Ensure it remains vertically aligned */
            pointer-events: none;
            border: none;
            /* Remove existing arrow */
            transition: transform 0.3s ease;
            /* Smooth transition */
        }

        /* When select box is open, rotate the arrow */
        .choices[data-type*="select-one"].is-open::after {
            transform: translateY(-90%) rotate(180deg);
        }



        .choices[data-type*="select-one"].is-open::after {
            border-color: transparent transparent #333;
            margin-top: 2px;

        }
    </style>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Job List</h4>
                            </div>

                            <div class="px-3 mt-3 d-flex align-items-center gap-2">
                                <input type="text" id="search" name="search"
                                    class="form-control form-control-sm bg-light rounded w-25" placeholder="Search...">
                                <button class="btn btn-primary btn-sm"
                                    onclick="window.location.href='{{ route('Admin.CreateJob') }}'">
                                    + Create Job
                                </button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Admin Verify</th>
                                                <th>Status</th>
                                                <th>Posted By</th>
                                                <th>Job Applicants</th>
                                                <th>Create Date</th>
                                                <th>Job Expiry</th>
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
                        url: "{{ route('Admin.GetJobPost') }}",
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


        {{-- To Show Verify & Reject Button --}}
        <script>
            function toggleVerifyOptions(id) {
                let optionsDiv = document.getElementById("verify-options-" + id);
                if (optionsDiv.style.display === "none") {
                    optionsDiv.style.display = "block";
                } else {
                    optionsDiv.style.display = "none";
                }
            }
        </script>


        {{-- Change Admin Verify Status --}}
        {{-- <script>
            function changeVerifyStatus(id, status) {
                let actionText = status === 1 ? 'verify' : 'reject';
                let confirmButtonText = status === 1 ? 'Yes, verify it!' : 'Yes, reject it!';
                let successMessage = status === 1 ? 'User has been verified successfully!' :
                    'User has been rejected successfully!';
                let backgroundColor = status === 1 ? '#28a745' : '#dc3545'; // Green for verify, Red for reject

                // Show confirmation modal
                Swal.fire({
                    title: `Are you sure?`,
                    text: `Do you really want to ${actionText} this user?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: confirmButtonText,
                    cancelButtonText: 'No, cancel!',
                    background: backgroundColor,
                }).then((response) => {
                    if (response.isConfirmed) {
                        // Perform AJAX request
                        $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ route('Admin.VerifyStatus') }}", // Change this to your verification route
                            data: {
                                id: id,
                                status: status
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status_code == 1) {
                                    // Reload the DataTable after success
                                    $('#myTable').DataTable().ajax.reload(null, false);
                                    Swal.fire({
                                        title: 'Success!',
                                        text: successMessage,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        background: '#28a745'
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        background: '#dc3545'
                                    });
                                }
                            }
                        });
                    } else {
                        // If user clicks "Cancel", show the info message
                        Swal.fire({
                            title: 'Cancelled',
                            text: 'No changes were made.',
                            icon: 'info',
                            confirmButtonText: 'Okay',
                            background: '#17a2b8'
                        });
                    }
                });
            }
        </script> --}}
        <script>
            function changeVerifyStatus(id, status) {
                let actionText = status === 1 ? 'verify' : 'reject';
                let confirmButtonText = status === 1 ? 'Yes, verify it!' : 'Yes, reject it!';
                let successMessage = status === 1 ? 'Job Post has been verified successfully!' :
                    'Job Post has been rejected successfully!';
                let confirmColor = status === 1 ? '#28a745' : '#dc3545';

                Swal.fire({
                    title: `Are you sure?`,
                    text: `Do you really want to ${actionText} this job post?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: confirmColor,
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: confirmButtonText,
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('Admin.VerifyStatus') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                id: id,
                                status: status
                            },
                            dataType: 'json',
                            success: function(response) {
                                let icon = response.status_code === 1 ? 'success' : 'error';
                                let bgColor = response.status_code === 1 ? '#28a745' : '#dc3545';

                                Swal.fire({
                                    title: response.status_code === 1 ? 'Success!' : 'Error!',
                                    text: response.message,
                                    icon: icon,
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: bgColor
                                });

                                if (response.status_code === 1) {
                                    $('#myTable').DataTable().ajax.reload(null, false);
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Something went wrong. Please try again later.',
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: '#dc3545'
                                });
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Cancelled',
                            text: 'No changes were made.',
                            icon: 'info',
                            confirmButtonText: 'Okay',
                            confirmButtonColor: '#17a2b8'
                        });
                    }
                });
            }
        </script>


        {{-- change Status --}}
        <script>
            function changeStatus(id) {

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to change the status of this record?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, change it!',
                    cancelButtonText: 'No, cancel!',
                    background: '#ffc107',
                }).then((response) => {
                    if (response.isConfirmed) {

                        $.ajax({
                            url: "{{ route('Admin.ChangeJobPostStatus') }}",
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(result) {
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
                            text: 'The status was not changed.',
                            icon: 'info',
                            confirmButtonText: 'Okay',
                            background: '#17a2b8'
                        });
                    }
                });
            }
        </script>


        {{-- DeleteJobCategory --}}
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
                            url: "{{ route('Admin.DeleteJobPost') }}",
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(deleteResult) {
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
    @endsection
