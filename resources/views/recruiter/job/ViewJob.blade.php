@extends('recruiter.recruiterlayout.main')
@section('title')
    Recruiter-View Job Post
@endsection

@section('page-title')
View Job Post
@endsection

@section('main-container')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xxl-12">

                        <div class="card">
                            <div class="card-body pb-0">
                                <form method="POST" action="javascript:void(0)" id="AddJobPost">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-12 text-center">
                                            <h4>{{$job->title}}</h4>
                                        </div>
                                        
                                        <div class="col-6 col-md-3">
                                            <p><strong>Type:</strong> {{$job->type}}</p>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <p><strong>Industry:</strong> {{$job->industry}}</p>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <p><strong>Department:</strong> {{$job->department}}</p>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <p><strong>Role:</strong> {{$job->role}}</p>
                                        </div>
                                        
                                        <div class="col-6 col-md-3">
                                            <p><strong>Mode:</strong> {{$job->mode}}</p>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <p><strong>Location:</strong> {{$job->location}}</p>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <p><strong>Experience:</strong> {{$job->min_exp}} - {{$job->max_exp}} years</p>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <p><strong>Salary:</strong> {{$job->currency}} {{$job->min_sal}} - {{$job->max_sal}}</p>
                                        </div>
                                        
                                        <div class="col-12">
                                            <p><strong>Skills:</strong> 
                                                @foreach(explode(',', $job->skills) as $skill)
                                                    {{ trim($skill) }}
                                                @endforeach
                                            </p>
                                        </div>
                                        
                                        <div class="col-6 col-md-3">
                                            <p><strong>Education:</strong> {{$job->education}}</p>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <p><strong>Candidate Industry:</strong> {{$job->condidate_industry}}</p>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <p><strong>Vacancies:</strong> {{$job->vacancies}}</p>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <p><strong>Interview Type:</strong> {{$job->int_type}}</p>
                                        </div>
                                        
                                        <div class="col-12">
                                            <label for="edit_diversity" class="d-block"><strong>Diversity Hiring (Optional)</strong></label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="male" name="edit_diversity" value="Male">
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="female" name="edit_diversity" value="Female">
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-md-6">
                                            <p><strong>Company Name:</strong> {{$job->com_name}}</p>
                                            <p><strong>Company Details:</strong> {{$job->com_details}}</p>
                                        </div>
                                        
                                        <div class="col-12 text-center">
                                            <div class="mt-3">
                                                <img id="imagePreview" src="{{asset($job->com_logo)}}" alt="Company Logo"
                                                    style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
                                                <input type="hidden" id="edit_company_logo" name="edit_company_logo" value="">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
       
    @endsection
