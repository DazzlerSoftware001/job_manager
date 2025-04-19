@extends('User.UserDashLayout.main')
@section('title')
    Profile
@endsection
@section('main-container')
    <div class="my__profile__tab radius-16 bg-white">
        <nav>
            <div class="nav nav-tabs">
                <a class="nav-link active" href="#info">My Details</a>
                <a class="nav-link " href="#social">Social Links</a>
                <a class="nav-link" href="#address">Contact Information</a>
            </div>
        </nav>

        <div class="my__details" id="info">
            <div class="info__top">
                <div class="author__image">
                    <img id="profileImage" src="{{ url('user/assets/img/' . $user->logo) }}"
                        onerror="this.onerror=null; this.src='{{ url('user/assets/img/profile/default.png') }}';"
                        alt="">
                </div>
                <div class="select__image">
                    <button for="imageInput" id="editImageButton" class="file-upload__label">Upload New Photo</button>
                    <input type="file" id="imageInput" class="d-none" accept="image/*">
                </div>
            </div>
        </div>
        <form method="POST" action="javascript:void(0)" id="Profile">
            <div class="info__field">
                <div class="row row-cols-sm-2 row-cols-1 g-3">
                    <div class="rt-input-group">
                        <label for="name">First Name</label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}"
                            placeholder="First Name" required>
                    </div>
                    <div class="rt-input-group">
                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="lname" value="{{ $user->lname }}"
                            placeholder="Last Name" required>
                    </div>
                    <div class="rt-input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}"
                            placeholder="careernext@gmqail.com" required readonly>
                    </div>
                    <div class="rt-input-group">
                        <label for="phone">Phone</label>
                        <div style="display: flex; gap: 10px;">
                            <select name="country_code" id="country_code" class="form-select" style="width:30%;" required>
                                @foreach ($countries as $country)
                                    <option value="{{ $country['dial_code'] }}" {{ old('country_code') == $country['dial_code'] ? 'selected' : '' }}>
                                        {{ $country['flag'] }} {{ $country['dial_code'] }} ({{ $country['name'] }})
                                    </option>
                                @endforeach
                            </select>
                    
                            <input type="text" id="phone" name="phone" value="{{ $user->phone ?? '' }}"
                                placeholder="1234567890" required readonly>
                        </div>
                    </div>
                    
                    <div class="rt-input-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" value="{{ $user->date_of_birth }}" required>
                    </div>
                    <div class="rt-input-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-select">
                            <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="All" {{ $user->gender == 'All' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <!-- qualification -->
                <div class="row row-cols-sm-3 row-cols-1 g-3">
                    <div class="rt-input-group">
                        <label for="education_level">Education Level</label>
                        <select name="education_level" id="education_level" class="form-select">
                            <option value="">Select Education Level</option>
                            <option value="Matric" {{ $user->education_level == 'Matric' ? 'selected' : '' }}>Secondary Education</option>
                            <option value="Higher Secondary" {{ $user->education_level == 'Higher Secondary' ? 'selected' : '' }}>Higher Secondary Education</option>
                            <option value="UG" {{ $user->education_level == 'UG' ? 'selected' : '' }}>Undergraduate (UG)</option>
                            <option value="PG" {{ $user->education_level == 'PG' ? 'selected' : '' }}>Postgraduate (PG)</option>
                            <option value="PhD" {{ $user->education_level == 'PhD' ? 'selected' : '' }}>Doctorate (PhD)</option>
                            <option value="PostDoc" {{ $user->education_level == 'PostDoc' ? 'selected' : '' }}>Postdoctoral Research (After PhD)</option>
                            <option value="Diploma" {{ $user->education_level == 'Diploma' ? 'selected' : '' }}>Diploma & Certificate Courses</option>
                        </select>
                    </div>
                    <div class="rt-input-group">
                        <label for="qualification">Qualification</label>
                        <input type="text" name="qualification" id="qualification" class="form-control" placeholder="Ex- B.Tech" required>
                           
                    </div>

                    <div class="rt-input-group">
                        <label for="branch">Branch</label>
                        <input type="text" name="branch" id="branch" placeholder="Ex- CS" class="form-control">
                            
                    </div>

                    <div class="rt-input-group">
                        <label for="lang">Language</label>
                        <select name="lang[]" id="lang" class="form-select" multiple>
                            <option value="">Select Language</option>
                            @foreach ($languages as $lang)
                                <option value="{{ $lang }}" {{ in_array($lang, $user->lang ?? []) ? 'selected' : '' }}>
                                    {{ $lang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    
                </div>
                <!-- qualification end -->

                <!-- experience -->
                <div class="row row-cols-sm-2 row-cols-1 g-3">
                    <div class="rt-input-group">
                        <label for="experience">Experience</label>
                        <div style="display: flex; gap: 10px;">
                            <input type="number" name="exp_year" id="experience" class="no-spinner" placeholder="Years">
                            <select name="exp_months" id="experience_months" class="form-select">
                                <option value="">Select Months</option>
                                <option value="1">1 Month</option>
                                <option value="2">2 Months</option>
                                <option value="3">3 Months</option>
                                <option value="4">4 Months</option>
                                <option value="5">5 Months</option>
                                <option value="6">6 Months</option>
                                <option value="7">7 Months</option>
                                <option value="8">8 Months</option>
                                <option value="9">9 Months</option>
                                <option value="10">10 Months</option>
                                <option value="11">11 Months</option>
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="rt-input-group">
                        <label for="show">Looking for a job ? </label>
                        <select name="jobSearch" id="jobSearch" class="form-select">
                            <option value="">Select</option>
                            <option value="1" {{ $user->look_job == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ $user->look_job == '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                </div>
                <!-- experience end -->
                <!-- editor area -->
                <div class="rt-input-group">
                    <label for="description">Candidate Description</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Enter Description" cols="10"
                        rows="5">{{$user->description}}</textarea>
                </div>
                <!-- editor area end -->
            </div>
            <h6 class="fw-medium mt-4 mb-4">Social Links</h6>
            <div class="social__links p-30 radius-16 bg-white" id="social">
                <div class="info__field" id="socialFields">
                    <!-- First Field (Default Facebook) -->
                    <div class="row g-3 social-group">
                        <div class="col-sm-6">
                            <div class="rt-input-group">
                                <label for="Facebook">Facebook</label>
                                <input type="url" name="social_link[]" placeholder="https://www.facebook.com/yourpage" required>
                                <input type="hidden" name="social_name[]" value="Facebook">
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Add Button -->
                <div class="d-block mt-30">
                    <button type="button" class="added__social__links btn btn-primary">
                        Add Another Network
                    </button>
                </div>
            </div>
            
            <!-- address area -->
            <h6 class="fw-medium mt-4 mb-4">Address / Location</h6>
            <div class="social__links radius-16 p-30 bg-white" id="address">
                <div class="row row-cols-md-2 row-cols-lg-2 row-cols-1 g-30">
                    <div class="info__field">
                        <div class="rt-input-group">
                            <label for="Country">Country</label>
                            <select name="country" id="country" class="form-select">
                                <option value="">Select Country</option>
                                @foreach ($countryList as $country)
                                    <option value="{{ $country['name'] }}" 
                                        {{ $user->country == $country['name'] ? 'selected' : '' }}>
                                        {{ $country['flag'] }} {{ $country['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="rt-input-group">
                            <label for="pr">Present Address</label>
                            <input type="text" id="pr" name="address" value="{{$user->address}}" placeholder="Enter Your Address "
                                required>
                        </div>
                    </div>
                    <div>
                        <div class="info__field">
                            <div class="rt-input-group">
                                <label for="state">State</label>
                                <input type="text" name="state" id="state" class="form-control" placeholder="Enter Your State" required>
                                   
                            </div>

                            <div class="rt-input-group">
                                <label for="postalCode">Postal Code</label>
                                <input type="text" id="postalCode" name="postalCode" value="{{$user->postal_code}}" placeholder="Ex -128340" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info__field">
                <button type="submit" class="rts__btn fill__btn mx-0">Save Profile</button>
            </div>
        </form>
    </div>

    <!-- address area end -->
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
                var lang = document.getElementById('lang');
                if (lang) {
                    const lang1 = new Choices(lang, {
                        shouldSort: false,
                        position: 'down',
                        removeItemButton: true, // Enables removing selected items
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                var country_code = document.getElementById('country_code');
                if (country_code) {
                    const country = new Choices(country_code, {
                        shouldSort: false,
                        position: 'down',
                        removeItemButton: true, // Enables removing selected items
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                var country = document.getElementById('country');
                if (country) {
                    const countries = new Choices(country, {
                        shouldSort: false,
                        position: 'down',
                        removeItemButton: true, // Enables removing selected items
                    });
                }
            });
    </script>
    

    <!-- JS to handle adding new social fields -->
    <script>
        document.querySelector('.added__social__links').addEventListener('click', function () {
            const container = document.getElementById('socialFields');
    
            const newField = document.createElement('div');
            newField.classList.add('row', 'g-3', 'social-group', 'align-items-end');
    
            newField.innerHTML = `
                <div class="col-sm-3">
                    <div class="rt-input-group">
                        <label>Media Name</label>
                        <input type="text" name="social_name[]" placeholder="e.g., Twitter" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="rt-input-group">
                        <label>Media Link</label>
                        <input type="url" name="social_link[]" placeholder="https://twitter.com/yourprofile" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-danger remove-social">Remove</button>
                </div>
            `;
    
            container.appendChild(newField);
        });
    
        // Remove button functionality
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-social')) {
                const group = e.target.closest('.social-group');
                group.remove();
            }
        });
    </script>
    
    
  



    {{-- Update Profile Image --}}
    <script>
        $(document).ready(function() {

            // Trigger file input when camera icon is clicked
            $('#editImageButton').click(function() {
                $('#imageInput').click();
            });

            // Preview Image and Upload
            $('#imageInput').change(function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#profileImage').attr('src', e.target.result); // Image preview
                    }
                    reader.readAsDataURL(file);

                    // Upload Image using AJAX
                    const formData = new FormData();
                    formData.append('image', file);

                    $.ajax({
                        url: "{{ route('User.UpdateProfileImage') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(result) {
                            if (result.status_code === 1) {
                                // $('#EditModal').modal('hide');
                                // $('#EditCompany').trigger("reset");
                                // $('#myTable').DataTable().ajax.reload(null, false);
                                Toastify({
                                    text: result.message,
                                    duration: 3000,
                                    gravity: "top",
                                    position: "right",
                                    style: {
                                        background: "#28a745",
                                    },
                                }).showToast();
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
                }
            });
        });
    </script>


    <script type="text/javascript">
        $('#Profile').on('submit', function(e) {
            e.preventDefault(); // prevent form from reloading

            var url = "{{ route('User.UpdateProfile') }}";

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
@endsection
