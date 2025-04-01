@extends('recruiter.recruiterlayout.main')
@section('title')
    Recruiter-Edit Job
@endsection
@section('page-title')
    Edit Job
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
                                <h4 class="card-title">Edit Job</h4>
                            </div>

                            <div class="px-3 mt-3 d-flex align-items-center gap-2">
                                <button class="btn btn-primary btn-sm" onclick="window.location.href='{{ route('Recruiter.jobpost') }}'">
                                    + Create Job
                                </button>
                                    
                            </div>

                            <div class="card-body">
                                <form method="POST" action="javascript:void(0)" id="AddJobPost">
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
                                               
                                            </select>
                                        </div>


                                        <div class="col-xl-4">
                                            <label for="skills">Skills</label>
                                            <select class="form-select" id="skills" name="skills[]" multiple>
                                                
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="industry">Category</label>
                                            <select class="form-select" id="industry" name="industry">
                                                <option value="">Choose Industry</option>
                                              
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
                                               
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="location">Location</label>
                                            <select class="form-select" id="location" name="location">
                                                <option value="">Select</option>
                                                
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="min_experience">Work Experience (Min - Max)</label>
                                            <div class="d-flex gap-2">
                                                <!-- Min Experience Dropdown -->
                                                <select class="form-select" id="min_experience" name="min_experience"
                                                    onchange="updateMaxExperience()">
                                                    <option value=0>Fresher</option>
                                                   
                                                </select>

                                                <!-- Max Experience Dropdown -->
                                                <select class="form-select" id="max_experience" name="max_experience"
                                                    disabled>
                                                    <option value=0>Max</option>
                                                    
                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-xl-4 mt-3">
                                            <label for="currency">Annual Salary (Currency - Min - Max)</label>
                                            <div class="d-flex gap-2">
                                                <select class="form-select" id="currency" name="currency">
                                                    <option value="">Currency</option>
                                                  
                                                </select>
                                                <select class="form-select" id="min_salary" name="min_salary"
                                                    onchange="updateMaxSalary()">
                                                    <option value="0">Min Salary</option>
                                                    
                                                </select>
                                                <select class="form-select" id="max_salary" name="max_salary" disabled>
                                                    <option value="0">Max Salary</option>
                                                    
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="education">Educational Qualification</label>
                                            <select class="form-select" id="education" name="education">
                                                <option value="">Choose Qualification</option>
                                                
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="candidate_industry">Condidate Industry</label>
                                            <select class="form-select" id="candidate_industry"
                                                name="candidate_industry">
                                                <option value="">Choose Industry</option>
                                               
                                            </select>
                                        </div>


                                        <div class="col-xl-4 col-lg-6 col-md-8 col-sm-12 mt-3">
                                            <label for="diversity" class="d-block">Diversity Hiring (Optional)</label>
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
                                            <label for="vacancies">Number of Vacancies</label>
                                            <input type="number" class="form-control" name="vacancies">
                                        </div>


                                        <div class="col-xl-4 col-lg-6 col-md-8 col-sm-12 mt-3">
                                            <label for="interview_type" class="d-block">Interview Type</label>
                                            <select class="form-select" id="interview_type" name="interview_type">
                                                <option value="">Select</option>
                                               
                                            </select>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="row">
                                                <!-- Company Name Selection -->
                                                <div class="col-12 col-md-12 mt-3">
                                                    <label for="company_name">Company Name</label>
                                                    <select class="form-select" id="company_name" name="company_name"
                                                        onchange="updateCompanyDetails()">
                                                        <option value="">Select</option>
                                                       
                                                    </select>
                                                </div>

                                                <!-- Company Details -->
                                                <div class="col-12 col-md-12 mt-3">
                                                    <label for="company_details">Company Details</label>
                                                    <textarea class="form-control" id="company_details" name="company_details" readonly></textarea>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- Image Preview Section -->
                                        <div class="col-xl-6 text-center mt-3">
                                            <label for="job_image">Job Image</label>
                                            <div class="mt-3">
                                                <img id="imagePreview" src=""
                                                    alt="Image Preview"
                                                    style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
                                                    <input type="hidden" id="company_logo" name="company_logo" value="">
                                            </div>
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
                                </form>
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
