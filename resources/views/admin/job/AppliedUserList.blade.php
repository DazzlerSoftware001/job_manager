@extends('admin.adminlayout.main')
@section('title')
    Admin-All User List
@endsection
@section('page-title')
    All User List
@endsection

@section('main-container')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{$PostName}}</h4>
                            </div>

                            <div class="card-body">

                                <div class="row">
                                    <input type="hidden" name="decryptedId" id="decryptedId" value="{{ $decryptedId }}">
                                    {{-- <div class="col-10 mt-2">
                                        <label for="jobFilter" class="form-label">Select Job</label>
                                        <select id="jobFilter" class="form-select">
                                            <option value="">Filter by Job</option>
                                            @foreach ($joblist as $job)
                                                <option value="{{ $job->id }}">{{ $job->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-2 mt-2">
                                    </div> --}}


                                    {{-- education level --}}
                                    <div class="col-2 mt-2">
                                        <label for="education_level" class="form-label">Select Education</label>

                                        <select name="education_level" id="education_level" class="form-select">
                                            <option value="">Select Education Level</option>
                                            <option value="Matric">Secondary Education</option>
                                            <option value="Higher Secondary">Higher Secondary Education</option>
                                            <option value="UG">Undergraduate (UG)</option>
                                            <option value="PG">Postgraduate (PG)</option>
                                            <option value="PhD">Doctorate (PhD)</option>
                                            <option value="PostDoc">Postdoctoral Research (After PhD)</option>
                                            <option value="Diploma">Diploma & Certificate Courses</option>
                                        </select>

                                    </div>

                                    <div class="col-2 mt-2">
                                        <label for="Qualification" class="form-label">Qualification</label>
                                        <select id="Qualification" class="form-select">
                                            <option value="">Select</option>
                                        </select>
                                    </div>

                                    <div class="col-2 mt-2">
                                        <label for="Branch" class="form-label">Branch</label>
                                        <select id="Branch" class="form-select">
                                            <option value="">Select</option>
                                        </select>
                                    </div>


                                    <div class="col-2 mt-2">
                                        <label for="cityFilter" class="form-label">Select City</label>

                                        <select id="cityFilter" class="form-select">
                                            <option value="">City</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city }}">{{ $city }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-2 mt-2">
                                        <label for="statusFilter" class="form-label">Select Status</label>

                                        <select id="statusFilter" class="form-select">
                                            <option value="">Status</option>
                                            <option value="pending">Applied</option>
                                            <option value="shortlisted">ShortListed</option>
                                            <option value="hired">Hired</option>
                                            <option value="rejected">Rejected</option>
                                        </select>
                                    </div>

                                    <div class="col-2 mt-2">
                                        <label for="ProfilestatusFilter" class="form-label">Select Profile Status</label>

                                        <select id="ProfilestatusFilter" class="form-select">
                                            <option value="">Status</option>
                                            <option value="1">Viewed</option>
                                            <option value="0">Not Viewed</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-2 mt-2">
                                        <label class="form-label">Select Experience</label>

                                        <div class="dropdown">
                                            <button
                                                class="btn btn-outline-secondary form-control dropdown-toggle w-100 text-start"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Select Experience
                                            </button>
                                            <ul class="dropdown-menu w-100 px-3"
                                                style="max-height: 200px; overflow-y: auto;">
                                                @foreach ($experience as $exp)
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="experience[]" value="{{ $exp }}"
                                                                id="exp_{{ $loop->index }}">
                                                            <label class="form-check-label" for="exp_{{ $loop->index }}">
                                                                {{ $exp }}
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-2 mt-2">
                                        <label for="search" class="form-label">Search</label>

                                        <input type="text" id="search" class="form-control mb-3"
                                            placeholder="Search by name, email or job title">
                                    </div>

                                    <div class="col-3 mt-2">
                                        <label for="skills" class="form-label">Skills</label>
                                        <select id="skills" class="form-select" multiple>
                                            <option value="">Select Skills</option>
                                            @foreach ($skills as $skill)
                                                <option value="{{ $skill }}">{{ ucfirst($skill) }}</option>
                                            @endforeach
                                        </select>

                                    </div>


                                </div>



                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Applicant Name</th>
                                                <th>Applicant Email</th>
                                                <th>Profile Image</th>
                                                <th>City</th>
                                                <th>Status</th>
                                                <th>Applied Date</th>
                                                <th>Profile Status</th>
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
        <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel"
            aria-hidden="true">
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

        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Profile Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="modalImage" src="" alt="Logo" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#skills').select2({
                placeholder: "Select Skills",
                allowClear: true
            });
        });
    </script>

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
                        url: "{{ route('Admin.GetAppliedUserList') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: function(data) {
                            data.decryptedId = $('#decryptedId').val(); // important
                            data.job_id = $('#jobFilter').val(); // important

                            data.education_level = $('#education_level').val();
                            data.Qualification = $('#Qualification').val();
                            data.Branch = $('#Branch').val();

                            data.city = $('#cityFilter').val(); // optional
                            data.status = $('#statusFilter').val(); // optional
                            data.Profilestatus = $('#ProfilestatusFilter').val(); // optional
                            data.search = $('#search').val();
                            data.skills = $('#skills').val();
                            // data.experience = $('#ExperienceFilter').val();
                            data.experience = $('input[name="experience[]"]:checked')
                                .map(function() {
                                    return this.value;
                                }).get();

                        }

                    },
                    "language": {
                        "emptyTable": "<div><lord-icon src='https://cdn.lordicon.com/msoeawqm.json' trigger='loop' style='width:75px;height:75px'></div> <div class='mt-2 noresult'><b>Sorry! No Result Found</b></div>"
                    }
                });
                if ($('#decryptedId').val()) {
                    $('#myTable').DataTable().draw();
                }

                $('#jobFilter, #education_level, #Qualification, #Branch, #cityFilter, #statusFilter, #ProfilestatusFilter, #skills, input[name="experience[]"]')
                    .on(
                        'change',
                        function() {
                            $('#myTable').DataTable().draw();

                        });

                // 🔍 Trigger search if search box exists
                $('#search').on('keyup', function(e) {
                    e.preventDefault();
                    $('#myTable').DataTable().draw();
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var skills = document.getElementById('skills');
                if (skills) {
                    const skills1 = new Choices(skills, {
                        shouldSort: false,
                        position: 'down',
                        removeItemButton: true, // Enables removing selected items
                    });
                }
            });
        </script>

        {{-- For Sho image --}}
        <script>
            function openImageModal(imageSrc) {
                // Set the modal image source to the clicked image
                document.getElementById('modalImage').src = imageSrc;
                // Open the modal
                $('#imageModal').modal('show');
            }
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

        {{-- For Select Qualification According to Education level --}}
        <script>
            $('#education_level').on('change', function() {
                var educationLevel = $(this).val();

                // Clear existing qualification
                var $qualification = $('#Qualification');
                $qualification.empty().append('<option value="">Select</option>');

                var $branch = $('#Branch');
                $branch.empty().append('<option value="">Select</option>');

                $.ajax({
                    url: '{{ route('Admin.GetUserListQualifications') }}',
                    method: 'POST',
                    data: {
                        education_level: educationLevel,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        var $qualification = $('#Qualification');
                        $qualification.empty().append('<option value="">Select</option>');

                        $.each(data, function(index, value) {
                            $qualification.append('<option value="' + value + '">' + value +
                                '</option>');
                        });
                    }
                });
            });
        </script>

        {{-- For Selecting Branch According to Qualifications --}}
        <script>
            $('#Qualification').on('change', function() {
                var qualification = $(this).val();

                // Reset Branch dropdown
                var $branch = $('#Branch');
                $branch.empty().append('<option value="">Select</option>');

                if (qualification !== '') {
                    $.ajax({
                        url: '{{ route('Admin.GetUserListBranches') }}',
                        method: 'POST',
                        data: {
                            qualification: qualification,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            $.each(data, function(index, value) {
                                $branch.append('<option value="' + value + '">' + value +
                                    '</option>');
                            });
                        }
                    });
                }
            });
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
