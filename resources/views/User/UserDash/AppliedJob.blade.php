@extends('User.UserDashLayout.main')
@section('title')
    Applied Job
@endsection
@section('main-container')
    <div class="applied__job__info radius-16">

        {{-- <div class="job__filter">
            <div class="search__job">
                <div class="position-relative">
                    <input type="text" id="search" placeholder="Find Top Employer" required="">
                    <i class="fa-light fa-magnifying-glass"></i>
                </div>
            </div>
            <div class="filter__job">
                <div class="nice-select filter__select">
                    <span class="current">All Category</span>
                    <ul class="list">
                        <li data-value="Nothing" data-display="All Category" class="option selected focus">All Category</li>
                        <li data-value="1" class="option">Dhaka</li>
                        <li data-value="2" class="option">Part time</li>
                        <li data-value="3" class="option">Full Time</li>
                        <li data-value="4" class="option">Government</li>
                        <li data-value="5" class="option">NGO</li>
                        <li data-value="6" class="option">Private</li>
                    </ul>
                </div>
            </div>
        </div> --}}

        @if (count($jobDetails) > 0)
            <div class="applied__job__list">
                <!-- single job -->
                @foreach ($jobDetails as $job)
                    <div class="single__applied__job">
                        <div class="single__applied__job__content">
                            <div class="icon">
                                <img src="{{ asset($job->com_logo) }}"
                                    onerror="this.onerror=null; this.src='{{ url('company/logo/default.png') }}';"
                                    alt="">
                            </div>
                            <div class="content__flex">
                                <div class="content">
                                    <a href="#">
                                        <h6><a
                                                href="{{ route('User.JobDetails', ['id' => encrypt($job->id)]) }}">{{ $job->title }}</a>
                                        </h6>
                                    </a>
                                    <p>{{ $job->com_name }}</p>
                                    <div class="content__info">
                                        <span><i class="fa-light fa-location-dot"></i> {{ $job->location }}</span>
                                        <span><i class="fa-light fa-briefcase"></i>{{ $job->type }}</span>
                                        <span><i class="fa-light fa-clock"></i>
                                            {{ $job->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <div class="tags">
                                    @foreach (explode(',', $job->skills) as $skill)
                                        <a href="#">{{ trim($skill) }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="action">
                            <a href="{{ route('User.JobDetails', ['id' => encrypt($job->id)]) }}">
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
                        </div>
                    </div>
                @endforeach
                <!--single job end  -->

            </div>
            <div class="rts__pagination mx-auto pt-60 max-content">
                <ul class="d-flex gap-2">
                    {{-- Previous Page Link --}}
                    @if ($jobDetails->onFirstPage())
                        <li><span class="inactive"><i class="rt-chevron-left"></i></span></li>
                    @else
                        <li><a href="{{ $jobDetails->previousPageUrl() }}"><i class="rt-chevron-left"></i></a></li>
                    @endif

                    {{-- Pagination Numbers --}}
                    @for ($page = 1; $page <= $jobDetails->lastPage(); $page++)
                        <li>
                            <a href="{{ $jobDetails->url($page) }}"
                                class="{{ $page == $jobDetails->currentPage() ? 'active' : '' }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endfor

                    {{-- Next Page Link --}}
                    @if ($jobDetails->hasMorePages())
                        <li><a href="{{ $jobDetails->nextPageUrl() }}"><i class="rt-chevron-right"></i></a></li>
                    @else
                        <li><span class="inactive"><i class="rt-chevron-right"></i></span></li>
                    @endif
                </ul>
            </div>
        @else
            <div class="text-center py-10 bg-gray-100 rounded-lg shadow-sm">
                <div class="flex flex-col items-center justify-center">
                    <h4 class="text-lg font-semibold text-gray-600">No Applied jobs</h4>
                    <p class="text-sm text-gray-500 mt-1">Jobs you Apply will appear here.</p>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script></script>
@endsection
