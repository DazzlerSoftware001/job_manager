@extends('admin.adminlayout.main')
@section('title')
    Admin-Email Templates
@endsection
@section('page-title')
    Email Templates List
@endsection

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
                                                <th>Template Name</th>
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
@endsection
