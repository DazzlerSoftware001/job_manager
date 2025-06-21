@extends('admin.adminlayout.main')
@section('title')
    Admin-Email Templates
@endsection
@section('page-title')
   <div class="breadcrumb mt-2">
        {!! Breadcrumbs::render('Admin.EmailTemplates') !!}
    </div>

    <style>
        .breadcrumb {
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
@endsection
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 22px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: #4caf50;
    }

    input:checked+.slider:before {
        transform: translateX(18px);
    }
</style>

@section('main-container')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Email Templates List </h4>
                            </div>

                            {{-- <div class="px-3 mt-3 d-flex align-items-center gap-2">
                                <input type="text" id="search" name="search"
                                    class="form-control form-control-sm bg-light rounded w-25" placeholder="Search...">
                                <button class="btn btn-primary btn-sm">
                                        + Create Job
                                    </button> 
                            </div> --}}

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Email Name</th>
                                                <th>Send Email</th>
                                                <th>Subject</th>
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
        </div>



        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('script')
    {{-- Get Template List --}}
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
                    url: "{{ route('Admin.GetEmailTemplates') }}",
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
    <script>
        $(document).on('change', '.status-toggle', function() {
            let id = $(this).data('id');
            let status = $(this).is(':checked') ? 1 : 0;

            // Revert toggle temporarily until confirmation
            $(this).prop('checked', !status);

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to " + (status ? "enable" : "disable") + " Mail Send?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('Admin.SendEmail') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            status: status,
                            id: id
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });

                            setTimeout(function() {
                                location.reload();
                            }, 750);
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Something went wrong. Please try again.',
                            });
                        }
                    });
                }
            });
        });
    </script>
    {{-- <script>
        $('.status-toggle').on('change', function() {
            let status = $(this).is(':checked') ? 1 : 0;

            // Revert toggle temporarily until confirmation
            $(this).prop('checked', !status);

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to " + (status ? "enable" : "disable") + " Mail Send?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('Admin.SendEmail') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            status: status
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });

                            // Update toggle status only on success
                            $('.status-toggle').prop('checked', status);
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Something went wrong. Please try again.',
                            });
                        }
                    });
                }
            });
        });
    </script> --}}
@endsection
