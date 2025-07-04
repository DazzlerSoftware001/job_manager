@extends('User.UserLayout.main')
@section('title')
    Home
@endsection
@section('main-container')
    <!-- banner area -->
    <section class="rts__banner home__one__banner pt-260">
        <div class="rts__banner__background">
            <div class="shape__home__one __first d-none d-lg-block">
                <img src="{{ url('user/assets/img/home-1/banner/banner-shape.svg') }}" alt="">
            </div>
            <div class="shape__home__one __second d-none d-lg-block">
                <img src="{{ url('user/assets/img/home-1/banner/banner-shape-2.svg') }}" alt="">
            </div>
            <div class="shape__home__one __third">
            </div>
        </div>
        <div class="container">
            <div class="row pb-5">
                <div class="rts__banner__wrapper d-flex gap-4 justify-content-between ">
                    <div class="rts__banner__content">
                        <h1 class="rts__banner__title wow animated fadeInUp ">
                            {{ $HomeSection->banner_title ?? 'Find Your Perfect Dream Job With' }}
                            <span>careernext</span>
                        </h1>
                        <p class="rts__banner__desc my-40 wow animated fadeInUp" data-wow-delay=".1s">
                            @if ($HomeSection !== null && $HomeSection->banner_desc !== null)
                                {{ $HomeSection->banner_desc }}
                            @else
                                Looking for a new job can be both exciting and daunting. Navigating the job market involves
                                exploring various avenues, including online job boards.
                            @endif

                        </p>
                        @if ($HomeSection === null || $HomeSection->banner_filter == 1)
                            <div class="rts__job__search wow animated fadeInUp mb-5" data-wow-delay=".2s">
                                <form action="{{ route('User.JobList') }}" method="GET"
                                    class="d-flex align-items-center flex-wrap flex-md-nowrap flex-lg-wrap flex-xl-nowrap gap-4 gap-xl-0 justify-content-between">
                                    <div class="input-group flex-wrap d-flex gap-4">
                                        <div class="single__input d-flex flex-column">
                                            <label for="location">location</label>
                                            <select name="location" class="select-nice" id="location">
                                                <option value="Nothing" selected disabled>Search Location</option>
                                                @foreach ($location as $value)
                                                    <option value="{{ $value->location }}">{{ $value->location }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="vr d-none d-sm-block"></div>
                                        <div class="single__input d-flex flex-column">
                                            <label for="job__type">job type</label>
                                            <select name="job_type" class="select-nice" id="job__type">
                                                <option value="Nothing" selected disabled>Select Job Type</option>
                                                @foreach ($type as $value)
                                                    <option value="{{ $value->type }}">{{ $value->type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="rts__btn gap-2 fill__btn job__search"
                                        aria-label="Search"><i class="fa-light fa-magnifying-glass"></i> Search Job</button>

                                </form>
                            </div>
                        @endif
                    </div>
                    <div class="rts__banner__image position-relative">
                        <figure class="banner__image">
                            @if ($HomeSection !== null && $HomeSection->banner_image !== null)
                                <img src="{{ asset($HomeSection->banner_image) }}" alt="">
                            @else
                                <img src="{{ url('user/assets/img/home-1/banner/image_2x.webp') }}" alt="banner"
                                    width="100%" height="100%">
                            @endif
                        </figure>
                        <div class="banner__image__shape">
                            <div class="facebook">
                                <i class="fab fa-facebook"></i>
                            </div>
                            <div class="twitter">
                                <i class="fab fa-twitter"></i>
                            </div>
                            <div class="linkedin">
                                <i class="fab fa-linkedin-in"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner area end -->
    <!-- work process area -->
    @if ($WorkProcessSectionSettings == null || $WorkProcessSectionSettings->show_section !== '0')
        <section class="rts__section section__padding">
            <div class="container">
                <div class="row justify-content-center mb-60">
                    <div class="col-xl-6 col-lg-10">
                        <div class="rts__section__content text-center wow animated fadeInUp">
                            <h3 class="rts__section__title section__mb">
                                {{ $WorkProcessSectionSettings->work_title ?? 'How careernext Works' }}</h3>
                            <p class="rts__section__desc">
                                {{ $WorkProcessSectionSettings->work_message ?? 'Our job board offers a wide range' }}</p>
                        </div>
                    </div>
                </div>

                <div class="row g-30 justify-content-center">
                    @if (!empty($WorkProcessSectionSettings->cards))
                        @foreach ($WorkProcessSectionSettings->cards as $card)
                            <div class="col-lg-4 col-md-10 wow animated fadeInUp" data-wow-delay=".1s">
                                <div class="rts__workprocess__box">
                                    <div class="rts__icon">
                                        {{-- <img src="{{ url('user/assets/img/home-1/process/icon-1.svg') }}" alt=""> --}}
                                        <img src="{{ asset($card['icon']) }}" alt="">
                                    </div>
                                    <span
                                        class="process__title h6 d-block">{{ $card['title'] ?? 'Create a Free Account' }}</span>
                                    <p> {{ $card['description'] ??
                                        'Consectetur adipisicing elit. Possimus
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    aut mollitia eum ipsum fugiat odio officiis odit mollitia eum ipsum.' }}
                                    </p>
                                    <div class="work__readmore mt-3">
                                        <a href="#">{{ $card['button_text'] ?? 'Read More' }} <i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center">No news found.</p>
                    @endif
                    {{-- <div class="col-lg-4 col-md-10 wow animated fadeInUp" data-wow-delay=".2s">
                    <div class="rts__workprocess__box">
                        <div class="rts__icon">
                            <img src="{{ url('user/assets/img/home-1/process/icon-2.svg') }}" alt="">
                        </div>
                        <span class="process__title h6 d-block">Make Your Resume Amazing</span>
                        <p>Consectetur adipisicing elit. Possimus
                            aut mollitia eum ipsum fugiat odio officiis odit mollitia eum ipsum.
                        </p>
                        <div class="work__readmore mt-3">
                            <a href="#">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-10 wow animated fadeInUp" data-wow-delay=".3s">
                    <div class="rts__workprocess__box">
                        <div class="rts__icon">
                            <img src="{{ url('user/assets/img/home-1/process/icon-3.svg') }}" alt="">
                        </div>
                        <span class="process__title h6 d-block">Apply job</span>
                        <p>Consectetur adipisicing elit. Possimus
                            aut mollitia eum ipsum fugiat odio officiis odit mollitia eum ipsum.
                        </p>
                        <div class="work__readmore mt-3">
                            <a href="#">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div> --}}

                </div>
            </div>
        </section>
    @endif
    <!-- work process area end -->

    <!-- brand area -->
    @if ($BrandSectionSetting == null || $BrandSectionSetting->show_section !== '0')
        <div class="rts__section rts__brand mt-5 pb-120 pt-50 text-center">
            <div class="container">
                <div class="row">
                    <div class="section__title mb-40">
                        <span
                            class="h6 d-block fw-semibold">{{ $BrandSectionSetting->title ?? 'Trusted by 300+ leading companies' }}</span>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="rts__brand__slider overflow-hidden swiper-data"
                        data-swiper='{
                        "slidesPerView":7,
                        "loop": true,
                        "speed": 1000,
                        "autoplay":{
                            "delay":"7000"
                        },

                        "breakpoints": {
                            "0": {
                                "slidesPerView": 2
                            },
                            "480": {
                                "slidesPerView": 3
                            },
                            "768": {
                                "slidesPerView": 4
                            },
                            "1024": {
                                "slidesPerView": 4
                            },
                            "1200": {
                                "slidesPerView": 6
                            },
                            "1400": {
                                "slidesPerView": 7
                            }
                        }

                    }'>
                        <div class="swiper-wrapper">
                            @if (!empty($BrandSectionSetting->logos))
                                @foreach ($BrandSectionSetting->logos as $logo)
                                    <div class="swiper-slide">
                                        <div class="brand__item">
                                            <a href="#" class="brand__item__link" aria-label="brand">
                                                <img src="{{ url($logo) }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="swiper-slide">
                                    <div class="brand__item">
                                        <a href="#" class="brand__item__link" aria-label="brand">
                                            <img src="{{ url('user/assets/img/home-1/brand/b51.svg') }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="brand__item">
                                        <a href="#" class="brand__item__link" aria-label="brand">
                                            <img src="{{ url('user/assets/img/home-1/brand/image1.svg') }}"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="brand__item">
                                        <a href="#" class="brand__item__link" aria-label="brand">
                                            <img src="{{ url('user/assets/img/home-1/brand/image2.svg') }}"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="brand__item">
                                        <a href="#" class="brand__item__link" aria-label="brand">
                                            <img src="{{ url('user/assets/img/home-1/brand/image3.svg') }}"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="brand__item">
                                        <a href="#" class="brand__item__link" aria-label="brand">
                                            <img src="{{ url('user/assets/img/home-1/brand/image4.svg') }}"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="brand__item">
                                        <a href="#" class="brand__item__link" aria-label="brand">
                                            <img src="{{ url('user/assets/img/home-1/brand/image5.svg') }}"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="brand__item">
                                        <a href="#" class="brand__item__link" aria-label="brand">
                                            <img src="{{ url('user/assets/img/home-1/brand/image1.svg') }}"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="brand__item">
                                        <a href="#" class="brand__item__link" aria-label="brand">
                                            <img src="{{ url('user/assets/img/home-1/brand/linkedin-logo-png-20321.svg') }}"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- brand area end -->

    <!-- cat slider -->
    {{-- <div class="rts__section overflow-hidden cat__slider__bg pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-between mb-50 gap-4 position-relative mtn-1">
                <div class="col-xl-6 col-lg-10">
                    <div class="rts__section__content text-start wow animated fadeInUp">
                        <h3 class="rts__section__title section__mb">Browse Job Category</h3>
                        <p class="rts__section__desc">Looking for your next career opportunity. Look no further</p>
                    </div>
                </div>
                <div
                    class="rts__slider__control align-items-end 
                    position-relative position-md-absolute right-md-0 bottom-md-0 z-3 d-flex gap-2 max-contnet">
                    <div class="rts__slide__next slider__btn"><i class="fa-sharp fa-solid fa-chevron-left"></i></div>
                    <div class="rts__slide__prev slider__btn"><i class="fa-sharp fa-solid fa-chevron-right"></i></div>
                </div>
            </div>
            <div class="row">
                <div class="cat__slider overflow-hidden swiper-data @@style"
                    data-swiper='
                {
                "slidesPerView": 4, 
                "spaceBetween": 30,
                "loop": true,
                "speed": 1000,
                "autoplay":{
                    "delay":"7000"
                },
                "pagination": {
                    "el": ".rts__pagination",
                    "clickable": true
                },
                "navigation": {
                    "nextEl": ".rts__slide__next",
                    "prevEl": ".rts__slide__prev"
                },
                "breakpoints": {
                    "0": {
                        "slidesPerView": 1
                    },
                    "490": {
                        "slidesPerView": 1.5
                    },
                    "768": {
                        "slidesPerView": 2
                    },
                    "1024": {
                        "slidesPerView": 3
                    },
                    "1200": {
                        "slidesPerView": 3.5
                    },
                    "1400": {
                        "slidesPerView": 4
                    }
                }

            }'>
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="single__cat d-flex gap-4">
                                <div class="single__cat__icon color-1">
                                    <img src="{{ url('user/assets/img/home-1/cat/1.svg') }}" alt="">
                                </div>
                                <div class="single__cat__link d-flex flex-column">
                                    <a href="job-list-1.html" aria-label="cat__label">Development</a>
                                    <span>130+ Jobs</span>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="single__cat d-flex gap-4">
                                <div class="single__cat__icon color-2">
                                    <img src="{{ url('user/assets/img/home-1/cat/2.svg') }}" alt="">
                                </div>
                                <div class="single__cat__link d-flex flex-column">
                                    <a href="job-list-1.html" aria-label="cat__label">Design &amp; arts</a>
                                    <span>130+ Jobs</span>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="single__cat d-flex gap-4">
                                <div class="single__cat__icon color-3">
                                    <img src="{{ url('user/assets/img/home-1/cat/3.svg') }}" alt="">
                                </div>
                                <div class="single__cat__link d-flex flex-column">
                                    <a href="job-list-1.html" aria-label="cat__label">Accounting</a>
                                    <span>130+ Jobs</span>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="single__cat d-flex gap-4">
                                <div class="single__cat__icon color-4">
                                    <img src="{{ url('user/assets/img/home-1/cat/4.svg') }}" alt="">
                                </div>
                                <div class="single__cat__link d-flex flex-column">
                                    <a href="job-list-1.html" aria-label="cat__label">Marketting</a>
                                    <span>130+ Jobs</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- cat slider end -->

    <!-- current open position -->
    {{-- <section class="rts__section section__padding">
        <div class="container">
            <div class="row justify-content-center mb-60">
                <div class="col-xl-6 col-lg-10">
                    <div class="rts__section__content text-center wow animated fadeInUp">
                        <h3 class="rts__section__title section__mb">There Are More Then 1000+ Jobs in careernext</h3>
                        <p class="rts__section__desc">From entry-level positions to executive roles browse through.</p>
                    </div>
                </div>
            </div>
            <div class="row g-30 wow animated fadeInUp" data-wow-delay=".0s">
                <!-- single job -->
                <div class="col-lg-6 col-xl-4 col-md-6">
                    <div class="rts__job__card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="company__icon">
                                <img src="{{ url('user/assets/img/home-1/company/apple.svg') }}" alt="">
                            </div>
                            <div class="featured__option">
                                <span>Featured</span>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mt-4 flex-wrap">
                            <div class="d-flex gap-1 align-items-center">
                                <i class="fa-light fa-location-dot"></i> Newyork, USA
                            </div>
                            <div class="d-flex gap-1 align-items-center">
                                <i class="fa-light fa-briefcase"></i> Full Time
                            </div>
                        </div>
                        <div class="h6 job__title my-3">
                            <a href="job-details-1.html" aria-label="job">
                                Senior UI Designer, Apple
                            </a>
                        </div>
                        <p>Consectetur adipisicing elit. Possimus
                            aut mollitia eum ipsum fugiat odio officiis odit mollitia eum ipsum.
                        </p>
                        <div class="job__tags d-flex flex-wrap gap-3 mt-4">
                            <a href="#">Creative</a>
                            <a href="#">user interface</a>
                            <a href="#">web ui</a>
                        </div>
                    </div>
                </div>
                <!-- single job end -->
                <!-- single job -->
                <div class="col-lg-6 col-xl-4 col-md-6">
                    <div class="rts__job__card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="company__icon">
                                <img src="{{ url('user/assets/img/home-1/company/google.svg') }}" alt="">
                            </div>
                            <div class="featured__option">

                            </div>
                        </div>
                        <div class="d-flex gap-3 mt-4 flex-wrap">
                            <div class="d-flex gap-1 align-items-center">
                                <i class="fa-light fa-location-dot"></i> Newyork, USA
                            </div>
                            <div class="d-flex gap-1 align-items-center">
                                <i class="fa-light fa-briefcase"></i> Full Time
                            </div>
                        </div>
                        <div class="h6 job__title my-3">
                            <a href="job-details-1.html" aria-label="job">
                                Senior UX Designer, Google
                            </a>
                        </div>
                        <p>Consectetur adipisicing elit. Possimus
                            aut mollitia eum ipsum fugiat odio officiis odit mollitia eum ipsum.
                        </p>
                        <div class="job__tags d-flex flex-wrap gap-3 mt-4">
                            <a href="#">Creative</a>
                            <a href="#">user interface</a>
                            <a href="#">web ui</a>
                        </div>
                    </div>
                </div>
                <!-- single job end -->
                <!-- single job -->
                <div class="col-lg-6 col-xl-4 col-md-6">
                    <div class="rts__job__card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="company__icon">
                                <img src="{{ url('user/assets/img/home-1/company/microsoft.svg') }}" alt="">
                            </div>
                            <div class="featured__option">

                            </div>
                        </div>
                        <div class="d-flex gap-3 mt-4 flex-wrap">
                            <div class="d-flex gap-1 align-items-center">
                                <i class="fa-light fa-location-dot"></i> Newyork, USA
                            </div>
                            <div class="d-flex gap-1 align-items-center">
                                <i class="fa-light fa-briefcase"></i> Full Time
                            </div>
                        </div>
                        <div class="h6 job__title my-3">
                            <a href="job-details-1.html" aria-label="job">
                                Software Engineer, Apple
                            </a>
                        </div>
                        <p>Consectetur adipisicing elit. Possimus
                            aut mollitia eum ipsum fugiat odio officiis odit mollitia eum ipsum.
                        </p>
                        <div class="job__tags d-flex flex-wrap gap-3 mt-4">
                            <a href="#">Creative</a>
                            <a href="#">user interface</a>
                            <a href="#">web ui</a>
                        </div>
                    </div>
                </div>
                <!-- single job end -->
                <!-- single job -->
                <div class="col-lg-6 col-xl-4 col-md-6">
                    <div class="rts__job__card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="company__icon">
                                <img src="{{ url('user/assets/img/home-1/company/upwork.svg') }}" alt="">
                            </div>
                            <div class="featured__option">
                                <span>Upcoming</span>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mt-4 flex-wrap">
                            <div class="d-flex gap-1 align-items-center">
                                <i class="fa-light fa-location-dot"></i> Newyork, USA
                            </div>
                            <div class="d-flex gap-1 align-items-center">
                                <i class="fa-light fa-briefcase"></i> Full Time
                            </div>
                        </div>
                        <div class="h6 job__title my-3">
                            <a href="job-details-1.html" aria-label="job">
                                Web developer, Upwork
                            </a>
                        </div>
                        <p>Consectetur adipisicing elit. Possimus
                            aut mollitia eum ipsum fugiat odio officiis odit mollitia eum ipsum.
                        </p>
                        <div class="job__tags d-flex flex-wrap gap-3 mt-4">
                            <a href="#">Creative</a>
                            <a href="#">user interface</a>
                            <a href="#">web ui</a>
                        </div>
                    </div>
                </div>
                <!-- single job end -->
                <!-- single job -->
                <div class="col-lg-6 col-xl-4 col-md-6">
                    <div class="rts__job__card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="company__icon">
                                <img src="{{ url('user/assets/img/home-1/company/facebook.svg') }}" alt="">
                            </div>
                            <div class="featured__option">

                            </div>
                        </div>
                        <div class="d-flex gap-3 mt-4 flex-wrap">
                            <div class="d-flex gap-1 align-items-center">
                                <i class="fa-light fa-location-dot"></i> Newyork, USA
                            </div>
                            <div class="d-flex gap-1 align-items-center">
                                <i class="fa-light fa-briefcase"></i> Full Time
                            </div>
                        </div>
                        <div class="h6 job__title my-3">
                            <a href="job-details-1.html" aria-label="job">
                                Digital Marketing, Facebook
                            </a>
                        </div>
                        <p>Consectetur adipisicing elit. Possimus
                            aut mollitia eum ipsum fugiat odio officiis odit mollitia eum ipsum.
                        </p>
                        <div class="job__tags d-flex flex-wrap gap-3 mt-4">
                            <a href="#">Creative</a>
                            <a href="#">user interface</a>
                            <a href="#">web ui</a>
                        </div>
                    </div>
                </div>
                <!-- single job end -->
                <!-- single job -->
                <div class="col-lg-6 col-xl-4 col-md-6">
                    <div class="rts__job__card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="company__icon">
                                <img src="{{ url('user/assets/img/home-1/company/in.svg') }}" alt="">
                            </div>
                            <div class="featured__option">
                                <span>Featured</span>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mt-4 flex-wrap">
                            <div class="d-flex gap-1 align-items-center">
                                <i class="fa-light fa-location-dot"></i> Newyork, USA
                            </div>
                            <div class="d-flex gap-1 align-items-center">
                                <i class="fa-light fa-briefcase"></i> Full Time
                            </div>
                        </div>
                        <div class="h6 job__title my-3">
                            <a href="job-details-1.html" aria-label="job">
                                Senior UI Designer, Apple
                            </a>
                        </div>
                        <p>Consectetur adipisicing elit. Possimus
                            aut mollitia eum ipsum fugiat odio officiis odit mollitia eum ipsum.
                        </p>
                        <div class="job__tags d-flex flex-wrap gap-3 mt-4">
                            <a href="#">Creative</a>
                            <a href="#">user interface</a>
                            <a href="#">web ui</a>
                        </div>
                    </div>
                </div>
                <!-- single job end -->
            </div>
        </div>
    </section> --}}
    <!-- current open position end -->

    <!-- what we are -->
    @if ($WhatWeAreSectionSettings == null || $WhatWeAreSectionSettings->show_section !== '0')
        <div class="rts__section pb-120">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-5">
                        <div class="rts__image__section">
                            @if (!empty($WhatWeAreSectionSettings->section_image))
                                <img src="{{ asset($WhatWeAreSectionSettings->section_image) }}" alt="">
                            @else
                                <img src="{{ url('user/assets/img/home-1/we-are/image.webp') }}" alt="">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="rts__content__section ms-lg-4 ms-md-0 wow animated fadeInUp">
                            <h3 class="fw-bold mb-4">{{ $WhatWeAreSectionSettings->title ?? 'Why We Are Most Popular' }}
                            </h3>
                            <p>{{ $WhatWeAreSectionSettings->description ?? 'Whether you\'re an experienced professional or a fresh graduate eager to dive into the workforce, we have something for everyone. From tech wizards to marketing mavens, finance gurus to creative minds, our diverse range of listings caters to a variety of skills and interests.' }}
                            </p>

                            <div class="mt-40 rts__listing">
                                @if (!empty($WhatWeAreSectionSettings->points))
                                    @foreach ($WhatWeAreSectionSettings->points as $point)
                                        <div class="single__listing d-flex align-items-center gap-4">
                                            <span class="icon">
                                                <i class="fa-regular fa-check"></i>
                                            </span>
                                            <span>{{ $point }}</span>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="single__listing d-flex align-items-center gap-4">
                                        <span class="icon">
                                            <i class="fa-regular fa-check"></i>
                                        </span>
                                        <span>Reach 100s contacts</span>
                                    </div>
                                    <div class="single__listing d-flex align-items-center gap-4">
                                        <span class="icon">
                                            <i class="fa-regular fa-check"></i>
                                        </span>
                                        <span>No Extra Charge</span>
                                    </div>
                                    <div class="single__listing d-flex align-items-center gap-4">
                                        <span class="icon">
                                            <i class="fa-regular fa-check"></i>
                                        </span>
                                        <span>Internation job </span>
                                    </div>
                                @endif
                            </div>

                            <a href="job-list-2.html" class="rts__btn common__btn  fill__btn mt-50">
                                {{ $WhatWeAreSectionSettings->button_text ?? 'Explore More' }}
                                <i class="fa-regular fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- what we are end -->

    <!-- testimonial section -->
    <div class="rts__section section__padding rts__testimonial__background">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-10">
                    <div class="rts__section__content text-center wow animated fadeInUp mb-60">
                        <h3 class="rts__section__title section__mb">What Our Customer Saying</h3>
                        <p class="rts__section__desc">Looking for your next career opportunity. Look no further</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="rts__testimonial__active overflow-hidden swiper-data"
                        data-swiper='{
                            "slidesPerView": 1,
                            "autoplay": true,
                            "loop": true,
                            "navigation": {
                                "nextEl": ".rts__slide__next",
                                "prevEl": ".rts__slide__prev"
                            }
                        }'>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="rts__single__testimonial text-center">
                                    <div class="rts__quote mb-40">
                                        <img class="opacity-50" src="{{ url('user/assets/img/icon/quote.svg') }}"
                                            alt="">
                                    </div>
                                    <div class="testimonial__text h6    ">Contrary to popular belief, Lorem Ipsum is not
                                        simply random text. It has roots in a piece of classical Latin literature from 45
                                        BC, making it over 2000 years old. Richard McClintock, a Latin professor at
                                        Hampden-Sydney College in Virginia</div>
                                    <div
                                        class="d-flex align-items-center justify-content-center mx-auto gap-3 pt-40 max-content">
                                        <div class="author__image">
                                            <img src="{{ url('user/assets/img/home-1/testimonial/author.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="author__content text-start">
                                            <span class="h6">Alexander Joy</span>
                                            <p>Web Developer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="rts__single__testimonial text-center">
                                    <div class="rts__quote mb-40">
                                        <img class="opacity-50" src="{{ url('user/assets/img/icon/quote.svg') }}"
                                            alt="">
                                    </div>
                                    <div class="testimonial__text h6    ">Contrary to popular belief, Lorem Ipsum is not
                                        simply random text. It has roots in a piece of classical Latin literature from 45
                                        BC, making it over 2000 years old. Richard McClintock, a Latin professor at
                                        Hampden-Sydney College in Virginia</div>
                                    <div
                                        class="d-flex align-items-center justify-content-center mx-auto gap-3 pt-40 max-content">
                                        <div class="author__image">
                                            <img src="{{ url('user/assets/img/home-1/testimonial/author.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="author__content text-start">
                                            <span class="h6">Alexander Joy</span>
                                            <p>Web Developer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="rts__slider__control d-lg-flex justify-content-between g-0 position-absolute top-50  translate-middle-y d-none">
                    <div class="rts__slide__next slider__btn"><i class="fa-sharp fa-solid fa-chevron-left"></i></div>
                    <div class="rts__slide__prev slider__btn"><i class="fa-sharp fa-solid fa-chevron-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    <!-- testimonial section end -->

    <!-- funfact section -->
    <div class="rts__section section__padding">
        <div class="container">
            <div class="row g-30 justify-content-center wow animated slideInUp">
                <div class="col-lg-3 col-md-6">
                    <div class="rts__single__counter">
                        <h2 class="fw-bold ms-lg-3 mx-auto heading__color"><span class="counter">20</span>K</h2>
                        <p class="h6 mb-0 fw-semibold">Happy Employer</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="rts__single__counter">
                        <h2 class="fw-bold ms-lg-3 mx-auto heading__color"><span class="counter">11</span>K</h2>
                        <p class="h6 mb-0 fw-semibold">Opening Position</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="rts__single__counter">
                        <h2 class="fw-bold ms-lg-3 mx-auto heading__color"><span class="counter">1</span>M</h2>
                        <p class="h6 mb-0 fw-semibold">Daily active users</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="rts__single__counter">
                        <h2 class="fw-bold ms-lg-3 mx-auto heading__color"><span class="counter">100</span>+</h2>
                        <p class="h6 mb-0 fw-semibold">Job Categories</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- funfact section end -->

    <!-- pricing section -->
    {{-- <div class="rts__section pt--10">
        <div class="container">
            <div class="row position-relative justify-content-lg-between justify-content-sm-center gap-4 mb-60">
                <div class="col-xl-6 col-lg-10">
                    <div class="rts__section__content text-md-start text-sm-center">
                        <h3 class="rts__section__title section__mb">Pricing Plan</h3>
                        <p class="rts__section__desc">Looking for your next career opportunity.</p>
                    </div>
                </div>
                <div class="d-flex align-items-end max-content gap-2 position-lg-absolute right-md-0 bottom-md-0">
                    <p class="mb-0">Monthly</p>
                    <label for="pricing__toogle" class="switch">
                        <input type="checkbox" name="pricing__toogle" class="pricing__toogle" id="pricing__toogle" />
                        <span class="slider round"></span>
                    </label>
                    <p class="mb-0">Yearly</p>
                </div>

            </div>

            <div class="monthly__pricing active">
                <div class="row g-30">
                    <div class="col-lg-5 col-xl-4 col-md-6">
                        <div class="rts__pricing__box">
                            <div class="h6 fw-medium lh-1 mb-2 text-primary">Free</div>
                            <div class="plan__price lh-1 mb-40"><span class="h2">Free/</span>Month</div>
                            <ul class="plan__feature">
                                <li><i class="fa-sharp fa-solid fa-check"></i> Unlimited access to 100+ Job</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> 10+ Featured job</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Job duration for 30 days</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Get 10+ job</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Try for free, forever!</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Individual Job</li>
                            </ul>
                            <a href="#" class="rts__btn pricing__btn  no__fill__btn mt-40">Get Started Now</a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-4 col-md-6">
                        <div class="rts__pricing__box">
                            <div class="h6 fw-medium lh-1 mb-2 text-primary">Basic</div>
                            <div class="plan__price lh-1 mb-40"><span class="h2">99$/</span>Month</div>
                            <ul class="plan__feature">
                                <li><i class="fa-sharp fa-solid fa-check"></i> Unlimited access to 100+ Job</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> 10+ Featured job</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Job duration for 30 days</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Get 10+ job</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Try for free, forever!</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Individual Job</li>
                            </ul>
                            <a href="#" class="rts__btn pricing__btn  no__fill__btn mt-40">Get Started Now</a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-4 col-md-6">
                        <div class="rts__pricing__box">
                            <div class="h6 fw-medium lh-1 mb-2 text-primary">Standard</div>
                            <div class="plan__price lh-1 mb-40"><span class="h2">199$/</span>Month</div>
                            <ul class="plan__feature">
                                <li><i class="fa-sharp fa-solid fa-check"></i> Unlimited access to 100+ Job</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> 10+ Featured job</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Job duration for 30 days</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Get 10+ job</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Try for free, forever!</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Individual Job</li>
                            </ul>
                            <a href="#" class="rts__btn pricing__btn  no__fill__btn mt-40">Get Started Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="yearly__pricing">
                <div class="row g-30">
                    <div class="col-lg-5 col-xl-4 col-md-6">
                        <div class="rts__pricing__box">
                            <div class="h6 fw-medium lh-1 mb-2 text-primary">Free</div>
                            <div class="plan__price lh-1 mb-40"><span class="h2">Free/</span>Yearly</div>
                            <ul class="plan__feature">
                                <li><i class="fa-sharp fa-solid fa-check"></i> Unlimited access to 100+ Job</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> 10+ Featured job</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Job duration for 30 days</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Get 10+ job</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Try for free, forever!</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Individual Job</li>
                            </ul>
                            <a href="#" class="rts__btn pricing__btn  no__fill__btn mt-40">Get Started Now</a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-4 col-md-6">
                        <div class="rts__pricing__box">
                            <div class="h6 fw-medium lh-1 mb-2 text-primary">Basic</div>
                            <div class="plan__price lh-1 mb-40"><span class="h2">399$/</span>Yearly</div>
                            <ul class="plan__feature">
                                <li><i class="fa-sharp fa-solid fa-check"></i> Unlimited access to 100+ Job</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> 10+ Featured job</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Job duration for 30 days</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Get 10+ job</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Try for free, forever!</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Individual Job</li>
                            </ul>
                            <a href="#" class="rts__btn pricing__btn  no__fill__btn mt-40">Get Started Now</a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-4 col-md-6">
                        <div class="rts__pricing__box">
                            <div class="h6 fw-medium lh-1 mb-2 text-primary">Standard</div>
                            <div class="plan__price lh-1 mb-40"><span class="h2">599$/</span>Yearly</div>
                            <ul class="plan__feature">
                                <li><i class="fa-sharp fa-solid fa-check"></i> Unlimited access to 100+ Job</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> 10+ Featured job</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Job duration for 30 days</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Get 10+ job</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Try for free, forever!</li>
                                <li><i class="fa-sharp fa-solid fa-check"></i> Individual Job</li>
                            </ul>
                            <a href="#" class="rts__btn pricing__btn  no__fill__btn mt-40">Get Started Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- pricing section end -->

    <!-- blog section -->
    {{-- <div class="rts__section section__padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-10">
                    <div class="rts__section__content text-center wow animated fadeIn mb-60">
                        <h3 class="rts__section__title section__mb">Read Our Latest News</h3>
                        <p class="rts__section__desc">Looking for your next career opportunity. Look no further</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center justify-content-cneter g-30">
                <div class="col-lg-6 col-xl-4 col-md-10">
                    <div class="rts__single__blog">
                        <a href="blog-details.html" class="blog__img">
                            <img src="{{ url('user/assets/img/home-1/blog/1.webp') }}" class="mb-2" alt="blog">
                        </a>
                        <div class="blog__meta">
                            <div class="blog__meta__info d-flex gap-3 my-3">
                                <span class="d-flex gap-1 align-items-center"> <img class="svg"
                                        src="{{ url('user/assets/img/icon/calender.svg') }}" alt=""> 20 March,
                                    2022</span>
                                <a href="#" class="d-flex gap-1 align-items-center"> <img class="svg"
                                        src="{{ url('user/assets/img/icon/user.svg') }}" alt=""> Jon Adom</a>
                            </div>
                            <a href="blog-details.html" class="h6 fw-semibold">
                                7 Ways Job Post Has Improved Business Today
                            </a>
                            <a href="blog-details.html" class="readmore__btn d-flex mt-3 gap-2 align-items-center">Read
                                More <i class="fa-light fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-6 col-xl-4 col-md-10">
                    <div class="rts__single__blog">
                        <a href="blog-details.html" class="blog__img">
                            <img src="{{ url('user/assets/img/home-1/blog/2.webp') }}" class="mb-2" alt="blog">
                        </a>
                        <div class="blog__meta">
                            <div class="blog__meta__info d-flex gap-3 my-3">
                                <span class="d-flex gap-1 align-items-center"> <img class="svg"
                                        src="{{ url('user/assets/img/icon/calender.svg') }}" alt=""> 20 March,
                                    2022</span>
                                <a href="#" class="d-flex gap-1 align-items-center"> <img class="svg"
                                        src="{{ url('user/assets/img/icon/user.svg') }}" alt=""> Jon Adom</a>
                            </div>
                            <a href="blog-details.html" class="h6 fw-semibold">
                                Start an online Job and work from home
                            </a>
                            <a href="blog-details.html" class="readmore__btn d-flex mt-3 gap-2 align-items-center">Read
                                More <i class="fa-light fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 col-md-10">
                    <div class="rts__single__blog">
                        <a href="blog-details.html" class="blog__img">
                            <img src="{{ url('user/assets/img/home-1/blog/3.webp') }}" class="mb-2" alt="blog">
                        </a>
                        <div class="blog__meta">
                            <div class="blog__meta__info d-flex gap-3 my-3">
                                <span class="d-flex gap-1 align-items-center"> <img class="svg"
                                        src="{{ url('user/assets/img/icon/calender.svg') }}" alt=""> 20 March,
                                    2022</span>
                                <a href="#" class="d-flex gap-1 align-items-center"> <img class="svg"
                                        src="{{ url('user/assets/img/icon/user.svg') }}" alt=""> Jon Adom</a>
                            </div>
                            <a href="blog-details.html" class="h6 fw-semibold">
                                Insider Strategies for Success on Job Websites
                            </a>
                            <a href="blog-details.html" class="readmore__btn d-flex mt-3 gap-2 align-items-center">Read
                                More <i class="fa-light fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    @if ($NewsSection == null || $NewsSection->show_section !== '0')
        <div class="rts__section section__padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-10">
                        <div class="rts__section__content text-center wow animated fadeIn mb-60">
                            <h3 class="rts__section__title section__mb">
                                {{ $NewsSection->news_title ?? 'Read Our Latest News' }}
                            </h3>
                            <p class="rts__section__desc">
                                {{ $NewsSection->news_message ?? 'Looking for your next career opportunity. Look no further' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-30">
                    @if (!empty($NewsSection->cards))
                        @foreach ($NewsSection->cards as $card)
                            <div class="col-lg-6 col-xl-4 col-md-10">
                                <div class="rts__single__blog">
                                    <a href="#" class="blog__img">
                                        <img src="{{ asset($card['image']) }}" class="mb-2" alt="blog">
                                    </a>
                                    <div class="blog__meta">
                                        <div class="blog__meta__info d-flex gap-3 my-3">
                                            <span class="d-flex gap-1 align-items-center">
                                                <img class="svg" src="{{ url('user/assets/img/icon/calender.svg') }}"
                                                    alt="">
                                                {{ $card['date'] ?? '' }}
                                            </span>
                                            <a href="#" class="d-flex gap-1 align-items-center">
                                                <img class="svg" src="{{ url('user/assets/img/icon/user.svg') }}"
                                                    alt="">
                                                {{ $card['author'] ?? '' }}
                                            </a>
                                        </div>
                                        <a href="#" class="h6 fw-semibold">
                                            {{ $card['title'] ?? '' }}
                                        </a>
                                        <a href="#" class="readmore__btn d-flex mt-3 gap-2 align-items-center">
                                            {{ $card['link_text'] ?? 'Read More' }}
                                            <i class="fa-light fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center">No news found.</p>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- blog section end -->

    {{-- 
    <div class="rts__section pb-120">
        <div class="container">
            <div class="row">
                <div class="rts__appcenter">
                    <div class="rts__appcenter__shape">
                        <img src="{{ url('user/assets/img/home-1/app/shape.png') }}" alt="">
                    </div>
                    <div
                        class="rts__appcenter__content d-flex flex-wrap flex-xl-nowrap align-items-center justify-content-between justify-content-lg-center">
                        <div class="content__left align-items-end d-flex position-relative top-15px">
                            <img src="{{ url('user/assets/img/home-1/app/app_screen.png') }}" alt="">
                        </div>
                        <div class="content__right text-white text-center text-xl-start max-630">
                            <h3 class="l--1 mb-4 text-white wow animated fadeInUp" data-wow-delay=".1s ">Download The app
                                Free!</h3>
                            <p class="wow animated fadeInUp" data-wow-delay=".2s">Looking for a new job can be both
                                exciting and daunting. Navigating the job market involves exploring various avenues.</p>
                            <div class="d-flex gap-3 justify-content-center justify-content-xl-start flex-wrap mt-40 wow animated fadeInUp"
                                data-wow-delay=".3s">
                                <div class="link">
                                    <a href="https://appstore.com/" target="_blank" title="app store">
                                        <img src="{{ url('user/assets/img/home-1/app/app-store.svg') }}" alt="">
                                    </a>
                                </div>
                                <div class="link">
                                    <a href="https://google.com/" target="_blank" title="play store">
                                        <img src="{{ url('user/assets/img/home-1/app/play-store.svg') }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}



    <div class="modal similar__modal fade " id="loginModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="max-content similar__form form__padding">
                    <div class="d-flex mb-3 align-items-center justify-content-between">
                        <h6 class="mb-0">Login To careernext</h6>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-regular fa-xmark text-primary"></i>
                        </button>
                    </div>
                    {{-- <div class="d-block has__line text-center"><p>Choose your Account Type</p></div>
            
            <div class="tab__switch flex-wrap flex-sm-nowrap nav-tab mt-30 mb-30">
                <button class="rts__btn nav-link  active"><i class="fa-light fa-user"></i>Candidate</button>
                <button class="rts__btn nav-link"><i class="rt-briefcase"></i> Employer</button>
            </div> --}}
                    <div class="tab-content" id="">

                    </div>
                    {{-- <form action="#" method="post" class="d-flex flex-column gap-3">
                <div class="form-group">
                    <label for="email" class="fw-medium text-dark mb-2">Your Email</label>
                    <div class="position-relative">
                        <input type="email" name="email" id="email" value="" placeholder="Enter your email" required>
                        <i class="fa-light fa-user icon"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="fw-medium text-dark mb-2">Password</label>
                    <div class="position-relative">
                        <input type="password" name="password" value="1234" id="password" placeholder="Enter your password" required>
                        <i class="fa-light fa-lock icon"></i>
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-between align-items-center fw-medium">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Remember me
                        </label>
                    </div>
                    <a href="#" class="forgot__password text-para" data-bs-toggle="modal" data-bs-target="#forgotModal" >Forgot Password?</a>
                </div>
                <div class="form-group my-3">
                    <button class="rts__btn w-100 fill__btn">Login</button>
                </div>
            </form> --}}
                    {{-- <div class="d-block has__line text-center"><p>Or</p></div>
            <div class="d-flex gap-4 flex-wrap justify-content-center mt-20 mb-20">
                <div class="is__social google">
                    <button><img src="{{url('user/assets/img/icon/google-small.svg')}}" alt="">Continue with Google</button>
                </div>
                <div class="is__social facebook">
                    <button><img src="{{url('user/assets/img/icon/facebook-small.svg')}}" alt="">Continue with Facebook</button>
                </div>
            </div> --}}
                    {{-- <span class="d-block text-center fw-medium">Don`t have an account? <a href="#" data-bs-target="#signupModal" data-bs-toggle="modal" class="text-primary">Sign Up</a> </span> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- signup form -->
    <div class="modal similar__modal fade " id="signupModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="max-content similar__form form__padding">
                    <div class="d-flex mb-3 align-items-center justify-content-between">
                        <h6 class="mb-0">Create A Free Account</h6>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-regular fa-xmark text-primary"></i>
                        </button>
                    </div>
                    {{-- <div class="d-block has__line text-center"><p>Choose your Account Type</p></div>
            
            <div class="tab__switch flex-wrap flex-sm-nowrap nav-tab mt-30 mb-30">
                <button class="rts__btn nav-link  active"><i class="fa-light fa-user"></i>Candidate</button>
                <button class="rts__btn nav-link"><i class="rt-briefcase"></i> Employer</button>
            </div> --}}
                    <form action="#" class="d-flex flex-column gap-3">

                        <div class="form-group">
                            <label for="sname" class="fw-medium text-dark mb-3">Your Name</label>
                            <div class="position-relative">
                                <input type="text" name="sname" id="sname" placeholder="Candidate" required>
                                <i class="fa-light fa-user icon"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="signemail" class="fw-medium text-dark mb-3">Your Email</label>
                            <div class="position-relative">
                                <input type="email" name="signemail" id="signemail" placeholder="Enter your email"
                                    required>
                                <i class="fa-sharp fa-light fa-envelope icon"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="spassword" class="fw-medium text-dark mb-3">Password</label>
                            <div class="position-relative">
                                <input type="password" name="spassword" id="spassword" placeholder="Enter your password"
                                    required>
                                <i class="fa-light fa-lock icon"></i>
                            </div>
                        </div>

                        <div class="form-group my-3">
                            <button class="rts__btn w-100 fill__btn">Login</button>
                        </div>
                    </form>
                    {{-- <div class="d-block has__line text-center"><p>Or</p></div>
            <div class="d-flex flex-wrap justify-content-center gap-4 mt-20 mb-20">
                <div class="is__social google">
                    <button><img src="{{url('user/assets/img/icon/google-small.svg')}}" alt="">Continue with Google</button>
                </div>
                <div class="is__social facebook">
                    <button><img src="{{url('user/assets/img/icon/facebook-small.svg')}}" alt="">Continue with Facebook</button>
                </div>
            </div> --}}
                    <span class="d-block text-center fw-medium">Have an account? <a href="#"
                            data-bs-target="#loginModal" data-bs-toggle="modal" class="text-primary">Login</a> </span>
                </div>
            </div>
        </div>
    </div>

    <!-- forgot password form -->
    <div class="modal similar__modal fade " id="forgotModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="max-content similar__form form__padding">
                    <div class="d-flex mb-3 align-items-center justify-content-between">
                        <h6 class="mb-0">Forgot Password</h6>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-regular fa-xmark text-primary"></i>
                        </button>
                    </div>
                    <form action="#" class="d-flex flex-column gap-3">

                        <div class="form-group">
                            <label for="fmail" class="fw-medium text-dark mb-3">Your Email</label>
                            <div class="position-relative">
                                <input type="email" name="email" id="fmail" placeholder="Enter your email"
                                    required>
                                <i class="fa-sharp fa-light fa-envelope icon"></i>
                            </div>
                        </div>

                        <div class="form-group my-3">
                            <button class="rts__btn w-100 fill__btn">Reset Password</button>
                        </div>
                    </form>

                    <span class="d-block text-center fw-medium">Remember Your Password? <a href="#"
                            data-bs-target="#loginModal" data-bs-toggle="modal" class="text-primary">Login</a> </span>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
