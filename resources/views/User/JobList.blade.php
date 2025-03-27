@extends('User.UserLayout.main')
@section('title')
    Jobs
@endsection
<style>
    .rts__pagination ul {
    list-style: none;
    padding: 0;
    display: flex;
    justify-content: center;
}

.rts__pagination ul li {
    display: inline-block;
}

.rts__pagination ul li a, 
.rts__pagination ul li span {
    padding: 10px 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    text-decoration: none;
    color: #555;
    transition: background 0.3s ease;
}

.rts__pagination ul li a:hover {
    background: #f0f0f0;
}

.rts__pagination ul li a.active {
    background: #007bff;
    color: white;
    border-color: #007bff;
}

.rts__pagination ul li .inactive {
    color: #bbb;
    cursor: not-allowed;
}
</style>
@section('main-container')
    <div class="rts__section breadcrumb__background">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 position-relative d-flex justify-content-between align-items-center">
                    <div class="breadcrumb__area max-content breadcrumb__padding z-2">
                        <h1 class="breadcrumb-title h3 mb-3">Job List</h1>
                        <nav>
                            <ul class="breadcrumb m-0 lh-1">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Job List</li>
                            </ul>
                        </nav>
                    </div>
                    <div class="breadcrumb__area__shape d-flex gap-4 justify-content-end align-items-center">
                        <div class="shape__one common">
                            <img src="{{ url('user/assets/img/breadcrumb/shape-1.svg') }}" alt="">
                        </div>
                        <div class="shape__two common">
                            <img src="{{ url('user/assets/img/breadcrumb/shape-2.svg') }}" alt="">
                        </div>
                        <div class="shape__three common">
                            <img src="{{ url('user/assets/img/breadcrumb/shape-3.svg') }}" alt="">
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
                <div class="col-lg-5 col-xl-4">
                    <div class="job__search__section mb-40">
                        <form action="#" class="d-flex flex-column row-30">
                            <div class="search__item">
                                <label for="search" class="mb-3 font-20 fw-medium text-dark text-capitalize">Search By Job
                                    Title</label>
                                <div class="position-relative">
                                    <input type="text" id="search" placeholder="Enter Type Of job" required>
                                    <i class="fa-light fa-magnifying-glass"></i>
                                </div>
                            </div>
                            <!-- job location -->
                            <div class="search__item">
                                <h6 class="mb-3 font-20 fw-medium text-dark text-capitalize">Search Location</h6>
                                <div class="position-relative">
                                    <div class="nice-select" tabindex="0">
                                        <span class="current">Search Location</span>
                                        <ul class="list">
                                            <li data-value="Nothing" data-display="Search Location"
                                                class="option selected focus">Search Location</li>
                                            <li data-value="1" class="option">Dhaka</li>
                                            <li data-value="2" class="option">Barisal</li>
                                            <li data-value="3" class="option">Chittagong</li>
                                            <li data-value="4" class="option">Rajshahi</li>
                                        </ul>
                                    </div>
                                    <i class="fa-light fa-location-dot"></i>
                                </div>
                            </div>
                            <!-- job category -->
                            <div class="search__item">
                                <h6 class="mb-3 font-20 fw-medium text-dark text-capitalize">Search By Job category</h6>
                                <div class="position-relative">
                                    <div class="nice-select" tabindex="0">
                                        <span class="current">Choose a Category</span>
                                        <ul class="list">
                                            <li data-value="Nothing" data-display="Search By Job category"
                                                class="option selected focus">Choose a Category</li>
                                            <li data-value="1" class="option">Government</li>
                                            <li data-value="2" class="option">NGO</li>
                                            <li data-value="3" class="option ">Private</li>
                                        </ul>
                                    </div>
                                    <i class="rt-briefcase"></i>
                                </div>
                            </div>
                            <!-- job post time -->
                            <div class="search__item">
                                <h6 class="mb-3 font-20 fw-medium text-dark text-capitalize">Date posted</h6>
                                <div class="position-relative">
                                    <div class="nice-select" tabindex="0">
                                        <span class="current">Date Posted</span>
                                        <ul class="list">
                                            <li data-value="Nothing" data-display="Date posted"
                                                class="option selected focus">Date Posted</li>
                                            <li data-value="1" class="option">01 Jan 24</li>
                                            <li data-value="2" class="option">05 Feb 24</li>
                                            <li data-value="3" class="option">07 Mar 24</li>
                                        </ul>
                                    </div>
                                    <i class="fa-light fa-clock"></i>
                                </div>
                            </div>

                            <!-- job post time -->
                            <div class="search__item">
                                <div class="mb-3 font-20 fw-medium text-dark text-capitalize">job type</div>
                                <div class="search__item__list">
                                    <div class="d-flex align-items-center justify-content-between list">
                                        <div class="d-flex gap-2 align-items-center checkbox">
                                            <input type="checkbox" name="fulltime" id="fulltime">
                                            <label for="fulltime">Full Time</label>
                                        </div>
                                        <span>(130)</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between list">
                                        <div class="d-flex gap-2 align-items-center checkbox">
                                            <input type="checkbox" name="part" id="part">
                                            <label for="part">Part Time</label>
                                        </div>
                                        <span>(80)</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between list">
                                        <div class="d-flex gap-2 align-items-center checkbox">
                                            <input type="checkbox" name="temporary" id="temporary">
                                            <label for="temporary">temporary</label>
                                        </div>
                                        <span>(150)</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between list">
                                        <div class="d-flex gap-2 align-items-center checkbox">
                                            <input type="checkbox" name="freelance" id="freelance">
                                            <label for="freelance">freelance</label>
                                        </div>
                                        <span>(130)</span>
                                    </div>
                                </div>
                            </div>

                            <!-- experience label -->
                            <div class="search__item">
                                <div class="mb-3 font-20 fw-medium text-dark text-capitalize">experience Label</div>
                                <div class="search__item__list">

                                    <div class="d-flex align-items-center justify-content-between list">
                                        <div class="d-flex gap-2 align-items-center checkbox">
                                            <input type="checkbox" name="5year" id="5year">
                                            <label for="5year">5 year</label>
                                        </div>
                                        <span>(10)</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between list">
                                        <div class="d-flex gap-2 align-items-center checkbox">
                                            <input type="checkbox" name="4year" id="4year">
                                            <label for="4year">4 year</label>
                                        </div>
                                        <span>(15)</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between list">
                                        <div class="d-flex gap-2 align-items-center checkbox">
                                            <input type="checkbox" name="3year" id="3year">
                                            <label for="3year">3 year</label>
                                        </div>
                                        <span>(50)</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between list">
                                        <div class="d-flex gap-2 align-items-center checkbox">
                                            <input type="checkbox" name="fresher" id="fresher">
                                            <label for="fresher">fresher</label>
                                        </div>
                                        <span>(130)</span>
                                    </div>
                                </div>
                            </div>

                            <!-- salary label -->
                            <div class="search__item">
                                <div class="mb-3 font-20 fw-medium text-dark text-capitalize">salary offered</div>
                                <div class="search__item__list">

                                    <div class="d-flex align-items-center justify-content-between list">
                                        <div class="d-flex gap-2 align-items-center checkbox">
                                            <input type="checkbox" name="500" id="500">
                                            <label for="500">under $500</label>
                                        </div>
                                        <span>(10)</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between list">
                                        <div class="d-flex gap-2 align-items-center checkbox">
                                            <input type="checkbox" name="5000" id="5000">
                                            <label for="5000">$5,000 - $10,000</label>
                                        </div>
                                        <span>(44)</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between list">
                                        <div class="d-flex gap-2 align-items-center checkbox">
                                            <input type="checkbox" name="1000" id="1000">
                                            <label for="1000">$10,000 - $15,000</label>
                                        </div>
                                        <span>(27)</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between list">
                                        <div class="d-flex gap-2 align-items-center checkbox">
                                            <input type="checkbox" name="1500" id="1500">
                                            <label for="1500">$15,000 - $20,000</label>
                                        </div>
                                        <span>(85)</span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="rts__btn no__fill__btn max-content mx-auto job__search__btn font-sm"
                                aria-label="Search">Find Job</button>
                        </form>
                    </div>
                    <!-- job aleart -->
                    <div class="job__aleart job__search__section">
                        <form action="#" class="d-flex flex-column row-35">
                            <div class="search__item">
                                <label for="alert" class="mb-3 font-20 fw-medium text-dark text-capitalize">Job
                                    Alert</label>
                                <div class="position-relative">
                                    <input type="text" id="alert" placeholder="Enter Type Of job" required>
                                    <i class="fa-light fa-magnifying-glass"></i>
                                </div>
                            </div>
                            <!-- job location -->
                            <div class="search__item no-icon">
                                <label for="frequency"
                                    class="mb-3 font-20 fw-medium text-dark text-capitalize">EmailFrequency</label>
                                <div class="position-relative">
                                    <div class="nice-select" tabindex="0">
                                        <span class="current">Daily</span>
                                        <ul class="list">
                                            <li data-value="Nothing" data-display="Daily" class="option selected focus">
                                                Daily</li>
                                            <li data-value="1" class="option">Weakly</li>
                                            <li data-value="2" class="option">Monthly</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- job category -->
                            <button type="submit" class="rts__btn fill__btn py-3 rounded-2 job__search"
                                aria-label="Search">Save Job Alert</button>
                        </form>
                    </div>
                    <!-- job aleart end -->
                </div>
                <div class="col-lg-7 col-xl-8">
                    <div
                        class="top__query mb-40 d-flex flex-wrap gap-4 gap-xl-0 justify-content-between align-items-center">
                        <span class="text-dark font-20 fw-medium">Showing 1-9 of 19 results</span>
                        <div class="d-flex flex-wrap align-items-center gap-4">
                            <form action="#" class="category-select">
                                <div class="position-relative">
                                    <div class="nice-select" tabindex="0">
                                        <span class="current">All Category</span>
                                        <ul class="list">
                                            <li data-value="Nothing" data-display="All Category"
                                                class="option selected focus">All Category</li>
                                            <li data-value="1" class="option">Part Time</li>
                                            <li data-value="2" class="option">Full Time</li>
                                            <li data-value="3" class="option">Government</li>
                                            <li data-value="4" class="option">NGO</li>
                                            <li data-value="5" class="option">Private</li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                            {{-- <div class="d-flex align-items-center gap-3" id="nav-tab" role="tablist">
                                <button class="rts__btn no__fill__btn grid-style nav-link active" data-bs-toggle="tab" data-bs-target="#grid"> <i class="rt-hamburger"></i> Grid</button>
                                <button class="rts__btn no__fill__btn list-style nav-link active" data-bs-toggle="tab" data-bs-target="#list"> <i class="rt-list"></i> List</button>
                            </div> --}}
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        {{-- <div class="tab-pane grid__style fade show active" role="tabpanel" id="grid">
                            <div class="row g-30">
                                <div class="col-xl-6 col-md-6 col-lg-12">
                                    <div class="rts__job__card">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="company__icon">
                                                <img src="{{url('user/assets/img/home-1/company/google.svg')}}" alt="">
                                            </div>
                                            <div class="featured__option">
                                              
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3 flex-wrap mt-4">
                                            <div class="d-flex gap-1 align-items-center">
                                                <i class="fa-light fa-location-dot"></i> Newyork, UsssSA
                                            </div>
                                            <div class="d-flex gap-1 align-items-center">
                                                <i class="fa-light fa-briefcase"></i> Full Time
                                            </div>
                                        </div>
                                        <div class="h6 job__title my-3">
                                            <a href="#" aria-label="job">
                                                Senior UX Designer, Google
                                            </a>
                                        </div>
                                        <p>Consectetur adipisicing elit. Possimus 
                                            aut mollitia eum ipsum fugiat odio officiis odit mollitia eum ipsum.
                                        </p>
                                        <div class="job__tags d-flex flex-wrap gap-2 mt-4">
                                            <a href="#">Creative</a>
                                            <a href="#">user interface</a>
                                            <a href="#">web ui</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-lg-12">
                                    <div class="rts__job__card">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="company__icon">
                                                <img src="{{url('user/assets/img/home-1/company/microsoft.svg')}}" alt="">
                                            </div>
                                            <div class="featured__option">
                                              
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3 flex-wrap mt-4">
                                            <div class="d-flex gap-1 align-items-center">
                                                <i class="fa-light fa-location-dot"></i> Newyork, USA
                                            </div>
                                            <div class="d-flex gap-1 align-items-center">
                                                <i class="fa-light fa-briefcase"></i> Full Time
                                            </div>
                                        </div>
                                        <div class="h6 job__title my-3">
                                            <a href="#" aria-label="job">
                                                Software Engineer, Bing
                                            </a>
                                        </div>
                                        <p>Consectetur adipisicing elit. Possimus 
                                            aut mollitia eum ipsum fugiat odio officiis odit mollitia eum ipsum.
                                        </p>
                                        <div class="job__tags d-flex flex-wrap gap-2 mt-4">
                                            <a href="#">React</a>
                                            <a href="#">javascript</a>
                                            <a href="#">web ui</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-lg-12">
                                    <div class="rts__job__card">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="company__icon">
                                                <img src="{{url('user/assets/img/home-1/company/apple.svg')}}" alt="">
                                            </div>
                                            <div class="featured__option">
                                              
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3 flex-wrap mt-4">
                                            <div class="d-flex gap-1 align-items-center">
                                                <i class="fa-light fa-location-dot"></i> Newyork, USA
                                            </div>
                                            <div class="d-flex gap-1 align-items-center">
                                                <i class="fa-light fa-briefcase"></i> Full Time
                                            </div>
                                        </div>
                                        <div class="h6 job__title my-3">
                                            <a href="#" aria-label="job">
                                                Senior UX Designer, Apple
                                            </a>
                                        </div>
                                        <p>Consectetur adipisicing elit. Possimus 
                                            aut mollitia eum ipsum fugiat odio officiis odit mollitia eum ipsum.
                                        </p>
                                        <div class="job__tags d-flex flex-wrap gap-2 mt-4">
                                            <a href="#">Creative</a>
                                            <a href="#">user interface</a>
                                            <a href="#">web ui</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-lg-12">
                                    <div class="rts__job__card">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="company__icon">
                                                <img src="{{url('user/assets/img/home-1/company/upwork.svg')}}" alt="">
                                            </div>
                                            <div class="featured__option">
                                              
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3 flex-wrap mt-4">
                                            <div class="d-flex gap-1 align-items-center">
                                                <i class="fa-light fa-location-dot"></i> Newyork, USA
                                            </div>
                                            <div class="d-flex gap-1 align-items-center">
                                                <i class="fa-light fa-briefcase"></i> Full Time
                                            </div>
                                        </div>
                                        <div class="h6 job__title my-3">
                                            <a href="#" aria-label="job">
                                            Web Developer, Upwork
                                            </a>
                                        </div>
                                        <p>Consectetur adipisicing elit. Possimus 
                                            aut mollitia eum ipsum fugiat odio officiis odit mollitia eum ipsum.
                                        </p>
                                        <div class="job__tags d-flex flex-wrap gap-2 mt-4">
                                            <a href="#">HTML</a>
                                            <a href="#">CSS</a>
                                            <a href="#">SCSS</a>
                                            <a href="#">Figma</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-lg-12">
                                    <div class="rts__job__card">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="company__icon">
                                                <img src="{{url('user/assets/img/home-1/company/facebook.svg')}}" alt="">
                                            </div>
                                            <div class="featured__option">
                                              
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3 flex-wrap mt-4">
                                            <div class="d-flex gap-1 align-items-center">
                                                <i class="fa-light fa-location-dot"></i> Newyork, USA
                                            </div>
                                            <div class="d-flex gap-1 align-items-center">
                                                <i class="fa-light fa-briefcase"></i> Full Time
                                            </div>
                                        </div>
                                        <div class="h6 job__title my-3">
                                            <a href="#" aria-label="job">
                                                Digital Marketing, Facebook
                                            </a>
                                        </div>
                                        <p>Consectetur adipisicing elit. Possimus 
                                            aut mollitia eum ipsum fugiat odio officiis odit mollitia eum ipsum.
                                        </p>
                                        <div class="job__tags d-flex flex-wrap gap-2 mt-4">
                                            <a href="#">Blog Post</a>
                                            <a href="#">web ui</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-lg-12">
                                    <div class="rts__job__card">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="company__icon">
                                                <img src="{{url('user/assets/img/home-1/company/in.svg')}}" alt="">
                                            </div>
                                            <div class="featured__option">
                                              
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3 flex-wrap mt-4">
                                            <div class="d-flex gap-1 align-items-center">
                                                <i class="fa-light fa-location-dot"></i> Newyork, USA
                                            </div>
                                            <div class="d-flex gap-1 align-items-center">
                                                <i class="fa-light fa-briefcase"></i> Full Time
                                            </div>
                                        </div>
                                        <div class="h6 job__title my-3">
                                            <a href="#" aria-label="job">
                                                Graphic Designer, Linkedin
                                            </a>
                                        </div>
                                        <p>Consectetur adipisicing elit. Possimus 
                                            aut mollitia eum ipsum fugiat odio officiis odit mollitia eum ipsum.
                                        </p>
                                        <div class="job__tags d-flex flex-wrap gap-2 mt-4">
                                            <a href="#">Creative</a>
                                            <a href="#">user interface</a>
                                            <a href="#">web ui</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-lg-12">
                                    <div class="rts__job__card">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="company__icon">
                                                <img src="{{url('user/assets/img/home-1/company/udemy.svg')}}" alt="">
                                            </div>
                                            <div class="featured__option">
                                              
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3 flex-wrap mt-4">
                                            <div class="d-flex gap-1 align-items-center">
                                                <i class="fa-light fa-location-dot"></i> Newyork, USA
                                            </div>
                                            <div class="d-flex gap-1 align-items-center">
                                                <i class="fa-light fa-briefcase"></i> Full Time
                                            </div>
                                        </div>
                                        <div class="h6 job__title my-3">
                                            <a href="#" aria-label="job">
                                                Online Trainer, Udemy
                                            </a>
                                        </div>
                                        <p>Consectetur adipisicing elit. Possimus 
                                            aut mollitia eum ipsum fugiat odio officiis odit mollitia eum ipsum.
                                        </p>
                                        <div class="job__tags d-flex flex-wrap gap-2 mt-4">
                                            <a href="#">Creative</a>
                                            <a href="#">user interface</a>
                                            <a href="#">web ui</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-lg-12">
                                    <div class="rts__job__card">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="company__icon">
                                                <img src="{{url('user/assets/img/home-1/company/figma.svg')}}" alt="">
                                            </div>
                                            <div class="featured__option">
                                              
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3 flex-wrap mt-4">
                                            <div class="d-flex gap-1 align-items-center">
                                                <i class="fa-light fa-location-dot"></i> Newyork, USA
                                            </div>
                                            <div class="d-flex gap-1 align-items-center">
                                                <i class="fa-light fa-briefcase"></i> Full Time
                                            </div>
                                        </div>
                                        <div class="h6 job__title my-3">
                                            <a href="#" aria-label="job">
                                                Product Designer, Figma
                                            </a>
                                        </div>
                                        <p>Consectetur adipisicing elit. Possimus 
                                            aut mollitia eum ipsum fugiat odio officiis odit mollitia eum ipsum.
                                        </p>
                                        <div class="job__tags d-flex flex-wrap gap-2 mt-4">
                                            <a href="#">Skill</a>
                                            <a href="#">user interface</a>
                                            <a href="#">Problem Solving</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div> --}}
                        <div class="tab-pane fade list__style show active" role="tabpanel" id="list">
                            <div class="row g-30">
                                <!-- single item -->
                                @foreach ($jobs as $data)
                                <div class="col-lg-12">
                                    <div
                                        class="rts__job__card__big style__gradient flex-wrap justify-content-between d-flex gap-4 align-items-center">
                                        <div
                                            class="d-flex flex-wrap flex-md-nowrap flex-lg-wrap flex-xl-nowrap gap-4 align-items-center">
                                            <div class="company__icon rounded-2">
                                                <img src="{{ url('user/assets/img/home-1/company/apple.svg') }}"
                                                    alt="">
                                            </div>
                                            <div class="job__meta w-100 d-flex flex-column gap-2">
                                                <div class="d-flex justify-content-between align-items-center gap-3">
                                                    <a href="#" id="title" class="job__title h6 mb-0">{{$data->title}}</a>
                                                </div>
                                                <div class="d-flex gap-3 gap-md-4 flex-wrap mb-2">
                                                    <div class="d-flex gap-2 align-items-center" id="location">
                                                        <i class="fa-light fa-location-dot"></i> {{$data->location}}
                                                    </div>
                                                    <div class="d-flex gap-2 align-items-center" id="type">
                                                        <i class="fa-light rt-briefcase"></i> {{$data->type}}
                                                    </div>
                                                    <div class="d-flex gap-2 align-items-center">
                                                        <i class="fa-light fa-clock"></i> 1 Years Ago
                                                    </div>
                                                </div>
                                                <div class="job__tags d-flex flex-wrap gap-3" id="skills">
                                                    @foreach(explode(',', $data->skills) as $skill)
                                                        <a href="#">{{ trim($skill) }}</a>
                                                    @endforeach
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div>
                                            <button type="button" class="bookmark__btn"><i
                                                    class="rt-bookmark"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                
                                <!-- single item end -->

                            </div>
                        </div>
                    </div>

                    {{-- <div class="rts__pagination mx-auto pt-60 max-content">
                        <ul class="d-flex gap-2">
                            <li><a href="#" class="inactive"><i class="rt-chevron-left"></i></a></li>
                            <li><a class="active" href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#"><i class="rt-chevron-right"></i></a></li>
                        </ul>
                    </div> --}}

                    {{-- <div class="rts__pagination mx-auto pt-60 max-content">
                        {{ $jobs->links('pagination::bootstrap-4') }}
                    </div> --}}

                    <div class="rts__pagination mx-auto pt-60 max-content">
                        <ul class="d-flex gap-2">
                            {{-- Previous Page Link --}}
                            @if ($jobs->onFirstPage())
                                <li><span class="inactive"><i class="rt-chevron-left"></i></span></li>
                            @else
                                <li><a href="{{ $jobs->previousPageUrl() }}"><i class="rt-chevron-left"></i></a></li>
                            @endif
                    
                            {{-- Pagination Numbers --}}
                            @for ($page = 1; $page <= $jobs->lastPage(); $page++)
                                <li>
                                    <a href="{{ $jobs->url($page) }}" class="{{ $page == $jobs->currentPage() ? 'active' : '' }}">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endfor
                    
                            {{-- Next Page Link --}}
                            @if ($jobs->hasMorePages())
                                <li><a href="{{ $jobs->nextPageUrl() }}"><i class="rt-chevron-right"></i></a></li>
                            @else
                                <li><span class="inactive"><i class="rt-chevron-right"></i></span></li>
                            @endif
                        </ul>
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
    </div>

    <!-- app center end -->



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
                    <div class="d-block has__line text-center">
                        <p>Choose your Account Type</p>
                    </div>

                    <div class="tab__switch flex-wrap flex-sm-nowrap nav-tab mt-30 mb-30">
                        <button class="rts__btn nav-link  active"><i class="fa-light fa-user"></i>Candidate</button>
                        <button class="rts__btn nav-link"><i class="rt-briefcase"></i> Employer</button>
                    </div>
                    <div class="tab-content" id="">

                    </div>
                    <form action="#" method="post" class="d-flex flex-column gap-3">
                        <div class="form-group">
                            <label for="email" class="fw-medium text-dark mb-3">Your Email</label>
                            <div class="position-relative">
                                <input type="email" name="email" id="email" value="user@test.com"
                                    placeholder="Enter your email" required>
                                <i class="fa-light fa-user icon"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="fw-medium text-dark mb-3">Password</label>
                            <div class="position-relative">
                                <input type="password" name="password" value="1234" id="password"
                                    placeholder="Enter your password" required>
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
                            <a href="#" class="forgot__password text-para" data-bs-toggle="modal"
                                data-bs-target="#forgotModal">Forgot Password?</a>
                        </div>
                        <div class="form-group my-3">
                            <button class="rts__btn w-100 fill__btn">Login</button>
                        </div>
                    </form>
                    <div class="d-block has__line text-center">
                        <p>Or</p>
                    </div>
                    <div class="d-flex gap-4 flex-wrap justify-content-center mt-20 mb-20">
                        <div class="is__social google">
                            <button><img src="{{ url('user/assets/img/icon/google-small.svg') }}" alt="">Continue
                                with Google</button>
                        </div>
                        <div class="is__social facebook">
                            <button><img src="{{ url('user/assets/img/icon/facebook-small.svg') }}"
                                    alt="">Continue with Facebook</button>
                        </div>
                    </div>
                    <span class="d-block text-center fw-medium">Don`t have an account? <a href="#"
                            data-bs-target="#signupModal" data-bs-toggle="modal" class="text-primary">Sign Up</a> </span>
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
                    <div class="d-block has__line text-center">
                        <p>Choose your Account Type</p>
                    </div>

                    <div class="tab__switch flex-wrap flex-sm-nowrap nav-tab mt-30 mb-30">
                        <button class="rts__btn nav-link  active"><i class="fa-light fa-user"></i>Candidate</button>
                        <button class="rts__btn nav-link"><i class="rt-briefcase"></i> Employer</button>
                    </div>
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
                    <div class="d-block has__line text-center">
                        <p>Or</p>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center gap-4 mt-20 mb-20">
                        <div class="is__social google">
                            <button><img src="{{ url('user/assets/img/icon/google-small.svg') }}" alt="">Continue
                                with Google</button>
                        </div>
                        <div class="is__social facebook">
                            <button><img src="{{ url('user/assets/img/icon/facebook-small.svg') }}"
                                    alt="">Continue with Facebook</button>
                        </div>
                    </div>
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
