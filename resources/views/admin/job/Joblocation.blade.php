@extends('admin.adminlayout.main')
@section('title')
    Admin-Job Location
@endsection
@section('page-title')
    Job Location
@endsection

@section('main-container')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                {{-- <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body pb-0">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-3">Overview</h5>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span class="fw-semibold">Sort By:</span> <span
                                                    class="text-muted">Yearly<i
                                                        class="mdi mdi-chevron-down ms-1"></i></span>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Yearly</a>
                                                <a class="dropdown-item" href="#">Monthly</a>
                                                <a class="dropdown-item" href="#">Weekly</a>
                                                <a class="dropdown-item" href="#">Today</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row gy-4">
                                    <div class="col-xxl-3">
                                        <div>
                                            <div class="mt-3 mb-3">
                                                <p class="text-muted mb-1">This Month</p>

                                                <div class="d-flex flex-wrap align-items-center gap-2">
                                                    <h2 class="mb-0">$24,568</h2>
                                                    <div class="badge rounded-pill font-size-13 bg-success-subtle text-success ">+
                                                        2.65%</div>
                                                </div>
                                            </div>

                                            <div class="row g-0">
                                                <div class="col-sm-6">
                                                    <div class="border-bottom border-end p-3 h-100">
                                                        <p class="text-muted text-truncate mb-1">Orders</p>
                                                        <h5 class="text-truncate mb-0">5,643</h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="border-bottom p-3 h-100">
                                                        <p class="text-muted text-truncate mb-1">Sales</p>
                                                        <h5 class="text-truncate mb-0">16,273</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-0">
                                                <div class="col-sm-6">
                                                    <div class="border-bottom border-end p-3 h-100">
                                                        <p class="text-muted text-truncate mb-1">Order Value</p>
                                                        <h5 class="text-truncate mb-0">12.03 %</h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="border-bottom p-3 h-100">
                                                        <p class="text-muted text-truncate mb-1">Customers</p>
                                                        <h5 class="text-truncate mb-0">21,456</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-0">
                                                <div class="col-sm-6">
                                                    <div class="border-end p-3 h-100">
                                                        <p class="text-muted text-truncate mb-1">Income</p>
                                                        <h5 class="text-truncate mb-0">$35,652</h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="p-3 h-100">
                                                        <p class="text-muted text-truncate mb-1">Expenses</p>
                                                        <h5 class="text-truncate mb-0">$12,248</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-9">
                                        <div>
                                            <div id="chart-column" class="apex-charts" data-colors='["#f1f3f7", "#3b76e1"]'></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Job Location</h4>
                            </div>

                            {{-- <div class="px-3 mt-3">
                                <input type="text" class="form-control bg-light rounded w-10" placeholder="Search...">
                            </div> --}}

                            <div class="px-3 mt-3 d-flex align-items-center gap-2">
                                <input type="text" id="search" name="search" class="form-control form-control-sm bg-light rounded w-25" placeholder="Search...">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Add Job Location</button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table  id="myTable" class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Country</th>
                                                <th>City</th>
                                                <th>Status</th>
                                                <th>Create Date</th>
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


    <!--add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add job location</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- form -->
                <form method="POST" action="javascript:void(0)" id="AddJobLocation">
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" name="country" id="country" aria-describedby="countryHelp">
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" name="city" id="city" aria-describedby="cityHelp">
                    </div>

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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit job location</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- form -->
                <form method="POST" action="javascript:void(0)" id="EditJobLocation">

                    <div class="mb-3" id="modal-id" style="display: none;">
                        <label for="edit-id" class="form-label">ID</label>
                        <input type="text" name="edit-id" id="edit-id" class="form-control" placeholder="ID" />
                    </div>

                    <div class="mb-3">
                        <label for="editcountry" class="form-label">Country</label>
                        <input type="text" class="form-control" name="editcountry" id="editcountry" aria-describedby="countryHelp">
                    </div>

                    <div class="mb-3">
                        <label for="editcity" class="form-label">City</label>
                        <input type="text" class="form-control" name="editcity" id="editcity" aria-describedby="cityHelp">
                    </div>

            </div>
                    
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>

        </div>
        </div>
    </div>


@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('script')

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
                url: "{{ route('Admin.GetJobLocation') }}",
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

        {{-- AddJobLocation --}}
    <script>
        $(document).ready(function() {
            $('#AddJobLocation').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
        
                var url = "{{ route('Admin.AddJobLocation') }}";
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
                            $('#AddJobLocation').trigger("reset");
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
                                    background:"yellow",
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
                text: 'Do you want to change the status of this job location?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'No, cancel!',
                background: '#ffc107',
                customClass: {
                    title: 'text-dark',
                    content: 'text-dark'
                }
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
                        url: "{{ route('Admin.ChangeJobLocationStatus') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: { id: id },
                        dataType: 'json',
                        success: function(result) {
                            Swal.close(); // Close loading alert

                            let bgColor;
                            if (result.status_code == 1) {
                                bgColor = "green";
                                $('#myTable').DataTable().ajax.reload(null, false);
                            } else if (result.status_code == 2) {
                                bgColor = "yellow"; // Yellowish for warnings
                            } else {
                                bgColor = "red";
                            }

                            Toastify({
                                text: result.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: bgColor,
                                    color: "white",
                                }
                            }).showToast();
                        }
                    });

                } else {
                    Swal.fire({
                        title: 'Cancelled',
                        text: 'The job location status was not changed.',
                        icon: 'info',
                        confirmButtonText: 'Okay',
                        background: '#17a2b8'
                    });
                }
            });
        }

    </script>

    
    {{-- DeleteJobLocation --}}
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
                        url: "{{ route('Admin.DeleteJobLocation') }}",
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

    {{--Edit Location --}}
    <script>
        function edit(id)
        {
        $.ajax({
            type:'POST',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('Admin.EditJobLocation') }}",
            data:{ id:id },
            dataType:'json',
            success:function(result)
            {   

            var record = result.data;
            $('#edit-id').val(record.id);
            $('#editcountry').val(record.country);
            $('#editcity').val(record.city);

            },
        });
        }
    </script>

      {{-- Update location --}}
      <script>
        $(document).ready(function() {
            $('#EditJobLocation').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
        
                var url = "{{ route('Admin.UpdateJobLocation') }}";
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
                            $('#EditJobLocation').trigger("reset");
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
              