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

                        <div class="card">
                            <div class="card-body pb-0">
                                <form method="POST" action="javascript:void(0)" id="UpdateJobPost"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <input type="hidden" name="edit-id" id="edit-id" value="{{ $jobPost->id }}">
                                        <div class="col-xl-12">
                                            <label for="job_title">Job Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="job_title" name="job_title"
                                                value="{{ $jobPost->title ?? '' }}" placeholder="Enter job title">
                                        </div>


                                        <div class="col-xl-4 mt-2">
                                            <label for="job_type">Job Type <span class="text-danger">*</span></label>
                                            <select class="form-select" id="job_type" name="job_type">
                                                <option value="">Select</option>
                                                @foreach ($jobTypes as $key => $value)
                                                    {{-- <option value="{{ $value->type }}">{{ $value->type }}</option> --}}
                                                    <option value="{{ $value->type }}"
                                                        {{ isset($jobPost) && $jobPost->type == $value->type ? 'selected' : '' }}>
                                                        {{ $value->type }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-2">
                                            <label for="skills">Skills <span class="text-danger">*</span></label>
                                            <select class="form-select" id="skills" name="skills[]" multiple>
                                                @foreach ($jobSkill as $key => $value)
                                                    {{-- <option value="{{ $value->skill }}">{{ $value->skill }}</option> --}}
                                                    <option value="{{ $value->skill }}"
                                                        {{ isset($jobPost) && in_array($value->skill, explode(',', $jobPost->skills)) ? 'selected' : '' }}>
                                                        {{ $value->skill }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-xl-4 mt-2">
                                            <label for="industry">Category <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $jobPost->industry }}"
                                                id="industry" name="industry" readonly>
                                        </div>

                                        <div class="col-xl-4 mt-3" id="department-container">
                                            <label for="department">Department <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $jobPost->department }}"
                                                id="department" name="department" readonly>
                                        </div>

                                        <div class="col-xl-4 mt-3" id="role-container">
                                            <label for="role">Role <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $jobPost->role }}"
                                                id="role" name="role" readonly>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="work_mode">Job Mode <span class="text-danger">*</span></label>
                                            <select class="form-select" id="work_mode" name="work_mode">
                                                <option value="">Select</option>
                                                @foreach ($jobMode as $key => $value)
                                                    {{-- <option value="{{ $value->mode }}">{{ $value->mode }}</option> --}}
                                                    <option value="{{ $value->mode }}"
                                                        {{ isset($jobPost) && $jobPost->mode == $value->mode ? 'selected' : '' }}>
                                                        {{ $value->mode }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="location">Location <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $jobPost->location }}"
                                                id="location" name="location" readonly>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="min_experience">Work Experience (Min - Max) <span
                                                    class="text-danger">*</span></label>
                                            <div class="d-flex gap-2">
                                                <!-- Min Experience Dropdown -->
                                                <select class="form-select" id="min_experience" name="min_experience"
                                                    onchange="updateMaxExperience()">
                                                    {{-- <option value="">Min</option> --}}
                                                    <option value=0>Fresher</option>
                                                    @foreach ($JobExperience as $value)
                                                        {{-- <option value="{{ $value->experience }}">{{ $value->experience }} </option> --}}
                                                        <option value="{{ $value->experience }}"
                                                            {{ isset($jobPost) && $jobPost->min_exp == $value->experience ? 'selected' : '' }}>
                                                            {{ $value->experience }}</option>
                                                    @endforeach
                                                </select>

                                                <!-- Max Experience Dropdown -->
                                                <select class="form-select" id="max_experience" name="max_experience">
                                                    <option value=0>Max</option>
                                                    @foreach ($JobExperience as $value)
                                                        <option value="{{ $value->experience }}"
                                                            {{ isset($jobPost) && $jobPost->max_exp == $value->experience ? 'selected' : '' }}>
                                                            {{ $value->experience }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-xl-4 mt-3">
                                            <label for="currency">Annual Salary (Currency - Min - Max) <span
                                                    class="text-danger">*</span></label>
                                            <div class="d-flex gap-2">
                                                <select class="form-select" id="currency" name="currency">
                                                    <option value="">Currency</option>
                                                    @foreach ($JobCurrency as $value)
                                                        {{-- <option value="{{ $value->currency }}">{{ $value->currency }}
                                                        </option> --}}
                                                        <option value="{{ $value->currency }}"
                                                            {{ isset($jobPost) && $jobPost->currency == $value->currency ? 'selected' : '' }}>
                                                            {{ $value->currency }}</option>
                                                    @endforeach
                                                </select>
                                                <select class="form-select" id="min_salary" name="min_salary"
                                                    onchange="updateMaxSalary()">
                                                    <option value="0">Min Salary</option>
                                                    @foreach ($JobSalary as $value)
                                                        {{-- <option value="{{ $value->salary }}">{{ $value->salary }}
                                                        </option> --}}
                                                        <option value="{{ $value->salary }}"
                                                            {{ isset($jobPost) && $jobPost->min_sal == $value->salary ? 'selected' : '' }}>
                                                            {{ $value->salary }}</option>
                                                    @endforeach
                                                </select>
                                                <select class="form-select" id="max_salary" name="max_salary">
                                                    <option value="0">Max Salary</option>
                                                    @foreach ($JobSalary as $value)
                                                        <option value="{{ $value->salary }}"
                                                            {{ isset($jobPost) && $jobPost->max_sal == $value->salary ? 'selected' : '' }}>
                                                            {{ $value->salary }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                                <input type="checkbox" name="sal_status" id="sal_status"
                                                    {{ isset($jobPost) && $jobPost->sal_status == 'on' ? 'checked' : '' }}>
                                                <label for="sal_status">Do you want to show the Salary to User</label>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 mt-3">
                                            <label for="education_level" class="form-label">Education Level <span
                                                    class="text-danger">*</span></label>
                                            <select name="education_level" class="form-control" id="education_level">
                                                <option value="">Select Education Level</option>
                                                <option value="Matric"
                                                    {{ isset($jobPost) && $jobPost->education_level == 'Matric' ? 'selected' : '' }}>
                                                    Secondary Education</option>
                                                <option value="Higher Secondary"
                                                    {{ isset($jobPost) && $jobPost->education_level == 'Higher Secondary' ? 'selected' : '' }}>
                                                    Higher Secondary Education</option>
                                                <option value="UG"
                                                    {{ isset($jobPost) && $jobPost->education_level == 'UG' ? 'selected' : '' }}>
                                                    Undergraduate (UG)</option>
                                                <option value="PG"
                                                    {{ isset($jobPost) && $jobPost->education_level == 'PG' ? 'selected' : '' }}>
                                                    Postgraduate (PG)</option>
                                                <option value="PhD"
                                                    {{ isset($jobPost) && $jobPost->education_level == 'PhD' ? 'selected' : '' }}>
                                                    Doctorate (PhD)</option>
                                                <option value="PostDoc"
                                                    {{ isset($jobPost) && $jobPost->education_level == 'PostDoc' ? 'selected' : '' }}>
                                                    Postdoctoral Research (After PhD)</option>
                                                <option value="Diploma"
                                                    {{ isset($jobPost) && $jobPost->education_level == 'Diploma' ? 'selected' : '' }}>
                                                    Diploma & Certificate Courses</option>
                                            </select>
                                        </div>

{{-- 
                                        <div class="col-xl-4 mt-3" id="education-container">
                                            <label for="education">Educational Qualification <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="education" name="education">
                                                <option value="">Choose Qualification</option>
                                                @foreach ($JobEducation as $value)
                                                    <option value="{{ $value->education }}"
                                                        {{ isset($jobPost) && $jobPost->education == $value->education ? 'selected' : '' }}>
                                                        {{ $value->education }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                       

                                        <div class="col-xl-4 mt-2" id="branch-container">
                                            <label for="branch">Education Branch</label>
                                            <select class="form-select" id="branch" name="branch[]" multiple>
                                                @foreach ($JobEducation as $value)
                                                    <option value="{{ $value->branch }}"
                                                        {{ isset($jobPost) && !empty($jobPost->branch) && $jobPost->branch  == $value->branch ? 'selected' : ''}}>
                                                        {{ $value->branch }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div> --}}

                                        <div class="col-xl-4 mt-3" id="education-container">
                                            <label for="education">Educational Qualification <span class="text-danger">*</span></label>
                                            <select class="form-select" id="education" name="education">
                                                <option value="">Choose Qualification</option>
                                                @foreach ($JobEducation as $value)
                                                    <option value="{{ $value->education }}"
                                                        {{ isset($jobPost) && $jobPost->education == $value->education ? 'selected' : '' }}>
                                                        {{ $value->education }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="col-xl-4 mt-2" id="branch-container">
                                            <label for="branch">Education Branch</label>
                                            <select class="form-select" id="branch" name="branch[]" multiple>
                                                @foreach ($JobEducation as $value)
                                                    <option value="{{ $value->branch }}" data-education="{{ $value->education }}"
                                                        {{ isset($jobPost) && !empty($jobPost->branch) && $jobPost->branch == $value->branch ? 'selected' : '' }}>
                                                        {{ $value->branch }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        

                                        




                                        <div class="col-xl-4 mt-3">
                                            <label for="candidate_industry">Condidate Industry</label>
                                            <select class="form-select" id="candidate_industry"
                                                name="candidate_industry">
                                                <option value="">Choose Industry</option>
                                                @foreach ($JobCategory as $key => $value)
                                                    <option value="{{ $value->name }}"
                                                        {{ isset($jobPost) && $jobPost->condidate_industry == $value->name ? 'selected' : '' }}>
                                                        {{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-xl-4 col-lg-6 col-md-8 col-sm-12 mt-3">
                                            <label for="diversity" class="d-block">Diversity Hiring (Optional)</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="male"
                                                    {{ isset($jobPost) && $jobPost->diversity == 'Male' ? 'checked' : '' }}
                                                    name="diversity" value="Male">
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox"
                                                    id="female"{{ isset($jobPost) && $jobPost->diversity == 'Female' ? 'checked' : '' }}
                                                    name="diversity" value="Female">
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 mt-3">
                                            <label for="vacancies">Number of Vacancies <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="vacancies"
                                                value="{{ $jobPost->vacancies }}">
                                        </div>


                                        <div class="col-xl-4 col-lg-6 col-md-8 col-sm-12 mt-3">
                                            <label for="interview_type" class="d-block">Interview Type <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="interview_type" name="interview_type">
                                                <option value="">Select</option>
                                                @foreach ($JobIntType as $key => $value)
                                                    {{-- <option value="{{ $value->int_type }}">{{ $value->int_type }}
                                                    </option> --}}
                                                    <option value="{{ $value->int_type }}"
                                                        {{ isset($jobPost) && $jobPost->int_type == $value->int_type ? 'selected' : '' }}>
                                                        {{ $value->int_type }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="row">
                                                <!-- Company Name Selection -->
                                                <div class="col-12 col-md-12 mt-3">
                                                    <label for="company_name">Company Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $jobPost->com_name }}" id="company_name"
                                                        name="company_name" readonly>
                                                </div>


                                                <!-- Company Details -->
                                                <div class="col-12 col-md-12 mt-3">
                                                    <label for="company_details">Company Details <span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control" id="company_details" name="company_details">{{ $jobPost->com_details }}</textarea>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- Image Preview Section -->
                                        <div class="col-xl-6 text-center mt-3">
                                            <label for="job_image">Company Logo <span class="text-danger">*</span></label>
                                            <div class="mt-3">
                                                <img id="imagePreview" src="{{ url('recruiter/logo/default.png') }}"
                                                    onerror="this.onerror=null; this.src='{{ url('recruiter/logo/default.png') }}';"
                                                    alt="Image Preview"
                                                    style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px;">
                                                <input type="hidden" id="company_logo" name="company_logo"
                                                    value="">
                                            </div>
                                        </div>

                                        <div class="col-6 mt-3">
                                            <label for="jobExp">Job Expiry<span class="text-danger">*</span></label>
                                            <input type="Date" class="form-control" id="jobExp" name="jobExp"  value="{{ old('jobExp', $jobPost->jobexpiry ?? '') }}">
                                        </div>


                                        <div class="d-flex justify-content-center mt-3">
                                            <div class="col-xl-12 text-center">
                                                <label for="job_description">Job Description <span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control" id="job_description" name="job_description">{{ $jobPost->job_desc }}</textarea>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mt-3">
                                            <div class="col-xl-12 text-center">
                                                <label for="job_resp">Responsibilities <span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control" id="job_resp" name="job_resp">{{ $jobPost->job_resp }}</textarea>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mt-3">
                                            <div class="col-xl-12 text-center">
                                                <label for="job_req">Requirements <span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control" id="job_req" name="job_req">{{ $jobPost->job_req }}</textarea>
                                            </div>
                                        </div>


                                    </div>


                                    <div class="col-12 mb-3">
                                        <button type="submit" class="btn btn-primary">Post Job</button>
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

        <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
     
        <script>
        ClassicEditor
            .create(document.querySelector('#job_description'))
            .catch(error => {
                console.error(error);
            });

            ClassicEditor
            .create(document.querySelector('#job_resp'))
            .catch(error => {
                console.error(error);
            });

            ClassicEditor
            .create(document.querySelector('#job_req'))
            .catch(error => {
                console.error(error);
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const jobExpInput = document.getElementById("jobExp");
                const today = new Date();
                today.setDate(today.getDate() + 1); // Set to tomorrow
                const minDate = today.toISOString().split('T')[0];
                jobExpInput.setAttribute("min", minDate);
            });
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
                var education_level = document.getElementById('education_level');
                if (education_level) {
                    const education_level1 = new Choices(education_level, {
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
        </script>

        <!-- For Company Details -->
        <script>
            function updateCompanyDetails() {
                var select = document.getElementById("company_name");
                var detailsTextarea = document.getElementById("company_details");

                // Get the selected option
                var selectedOption = select.options[select.selectedIndex];

                // Check if data-details exists and update the textarea
                if (selectedOption) {
                    var details = selectedOption.getAttribute("data-details") || "";
                    detailsTextarea.value = details;

                    // Get and update the logo URL
                    const logoUrl = selectedOption.getAttribute('data-logo');
                    const imgElement = document.getElementById('imagePreview');
                    var hiddenLogoInput = document.getElementById("company_logo");
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

        {{-- For selecting department according to category & Role according to department --}}
        {{-- <script>
            $(document).ready(function() {
                // When category changes, load departments
                $('#industry').change(function() {
                    var category_name = $(this).val();
                    $('#department').html('<option value="">Loading...</option>');
                    $('#role').html('<option value="">Select</option>'); // Reset role dropdown
                    $('#role-container').hide(); // Hide role container initially

                    if (category_name) {
                        $.ajax({
                            url: "{{ route('Recruiter.getDepartment') }}",
                            type: "GET",
                            data: {
                                category_name: category_name
                            },
                            success: function(data) {
                                $('#department').html(
                                    '<option value="">Select Department</option>');
                                if (data.length > 0) {
                                    $.each(data, function(index, item) {
                                        $('#department').append('<option value="' + item
                                            .department + '">' + item.department +
                                            '</option>');
                                    });
                                    $('#department-container').show(); // Show department container
                                } else {
                                    $('#department').html(
                                        '<option value="">No Departments Found</option>');
                                    $('#department-container').hide();
                                }
                            },
                            error: function() {
                                $('#department').html(
                                    '<option value="">Error loading data</option>');
                                $('#department-container').hide();
                            }
                        });
                    } else {
                        $('#department-container').hide();
                        $('#role-container').hide();
                    }
                });

                // When department changes, load roles
                $('#department').change(function() {
                    var department_name = $(this).val();
                    $('#role').html('<option value="">Loading...</option>');

                    if (department_name) {
                        $.ajax({
                            url: "{{ route('Recruiter.getRole') }}",
                            type: "GET",
                            data: {
                                department_name: department_name
                            },
                            success: function(data) {
                                $('#role').html('<option value="">Select Role</option>');
                                if (data.length > 0) {
                                    $.each(data, function(index, item) {
                                        $('#role').append('<option value="' + item.role +
                                            '">' + item.role + '</option>');
                                    });
                                    $('#role-container').show(); // Show role container
                                } else {
                                    $('#role').html('<option value="">No Roles Found</option>');
                                    $('#role-container').hide();
                                }
                            },
                            error: function() {
                                $('#role').html('<option value="">Error loading data</option>');
                                $('#role-container').hide();
                            }
                        });
                    } else {
                        $('#role-container').hide();
                    }
                });
            });
        </script> --}}

        {{-- For selecting education according to education_level --}}
        <script>
            $(document).ready(function() {
                // When education level changes, load qualifications
                $('#education_level').change(function() {
                    var education_level = $(this).val();
                    $('#education').html('<option value="">Loading...</option>'); // Show loading text
                    $('#branch').html('<option value="">Choose Branch</option>'); // Reset branch dropdown
                    $('#branch-container').hide(); // Hide branch container initially

                    if (education_level) {
                        $.ajax({
                            url: "{{ route('Recruiter.getEducation') }}",
                            type: "GET",
                            data: {
                                education_level: education_level
                            },
                            success: function(data) {
                                // console.log("Education Data:", data); // Debugging
                                $('#education').html(
                                    '<option value="">Choose Qualification</option>');

                                if (data.length > 0) {
                                    $.each(data, function(index, item) {
                                        $('#education').append('<option value="' + item
                                            .education + '">' + item.education +
                                            '</option>');
                                    });
                                    $('#education-container').show(); // Show education container
                                } else {
                                    $('#education').html(
                                        '<option value="">No Qualifications Found</option>');
                                    $('#education-container').hide();
                                }
                            },
                            error: function() {
                                $('#education').html(
                                    '<option value="">Error loading data</option>');
                                $('#education-container').hide();
                            }
                        });
                    } else {
                        $('#education-container').hide();
                        $('#branch-container').hide();
                    }
                });

            });
        </script>

        {{-- For selecting branch according to education --}}
        {{-- <script>
            $(document).ready(function() {
                var branchSelect = document.getElementById('branch');
                var branchChoices;
        
                function hideBranchContainerIfEmpty() {
                    const hasOptions = $('#branch option').length > 0;
                    if (!hasOptions) {
                        $('#branch-container').hide();
                        if (branchChoices) branchChoices.destroy(); // cleanup
                        $('#branch').empty(); // remove any leftover
                    } else {
                        $('#branch-container').show();
                    }
                }
        
                // Initialize Choices.js only if options exist
                if ($('#branch option').length > 0) {
                    branchChoices = new Choices(branchSelect, {
                        shouldSort: false,
                        position: 'down',
                        removeItemButton: true,
                    });
                } else {
                    $('#branch-container').hide();
                }
        
                $('#education').change(function() {
                    var education = $(this).val();
                    $('#branch').html('<option value="">Loading...</option>');
        
                    if (education) {
                        $.ajax({
                            url: "{{ route('Recruiter.getBranch') }}",
                            type: "GET",
                            data: { education: education },
                            success: function(data) {
                                $('#branch').empty();
        
                                if (data.length > 0) {
                                    $.each(data, function(index, item) {
                                        $('#branch').append('<option value="' + item.branch + '">' + item.branch + '</option>');
                                    });
                                    $('#branch-container').show();
                                } else {
                                    $('#branch-container').hide();
                                }
        
                                // Reset Choices.js
                                if (branchChoices) branchChoices.destroy();
                                if (data.length > 0) {
                                    branchChoices = new Choices(branchSelect, {
                                        shouldSort: false,
                                        position: 'down',
                                        removeItemButton: true,
                                    });
                                }
                            },
                            error: function() {
                                $('#branch').empty();
                                $('#branch-container').hide();
                                if (branchChoices) branchChoices.destroy();
                            }
                        });
                    } else {
                        $('#branch').empty();
                        $('#branch-container').hide();
                        if (branchChoices) branchChoices.destroy();
                    }
                });
        
                // On page load, hide if empty
                hideBranchContainerIfEmpty();
            });
        </script> --}}
        
        {{-- For selecting branch according to education --}}
        <script>
            $(document).ready(function() {
                var branchSelect = document.getElementById('branch');
                var branchChoices;

                // Initialize Choices.js if #branch exists
                if (branchSelect) {
                    branchChoices = new Choices(branchSelect, {
                        shouldSort: false,
                        position: 'down',
                        removeItemButton: true,
                    });
                }

                // Populate branch dropdown with existing JobEducation options
                var jobEducationOptions = ` @foreach ($JobEducation as $value)
                                                    <option value="{{ $value->branch }}"
                                                        {{ isset($jobPost) && !empty($jobPost->branch) && $jobPost->branch  == $value->branch ? 'selected' : ''}}>
                                                        {{ $value->branch }}
                                                    </option>
                                                @endforeach`;
                $('#branch').append(jobEducationOptions);

                // Handle education change event
                $('#education').change(function() {
                    var education = $(this).val();
                    $('#branch').html('<option value="">Loading...</option>');

                    if (education) {
                        $.ajax({
                            url: "{{ route('Recruiter.getBranch') }}",
                            type: "GET",
                            data: {
                                education: education
                            },
                            success: function(data) {
                                $('#branch').empty(); // Clear previous options

                                if (data.length > 0) {
                                    $('#branch').append('<option value="">Choose Branch</option>');
                                    $.each(data, function(index, item) {
                                        $('#branch').append('<option value="' + item
                                            .branch + '">' + item.branch + '</option>');
                                    });
                                    $('#branch-container').show();
                                } else {
                                    $('#branch').append(
                                        '<option value="">No Branches Found</option>');
                                    $('#branch-container').hide();
                                }

                                // Destroy and Reinitialize Choices.js
                                if (branchChoices) {
                                    branchChoices.destroy();
                                }
                                branchChoices = new Choices(branchSelect, {
                                    shouldSort: false,
                                    position: 'down',
                                    removeItemButton: true,
                                });
                            },
                            error: function() {
                                $('#branch').html('<option value="">Error loading data</option>');
                                $('#branch-container').hide();
                            }
                        });
                    } else {
                        $('#branch-container').hide();
                    }
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const educationSelect = document.getElementById('education');
                const branchSelect = document.getElementById('branch');
                const allBranchOptions = Array.from(branchSelect.options);

                function filterBranches() {
                    const selectedEducation = educationSelect.value;

                    // Clear all current options
                    branchSelect.innerHTML = '';

                    // Filter and add relevant options
                    const filtered = allBranchOptions.filter(option => option.dataset.education === selectedEducation);

                    if (filtered.length > 0) {
                        filtered.forEach(option => branchSelect.appendChild(option));
                        branchSelect.closest('#branch-container').style.display = 'block';
                    } else {
                        branchSelect.closest('#branch-container').style.display = 'none';
                    }
                }

                // Run on change
                educationSelect.addEventListener('change', filterBranches);

                // Run on page load if editing
                filterBranches();
            });
        </script>




        {{-- UpdateJobPost --}}
        <script>
            $(document).ready(function() {
                $('#UpdateJobPost').on('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    var url = "{{ route('Recruiter.UpdateJobPost') }}"; // Submission URL
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
                                // $('#myTable').DataTable().ajax.reload(null, false);  

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
                            // console.error('AJAX Error:', error);
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
