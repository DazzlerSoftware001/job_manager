@extends('admin.adminlayout.main')
@section('title')
    Admin-Job Skill
@endsection
@section('page-title')
    <div class="breadcrumb mt-2">
        {!! Breadcrumbs::render('Admin.JobSkill') !!}
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
                                <h4 class="card-title">Job Skill</h4>
                            </div>

                            <div class="px-3 mt-3 d-flex align-items-center gap-2">
                                <input type="text" id="search" name="search" class="form-control form-control-sm bg-light rounded w-25" placeholder="Search...">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Add Job Skill</button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table  id="myTable" class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Skill</th>
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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add job Skill</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- form -->
                <form method="POST" action="javascript:void(0)" id="AddJobSkill">
                    <div class="mb-3">
                        <label for="skill" class="form-label">Skill<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="skill" id="skill" aria-describedby="countryHelp">
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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit job Skill</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- form -->
                <form method="POST" action="javascript:void(0)" id="EditJobSkill">

                    <div class="mb-3" id="modal-id" style="display: none;">
                        <label for="edit-id" class="form-label">ID</label>
                        <input type="text" name="edit-id" id="edit-id" class="form-control" placeholder="ID" />
                    </div>

                    <div class="mb-3">
                        <label for="EditSkill" class="form-label">Skill<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="EditSkill" id="EditSkill" aria-describedby="countryHelp">
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
                url: "{{ route('Admin.GetJobSkill') }}",
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

        {{-- AddJobSkill --}}
    <script>
        $(document).ready(function() {
            $('#AddJobSkill').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
        
                var url = "{{ route('Admin.AddJobSkill') }}";
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
                            $('#AddJobSkill').trigger("reset");
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
     {{-- <script>
        function changeStatus(id){
          $.ajax({
            url : "{{ route('Admin.ChangeJobSkillStatus') }}",
            type: 'POST',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:  { id:id },
            dataType:'json',
            success : function (result) {
              if (result.status_code == 1) {
                $('#myTable').DataTable().ajax.reload(null, false);
                Toastify({
                  text: result.message,
                  duration: 3000,
                  gravity: "top",
                  position: "right",
                  style:{
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
                  style:{
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
                  style:{
                    background: "red",
                    color: "white",
                  }
                }).showToast();
              }
            }
          });
        }
    </script> --}}
    <script>
        function changeStatus(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to change the status of this skill?',
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
                        url: "{{ route('Admin.ChangeJobSkillStatus') }}",
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
                                bgColor = "yellow";
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
                        text: 'The skill status was not changed.',
                        icon: 'info',
                        confirmButtonText: 'Okay',
                        background: '#17a2b8'
                    });
                }
            });
        }
    </script>
    

    
    {{-- DeleteJobSkill --}}
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
                        url: "{{ route('Admin.DeleteJobSkill') }}",
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

    {{--EditJobSkill --}}
    <script>
        function edit(id)
        {
        $.ajax({
            type:'POST',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('Admin.EditJobSkill') }}",
            data:{ id:id },
            dataType:'json',
            success:function(result)
            {   

            var record = result.data;
            $('#edit-id').val(record.id);
            $('#EditSkill').val(record.skill);

            },
        });
        }
    </script>

    {{-- UpdateJobSkill --}}
    <script>
    $(document).ready(function() {
        $('#EditJobSkill').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
    
            var url = "{{ route('Admin.UpdateJobSkill') }}";
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
                        $('#EditJobSkill').trigger("reset");
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
              