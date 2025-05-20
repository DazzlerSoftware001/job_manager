@extends('admin.adminlayout.main')
@section('title')
    Admin-Database
@endsection
@section('page-title')
Database
@endsection

@section('main-container')

    
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Export</h4>
                            </div>

                            <div class="px-3 mt-3 d-flex align-items-center gap-2">
                                
                            </div>

                            <div class="card-body">
                                
                                <div class="row">
                                    @foreach($exportTables as $table)
                                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                                            <div class="border rounded p-3 h-100">
                                                <h5 class="card-title text-primary text-capitalize">
                                                    {{ str_replace('_', ' ', $table) }}
                                                </h5>
                                                <p class="card-text mb-2">Export data for <strong>{{ str_replace('_', ' ', $table) }}</strong> to a CSV/Excel file.</p>
                                            <a href="{{ route('export.csv', ['table' => $table]) }}" class="btn btn-sm btn-success mt-2"><i class="fas fa-file-csv"></i>
                                                Export CSV
                                            </a>

                                            <a href="{{ route('export.excel', ['table' => $table]) }}" class="btn btn-sm btn-primary mt-2"><i class="mdi mdi-file-excel"></i>
                                                Export Excel
                                            </a>


                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Import</h4>
                            </div>

                            <div class="px-3 mt-3 d-flex align-items-center gap-2">
                                
                            </div>

                            <div class="card-body">
                                 <div class="row">
                                    @foreach($importTables as $table)
                                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                                            <div class="border rounded p-3 h-100">
                                                <h5 class="card-title text-primary text-capitalize">
                                                    {{ str_replace('_', ' ', $table) }}
                                                </h5>
                                                <p class="card-text mb-2">Import data into <strong>{{ str_replace('_', ' ', $table) }}</strong> from a CSV/Excel file.</p>

                                                
                                            </div>
                                        </div>
                                    @endforeach
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
        {{-- <script>
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
                        url: "",
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
        </script> --}}




        {{-- DeleteJobCategory --}}
        {{-- <script>
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
        </script> --}}
    @endsection
