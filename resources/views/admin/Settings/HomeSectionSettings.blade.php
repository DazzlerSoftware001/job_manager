@extends('admin.adminlayout.main')
@section('title')
    Admin-General Setting
@endsection
@section('page-title')
    Home Section Setting
@endsection

@section('main-container')
    <div class="main-content">
        <div class="page-content row">
            <form action="javascript:void(0)" method="post" class="row w-100" id="BannerForm" enctype="multipart/form-data">

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Banner Title</h4>
                        </div>
                        <div class="card-body">
                            {{-- <input type="text" name="banner_title" id="banner_title" class="form-control"> --}}
                            <input type="text" name="banner_title" id="banner_title" class="form-control"
                                value="{{ old('banner_title', $HomeSection->banner_title ?? '') }}">

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Banner Filter</h4>
                        </div>
                        <div class="card-body">
                            {{-- <select name="banner_filter" id="banner_filter" class="form-control">
                                <option value="">-- Select Filter --</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select> --}}
                            <select name="banner_filter" id="banner_filter" class="form-control">
                                <option value="">-- Select Filter --</option>
                                <option value="1"
                                    {{ old('banner_filter', $HomeSection->banner_filter ?? '') == '1' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0"
                                    {{ old('banner_filter', $HomeSection->banner_filter ?? '') == '0' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>

                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Banner Desc</h4>
                        </div>
                        <div class="card-body">
                            {{-- <textarea name="banner_desc" id="banner_desc" cols="30" rows="10"class="form-control"></textarea> --}}
                            <textarea name="banner_desc" id="banner_desc" cols="30" rows="10" class="form-control">{{ old('banner_desc', $HomeSection->banner_desc ?? '') }}</textarea>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Banner Image</h4>
                        </div>
                        <div class="card-body">
                            {{-- <input type="file" name="banner_image" id="banner_image" class="form-control"> --}}
                            @if (!empty($HomeSection->banner_image))
                                <div class="mb-2">
                                    <img src="{{ asset($HomeSection->banner_image) }}" alt="Banner Image" width="100">
                                </div>
                            @endif
                            <input type="file" name="banner_image" id="banner_image" class="form-control">

                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-3 text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>

    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#BannerForm').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                var url = "{{ route('Admin.SubmitHomeSection') }}";
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
                        if (result.status_code === 1) {
                            Toastify({
                                text: result.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "#28a745",
                                },
                            }).showToast();
                            setTimeout(function() {
                                location.reload();
                            }, 750);
                        } else if (result.status_code === 2) {
                            Toastify({
                                text: result.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "#c7ac14",
                                },
                            }).showToast();
                        } else {
                            Toastify({
                                text: result.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "#c7ac14",
                                },
                            }).showToast();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        Toastify({
                            text: 'An error occurred. Please try again.',
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            style: {
                                background: "#dc3545",
                            },
                        }).showToast();
                    }
                });
            });
        });
    </script>
@endsection
