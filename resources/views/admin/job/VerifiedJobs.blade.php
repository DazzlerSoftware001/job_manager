@extends('admin.adminlayout.main')
@section('title')
    Admin-Verified Job List
@endsection
@section('page-title')
Verified Job List
@endsection

@section('main-container')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Verified Job List</h4>
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
                        url: "{{ route('Admin.VerifiedJobs') }}",
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
        <script>
            function changeVerifyStatus(id, status) {
                let actionText = status === 1 ? 'verify' : 'reject';
                let confirmButtonText = status === 1 ? 'Yes, verify it!' : 'Yes, reject it!';
                let successMessage = status === 1 ? 'Job has been verified successfully!' :
                    'Job has been rejected successfully!';
                let backgroundColor = status === 1 ? '#28a745' : '#dc3545'; // Green for verify, Red for reject

                // Show confirmation modal
                Swal.fire({
                    title: `Are you sure?`,
                    text: `Do you really want to ${actionText} this Job?`,
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
