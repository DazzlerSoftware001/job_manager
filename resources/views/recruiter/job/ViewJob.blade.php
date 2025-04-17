@extends('recruiter.recruiterlayout.main')
@section('title', 'Recruiter - View Job Post')

@section('page-title')
    View Job Post
@endsection

@section('main-container')
<style>
    /* Styling for a clean modern look */
    body {
        background: #f8f9fa;
    }

    .job-details-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 25px;
    }

    .section-header {
        font-size: 1.2rem;
        font-weight: bold;
        border-bottom: 2px solid #007bff;
        padding-bottom: 5px;
        margin-bottom: 15px;
        color: #007bff;
    }

    .info-box {
        font-size: 1rem;
        color: #333;
        background: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .badge-custom {
        background-color: #007bff;
        color: white;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.9rem;
        margin-right: 5px;
    }

    .company-logo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #ddd;
        display: block;
        margin: 0 auto;
    }
</style>

<div class="main-content">
    <div class="page-content">
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="job-details-card">
                        <h3 class="text-center text-primary fw-bold">{{ $job->title }}</h3>

                        <!-- Job Info Grid -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <p class="info-box"><strong>Type:</strong> {{ $job->type }}</p>
                                <p class="info-box"><strong>Industry:</strong> {{ $job->industry }}</p>
                                <p class="info-box"><strong>Department:</strong> {{ $job->department }}</p>
                                <p class="info-box"><strong>Role:</strong> {{ $job->role }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="info-box"><strong>Mode:</strong> {{ $job->mode }}</p>
                                <p class="info-box"><strong>Location:</strong> {{ $job->location }}</p>
                                <p class="info-box"><strong>Experience:</strong> {{ $job->min_exp }} - {{ $job->max_exp }} years</p>
                                <p class="info-box"><strong>Salary:</strong> {{ $job->currency }} {{ $job->min_sal }} - {{ $job->max_sal }}</p>
                            </div>
                        </div>

                        <!-- Skills -->
                        <div class="mt-3">
                            <p class="section-header">Skills Required</p>
                            @foreach(explode(',', $job->skills) as $skill)
                                <span class="badge badge-custom">{{ trim($skill) }}</span>
                            @endforeach
                        </div>

                        <!-- Education & Candidate Info -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <p class="info-box"><strong>Education Level:</strong> {{ $job->education_level }}</p>
                                <p class="info-box"><strong>Education:</strong> {{ $job->education }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="info-box"><strong>Candidate Industry:</strong> {{ $job->condidate_industry }}</p>
                                <p class="info-box"><strong>Vacancies:</strong> {{ $job->vacancies }}</p>
                            </div>
                        </div>

                        <!-- Branch -->
                        <div class="mt-3">
                            <p class="section-header">Branch</p>
                            @foreach(explode(',', $job->branch) as $value)
                                <span class="badge badge-custom">{{ trim($value) }}</span>
                            @endforeach
                        </div>

                        <!-- Company Details -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <p class="info-box"><strong>Company Name:</strong> {{ $job->com_name }}</p>
                                <p class="info-box"><strong>Company Details:</strong> {{ $job->com_details }}</p>
                            </div>
                            <div class="col-md-4 text-center">
                                <p class="info-box"><strong>Company Logo:</strong>
                                <img id="imagePreview" src="{{ asset($job->com_logo) }}" 
                                     onerror="this.onerror=null; this.src='{{ url('recruiter/logo/default.png') }}';"
                                     alt="Company Logo" class="company-logo"></p>
                            </div>
                            <div class="col-md-8 text-center">
                            </div>

                            <div class="col-md-4">
                                <p class="info-box text-danger"><strong>Job Expiry: </strong>{{ $job->jobexpiry }}</p>
                            </div>
                        </div>

                        <!-- Job Description -->
                        <div class="mt-4">
                            <p class="section-header text-danger">Job Description</p>
                            <p>{!! $job->job_desc !!}</p>
                        </div>

                        <div class="mt-4">
                            <p class="section-header text-success">Responsibilities</p>
                            <p>{!! $job->job_resp !!}</p>
                        </div>

                        <div class="mt-4">
                            <p class="section-header text-info">Requirements</p>
                            <p>{!! $job->job_req !!}</p>
                        </div>

                        <div class="mt-4">
                            <p class="info-box"><strong>Recruter Name:</strong> {{ $Recruiter->name }} - {{ $Recruiter->email }}</p>
                        </div>
                        
                        <!-- Action Button -->
                        {{-- <div class="text-center mt-4">
                            <button class="btn btn-primary px-4 py-2 fw-bold">Edit Job Post</button>
                        </div> --}}
                    </div> <!-- End Card -->
                </div> <!-- End Col -->
            </div> <!-- End Row -->
        </div> <!-- End Container -->
    </div> <!-- End Page-content -->
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
