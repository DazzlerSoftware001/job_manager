@extends('recruiter.recruiterlayout.main')
@section('title')
    Recruiter-JobPost
@endsection


@section('page-title')
    Job Post
@endsection
@section('main-container')
    <script src="https://cdn.tiny.cloud/1/k73iszd3tzdamw58yk6fmdzasoe86nkkbzktvgqtvxvcrr17/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            tinymce.init({
                selector: '#edit_job_description',
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
                                <form method="POST" action="javascript:void(0)" id="AddJobPost">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-xl-4">
                                            <label for="edit_job_title">Job Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="edit_job_title" name="edit_job_title"
                                                placeholder="Enter job title" value="{{$job->title}}">
                                        </div>


                                        <div class="col-xl-4">
                                            <label for="edit_job_type">Job Type <span class="text-danger">*</span></label>
                                            <select class="form-select" id="edit_job_type" name="edit_job_type">
                                                <option value="{{$job->type}}">{{$job->type}}</option>
                                                
                                            </select>
                                        </div>


                                        <div class="col-xl-4">
                                            <label for="edit_skills">Skills <span class="text-danger">*</span></label>
                                            <select class="form-select" id="edit_skills" name="edit_skills[]" multiple>
                                               <option value="{{$job->skills}}">{{$job->skills}}</option>
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="edit_industry">Category <span class="text-danger">*</span></label>
                                            <select class="form-select" id="edit_industry" name="edit_industry">
                                                <option value="{{$job->industry}}">{{$job->industry}}</option>
                                                
                                                    <option ></option>
                                               
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="edit_department">Department <span class="text-danger">*</span></label>
                                            <select class="form-select" id="edit_department" name="edit_department">
                                                <option value="{{$job->department}}">{{$job->department}}</option>
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="edit_role">Role <span class="text-danger">*</span></label>
                                            <select class="form-select" id="edit_role" name="edit_role">
                                                <option value="{{$job->role}}">{{$job->role}}</option>
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="edit_work_mode">Job Mode <span class="text-danger">*</span></label>
                                            <select class="form-select" id="edit_work_mode" name="edit_work_mode">
                                                <option value="{{$job->mode}}">{{$job->mode}}</option>
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="edit_location">Location <span class="text-danger">*</span></label>
                                            <select class="form-select" id="edit_location" name="edit_location">
                                                <option value="{{$job->location}}">{{$job->location}}</option>
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="edit_min_experience">Work Experience (Min - Max) <span class="text-danger">*</span></label>
                                            <div class="d-flex gap-2">
                                                <!-- Min Experience Dropdown -->
                                                <select class="form-select" id="edit_min_experience" name="edit_min_experience"
                                                    onchange="updateMaxExperience()">
                                                    {{-- <option value=0>Fresher</option> --}}
                                                <option value="{{$job->min_exp}}">{{$job->min_exp}}</option>

                                                </select>

                                                <!-- Max Experience Dropdown -->
                                                <select class="form-select" id="edit_max_experience" name="edit_max_experience"
                                                    disabled>
                                                    {{-- <option value=0>Max</option> --}}
                                                <option value="{{$job->max_exp}}">{{$job->max_exp}}</option>

                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-xl-4 mt-3">
                                            <label for="edit_currency">Annual Salary (Currency - Min - Max) <span class="text-danger">*</span></label>
                                            <div class="d-flex gap-2">
                                                <select class="form-select" id="edit_currency" name="edit_currency">
                                                    {{-- <option value="">Currency</option> --}}
                                                    <option value="{{$job->currency}}">{{$job->currency}}</option>

                                                </select>
                                                <select class="form-select" id="edit_min_salary" name="edit_min_salary"
                                                    onchange="updateMaxSalary()">
                                                    {{-- <option value="0">Min Salary</option> --}}
                                                <option value="{{$job->min_sal}}">{{$job->min_sal}}</option>

                                                </select>
                                                <select class="form-select" id="edit_max_salary" name="edit_max_salary" disabled>
                                                    {{-- <option value="0">Max Salary</option> --}}
                                                <option value="{{$job->max_sal}}">{{$job->max_sal}}</option>

                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="edit_education">Educational Qualification <span class="text-danger">*</span></label>
                                            <select class="form-select" id="edit_education" name="edit_education">
                                                {{-- <option value="">Choose Qualification</option> --}}
                                                <option value="{{$job->education}}">{{$job->education}}</option>
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="edit_candidate_industry">Condidate Industry</label>
                                            <select class="form-select" id="edit_candidate_industry"
                                                name="edit_candidate_industry">
                                                {{-- <option value="">Choose Industry</option> --}}
                                                <option value="{{$job->condidate_industry}}">{{$job->condidate_industry}}</option>

                                            </select>
                                        </div>


                                        <div class="col-xl-4 col-lg-6 col-md-8 col-sm-12 mt-3">
                                            <label for="edit_diversity" class="d-block">Diversity Hiring (Optional)</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="male"
                                                    name="edit_diversity" value="Male">
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="female"
                                                    name="edit_diversity" value="Female">
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 mt-3">
                                            <label for="edit_vacancies">Number of Vacancies <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="edit_vacancies" value="{{$job->vacancies}}">
                                        </div>


                                        <div class="col-xl-4 col-lg-6 col-md-8 col-sm-12 mt-3">
                                            <label for="edit_interview_type" class="d-block">Interview Type <span class="text-danger">*</span></label>
                                            <select class="form-select" id="edit_interview_type" name="edit_interview_type">
                                                {{-- <option value="">Select</option> --}}
                                                <option value="{{$job->int_type}}">{{$job->int_type}}</option>

                                            </select>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="row">
                                                <!-- Company Name Selection -->
                                                <div class="col-12 col-md-12 mt-3">
                                                    <label for="edit_company_name">Company Name <span class="text-danger">*</span></label>
                                                    <select class="form-select" id="edit_company_name" name="edit_company_name"
                                                        onchange="updateCompanyDetails()">
                                                        <option value="{{$job->com_name}}">{{$job->com_name}}</option>
                                                    </select>
                                                </div>

                                                <!-- Company Details -->
                                                <div class="col-12 col-md-12 mt-3">
                                                    <label for="edit_company_details">Company Details <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" id="edit_company_details" name="edit_company_details" readonly>{{$job->com_details}}</textarea>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- Image Preview Section -->
                                        <div class="col-xl-6 text-center mt-3">
                                            <label for="job_image">Job Image <span class="text-danger">*</span></label>
                                            <div class="mt-3">
                                                <img id="imagePreview" src="{{asset($job->com_logo)}}"
                                                    alt="Image Preview"
                                                    style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
                                                    <input type="hidden" id="edit_company_logo" name="edit_company_logo" value="">
                                            </div>
                                        </div>



                                        <div class="d-flex justify-content-center mt-3">
                                            <div class="col-xl-12">
                                                <label for="edit_job_description">Job Description <span class="text-danger">*</span></label>
                                                <textarea class="form-control" id="edit_job_description" name="edit_job_description">{{$job->job_desc}}</textarea>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mt-3">
                                            <div class="col-xl-12">
                                                <label for="edit_job_description">Responsibilities <span class="text-danger">*</span></label>
                                                <textarea class="form-control" id="edit_job_description" name="edit_job_description"></textarea>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mt-3">
                                            <div class="col-xl-12">
                                                <label for="edit_job_description">Requirements <span class="text-danger">*</span></label>
                                                <textarea class="form-control" id="edit_job_description" name="edit_job_description"></textarea>
                                            </div>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                var element1 = document.getElementById('edit_work_mode');
                if (element1) {
                    const choices1 = new Choices(element1, {
                        shouldSort: false,
                        position: 'down',
                        resetScrollPosition: true,
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                var edit_job_type = document.getElementById('edit_job_type');
                if (edit_job_type) {
                    const edit_job_type1 = new Choices(edit_job_type, {
                        shouldSort: false,
                        position: 'down',
                        resetScrollPosition: true,
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                var edit_skills = document.getElementById('edit_skills');
                if (edit_skills) {
                    const edit_skills1 = new Choices(edit_skills, {
                        shouldSort: false,
                        position: 'down',
                        removeItemButton: true, // Enables removing selected items
                    });
                }
            });


            document.addEventListener('DOMContentLoaded', function() {
                var edit_location = document.getElementById('edit_location');
                if (edit_location) {
                    const edit_location1 = new Choices(edit_location, {
                        shouldSort: false,
                        position: 'down',
                        resetScrollPosition: true,
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                var edit_industry = document.getElementById('edit_industry');
                if (edit_industry) {
                    const edit_industry1 = new Choices(edit_industry, {
                        shouldSort: false,
                        position: 'down',
                        resetScrollPosition: true,
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                var edit_education = document.getElementById('edit_education');
                if (edit_education) {
                    const edit_education1 = new Choices(edit_education, {
                        shouldSort: false,
                        position: 'down',
                        removeItemButton: true,
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                var edit_interview_type = document.getElementById('edit_interview_type');
                if (edit_interview_type) {
                    const edit_interview_type1 = new Choices(edit_interview_type, {
                        shouldSort: false,
                        position: 'down',
                        resetScrollPosition: true,
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                var edit_company_name = document.getElementById('edit_company_name');
                if (edit_company_name) {
                    const edit_company_name1 = new Choices(edit_company_name, {
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
                var select = document.getElementById("edit_company_name");
                var detailsTextarea = document.getElementById("edit_company_details");

                // Get the selected option
                var selectedOption = select.options[select.selectedIndex];

                // Check if data-details exists and update the textarea
                if (selectedOption) {
                    var details = selectedOption.getAttribute("data-details") || "";
                    detailsTextarea.value = details;

                    // Get and update the logo URL
                    const logoUrl = selectedOption.getAttribute('data-logo');
                    const imgElement = document.getElementById('imagePreview');
                    var hiddenLogoInput = document.getElementById("edit_company_logo");
                    if (logoUrl) {
                        const logoPath = new URL(logoUrl).pathname.replace(/^\/+/, '');
                        imgElement.src = logoUrl;
                        hiddenLogoInput.value = logoPath;
                    } else {
                        imgElement.src = 'path_to_placeholder.jpg'; // Fallback image
                        hiddenLogoInput.value = "";
                    }
                }
            }
        </script>

        <!-- JavaScript to Preview Image -->
        <script>
            function previewImage(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    const imgElement = document.getElementById('imagePreview');
                    imgElement.src = reader.result;
                    imgElement.style.display = 'block';
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>


        {{-- Showing min & max Experience --}}
        <script>
            function updateMaxExperience() {
                var minSelect = document.getElementById("edit_min_experience");
                var maxSelect = document.getElementById("edit_max_experience");

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
                var minSelect = document.getElementById("edit_min_salary");
                var maxSelect = document.getElementById("edit_max_salary");

                // // If no value is selected, set both minValue and maxValue to "N/A"
                // if (!minSelect.value) {
                //     minSelect.innerHTML = '<option value="N/A">N/A</option>';
                //     maxSelect.innerHTML = '<option value="N/A">N/A</option>';
                //     maxSelect.disabled = flase;
                //     // return;
                // }

                var minValue = parseInt(minSelect.value) || 0;

                // Enable Max Salary dropdown
                maxSelect.disabled = false;
                maxSelect.innerHTML = '';

                // Get all salary options from Min selector
                var options = Array.from(minSelect.querySelectorAll("option"))
                    .map(option => parseInt(option.value))
                    .filter(value => !isNaN(value));
                var maxValue = Math.max(...options);

                // If minValue is the maximum salary, set max_salary to "N/A" and disable it
                if (minValue === maxValue) {
                    var naOption = document.createElement("option");
                    naOption.value = "N/A";
                    naOption.textContent = "N/A";
                    maxSelect.appendChild(naOption);
                }

                // Add valid max salary options
                options.forEach(salaryValue => {
                    if (salaryValue > minValue) {
                        var newOption = document.createElement("option");
                        newOption.value = salaryValue;
                        newOption.textContent = salaryValue;
                        maxSelect.appendChild(newOption);
                    }
                });
            }
        </script>

        {{-- For selecting edit_department according to category & Role according to edit_department --}}
        <script>
            $(document).ready(function() {
                // When category changes, load edit_departments
                $('#edit_industry').change(function() {
                    var category_name = $(this).val();
                    $('#edit_department').html('<option value="">Loading...</option>');
                    $('#edit_role').html('<option value="">Select</option>'); // Reset role dropdown

                    if (category_name) {
                        $.ajax({
                            url: "{{ route('Recruiter.getDepartment') }}",
                            type: "GET",
                            data: {
                                category_name: category_name
                            },
                            success: function(data) {
                                // console.log("edit_departments Response:", data);
                                $('#edit_department').html(
                                    '<option value="">Select Department</option>');

                                if (data.length > 0) {
                                    $.each(data, function(index, item) {
                                        $('#edit_department').append('<option value="' + item
                                            .department + '">' + item.department +
                                            '</option>');
                                    });
                                } else {
                                    $('#edit_department').html(
                                        '<option value="">No Departments Found</option>');
                                }
                            },
                            error: function() {
                                $('#edit_department').html(
                                    '<option value="">Error loading data</option>');
                            }
                        });
                    } else {
                        $('#edit_department').html('<option value="">Select Department</option>');
                    }
                });

                // When department changes, load roles
                $('#edit_department').change(function() {
                    var edit_department_name = $(this).val();
                    $('#edit_role').html('<option value="">Loading...</option>');

                    if (edit_department_name) {
                        $.ajax({
                            url: "{{ route('Recruiter.getRole') }}", // Create this route
                            type: "GET",
                            data: {
                                edit_department_name: edit_department_name
                            },
                            success: function(data) {
                                // console.log("Roles Response:", data);
                                $('#edit_role').html('<option value="">Select Role</option>');

                                if (data.length > 0) {
                                    $.each(data, function(index, item) {
                                        $('#edit_role').append('<option value="' + item.role +
                                            '">' + item.role + '</option>');
                                    });
                                } else {
                                    $('#edit_role').html('<option value="">No Roles Found</option>');
                                }
                            },
                            error: function() {
                                $('#edit_role').html('<option value="">Error loading data</option>');
                            }
                        });
                    } else {
                        $('#edit_role').html('<option value="">Select Role</option>');
                    }
                });
            });
        </script>


        {{-- AddJobPost --}}
        <script>
            $(document).ready(function() {
                $('#AddJobPost').on('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    var url = "{{ route('Recruiter.PostJobData') }}"; // Submission URL
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
                                $('#AddJobPost').trigger("reset");
                                $('#myTable').DataTable().ajax.reload(null, false);

                                Toastify({
                                    text: result.message,
                                    duration: 3000,
                                    gravity: "top",
                                    position: "right",
                                    style: {
                                        background: "green",
                                        color: "white"
                                    }
                                }).showToast();

                                // Redirect to another route after successful submission
                                // setTimeout(function() {
                                //     window.location.href =
                                //         "{{ route('Recruiter.JobList') }}"; // Change this to your desired route
                                // }, 1500);
                            } else if (result.status_code === 2) {
                                Toastify({
                                    text: result.message,
                                    duration: 3000,
                                    gravity: "top",
                                    position: "right",
                                    style: {
                                        background: "#c7ac14",
                                        color: "white"
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
                                        color: "white"
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
                                    color: "white"
                                }
                            }).showToast();
                        }
                    });
                });
            });
        </script>
    @endsection
