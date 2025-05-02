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
                        <h3 class="border-bottom border-primary d-inline-block pb-1 mb-4 text-primary">
                            <i class="bi bi-person-circle me-2"></i> {{$JobPost}}
                        </h3>
                        <div class="card">
                           

                          

                            <div class="card-body">
                                <div class="row align-items-center">
                                    <!-- Profile Image -->
                                    <div class="col-md-2 text-center">
                                        <img src="{{ $user->logo ? asset($user->logo) : url('user/assets/img/profile/default.png') }}"
                                            class="img-fluid rounded-circle" alt="Profile Picture"
                                            style="width: 100px; height: 100px; object-fit: cover;">
                                    </div>

                                    <!-- Name, Role, Location, Employment Type, Skills -->
                                    <div class="col-md-7">
                                        <h3 class="mb-1">{{ $user->name }} {{ $user->lname }}</h3>
                                        <p class="mb-1 text-muted">
                                            {{ $user->candidateProfile->position ?? 'Not Specified' }}</p>
                                        <p class="mb-1">
                                            <i class="mdi mdi-map-marker-outline"></i> {{ $user->city }}
                                            {{ $user->state }}
                                            {{ $user->country }}
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
                                            @php
                                                $skills = $user->candidateProfile->skill ?? '[]';
                                                $skillsArray = json_decode($skills, true) ?? [];
                                            @endphp

                                            @foreach ($skillsArray as $skill)
                                                <span class="badge bg-light text-dark me-2">{{ $skill }}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="col-md-3 text-md-end mt-3 mt-md-0">

                                        @if ($application->status !== 'shortlisted')
                                            <button id="shortlistBtn"
                                                class="btn btn-outline-warning me-2">Shortlist</button>
                                        @elseif($application->status == 'shortlisted')
                                            <button class="btn btn-warning me-2">Shortlisted</button>
                                        @endif

                                        @if ($application->status !== 'rejected')
                                            <button id="RejectBtn" class="btn btn-outline-danger me-2">Reject</button>
                                        @elseif($application->status == 'rejected')
                                            <button class="btn btn-danger me-2">Rejected</button>
                                        @endif

                                        @if ($application->status !== 'hired')
                                            <button id="HireBtn" class="btn btn-outline-primary me-2">Hire</button>
                                        @elseif($application->status == 'hired')
                                            <button class="btn btn-success me-2">Hired</button>
                                        @endif
                                        {{-- $user->id
                                    $DecJob_Id --}}

                                        <a href="{{ route('Recruiter.CandidateCVDownload', ['userId' => Crypt::encrypt($user->id)]) }}"
                                            class="btn btn-primary mt-1">Cv Download</a>


                                    </div>
                                </div>

                            </div>

                        </div>
                        @if ($user->description != null)
                            {{-- <h3 class="border-bottom border-primary d-inline-block pb-1">About Candidate</h3>
                            <div class="card shadow-sm mb-4 border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <p class="ms-3"> Email: {{ $user->email }}</p>
                                        <p class="ms-3"> DOB: {{ date('d-M-Y', strtotime($user->date_of_birth)) }}</p>
                                        <p class="ms-3">Gender: {{ $user->gender }}</p>
                                        <p class="ms-3">Looking for Job: {{ $user->look_job == 1 ? 'Yes' : 'No' }}</p>
                                       <h6>Description</h6>
                                        <p class="ms-3">{{ $user->description }}</p>
                                    </div>
                                </div>
                            </div> --}}

                            <h3 class="border-bottom border-primary d-inline-block pb-1 mb-4 text-primary">
                                <i class="bi bi-person-circle me-2"></i> About Candidate
                            </h3>
                            
                            <div class="card shadow-lg border-0 rounded-4">
                                <div class="card-body p-4">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <p class="mb-2">
                                                <i class="bi bi-envelope-fill text-primary me-2"></i>
                                                <strong>Email:</strong> {{ $user->email }}
                                            </p>
                                            <p class="mb-2">
                                                <i class="bi bi-calendar-event-fill text-success me-2"></i>
                                                <strong>DOB:</strong> {{ date('d-M-Y', strtotime($user->date_of_birth)) }}
                                            </p>
                                            <p class="mb-2">
                                                <i class="bi bi-gender-ambiguous text-warning me-2"></i>
                                                <strong>Gender:</strong> {{ ucfirst($user->gender) }}
                                            </p>
                                            <p class="mb-2">
                                                <i class="bi bi-briefcase-fill text-info me-2"></i>
                                                <strong>Looking for Job:</strong> 
                                                <span class="badge {{ $user->look_job == 1 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $user->look_job == 1 ? 'Yes' : 'No' }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-12">
                                            <h6 class="border-bottom border-primary d-inline-block pb-1 mb-1 text-primary">
                                                <i class="bi bi-card-text me-2"></i>Description
                                            </h6>
                                            <p class="text-muted ps-1">{{ $user->description }}</p>
                                        </div>

                                        @php
                                        $social_links = json_decode($user->social_links, true);
                                    @endphp
            
                                    @if (!empty($social_links))
                                        <div class="mt-4">
                                            <h4 class="border-bottom border-success d-inline-block pb-1 mb-1 text-success">
                                                <i class="bi bi-card-text me-2"></i>Social Profiles
                                            </h4>
                                            
                                                <ul class="list-unstyled ms-2">
                                                    @foreach($social_links as $platform => $url)
                                                        <li class="mb-2">
                                                            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                                                            class="text-primary text-decoration-underline fw-medium"
                                                            style="transition: color 0.2s ease;">
                                                                {{ ucfirst($platform) }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
            
                                        </div>
                                    @endif

                                    </div>
                                </div>
                            </div>
                            

                        @endif


                        @php
                            $educations = $user->candidateQualification; // or whatever relationship you set
                        @endphp
                        {{-- {{$educations}} --}}
                        @if ($educations->isNotEmpty())

                            <h3>Education</h3>
                            @foreach ($educations as $education)
                                <div class="card shadow-sm mb-4 border-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <h6 class="mb-0">{{ $education->level }}</h6>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <h6 class="mb-0">{{ $education->board_university }}</h6>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <h6 class="mb-0">{{ $education->school_college }}</h6>
                                            </div>
                                            @if($education->stream)
                                            <div class="col-12 mb-2">
                                                <h6 class="mb-0">{{ $education->stream }}</h6>
                                            </div>
                                            @endif
                                            <div class="col-12 mb-2">
                                                <h6 class="mb-0">{{ $education->passing_year }}</h6>
                                            </div>
                                            <div class="col-12">
                                                <h6 class="mb-0">{{ $education->percentage }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        @php
                            $employments = $user->candidateEmployment; // or whatever relationship you set
                        @endphp
                        @if ($employments->isNotEmpty())
                            <h3>Experience</h3>
                            @foreach ($employments as $employment)
                                <div class="card shadow-sm mb-4 border-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="mb-0">{{ $employment->position }}</h2>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <h6 class="mb-0">{{ $employment->company_name }}</h6>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <h6 class="mb-0">{{ $employment->experience }}</h6>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <h6 class="mb-0">{{ $employment->description }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif


                        @php
                            $candidateAward = $user->candidateAward;
                        @endphp
                            @if ($candidateAward->isNotEmpty())
                            <h3>Award</h3>
                            @foreach ($candidateAward as $Award)
                                <div class="card shadow-sm mb-4 border-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="border-bottom border-primary d-inline-block pb-1 mb-1 text-primary">{{ $Award->award_title }}</h4>
                                            </div>
                                            
                                            <div class="col-12 mt-2">
                                                <h6 class="mb-0">{{ $Award->award_desc }}</h6>
                                            </div>

                                            <div class="col-12 mt-2">
                                                <h6 class="mb-0">{{ $Award->award_date }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                      



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
    <script>
        $(document).ready(function() {
            $('#shortlistBtn').on('click', function() {
                var url =
                    "{{ route('Recruiter.CandidateShortlist', [
                        'userId' => Crypt::encrypt($user->id),
                        'jobId' => Crypt::encrypt($DecJob_Id),
                    ]) }}";

                $.ajax({
                    url: url,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.status_code === 1) {
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
                            setTimeout(function() {
                                location.reload();
                            }, 1000);

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
                    error: function() {
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

    <script>
        $(document).ready(function() {
            $('#RejectBtn').on('click', function() {
                var url =
                    "{{ route('Recruiter.CandidateReject', [
                        'userId' => Crypt::encrypt($user->id),
                        'jobId' => Crypt::encrypt($DecJob_Id),
                    ]) }}";

                $.ajax({
                    url: url,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.status_code === 1) {
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
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
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
                    error: function() {
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

    <script>
        $(document).ready(function() {
            $('#HireBtn').on('click', function() {
                var url =
                    "{{ route('Recruiter.CandidateHire', [
                        'userId' => Crypt::encrypt($user->id),
                        'jobId' => Crypt::encrypt($DecJob_Id),
                    ]) }}";

                $.ajax({
                    url: url,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.status_code === 1) {
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
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
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
                    error: function() {
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
