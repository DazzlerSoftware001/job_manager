@extends('recruiter.recruiterlayout.main')
@section('title')
    Recruiter-All Applicants
@endsection
@section('page-title')
    All Applicants
@endsection

@section('main-container')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Applicants</h4>
                                <div class="row">
                                    <div class="col-10 mt-2">
                                        <select id="jobFilter" class="form-select">
                                            <option value="">Filter by Job</option>
                                            @foreach($joblist as  $job)
                                                <option value="{{ $job->id }}">{{ $job->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-2 mt-2">
                                        <select id="statusFilter" class="form-select">
                                            <option value="">Status</option>
                                                <option value="pending">All</option>
                                                <option value="shortlisted">ShortListed</option>
                                                <option value="hired">Hired</option>
                                                <option value="rejected">Rejected</option>
                                        </select>
                                    </div>

                                    <div class="col-2 mt-2">
                                        <select id="cityFilter" class="form-select">
                                                <option value="">City</option>
                                                @foreach ($cities as $city )
                                                <option value="{{$city}}">{{$city}}</option>
                                                    
                                                @endforeach
                                        </select>
                                    </div>

                                    <div class="col-2 mt-2">
                                        <input type="text" id="search" class="form-control mb-3" placeholder="Search by name, email or job title">
                                    </div>

                                </div>



                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Applicant Name</th>
                                                <th>Applicant Email</th>
                                                <th>Status</th>
                                                <th>Applied Date</th>
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
                        url: "{{ route('Recruiter.GetAllApplicants') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: function (data) {
                            data.search = $('#search').val();
                            data.job_id = $('#jobFilter').val();      // important
                            data.status = $('#statusFilter').val();   // optional
                        }

                    },
                    "language": {
                        "emptyTable": "<div><lord-icon src='https://cdn.lordicon.com/msoeawqm.json' trigger='loop' style='width:75px;height:75px'></div> <div class='mt-2 noresult'><b>Sorry! No Result Found</b></div>"
                    }
                });

                $('#jobFilter, #statusFilter').on('change', function() {
                    $('#myTable').DataTable().draw();
                });

                // 🔍 Trigger search if search box exists
                $('#search').on('keyup', function(e) {
                    e.preventDefault();
                    $('#myTable').DataTable().draw();
                });
            });
        </script>

        {{-- To Show Button's --}}
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

        {{-- change Status --}}
        {{-- <script>
            function changeVerifyStatus(id, status) {
                let actionText = status.charAt(0).toUpperCase() + status.slice(1); // Capitalized
                let confirmButtonText = `Yes, mark as ${actionText}`;
                let successMessage = `User has been marked as ${actionText} successfully!`;

                let bgMap = {
                    'shortlisted': '#17a2b8',
                    'rejected': '#dc3545',
                    'hired': '#28a745'
                };
                let backgroundColor = bgMap[status] || '#6c757d';

                Swal.fire({
                    title: `Are you sure?`,
                    text: `Do you want to mark this user as ${status}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: confirmButtonText,
                    cancelButtonText: 'No, cancel!',
                    background: backgroundColor,
                }).then((response) => {
                    if (response.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ route('Recruiter.VerifyStatus') }}",
                            data: {
                                id: id,
                                status: status
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status_code == 1) {
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

    @endsection
