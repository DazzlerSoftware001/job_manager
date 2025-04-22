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
                                <h4 class="card-title">All Applicants</h4>
                            </div>

                            <div class="card-body">

                                <div class="row">
                                    @forelse ($applicants as $user)
                                    <div class="col-md-4 mb-4">
                                        <div class="card text-center shadow-sm border">
                                            <div class="card-body">
                                                <img src="{{ $user->logo ? asset('assets/' . $user->logo) : 'https://via.placeholder.com/80' }}"
                                                     class="rounded-circle mb-3" width="80" height="80" alt="Profile">
                                                <h5 class="card-title fw-bold mb-1">{{ $user->name }}</h5>
                                                <p class="text-muted mb-2">{{ $user->position ?? 'Not specified' }}</p>
                        
                                                <div class="d-flex justify-content-center gap-3 text-muted small mb-3">
                                                    <div><i class="fas fa-map-marker-alt me-1"></i> {{ $user->address}}, {{ $user->state}}</div>
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
                                                    @foreach($user->skills ?? [] as $skill)
                                                        <span class="badge bg-light text-dark me-1">{{ $skill }}</span>
                                                    @endforeach
                                                </div>
                        
                                                <a href="#" class="btn btn-outline-secondary rounded-pill px-4">View Profile</a>
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
