@extends('admin.adminlayout.main')
@section('title')
    Admin-General Setting
@endsection
@section('page-title')
    Home Page Setting
@endsection

<style>
    .preview-image {
        position: relative;
        margin-bottom: 10px;
    }

    .preview-image img {
        max-height: 80px;
        border-radius: 4px;
    }

    .remove-btn {
        position: absolute;
        top: -10px;
        right: 0px;
        background: red;
        color: white;
        border: none;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        text-align: center;
        line-height: 20px;
        font-size: 14px;
        cursor: pointer;
        z-index: 5;
    }
</style>


@section('main-container')
    <div class="main-content">
        <div class="page-content row">

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Home Section</h4>
                    </div>
                    <form action="javascript:void(0)" method="post" class="row px-3 w-100" id="BannerForm"
                        enctype="multipart/form-data">

                        <div class="card-body">
                            <label for="banner_title" class="form-label">Banner Title</label>
                            {{-- <input type="text" name="banner_title" id="banner_title" class="form-control"> --}}
                            <input type="text" name="banner_title" id="banner_title" class="form-control"
                                value="{{ old('banner_title', $HomeSection->banner_title ?? '') }}">

                            {{-- <label for="banner_desc" class="form-label mt-3"> Desc</label> --}}
                            <label for="banner_filter" class="form-label mt-3">Banner Filter</label>
                            <select name="banner_filter" id="banner_filter" class="form-control mt-1">
                                <option value="">-- Select Filter --</option>
                                <option value="1"
                                    {{ old('banner_filter', $HomeSection->banner_filter ?? '') == '1' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0"
                                    {{ old('banner_filter', $HomeSection->banner_filter ?? '') == '0' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>

                            <label for="banner_desc" class="form-label mt-3">Banner Desc</label>
                            <textarea name="banner_desc" id="banner_desc" cols="30" rows="10" class="form-control">{{ old('banner_desc', $HomeSection->banner_desc ?? '') }}</textarea>

                            <label for="banner_image" class="form-label mt-3">Banner Image</label>
                            @if (!empty($HomeSection->banner_image))
                                <div class="mb-2">
                                    <img src="{{ asset($HomeSection->banner_image) }}" alt="Banner Image" width="100">
                                </div>
                            @endif
                            <input type="file" name="banner_image" id="banner_image" class="form-control">

                            <div class="col-md-12 mt-3 text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">News Section</h4>
                    </div>

                    <form action="javascript:void(0)" method="POST" enctype="multipart/form-data" id="NewsForm"
                        class="row px-3 w-100">
                        @csrf
                        <div class="card-body">
                            {{-- Section Title --}}
                            <label for="news_title" class="form-label">Section Title</label>
                            <input type="text" name="news_title" id="news_title" class="form-control"
                                value="{{ old('news_title', $NewsSection->news_title ?? '') }}">

                            {{-- Section Description --}}
                            <label for="news_message" class="form-label mt-3">Section Message</label>
                            <input type="text" name="news_message" id="news_message" class="form-control mb-4"
                                value="{{ old('news_message', $NewsSection->news_message ?? '') }}">

                            <div id="news-card-container">
                                @php
                                    $cards = $NewsSection->cards ?? [
                                        [
                                            'image' => '',
                                            'date' => '',
                                            'author' => '',
                                            'title' => '',
                                            'link_text' => 'Read More',
                                        ],
                                        [],
                                        [],
                                    ];
                                @endphp

                                @foreach ($cards as $index => $card)
                                    <div class="news-card mb-4 border p-3 position-relative"
                                        data-index="{{ $index }}">
                                        @if ($index > 0)
                                            <button type="button"
                                                class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 remove-card-btn">Remove</button>
                                        @endif
                                        <h5>News Card {{ $index + 1 }}</h5>

                                        @if (!empty($card['image']))
                                            <div class="mb-2">
                                                <img src="{{ asset($card['image']) }}" width="100">
                                            </div>
                                        @endif

                                        <label class="form-label mt-2">Image</label>
                                        <input type="file" name="cards[{{ $index }}][image]"
                                            class="form-control">

                                        <label class="form-label mt-2">Date</label>
                                        <input type="date" name="cards[{{ $index }}][date]" class="form-control"
                                            value="{{ $card['date'] ?? '' }}">

                                        <label class="form-label mt-2">Author</label>
                                        <input type="text" name="cards[{{ $index }}][author]"
                                            class="form-control" value="{{ $card['author'] ?? '' }}">

                                        <label class="form-label mt-2">Title</label>
                                        <input type="text" name="cards[{{ $index }}][title]" class="form-control"
                                            value="{{ $card['title'] ?? '' }}">

                                        <label class="form-label mt-2">Link Text</label>
                                        <input type="text" name="cards[{{ $index }}][link_text]"
                                            class="form-control" value="{{ $card['link_text'] ?? 'Read More' }}">
                                    </div>
                                @endforeach
                            </div>

                            <div class="text-start mt-3">
                                <button type="button" class="btn btn-success" id="add-card-btn">Add New Card</button>
                            </div>

                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary">Save Section</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Work Process Section</h4>
                    </div>

                    <form action="javascript:void(0)" method="POST" enctype="multipart/form-data" id="WorkProcessForm"
                        class="row px-3 w-100">
                        <div class="card-body">
                            {{-- Section Title --}}
                            <label for="section_title" class="form-label">Section Title</label>
                            <input type="text" name="section_title" id="section_title" class="form-control"
                                value="{{ old('section_title', $WorkProcessSectionSettings->work_title ?? '') }}">

                            {{-- Section Message --}}
                            <label for="section_message" class="form-label mt-3">Section Description</label>
                            <input type="text" name="section_message" id="section_message" class="form-control mb-4"
                                value="{{ old('section_message', $WorkProcessSectionSettings->work_message ?? '') }}">

                            <div id="career-card-container">
                                @php
                                    $cards = $WorkProcessSectionSettings->cards ?? [
                                        [
                                            'icon' => '',
                                            'title' => '',
                                            'description' => '',
                                            'button_text' => 'Read More',
                                        ],
                                        [],
                                        [],
                                    ];
                                @endphp

                                @foreach ($cards as $index => $card)
                                    <div class="career-card mb-4 border p-3 position-relative"
                                        data-index="{{ $index }}">
                                        @if ($index > 2)
                                            <button type="button"
                                                class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 remove-card-btn">Remove</button>
                                        @endif

                                        <h5>Step {{ $index + 1 }}</h5>

                                        {{-- Icon (Image or SVG Upload) --}}
                                        <label class="form-label mt-2">Icon</label>
                                        @if (!empty($card['icon']))
                                            <div class="mb-2">
                                                <img src="{{ asset($card['icon']) }}" width="60">
                                            </div>
                                        @endif
                                        <input type="file" name="cards[{{ $index }}][icon]"
                                            class="form-control">

                                        {{-- Title --}}
                                        <label class="form-label mt-2">Title</label>
                                        <input type="text" name="cards[{{ $index }}][title]"
                                            class="form-control" value="{{ $card['title'] ?? '' }}">

                                        {{-- Description --}}
                                        <label class="form-label mt-2">Description</label>
                                        <textarea name="cards[{{ $index }}][description]" class="form-control">{{ $card['description'] ?? '' }}</textarea>

                                        {{-- Button Text --}}
                                        <label class="form-label mt-2">Button Text</label>
                                        <input type="text" name="cards[{{ $index }}][button_text]"
                                            class="form-control" value="{{ $card['button_text'] ?? 'Read More' }}">
                                    </div>
                                @endforeach
                            </div>

                            <div class="text-start mt-3">
                                <button type="button" class="btn btn-success" id="add-career-card-btn">Add New
                                    Step</button>
                            </div>

                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary">Save Section</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Brand Section</h4>
                    </div>

                    <form action="javasript:void(0)" method="POST" enctype="multipart/form-data" id="BrandForm"
                        class="row px-3 w-100">
                        @csrf
                        <div class="card-body">
                            {{-- Section Title --}}
                            <div class="mb-3">
                                <label for="section_title" class="form-label">Section Title</label>
                                <input type="text" name="section_title" id="section_title" class="form-control"
                                    value="{{ old('section_title', $BrandSectionSetting->title ?? '') }}">
                            </div>

                            {{-- Logos Upload --}}
                            <div class="mb-3">
                                <label for="logos" class="form-label">Upload Logos</label>
                                <input type="file" name="logos[]" multiple class="form-control" id="logosInput">
                                <small class="text-muted">You can select multiple logos</small>

                                @if (!empty($BrandSectionSetting->logos) && is_array($BrandSectionSetting->logos))
                                    <div class="row mt-3" id="existingLogos">
                                        @foreach ($BrandSectionSetting->logos as $index => $logo)
                                            <div class="col-3 preview-image position-relative"
                                                data-logo="{{ $logo }}">
                                                <button type="button" class="remove-btn"
                                                    data-logo="{{ $logo }}">&times;</button>
                                                <img src="{{ asset($logo) }}" class="img-fluid" alt="Logo">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>



                            {{-- Preview Area --}}
                            <div class="row" id="previewContainer"></div>

                            <button type="submit" class="btn btn-primary mt-3">Save</button>
                        </div>
                    </form>

                    <script>
                        document.getElementById('logosInput').addEventListener('change', function(event) {
                            const previewContainer = document.getElementById('previewContainer');
                            previewContainer.innerHTML = '';

                            Array.from(event.target.files).forEach((file, index) => {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const wrapper = document.createElement('div');
                                    wrapper.classList.add('col-md-2', 'preview-image');

                                    wrapper.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" class="img-fluid">
                    <button type="button" class="remove-btn" onclick="removeImage(${index})">&times;</button>
                `;

                                    previewContainer.appendChild(wrapper);
                                };
                                reader.readAsDataURL(file);
                            });

                            // Store files for removal
                            window.selectedFiles = event.target.files;
                        });

                        function removeImage(index) {
                            const dt = new DataTransfer();
                            const input = document.getElementById('logosInput');

                            const files = Array.from(window.selectedFiles);
                            files.splice(index, 1);

                            files.forEach(file => dt.items.add(file));
                            input.files = dt.files;

                            // Re-trigger change to re-render previews
                            const event = new Event('change');
                            input.dispatchEvent(event);
                        }
                    </script>


                </div>

            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">What We are Section</h4>
                    </div>

                    <form action="javascript:void(0)" method="POST" enctype="multipart/form-data" id="WorkProcessForm"
                        class="row px-3 w-100">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control"
                                    placeholder="Why We Are Most Popular">
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="4"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Point 1</label>
                                <input type="text" name="point1" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Point 2</label>
                                <input type="text" name="point2" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Point 3</label>
                                <input type="text" name="point3" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Point 4</label>
                                <input type="text" name="point4" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Button Text</label>
                                <input type="text" name="button_text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Button Link</label>
                                <input type="text" name="button_link" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" name="is_hidden" class="form-check-input" id="toggleHidden">
                                <label class="form-check-label" for="toggleHidden">Hide This Section</label>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">Update Section</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>


        </div>

    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- For Submit Home Section --}}
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

    {{-- For Add New Card in News Section --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let cardIndex = {{ count($cards) }};
            const container = document.getElementById('news-card-container');
            const addCardBtn = document.getElementById('add-card-btn');

            function createCard(index) {
                const card = document.createElement('div');
                card.classList.add('news-card', 'mb-4', 'border', 'p-3', 'position-relative');
                card.setAttribute('data-index', index);
                card.innerHTML = `
                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 remove-card-btn">Remove</button>
                <h5>News Card ${index + 1}</h5>

                <label class="form-label mt-2">Image</label>
                <input type="file" name="cards[${index}][image]" class="form-control">

                <label class="form-label mt-2">Date</label>
                <input type="date" name="cards[${index}][date]" class="form-control">

                <label class="form-label mt-2">Author</label>
                <input type="text" name="cards[${index}][author]" class="form-control">

                <label class="form-label mt-2">Title</label>
                <input type="text" name="cards[${index}][title]" class="form-control">

                <label class="form-label mt-2">Link Text</label>
                <input type="text" name="cards[${index}][link_text]" class="form-control" value="Read More">
            `;
                return card;
            }

            addCardBtn.addEventListener('click', function() {
                const newCard = createCard(cardIndex);
                container.appendChild(newCard);
                cardIndex++;
            });

            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-card-btn')) {
                    e.target.closest('.news-card').remove();
                }
            });
        });
    </script>

    {{-- For Submit News Section --}}
    <script>
        $(document).ready(function() {
            $('#NewsForm').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                var url = "{{ route('Admin.SubmitNewsSection') }}";
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

    {{-- For Add New Card in Work Process Section --}}
    <script>
        let cardIndex = {{ count($cards) }};
        document.getElementById('add-career-card-btn').addEventListener('click', function() {

            const container = document.getElementById('career-card-container');
            const newCard = document.createElement('div');
            newCard.classList.add('career-card', 'mb-4', 'border', 'p-3', 'position-relative');
            newCard.setAttribute('data-index', cardIndex);
            newCard.innerHTML = `
            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 remove-card-btn">Remove</button>
            <h5>Step ${cardIndex + 1}</h5>
            <label class="form-label mt-2">Icon</label>
            <input type="file" name="cards[${cardIndex}][icon]" class="form-control">

            <label class="form-label mt-2">Title</label>
            <input type="text" name="cards[${cardIndex}][title]" class="form-control">

            <label class="form-label mt-2">Description</label>
            <textarea name="cards[${cardIndex}][description]" class="form-control"></textarea>

            <label class="form-label mt-2">Button Text</label>
            <input type="text" name="cards[${cardIndex}][button_text]" class="form-control" value="Read More">
        `;
            container.appendChild(newCard);
            cardIndex++;
        });

        // Remove card
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-card-btn')) {
                e.target.closest('.career-card').remove();
                cardIndex--;
            }
        });
    </script>

    {{-- For Submit Work Process Section --}}
    <script>
        $(document).ready(function() {
            $('#WorkProcessForm').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                var url = "{{ route('Admin.SubmitWorkProcessSection') }}";
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


    {{-- For Submit Brand Section --}}
    <script>
        $(document).ready(function() {
            $('#BrandForm').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                var url = "{{ route('Admin.SubmitBrandSection') }}";
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

    {{-- For Delete Brand Logo --}}
    <script>
        $(document).on('click', '.remove-btn', function() {
            const logoPath = $(this).data('logo');
            const $imageContainer = $(this).closest('.preview-image');

            if (confirm("Are you sure you want to delete this logo?")) {
                $.ajax({
                    url: "{{ route('Admin.DeleteBrandLogo') }}",
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    data: {
                        logo: logoPath
                    },
                    success: function(response) {
                        if (response.status_code === 1) {
                            Toastify({
                                text: response.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "#28a745"
                                },
                            }).showToast();
                            $imageContainer.remove();
                        } else {
                            Toastify({
                                text: response.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "#c7ac14"
                                },
                            }).showToast();
                        }
                    },
                    error: function() {
                        Toastify({
                            text: "An error occurred while deleting.",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            style: {
                                background: "#dc3545"
                            },
                        }).showToast();
                    }
                });
            }
        });
    </script>
@endsection
