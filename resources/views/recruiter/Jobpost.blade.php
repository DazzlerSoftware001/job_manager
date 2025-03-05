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
                                <form action="">
                                    <div class="row mb-3">
                                        <div class="col-xl-4">
                                            <label for="job_title">Job Title</label>
                                            <input type="text" class="form-control" id="job_title"
                                                placeholder="Enter job title">
                                        </div>


                                        <div class="col-xl-4">
                                            <label for="job_type">Job Type</label>
                                            <select class="form-select" id="job_type">
                                                <option>Select</option>
                                                <option>Full Time</option>
                                                <option>Part Time</option>
                                                <option>Contract</option>
                                                <option>Internship</option>
                                                <option>Freelance</option>
                                            </select>
                                        </div>


                                        <div class="col-xl-4">
                                            <label for="work_mode">Work Mode</label>
                                            <select class="form-select" id="work_mode">
                                                <option value="">Select</option>
                                                @foreach($jobTypes as $key => $value)
                                                <option value="{{ $value->type }}">{{ $value->type }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="job_description">Job Description</label>
                                            <textarea class="form-control" name="job_description"></textarea>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="skills">Skills</label>
                                            <select class="form-select" id="skills">
                                                <option>Select</option>
                                                <option>Part Time</option>
                                                <option>Contract</option>
                                                <option>Internship</option>
                                                <option>Freelance</option>
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="min_experience">Work Experience (Min - Max)</label>
                                            <div class="d-flex gap-2">
                                                <select class="form-select" id="min_experience">
                                                    <option value="">Min</option>
                                                    <?php for ($i = 0; $i <= 50; $i++) { ?>
                                                        <option value="<?= $i; ?>"><?= $i; ?> Years</option>
                                                    <?php } ?>
                                                </select>
                                                <select class="form-select" id="max_experience">
                                                    <option value="">Max</option>
                                                    <?php for ($i = 0; $i <= 50; $i++) { ?>
                                                        <option value="<?= $i; ?>"><?= $i; ?> Years</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-4 mt-3">
                                            <label for="currency">Annual Salary (Currency - Min - Max)</label>
                                            <div class="d-flex gap-2">
                                                <select class="form-select" id="currency">
                                                    <option value="">Currency</option>
                                                    <option value="INR">INR (₹)</option>
                                                    <option value="USD">USD ($)</option>
                                                    <option value="EUR">EUR (€)</option>
                                                    <option value="GBP">GBP (£)</option>
                                                    <option value="AUD">AUD (A$)</option>
                                                    <option value="CAD">CAD (C$)</option>
                                                    <option value="JPY">JPY (¥)</option>
                                                </select>
                                                <select class="form-select" id="min_salary">
                                                    <option value="">Min Salary</option>
                                                    <?php for ($i = 10000; $i <= 1000000; $i += 10000) { ?>
                                                        <option value="<?= $i; ?>"><?= number_format($i); ?></option>
                                                    <?php } ?>
                                                </select>
                                                <select class="form-select" id="max_salary">
                                                    <option value="">Max Salary</option>
                                                    <?php for ($i = 10000; $i <= 1000000; $i += 10000) { ?>
                                                        <option value="<?= $i; ?>"><?= number_format($i); ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        

                                        <div class="col-xl-4 mt-3">
                                            <label for="location">Location</label>
                                            <select class="form-select" id="location">
                                                <option>Select</option>
                                                <option>Part Time</option>
                                                <option>Contract</option>
                                                <option>Internship</option>
                                                <option>Freelance</option>
                                            </select>
                                        </div>



                                        <div class="col-xl-4 mt-3">
                                            <label for="industry">Industry</label>
                                            <select class="form-select" id="industry">
                                                <option>Select</option>
                                                <option>Part Time</option>
                                                <option>Contract</option>
                                                <option>Internship</option>
                                                <option>Freelance</option>
                                            </select>
                                        </div>
                                        

                                        <div class="col-xl-4 mt-3">
                                            <label for="preferred_industry">Preferred Industry</label>
                                            <select class="form-select" id="preferred_industry">
                                                <option>Select</option>
                                                <option>Part Time</option>
                                                <option>Contract</option>
                                                <option>Internship</option>
                                                <option>Freelance</option>
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="department">Department</label>
                                            <select class="form-select" id="department">
                                                <option>Select</option>
                                                <option>Part Time</option>
                                                <option>Contract</option>
                                                <option>Internship</option>
                                                <option>Freelance</option>
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="department">Role</label>
                                            <select class="form-select" id="department">
                                                <option>Select</option>
                                                <option>Part Time</option>
                                                <option>Contract</option>
                                                <option>Internship</option>
                                                <option>Freelance</option>
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="reference_code">Reference</label>
                                            <input type="text" class="form-control" name="reference_code">
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="vacancies">Number of Vacancies</label>
                                            <input type="text" class="form-control" name="vacancies">
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="department">Educational Qualification</label>
                                            <select class="form-select" id="department">
                                                <option>Select</option>
                                                <option>Part Time</option>
                                                <option>Contract</option>
                                                <option>Internship</option>
                                                <option>Freelance</option>
                                            </select>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="questions">Ask questions to candidatesthey should respond to when they are applying</label>
                                            <input type="text" class="form-control" placeholder="How many experience do you have in non it recruitment?">
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="company_name">Company Name</label>
                                            <input type="text" class="form-control" placeholder="Dazzler" name="company_name">
                                            <a href="">Add Website Name</a>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="company_details">Company Details</label>
                                            <textarea class="form-control" name="company_details"></textarea>
                                        </div>


                                        <div class="col-xl-4 mt-3">
                                            <label for="recruiter_details">Recruiter Details</label>
                                            <input type="text" class="form-control" name="recruiter_details">
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
{{-- 
    <script type="text/javascript">
        var element1 = document.getElementById('work_mode')
        const choices1 = new Choices(element1, {

            shouldSort: false,
            position: 'down',
            resetScrollPosition: true,

        })
    </script> --}}

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
    </script>
    

@endsection
