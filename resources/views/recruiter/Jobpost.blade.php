@extends('recruiter.recruiterlayout.main')
@section('title')
    Recruiter-JobPost
@endsection
@section('page-title')
    Job Post
@endsection
@section('main-container')
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
                                                <option>Select</option>
                                                <option>Part Time</option>
                                                <option>Contract</option>
                                                <option>Internship</option>
                                                <option>Freelance</option>
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

                        {{-- <div class="row">
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <h5 class="card-title mb-3">User Activity</h5>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle text-muted" href="#"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        Weekly<i class="mdi mdi-chevron-down ms-1"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Yearly</a>
                                                        <a class="dropdown-item" href="#">Monthly</a>
                                                        <a class="dropdown-item" href="#">Weekly</a>
                                                        <a class="dropdown-item" href="#">Today</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <p class="text-muted mb-1">This Month</p>
                                            <h4>16,543</h4>
                                        </div>

                                        <div class="m-n3">
                                            <div id="chart-area" data-colors='["#3b76e1", "#f56e6e"]' class="apex-charts"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                            <div class="col-xl-4 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <h5 class="card-title mb-3">Order Stats</h5>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle text-muted" href="#"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i data-eva="more-horizontal-outline" class="fill-muted"
                                                            data-eva-height="18" data-eva-width="18"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Yearly</a>
                                                        <a class="dropdown-item" href="#">Monthly</a>
                                                        <a class="dropdown-item" href="#">Weekly</a>
                                                        <a class="dropdown-item" href="#">Today</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="chart-donut" data-colors='["#3b76e1", "#f1f3f7", "#f56e6e"]' class="mt-2"></div>

                                        <div class="text-center mt-4 border-top">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="pt-3">
                                                        <p class="text-muted text-truncate mb-2">Completed</p>
                                                        <h5 class="font-size-16 mb-0">70</h5>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="pt-3">
                                                        <p class="text-muted text-truncate mb-2">Pending</p>
                                                        <h5 class="font-size-16 mb-0">25</h5>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="pt-3">
                                                        <p class="text-muted text-truncate mb-2">Cancel</p>
                                                        <h5 class="font-size-16 mb-0">19</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                            <div class="col-xl-4 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <h5 class="card-title mb-3">Top Product</h5>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle text-muted" href="#"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        Monthly<i class="mdi mdi-chevron-down ms-1"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Yearly</a>
                                                        <a class="dropdown-item" href="#">Monthly</a>
                                                        <a class="dropdown-item" href="#">Weekly</a>
                                                        <a class="dropdown-item" href="#">Today</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mx-n4" data-simplebar style="max-height: 296px;">
                                            <ul class="list-unstyled mb-0">
                                                <li class="py-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm">
                                                                <div
                                                                    class="avatar-title bg-primary bg-gradient rounded">
                                                                    #1
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <p class="text-muted mb-1 text-truncate">Polo blue T-shirt
                                                            </p>
                                                            <div class="fw-semibold font-size-15">$ 25.4</div>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center">
                                                                3.82k</h5>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="py-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm">
                                                                <div
                                                                    class="avatar-title bg-primary bg-gradient rounded">
                                                                    #2
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <p class="text-muted mb-1 text-truncate">Hoodie for men</p>
                                                            <div class="fw-semibold font-size-15">$ 24.5</div>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center">
                                                                3.14k</h5>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="py-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm">
                                                                <div
                                                                    class="avatar-title bg-primary bg-gradient rounded">
                                                                    #3
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <p class="text-muted mb-1 text-truncate">Red color Cap</p>
                                                            <div class="fw-semibold font-size-15">$ 22.5</div>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center">
                                                                2.84k</h5>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="py-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm">
                                                                <div
                                                                    class="avatar-title bg-primary bg-gradient rounded">
                                                                    #4
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <p class="text-muted mb-1 text-truncate">Pocket T-shirt</p>
                                                            <div class="fw-semibold font-size-15">$ 21.5</div>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center">
                                                                2.06k</h5>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div> --}}
                        <!-- end row -->
                    </div>
                    <!-- end col -->
                    {{-- <div class="col-xxl-3">

                        <div class="user-sidebar">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="user-profile-img">
                                        <img src="assets/images/pattern-bg.jpg"
                                            class="profile-img profile-foreground-img rounded-top" style="height: 120px;"
                                            alt="">
                                        <div class="overlay-content rounded-top">
                                            <div>
                                                <div class="user-nav p-3">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="dropdown">
                                                            <a class="dropdown-toggle" href="#" role="button"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i data-eva="more-horizontal-outline" data-eva-width="20" data-eva-height="20"
                                                                    class="fill-white"></i>
                                                            </a>
    
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="#">Action</a></li>
                                                                <li><a class="dropdown-item" href="#">Another action</a>
                                                                </li>
                                                                <li><a class="dropdown-item" href="#">Something else
                                                                        here</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end user-profile-img -->
    
                                    <div class="mt-n5 position-relative">
                                        <div class="text-center">
                                            <img src="assets/images/users/avatar-1.jpg" alt=""
                                                class="avatar-xl rounded-circle img-thumbnail">
    
                                            <div class="mt-3">
                                                <h5 class="mb-1">Jennifer Bennett</h5>
                                                <p class="text-muted">Product Designer</p>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="p-3">
                                        <div class="row text-center pb-3">
                                            <div class="col-6 border-end">
                                                <div class="p-1">
                                                    <h5 class="mb-1">1,269</h5>
                                                    <p class="text-muted mb-0">Products</p>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="p-1">
                                                    <h5 class="mb-1">5.2k</h5>
                                                    <p class="text-muted mb-0">Followers</p>
                                                </div>
                                            </div>
                                        </div>
    
                                        <hr class="mb-4">
    
                                        
                                        <div class="mb-4">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <h5 class="card-title mb-3">Earning</h5>
                                                </div>
                                                <div>
                                                    <button class="btn btn-link py-0 shadow-none"  data-bs-toggle="tooltip" data-bs-placement="left" data-bs-trigger="hover" title="Info">
                                                        <i data-eva="info-outline" class="fill-muted" data-eva-height="20" data-eva-width="20"></i>
                                                    </button>
                                                </div>
                                            </div>
    
                                            <div id="chart-radialBar" class="apex-charts" data-colors='["#3b76e1"]'></div>
    
                                            <div class="text-center mt-4">
                                                <h4>$26,256</h4>
                                                <p class="text-muted">Earning this Month</p>
                                                <div
                                                    class="d-flex align-items-start justify-content-center gap-2">
                                                    <div class="badge rounded-pill font-size-13 bg-success-subtle text-success ">+ 2.65%
                                                    </div>
                                                    <div class="text-muted text-start text-truncate">From previous period</div>
                                                </div>
                                            </div>
                                        </div>
    
                                        <hr class="mb-4">
                                        <div class="px-4 mx-n3" data-simplebar style="height: 258px;">
    
                                            <div>
                                                <h5 class="card-title mb-3">Recent Activity</h5>
    
                                                <ul class="list-unstyled mb-0">
                                                    <li class="py-2">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar-md h-auto p-1 py-2 bg-light rounded">
                                                                    <div class="text-center">
                                                                        <h5 class="mb-0">12</h5>
                                                                        <div>Sep</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 pt-2 text-muted">
                                                                <p class="mb-0">Responded to need “Volunteer Activities"</p>
                                                            </div>
                                                        </div>
                                                    </li>
    
                                                    <li class="py-2">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar-md h-auto p-1 py-2 bg-light rounded">
                                                                    <div class="text-center">
                                                                        <h5 class="mb-0">11</h5>
                                                                        <div>Sep</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 pt-2 text-muted">
                                                                <p class="mb-0">Everyone realizes would be desirable... <a href="javascript: void(0);">Read more</a></p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="py-2">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar-md h-auto p-1 py-2 bg-light rounded">
                                                                    <div class="text-center">
                                                                        <h5 class="mb-0">10</h5>
                                                                        <div>Sep</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 pt-2 text-muted">
                                                                <p class="mb-0">
                                                                    Joined the group “Boardsmanship Forum”</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="pt-2">
                                                        <a href="#" class="btn btn-link w-100 shadow-none"><i class="mdi mdi-loading mdi-spin me-2"></i> Load More</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                    </div> --}}
                    <!-- end col -->
                </div>
                <!-- end row -->

                {{-- <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-3">Ratings & Reviews</h5>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle text-muted" href="#"
                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i data-eva="more-horizontal-outline" class="fill-muted"
                                                    data-eva-height="18" data-eva-width="18"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Yearly</a>
                                                <a class="dropdown-item" href="#">Monthly</a>
                                                <a class="dropdown-item" href="#">Weekly</a>
                                                <a class="dropdown-item" href="#">Today</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gy-4 gx-0">
                                    <div class="col-lg-6">
                                        <div>
                                            <div class="text-center">
                                                <h1>4.3</h1>
                                                <div class="font-size-16 mb-1">
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star text-warning"></i>
                                                    <i class="mdi mdi-star-half-full text-warning"></i>
                                                </div>
                                                <div class="text-muted">(14,254 Based)</div>
                                            </div>

                                            <div class="mt-4">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <div class="p-1 py-2">
                                                            <h5 class="font-size-16 mb-0">5 <i
                                                                    class="mdi mdi-star"></i></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="p-1 py-2">
                                                            <div
                                                                class="progress animated-progess custom-progress">
                                                                <div class="progress-bar bg-gradient bg-primary"
                                                                    role="progressbar" style="width: 90%"
                                                                    aria-valuenow="90" aria-valuemin="0"
                                                                    aria-valuemax="90">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="p-1 py-2">
                                                            <h5 class="font-size-16 mb-0">50%</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end row -->

                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <div class="p-1 py-2">
                                                            <h5 class="font-size-16 mb-0">4 <i
                                                                    class="mdi mdi-star"></i></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="p-1 py-2">
                                                            <div
                                                                class="progress animated-progess custom-progress">
                                                                <div class="progress-bar bg-gradient bg-primary"
                                                                    role="progressbar" style="width: 75%"
                                                                    aria-valuenow="75" aria-valuemin="0"
                                                                    aria-valuemax="75">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="p-1 py-2">
                                                            <h5 class="font-size-16 mb-0">20%</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end row -->

                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <div class="p-1 py-2">
                                                            <h5 class="font-size-16 mb-0">3 <i
                                                                    class="mdi mdi-star"></i></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="p-1 py-2">
                                                            <div
                                                                class="progress animated-progess custom-progress">
                                                                <div class="progress-bar bg-gradient bg-primary"
                                                                    role="progressbar" style="width: 60%"
                                                                    aria-valuenow="60" aria-valuemin="0"
                                                                    aria-valuemax="60">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="p-1 py-2">
                                                            <h5 class="font-size-16 mb-0">15%</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end row -->

                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <div class="p-1 py-2">
                                                            <h5 class="font-size-16 mb-0">2 <i
                                                                    class="mdi mdi-star"></i></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="p-1 py-2">
                                                            <div
                                                                class="progress animated-progess custom-progress">
                                                                <div class="progress-bar bg-gradient bg-warning"
                                                                    role="progressbar" style="width: 50%"
                                                                    aria-valuenow="50" aria-valuemin="0"
                                                                    aria-valuemax="50">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="p-1 py-2">
                                                            <h5 class="font-size-16 mb-0">10%</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end row -->

                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <div class="p-1 py-2">
                                                            <h5 class="font-size-16 mb-0">1 <i
                                                                    class="mdi mdi-star"></i></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="p-1 py-2">
                                                            <div
                                                                class="progress animated-progess custom-progress">
                                                                <div class="progress-bar bg-gradient bg-danger"
                                                                    role="progressbar" style="width: 20%"
                                                                    aria-valuenow="20" aria-valuemin="0"
                                                                    aria-valuemax="20">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="p-1 py-2">
                                                            <h5 class="font-size-16 mb-0">5%</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end row -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-lg-6">
                                        <div class="ps-lg-4">
                                            <div class="d-flex flex-wrap align-items-start gap-3">
                                                <h5 class="font-size-15">Reviews: </h5>
                                                <p class="text-muted">(14,254 Based)</p>
                                            </div>

                                            <div class=" me-lg-n3 pe-lg-3" data-simplebar style="max-height: 266px;">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <div>
                                                            <div class="d-flex align-items-start">
                                                                <div class="flex-grow-1">
                                                                    <div class="badge bg-success bg-gradient mb-2"><i class="mdi mdi-star"></i> 4.1</div>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <p class="text-muted font-size-13">12 Jul, 21</p>
                                                                </div>
                                                            </div>
                                                            
                                                            <p class="text-muted mb-4">It will be as simple as in fact, It will seem like simplified</p>
                                                            <div class="d-flex align-items-start">
                                                                <div class="flex-grow-1">
                                                                    <h5 class="font-size-14 mb-0">Samuel</h5>
                                                                </div>
            
                                                                <div class="flex-shrink-0">
                                                                    <div class="hstack gap-3">
                                                                        <div data-bs-toggle="tooltip" data-bs-placement="top" title="Like">
                                                                            <a href="#" class="text-muted"><i class="mdi mdi-thumb-up-outline"></i></a>
                                                                        </div>
                                                                        <div class="vr"></div>
                                                                        <div data-bs-toggle="tooltip" data-bs-placement="top" title="Comment">
                                                                            <a href="#" class="text-muted"><i class="mdi mdi-comment-text-outline"></i></a>
                                                                        </div>
                                                                        <div class="vr"></div>
                                                                        <div class="dropdown">
                                                                            <a class="text-muted dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i class="mdi mdi-dots-horizontal"></i>
                                                                            </a>
                                                                        
                                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                            <a class="dropdown-item" href="#">Action</a>
                                                                            <a class="dropdown-item" href="#">Another action</a>
                                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div>
                                                            <div class="d-flex align-items-start">
                                                                <div class="flex-grow-1">
                                                                    <div class="badge bg-success bg-gradient mb-2"><i class="mdi mdi-star"></i> 4.0</div>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <p class="text-muted font-size-13">06 Jul, 21</p>
                                                                </div>
                                                            </div>
                                                            <p class="text-muted mb-4">Sed ut perspiciatis iste error sit</p>
                                                            <div class="d-flex align-items-start">
                                                                <div class="flex-grow-1">
                                                                    <h5 class="font-size-14 mb-0">Joseph</h5>
                                                                </div>
            
                                                                <div class="flex-shrink-0">
                                                                    <div class="hstack gap-3">
                                                                        <div data-bs-toggle="tooltip" data-bs-placement="top" title="Like">
                                                                            <a href="#" class="text-muted"><i class="mdi mdi-thumb-up-outline"></i></a>
                                                                        </div>
                                                                        <div class="vr"></div>
                                                                        <div data-bs-toggle="tooltip" data-bs-placement="top" title="Comment">
                                                                            <a href="#" class="text-muted"><i class="mdi mdi-comment-text-outline"></i></a>
                                                                        </div>
                                                                        <div class="vr"></div>
                                                                        <div class="dropdown">
                                                                            <a class="text-muted dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i class="mdi mdi-dots-horizontal"></i>
                                                                            </a>
                                                                        
                                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                            <a class="dropdown-item" href="#">Action</a>
                                                                            <a class="dropdown-item" href="#">Another action</a>
                                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
    
                                                    <li class="list-group-item">
                                                        <div>
                                                            <div class="d-flex align-items-start">
                                                                <div class="flex-grow-1">
                                                                    <div class="badge bg-success bg-gradient mb-2"><i class="mdi mdi-star"></i> 4.2</div>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <p class="text-muted font-size-13">26 Jun, 21</p>
                                                                </div>
                                                            </div>
                                                            <p class="text-muted mb-4">Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet</p>
                                                            <div class="d-flex align-items-start">
                                                                <div class="flex-grow-1">
                                                                    <h5 class="font-size-14 mb-0">Paul</h5>
                                                                </div>
            
                                                                <div class="flex-shrink-0">
                                                                    <div class="hstack gap-3">
                                                                        <div data-bs-toggle="tooltip" data-bs-placement="top" title="Like">
                                                                            <a href="#" class="text-muted"><i class="mdi mdi-thumb-up-outline"></i></a>
                                                                        </div>
                                                                        <div class="vr"></div>
                                                                        <div data-bs-toggle="tooltip" data-bs-placement="top" title="Comment">
                                                                            <a href="#" class="text-muted"><i class="mdi mdi-comment-text-outline"></i></a>
                                                                        </div>
                                                                        <div class="vr"></div>
                                                                        <div class="dropdown">
                                                                            <a class="text-muted dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i class="mdi mdi-dots-horizontal"></i>
                                                                            </a>
                                                                        
                                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                            <a class="dropdown-item" href="#">Action</a>
                                                                            <a class="dropdown-item" href="#">Another action</a>
                                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
    
                                                    <li class="list-group-item">
                                                        <div>
                                                            <div class="d-flex align-items-start">
                                                                <div class="flex-grow-1">
                                                                    <div class="badge bg-success bg-gradient mb-2"><i class="mdi mdi-star"></i> 4.1</div>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <p class="text-muted font-size-13">24 Jun, 21</p>
                                                                </div>
                                                            </div>
                                                            <p class="text-muted mb-4">Ut enim ad minima veniam, quis nostrum ullam corporis suscipit consequatur nisi ut</p>
                                                            <div class="d-flex align-items-start">
                                                                <div class="flex-grow-1">
                                                                    <h5 class="font-size-14 mb-0">Patrick</h5>
                                                                </div>
            
                                                                <div class="flex-shrink-0">
                                                                    <div class="hstack gap-3">
                                                                        <div data-bs-toggle="tooltip" data-bs-placement="top" title="Like">
                                                                            <a href="#" class="text-muted"><i class="mdi mdi-thumb-up-outline"></i></a>
                                                                        </div>
                                                                        <div class="vr"></div>
                                                                        <div data-bs-toggle="tooltip" data-bs-placement="top" title="Comment">
                                                                            <a href="#" class="text-muted"><i class="mdi mdi-comment-text-outline"></i></a>
                                                                        </div>
                                                                        <div class="vr"></div>
                                                                        <div class="dropdown">
                                                                            <a class="text-muted dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i class="mdi mdi-dots-horizontal"></i>
                                                                            </a>
                                                                        
                                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                            <a class="dropdown-item" href="#">Action</a>
                                                                            <a class="dropdown-item" href="#">Another action</a>
                                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-3">Transaction</h5>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span class="fw-semibold">Report By:</span> <span
                                                    class="text-muted">Monthly<i
                                                        class="mdi mdi-chevron-down ms-1"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Yearly</a>
                                                <a class="dropdown-item" href="#">Monthly</a>
                                                <a class="dropdown-item" href="#">Weekly</a>
                                                <a class="dropdown-item" href="#">Today</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="align-middle">Order ID</th>
                                                <th class="align-middle">Billing Name</th>
                                                <th class="align-middle">Date</th>
                                                <th class="align-middle">Total</th>
                                                <th class="align-middle">Pay Status</th>
                                                <th class="align-middle">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a href="javascript: void(0);" class="text-body fw-semibold">#BR2150</a> </td>
                                                <td>Smith</td>
                                                <td>
                                                    07 Oct, 2021
                                                </td>
                                                <td>
                                                    $24.05
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-pill bg-success-subtle text-success  font-size-11">Paid</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <button type="button" class="btn btn-primary bg-gradient btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                            <i data-eva="eye" data-eva-height="14" data-eva-width="14" class="fill-white align-text-top"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-success bg-gradient btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                            <i data-eva="edit" data-eva-height="14" data-eva-width="14" class="fill-white align-text-top"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger bg-gradient btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                            <i data-eva="trash-2" data-eva-height="14" data-eva-width="14" class="fill-white align-text-top"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><a href="javascript: void(0);" class="text-body fw-semibold">#BR2149</a> </td>
                                                <td>James</td>
                                                <td>
                                                    07 Oct, 2021
                                                </td>
                                                <td>
                                                    $26.15
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-pill bg-success-subtle text-success  font-size-11">Paid</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <button type="button" class="btn btn-primary bg-gradient btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                            <i data-eva="eye" data-eva-height="14" data-eva-width="14" class="fill-white align-text-top"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-success bg-gradient btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                            <i data-eva="edit" data-eva-height="14" data-eva-width="14" class="fill-white align-text-top"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger bg-gradient btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                            <i data-eva="trash-2" data-eva-height="14" data-eva-width="14" class="fill-white align-text-top"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><a href="javascript: void(0);" class="text-body fw-semibold">#BR2148</a> </td>
                                                <td>Jill</td>
                                                <td>
                                                    06 Oct, 2021
                                                </td>
                                                <td>
                                                    $21.25
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-pill  bg-warning-subtle  text-warning  font-size-11">Refund</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <button type="button" class="btn btn-primary bg-gradient btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                            <i data-eva="eye" data-eva-height="14" data-eva-width="14" class="fill-white align-text-top"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-success bg-gradient btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                            <i data-eva="edit" data-eva-height="14" data-eva-width="14" class="fill-white align-text-top"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger bg-gradient btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                            <i data-eva="trash-2" data-eva-height="14" data-eva-width="14" class="fill-white align-text-top"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><a href="javascript: void(0);" class="text-body fw-semibold">#BR2147</a> </td>
                                                <td>Kyle</td>
                                                <td>
                                                    05 Oct, 2021
                                                </td>
                                                <td>
                                                    $25.03
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-pill bg-success-subtle text-success  font-size-11">Paid</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <button type="button" class="btn btn-primary bg-gradient btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                            <i data-eva="eye" data-eva-height="14" data-eva-width="14" class="fill-white align-text-top"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-success bg-gradient btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                            <i data-eva="edit" data-eva-height="14" data-eva-width="14" class="fill-white align-text-top"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger bg-gradient btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                            <i data-eva="trash-2" data-eva-height="14" data-eva-width="14" class="fill-white align-text-top"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><a href="javascript: void(0);" class="text-body fw-semibold">#BR2146</a> </td>
                                                <td>Robert</td>
                                                <td>
                                                    05 Oct, 2021
                                                </td>
                                                <td>
                                                    $22.61
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-pill bg-success-subtle text-success  font-size-11">Paid</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <button type="button" class="btn btn-primary bg-gradient btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                            <i data-eva="eye" data-eva-height="14" data-eva-width="14" class="fill-white align-text-top"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-success bg-gradient btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                            <i data-eva="edit" data-eva-height="14" data-eva-width="14" class="fill-white align-text-top"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger bg-gradient btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                            <i data-eva="trash-2" data-eva-height="14" data-eva-width="14" class="fill-white align-text-top"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <!-- end table -->
                                </div>
                                <!-- end table responsive -->
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div> --}}
                <!-- end row -->
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    @endsection
