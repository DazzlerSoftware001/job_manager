@extends('User.UserDashLayout.main')
@section('title')
    Resume
@endsection
@section('main-container')

<style>
    .add-skill-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
        animation: fadeIn 0.3s ease-in-out;
    }

    .skill-input {
        padding: 10px 15px;
        border: 2px solid #4f46e5;
        border-radius: 8px;
        font-size: 14px;
        outline: none;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(79, 70, 229, 0.1);
    }

    .skill-input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
    }

    .add-skill-btn {
        padding: 10px 20px;
        background: linear-gradient(135deg, #4f46e5, #6366f1);
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .add-skill-btn:hover {
        background: linear-gradient(135deg, #4338ca, #4f46e5);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
</style>

    <div class="my__profile__tab radius-16 bg-white">
        {{-- <nav>
            <div class="nav nav-tabs">
                <a class="nav-link active" href="#info">CV File</a>
                <a class="nav-link " href="#social">Education</a>
                <a class="nav-link" href="#address">Skills & Experience</a>
                <a class="nav-link" href="#address">Portfolio </a>
                <a class="nav-link" href="#address">Award</a>
            </div>
        </nav> 
        <div class="my__details" id="info">
            <div class="info__top align-items-start">

               <div class="select__image">
                    <label for="file" class="file-upload__label__two">
                        <span>
                            <i class="fa-light fa-file-arrow-up"></i>
                            <b><u>Click To Upload</u></b> Or Drag and Drop
                            <br>
                            Meximum File Size 10 Mb
                        </span>
                    </label>
                    <input type="file" class="file-upload__input__two" id="file" required>
                </div>


                <div class="cv__included d-flex gap-30">
                    <div class="single__item">
                        <div class="d-flex justify-content-between">
                            <span>Resume</span>
                            <span><i class="fa-regular fa-xmark"></i></span>
                        </div>
                        <div class="file__type font-20 mt-2 fw-semibold">
                            PDF
                        </div>
                    </div>
                    <div class="single__item">
                        <div class="d-flex justify-content-between">
                            <span>Cover Letter</span>
                            <span><i class="fa-regular fa-xmark"></i></span>
                        </div>
                        <div class="file__type font-20 mt-2 fw-semibold">
                            PDF
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <form action="javascript:void(0)" method="POST" id="uploadResume" enctype="multipart/form-data">
            <div class="row">

                <div class="col-md-6 mb-3">
                    <label for="resume" class="form-label">Resume<span class="text-danger">*</span></label>
                    <input type="file" class="form-control" id="resume" name="resume" required accept=".pdf">
                    <small class="text-danger">Only PDF will be accepted</small>
                </div>

                <div class="col-md-1 " style="margin-top: 36px;">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>

                <div class="col-12 col-sm-8 col-md-6 col-lg-4 mt-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            @if (!empty($resumeName) && !empty($resumePath))
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="me-4">
                                        <h6 class="mb-0">
                                            <i class="bi bi-file-earmark-pdf-fill text-danger me-1"></i>
                                            <strong>{{ $resumeName }}</strong>
                                        </h6>
                                    </div>
                                    <div class="">
                                        <a href="{{ $resumePath }}" target="_blank"
                                            class="btn btn-outline-primary btn-sm">
                                            View
                                        </a>
                                    </div>
                                </div>
                            @else
                                <p class="text-muted mb-0">No resume uploaded yet.</p>
                            @endif
                        </div>
                    </div>
                </div>

        </form>

                <form id="uploadCoverLetter">
                    <div class="mb-3">
                        <label for="cover_letter" class="form-label">Cover Letter</label>
                        <textarea class="form-control" id="cover_letter" name="cover_letter" rows="5"
                            placeholder="Write your cover letter here...">{{$candidate->cover_letter}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Upload Cover Letter</button>
                </form>
            </div>
    </div>

    <!-- education -->
    <h6 class="fw-medium mt-30 mb-20">Skill & Experience</h6>
    <div class="my__education radius-16 p-30 bg-white" id="education-1">
        <div class="my__skillset">
            <ul class="skill__tags">
                <li><span class="skill__item">HTML</span> <span><i class="fa-regular fa-xmark"></i></span></li>
        
                <!-- Add Skill Input and Button (Initially Hidden) -->
                <li class="add-skill-wrapper" style="display: none;">
                    <input type="text" name="skill[]" placeholder="Enter skill" class="skill-input" multiple>
                    <button class="add-skill-btn">Add Skill</button>
                </li>
                
        
                <!-- Plus Icon -->
                <li>
                    <span class="skill__item__add toggle-add-skill">
                        <i class="fa-regular fa-plus"></i>
                    </span>
                </li>
            </ul>
        </div>
        
        <div class="accordion" id="rts-accordion-2">
            <div class="accordion-item">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c1"
                    aria-expanded="false" aria-controls="c1">
                    Software Engineer
                </button>
                <div id="c1" class="accordion-collapse collapse" data-bs-parent="#rts-accordion-2">
                    <div class="accordion-body p-0 mt-3 mb-20">
                        <div class="info__field">
                            <div class="row row-cols-sm-2 row-cols-1">
                                <div class="rt-input-group">
                                    <label for="title-4">Title</label>
                                    <input type="text" id="title-4" placeholder="Software Engineer" required>
                                </div>
                                <div class="rt-input-group">
                                    <label for="cm-4">Company</label>
                                    <input type="text" id="cm-4" placeholder="Reactheme" required>
                                </div>
                            </div>
                            <div class="row row-cols-sm-2 row-cols-1">
                                <div class="rt-input-group">
                                    <label for="de-4">end date</label>
                                    <input type="text" id="de-4" placeholder="DD/ MM/ YY" required>
                                </div>
                                <div class="rt-input-group">
                                    <label for="sd-4">Start Date</label>
                                    <input type="text" id="sd-4" placeholder="DD/MM/YY" required>
                                </div>
                            </div>
                            <div class="rt-input-group">
                                <label for="desc-4">Description</label>
                                <textarea name="desc" id="desc-4" cols="30" rows="5" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-30">
                            <a href="#" class="added__social__link">Remove EXperience</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c2"
                    aria-expanded="false" aria-controls="c2">
                    Django Developer
                </button>
                <div id="c2" class="accordion-collapse collapse" data-bs-parent="#rts-accordion-2">
                    <div class="accordion-body p-0 mt-3 mb-20">
                        <div class="info__field">
                            <div class="row row-cols-sm-2 row-cols-1">
                                <div class="rt-input-group">
                                    <label for="title-5">Title</label>
                                    <input type="text" id="title-5" placeholder="Software Engineer" required>
                                </div>
                                <div class="rt-input-group">
                                    <label for="cm-5">Company</label>
                                    <input type="text" id="cm-5" placeholder="Reactheme" required>
                                </div>
                            </div>
                            <div class="row row-cols-sm-2 row-cols-1">
                                <div class="rt-input-group">
                                    <label for="de-5">end date</label>
                                    <input type="text" id="de-5" placeholder="DD/ MM/ YY" required>
                                </div>
                                <div class="rt-input-group">
                                    <label for="sd-5">Start Date</label>
                                    <input type="text" id="sd-5" placeholder="DD/MM/YY" required>
                                </div>
                            </div>
                            <div class="rt-input-group">
                                <label for="desc-5">Description</label>
                                <textarea name="desc" id="desc-5" cols="30" rows="5" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-30">
                            <a href="#" class="added__social__link">Remove EXperience</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c3"
                    aria-expanded="false" aria-controls="collapseThree">
                    Wordpress Developer
                </button>
                <div id="c3" class="accordion-collapse collapse" data-bs-parent="#rts-accordion-2">
                    <div class="accordion-body p-0 mt-3 mb-20">
                        <div class="info__field">
                            <div class="row row-cols-sm-2 row-cols-1">
                                <div class="rt-input-group">
                                    <label for="title-6">Title</label>
                                    <input type="text" id="title-6" placeholder="Software Engineer" required>
                                </div>
                                <div class="rt-input-group">
                                    <label for="cm-6">Company</label>
                                    <input type="text" id="cm-6" placeholder="Reactheme" required>
                                </div>
                            </div>
                            <div class="row row-cols-sm-2 row-cols-1">
                                <div class="rt-input-group">
                                    <label for="de-6">end date</label>
                                    <input type="text" id="de-6" placeholder="DD/ MM/ YY" required>
                                </div>
                                <div class="rt-input-group">
                                    <label for="sd-6">Start Date</label>
                                    <input type="text" id="sd-6" placeholder="DD/MM/YY" required>
                                </div>
                            </div>
                            <div class="rt-input-group">
                                <label for="desc-6">Description</label>
                                <textarea name="desc" id="desc-6" cols="30" rows="5" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-30">
                            <a href="#" class="added__social__link">Remove EXperience</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <a href="#" class="added__social__link">Add Skill</a>
            </div>
        </div>
    </div>
    <!-- education end -->
@endsection
@section('script')

    {{-- For Upload Resume --}}
    <script type="text/javascript">
        $('#uploadResume').on('submit', function(e) {
            e.preventDefault(); // prevent form from reloading

            var url = "{{ route('User.UploadResume') }}";

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
                    if (result.status_code == 1) {
                        Toastify({
                            text: result.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            className: "bg-success"
                        }).showToast();

                        setTimeout(function() {
                            if (result.redirect_url) {
                                window.location.href = result.redirect_url;
                            } else {
                                location.reload();
                            }
                        }, 750);

                    } else if (result.status_code == 2) {
                        Toastify({
                            text: result.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            className: "bg-warning"
                        }).showToast();
                    } else {
                        Toastify({
                            text: result.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            className: "bg-danger"
                        }).showToast();
                    }
                },
                error: function(xhr) {
                    Toastify({
                        text: "Something went wrong!",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        className: "bg-danger"
                    }).showToast();
                }
            });
        });
    </script>

    {{-- For Upload Cover Letter --}}
    <script type="text/javascript">
        $('#uploadCoverLetter').on('submit', function(e) {
            e.preventDefault(); // prevent form from reloading

            var url = "{{ route('User.UploadCoverLetter') }}";

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
                    if (result.status_code == 1) {
                        Toastify({
                            text: result.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            className: "bg-success"
                        }).showToast();

                        setTimeout(function() {
                            if (result.redirect_url) {
                                window.location.href = result.redirect_url;
                            } else {
                                location.reload();
                            }
                        }, 750);

                    } else if (result.status_code == 2) {
                        Toastify({
                            text: result.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            className: "bg-warning"
                        }).showToast();
                    } else {
                        Toastify({
                            text: result.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            className: "bg-danger"
                        }).showToast();
                    }
                },
                error: function(xhr) {
                    Toastify({
                        text: "Something went wrong!",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        className: "bg-danger"
                    }).showToast();
                }
            });
        });
    </script>
    <script>
        document.querySelector('.toggle-add-skill').addEventListener('click', function () {
            const inputWrapper = document.querySelector('.add-skill-wrapper');
            inputWrapper.style.display = inputWrapper.style.display === 'none' ? 'flex' : 'none';
        });
    </script>
    
@endsection
