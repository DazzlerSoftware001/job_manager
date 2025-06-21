@extends('admin.adminlayout.main')
@section('title')
    Admin-General Setting
@endsection
@section('page-title')
   <div class="breadcrumb mt-2">
        {!! Breadcrumbs::render('Admin.GeneralSetting') !!}
    </div>

    <style>
        .breadcrumb {
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
@endsection

@section('main-container')
    <div class="main-content">
        <div class="page-content row">
            <div class="col-md-9">
                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">Change Logo</h4>
                    </div>
                    <form id="multiImageForm" enctype="multipart/form-data" method="POST" class="py-5">
                        @csrf
                        <div class="row" id="info">
                            <!-- Image 1 -->
                            <div class="col-md-4 my__details">
                                <div class="info__top d-flex align-items-center justify-content-center">
                                    <div class="author__image me-3">
                                        @if ($GeneralSetting !== null)
                                            <img id="preview1" src="{{ asset($GeneralSetting->logo) }}"
                                                onerror="this.onerror=null; this.src='{{ url('settings/logo/default.png') }}';"
                                                alt="" width="150" height="150">
                                        @else
                                            <img id="preview1" src="{{ url('settings/logo/default.png') }}" width="150"
                                                height="150">
                                        @endif

                                    </div>
                                    <div class="select__image">
                                        <label for="image1" class="btn btn-primary">Upload Logo</label>
                                        <input type="file" name="image1" id="image1" class="d-none" accept="image/*">
                                    </div>
                                </div>
                            </div>


                            <!-- Image 2 -->
                            <div class="col-md-4 my__details">
                                <div class="info__top d-flex align-items-center justify-content-center">
                                    <div class="author__image me-3">
                                        @if ($GeneralSetting !== null)
                                            <img id="preview2" src="{{ asset($GeneralSetting->light_logo) }}"
                                                onerror="this.onerror=null; this.src='{{ url('settings/logo/default.png') }}';"
                                                alt="" width="150" height="150">
                                        @else
                                            <img id="preview2" src="{{ url('settings/logo/default.png') }}" alt=""
                                                width="150" height="150">
                                        @endif
                                    </div>
                                    <div class="select__image">
                                        <label for="image2" class="btn btn-primary">Upload Light Logo</label>
                                        <input type="file" name="image2" id="image2" class="d-none" accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <!-- Image 3 -->
                            <div class="col-md-4 my__details">
                                <div class="info__top d-flex align-items-center justify-content-center">
                                    <div class="author__image me-3">
                                        @if ($GeneralSetting !== null)
                                            <img id="preview3" src="{{ asset($GeneralSetting->dark_logo) }}"
                                                onerror="this.onerror=null; this.src='{{ url('settings/logo/default.png') }}';"
                                                alt="" width="150" height="150">
                                        @else
                                            <img id="preview3" src="{{ url('settings/logo/default.png') }}" alt=""
                                                width="150" height="150">
                                        @endif
                                    </div>
                                    <div class="select__image">
                                        <label for="image3" class="btn btn-primary">Upload Favicon</label>
                                        <input type="file" name="image3" id="image3" class="d-none" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success">Submit All Images</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Upload Favicon --}}
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Change Favicon</h4>
                    </div>

                    <form id="FaviconForm" enctype="multipart/form-data" method="POST" class="py-5">
                        @csrf
                        <div class="d-flex justify-content-center mb-3">
                            <div class="author__image me-3">
                                @if ($GeneralSetting !== null)
                                    <img id="favicon" src="{{ asset($GeneralSetting->favicon) }}"
                                        onerror="this.onerror=null; this.src='{{ url('settings/logo/default.png') }}';"
                                        alt="" width="250" height="150">
                                @else
                                    <img id="favicon" src="{{ url('settings/logo/default.png') }}" alt=""
                                        width="250" height="150">
                                @endif
                            </div>
                        </div>

                        <div class="text-center">
                            <label for="faviconInput" class="btn btn-primary">Upload Favicon</label>
                            <input type="file" name="favicon" id="faviconInput" class="d-none" accept="image/*">
                        </div>
                    </form>
                </div>
            </div>


            <div class="row g-4">
                <!-- Site Title Section -->
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light border-bottom">
                            <h5 class="mb-0">Site Title</h5>
                        </div>
                        <form id="SiteTitle" action="javascript:void(0)" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row align-items-end">
                                    <div class="col-md-8">
                                        <label for="site_title" class="form-label">Enter Site Title</label>
                                        <input type="text" name="site_title" id="site_title" class="form-control"
                                            placeholder="e.g. CareerNest" value="{{ $GeneralSetting->site_title ?? '' }}"
                                            required>
                                    </div>
                                    <div class="col-md-4 mt-md-0 mt-3">
                                        <button type="submit" class="btn btn-success w-100">Update Title</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Timezone Section -->
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light border-bottom">
                            <h5 class="mb-0">Timezone</h5>
                        </div>
                        <form id="timezoneForm" method="POST" action="javascript:void(0)">
                            @csrf
                            <div class="card-body">
                                <div class="row align-items-end">
                                    <div class="col-md-8">
                                        <label for="timezone" class="form-label">Select Timezone</label>
                                        <select name="timezone" id="timezone" class="form-select" required>
                                            @php
                                                $currentTz = old(
                                                    'timezone',
                                                    $GeneralSetting->timezone ?? config('app.timezone'),
                                                );
                                            @endphp
                                            @foreach (timezone_identifiers_list() as $tz)
                                                <option value="{{ $tz }}"
                                                    {{ $currentTz === $tz ? 'selected' : '' }}>
                                                    {{ $tz }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-md-0 mt-3">
                                        <button type="submit" class="btn btn-success w-100">Update Timezone</button>
                                    </div>
                                </div>
                                {{-- <div class="mt-3">
                                    <p class="text-muted mb-0">Current Server Time: <strong>{{ now() }}</strong>
                                    </p>
                                </div> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            {{-- Clear Cache --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Clear Cache</h4>

                    </div>
                    <div class="col-12 mt-2 p-3 radius-2 bg-white">
                        <div class="row align-items-center">

                            <div class="col-md-2 mt-md-0 d-flex align-items-end">
                                <button class="btn btn-success w-80" id="clearCacheBtn">Clear Cache</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    @endsection

    @section('script')
        {{-- Update Profile Image --}}
        <script>
            $(document).ready(function() {
                // Preview handlers
                function readURL(input, previewId) {
                    if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            $(previewId).attr('src', e.target.result);
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $('#image1').change(function() {
                    readURL(this, '#preview1');
                });

                $('#image2').change(function() {
                    readURL(this, '#preview2');
                });

                $('#image3').change(function() {
                    readURL(this, '#preview3');
                });

                // Form submit handler
                $('#multiImageForm').submit(function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);

                    $.ajax({
                        url: "{{ route('Admin.Profilelogo') }}", // Your route
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Toastify({
                                text: response.message,
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
                        },
                        error: function() {
                            Toastify({
                                text: "Upload failed. Please try again.",
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

        {{-- Update Favicon --}}
        <script>
            $(document).ready(function() {
                function readURL(input, previewId) {
                    if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            $(previewId).attr('src', e.target.result);
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $('#faviconInput').change(function() {
                    readURL(this, '#favicon');
                    $('#FaviconForm').submit(); // Optional: auto-submit after file selected
                });

                $('#FaviconForm').submit(function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);

                    $.ajax({
                        url: "{{ route('Admin.Favicon') }}",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Toastify({
                                text: response.message,
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
                        },
                        error: function() {
                            Toastify({
                                text: "Upload failed. Please try again.",
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


        {{-- Update Site Title --}}
        <script>
            $(document).ready(function() {
                $('#SiteTitle').on('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    var url = "{{ route('Admin.SiteTitle') }}";
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
                                $('#EditModal').modal('hide');
                                $('#EditCompany').trigger("reset");
                                $('#myTable').DataTable().ajax.reload(null, false);
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

        {{-- Update Time Zone --}}
        <script>
            $(document).ready(function() {
                $('#timezoneForm').on('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    var url = "{{ route('Admin.Timezone') }}";
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
                                $('#EditModal').modal('hide');
                                $('#EditCompany').trigger("reset");
                                $('#myTable').DataTable().ajax.reload(null, false);
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


        {{-- Clear Cache --}}
        <script>
            $(document).ready(function() {
                $('#clearCacheBtn').on('click', function(event) {

                    var url = "{{ route('Admin.clearCache') }}";
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(result) {
                            if (result.status_code === 1) {
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
                                // setTimeout(function() {
                                //     location.reload();
                                // }, 750);
                            } else if (result.status_code === 0) {
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
