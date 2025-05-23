@extends('recruiter.recruiterlayout.main')
@section('title')
    Recruiter-All Applicants
@endsection
@section('page-title')
    All Applicants
@endsection

@section('main-container')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-success"><b>{{ $job->title }}</b></h4>
                            </div>

                            <div class="card-body">

                                <div class="row">
                                    @forelse ($applicants as $user)
                                        @php
                                            // Get the application for this user
                                            $application = $job->applications->firstWhere('user_id', $user->id);

                                            // Get the recruiter_view value for the application (default to 0 if not found)
                                            $viewStatus = $application ? $application->recruiter_view : 0;
                                        @endphp
                                        <div class="col-md-4 mb-4">
                                            <div class="card text-center shadow-sm border">
                                                @if ($viewStatus == 1)
                                                <div class="card-body" style="position:relative;">
                                                @else
                                                <div class="card-body border-success" style="position:relative; border:2px solid purple;">
                                                @endif
                                                
                                                    <img src="{{ $user->logo ? asset($user->logo) : url('user/assets/img/profile/default.png') }}"
                                                        class="rounded-circle mb-3" width="80" height="80"
                                                        alt="Profile">
                                                    {{-- Add Viewed / Not Viewed Badge --}}
                                                    <div class="mb-3 text-center"
                                                        style="position: absolute;top:10px;right:10px;">
                                                        @if ($viewStatus == 1)
                                                            <span
                                                                class="badge bg-warning text-dark px-3 py-2">Viewed</span>
                                                        @else
                                                            <span class="badge bg-success text-white px-3 py-2">Not
                                                                Viewed</span>
                                                        @endif


                                                    </div>
                                                    <h5 class="card-title fw-bold mb-1">{{ $user->name }}
                                                        {{ $user->lname }}</h5>
                                                    <p class="text-muted mb-2">
                                                        {{ $user->candidateProfile->position ?? 'Not specified' }}</p>

                                                    <div class="d-flex justify-content-center gap-3 text-muted small mb-3">
                                                        <div><i class="fas fa-map-marker-alt me-1"></i>
                                                            {{ $user->address }}, {{ $user->state }}</div>
                                                        {{-- <div><i class="fas fa-briefcase me-1"></i> {{ $user->experience ?? 'N/A' }}</div> --}}

                                                        @php
                                                            $exp = $user->experience ?? null;

                                                            if ($exp) {
                                                                $parts = explode('.', number_format($exp, 2, '.', ''));
                                                                $years = intval($parts[0]);
                                                                $months = isset($parts[1]) ? intval($parts[1]) : 0;
                                                            }
                                                        @endphp

                                                        <div>
                                                            <i class="fas fa-briefcase me-1"></i>
                                                            {{ $exp ? "$years Year" . ($years != 1 ? 's' : '') . ($months ? " $months Month" . ($months != 1 ? 's' : '') : '') : 'N/A' }}
                                                        </div>

                                                    </div>

                                                    <div class="mb-3">
                                                        @foreach ($user->skills ?? [] as $skill)
                                                            <span
                                                                class="badge bg-light text-dark me-1">{{ $skill }}</span>
                                                        @endforeach
                                                    </div>

                                                    {{-- <a href="{{route('Recruiter.ApllicantsDetails', ['userId' => Crypt::encrypt($user->id)])}}" class="btn btn-outline-primary rounded-pill px-4">View Profile</a> --}}
                                                    <a href="{{ route('Recruiter.ApllicantsDetails', [
                                                        'userId' => Crypt::encrypt($user->id),
                                                        'jobId' => Crypt::encrypt($job->id),
                                                    ]) }}"
                                                        class="btn btn-outline-primary rounded-pill px-4">View Profile</a>

                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p>No applicants found for this job.</p>
                                    @endforelse
                                </div>


                            </div>


                        </div>
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
