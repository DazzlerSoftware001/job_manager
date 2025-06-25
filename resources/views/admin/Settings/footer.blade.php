@extends('admin.adminlayout.main')
@section('title')
    Admin-Page Setting
@endsection
@section('page-title')
    <div class="breadcrumb mt-2">
        {!! Breadcrumbs::render('Admin.Footer') !!}
    </div>

    <style>
        .breadcrumb {
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
@endsection
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Optional: Make icons visible and aligned */
    .select2-results__option i,
    .select2-selection__rendered i {
        margin-right: 8px;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid #ced4da;
        /* Bootstrap input border */
        height: 41px;
        /* Matches default input height */
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.5;
        border-radius: 4px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 24px;
        /* Adjusts vertical alignment */
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
        right: 10px;
    }


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
                    <form method="POST" action="javascript:void(0)" enctype="multipart/form-data" id="FooterSettings">
                        @csrf

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $footer->description ?? '') }}</textarea>
                        </div>

                        {{-- <div class="mb-3">
                            <label>Links</label>
                            <textarea name="links" class="form-control" rows="5">{{ json_encode($footer->links ?? [], JSON_PRETTY_PRINT) }}</textarea>
                        </div> --}}

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
                                    @foreach ($socialLinks as $social)
                                        <div class="row g-3 social-group align-items-end">
                                            <div class="col-sm-3">
                                                <div class="rt-input-group">
                                                    <label>Media Name</label>
                                                    <input type="text" name="social_name[]"
                                                        value="{{ $social['name'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="rt-input-group">
                                                    <label>Select Icon</label>
                                                    <select name="social_icon[]" class="icon-select form-select" required>
                                                        <option value="">Select Icon</option>
                                                        <option value="fa-brands fa-facebook-f"
                                                            data-icon="fa-brands fa-facebook-f"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-facebook-f' ? 'selected' : '' }}>
                                                            Facebook</option>
                                                        <option value="fa-brands fa-twitter"
                                                            data-icon="fa-brands fa-twitter"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-twitter' ? 'selected' : '' }}>
                                                            Twitter</option>
                                                        <option value="fa-brands fa-instagram"
                                                            data-icon="fa-brands fa-instagram"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-instagram' ? 'selected' : '' }}>
                                                            Instagram</option>
                                                        <option value="fa-brands fa-linkedin-in"
                                                            data-icon="fa-brands fa-linkedin-in"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-linkedin-in' ? 'selected' : '' }}>
                                                            LinkedIn</option>
                                                        <option value="fa-brands fa-youtube"
                                                            data-icon="fa-brands fa-youtube"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-youtube' ? 'selected' : '' }}>
                                                            YouTube</option>
                                                        <option value="fa-brands fa-github" data-icon="fa-brands fa-github"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-github' ? 'selected' : '' }}>
                                                            GitHub</option>
                                                        <option value="fa-brands fa-tiktok" data-icon="fa-brands fa-tiktok"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-tiktok' ? 'selected' : '' }}>
                                                            TikTok</option>
                                                        <option value="fa-brands fa-discord"
                                                            data-icon="fa-brands fa-discord"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-discord' ? 'selected' : '' }}>
                                                            Discord</option>
                                                        <option value="fa-brands fa-reddit" data-icon="fa-brands fa-reddit"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-reddit' ? 'selected' : '' }}>
                                                            Reddit</option>
                                                        <option value="fa-brands fa-whatsapp"
                                                            data-icon="fa-brands fa-whatsapp"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-whatsapp' ? 'selected' : '' }}>
                                                            WhatsApp</option>
                                                        <option value="fa-brands fa-telegram"
                                                            data-icon="fa-brands fa-telegram"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-telegram' ? 'selected' : '' }}>
                                                            Telegram</option>
                                                        <option value="fa-brands fa-pinterest"
                                                            data-icon="fa-brands fa-pinterest"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-pinterest' ? 'selected' : '' }}>
                                                            Pinterest</option>
                                                        <option value="fa-brands fa-snapchat"
                                                            data-icon="fa-brands fa-snapchat"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-snapchat' ? 'selected' : '' }}>
                                                            Snapchat</option>
                                                        <option value="fa-brands fa-skype" data-icon="fa-brands fa-skype"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-skype' ? 'selected' : '' }}>
                                                            Skype</option>
                                                        <option value="fa-brands fa-twitch" data-icon="fa-brands fa-twitch"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-twitch' ? 'selected' : '' }}>
                                                            Twitch</option>
                                                        <option value="fa-brands fa-dribbble"
                                                            data-icon="fa-brands fa-dribbble"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-dribbble' ? 'selected' : '' }}>
                                                            Dribbble</option>
                                                        <option value="fa-brands fa-behance"
                                                            data-icon="fa-brands fa-behance"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-behance' ? 'selected' : '' }}>
                                                            Behance</option>
                                                        <option value="fa-brands fa-vimeo-v"
                                                            data-icon="fa-brands fa-vimeo-v"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-vimeo-v' ? 'selected' : '' }}>
                                                            Vimeo</option>
                                                        <option value="fa-brands fa-stack-overflow"
                                                            data-icon="fa-brands fa-stack-overflow"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-stack-overflow' ? 'selected' : '' }}>
                                                            Stack Overflow</option>
                                                        <option value="fa-brands fa-medium" data-icon="fa-brands fa-medium"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-medium' ? 'selected' : '' }}>
                                                            Medium</option>
                                                        <option value="fa-brands fa-quora" data-icon="fa-brands fa-quora"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-quora' ? 'selected' : '' }}>
                                                            Quora</option>
                                                        <option value="fa-brands fa-soundcloud"
                                                            data-icon="fa-brands fa-soundcloud"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-soundcloud' ? 'selected' : '' }}>
                                                            SoundCloud</option>
                                                        <option value="fa-brands fa-spotify"
                                                            data-icon="fa-brands fa-spotify"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-spotify' ? 'selected' : '' }}>
                                                            Spotify</option>
                                                        <option value="fa-brands fa-apple" data-icon="fa-brands fa-apple"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-apple' ? 'selected' : '' }}>
                                                            Apple</option>
                                                        <option value="fa-brands fa-google" data-icon="fa-brands fa-google"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-google' ? 'selected' : '' }}>
                                                            Google</option>
                                                        <option value="fa-brands fa-android"
                                                            data-icon="fa-brands fa-android"
                                                            {{ ($social['icon'] ?? '') == 'fa-brands fa-android' ? 'selected' : '' }}>
                                                            Android</option>
                                                        <option value="fa-solid fa-globe" data-icon="fa-solid fa-globe"
                                                            {{ ($social['icon'] ?? '') == 'fa-solid fa-globe' ? 'selected' : '' }}>
                                                            Website</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="rt-input-group">
                                                    <label>Media Link</label>
                                                    <input type="url" name="social_link[]"
                                                        value="{{ $social['link'] ?? '' }}"
                                                        placeholder="https://{{ strtolower($social['name'] ?? '') }}.com/yourprofile">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button"
                                                    class="btn btn-danger remove-social">Remove</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

    <script>
        function formatIcon(option) {
            if (!option.id) return option.text;
            const iconClass = $(option.element).data('icon');
            if (!iconClass) return option.text;
            return $(`<span><i class="${iconClass}"></i> ${option.text}</span>`);
        }

        $(document).ready(function() {
            $('.icon-select').select2({
                templateResult: formatIcon,
                templateSelection: formatIcon,
                width: 'resolve'
            });
        });
    </script>


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
                    <div class="col-sm-3">
                        <div class="rt-input-group">
                            <label>Select Icon</label>
                            <select name="social_icon[]" class="icon-select form-select" style="height: 300px;" required>
                                <option value="">Select Icon</option>
                                <option value="fa-brands fa-facebook-f" data-icon="fa-brands fa-facebook-f">Facebook</option>
                                <option value="fa-brands fa-twitter" data-icon="fa-brands fa-twitter">Twitter</option>
                                <option value="fa-brands fa-instagram" data-icon="fa-brands fa-instagram">Instagram</option>
                                <option value="fa-brands fa-linkedin-in" data-icon="fa-brands fa-linkedin-in">LinkedIn</option>
                                <option value="fa-brands fa-youtube" data-icon="fa-brands fa-youtube">YouTube</option>
                                <option value="fa-brands fa-github" data-icon="fa-brands fa-github">GitHub</option>
                                <option value="fa-brands fa-tiktok" data-icon="fa-brands fa-tiktok">TikTok</option>
                                <option value="fa-brands fa-discord" data-icon="fa-brands fa-discord">Discord</option>
                                <option value="fa-brands fa-reddit" data-icon="fa-brands fa-reddit">Reddit</option>
                                <option value="fa-brands fa-whatsapp" data-icon="fa-brands fa-whatsapp">WhatsApp</option>
                                <option value="fa-brands fa-telegram" data-icon="fa-brands fa-telegram">Telegram</option>
                                <option value="fa-brands fa-pinterest" data-icon="fa-brands fa-pinterest">Pinterest</option>
                                <option value="fa-brands fa-snapchat" data-icon="fa-brands fa-snapchat">Snapchat</option>
                                <option value="fa-brands fa-skype" data-icon="fa-brands fa-skype">Skype</option>
                                <option value="fa-brands fa-twitch" data-icon="fa-brands fa-twitch">Twitch</option>
                                <option value="fa-brands fa-dribbble" data-icon="fa-brands fa-dribbble">Dribbble</option>
                                <option value="fa-brands fa-behance" data-icon="fa-brands fa-behance">Behance</option>
                                <option value="fa-brands fa-vimeo-v" data-icon="fa-brands fa-vimeo-v">Vimeo</option>
                                <option value="fa-brands fa-stack-overflow" data-icon="fa-brands fa-stack-overflow">Stack Overflow</option>
                                <option value="fa-brands fa-medium" data-icon="fa-brands fa-medium">Medium</option>
                                <option value="fa-brands fa-quora" data-icon="fa-brands fa-quora">Quora</option>
                                <option value="fa-brands fa-soundcloud" data-icon="fa-brands fa-soundcloud">SoundCloud</option>
                                <option value="fa-brands fa-spotify" data-icon="fa-brands fa-spotify">Spotify</option>
                                <option value="fa-brands fa-apple" data-icon="fa-brands fa-apple">Apple</option>
                                <option value="fa-brands fa-google" data-icon="fa-brands fa-google">Google</option>
                                <option value="fa-brands fa-android" data-icon="fa-brands fa-android">Android</option>
                                <option value="fa-solid fa-globe" data-icon="fa-solid fa-globe">Website</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
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

                // Initialize Select2 for the newly added .icon-select
                $(row).find('.icon-select').select2({
                    templateResult: formatIcon,
                    templateSelection: formatIcon,
                    width: 'resolve'
                });

            });

            // Remove button functionality
            socialFields.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-social')) {
                    e.target.closest('.social-group').remove();
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#FooterSettings').on('submit', function(event) {
                event.preventDefault();

                var url = "{{ route('Admin.FooterSettings') }}";

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
                        Toastify({
                            text: result.message || "Operation completed.",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            style: {
                                background: result.status_code === 1 ? "green" : (result
                                    .status_code === 0 ? "#c7ac14" : "red"),
                                color: "white",
                            }
                        }).showToast();

                        if (result.status_code === 1) {
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'An error occurred. Please try again.';

                        if (xhr.responseJSON?.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        Toastify({
                            text: errorMessage,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            style: {
                                background: "red",
                                color: "white",
                            }
                        }).showToast();
                    }
                });
            });
        });
    </script>
@endsection
