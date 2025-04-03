@extends('admin.adminlayout.main')
@section('title')
    Admin-Job Experience
@endsection
@section('page-title')
    Job Experience
@endsection

@section('main-container')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Job Experience</h4>
                            </div>

                            <div class="px-3 mt-3 d-flex align-items-center gap-2">
                                <input type="text" id="search" name="search" class="form-control form-control-sm bg-light rounded w-25" placeholder="Search...">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Add Job Experience</button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table  id="myTable" class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Experience</th>
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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add job experience</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- form -->
                <form method="POST" action="javascript:void(0)" id="AddJobExperience">
                    <div class="mb-3">
                        <label for="experience" class="form-label">Experience</label>
                        <input type="number" class="form-control" name="experience" id="experience" aria-describedby="countryHelp">
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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit job Experience</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- form -->
                <form method="POST" action="javascript:void(0)" id="EditJobExp">

                    <div class="mb-3" id="modal-id" style="display: none;">
                        <label for="edit-id" class="form-label">ID</label>
                        <input type="text" name="edit-id" id="edit-id" class="form-control" placeholder="ID" />
                    </div>

                    <div class="mb-3">
                        <label for="editExp" class="form-label">Experience</label>
                        <input type="number" class="form-control" name="editExp" id="editExp" aria-describedby="countryHelp">
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
                url: "{{ route('Admin.GetJobExperience') }}",
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

        {{-- AddJobExperience --}}
    <script>
        $(document).ready(function() {
            $('#AddJobExperience').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
        
                var url = "{{ route('Admin.AddJobExperience') }}";
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
                            $('#AddJobExperience').trigger("reset");
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
                text: 'Do you want to change the status of this job experience?',
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
                        url: "{{ route('Admin.ChangeJobExperienceStatus') }}",
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
                        text: 'The job experience status was not changed.',
                        icon: 'info',
                        confirmButtonText: 'Okay',
                        background: '#17a2b8'
                    });
                }
            });
        }

    </script>

    
    {{-- DeleteJobExperience --}}
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
                        url: "{{ route('Admin.DeleteJobExperience') }}",
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

    {{--EditJobExperience --}}
    <script>
        function edit(id)
        {
        $.ajax({
            type:'POST',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('Admin.EditJobExperience') }}",
            data:{ id:id },
            dataType:'json',
            success:function(result)
            {   

            var record = result.data;
            $('#edit-id').val(record.id);
            $('#editExp').val(record.experience);

            },
        });
        }
    </script>

    {{-- UpdateJobExperience --}}
    <script>
    $(document).ready(function() {
        $('#EditJobExp').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
    
            var url = "{{ route('Admin.UpdateJobExperience') }}";
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
                        $('#EditJobExp').trigger("reset");
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
                                background:"#c7ac14",
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
              