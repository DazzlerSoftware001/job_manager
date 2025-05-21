@extends('admin.adminlayout.main')
@section('title')
    Admin-Page Setting
@endsection
@section('page-title')
    Footer Setting
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

    /* Container and Layout */
    .social__links {
        background: #fff;
        border-radius: 16px;
        padding: 30px;
        /* margin-top: 20px; */
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
    }

    .info__field {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* Input Group Styling */
    .rt-input-group {
        display: flex;
        flex-direction: column;
    }

    .rt-input-group label {
        font-weight: 500;
        margin-bottom: 6px;
        font-size: 14px;
        color: #333;
    }

    .rt-input-group input {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px 15px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .rt-input-group input:focus {
        border-color: #007bff;
        outline: none;
    }

    /* Buttons */
    .added__social__links,
    .remove-social {
        padding: 10px 20px;
        font-size: 14px;
        border-radius: 8px;
        cursor: pointer;
    }

    .added__social__links {
        background-color: #007bff;
        color: #fff;
        border: none;
    }

    .added__social__links:hover {
        background-color: #0056b3;
    }

    .remove-social {
        background-color: #dc3545;
        color: #fff;
        border: none;
    }

    .remove-social:hover {
        background-color: #bd2130;
    }

    /* Responsive Layout */
    @media (max-width: 768px) {

        .social-group .col-sm-3,
        .social-group .col-sm-6,
        .social-group .col-sm-2 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>
@section('main-container')
    <div class="main-content">
        <div class="page-content">
            {{-- <div class="col-md-12">
                <div class="widget-box">
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
                </div>
            </div> --}}

            <!-- Inner Footer Sidebar -->
            <div class="col-md-12">
                <div class="widget-box">
                    <form method="POST" action="{{ route('Admin.FooterSettings') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $footer->description ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label>Links</label>
                            <textarea name="links" class="form-control" rows="5">{{ json_encode($footer->links ?? [], JSON_PRETTY_PRINT) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control"
                                value="{{ old('address', $footer->address ?? '') }}">
                        </div>

                        <div class="mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone', $footer->phone ?? '') }}">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $footer->email ?? '') }}">
                        </div>

                        <div class="mb-3">
                            <label>Social Links</label>

                            @php
                                $socialLinks = [];

                                if (!empty($footer->social_links)) {
                                    if (is_string($footer->social_links)) {
                                        $socialLinks = json_decode($footer->social_links, true) ?? [];
                                    } elseif (is_array($footer->social_links)) {
                                        $socialLinks = $footer->social_links;
                                    }
                                }
                            @endphp

                            <div class="social__links p-30 radius-16 bg-white" id="social">
                                <div class="info__field" id="socialFields">
                                    <!-- Example of Additional Social Fields -->
                                    @foreach ($socialLinks as $name => $link)
                                        <div class="row g-3 social-group align-items-end">
                                            <div class="col-sm-3">
                                                <div class="rt-input-group">
                                                    <label>Media Name</label>
                                                    <input type="text" name="social_name[]" value="{{ $name }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="rt-input-group">
                                                    <label>Media Link</label>
                                                    <input type="url" name="social_link[]" value="{{ $link }}"
                                                        placeholder="https://{{ strtolower($name) }}.com/yourprofile">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" class="btn btn-danger remove-social">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Add Button -->
                                <div class="d-block mt-3">
                                    <button type="button" class="added__social__links btn btn-primary">
                                        Add Another Network
                                    </button>
                                </div>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label>Copyright</label>
                            <input type="text" name="copyright" class="form-control"
                                value="{{ old('copyright', $footer->copyright ?? '') }}">
                        </div>

                        <button class="btn btn-primary">Update Footer</button>
                    </form>
                </div>

                <!-- Bottom Footer Sidebar -->
                {{-- <div class="col-md-6">
                        <div class="widget-box">
                            <div class="widget-title">Bottom Footer Sidebar</div>
                            <div class="widget-description">Bottom footer section for legal notices and credits.</div>
                            <div class="widget-item">Site Copyright</div>
                            <div class="widget-item">Simple Menu</div>
                        </div>
                    </div> --}}







            </div>
        </div>
    </div>
@endsection
@section('script')

    {{-- Add Social Links Fields --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addButton = document.querySelector('.added__social__links');
            const socialFields = document.querySelector('#socialFields');

            addButton.addEventListener('click', function() {
                const row = document.createElement('div');
                row.classList.add('row', 'g-3', 'social-group', 'align-items-end');
                row.innerHTML = `
            <div class="col-sm-3">
                <div class="rt-input-group">
                    <label>Media Name</label>
                    <input type="text" name="social_name[]" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="rt-input-group">
                    <label>Media Link</label>
                    <input type="url" name="social_link[]" placeholder="https://example.com/yourprofile" required>
                </div>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-danger remove-social">Remove</button>
            </div>
        `;
                socialFields.appendChild(row);
            });

            // Remove button functionality
            socialFields.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-social')) {
                    e.target.closest('.social-group').remove();
                }
            });
        });
    </script>
@endsection
