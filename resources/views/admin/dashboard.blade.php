@extends('admin.adminlayout.main')
@section('title')
    Admin-Dashboard
@endsection
@section('page-title')
    Dashboard
@endsection
@section('main-container')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xxl-9">
                        <div class="row">
                            <div class="col-xl-4 col-lg-6">
                                <div class="card">
                                    <a href="{{ route('Admin.UserList') }}" class="text-decoration-none text-dark">
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
                                                    <p class="text-muted mb-1">Users</p>
                                                    <h4 class="mb-0" id="userCount">0</h4>
                                                </div>
                                                <div class="flex-shrink-0 align-self-end ms-2">
                                                    {{-- Optional badge here --}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <div class="col-xl-4 col-lg-6">
                                <div class="card">
                                    <a href="{{ route('Admin.JobList') }}" class="text-decoration-none text-dark">
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
                                                    <p class="text-muted mb-1">Job Post</p>
                                                    <h4 class="mb-0" id="jobCount">0</h4>
                                                </div>
                                                <div class="flex-shrink-0 align-self-end ms-2">
                                                    {{-- <div
                                                        class="badge rounded-pill font-size-13  bg-danger-subtle  text-danger ">
                                                        - 0.82%
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <div class="col-xl-4">
                                <div class="card">
                                    <a href="{{ route('Admin.Recruiters') }}" class="text-decoration-none text-dark">
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
                                                    <p class="text-muted mb-1">Recruiter</p>
                                                    <h4 class="mb-0" id="RecruiterCount">0</h4>
                                                </div>
                                                <div class="flex-shrink-0 align-self-end ms-2">
                                                    {{-- <div class="badge rounded-pill font-size-13 bg-danger-subtle text-danger">-
                                                        1.04%
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        {{-- <div class="card">
                            <div class="card-body pb-0">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-3">Overview</h5>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span class="fw-semibold">Sort By:</span> <span class="text-muted">Yearly<i
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

                                <div class="row gy-4">
                                    <div class="col-xxl-3">
                                        <div>
                                            <div class="mt-3 mb-3">
                                                <p class="text-muted mb-1">This Month</p>

                                                <div class="d-flex flex-wrap align-items-center gap-2">
                                                    <h2 class="mb-0">$24,568</h2>
                                                    <div
                                                        class="badge rounded-pill font-size-13 bg-success-subtle text-success ">
                                                        +
                                                        2.65%</div>
                                                </div>
                                            </div>

                                            <div class="row g-0">
                                                <div class="col-sm-6">
                                                    <div class="border-bottom border-end p-3 h-100">
                                                        <p class="text-muted text-truncate mb-1">Orders</p>
                                                        <h5 class="text-truncate mb-0">5,643</h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="border-bottom p-3 h-100">
                                                        <p class="text-muted text-truncate mb-1">Sales</p>
                                                        <h5 class="text-truncate mb-0">16,273</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-0">
                                                <div class="col-sm-6">
                                                    <div class="border-bottom border-end p-3 h-100">
                                                        <p class="text-muted text-truncate mb-1">Order Value</p>
                                                        <h5 class="text-truncate mb-0">12.03 %</h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="border-bottom p-3 h-100">
                                                        <p class="text-muted text-truncate mb-1">Customers</p>
                                                        <h5 class="text-truncate mb-0">21,456</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-0">
                                                <div class="col-sm-6">
                                                    <div class="border-end p-3 h-100">
                                                        <p class="text-muted text-truncate mb-1">Income</p>
                                                        <h5 class="text-truncate mb-0">$35,652</h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="p-3 h-100">
                                                        <p class="text-muted text-truncate mb-1">Expenses</p>
                                                        <h5 class="text-truncate mb-0">$12,248</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-9">
                                        <div>
                                            <div id="chart-column" class="apex-charts"
                                                data-colors='["#f1f3f7", "#3b76e1"]'></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div> --}}
                        <!-- end card -->

                        <div class="row">
                            <div class="col-xl-6">
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
                                                        Weekly
                                                    </a>

                                                    {{-- <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Yearly</a>
                                                        <a class="dropdown-item" href="#">Monthly</a>
                                                        <a class="dropdown-item" href="#">Weekly</a>
                                                        <a class="dropdown-item" href="#">Today</a>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <p class="text-muted mb-1">This Month</p>
                                            <h4>{{ number_format($totalThisMonth) }}</h4>
                                        </div>

                                        <div class="m-n3">
                                            <div id="userActivity" data-colors='["#3b76e1", "#f56e6e"]' class="apex-charts">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- end col -->

                            {{-- <div class="col-xl-4 col-md-6">
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

                                        <div id="chart-donut" data-colors='["#3b76e1", "#f1f3f7", "#f56e6e"]'
                                            class="mt-2"></div>

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
                            </div> --}}
                            <!-- end col -->

                            <div class="col-xl-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <h5 class="card-title mb-3">Applicants</h5>
                                            </div>
                                        </div>

                                        <div id="candlestick-chart"></div>

                                        <div class="mx-n4" data-simplebar style="max-height: 296px;">
                                            <!-- your product list here -->
                                        </div>
                                    </div>

                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end col -->
                    <div class="col-xxl-3">

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
                                                        {{-- <div class="dropdown">
                                                            <a class="dropdown-toggle" href="#" role="button"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i data-eva="more-horizontal-outline" data-eva-width="20"
                                                                    data-eva-height="20" class="fill-white"></i>
                                                            </a>

                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="#">Action</a>
                                                                </li>
                                                                <li><a class="dropdown-item" href="#">Another
                                                                        action</a>
                                                                </li>
                                                                <li><a class="dropdown-item" href="#">Something else
                                                                        here</a></li>
                                                            </ul>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end user-profile-img -->

                                    <div class="mt-n5 position-relative">
                                        <div class="text-center">
                                            <!-- Profile Image with Camera Icon -->
                                            <div class="position-relative d-inline-block">
                                                <img id="profileImage" src="{{ url('admin/logo/default.png') }}"
                                                    onerror="this.onerror=null; this.src='{{ url('admin/logo/default.png') }}';"
                                                    alt="" class="avatar-xl rounded-circle img-thumbnail">
                                                <button
                                                    class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle"
                                                    style="width: 32px; height: 32px;" id="editImageButton">
                                                    <i class="fa fa-camera"></i>
                                                </button>
                                                <input type="file" id="imageInput" class="d-none" accept="image/*">
                                            </div>

                                            <div class="mt-3">
                                                <!-- Editable Name with Pencil Icon -->
                                                <h5 class="mb-1 d-inline-block position-relative" id="nameDisplay">
                                                </h5>
                                                <input type="text" id="nameInput" class="form-control d-none"
                                                    value="">
                                                <button class="btn btn-sm btn-outline-secondary ms-2 p-1"
                                                    id="editNameButton" data-bs-toggle="modal"
                                                    data-bs-target="#editNameModal">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </button>
                                                <p class="text-muted">Product Designer</p>
                                            </div>
                                            <button class="btn btn-success mt-3 d-none" id="saveChangesButton">Save
                                                Changes</button>
                                        </div>
                                    </div>

                                    <!-- Edit Name Modal -->
                                    <div class="modal fade" id="editNameModal" tabindex="-1"
                                        aria-labelledby="editNameModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editNameModalLabel">Edit Name</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="editNameForm">
                                                        <div class="mb-3">
                                                            <label for="userNameInput" class="form-label">Enter New
                                                                Name</label>
                                                            <input type="text" class="form-control" id="userNameInput"
                                                                placeholder="Enter your name">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Update
                                                            Name</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Name Modal End -->

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


                                        {{-- <div class="mb-4">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <h5 class="card-title mb-3">Earning</h5>
                                                </div>
                                                <div>
                                                    <button class="btn btn-link py-0 shadow-none" data-bs-toggle="tooltip"
                                                        data-bs-placement="left" data-bs-trigger="hover" title="Info">
                                                        <i data-eva="info-outline" class="fill-muted"
                                                            data-eva-height="20" data-eva-width="20"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div id="chart-radialBar" class="apex-charts" data-colors='["#3b76e1"]'>
                                            </div>

                                            <div class="text-center mt-4">
                                                <h4>$26,256</h4>
                                                <p class="text-muted">Earning this Month</p>
                                                <div class="d-flex align-items-start justify-content-center gap-2">
                                                    <div
                                                        class="badge rounded-pill font-size-13 bg-success-subtle text-success ">
                                                        + 2.65%
                                                    </div>
                                                    <div class="text-muted text-start text-truncate">From previous period
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        {{--     
                                        <hr class="mb-4"> --}}
                                        {{-- <div class="px-4 mx-n3" data-simplebar style="height: 258px;">
    
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
                                        </div> --}}
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-3">Recent Job</h5>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="align-middle">Title</th>
                                                <th class="align-middle">Role</th>
                                                <th class="align-middle">location</th>
                                                <th class="align-middle">Experience</th>
                                                <th class="align-middle">Education</th>
                                                <th class="align-middle">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recentJob as $job)
                                                <tr>
                                                    <td><a href="javascript: void(0);"
                                                            class="text-body fw-semibold">{{ $job->title }}</a> </td>
                                                    <td>{{ $job->role }}</td>
                                                    <td>
                                                        {{ $job->location }}
                                                    </td>
                                                    <td>
                                                        {{ $job->min_exp . ' - ' . $job->max_exp }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{-- <span class="badge badge-pill bg-success-subtle text-success  font-size-11">Paid</span> --}}
                                                        {{ $job->education }}
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('Admin.ViewJobPost', ['id' => Crypt::encrypt($job->id)]) }}"
                                                                class="btn btn-primary bg-gradient btn-sm"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="View">
                                                                <i data-eva="eye" data-eva-height="14"
                                                                    data-eva-width="14"
                                                                    class="fill-white align-text-top"></i>
                                                            </a>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach


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

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-3">Recent Applicants</h5>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="align-middle">Name</th>
                                                <th class="align-middle">Email</th>
                                                <th class="align-middle">mobile</th>
                                                <th class="align-middle">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($RecentApplicant as $applicants)
                                                <tr>
                                                    <td><a href="javascript: void(0);"
                                                            class="text-body fw-semibold">{{ $applicants->user->name . ' ' . $applicants->user->lname }}</a>
                                                    </td>
                                                    <td>{{ $applicants->user->email }}</td>
                                                    <td>
                                                        {{ $applicants->phone }}
                                                    </td>


                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('Admin.ApllicantsDetails', [
                                                                'userId' => Crypt::encrypt($applicants->user->id),
                                                                'jobId' => Crypt::encrypt($applicants->jobPost->id),
                                                            ]) }}"
                                                                class="btn btn-primary bg-gradient btn-sm"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="View">
                                                                <i data-eva="eye" data-eva-height="14"
                                                                    data-eva-width="14"
                                                                    class="fill-white align-text-top"></i>
                                                            </a>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach


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

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-3">Job Expiry</h5>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="align-middle">Title</th>
                                                <th class="align-middle">Recruiter</th>
                                                <th class="align-middle">location</th>
                                                <th class="align-middle">Expiry</th>
                                                <th class="align-middle">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jobExpiry as $exp)
                                                <tr>
                                                    <td><a href="javascript: void(0);"
                                                            class="text-body fw-semibold">{{ $exp->title }}</a> </td>
                                                    <td>{{ $exp->recruiter->name }}</td>
                                                    <td>
                                                        {{ $exp->location }}
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge badge-pill bg-danger-subtle text-danger  font-size-11">
                                                            {{ date('d-M-Y', strtotime($exp->jobexpiry)) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('Admin.EditJobPost', ['id' => Crypt::encrypt($exp->id)]) }}"
                                                                class="btn btn-primary bg-gradient btn-sm"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Edit">
                                                                <i data-eva="edit" data-eva-height="14"
                                                                    data-eva-width="14"
                                                                    class="fill-white align-text-top"></i>
                                                            </a>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach


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
                </div>
                <!-- end row -->
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    @endsection

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    @section('script')
        {{-- To get details --}}
        <script>
            $(document).ready(function() {
                var defaultImage = "{{ url('admin/logo/default.png') }}";

                $.ajax({
                    url: "{{ route('Admin.dashboardData') }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#userCount').text(data.userCount);
                        $('#jobCount').text(data.jobCount);
                        $('#RecruiterCount').text(data.RecruiterCount);

                        // Check if logo exists and update the profile image
                        if (data.logo) {
                            $('#profileImage').attr('src', "{{ asset('') }}" + data.logo);
                        } else {
                            $('#profileImage').attr('src', defaultImage);
                        }

                        $('#nameDisplay').text(data.name);
                    },
                    error: function() {
                        alert('Failed to fetch data!');
                    }
                });
            });
        </script>

        {{-- Update Profile Image --}}
        <script>
            $(document).ready(function() {

                // Trigger file input when camera icon is clicked
                $('#editImageButton').click(function() {
                    $('#imageInput').click();
                });

                // Preview Image and Upload
                $('#imageInput').change(function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            $('#profileImage').attr('src', e.target.result); // Image preview
                        }
                        reader.readAsDataURL(file);

                        // Upload Image using AJAX
                        const formData = new FormData();
                        formData.append('image', file);

                        $.ajax({
                            url: "{{ route('Admin.UpdateProfileImage') }}",
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            dataType: 'json',
                            success: function(result) {
                                if (result.status_code === 1) {
                                    $('#EditModal').modal('hide');
                                    $('#EditCompany').trigger("reset");
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
                                        },
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
                    }
                });
            });
        </script>

        {{-- Update Profile Nmae --}}
        <script>
            $(document).ready(function() {
                // When the edit button is clicked
                $('#editNameButton').click(function() {
                    const currentName = $('#nameDisplay').text(); // Get the current name
                    $('#userNameInput').val(currentName); // Set it in the input field
                });

                // Handle Form Submission
                $('#editNameForm').submit(function(e) {
                    e.preventDefault();
                    const newName = $('#userNameInput').val();

                    if (!newName.trim()) {
                        alert('Please enter a valid name.');
                        return;
                    }

                    $.ajax({
                        url: "{{ route('Admin.UpdateProfileName') }}",
                        type: 'POST',
                        data: {
                            name: newName,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                // Update the displayed name
                                $('#nameDisplay').text(response.name);

                                // Close the modal
                                $('#editNameModal').modal('hide');

                                // Show success toast
                                Toastify({
                                    text: "Name updated successfully!",
                                    duration: 3000,
                                    gravity: "top",
                                    position: "right",
                                    backgroundColor: "#4CAF50"
                                }).showToast();

                                // Rleoad data
                                location.reload();
                            }
                        },
                        error: function() {
                            Toastify({
                                text: "Failed to update name.",
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "#F44336"
                            }).showToast();
                        }
                    });
                });
            });
        </script>


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                setTimeout(function() {
                    var options = {
                        chart: {
                            height: 250,
                            type: 'area',
                            toolbar: {
                                show: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2
                        },
                        series: [{
                                name: "Current",
                                data: @json($currentWeek)
                            },
                            {
                                name: "Previous",
                                data: @json($previousWeek)
                            }
                        ],
                        colors: ['#3b76e1', '#f56e6e'],
                        xaxis: {
                            categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'center'
                        },
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shadeIntensity: 1,
                                opacityFrom: 0.7,
                                opacityTo: 0.2,
                                stops: [0, 90, 100]
                            }
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#userActivity"), options);
                    chart.render();
                }, 100); // slight delay for smoother load
            });
        </script>

        {{-- For Showing the Applicants Graph Data --}}
        <script>
            var weeklyData = @json($weeklyApplications);

            var chartOptions = {
                series: [{
                    name: "Applications",
                    data: weeklyData.map(item => ({
                        x: new Date(item.x).getTime(),
                        y: item.y
                    }))
                }],
                chart: {
                    type: 'bar', // Using bar for better clarity on count
                    height: 0,
                    toolbar: {
                        show: false // ✅ disables the toolbar icons
                    }
                },
                xaxis: {
                    type: 'datetime',
                    labels: {
                        format: 'dd MMM'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Applications'
                    }
                },
                tooltip: {
                    x: {
                        format: 'dddd, dd MMMM yyyy'
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#candlestick-chart"), chartOptions);
            chart.render();
        </script>
    @endsection
