@extends('admin.adminlayout.main')
@section('title')
    Admin-Job List
@endsection
@section('page-title')
    Job List
@endsection

@section('main-container')
    <script src="https://cdn.tiny.cloud/1/k73iszd3tzdamw58yk6fmdzasoe86nkkbzktvgqtvxvcrr17/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            tinymce.init({
                selector: '#job_description',
                height: 400,
                plugins: 'advlist autolink lists link image charmap preview',
                toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
            });
        });
    </script>

    <style>
        .choices {
            border: var(--bs-border-width) solid var(--bs-border-color);
            border-radius: var(--bs-border-radius);
            overflow: hidden;
            line-height: 0.8;
            height: 38px;
        }

        .choices__inner {
            background-color: var(--bs-secondary-bg);
            color: var(--bs-body-color);
        }

        .choices__list--single .choices__item {
            color: #000000;
        }

        .choices[data-type*=select-one] .choices__input {
            display: block;
            width: 100%;
            border: 1px solid #a29898 !important;
            background-color: #ffffff;
            border-radius: 10px;
        }

        .is-focused .choices__inner,
        .is-open .choices__inner {
            border: var(--bs-border-width) solid var(--bs-border-color);
            border-radius: var(--bs-border-radius);
        }

        .choices[data-type*="select-one"]::after {
            content: "";
            width: 12px;
            /* Adjust based on your icon size */
            height: 12px;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2322354e' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            position: absolute;
            right: 15px;
            top: 60%;
            /* Keep it centered */
            transform: translateY(-50%);
            /* Ensure it remains vertically aligned */
            pointer-events: none;
            border: none;
            /* Remove existing arrow */
            transition: transform 0.3s ease;
            /* Smooth transition */
        }

        /* When select box is open, rotate the arrow */
        .choices[data-type*="select-one"].is-open::after {
            transform: translateY(-90%) rotate(180deg);
        }



        .choices[data-type*="select-one"].is-open::after {
            border-color: transparent transparent #333;
            margin-top: 2px;

        }
    </style>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Job List</h4>
                            </div>

                            <div class="px-3 mt-3 d-flex align-items-center gap-2">
                                <input type="text" id="search" name="search"
                                    class="form-control form-control-sm bg-light rounded w-25" placeholder="Search...">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">+ Create Job</button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Type</th>
                                                <th>Skills</th>
                                                <th>Industry</th>
                                                <th>Department</th>
                                                <th>Role</th>
                                                <th>Mode</th>
                                                <th>Location</th>
                                                <th>Experience(Min - Max)</th>
                                                <th>Salary Range</th>
                                                <th>Qualifications</th>
                                                <th>Condidate Industry</th>
                                                <th>Diversity</th>
                                                <th>No. of Vacancies</th>
                                                <th>Interview type</th>
                                                <th>Company Name</th>
                                                <th>Logo</th>
                                                <th>Company Details</th>
                                                <th>Job Description</th>
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


        <!-- Modal to view image -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Logo Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="modalImage" src="" alt="Logo" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>


        <!--add Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create job</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- form -->
                        <form method="POST" action="javascript:void(0)" id="AddJobPost">
                            <div class="row mb-3">
                                <div class="col-xl-4">
                                    <label for="job_title">Job Title</label>
                                    <input type="text" class="form-control" id="job_title" name="job_title"
                                        placeholder="Enter job title">
                                </div>


                                <div class="col-xl-4">
                                    <label for="job_type">Job Type</label>
                                    <select class="form-select" id="job_type" name="job_type">
                                        <option value="">Select</option>
                                        @foreach ($jobTypes as $key => $value)
                                            <option value="{{ $value->type }}">{{ $value->type }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-xl-4">
                                    <label for="skills">Skills</label>
                                    <select class="form-select" id="skills" name="skills[]" multiple>
                                        @foreach ($jobSkill as $key => $value)
                                            <option value="{{ $value->skill }}">{{ $value->skill }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-xl-4 mt-3">
                                    <label for="industry">Category</label>
                                    <select class="form-select" id="industry" name="industry">
                                        <option value="">Choose Industry</option>
                                        @foreach ($JobCategory as $key => $value)
                                            <option value="{{ $value->name }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-xl-4 mt-3">
                                    <label for="department">Department</label>
                                    <select class="form-select" id="department" name="department">
                                        <option value="">Select</option>
                                    </select>
                                </div>


                                <div class="col-xl-4 mt-3">
                                    <label for="role">Role</label>
                                    <select class="form-select" id="role" name="role">
                                        <option value="">Select</option>
                                    </select>
                                </div>


                                <div class="col-xl-4 mt-3">
                                    <label for="work_mode">Job Mode</label>
                                    <select class="form-select" id="work_mode" name="work_mode">
                                        <option value="">Select</option>
                                        @foreach ($jobMode as $key => $value)
                                            <option value="{{ $value->mode }}">{{ $value->mode }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-xl-4 mt-3">
                                    <label for="location">Location</label>
                                    <select class="form-select" id="location" name="location">
                                        <option value="">Select</option>
                                        @foreach ($JobLocation as $key => $value)
                                            <option value="{{ $value->country . ' - ' . $value->city }}">
                                                {{ $value->country . ' - ' . $value->city }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-xl-4 mt-3">
                                    <label for="min_experience">Work Experience (Min - Max)</label>
                                    <div class="d-flex gap-2">
                                        <!-- Min Experience Dropdown -->
                                        <select class="form-select" id="min_experience" name="min_experience"
                                            onchange="updateMaxExperience()">
                                            <option value=0>Fresher</option>
                                            @foreach ($JobExperience as $value)
                                                <option value="{{ $value->experience }}">{{ $value->experience }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <!-- Max Experience Dropdown -->
                                        <select class="form-select" id="max_experience" name="max_experience" disabled>
                                            <option value=0>Max</option>
                                            @foreach ($JobExperience as $value)
                                                <option value="{{ $value->experience }}">{{ $value->experience }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <div class="col-xl-4 mt-3">
                                    <label for="currency">Annual Salary (Currency - Min - Max)</label>
                                    <div class="d-flex gap-2">
                                        <select class="form-select" id="currency" name="currency">
                                            <option value="">Currency</option>
                                            @foreach ($JobCurrency as $value)
                                                <option value="{{ $value->currency }}">{{ $value->currency }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <select class="form-select" id="min_salary" name="min_salary"
                                            onchange="updateMaxSalary()">
                                            <option value="">Min Salary</option>
                                            @foreach ($JobSalary as $value)
                                                <option value="{{ $value->salary }}">{{ $value->salary }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <select class="form-select" id="max_salary" name="max_salary" disabled>
                                            <option value="0">Max Salary</option>
                                            @foreach ($JobSalary as $value)
                                                <option value="{{ $value->salary }}">{{ $value->salary }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-xl-4 mt-3">
                                    <label for="education">Educational Qualification</label>
                                    <select class="form-select" id="education" name="education">
                                        <option value="">Choose Qualification</option>
                                        @foreach ($JobEducation as $key => $value)
                                            <option value="{{ $value->education }}">{{ $value->education }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-xl-4 mt-3">
                                    <label for="candidate_industry">Condidate Industry</label>
                                    <select class="form-select" id="candidate_industry" name="candidate_industry">
                                        <option value="">Choose Industry</option>
                                        @foreach ($JobCategory as $key => $value)
                                            <option value="{{ $value->name }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-8 col-sm-12 mt-3">
                                    <label for="diversity" class="d-block">Diversity Hiring</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="male" name="diversity"
                                            value="Male">
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="female" name="diversity"
                                            value="Female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>

                                <div class="col-xl-4 mt-3">
                                    <label for="vacancies">Number of Vacancies</label>
                                    <input type="number" class="form-control" name="vacancies">
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-8 col-sm-12 mt-3">
                                    <label for="interview_type" class="d-block">Interview Type</label>
                                    <select class="form-select" id="interview_type" name="interview_type">
                                        <option value="">Select</option>
                                        @foreach ($JobIntType as $key => $value)
                                            <option value="{{ $value->int_type }}">{{ $value->int_type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-xl-6 mt-3">
                                    <label for="company_name">Company Name</label>
                                    <select class="form-select" id="company_name" name="company_name"
                                        onchange="updateCompanyDetails()">
                                        <option value="">Select</option>
                                        @foreach ($Companies as $company)
                                            <option value="{{ $company->name }}" data-details="{{ $company->details }}">
                                                {{ $company->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="col-xl-6 mt-3">
                                    <label for="company_details">Company Details</label>
                                    <textarea class="form-control" id="company_details" name="company_details" readonly></textarea>
                                </div>

                                <div class="d-flex justify-content-center mt-3">
                                    <div class="col-xl-8 text-center">
                                        <label for="job_description">Job Description</label>
                                        <textarea class="form-control" id="job_description" name="job_description"></textarea>
                                    </div>
                                </div>



                            </div>


                            <div class="col-12 mb-3">
                                <button type="submit" class="btn btn-primary">Preview & Post Job</button>
                            </div>

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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit job</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- form -->
                        <form method="POST" action="javascript:void(0)" id="EditJobCategory">

                            <div class="mb-3" id="modal-id" style="display: none;">
                                <label for="edit-id" class="form-label">ID</label>
                                <input type="text" name="edit-id" id="edit-id" class="form-control"
                                    placeholder="ID" />
                            </div>

                            <div class="mb-3">
                                <label for="editcategory" class="form-label">Category</label>
                                <input type="text" class="form-control" name="editcategory" id="editcategory"
                                    aria-describedby="countryHelp">
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

        <!--Description Modal -->
        <div class="modal fade" id="descModal" tabindex="-1" aria-labelledby="descModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="descModalLabel">Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="descModalBody">
                        <!-- Description content will be inserted here -->
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
                        url: "{{ route('Admin.GetJobPost') }}",
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

        {{--  open the image modal --}}
        <script>
            function openImageModal(imageSrc) {
                // Set the modal image source to the clicked image
                document.getElementById('modalImage').src = imageSrc;
                // Open the modal
                $('#imageModal').modal('show');
            }
        </script>

        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                var element1 = document.getElementById('work_mode');
                if (element1) {
                    const choices1 = new Choices(element1, {
                        shouldSort: false,
                        position: 'down',
                        resetScrollPosition: true,
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                var job_type = document.getElementById('job_type');
                if (job_type) {
                    const job_type1 = new Choices(job_type, {
                        shouldSort: false,
                        position: 'down',
                        resetScrollPosition: true,
                    });
                }
            });

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


            document.addEventListener('DOMContentLoaded', function() {
                var location = document.getElementById('location');
                if (location) {
                    const location1 = new Choices(location, {
                        shouldSort: false,
                        position: 'down',
                        resetScrollPosition: true,
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                var industry = document.getElementById('industry');
                if (industry) {
                    const industry1 = new Choices(industry, {
                        shouldSort: false,
                        position: 'down',
                        resetScrollPosition: true,
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                var education = document.getElementById('education');
                if (education) {
                    const education1 = new Choices(education, {
                        shouldSort: false,
                        position: 'down',
                        removeItemButton: true,
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                var interview_type = document.getElementById('interview_type');
                if (interview_type) {
                    const interview_type1 = new Choices(interview_type, {
                        shouldSort: false,
                        position: 'down',
                        resetScrollPosition: true,
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                var company_name = document.getElementById('company_name');
                if (company_name) {
                    const company_name1 = new Choices(company_name, {
                        shouldSort: false,
                        position: 'down',
                        resetScrollPosition: true,
                    });
                }
            });
        </script>

        <!-- For Company Details -->
        <script>
            function updateCompanyDetails() {
                var select = document.getElementById("company_name");
                var detailsTextarea = document.getElementById("company_details");

                // Get the selected option
                var selectedOption = select.options[select.selectedIndex];

                // Check if data-details exists
                if (selectedOption) {
                    var details = selectedOption.getAttribute("data-details") || "";
                    detailsTextarea.value = details;
                }
            }
        </script>


        {{-- Showing min & max Experience --}}
        <script>
            function updateMaxExperience() {
                var minSelect = document.getElementById("min_experience");
                var maxSelect = document.getElementById("max_experience");

                var minValue = parseInt(minSelect.value) || 0;

                // Enable Max Experience dropdown
                maxSelect.disabled = false;
                maxSelect.innerHTML = '';

                // Get all experience options from Min selector
                var options = Array.from(minSelect.querySelectorAll("option")).map(option => parseInt(option.value)).filter(
                    value => !isNaN(value));
                var maxValue = Math.max(...options); // Get the maximum experience value

                // If "Fresher" (0) is selected, set max_experience to 0 and disable it
                if (minValue === 0) {
                    var fresherOption = document.createElement("option");
                    fresherOption.value = "0";
                    fresherOption.textContent = "0";
                    maxSelect.appendChild(fresherOption);
                    // maxSelect.disabled = true;
                    // return;
                }

                // If minValue is the maximum experience, set max_experience to "N/A" and disable it
                if (minValue === maxValue) {
                    var naOption = document.createElement("option");
                    naOption.value = "N/A";
                    naOption.textContent = "N/A";
                    maxSelect.appendChild(naOption);
                    maxSelect.disabled = true;
                    return;
                }

                // Add valid max experience options
                options.forEach(experienceValue => {
                    if (experienceValue > minValue) {
                        var newOption = document.createElement("option");
                        newOption.value = experienceValue;
                        newOption.textContent = experienceValue;
                        maxSelect.appendChild(newOption);
                    }
                });
            }
        </script>

        {{-- Showing min & max Salary --}}
        <script>
            function updateMaxSalary() {
                var minSelect = document.getElementById("min_salary");
                var maxSelect = document.getElementById("max_salary");

                // Get selected Min Salary value
                var minValue = parseInt(minSelect.value) || 0;

                // Enable Max Salary dropdown
                maxSelect.disabled = false;

                // Remove previous options
                maxSelect.innerHTML = '<option value="">Max Salary</option>';

                // Get all salary options from Min selector
                var options = minSelect.querySelectorAll("option");

                options.forEach(option => {
                    var salaryValue = parseInt(option.value);
                    if (!isNaN(salaryValue) && salaryValue > minValue) {
                        var newOption = document.createElement("option");
                        newOption.value = salaryValue;
                        newOption.textContent = salaryValue;
                        maxSelect.appendChild(newOption);
                    }
                });
            }
        </script>

        {{-- For selecting department according to category & Role according to department --}}
        <script>
            $(document).ready(function() {
                // When category changes, load departments
                $('#industry').change(function() {
                    var category_name = $(this).val();
                    $('#department').html('<option value="">Loading...</option>');
                    $('#role').html('<option value="">Select</option>'); // Reset role dropdown

                    if (category_name) {
                        $.ajax({
                            url: "{{ route('Recruiter.getDepartment') }}",
                            type: "GET",
                            data: {
                                category_name: category_name
                            },
                            success: function(data) {
                                // console.log("Departments Response:", data);
                                $('#department').html(
                                    '<option value="">Select Department</option>');

                                if (data.length > 0) {
                                    $.each(data, function(index, item) {
                                        $('#department').append('<option value="' + item
                                            .department + '">' + item.department +
                                            '</option>');
                                    });
                                } else {
                                    $('#department').html(
                                        '<option value="">No Departments Found</option>');
                                }
                            },
                            error: function() {
                                $('#department').html(
                                    '<option value="">Error loading data</option>');
                            }
                        });
                    } else {
                        $('#department').html('<option value="">Select Department</option>');
                    }
                });

                // When department changes, load roles
                $('#department').change(function() {
                    var department_name = $(this).val();
                    $('#role').html('<option value="">Loading...</option>');

                    if (department_name) {
                        $.ajax({
                            url: "{{ route('Recruiter.getRole') }}", // Create this route
                            type: "GET",
                            data: {
                                department_name: department_name
                            },
                            success: function(data) {
                                // console.log("Roles Response:", data);
                                $('#role').html('<option value="">Select Role</option>');

                                if (data.length > 0) {
                                    $.each(data, function(index, item) {
                                        $('#role').append('<option value="' + item.role +
                                            '">' + item.role + '</option>');
                                    });
                                } else {
                                    $('#role').html('<option value="">No Roles Found</option>');
                                }
                            },
                            error: function() {
                                $('#role').html('<option value="">Error loading data</option>');
                            }
                        });
                    } else {
                        $('#role').html('<option value="">Select Role</option>');
                    }
                });
            });
        </script>


        {{-- For Showing Details --}}
        <script>
            function openDetailsModal(com_details) {
                document.getElementById('detailsModalBody').innerHTML = com_details;
                var myModal = new bootstrap.Modal(document.getElementById('detailsModal'));
                myModal.show();
            }
        </script>

        {{-- For Showing Description --}}
        <script>
            function openDescModal(job_desc) {
                document.getElementById('descModalBody').innerHTML = job_desc;
                var myModal = new bootstrap.Modal(document.getElementById('descModal'));
                myModal.show();
            }
        </script>

        {{-- CreateJob --}}
        <script>
            $(document).ready(function() {
                $('#AddJobPost').on('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    var url = "{{ route('Admin.AddJobPost') }}";
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
                                $('#AddJobPost').trigger("reset");
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

                            } else if (result.status_code === 2) {
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
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', error);
                            Toastify({
                                text: 'An error occurred. Please try again.',
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "red",
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

        {{-- Edit Category --}}
        <script>
            function edit(id) {
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('Admin.EditJobCategory') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(result) {

                        var record = result.data;
                        $('#edit-id').val(record.id);
                        $('#editcategory').val(record.name);

                    },
                });
            }
        </script>

        {{-- Update Category --}}
        <script>
            $(document).ready(function() {
                $('#EditJobCategory').on('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    var url = "{{ route('Admin.UpdateJobCategory') }}";
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
                                $('#EditJobCategory').trigger("reset");
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
