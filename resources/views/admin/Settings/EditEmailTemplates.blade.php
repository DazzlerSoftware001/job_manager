@extends('admin.adminlayout.main')
@section('title')
    Admin-Edit Email Templates
@endsection
@section('page-title')
    Edit Email Templates
@endsection

@section('main-container')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
    <style>
        .choices {
            border: var(--bs-border-width) solid var(--bs-border-color);
            border-radius: var(--bs-border-radius);
            overflow: hidden;
            line-height: 0.8;
            height: 38px;
        }

        .choices__inner {
            background-color: var(--bs-secondary-bg);
            color: var(--bs-body-color);
        }

        .choices__list--single .choices__item {
            color: #000000;
        }

        .choices[data-type*=select-one] .choices__input {
            display: block;
            width: 100%;
            border: 1px solid #a29898 !important;
            background-color: #ffffff;
            border-radius: 10px;
        }

        .is-focused .choices__inner,
        .is-open .choices__inner {
            border: var(--bs-border-width) solid var(--bs-border-color);
            border-radius: var(--bs-border-radius);
        }

        .choices[data-type*="select-one"]::after {
            content: "";
            width: 12px;
            /* Adjust based on your icon size */
            height: 12px;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2322354e' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            position: absolute;
            right: 15px;
            top: 60%;
            /* Keep it centered */
            transform: translateY(-50%);
            /* Ensure it remains vertically aligned */
            pointer-events: none;
            border: none;
            /* Remove existing arrow */
            transition: transform 0.3s ease;
            /* Smooth transition */
        }

        /* When select box is open, rotate the arrow */
        .choices[data-type*="select-one"].is-open::after {
            transform: translateY(-90%) rotate(180deg);
        }



        .choices[data-type*="select-one"].is-open::after {
            border-color: transparent transparent #333;
            margin-top: 2px;

        }
    </style>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ $EmailTemplates->name }}</h4>
                            </div>

                            {{-- <div class="px-3 mt-3 d-flex align-items-center gap-2">
                                <input type="text" id="search" name="search"
                                    class="form-control form-control-sm bg-light rounded w-25" placeholder="Search...">
                                <button class="btn btn-primary btn-sm">
                                        + Create Job
                                    </button> 
                            </div> --}}

                            <div class="card">
                                <div class="card-body pb-0">
                                    <form method="POST" action="javascript:void(0)" id="UpdateEmailTemplate"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <input type="hidden" name="edit-id" id="edit-id"
                                                value="{{ $EmailTemplates->id }}">
                                            <div class="col-xl-12">
                                                <label for="slug">Job Title <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="slug" name="slug"
                                                    value="{{ $EmailTemplates->slug }}" placeholder="Enter Template Name">
                                            </div>


                                            <div class="col-xl-4 mt-3">
                                                <label for="subject">Subject <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    value="{{ $EmailTemplates->subject }}" id="subject" name="subject">
                                            </div>

                                            <div class="d-flex justify-content-center mt-3">
                                                <div class="col-xl-12">
                                                    <label for="description">Description <span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control" id="description" name="description">{{ $EmailTemplates->body }}</textarea>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="col-12 mb-3">
                                            <button type="submit" class="btn btn-primary">Update Template</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- end card body -->
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>



        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('script')
    <!-- Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#description').summernote({
                height: 300, // set editor height
                placeholder: 'Write your content here...'
            });
        });
    </script>

    {{--For Update EmailTemplate --}}
    <script>
        $(document).ready(function() {
            $('#UpdateEmailTemplate').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                var url = "{{ route('Admin.UpdateEmailTemplate') }}"; // Submission URL
                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    success: function(result) {
                        if (result.status === 1) {
                            Toastify({
                                text: result.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "green",
                                    color: "white"
                                }
                            }).showToast();

                            // Redirect to another route after successful submission
                            setTimeout(function() {
                                window.location.href =
                                    "{{ route('Admin.EmailTemplates') }}"; // Change this to your desired route
                            }, 1500);
                        } else if (result.status === 2) {
                            Toastify({
                                text: result.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "#c7ac14",
                                    color: "white"
                                }
                            }).showToast();
                        } else {
                            Toastify({
                                text: result.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "red",
                                    color: "white"
                                }
                            }).showToast();
                        }
                    },
                    error: function(xhr, status, error) {
                        // console.error('AJAX Error:', error);
                        Toastify({
                            text: 'An error occurred. Please try again.',
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            style: {
                                background: "red",
                                color: "white"
                            }
                        }).showToast();
                    }
                });
            });
        });
    </script>
@endsection
