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

    .rt-bookmark.filled {
        color: white;
        /* or any color you want */
    }

    .rt-bookmark.bg-grey {
        background-color: grey;
        border-radius: 50%;
        padding: 6px;
        /* optional, just for better appearance */
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
                                <li class="breadcrumb-item"><a href="{{ route('User.Home') }}">Home</a></li>
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
                        <form action="{{ route('User.JobList') }}" class="d-flex flex-column row-30">
                            <div class="search__item">
                                <label for="search" class="mb-3 font-20 fw-medium text-dark text-capitalize">Search By Job
                                    Title</label>
                                <div class="position-relative">
                                    <input type="text" id="title" name="title" placeholder="Enter Type Of job"
                                        required style="padding-right: 80px;">
                                    <i class="fa-light fa-magnifying-glass"></i>
                                </div>
                                <button class="btn btn-sm btn-primary" type="submit"
                                    style="position: absolute; top: 73%; right: 10px; transform: translateY(-50%); border: none;">
                                    Submit
                                </button>
                            </div>
                        </form>


                        <!-- job location -->
                        <div class="search__item">
                            <h6 class="mb-3 font-20 fw-medium text-dark text-capitalize">Search Location</h6>
                            <form action="{{ route('User.JobList') }}" method="GET" class="location-select"
                                id="locationForm">
                                <input type="hidden" name="location" id="selectedLocation" value="">
                                <div class="position-relative">
                                    <select name="location" id="selectedLocation" class="form-select"
                                        onchange="this.form.submit()">
                                        <option value="Nothing" selected disabled>Search Location</option>
                                        @foreach ($location as $value)
                                            <option value="{{ $value->location }}">{{ $value->location }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>


                        <!-- job post time -->
                        {{-- <div class="search__item">
                                <h6 class="mb-3 font-20 fw-medium text-dark text-capitalize">Date posted</h6>
                                <div class="position-relative">
                                    <div class="nice-select" tabindex="0">
                                        <span class="current">Date Posted</span>
                                        <ul class="list">
                                            <li data-value="Nothing"
                                                data-display="Date posted"class="option selected focus">Date Posted</li>
                                            @foreach ($DatePost as $value)
                                                <li data-value="{{ $value->created_at }}" class="option">
                                                    {{ date('d M Y', strtotime($value->created_at)) }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <i class="fa-light fa-clock"></i>
                                </div>
                            </div> --}}

                        <div class="search__item">
                            <h6 class="mb-3 font-20 fw-medium text-dark text-capitalize">Date Posted</h6>
                            <form action="{{ route('User.JobList') }}" method="GET" class="date-select" id="dateForm">
                                <input type="hidden" name="date_posted" id="selectedDate" value="">
                                <div class="position-relative">
                                    <select name="date_posted" id="selectedDate" class="form-select"
                                        onchange="this.form.submit()">
                                        <option value="Nothing" selected disabled>Date Posted</option>
                                        @foreach ($DatePost as $value)
                                            <option value="{{ $value->created_at }}">
                                                {{ date('d M Y', strtotime($value->created_at)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>









                        <!-- job post time -->
                        <div class="search__item">
                            <div class="mt-3 fs-5 fw-medium text-dark text-capitalize">Job Type</div>
                            <div class="search__item__list">
                                <form action="{{ route('User.JobList') }}" method="GET" class="type-select"
                                    id="TypeForm">
                                    <input type="hidden" name="job_type" id="job_type" value="">
                                    @foreach ($type as $index => $t)
                                        <div class="d-flex align-items-center justify-content-between py-2 border-bottom">
                                            <div class="d-flex align-items-center gap-2 flex-shrink-1">
                                                <input type="checkbox" id="job_type_{{ $index }}" name="job_type[]"
                                                    value="{{ $t->type }}">
                                                <label for="job_type_{{ $index }}"
                                                    class="mb-0 text-nowrap">{{ $t->type }}</label>
                                            </div>
                                            <span class="text-muted text-nowrap">({{ $t->count }})</span>
                                        </div>
                                    @endforeach
                                </form>
                            </div>
                        </div>


                        <!-- experience label -->
                        <div class="search__item">
                            <div class="mt-3 font-20 fw-medium text-dark text-capitalize">Experience Label</div>
                            <div class="search__item__list">
                                <form action="{{ route('User.JobList') }}" method="GET" class="experience-select"
                                    id="ExperienceForm">
                                    @foreach ($experience as $index => $exp)
                                        <div class="d-flex align-items-center justify-content-between py-2 border-bottom">
                                            <div class="d-flex gap-2 align-items-center flex-shrink-1">
                                                <input type="checkbox" id="exp_{{ $index }}" name="experience[]"
                                                    value="{{ $exp->max_exp }}">
                                                <label for="exp_{{ $index }}"
                                                    class="mb-0 text-nowrap">{{ $exp->max_exp }} year</label>
                                            </div>
                                            <span class="text-muted text-nowrap">({{ $exp->count }})</span>
                                        </div>
                                    @endforeach
                                </form>
                            </div>
                        </div>


                        <!-- salary label -->
                        <div class="search__item">
                            <div class="mb-3 font-20 fw-medium text-dark text-capitalize">salary offered</div>
                            <div class="search__item__list">
                                @foreach ($salaryoffer as $salary)
                                    <div class="d-flex align-items-center justify-content-between list">
                                        <div class="d-flex gap-2 align-items-center checkbox">
                                            <input type="checkbox" name="saloffer" id="saloffer">
                                            <label for="saloffer">{{ $salary->max_sal }}</label>
                                        </div>
                                        <span>({{ $salary->count }})</span>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <button type="submit" class="rts__btn no__fill__btn max-content mx-auto job__search__btn font-sm"
                            aria-label="Search">Find Job</button>
                    </div>

                </div>
                <div class="col-lg-7 col-xl-8">
                    <div
                        class="top__query mb-40 d-flex flex-wrap gap-4 gap-xl-0 justify-content-between align-items-center">
                        {{-- <span class="text-dark font-20 fw-medium">Showing 1-9 of 19 results</span> --}}
                        <span class="text-dark font-20 fw-medium">
                            Showing {{ $jobs->firstItem() }}-{{ $jobs->lastItem() }} of {{ $jobs->total() }} results
                        </span>


                        <div class="d-flex flex-wrap align-items-center gap-4">
                            <form action="{{ route('User.JobList') }}" method="GET" class="category-select"
                                id="categoryForm">
                                <input type="hidden" name="category" id="selectedCategory" value="">

                                <div class="position-relative">
                                    <div class="nice-select industry-select" tabindex="0">
                                        <span class="current">All Category</span>
                                        <ul class="list">
                                            @foreach ($industry as $industry)
                                                <li data-value="{{ $industry->industry }}" class="option">
                                                    {{ $industry->industry }}
                                                </li>
                                            @endforeach
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

                        <div class="tab-pane fade list__style show active" role="tabpanel" id="list">
                            <div class="row g-30">
                                <!-- single item -->
                                @foreach ($jobs as $data)
                                    <div class="col-lg-12 position-relative style__gradient rts__job__card__big">
                                        @php
                                            $isSaved = in_array($data->id, $savedJobs ?? []);
                                        @endphp

                                        {{-- <button type="button" class="bookmark__btn"
                                            onclick="SaveJob( {{ $data->id }} )"
                                            data-saved="{{ $isSaved ? 'true' : 'false' }}"
                                            {{ $isSaved ? 'disabled' : '' }}>
                                            <i class="rt-bookmark {{ $isSaved ? 'filled bg-grey text-black' : '' }}"></i>
                                        </button> --}}
                                        <button type="button" class="bookmark__btn"
                                            onclick="SaveJob({{ $data->id }}, this)"
                                            data-saved="{{ $isSaved ? 'true' : 'false' }}">
                                            <i class="rt-bookmark {{ $isSaved ? 'filled bg-grey text-black' : '' }}"></i>
                                        </button>



                                        <div class="position-absolute top-0 end-0 m-2 z-100">


                                        </div>
                                        <div class="flex-wrap justify-content-between d-flex gap-4 align-items-center">
                                            <div
                                                class="d-flex flex-wrap flex-md-nowrap flex-lg-wrap flex-xl-nowrap gap-4 align-items-center w-100 position-relative">

                                                <!-- Company Logo -->
                                                <div class="company__icon rounded-2">
                                                    <img src="{{ parse_url($data->com_logo, PHP_URL_PATH) ?? '' }}"
                                                        onerror="this.onerror=null; this.src='{{ url('recruiter/logo/default.png') }}';"
                                                        alt="">
                                                </div>


                                                <!-- Job Meta -->
                                                <div class="job__meta w-100 d-flex flex-column gap-2 position-relative">

                                                    <!-- Bookmark Button (Top Right) -->


                                                    <!-- Clickable Overlay -->
                                                    <a href="{{ route('User.JobDetails', ['id' => encrypt($data->id)]) }}"
                                                        class="stretched-link"></a>

                                                    <!-- Title & Info -->
                                                    <div class="d-flex justify-content-between align-items-center gap-3">
                                                        <a id="title"
                                                            class="job__title h6 mb-0">{{ $data->title }}</a>
                                                    </div>
                                                    <p class="mb-0 text-muted">{{ $data->com_name }}</p>

                                                    <!-- Meta Info Row -->
                                                    <div class="d-flex gap-3 gap-md-4 flex-wrap mb-2">
                                                        <div class="d-flex gap-2 align-items-center" id="location">
                                                            <i class="fa-light fa-location-dot"></i> {{ $data->location }}
                                                        </div>
                                                        @if ($data->sal_status == 'off')
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <p> {{ $data->currency }} - Not disclosed</p>
                                                            </div>
                                                        @else
                                                            <div class="d-flex gap-2 align-items-center">
                                                                {{ $data->currency }} {{ $data->min_sal }} -
                                                                {{ $data->max_sal }}
                                                            </div>
                                                        @endif

                                                        <div class="d-flex gap-2 align-items-center" id="type">
                                                            <i class="fa-light rt-briefcase"></i> {{ $data->type }}
                                                        </div>
                                                        <div class="d-flex gap-2 align-items-center">
                                                            <i class="fa-light fa-clock"></i>
                                                            {{ $data->created_at->diffForHumans() }}
                                                        </div>
                                                    </div>

                                                    <!-- Skills -->
                                                    <div class="job__tags d-flex flex-wrap gap-3" id="skills">
                                                        @foreach (explode(',', $data->skills) as $skill)
                                                            <a href="#">{{ trim($skill) }}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- single item end -->

                            </div>
                        </div>
                    </div>



                    @php
                        $current = $jobs->currentPage();
                        $last = $jobs->lastPage();
                    @endphp

                    @if ($jobs->total() > $jobs->perPage())
                        <div class="rts__pagination mx-auto pt-60 max-content">
                            <ul class="d-flex gap-2">

                                {{-- Previous Page --}}
                                @if ($jobs->onFirstPage())
                                    <li><span class="inactive"><i class="rt-chevron-left"></i></span></li>
                                @else
                                    <li><a href="{{ $jobs->previousPageUrl() }}"><i class="rt-chevron-left"></i></a></li>
                                @endif

                                {{-- Always show page 1 --}}
                                <li><a href="{{ $jobs->url(1) }}" class="{{ $current == 1 ? 'active' : '' }}">1</a></li>

                                {{-- Middle Pages --}}
                                @for ($i = max(2, $current - 1); $i <= min($last - 1, $current + 1); $i++)
                                    <li><a href="{{ $jobs->url($i) }}"
                                            class="{{ $i == $current ? 'active' : '' }}">{{ $i }}</a></li>
                                @endfor

                                {{-- Right Ellipsis --}}
                                @if ($current < $last - 3)
                                    <li><span class="inactive">...</span></li>
                                @endif

                                {{-- Always show last page if more than 1 --}}
                                @if ($last > 1)
                                    <li><a href="{{ $jobs->url($last) }}"
                                            class="{{ $current == $last ? 'active' : '' }}">{{ $last }}</a></li>
                                @endif

                                {{-- Next Page --}}
                                @if ($jobs->hasMorePages())
                                    <li><a href="{{ $jobs->nextPageUrl() }}"><i class="rt-chevron-right"></i></a></li>
                                @else
                                    <li><span class="inactive"><i class="rt-chevron-right"></i></span></li>
                                @endif

                            </ul>
                        </div>
                    @endif



                </div>
            </div>
        </div>
    </div>
    <!-- job list one end -->

    <!-- app center -->

    {{-- <div class="rts__section pb-120">
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

    <!-- app center end -->

    {{--  --}}
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const categoryForm = document.getElementById("categoryForm");
            const hiddenInput = document.getElementById("selectedCategory");

            document.querySelectorAll(".industry-select .option").forEach(option => {
                option.addEventListener("click", function() {
                    const selectedValue = this.getAttribute("data-value");
                    hiddenInput.value = selectedValue; // Set the hidden input value
                    categoryForm.submit(); // Submit the form automatically
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Attach click handler to all options inside nice-select
            $('.select-location .list .option').on('click', function() {
                var selectedValue = $(this).data('value');
                var selectedText = $(this).text();

                // Update the displayed text
                $('.select-location .current').text(selectedText);

                // Set the hidden input value
                $('#selectedLocation').val(selectedValue);

                // Submit the form
                $('#locationForm').submit();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Listen for click events on the options inside nice-select
            $('.select-date .list .option').on('click', function() {
                var selectedDate = $(this).data('value'); // Get selected date value
                var selectedText = $(this).text(); // Get selected text

                // Update the displayed text inside the nice-select dropdown
                $('.select-date .current').text(selectedText);

                // Set the hidden input value with the selected date
                $('#selectedDate').val(selectedDate);

                // Submit the form
                $('#dateForm').submit();
            });
        });
    </script>

    <script>
        document.querySelectorAll('.type-select input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                document.getElementById('TypeForm').submit();
            });
        });
    </script>

    {{-- for Submit Experience --}}
    <script>
        document.querySelectorAll('.experience-select input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                document.getElementById('ExperienceForm').submit();
            });
        });
    </script>

    {{-- <script>
        function SaveJob(id) {
            $.ajax({
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('User.SaveJob') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status_code == 1) {
                        alert('Job saved successfully.');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401 && xhr.responseJSON?.redirect) {
                        // Redirect to login page manually
                        window.location.href = xhr.responseJSON.redirect;
                    } else {
                        alert('An error occurred while saving the job.');
                    }
                }
            });
        }

    </script> --}}

    <script>
        function SaveJob(id, el) {
            const isSaved = el.getAttribute('data-saved') === 'true';
            const url = isSaved ?
                "{{ route('User.RemoveSavedJob') }}" :
                "{{ route('User.SaveJob') }}";

            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    Toastify({
                        text: response.message,
                        duration: 2000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: response.status_code == 1 ? "#28a745" : "#dc3545",
                    }).showToast();

                    if (response.status_code == 1) {

                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401 && xhr.responseJSON?.redirect) {
                        window.location.href = xhr.responseJSON.redirect;
                    } else {
                        Toastify({
                            text: "Something went wrong.",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#dc3545",
                        }).showToast();
                    }
                }
            });
        }
    </script>
@endsection
