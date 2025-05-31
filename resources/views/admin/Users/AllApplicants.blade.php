@extends('admin.adminlayout.main')
@section('title')
    Admin-All Apllicants
@endsection
@section('page-title')
   All Apllicants
@endsection

@section('main-container')

   
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Apllicants</h4>
                            </div>

                                <input type="hidden" name="decryptedId" id="decryptedId" value="">

                                <div class="row">
                                    <div class="col-6 mt-2 px-3">
                                        <label for="RecruiterFilter" class="form-label">Select Recruiter</label>
                                        <select id="RecruiterFilter" class="form-select">
                                            <option value="">Filter by Recruiter</option>
                                            @foreach ($Recruiters as $Recruite)
                                                <option value="{{ $Recruite->id }}">{{ $Recruite->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-6 mt-2 px-3">
                                        <label for="JobFilter" class="form-label">Select Job</label>
                                        <select id="JobFilter" class="form-select">
                                            <option value="">Filter by Job</option>
                                           
                                        </select>
                                    </div>
                                </div>

                                
                                <div class="row mt-2 px-3">

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

                                    {{-- <div class="col-2 mt-2">
                                        <label for="statusFilter" class="form-label">Select Status</label>

                                        <select id="statusFilter" class="form-select">
                                            <option value="">Status</option>
                                            <option value="pending">Applied</option>
                                            <option value="shortlisted">ShortListed</option>
                                            <option value="hired">Hired</option>
                                            <option value="rejected">Rejected</option>
                                        </select>
                                    </div> --}}

                                    {{-- <div class="col-2 mt-2">
                                        <label for="ProfilestatusFilter" class="form-label">Select Profile Status</label>

                                        <select id="ProfilestatusFilter" class="form-select">
                                            <option value="">Status</option>
                                            <option value="1">Viewed</option>
                                            <option value="0">Not Viewed</option>
                                        </select>
                                    </div> --}}

                                    {{-- <div class="col-2 mt-2">
                                        <label for="ExperienceFilter" class="form-label">Select Experience</label>

                                        <select id="ExperienceFilter" class="form-select">
                                            <option value="">Experience</option>
                                            @foreach ($experience as $exp)
                                                <option value="{{ $exp }}">{{ $exp }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}

                                    {{-- <div class="col-12 col-md-4 mt-2">
                                        <label class="form-label fw-bold">Select Experience</label>
                                        <div class="border rounded p-2" style="max-height: 180px; overflow-y: auto;">
                                            @foreach ($experience as $exp)
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input" type="checkbox" name="experience[]"
                                                        value="{{ $exp }}" id="exp_{{ $loop->index }}">
                                                    <label class="form-check-label" for="exp_{{ $loop->index }}">
                                                        {{ $exp }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div> --}}
                                    <div class="col-12 col-md-2 mt-2">
                                        <label class="form-label">Select Experience</label>

                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary form-control dropdown-toggle w-100 text-start"
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


                                    {{-- <div class="col-2 mt-2">
                                        <label for="search" class="form-label">Search</label>

                                        <input type="text" id="search" class="form-control mb-3"
                                            placeholder="Search by name, email or job title">
                                    </div> --}}

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


                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Image</th>
                                                {{-- <th>Status</th> --}}
                                                {{-- <th>Registered Date</th> --}}
                                                <th>Excel</th>
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

         <!-- Modal to view image -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Image</h5>
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
    @section('script')

        {{-- Get job by recruiter --}}
        <script>
            $(document).ready(function () {
                $('#RecruiterFilter').on('change', function () {
                    var recruiterId = $(this).val();

                    if (recruiterId) {

                        console.log('Selected city:', $('#cityFilter').val());

                        $.ajax({
                            url: '{{ route('Admin.getJobsByRecruiter') }}',
                            type: 'GET',
                            data: { 
                                recruiter_id: recruiterId
                            },
                            success: function (data) {
                                $('#JobFilter').empty().append('<option value="">Filter by Job</option>');
                                $.each(data, function (key, job) {
                                    $('#JobFilter').append('<option value="' + job.id + '">' + job.title + '</option>');
                                });

                            }

                        });
                    } else {
                        $('#JobFilter').empty().append('<option value="">Filter by Job</option>');
                      
                    }
                });

                
            });
        </script>


        {{-- Get User list --}}
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
                        url: "{{ route('Admin.GetApplicants') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: function(data) {

                            data.JobFilter = $('#JobFilter').val();
                            data.city= $('#cityFilter').val();
                            data.skills =$('#skills').val();
                            data.education_level= $('#education_level').val();
                            data.Qualification= $('#Qualification').val();
                            data.Branch =$('#Branch').val();
                            data.experience=$('input[name="experience[]"]:checked')
                                .map(function () {
                                    return this.value;
                                }).get()
                        }
                    },
                    "language": {
                        "emptyTable": "<div><lord-icon src='https://cdn.lordicon.com/msoeawqm.json' trigger='loop' style='width:75px;height:75px'></div> <div class='mt-2 noresult'><b>Sorry! No Result Found</b></div>"
                    }
                });

                 $('#JobFilter, #education_level, #Qualification, #Branch, #cityFilter,#skills, input[name="experience[]"]').on('change', function () {
                    $('#myTable').DataTable().draw();
                });
                
            });
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
                    url: '{{ route('Admin.GetApplicantsQualifications') }}',
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
                        url: '{{ route('Admin.GetApplicantsBranches') }}',
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

        {{-- Choices for skills--}}
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



        {{--  open the image modal --}}
        <script>
            function openImageModal(imageSrc) {
                // Set the modal image source to the clicked image
                document.getElementById('modalImage').src = imageSrc;
                // Open the modal
                $('#imageModal').modal('show');
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
                            url: "{{ route('Admin.ChangeUserStatus') }}",
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
                            url: "{{ route('Admin.DeleteUser') }}",
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
