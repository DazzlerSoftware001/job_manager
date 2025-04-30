@extends('User.UserDashLayout.main')
@section('title')
    Resume
@endsection
@section('main-container')
    {{-- <style>
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
    </style> --}}

    <style>
        #skillInputsWrapper input {
            border-radius: 20px;
            padding: 0.4rem 1rem;
            border: 1px solid #6c757d;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
            font-size: 14px;
        }

        .form-skill-actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            margin-top: 0.8rem;
        }

        #SubmitSkillInput,
        #addSkillInput {
            border-radius: 20px;
            padding: 0.4rem 1rem;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        #SubmitSkillInput:hover,
        #addSkillInput:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.2);
        }

        @media (max-width: 768px) {
            .form-skill-actions {
                flex-direction: column;
                align-items: stretch;
            }
        }

        .skill-input-group input {
            border-radius: 20px;
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
                <label for="resume" class="form-label">Position<span class="text-danger">*</span></label>
                @if ($candidate && $candidate->position)
                    <input type="text" name="designation" class="form-control" value="{{ $candidate->position }}"
                        placeholder="Type your Designation">
                @else
                    <input type="text" name="designation" class="form-control" placeholder="Type your Designation">
                @endif
                <label for="resume" class="form-label mt-3">Expect Salary<span class="text-danger">*</span></label>
                @if ($candidate && $candidate->expect_sal)
                    <input type="number" name="expected" class="form-control"
                        value="{{ old('expected', $candidate->expect_sal) }}">
                    <span class="fs-6 text-danger">Enter monthly Expected Salary</span>
                @else
                    <input type="number" name="expected" class="form-control no-spinner" placeholder="Expected Salary">
                    <span class="fs-6 text-danger">Enter monthly Expected Salary</span>
                @endif

                <button type="submit" class="btn btn-primary w-10 d-block mt-3">
                    Submit
                </button>
            </div>
        </form>
    </div>


    <!-- Skill & Experience -->
    <h6 class="fw-medium mt-30 mb-20">Skill & Experience</h6>
    <div class="my__education radius-16 p-30 bg-white" id="education-1">
        {{-- <div class="my__skillset">
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
        </div> --}}
        <div class="my__skillset">
            <ul class="list-unstyled" id="skillList">
                @php
                    $skills =
                        $candidate && is_string($candidate->skill)
                            ? json_decode($candidate->skill, true)
                            : $candidate->skill ?? [];
                @endphp

                @if (!empty($skills) && is_array($skills))
                    @foreach ($skills as $skill)
                        <li class="d-inline-block mb-2 me-2">
                            <span class="badge bg-primary p-2">
                                {{ $skill }}
                                <span class="ms-2 text-white remove-skill" style="cursor:pointer;"
                                    data-skill="{{ $skill }}">
                                    <i class="fa-solid fa-xmark"></i>
                                </span>
                            </span>
                        </li>
                    @endforeach
                @else
                    <li>No skills added yet.</li>
                @endif


                <!-- Skill Input Form -->
                <form action="javascript:void(0)" method="POST" id="uploadSkill" class="mt-3">
                    <div id="skillInputsWrapper" class="d-flex flex-column gap-2">
                        <!-- Input field gets added here -->
                    </div>

                    <div class="form-skill-actions">
                        <button type="submit"
                            class="btn btn-outline-success btn-sm d-flex align-items-center gap-1 d-none"
                            id="SubmitSkillInput">
                            <i class="fa-solid fa-paper-plane"></i> Submit
                        </button>

                        <button type="button" class="btn btn-outline-primary btn-sm d-flex align-items-center"
                            id="addSkillInput">
                            <i class="fa-solid fa-plus"></i> Add Skill
                        </button>
                    </div>
                </form>






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
                        <p><strong class="text-dark">Company:</strong> {{ $exp->company_name }}</p>
                        <p><strong class="text-dark">Position:</strong> {{ $exp->position }}</p>
                        <p><strong class="text-dark">Experience (Years):</strong> {{ $years }}</p>
                        <p><strong class="text-dark">Experience (Months):</strong> {{ $months }}</p>
                        <p><strong class="text-dark">Description:</strong> {{ $exp->description }}</p>
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
                                        <label for="cm-4">Company<span class="text-danger d-inline">*</span></label>
                                        <input type="text" id="cm-4" name="company" placeholder="Company Name"
                                            required>
                                    </div>
                                    <div class="rt-input-group">
                                        <label for="title-4">Position<span class="text-danger d-inline">*</span></label>
                                        <input type="text" id="title-4" name="position"
                                            placeholder="Software Engineer" required>
                                    </div>
                                </div>

                                <div class="row row-cols-sm-2 row-cols-1">
                                    <div class="rt-input-group">
                                        <label for="de-4">Experience<span
                                                class="text-danger d-inline">*</span></label>
                                        <input type="number" class="no-spinner" name="exp_years" id="de-4"
                                            placeholder="Experience in years" required>
                                    </div>
                                    <div class="rt-input-group">
                                        <label for="sd-4">Month<span class="text-danger d-inline">*</span></label>
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
                                    <label for="desc-4">Description<span class="text-danger d-inline">*</span></label>
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
                <div class="submitted-education-info mb-3 position-relative" id="education-row-{{ $education->id }}">
                    <!-- Edit Button -->
                    <button type="button" class="btn btn-sm btn-outline-primary btn-light edit-education-btn"
                        data-bs-toggle="modal" data-bs-target="#editEducationModal" data-id="{{ $education->id }}"
                        data-level="{{ $education->level }}" data-board="{{ $education->board_university }}"
                        data-institute="{{ $education->school_college }}" data-stream="{{ $education->stream }}"
                        data-starting_year="{{ $education->starting_year }}"
                        data-passing_year="{{ $education->passing_year }}"
                        data-percentage="{{ $education->percentage }}" style="position: absolute; left:20%;">
                        <i class="fas fa-pen"></i> Edit
                    </button>

                    <!-- Delete Button -->
                    <button type="button" class="btn btn-outline-danger btn-sm ms-2" id="deleteEducationBtn"
                        data-id="{{ $education->id }}" style="position: absolute; left:25%;">
                        <i class="fas fa-trash"></i> Delete
                    </button>

                    <!-- Education Info -->
                    <p><strong class="text-dark">Education Level:</strong> {{ $education->level }}</p>
                    <p><strong class="text-dark">Board Type:</strong> {{ $education->board_university }}</p>
                    <p><strong class="text-dark">Institute Name:</strong> {{ $education->school_college }}</p>
                    @if ($education->stream)
                        <p><strong class="text-dark">Stream:</strong> {{ $education->stream }}</p>
                    @endif
                    <p><strong class="text-dark">Starting Year:</strong> {{ $education->starting_year }}</p>
                    <p><strong class="text-dark">Passing Year:</strong> {{ $education->passing_year }}</p>
                    <p class="mb-3"><strong class="text-dark">Percentage/Grade:</strong> {{ $education->percentage }}
                    </p>
                    <hr>
                </div>
            @endforeach
        @else
            <p>No education information available.</p>
        @endif

        <!-- Edit Education Modal -->
        <div class="modal fade" id="editEducationModal" tabindex="-1" aria-labelledby="editEducationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editEducationForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editEducationModalLabel">Edit Education</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="education_id" id="education_id">
                            <div class="mb-2">
                                <label>Level<span class="text-danger d-inline">*</span></label>
                                <select name="level" id="level" required
                                    style="width: 100%; padding: 0.625rem 1rem; border: 1px solid #ddd; border-radius: 8px; height: 50px; background-color: white;">
                                    <option value="">Select Level</option>
                                    <option value="10th">10th</option>
                                    <option value="12th">12th</option>
                                    <option value="UG">Graduation/Diploma</option>
                                    <option value="PG">Post Graduation</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="PhD">PhD</option>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label>Board/University<span class="text-danger d-inline">*</span></label>
                                <input type="text" name="board_university" id="board_university" class="form-control"
                                    required>
                            </div>
                            <div class="mb-2">
                                <label>Institute<span class="text-danger d-inline">*</span></label>
                                <input type="text" name="school_college" id="school_college" class="form-control"
                                    required>
                            </div>
                            <div class="mb-2">
                                <label>Stream</label>
                                <input type="text" name="stream" id="stream" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label>Starting Year<span class="text-danger d-inline">*</span></label>
                                {{-- <input type="number" name="starting_year" id="edit_starting_year" class="form-control"
                                    required> --}}
                                <select name="starting_year" id="edit_starting_year" class="form-control">
                                    @for ($i = date('Y'); $i >= 1950; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-2">
                                <label>Passing Year<span class="text-danger d-inline">*</span></label>
                                {{-- <input type="number" name="passing_year" id="edit_passing_year" class="form-control"
                                    required> --}}
                                <select name="passing_year" id="edit_passing_year" class="form-control">
                                    @for ($i = date('Y'); $i >= 1950; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-2">
                                <label>Percentage/Grade<span class="text-danger d-inline">*</span></label>
                                <input type="number" name="percentage" id="percentage" class="form-control"
                                    step="0.01" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



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
                                        <option value="UG">Graduation</option>
                                        <option value="PG">Post Graduation</option>
                                        <option value="Diploma">Diploma</option>
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
                                    <div class="row g-2">
                                        <div class="col">
                                            <label for="starting_year">Starting Year<span
                                                    class="text-danger d-inline">*</span></label>
                                            <select name="starting_year" id="starting_year" class="form-control"
                                                style="height: 56px;">
                                                @for ($i = date('Y'); $i >= 1950; $i--)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="passing_year">Passing Year<span
                                                    class="text-danger d-inline">*</span></label>
                                            <select name="passing_year" id="passing_year" class="form-control"
                                                style="height: 56px;">
                                                @for ($i = date('Y'); $i >= 1950; $i--)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="rt-input-group">
                                    <label for="percentage">Percentage/Grade<span
                                            class="text-danger d-inline">*</span></label>
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

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="confirmDeleteLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this education record?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="confirmDeleteBtn" class="btn btn-danger btn-sm">Yes, Delete</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- education end -->

    <!-- Award -->
    <h6 class="fw-medium mt-30 mb-20">Award</h6>
    <div class="my__education radius-16 p-30 bg-white" id="education-3">

        @if ($awards)
            @foreach ($awards as $award)
                <div class="submitted-education-info mb-3 position-relative">
                    <button type="button" class="btn btn-sm btn-light edit-award-btn" data-bs-toggle="modal"
                        data-bs-target="#editAwardModal" data-id="{{ $award->id }}"
                        data-award_title="{{ $award->award_title }}" data-award_date="{{ $award->award_date }}"
                        data-award_desc="{{ $award->award_desc }}" style="position: absolute; right:15%;">
                        <i class="fas fa-pen"></i>
                    </button>


                    <p><strong class="text-dark">Title:</strong> {{ $award->award_title }}</p>
                    <p><strong class="text-dark">Date:</strong>
                        {{ \Carbon\Carbon::parse($award->award_date)->format('d M Y') }}</p>
                    <p><strong class="text-dark">Description:</strong> {{ $award->award_desc }}</p>
                    </p>
                    <hr>
                </div>
            @endforeach
        @else
            <p>No education information available.</p>
        @endif

        <!-- Edit Award Modal -->
        <div class="modal fade" id="editAwardModal" tabindex="-1" aria-labelledby="editAwardModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editAwardForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editAwardModalLabel">Edit Award</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="award_id" id="award_id">

                            <div class="mb-2">
                                <label>Title<span class="text-danger d-inline">*</span></label>
                                <input type="text" name="award_title" id="award_title" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label>Date<span class="text-danger d-inline">*</span></label>
                                <input type="date" name="award_date" id="award_date" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label>Description<span class="text-danger d-inline">*</span></label>
                                <textarea id="award_desc" name="award_desc" cols="30" rows="5" class="form-control"
                                    placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Award Form -->
        <div class="accordion-item">
            <div id="c4" class="accordion-collapse collapse" data-bs-parent="#rts-accordion-3">
                <div class="accordion-body p-0 mt-3 mb-20">
                    <form action="javascript:void(0)" id="AddAward">
                        <div class="info__field">
                            <div class="row row-cols-sm-2 row-cols-1">
                                <div class="rt-input-group">
                                    <label for="titlea">Title<span class="text-danger d-inline">*</span></label>
                                    <input type="text" id="titlea" name="award_title"
                                        placeholder="McMaster Center for Software Certification" required>
                                </div>
                                <div class="rt-input-group">
                                    <label for="ye-7">Year<span class="text-danger d-inline">*</span></label>
                                    <input type="date" id="ye-7" name="award_date" placeholder="dd/mm/yy"
                                        required>
                                </div>
                            </div>
                            <div class="rt-input-group">
                                <label for="desc-7">Description<span class="text-danger d-inline">*</span></label>
                                <textarea id="desc-7" name="award_desc" cols="30" rows="5" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-30">
                            <button type="submit" class="btn me-3 added__social__link">Add Award</button>
                            <a href="#" class="removeAward added__social__link">Remove Award</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Award Button -->
        <div class="d-flex justify-content-start" id="addAwardContainer">
            <a href="#" id="addAwardBtn" class="added__social__link">Add Award</a>
        </div>
    </div>
    <!-- Award end -->


@endsection

@section('script')
    <script>
        const addSkillBtn = document.getElementById('addSkillInput');
        const wrapper = document.getElementById('skillInputsWrapper');
        const submitBtn = document.getElementById('SubmitSkillInput');
        const actionsRow = document.querySelector('.form-skill-actions');

        function updateUIState() {
            const inputCount = wrapper.querySelectorAll('.skill-input-group').length;
            if (inputCount > 0) {
                submitBtn.classList.remove('d-none');
                actionsRow.classList.add('justify-content-start');
            } else {
                submitBtn.classList.add('d-none');
                actionsRow.classList.remove('justify-content-start');
            }
        }

        addSkillBtn.addEventListener('click', function() {
            const inputGroup = document.createElement('div');
            inputGroup.className = 'd-flex align-items-center skill-input-group gap-2';

            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'skills[]';
            input.placeholder = 'Enter skill';
            // input.className = 'form-control';

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'btn btn-sm btn-danger';
            removeBtn.innerHTML = '<i class="fa-solid fa-xmark"></i>';

            removeBtn.addEventListener('click', function() {
                inputGroup.remove();
                updateUIState();
            });

            inputGroup.appendChild(input);
            inputGroup.appendChild(removeBtn);
            wrapper.appendChild(inputGroup);

            updateUIState();
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
    {{-- <script>
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
    </script> --}}

    {{-- For Remove Skill --}}
    <script>
        $('#skillList').on('click', '.remove-skill', function () {
            let skill = $(this).data('skill');
            let listItem = $(this).closest('li');
    
            $.ajax({
                url: "{{ route('User.RemoveSkill') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    skill: skill
                },
                success: function (response) {
                    if (response.status_code == 1) {
                        listItem.fadeOut(300, function () {
                            $(this).remove();
                        });
                        Toastify({
                            text: response.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            className: "bg-success"
                        }).showToast();
                    } else {
                        Toastify({
                            text: response.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            className: "bg-danger"
                        }).showToast();
                    }
                },
                error: function () {
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

    {{-- For Manage Date --}}
    <script type="text/javascript">
        $('#AddEducation').on('submit', function(e) {
            e.preventDefault();

            let startingYear = parseInt($('#starting_year').val());
            let passingYear = parseInt($('#passing_year').val());

            if (isNaN(startingYear) || isNaN(passingYear)) {
                Toastify({
                    text: "Both Starting Year and Passing Year are required.",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    className: "bg-danger"
                }).showToast();
                return;
            }

            if (passingYear < startingYear) {
                Toastify({
                    text: "Passing Year must be greater than Starting Year.",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    className: "bg-danger"
                }).showToast();
                return;
            }

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

    {{-- For Update Candidate Qualification --}}
    <script>
        $(document).ready(function() {
            // Fill modal form with existing data
            $('.edit-education-btn').on('click', function() {
                $('#education_id').val($(this).data('id'));
                $('#level').val($(this).data('level'));
                $('#board_university').val($(this).data('board'));
                $('#school_college').val($(this).data('institute'));
                $('#stream').val($(this).data('stream'));
                $('#edit_starting_year').val($(this).data('starting_year'));
                $('#edit_passing_year').val($(this).data('passing_year'));
                $('#percentage').val($(this).data('percentage'));
            });

            // Submit updated education via AJAX
            $('#editEducationForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('User.UpdateEducation') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status_code === 1) {
                            Toastify({
                                text: response.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "green"
                                }
                            }).showToast();

                            setTimeout(function() {
                                if (response.redirect_url) {
                                    window.location.href = response.redirect_url;
                                } else {
                                    location.reload();
                                }
                            }, 750);
                        } else {
                            Toastify({
                                text: response.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "orange"
                                }
                            }).showToast();
                        }
                    },
                    error: function() {
                        Toastify({
                            text: "Something went wrong.",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            style: {
                                background: "red"
                            }
                        }).showToast();
                    }
                });
            });
        });
    </script>

    {{-- For Delete Candidate Qualification --}}
    <script>
        let selectedEducationId = null;
        let selectedDeleteButton = null;

        $(document).on('click', '#deleteEducationBtn', function() {
            selectedEducationId = $(this).data('id');
            selectedDeleteButton = $(this);
            $('#confirmDeleteModal').modal('show');
        });

        $('#confirmDeleteBtn').on('click', function() {
            if (!selectedEducationId) return;

            let btn = selectedDeleteButton;
            btn.html(
                '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Deleting...'
            ).prop('disabled', true);

            $.ajax({
                url: "{{ route('User.DeleteEducation', ['id' => '__id__']) }}".replace('__id__',
                    selectedEducationId),
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Toastify({
                        text: "Education record deleted successfully.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        className: "bg-success"
                    }).showToast();

                    $(`#education-row-${selectedEducationId}`).fadeOut(300, function() {
                        $(this).remove();
                    });

                    $('#editEducationModal').modal('hide');
                    $('#confirmDeleteModal').modal('hide');
                },
                error: function() {
                    Toastify({
                        text: "Failed to delete the record. Please try again.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        className: "bg-danger"
                    }).showToast();
                },
                complete: function() {
                    btn.html('<i class="fas fa-trash"></i>').prop('disabled', false);
                    selectedEducationId = null;
                    selectedDeleteButton = null;
                }
            });
        });
    </script>



    {{-- For Showing the Award Section --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addAwdBtn = document.getElementById("addAwardBtn");
            const addAwdCon = document.getElementById("addAwardContainer");
            const awdDiv = document.getElementById("c4");

            // Note: This element exists after clicking "Add", so we attach the listener dynamically
            function attachRemoveListener() {
                const removeAwdBtn = document.querySelector(".removeAward");
                if (removeAwdBtn) {
                    removeAwdBtn.addEventListener("click", function(e) {
                        e.preventDefault();
                        awdDiv.classList.remove("show");
                        if (addAwdCon) {
                            addAwdCon.classList.remove("d-none"); // Show again
                            addAwdCon.classList.add("d-flex"); // Show again
                        }
                    });
                }
            }

            addAwdBtn.addEventListener("click", function(e) {
                e.preventDefault();

                // Show experience form
                awdDiv.classList.add("show");

                // Hide "Add Experience" button
                if (addAwdCon) {
                    addAwdCon.classList.remove("d-flex");
                    addAwdCon.classList.add("d-none");
                }

                // Attach remove handler
                attachRemoveListener();
            });
        });
    </script>

    {{-- For Submit Candidate Award --}}
    <script type="text/javascript">
        $('#AddAward').on('submit', function(e) {
            e.preventDefault();

            let form = this;
            let url = "{{ route('User.CandidateAward') }}"; // change to your route name

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

    {{-- For Update Candidate Award --}}
    <script>
        $(document).ready(function() {
            // Fill modal form with existing data
            $('.edit-award-btn').on('click', function() {
                $('#award_id').val($(this).data('id'));
                $('#award_title').val($(this).data('award_title'));
                $('#award_date').val($(this).data('award_date'));
                $('#award_desc').val($(this).data('award_desc'));
            });

            // Submit updated award via AJAX
            $('#editAwardForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('User.UpdateAward') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status_code === 1) {
                            Toastify({
                                text: response.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "green"
                                }
                            }).showToast();

                            setTimeout(function() {
                                if (response.redirect_url) {
                                    window.location.href = response.redirect_url;
                                } else {
                                    location.reload();
                                }
                            }, 750);
                        } else {
                            Toastify({
                                text: response.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "orange"
                                }
                            }).showToast();
                        }
                    },
                    error: function() {
                        Toastify({
                            text: "Something went wrong.",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            style: {
                                background: "red"
                            }
                        }).showToast();
                    }
                });
            });
        });
    </script>
@endsection
