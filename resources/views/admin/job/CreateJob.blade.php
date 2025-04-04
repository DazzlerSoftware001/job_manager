@extends('admin.adminlayout.main')
@section('title')
    Admin-Create Job
@endsection
@section('page-title')
Create Job
@endsection
@section('main-container')

  

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Create Job</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="javascript:void(0)" id="AddJobPost">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-xl-12">
                                            <label for="job_title">Job Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="job_title" name="job_title"
                                                placeholder="Enter job title">
                                        </div>


                                        <div class="col-xl-4 mt-2">
                                            <label for="job_type">Job Type <span class="text-danger">*</span></label>
                                            <select class="form-select" id="job_type" name="job_type">
                                                <option value="">Select</option>
                                            
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-2">
                                            <label for="skills">Skills <span class="text-danger">*</span></label>
                                            <select class="form-select" id="skills" name="skills[]" multiple>
                                            
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-2">
                                            <label for="industry">Category <span class="text-danger">*</span></label>
                                            <select class="form-select" id="industry" name="industry">
                                                <option value="">Choose Industry</option>
                                            
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3" id="department-container" style="display: none;">
                                            <label for="department">Department <span class="text-danger">*</span></label>
                                            <select class="form-select" id="department" name="department">
                                                <option value="">Select</option>
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3" id="role-container" style="display: none;">
                                            <label for="role">Role <span class="text-danger">*</span></label>
                                            <select class="form-select" id="role" name="role">
                                                <option value="">Select</option>
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="work_mode">Job Mode <span class="text-danger">*</span></label>
                                            <select class="form-select" id="work_mode" name="work_mode">
                                                <option value="">Select</option>
                                                
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="location">Location <span class="text-danger">*</span></label>
                                            <select class="form-select" id="location" name="location">
                                                <option value="">Select</option>
                                            
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="min_experience">Work Experience (Min - Max) <span
                                                    class="text-danger">*</span></label>
                                            <div class="d-flex gap-2">
                                                <!-- Min Experience Dropdown -->
                                                <select class="form-select" id="min_experience" name="min_experience"
                                                    onchange="updateMaxExperience()">
                                                    <option value="">Min</option>
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
                                            <label for="currency">Annual Salary (Currency - Min - Max) <span
                                                    class="text-danger">*</span></label>
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
                                            <div class="mt-3">
                                                <input type="checkbox" name="sal_status" id="sal_status" checked>
                                                <label for="">Do you want to show the Salary to User</label>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 mt-3">
                                            <label for="education_level" class="form-label">Education Level <span class="text-danger">*</span></label>
                                            <select name="education_level" class="form-control" id="education_level">
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
                                        
                                        <div class="col-xl-4 mt-3" id="education-container" style="display: none;">
                                            <label for="education">Educational Qualification <span class="text-danger">*</span></label>
                                            <select class="form-select" id="education" name="education">
                                                <option value="">Choose Qualification</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-xl-4 mt-3" id="branch-container" style="display: none;">
                                            <label for="branch">Education Branch<span class="text-danger">*</span></label>
                                            <select class="form-select" id="branch" name="branch">
                                                <option value="">Choose Branch</option>
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
                                            <label for="vacancies">Number of Vacancies <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="vacancies">
                                        </div>


                                        <div class="col-xl-4 col-lg-6 col-md-8 col-sm-12 mt-3">
                                            <label for="interview_type" class="d-block">Interview Type <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="interview_type" name="interview_type">
                                                <option value="">Select</option>
                                                
                                            </select>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="row">
                                                <!-- Company Name Selection -->
                                                <div class="col-12 col-md-12 mt-3">
                                                    <label for="company_name">Company Name <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" id="company_name" name="company_name"
                                                        onchange="updateCompanyDetails()">
                                                        <option value="">Select</option>
                                                        
                                                    </select>
                                                </div>

                                                <!-- Company Details -->
                                                <div class="col-12 col-md-12 mt-3">
                                                    <label for="company_details">Company Details <span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control" id="company_details" name="company_details" readonly></textarea>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- Image Preview Section -->
                                        <div class="col-xl-6 text-center mt-3">
                                            <label for="job_image">Job Image <span class="text-danger">*</span></label>
                                            <div class="mt-3">
                                                <img id="imagePreview" src="" alt="Image Preview"
                                                    style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
                                                <input type="hidden" id="company_logo" name="company_logo"
                                                    value="">
                                            </div>
                                        </div>



                                        <div class="d-flex justify-content-center mt-3">
                                            <div class="col-xl-12 text-center">
                                                <label for="job_description">Job Description <span
                                                        class="text-danger">*</span></label>
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

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('script')
<script src="https://cdn.tiny.cloud/1/k73iszd3tzdamw58yk6fmdzasoe86nkkbzktvgqtvxvcrr17/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    $(document).ready(function () {
        tinymce.init({
            selector: '#job_description',
            height: 300,
            menubar: false,
            plugins: 'lists link image table code',
            toolbar: 'undo redo | bold italic underline | bullist numlist | link image | code'
        });
    });
</script>
@endsection
