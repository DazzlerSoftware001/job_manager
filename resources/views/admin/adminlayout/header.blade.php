<!doctype html>
<html lang="en">

    
    <head>

        @php
        use App\Models\GeneralSetting;
            $title = GeneralSetting::value('site_title');
        @endphp

        <meta charset="utf-8" />
        <title>{{ $GeneralSetting->site_title ?? 'CareerNest' }} -
            @yield('title')
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Dazzler Software" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{url('admin/assets/images/favicon.ico')}}">
        <link rel="stylesheet" href="{{url('admin/assets/libs/gridjs/theme/mermaid.min.css')}}">
        <!-- Bootstrap Css -->
        <link href="{{url('admin/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{url('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{url('admin/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <!-- SweetAlert2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.4/dist/sweetalert2.min.css" rel="stylesheet">

        <link href="{{url('style.css')}}" id="style" rel="stylesheet" type="text/css" />

   
   
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <!-- Toastify CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">

    </head>
