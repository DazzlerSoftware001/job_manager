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
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .skill__item {
            background-color: #e0e0e0;
            padding: 4px 8px;
            border-radius: 6px;
            margin-right: 8px;
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

                @if ($candidate && $candidate->cover_letter)
                    <textarea class="form-control" id="cover_letter" name="cover_letter" rows="5"
                        placeholder="Write your cover letter here...">{{ $candidate->cover_letter }}</textarea>
                @else
                    <textarea class="form-control" id="cover_letter" name="cover_letter" rows="5"
                        placeholder="Write your cover letter here..."></textarea>
                @endif
            </div>
            <button type="submit" class="btn btn-success">Upload Cover Letter</button>
        </form>
    </div>
    </div>

    <h6 class="fw-medium mt-30 mb-20">Current Job Type</h6>
    <div class="bg-white mt-3 p-3 rounded shadow-sm">
        <form action="javasript:void(0)" class="row" id="UploadDesignation">
            <div class="col-6 col-sm-4">
                @if ($candidate && $candidate->position)
                    <input type="text" name="designation" class="form-control" value="{{ $candidate->position }}"
                        placeholder="Type your Designation">
                @else
                    <input type="text" name="designation" class="form-control" placeholder="Type your Designation">
                @endif
            </div>
            <div class="col-2 col-sm-1">
                <button type="submit" class="btn btn-primary w-100">
                    Submit
                </button>
            </div>
        </form>
    </div>


    <!-- Skill & Experience -->
    <h6 class="fw-medium mt-30 mb-20">Skill & Experience</h6>
    <div class="my__education radius-16 p-30 bg-white" id="education-1">
        <div class="my__skillset">
            <ul class="skill__tags" id="skillList">
                @php
                    $skills =
                        $candidate && is_string($candidate->skill)
                            ? json_decode($candidate->skill, true)
                            : $candidate->skill ?? [];
                @endphp

                @if (!empty($skills) && is_array($skills))
                    @foreach ($skills as $skill)
                        <li>
                            <span class="skill__item">{{ $skill }}</span>
                            <span class="remove-skill cursor-pointer text-red-500" data-skill="{{ $skill }}">
                                <i class="fa-regular fa-xmark"></i>
                            </span>
                        </li>
                    @endforeach
                @else
                    <li>No skills added yet.</li>
                @endif

                <!-- Add Skill Input and Button (Initially Hidden) -->
                <form action="javascript:void(0)" method="POST" id="uploadSkill">
                    <li class="add-skill-wrapper" style="display: none;">
                        <input type="text" name="skills[]" placeholder="Enter skill" class="skill-input" multiple>
                        <button class="add-skill-btn">Add Skill</button>
                    </li>
                </form>

                <!-- Plus Icon -->
                <li>
                    <span class="skill__item__add toggle-add-skill">
                        <i class="fa-regular fa-plus"></i>
                    </span>
                </li>
            </ul>
        </div>

        <div class="accordion" id="rts-accordion-2">
            @if ($can_exp)
                @foreach ($can_exp as $exp)
                    @php
                        $years = '0';
                        $months = '0';

                        if (!empty($exp->experience)) {
                            if (preg_match('/(\d+)\s*years?\s*(\d*)\s*months?/', $exp->experience, $match)) {
                                $years = $match[1] ?? '0';
                                $months = $match[2] ?? '0';
                            } elseif (preg_match('/(\d+)\s*years?/', $exp->experience, $match)) {
                                $years = $match[1];
                            } elseif (preg_match('/(\d+)\s*months?/', $exp->experience, $match)) {
                                $months = $match[1];
                            }
                        }
                    @endphp

                   

                    <div class="submitted-education-info mb-3">
                        {{-- <h5>Submitted Education Information</h5> --}}
                        <p><strong>Company:</strong> {{ $exp->company_name }}</p>
                        <p><strong>Position:</strong> {{ $exp->position }}</p>
                        <p><strong>Experience (Years):</strong> {{ $years }}</p>
                        <p><strong>Experience (Months):</strong> {{ $months }}</p>
                        <p><strong>Description</strong> {{ $exp->description }}</p>
                    </div>
                @endforeach
            @else
                <p>No experience found.</p>
            @endif

            <div class="accordion-item">
                <div id="c1" class="accordion-collapse collapse" data-bs-parent="#rts-accordion-2">
                    <form action="javascript:void(0)" id="CandidateExp">
                        <div class="accordion-body p-0 mt-3 mb-20">
                            <div class="info__field">
                                <div class="row row-cols-sm-2 row-cols-1">
                                    <div class="rt-input-group">
                                        <label for="cm-4">Company</label>
                                        <input type="text" id="cm-4" name="company" placeholder="Company Name"
                                            required>
                                    </div>
                                    <div class="rt-input-group">
                                        <label for="title-4">Position</label>
                                        <input type="text" id="title-4" name="position"
                                            placeholder="Software Engineer" required>
                                    </div>
                                </div>

                                <div class="row row-cols-sm-2 row-cols-1">
                                    <div class="rt-input-group">
                                        <label for="de-4">Experience</label>
                                        <input type="number" class="no-spinner" name="exp_years" id="de-4"
                                            placeholder="Experience in years" required>
                                    </div>
                                    <div class="rt-input-group">
                                        <label for="sd-4">Month</label>
                                        <select name="exp_months" id="experience_months" class="form-select">
                                            <option value="">Select Months</option>
                                            <!-- Loop to generate months -->
                                            <script>
                                                for (let i = 1; i <= 12; i++) {
                                                    document.write(`<option value="${i}">${i} Month${i > 1 ? 's' : ''}</option>`);
                                                }
                                            </script>
                                        </select>
                                    </div>
                                </div>

                                <div class="rt-input-group">
                                    <label for="desc-4">Description</label>
                                    <textarea name="desc" id="desc-4" cols="30" rows="5" placeholder="Description"></textarea>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-30">
                                <button type="submit" class="btn">Add Experience</button>
                                <a href="#" class="removeExperience added__social__link ms-3">Remove Experience</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-start" id="addExperienceContainer">
                <a href="#" id="addExperienceBtn" class="added__social__link">Add Experience</a>
            </div>
        </div>
    </div>
    <!-- Skill & Experience end -->


    <!-- education -->
    <h6 class="fw-medium mt-30 mb-20">Education</h6>
    <div class="my_education bg-white radius-16 p-30">

        @if ($educations)
            @foreach ($educations as $education)
                <div class="submitted-education-info mb-3">
                    {{-- <h5>Submitted Education Information</h5> --}}
                    <p><strong>Education Level:</strong> {{ $education->level }}</p>
                    <p><strong>Board Type:</strong> {{ $education->board_university }}</p>
                    <p><strong>Institute Name:</strong> {{ $education->school_college }}</p>
                    <p><strong>Stream:</strong> {{ $education->stream }}</p>
                    <p><strong>Passing Year:</strong> {{ $education->passing_year }}</p>
                    <p><strong>Percentage:</strong> {{ $education->percentage }}</p>
                </div>
            @endforeach
        @else
            <p>No education information available.</p>
        @endif

        <!-- Education Form -->
        <div class="accordion-item">
            <div id="c3" class="accordion-collapse collapse">
                <div class="accordion-body p-0 mt-3 mb-20">
                    <form action="javascript:void(0)" id="AddEducation">
                        <div class="info__field">
                            <div class="row row-cols-sm-2 row-cols-1">
                                <div class="rt-input-group">
                                    <label for="level">Education Level<span
                                            class="text-danger d-inline">*</span></label>
                                    <select name="level" id="level" required
                                        style="width: 100%; padding: 0.625rem 1rem; border: 1px solid #ddd; border-radius: 8px; height: 50px; background-color: white;">
                                        <option value="">Select Level</option>
                                        <option value="10th">10th</option>
                                        <option value="12th">12th</option>
                                        <option value="UG">Graduation/Diploma</option>
                                        <option value="PG">Post Graduation</option>
                                        <option value="PhD">PhD</option>
                                    </select>
                                </div>

                                <div class="rt-input-group">
                                    <label for="board_university">Board/University<span
                                            class="text-danger d-inline">*</span></label>
                                    <input type="text" id="board_university" name="board_university"
                                        placeholder="Enter Board/University" required>
                                </div>
                            </div>

                            <div class="row row-cols-sm-2 row-cols-1 mt-3">
                                <div class="rt-input-group">
                                    <label for="school_college">School/College Name<span
                                            class="text-danger d-inline">*</span></label>
                                    <input type="text" id="school_college" name="school_college"
                                        placeholder="Enter Institute Name" required>
                                </div>
                                <div class="rt-input-group">
                                    <label for="stream">Stream</label>
                                    <input type="text" id="stream" name="stream" placeholder="Enter Your Stream">
                                </div>
                            </div>

                            <div class="row row-cols-sm-2 row-cols-1 mt-3">
                                <div class="rt-input-group">
                                    <label for="passing_year">Passing Year<span
                                            class="text-danger d-inline">*</span></label>
                                    <input type="number" class="no-snipper" id="passing_year" name="passing_year"
                                        placeholder="YYYY" required max="{{ date('Y') }}">
                                </div>
                                <div class="rt-input-group">
                                    <label for="percentage">Percentage<span class="text-danger d-inline">*</span></label>
                                    <input type="text" id="percentage" name="percentage" placeholder="e.g. 85%"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-30">
                            <button type="submit" class="btn me-3 added__social__link">Add Education</button>
                            <a href="javascript:void(0)" id="removeEducationBtn" class="added__social__link">Remove
                                Education</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Add Education Button -->
        <div class="d-flex justify-content-start" id="addEducationContainer">
            <a href="javascript:void(0)" id="addEducationBtn" class="added__social__link">Add Educational Information</a>
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

    {{-- For Upload Designation --}}
    <script type="text/javascript">
        $('#UploadDesignation').on('submit', function(e) {
            e.preventDefault(); // prevent form from reloading

            var url = "{{ route('User.UploadDesignation') }}";

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

    {{-- For Add Skill --}}
    <script>
        document.querySelector('.toggle-add-skill').addEventListener('click', function() {
            const inputWrapper = document.querySelector('.add-skill-wrapper');
            inputWrapper.style.display = inputWrapper.style.display === 'none' ? 'flex' : 'none';
        });

        $('#uploadSkill').on('submit', function(e) {
            e.preventDefault(); // prevent form from reloading

            var url = "{{ route('User.AddSkill') }}";

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

    {{-- For Remove Skill --}}
    <script>
        $('#skillList').on('click', '.remove-skill', function() {
            let skill = $(this).data('skill');
            let listItem = $(this).closest('li');

            $.ajax({
                url: "{{ route('User.RemoveSkill') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    skill: skill
                },
                success: function(response) {
                    if (response.status_code == 1) {
                        listItem.remove(); // instantly remove from UI
                    } else {
                        alert(response.message);
                    }
                }
            });
        });
    </script>

    {{-- For Showing the Experince Column --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addExpBtn = document.getElementById("addExperienceBtn");
            const addExpCon = document.getElementById("addExperienceContainer");
            const expDiv = document.getElementById("c1");

            // Note: This element exists after clicking "Add", so we attach the listener dynamically
            function attachRemoveListener() {
                const removeExpBtn = document.querySelector(".removeExperience");
                if (removeExpBtn) {
                    removeExpBtn.addEventListener("click", function(e) {
                        e.preventDefault();
                        expDiv.classList.remove("show");
                        if (addExpCon) {
                            addExpCon.classList.remove("d-none"); // Show again
                            addExpCon.classList.add("d-flex"); // Show again
                        }
                    });
                }
            }

            addExpBtn.addEventListener("click", function(e) {
                e.preventDefault();

                // Show experience form
                expDiv.classList.add("show");

                // Hide "Add Experience" button
                if (addExpCon) {
                    addExpCon.classList.remove("d-flex");
                    addExpCon.classList.add("d-none");
                }

                // Attach remove handler
                attachRemoveListener();
            });
        });
    </script>

    {{-- For Submit Candidate Experience --}}
    <script type="text/javascript">
        $('#CandidateExp').on('submit', function(e) {
            e.preventDefault();

            let form = this;
            let url = "{{ route('User.CandidateExp') }}";

            // Create FormData object
            let formData = new FormData(form);

            // Combine exp_years and exp_months into one string like "2 years 5 months"
            let years = formData.get('exp_years') || 0;
            let months = formData.get('exp_months') || 0;
            let experience = `${years} years ${months} months`;

            // Append combined field and remove individual ones
            formData.delete('exp_years');
            formData.delete('exp_months');
            formData.append('experience', experience);

            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
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

    {{-- For Showing the Education Column --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addBtn = document.getElementById("addEducationBtn");
            const removeBtn = document.getElementById("removeEducationBtn");
            const formSection = document.getElementById("c3");
            const addContainer = document.getElementById("addEducationContainer");

            addBtn.addEventListener("click", function(e) {
                e.preventDefault();
                formSection.classList.add("show"); // Show the form
                addContainer.style.display = "none"; // Hide the button
            });

            removeBtn.addEventListener("click", function(e) {
                e.preventDefault();
                formSection.classList.remove("show"); // Hide the form
                addContainer.style.display = "flex"; // Show the button again
            });
        });
    </script>

    {{-- For Submit Candidate Qualification --}}
    <script type="text/javascript">
        $('#AddEducation').on('submit', function(e) {
            e.preventDefault();

            let form = this;
            let url = "{{ route('User.CandidateEducation') }}"; // change to your route name

            let formData = new FormData(form);

            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
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
@endsection
