@extends('admin.adminlayout.main')
@section('title')
    Admin-Page Setting
@endsection
@section('page-title')
    Page Setting
@endsection
<style>
    .widget-box {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 16px;
        background-color: #fff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .widget-title {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .widget-description {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 15px;
    }

    .widget-item {
        border: 1px solid #e9ecef;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 10px;
        background-color: #f8f9fa;
    }

    .info__top {
        display: flex;
        align-items: center;
        gap: 30px;
        margin-bottom: 30px;
        margin-top: 30px;
    }

    @media screen and (max-width: 576px) {
        .info__top {
            flex-wrap: wrap;
        }
    }

    .info__top .author__image {
        background: var(--rts-gray);
        border-radius: 16px;
    }

    .info__top .author__image img {
        height: 160px;
        width: 160px;
        border-radius: 6px;
    }

    .select__image {
        position: relative;
    }
</style>
@section('main-container')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <form id="multiImageForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row" id="info">
                            <!-- Image 1 -->
                            <div class="col-md-4 my__details">
                                <div class="info__top text-center">
                                    <div class="author__image mb-2">
                                        <img id="preview1" src="{{ asset($footerLogo->logo) }}"
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
                                <div class="info__top text-center">
                                    <div class="author__image mb-2">
                                        <img id="preview2" src="{{ asset($footerLogo->light_logo) }}"
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
                                <div class="info__top text-center">
                                    <div class="author__image mb-2">
                                        <img id="preview3" src="{{ asset($footerLogo->dark_logo) }}"
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



                    <div class="col-md-6">
                        <div class="widget-box">
                            <div class="widget-title">Top Footer Sidebar</div>
                            <div class="widget-description">Top section of the footer for logo and social links.</div>
                            <div class="widget-item">Site logo</div>
                            <div class="widget-item">Social Links</div>
                        </div>
                    </div>


                    <!-- Inner Footer Sidebar -->
                    <div class="col-md-6">
                        <div class="widget-box">
                            <div class="widget-title">Inner Footer Sidebar</div>
                            <div class="widget-description">Inner footer section for site info, menus, and newsletter.</div>
                            <div class="widget-item">Site information</div>
                            <div class="widget-item">Simple Menu</div>
                            <div class="widget-item">Simple Menu</div>
                            <div class="widget-item">Newsletter form</div>
                        </div>
                    </div>

                    <!-- Bottom Footer Sidebar -->
                    <div class="col-md-6">
                        <div class="widget-box">
                            <div class="widget-title">Bottom Footer Sidebar</div>
                            <div class="widget-description">Bottom footer section for legal notices and credits.</div>
                            <div class="widget-item">Site Copyright</div>
                            <div class="widget-item">Simple Menu</div>
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
                    url: "{{ route('Admin.FooterProfilelogo') }}", // Your route
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
@endsection
