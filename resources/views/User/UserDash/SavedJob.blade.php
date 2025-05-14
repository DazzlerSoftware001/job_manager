@extends('User.UserDashLayout.main')
@section('title')
    Saved Job
@endsection
@section('main-container')
    <div class="applied__job__info radius-16">

        <div class="applied__job__list">

            <!-- single job -->
            @if (count($savedJobs) > 0)
                @foreach ($savedJobs as $saved)
                    @php
                        $job = $saved['job_post'];
                    @endphp

                    <div class="single__applied__job">
                        <div class="single__applied__job__content">
                            <div class="icon">
                                {{-- <img src="{{ asset($job['com_logo']) ?? url('company/logo/default.png')}}" alt=""> --}}
                                <img src="{{ $job['com_logo'] ? asset($job['com_logo']) : asset('company/logo/default.png') }}"  onerror="this.onerror=null; this.src='{{ url('company/logo/default.png') }}';"
                                    alt="">

                            </div>
                            <div class="content__flex">
                                <div class="content">
                                    <a href="#">
                                        <h6>{{ $job['title'] ?? 'No Title' }}</h6>
                                    </a>
                                    <p>{{$job['com_name']}}</p>
                                    <div class="content__info">
                                        <span><i class="fa-light fa-location-dot"></i>
                                            {{ $job['location'] ?? 'N/A' }}</span>
                                        <span><i class="fa-light fa-briefcase"></i> {{ $job['type'] ?? 'N/A' }}</span>
                                        <span><i class="fa-light fa-clock"></i>
                                            {{ \Carbon\Carbon::parse($job['created_at'])->diffForHumans() ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                                {{-- <div class="tags">
                                    {{ $job['skills'] ?? 'No skills' }}
                                </div> --}}
                                <div class="job__tags d-flex flex-wrap gap-3" id="skills">
                                    @foreach (explode(',', $job['skills']) as $skill)
                                        <a href="">{{ trim($skill) }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="action">
                            <a href="{{ route('User.JobDetails', ['id' => encrypt($job['id'])]) }}">
                                <button class="action__btn" type="button">
                                    <svg width="22" height="16" viewBox="0 0 22 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20.544 7.045C20.848 7.471 21 7.685 21 8C21 8.316 20.848 8.529 20.544 8.955C19.178 10.871 15.689 15 11 15C6.31 15 2.822 10.87 1.456 8.955C1.152 8.529 1 8.315 1 8C1 7.684 1.152 7.471 1.456 7.045C2.822 5.129 6.311 1 11 1C15.69 1 19.178 5.13 20.544 7.045Z"
                                            stroke="#0B0D28" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M14 8C14 7.20435 13.6839 6.44129 13.1213 5.87868C12.5587 5.31607 11.7956 5 11 5C10.2044 5 9.44129 5.31607 8.87868 5.87868C8.31607 6.44129 8 7.20435 8 8C8 8.79565 8.31607 9.55871 8.87868 10.1213C9.44129 10.6839 10.2044 11 11 11C11.7956 11 12.5587 10.6839 13.1213 10.1213C13.6839 9.55871 14 8.79565 14 8Z"
                                            stroke="#0B0D28" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </a>
                            <form id="RemoveJob">
                                <button class="action__btn delete-saved-job" type="button" data-id="{{ $job['id'] }}">
                                    <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8 4.25H12C12 3.71957 11.7893 3.21086 11.4142 2.83579C11.0391 2.46071 10.5304 2.25 10 2.25C9.46957 2.25 8.96086 2.46071 8.58579 2.83579C8.21071 3.21086 8 3.71957 8 4.25ZM6.5 4.25C6.5 3.79037 6.59053 3.33525 6.76642 2.91061C6.94231 2.48597 7.20012 2.10013 7.52513 1.77513C7.85013 1.45012 8.23597 1.19231 8.66061 1.01642C9.08525 0.84053 9.54037 0.75 10 0.75C10.4596 0.75 10.9148 0.84053 11.3394 1.01642C11.764 1.19231 12.1499 1.45012 12.4749 1.77513C12.7999 2.10013 13.0577 2.48597 13.2336 2.91061C13.4095 3.33525 13.5 3.79037 13.5 4.25H19.25C19.4489 4.25 19.6397 4.32902 19.7803 4.46967C19.921 4.61032 20 4.80109 20 5C20 5.19891 19.921 5.38968 19.7803 5.53033C19.6397 5.67098 19.4489 5.75 19.25 5.75H17.93L16.76 17.861C16.6702 18.789 16.238 19.6502 15.5477 20.2768C14.8573 20.9034 13.9583 21.2504 13.026 21.25H6.974C6.04186 21.2501 5.1431 20.903 4.45295 20.2765C3.7628 19.6499 3.33073 18.7888 3.241 17.861L2.07 5.75H0.75C0.551088 5.75 0.360322 5.67098 0.21967 5.53033C0.0790175 5.38968 0 5.19891 0 5C0 4.80109 0.0790175 4.61032 0.21967 4.46967C0.360322 4.32902 0.551088 4.25 0.75 4.25H6.5ZM8.5 9C8.5 8.80109 8.42098 8.61032 8.28033 8.46967C8.13968 8.32902 7.94891 8.25 7.75 8.25C7.55109 8.25 7.36032 8.32902 7.21967 8.46967C7.07902 8.61032 7 8.80109 7 9V16.5C7 16.6989 7.07902 16.8897 7.21967 17.0303C7.36032 17.171 7.55109 17.25 7.75 17.25C7.94891 17.25 8.13968 17.171 8.28033 17.0303C8.42098 16.8897 8.5 16.6989 8.5 16.5V9ZM12.25 8.25C12.4489 8.25 12.6397 8.32902 12.7803 8.46967C12.921 8.61032 13 8.80109 13 9V16.5C13 16.6989 12.921 16.8897 12.7803 17.0303C12.6397 17.171 12.4489 17.25 12.25 17.25C12.0511 17.25 11.8603 17.171 11.7197 17.0303C11.579 16.8897 11.5 16.6989 11.5 16.5V9C11.5 8.80109 11.579 8.61032 11.7197 8.46967C11.8603 8.32902 12.0511 8.25 12.25 8.25ZM4.734 17.717C4.78794 18.2736 5.04724 18.7903 5.46137 19.1661C5.87549 19.542 6.41475 19.7501 6.974 19.75H13.026C13.5853 19.7501 14.1245 19.542 14.5386 19.1661C14.9528 18.7903 15.2121 18.2736 15.266 17.717L16.424 5.75H3.576L4.734 17.717Z"
                                            fill="#FF5757" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-10 bg-gray-100 rounded-lg shadow-sm">
                    <div class="flex flex-col items-center justify-center">
                        <h4 class="text-lg font-semibold text-gray-600">No saved jobs</h4>
                        <p class="text-sm text-gray-500 mt-1">Jobs you save will appear here.</p>
                    </div>
                </div>
            @endif

            {{-- <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade list__style show active" role="tabpanel" id="list">
                    <div class="row g-30">
                        <!-- single item -->
                        @foreach ($savedJobs as $saved)
                        @php
                            $job = $saved['job_post'];
                        @endphp
    
                            <div class="col-lg-12 position-relative style__gradient rts__job__card__big">
                                @php
                                    $isSaved = in_array($job['id'], $savedJobs ?? []);
                                @endphp

                                <button type="button" class="bookmark__btn"
                                    onclick="handleBookmarkClick(event, {{ $job['id'] }}, this)"
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
                                            <img src="{{ parse_url($job['com_logo'], PHP_URL_PATH) ?? '' }}"
                                                onerror="this.onerror=null; this.src='{{ url('recruiter/logo/default.png') }}';"
                                                alt="">
                                        </div>


                                        <!-- Job Meta -->
                                        <div class="job__meta w-100 d-flex flex-column gap-2 position-relative">

                                            <!-- Bookmark Button (Top Right) -->


                                            <!-- Clickable Overlay -->
                                            <a href="{{ route('User.JobDetails', ['id' => encrypt($job['id'])]) }}"
                                                class="stretched-link"></a>

                                            <!-- Title & Info -->
                                            <div class="d-flex justify-content-between align-items-center gap-3">
                                                <a id="title"
                                                    class="job__title h6 mb-0">{{ $job['title'] }}</a>
                                            </div>
                                            <p class="mb-0 text-muted">{{ $job['com_name'] }}</p>

                                            <!-- Meta Info Row -->
                                            <div class="d-flex gap-3 gap-md-4 flex-wrap mb-2">
                                                <div class="d-flex gap-2 align-items-center" id="location">
                                                    <i class="fa-light fa-location-dot"></i> {{ $job['location'] }}
                                                </div>
                                                @if ($job['sal_status'] == 'off')
                                                    <div class="d-flex gap-2 align-items-center">
                                                        <p> {{ $job['currency'] }} - Not disclosed</p>
                                                    </div>
                                                @else
                                                    <div class="d-flex gap-2 align-items-center">
                                                        {{ $job['currency'] }} {{ $job['min_sal'] }} -
                                                        {{ $job['max_sal'] }}
                                                    </div>
                                                @endif

                                                <div class="d-flex gap-2 align-items-center" id="type">
                                                    <i class="fa-light rt-briefcase"></i> {{ $job['type'] }}
                                                </div>
                                                <div class="d-flex gap-2 align-items-center">
                                                    <i class="fa-light fa-clock"></i>
                                                    {{ \Carbon\Carbon::parse($job['created_at'])->diffForHumans() ?? 'N/A' }}
                                                </div>
                                            </div>

                                            <!-- Skills -->
                                            <div class="job__tags d-flex flex-wrap gap-3" id="skills">
                                                @foreach (explode(',', $job['skills']) as $skill)
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
            </div> --}}


            <!--single job end  -->

        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-saved-job').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const id = this.getAttribute('data-id');
                    fetch('{{ route('User.RemoveSavedJob') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                job_id: id
                            })
                        })
                        .then(response => response.json())
                        .then(result => {
                            let toastClass = 'bg-success';
                            if (result.status_code == 2) toastClass = 'bg-warning';
                            if (result.status_code != 1 && result.status_code != 2) toastClass =
                                'bg-danger';

                            Toastify({
                                text: result.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                className: toastClass
                            }).showToast();

                            if (result.status_code == 1) {
                                // Remove the job element
                                this.closest('.single__applied__job').remove();

                                // Redirect or reload
                                setTimeout(() => {
                                    if (result.redirect_url) {
                                        window.location.href = result.redirect_url;
                                    } else {
                                        location.reload();
                                    }
                                }, 750);
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            Toastify({
                                text: "Something went wrong!",
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                className: "bg-danger"
                            }).showToast();
                        });
                });
            });
        });
    </script>
@endsection
