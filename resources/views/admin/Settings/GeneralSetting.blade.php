@extends('admin.adminlayout.main')
@section('title')
    Admin-General Setting
@endsection
@section('page-title')
    General Setting
@endsection

@section('main-container')
    <div class="main-content">
        <div class="page-content">
            <div class="col-md-12">
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
                                        <img id="preview1" src="{{ asset($GeneralSetting->logo) }}"
                                            onerror="this.onerror=null; this.src='{{ url('settings/footer/logo/default.png') }}';"
                                            alt="" width="150" height="150">
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
                                        <img id="preview2" src="{{ asset($GeneralSetting->light_logo) }}"
                                            onerror="this.onerror=null; this.src='{{ url('settings/footer/logo/default.png') }}';"
                                            alt="" width="150" height="150">
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
                                        <img id="preview3" src="{{ asset($GeneralSetting->dark_logo) }}"
                                            onerror="this.onerror=null; this.src='{{ url('settings/footer/logo/default.png') }}';"
                                            alt="" width="150" height="150">
                                    </div>
                                    <div class="select__image">
                                        <label for="image3" class="btn btn-primary">Upload Dark Logo</label>
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

            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">Site Title</h4>
                    </div>
                    <form action="javascript:void(0)" id="SiteTitle" class="p-3">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <input type="text" name="site_title" id="site_title" class="form-control"
                                    placeholder="Enter your site title" value="{{ $GeneralSetting->site_title ?? '' }}"
                                    required>
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="submit" class="btn btn-success w-100">Update Title</button>
                            </div>
                        </div>
                    </form>
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
    @endsection
