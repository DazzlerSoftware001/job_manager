@extends('admin.adminlayout.main')
@section('title')
    Admin-General Setting
@endsection
@section('page-title')
    Home Page Setting
@endsection

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
                                        @if ($index > 3)
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

    {{-- For Add New Card in Nws Section --}}
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

    {{-- For Submit Home Section --}}
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
@endsection
