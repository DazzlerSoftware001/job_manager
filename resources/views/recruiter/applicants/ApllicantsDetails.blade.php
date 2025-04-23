@extends('recruiter.recruiterlayout.main')
@section('title')
    Recruiter-Applicants Details
@endsection
@section('page-title')
    Applicants Details
@endsection

@section('main-container')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Applicants Details</h4>
                        </div>

                        <div class="card-body">
                            <div class="row align-items-center">
                                <!-- Profile Image -->
                                <div class="col-md-2 text-center">
                                    <img src="path_to_image.jpg" class="img-fluid rounded-circle" alt="Profile Picture" style="width: 100px; height: 100px; object-fit: cover;">
                                </div>

                                <!-- Name, Role, Location, Employment Type, Skills -->
                                <div class="col-md-7">
                                    <h3 class="mb-1">{{$user->name}} {{$user->lname}}</h3>
                                    <p class="mb-1 text-muted">Software Engineer</p>
                                    <p class="mb-1">
                                        <i class="mdi mdi-map-marker-outline"></i> {{$user->state}} {{$user->country}}
                                        &nbsp; | &nbsp;
                                        @php
                                            $exp = $user->experience ?? null;

                                            if ($exp) {
                                                $parts = explode('.', number_format($exp, 2, '.', ''));
                                                $years = intval($parts[0]);
                                                $months = isset($parts[1]) ? intval($parts[1]) : 0;
                                            }
                                        @endphp

                                            <i class="fas fa-briefcase me-1"></i>
                                            {{ $exp ? "$years Year" . ($years != 1 ? 's' : '') . ($months ? " $months Month" . ($months != 1 ? 's' : '') : '') : 'N/A' }}

                                    </p>
                                    <div class="mt-2">
                                        <span class="badge bg-light text-dark me-2">React</span>
                                        <span class="badge bg-light text-dark me-2">Nest Js</span>
                                        <span class="badge bg-light text-dark">C++</span>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="col-md-3 text-md-end mt-3 mt-md-0">
                                    <button class="btn btn-outline-primary me-2">Shortlist</button>
                                    <button class="btn btn-primary">Cv Download</button>
                                </div>
                            </div>

                        </div>

                    </div>
                    @if($user->description !=null)
                        <h3 class="border-bottom border-primary d-inline-block pb-1">About Candidate</h3>
                        <p class="ms-3">{{ $user->description }}</p>
                    @endif

                    
                    <h3>Education</h2>
                    <p></p>

                </div>
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>

        <!-- End Page-content -->

        <!--Details Modal -->
       
    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @section('script')
    
    @endsection
