<!DOCTYPE html>
<html lang="en">

<!--  candidate-dashboard.html   11:19:01 GMT -->

<head>

    <meta charset="UTF-8">
    @php
        use App\Models\GeneralSetting;
        $title = GeneralSetting::value('site_title');
    @endphp

    <title>{{ $title ?? 'CareerNest' }} - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="Your Ultimate Job HTML Template">
    <meta name="keywords" content="Job, Resume, Employer, Agency">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- for open graph social media -->
    <meta property="og:title" content="Your Ultimate Job HTML Template">
    <meta property="og:description" content="Your Ultimate Job HTML Template">
    <meta property="og:image" content="../../../www.example.com/image.html">
    <!-- for twitter sharing -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Your Ultimate Job HTML Template">
    <meta name="twitter:description" content="Your Ultimate Job HTML Template">
    <!-- fabicon -->
    <link rel="shortcut-icon" href="{{ url('user/assets/img/favicon-16x16.png') }}" type="image/x-icon">



    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&amp;display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="{{ url('user/assets/img/favicon.ico') }}" type="image/x-icon">
    <title>careernext - Job Seeker &amp; Job Holder HTML Template</title>
    <!-- rt icons -->
    <link rel="stylesheet" href="{{ url('user/assets/fonts/icon/css/rt-icons.css') }}">
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ url('user/assets/fonts/fontawesome/fontawesome.min.css') }}">
    <!-- all plugin css -->
    <link rel="stylesheet" href="{{ url('user/assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ url('user/assets/css/style.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.4/dist/sweetalert2.min.css" rel="stylesheet">
</head>
