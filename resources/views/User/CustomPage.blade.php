@extends('User.UserLayout.main')
@section('title')
    {{ Str::ucfirst($page->title) }}
@endsection
@section('main-container')
    <style>
        .about-content ul {
            list-style-type: disc;
            padding-left: 20px;
            margin-bottom: 1em;
        }

        .about-content ol {
            list-style-type: decimal;
            padding-left: 20px;
            margin-bottom: 1em;
        }

        .about-content li {
            margin-bottom: 0.5em;
        }
    </style>
    <!-- breadcrumb area -->
    <div class="rts__section breadcrumb__background">
        <div class="container">
            <div class="row">
                @php
                    use Illuminate\Support\Str;
                @endphp
                <div class="col-lg-12 position-relative d-flex justify-content-between align-items-center">
                    <div class="breadcrumb__area max-content breadcrumb__padding z-2">
                        <h1 class="breadcrumb-title h3 mb-3">{{ Str::ucfirst($page->title) }}</h1>
                        {{-- <nav>
                            <ul class="breadcrumb m-0 lh-1">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ Str::ucfirst($page->title) }}</li>
                            </ul>
                        </nav> --}}
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

    <div class="rts__section section__padding">
        <div class="container about-content">
            {!! html_entity_decode($page->content) !!}
        </div>
    </div>
@endsection
