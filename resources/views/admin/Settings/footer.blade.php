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
</style>
@section('main-container')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="my__details" id="info">
                        <div class="info__top">
                            <div class="author__image">
                                <img id="profileImage" src=""
                                    onerror="this.onerror=null; this.src='{{ url('user/assets/img/profile/default.png') }}';"
                                    alt="">
                            </div>
                            <div class="select__image">
                                <button for="imageInput" id="editImageButton" class="file-upload__label">Upload New
                                    Photo</button>
                                <input type="file" id="imageInput" class="d-none" accept="image/*">
                            </div>
                        </div>
                    </div>
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
