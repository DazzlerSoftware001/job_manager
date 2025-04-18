@extends('User.UserLayout.main')
@section('title')
    Jobs
@endsection
@section('main-container')
<script src="https://cdn.tiny.cloud/1/k73iszd3tzdamw58yk6fmdzasoe86nkkbzktvgqtvxvcrr17/tinymce/6/tinymce.min.js"
referrerpolicy="origin"></script>
   <!-- breadcrumb area -->
   <div class="rts__section breadcrumb__background">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 position-relative d-flex justify-content-between align-items-center">
                    <div class="breadcrumb__area max-content breadcrumb__padding">
                        <div class="rts__job__card__big bg-transparent p-0 position-relative z-1 flex-wrap justify-content-between d-flex gap-4 align-items-center">
                            <div class="d-flex gap-4 align-items-center flex-md-row flex-column mx-auto mx-md-0">
                                <div class="company__icon rounded-2 bg-white">
                                    {{-- <img src="{{ parse_url($job->com_logo, PHP_URL_PATH) ?? url('admin/logo/default.png')  }}"
                                                    alt=""> --}}
                                                    <img src="{{ $job->com_logo ? parse_url($job->com_logo, PHP_URL_PATH) : url('admin/logo/default.png') }}" alt="">
                                </div>
                                <div class="job__meta w-100 d-flex text-center text-md-start flex-column gap-2">
                                    <div class="">
                                        <h3 class="job__title h3 mb-0">{{$job->title}}</h3>
                                    </div>
                                    <div class="d-flex gap-3 justify-content-center justify-content-md-start flex-wrap mb-3 mt-2">
                                        <div class="d-flex gap-2 align-items-center">
                                            <i class="fa-light fa-location-dot"></i> {{$job->location}}
                                        </div>
                                        <div class="d-flex gap-2 align-items-center">
                                            <i class="fa-light rt-briefcase"></i> {{$job->type}}
                                        </div>
                                        <div class="d-flex gap-2 align-items-center">
                                            <i class="fa-light fa-clock"></i> {{ $job->created_at->diffForHumans() }}
                                        </div>
                                        <div class="d-flex gap-2 fw-medium align-items-center">
                                            <i class="fa-light rt-price-tag"></i> {{$job->currency}} {{$job->min_sal}} - {{$job->max_sal}}
                                        </div>
                                    </div>
                                    <div class="job__tags d-flex justify-content-center justify-content-md-start flex-wrap gap-3">
                                        @foreach(explode(',', $job->skills) as $skill)
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
                    <div class="rts__tab active__link mb-30">
                        <nav>
                            <div class="nav nav-tabs">
                                <a class="nav-link active" href="#all">All</a>
                                <a class="nav-link" href="#description">Job Description</a>
                                <a class="nav-link" href="#responsibility">Responsibilities</a>
                                <a class="nav-link" href="#requirements">Requirements</a>
                                <a class="nav-link" href="#skill">Skill & Experience</a>
                                <a class="nav-link" href="#salary">Salary & Benefits</a>
                            </div>
                        </nav>
                    </div>
                    <div class="job-description">
                        {!! html_entity_decode($job->job_desc) !!}

                    </div>
                    
                    {{--
                    <div id="description" class="mb-30">
                        <h6 class="fw-semibold mb-20">Job Description</h6>
                        <p>We are seeking a skilled Part-Time Software Engineer to join our team, specializing in social media content creation for lead generation purposes. The ideal candidate will have a creative flair, technical proficiency, and a strong understanding of social media trends and algorithms. Must be able to work Monday-Friday during EST business hours. This role will be under the ScaledOn brand, but will be working directly with one of our partners as their dedicated Software Engineer.</p>
                    </div>
                   
                     <div id="responsibility" class="mb-30">
                        <h6 class="fw-semibold mb-20">Responsibility</h6>
                        <ul class="list-style-dot">
                            <li>Design and build web and enterprise application using in ReactJS/Next JS/.Net Core</li>
                            <li>Collaborate with cross-functional teams to analyze, design, and implement new features.</li>
                            <li>Follow defined coding rules/conventions defined by the company.</li>
                            <li>Perform Unit test and ensure proper test coverage as per organizational standard.</li>
                            <li>Prepare basic design, detail design, execute basic acceptance testing.</li>
                            <li>Follow review process for peer review to code delivery.</li>
                            <li>Participate in defined meeting as per company policy.</li>
                            <li>Senior Software Engineer should pose mindset and ability to lead small team.</li>
                        </ul>
                    </div>
                    <div id="requirements" class="mb-30">
                        <h6 class="fw-semibold mb-20">Requirements</h6>
                        <ul class="list-style-dot">
                            <li>Excellent knowledge of Relational Databases MYSQL and ORM technologies (JPA, Hibernate).</li>
                            <li>Strong understanding on Object-Oriented analysis and design using common design patterns.</li>
                            <li>Need to know advanced in ReactJS/Next JS/.Net Core.</li>
                            <li>Practical experience in REST & RESTful web services.</li>
                            <li>Commanding knowledge on Maven, Gradle build tools.</li>
                            <li>Follow review process for peer review to code delivery.</li>
                            <li>Participate in defined meeting as per company policy.</li>
                            <li>Senior Software Engineer should pose mindset and ability to lead small team.</li>
                        </ul>
                    </div>
                    <div id="skill" class="mb-30">
                        <h6 class="fw-semibold mb-20">Skills and Experience</h6>
                        <div class="job__tags job__details__tags">
                            <a href="#" class="job__tag">Javascript</a>
                            <a href="#" class="job__tag">user interface</a>
                            <a href="#" class="job__tag">Problem Solving</a>
                        </div>
                    </div>
                    <div id="salary" class="mb-30">
                        <h6 class="fw-semibold mb-20">Salary and Benefits</h6>
                        <ul class="list-style-dot">
                            <li>Lunch Facilities: Full Subsidize</li>
                            <li>Salary Review: Yearly</li>
                            <li>Festival Bonus: 2</li>
                            <li>This will be a Night Shift work- Timing will be from 11.00 PM to 07.00 AM.</li>
                            <li>Weekend-Two Days</li>
                            <li>Monthly on time guaranteed payment</li>
                            <li>early Earned Leave, Sick Leave and Casual Leave facility and many more to come soon.</li>
                            <li>Salery: $1000- $2000 Monthly</li>
                        </ul>
                    </div> --}}

                    <div class="d-flex flex-wrap gap-4 mt-40 mb-30">
                        
                        <div class="d-flex gap-3 align-items-center">
                            <span class="h6 fw-semibold">Share</span>
                            <div class="rts__social d-flex gap-3">
                                <a target="_blank" href="https://facebook.com/"  aria-label="facebook">
                                    <i class="fa-brands fa-facebook"></i>
                                </a>
                                <a target="_blank" href="https://instagram.com/"  aria-label="instagram">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                                <a target="_blank" href="https://linkedin.com/"  aria-label="linkedin">
                                    <i class="fa-brands fa-linkedin"></i>
                                </a>
                                <a target="_blank" href="https://pinterest.com/"  aria-label="pinterest">
                                    <i class="fa-brands fa-pinterest"></i>
                                </a>
                                <a target="_blank" href="https://youtube.com/"  aria-label="youtube">
                                    <i class="fa-brands fa-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="job__location">
                    <h6 class="fw-semibold mb-30">Job Location</h6>
                    <div class="gmap height-500">
                        <iframe src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Reacthemes+(ReacThemes)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                    </div>
                </div>
               </div>
               <div class="col-lg-5 col-xl-4 d-flex flex-column gap-40">
                    <div class="job__overview">
                        <h6 class="fw-semibold mb-20">Job Overview</h6>
                        <div class="job__overview__content">
                            <ul>
                                <li class="d-flex flex-wrap gap-3 gap-sm-0 align-items-center justify-content-between">
                                    <span class="left-text"> <i class="rt-calender"></i> Date Posted</span>
                                    <span class="text">:  {{ $job->created_at->format('j M Y') }}</span>
                                </li>
                                <li class="d-flex flex-wrap gap-3 gap-sm-0 align-items-center justify-content-between">
                                    <span class="left-text"> <i class="rt-user"></i> Vacancy</span>
                                    <span class="text">: {{$job->vacancies}}</span>
                                </li>
                                <li class="d-flex flex-wrap gap-3 gap-sm-0 align-items-center justify-content-between">
                                    <span class="left-text"> <i class="rt-experience"></i> Experience</span>
                                    <span class="text">: {{$job->min_exp}} years - {{$job->max_exp}} years</span>
                                </li>
                                <li class="d-flex flex-wrap gap-3 gap-sm-0 align-items-center justify-content-between">
                                    <span class="left-text"> <i class="rt-price-tag"></i> Offered Salary</span>
                                    <span class="text">: {{$job->currency}} {{$job->min_sal}} - {{$job->max_sal}}</span>
                                </li>
                                <li class="d-flex flex-wrap gap-3 gap-sm-0 align-items-center justify-content-between">
                                    <span class="left-text"> <i class="rt-loading"></i> Job Deadline</span>
                                    <span class="text">: 01 July 2024</span>
                                </li>
                                <li class="d-flex flex-wrap gap-3 gap-sm-0 align-items-center justify-content-between">
                                    <span class="left-text"> <i class="rt-qualification"></i> Qualification</span>
                                    <span class="text">: {{$job->education}}</span>
                                </li>
                                <li class="d-flex flex-wrap gap-3 gap-sm-0 align-items-center justify-content-between">
                                    <span class="left-text"> <i class="fa-sharp fa-thin fa-location-dot"></i> Location</span>
                                    <span class="text">: {{$job->location}}</span>
                                </li>
                                <li class="d-flex flex-wrap gap-3 gap-sm-0 align-items-center justify-content-between">
                                    <span class="left-text"> <i class="rt-user"></i> Gender</span>
                                    <span class="text">: 
                                        @if($job->diversity == 'All')
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
                    <div class="video__section ">
                        <h6 class="mb-30 d-block fw-semibold">Job apply Process video</h6>
                        <div class="video__section__content style__two">
                            <img src="assets/img/pages/video-bg.webp" alt="">
                            <a href="https://www.youtube.com/watch?v=C9U1U15GSlM" class="video__play__btn" title="Play Video" data-lightbox>
                                <i class="fa-sharp fa-solid fa-play"></i>
                            </a>
                        </div>
                    </div>
                    <div class="job__contact">
                        <h6 class="fw-semibold mb-20">Contact apple.com</h6>
                        <form action="#" class="d-flex flex-column gap-4">
                            <div class="search__item">
                                <label for="gemail" class="mb-3 font-20 fw-medium text-dark text-capitalize">Your Email</label>
                                <div class="position-relative">
                                    <input type="email" id="gemail" placeholder="Enter your email">
                                    <i class="rt-mailbox"></i>
                                </div>
                            </div>

                            <div class="search__item">
                                <label for="phone" class="mb-3 font-20 fw-medium text-dark text-capitalize">Phone</label>
                                <div class="position-relative">
                                    <input type="text" id="phone" placeholder="(+88)154-678789">
                                    <i class="rt-phone"></i>
                                </div>
                            </div>
                            <div class="search__item">
                                <label class="mb-3 font-20 fw-medium text-dark text-capitalize" for="message">Your Message</label>
                                <textarea name="message" id="message" placeholder="Message"></textarea>
                                <i class="fa-thin fa-comment-lines"></i>
                            </div>
                            <button type="submit" class="rts__btn apply__btn w-100">Send a Message</button>
                        </form>
                    </div>
                    <div class="recent__post">
                        <h6 class="fw-semibold mb-30">Recent Job Post</h6>
                        <div class="d-flex flex-column gap-30">
                            <div class="d-flex gap-4 align-items-center flex-sm-row flex-column mx-auto mx-sm-0">
                                <div class="company__icon recent__post">
                                    <img class="" src="assets/img/home-1/company/apple.svg" alt="">
                                </div>
                                <div class="job__meta w-100 d-flex text-center text-sm-start flex-column gap-2">
                                    <div class="">
                                        <a href="#" class="job__title h6 fw-semibold mb-0">Senior UI Designer, Apple</a>
                                    </div>
                                    <div class="d-flex gap-3 justify-content-center justify-content-sm-start flex-wrap">
                                        <div class="d-flex gap-2 align-items-center">
                                            <i class="fa-light fa-location-dot"></i> Newyork, USA
                                        </div>
                                        <div class="d-flex gap-2 align-items-center">
                                            <i class="fa-light rt-briefcase"></i> Full Time
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-4 align-items-center flex-sm-row flex-column mx-auto mx-sm-0">
                                <div class="company__icon recent__post">
                                    <img class="" src="assets/img/home-1/company/amazon.svg" alt="">
                                </div>
                                <div class="job__meta w-100 d-flex text-center text-sm-start flex-column gap-2">
                                    <div class="">
                                        <a href="#" class="job__title h6 fw-semibold mb-0">Data Analysis, Amazon</a>
                                    </div>
                                    <div class="d-flex gap-3 justify-content-center justify-content-sm-start flex-wrap">
                                        <div class="d-flex gap-2 align-items-center">
                                            <i class="fa-light fa-location-dot"></i> Newyork, USA
                                        </div>
                                        <div class="d-flex gap-2 align-items-center">
                                            <i class="fa-light rt-briefcase"></i> Full Time
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-4 align-items-center flex-sm-row flex-column mx-auto mx-sm-0">
                                <div class="company__icon recent__post">
                                    <img class="" src="assets/img/home-1/company/udemy.svg" alt="">
                                </div>
                                <div class="job__meta w-100 d-flex text-center text-sm-start flex-column gap-2">
                                    <div class="">
                                        <a href="#" class="job__title h6 fw-semibold mb-0">Online Trainer, Udemy</a>
                                    </div>
                                    <div class="d-flex gap-3 justify-content-center justify-content-sm-start flex-wrap">
                                        <div class="d-flex gap-2 align-items-center">
                                            <i class="fa-light fa-location-dot"></i> Newyork, USA
                                        </div>
                                        <div class="d-flex gap-2 align-items-center">
                                            <i class="fa-light rt-briefcase"></i> Full Time
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </div>
    <!-- job list one end -->

    <!-- app center -->
    
    <div class="rts__section pb-120">
        <div class="container">
            <div class="row">
                <div class="rts__appcenter">
                    <div class="rts__appcenter__shape">
                        <img src="assets/img/home-1/app/shape.png" alt="">
                    </div>
                    <div class="rts__appcenter__content d-flex flex-wrap flex-xl-nowrap align-items-center justify-content-between justify-content-lg-center">
                        <div class="content__left align-items-end d-flex position-relative top-15px">
                            <img src="assets/img/home-1/app/app_screen.png" alt="">
                        </div>
                        <div class="content__right text-white text-center text-xl-start max-630">
                            <h3 class="l--1 mb-4 text-white wow animated fadeInUp" data-wow-delay=".1s ">Download The app Free!</h3>
                            <p class="wow animated fadeInUp" data-wow-delay=".2s">Looking for a new job can be both exciting and daunting. Navigating the job market involves exploring various avenues.</p>
                            <div class="d-flex gap-3 justify-content-center justify-content-xl-start flex-wrap mt-40 wow animated fadeInUp" data-wow-delay=".3s">
                                <div class="link">
                                    <a href="https://appstore.com/" target="_blank" title="app store">
                                        <img src="assets/img/home-1/app/app-store.svg" alt="">
                                    </a>
                                </div>
                                <div class="link">
                                    <a href="https://google.com/" target="_blank" title="play store">
                                        <img src="assets/img/home-1/app/play-store.svg" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <!-- app center end -->


@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    </script>


@endsection 