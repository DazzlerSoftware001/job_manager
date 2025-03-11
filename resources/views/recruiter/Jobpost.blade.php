@extends('recruiter.recruiterlayout.main')
@section('title')
    Recruiter-JobPost
@endsection
@section('page-title')
    Job Post
@endsection
@section('main-container')
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
                    <div class="col-xxl-12">
                        <div class="row">
                            <div class="col-xl-4 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                    <div class="avatar-title rounded bg-primary bg-gradient">
                                                        <i data-eva="pie-chart-2" class="fill-white"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="text-muted mb-1">Revenue</p>
                                                <h4 class="mb-0">$21,456</h4>
                                            </div>

                                            <div class="flex-shrink-0 align-self-end ms-2">
                                                <div
                                                    class="badge rounded-pill font-size-13 bg-success-subtle text-success ">
                                                    + 2.65%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <div class="col-xl-4 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                    <div class="avatar-title rounded bg-primary bg-gradient">
                                                        <i data-eva="shopping-bag" class="fill-white"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="text-muted mb-1">Orders</p>
                                                <h4 class="mb-0">5,643</h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-end ms-2">
                                                <div
                                                    class="badge rounded-pill font-size-13  bg-danger-subtle  text-danger ">
                                                    - 0.82%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                    <div class="avatar-title rounded bg-primary bg-gradient">
                                                        <i data-eva="people" class="fill-white"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="text-muted mb-1">Customers</p>
                                                <h4 class="mb-0">45,254</h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-end ms-2">
                                                <div class="badge rounded-pill font-size-13 bg-danger-subtle text-danger">-
                                                    1.04%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="card">
                            <div class="card-body pb-0">
                                <form method="POST" action="{{ route('Recruiter.PostJobData') }}">
                                    @csrf
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
                                                @foreach ($JobRole as $key => $value)
                                                    <option value="{{ $value->role }}">{{ $value->role }}</option>
                                                @endforeach
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
                                                    <option value="">Min</option>
                                                    @foreach ($JobExperience as $value)
                                                        <option value="{{ $value->experience }}">{{ $value->experience }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <!-- Max Experience Dropdown -->
                                                <select class="form-select" id="max_experience" name="max_experience"
                                                    disabled>
                                                    <option value="">Max</option>
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
                                                    <option value="">Max Salary</option>
                                                    @foreach ($JobSalary as $value)
                                                        <option value="{{ $value->salary }}">{{ $value->salary }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="education">Educational Qualification</label>
                                            <select class="form-select" id="education" name="education[]" multiple>
                                                <option>Select</option>
                                                <option>Part Time</option>
                                                <option>Contract</option>
                                                <option>Internship</option>
                                                <option>Freelance</option>
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="condidate_industry">Condidate Industry</label>
                                            <select class="form-select" id="condidate_industry"
                                                name="condidate_industry">
                                                <option value="">Select</option>
                                                <option>Part Time</option>
                                                <option>Contract</option>
                                                <option>Internship</option>
                                                <option>Freelance</option>
                                            </select>
                                        </div>


                                        <div class="col-xl-4 col-lg-6 col-md-8 col-sm-12 mt-3">
                                            <label for="diversity" class="d-block">Diversity Hiring</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="male"
                                                    name="diversity" value="Male">
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="female"
                                                    name="diversity" value="Female">
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                        </div>



                                        <div class="col-xl-4 mt-3">
                                            <label for="job_description">Job Description</label>
                                            <textarea class="form-control" name="job_description"></textarea>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="vacancies">Number of Vacancies</label>
                                            <input type="number" class="form-control" name="vacancies">
                                        </div>


                                        <div class="col-xl-4 col-lg-6 col-md-8 col-sm-12">
                                            <label for="interview_type" class="d-block">Interview Type</label>
                                            <select class="form-select" id="interview_type" name="interview_type">
                                                <option value="">Select</option>
                                                @foreach ($JobIntType as $key => $value)
                                                    <option value="{{ $value->int_type }}">{{ $value->int_type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="company_name">Company Name</label>
                                            <select class="form-select" id="company_name" name="company_name"
                                                onchange="updateCompanyDetails()">
                                                <option value="">Select</option>
                                                @foreach ($Companies as $company)
                                                    <option value="{{ $company->id }}"
                                                        data-details="{{ $company->details }}">
                                                        {{ $company->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>



                                        <div class="col-xl-4 mt-3">
                                            <label for="company_details">Company Details</label>
                                            <textarea class="form-control" id="company_details" name="company_details" readonly></textarea>
                                        </div>



                                    </div>


                                    <div class="col-12 mb-3">
                                        <button type="submit" class="btn btn-primary">Preview & Post Job</button>
                                    </div>
                                </form>
                            </div>

                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                        <!-- end row -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    @endsection
    @section('script')
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
                var role = document.getElementById('role');
                if (role) {
                    const role1 = new Choices(role, {
                        shouldSort: false,
                        position: 'down',
                        resetScrollPosition: true,
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


        {{-- <script>
            $(document).ready(function() {
                $('#PostJobData').on('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    var url = "{{ route('Recruiter.PostJobData') }}";
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
                                $('#PostJobData').trigger("reset");
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
        </script> --}}

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

                // Get selected Min Experience value
                var minValue = parseInt(minSelect.value) || 0;

                // Enable Max Experience dropdown
                maxSelect.disabled = false;

                // Remove previous options
                maxSelect.innerHTML = '<option value="">Max</option>';

                // Get all experience options from Min selector
                var options = minSelect.querySelectorAll("option");

                options.forEach(option => {
                    var experienceValue = parseInt(option.value);
                    if (!isNaN(experienceValue) && experienceValue >= minValue) {
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
                    if (!isNaN(salaryValue) && salaryValue >= minValue) {
                        var newOption = document.createElement("option");
                        newOption.value = salaryValue;
                        newOption.textContent = salaryValue;
                        maxSelect.appendChild(newOption);
                    }
                });
            }
        </script>

        {{-- For selecting department according to category --}}

        <script>
            $(document).ready(function() {
                $('#industry').change(function() {
                    var category_name = $(this).val();
                    $('#department').html('<option value="">Loading...</option>');

                    if (category_name) {
                        $.ajax({
                            url: "{{ route('Recruiter.getDepartment') }}",
                            type: "GET",
                            data: {
                                category_name: category_name
                            },
                            success: function(data) {
                                console.log("Response Data:", data);
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
            });
        </script>
    @endsection
