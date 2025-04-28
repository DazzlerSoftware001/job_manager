@extends('User.UserLayout.main')
@section('title')
    Jobs
@endsection
@section('main-container')
    <!-- breadcrumb area -->
    <div class="rts__section breadcrumb__background">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 position-relative d-flex justify-content-between align-items-center">
                    <div class="breadcrumb__area max-content breadcrumb__padding">
                        <div
                            class="rts__job__card__big bg-transparent p-0 position-relative z-1 flex-wrap justify-content-between d-flex gap-4 align-items-center">
                            <div class="d-flex gap-4 align-items-center flex-md-row flex-column mx-auto mx-md-0">
                                <div class="company__icon rounded-2 bg-white">
                                    <img src="{{ $job->com_logo ? asset($job->com_logo) : url('company/logo/default.png') }}"
                                        onerror="this.onerror=null; this.src='{{ url('company/logo/default.png') }}';"
                                        alt="">
                                </div>
                                <div class="job__meta w-100 d-flex text-center text-md-start flex-column gap-2">
                                    <div class="">
                                        <h3 class="job__title h3 mb-0">{{ $job->title }}</h3>
                                    </div>
                                    <div
                                        class="d-flex gap-3 justify-content-center justify-content-md-start flex-wrap mb-3 mt-2">
                                        <div class="d-flex gap-2 align-items-center">
                                            <i class="fa-light fa-location-dot"></i> {{ $job->location }}
                                        </div>
                                        <div class="d-flex gap-2 align-items-center">
                                            <i class="fa-light rt-briefcase"></i> {{ $job->type }}
                                        </div>
                                        <div class="d-flex gap-2 align-items-center">
                                            <i class="fa-light fa-clock"></i> {{ $job->created_at->diffForHumans() }}
                                        </div>
                                        <div class="d-flex gap-2 fw-medium align-items-center">
                                            <i class="fa-light rt-price-tag"></i> {{ $job->currency }} {{ $job->min_sal }} -
                                            {{ $job->max_sal }}
                                        </div>
                                    </div>
                                    <div
                                        class="job__tags d-flex justify-content-center justify-content-md-start flex-wrap gap-3">
                                        @foreach (explode(',', $job->skills) as $skill)
                                            <a href="#">{{ trim($skill) }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="breadcrumb__apply max-content">
                            <a href="#" class="rts__btn apply__btn be-1 fill__btn">Apply</a>
                        </div>   --}}

                        <div class="breadcrumb__apply max-content">
                            <form action="{{ route('User.ApplyForJOb', $job->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="rts__btn apply__btn be-1 fill__btn">Apply</button>
                            </form>
                        </div>



                    </div>
                    <div class="breadcrumb__area__shape d-flex gap-4 justify-content-end align-items-center">
                        <div class="shape__one common">

                        </div>
                        <div class="shape__two common">
                            <img src="assets/img/breadcrumb/shape-2.svg" alt="">
                        </div>
                        <div class="shape__three common">
                            <img src="assets/img/breadcrumb/shape-3.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- job list one -->
    <div class="rts__section section__padding">
        <div class="container">
            <div class="row g-30">
                <div class="col-lg-7 col-xl-8">
                    <div class="rts__job__details">
                        <div class="job-description">
                            {!! $job->job_desc !!}

                        </div>

                        <div id="responsibility" class="mb-30">
                            {!! $job->job_resp !!}

                        </div>

                        <div id="requirements" class="mb-30">
                            {!! $job->job_req !!}
                        </div>

                        <div class="d-flex flex-wrap gap-4 mt-40 mb-30">

                            <div class="d-flex gap-3 align-items-center">
                                <span class="h6 fw-semibold">Share</span>
                                <div class="rts__social d-flex gap-3">
                                    <a target="_blank" href="https://facebook.com/" aria-label="facebook">
                                        <i class="fa-brands fa-facebook"></i>
                                    </a>
                                    <a target="_blank" href="https://instagram.com/" aria-label="instagram">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                    <a target="_blank" href="https://linkedin.com/" aria-label="linkedin">
                                        <i class="fa-brands fa-linkedin"></i>
                                    </a>
                                    <a target="_blank" href="https://pinterest.com/" aria-label="pinterest">
                                        <i class="fa-brands fa-pinterest"></i>
                                    </a>
                                    <a target="_blank" href="https://youtube.com/" aria-label="youtube">
                                        <i class="fa-brands fa-youtube"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="job__location">
                        <h6 class="fw-semibold mb-30">Job Location</h6>
                        <div class="gmap height-500">
                        <iframe src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Reacthemes+(ReacThemes)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                    </div> 
                    </div> --}}
                </div>
                <div class="col-lg-5 col-xl-4 d-flex flex-column gap-40">
                    <div class="job__overview">
                        <h6 class="fw-semibold mb-20">Job Overview</h6>
                        <div class="job__overview__content">
                            <ul>
                                <li class="d-flex flex-wrap gap-3 gap-sm-0 align-items-center justify-content-between">
                                    <span class="left-text"> <i class="rt-calender"></i> Date Posted</span>
                                    <span class="text">: {{ $job->created_at->format('j M Y') }}</span>
                                </li>
                                <li class="d-flex flex-wrap gap-3 gap-sm-0 align-items-center justify-content-between">
                                    <span class="left-text"> <i class="rt-user"></i> Vacancy</span>
                                    <span class="text">: {{ $job->vacancies }}</span>
                                </li>
                                <li class="d-flex flex-wrap gap-3 gap-sm-0 align-items-center justify-content-between">
                                    <span class="left-text"> <i class="rt-experience"></i> Experience</span>
                                    <span class="text">: {{ $job->min_exp }} years - {{ $job->max_exp }} years</span>
                                </li>
                                <li class="d-flex flex-wrap gap-3 gap-sm-0 align-items-center justify-content-between">
                                    <span class="left-text"> <i class="rt-price-tag"></i> Offered Salary</span>
                                    <span class="text">: {{ $job->currency }} {{ $job->min_sal }} -
                                        {{ $job->max_sal }}</span>
                                </li>
                                <li class="d-flex flex-wrap gap-3 gap-sm-0 align-items-center justify-content-between">
                                    <span class="left-text"> <i class="rt-loading"></i> Job Deadline</span>
                                    <span class="text">: {{ \Carbon\Carbon::parse($job->jobexpiry)->format('d M Y') }}
                                    </span>
                                </li>
                                <li class="d-flex flex-wrap gap-3 gap-sm-0 align-items-center justify-content-between">
                                    <span class="left-text"> <i class="rt-qualification"></i> Qualification</span>
                                    <span class="text">: {{ $job->education }}</span>
                                </li>
                                <li class="d-flex flex-wrap gap-3 gap-sm-0 align-items-center justify-content-between">
                                    <span class="left-text"> <i class="fa-sharp fa-thin fa-location-dot"></i>
                                        Location</span>
                                    <span class="text">: {{ $job->location }}</span>
                                </li>
                                <li class="d-flex flex-wrap gap-3 gap-sm-0 align-items-center justify-content-between">
                                    <span class="left-text"> <i class="rt-user"></i> Gender</span>
                                    <span class="text">:
                                        @if ($job->diversity == 'All')
                                            All
                                        @elseif($job->diversity == 'Male')
                                            Male
                                        @elseif($job->diversity == 'Female')
                                            Female
                                        @else
                                            Not Specified
                                        @endif
                                    </span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- job list one end -->

@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script></script>
@endsection
