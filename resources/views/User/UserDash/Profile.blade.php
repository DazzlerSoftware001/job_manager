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
                    <img id="profileImage" src="{{ url('user/assets/img/'.$user->logo) }}" onerror="this.onerror=null; this.src='{{ url('user/assets/img/profile/default.png') }}';" alt="">
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
                        <input type="text" id="name" name="name" value="{{$user->name}}" placeholder="First Name" required>
                    </div>
                    <div class="rt-input-group">
                        <label for="name">Last Name</label>
                        <input type="text" id="lname" name="lname" value="{{$user->lname}}"  placeholder="Last Name" required>
                    </div>
                    <div class="rt-input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{$user->email}}"  placeholder="careernext@gmqail.com" required>
                    </div>
                    <div class="rt-input-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" placeholder="+880171234567" required>
                    </div>
                    <div class="rt-input-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" required>
                    </div>
                    <div class="rt-input-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-select">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="All">Other</option>
                        </select>
                    </div>
                </div>

                <!-- qualification -->
                <div class="row row-cols-sm-3 row-cols-1 g-3">
                    <div class="rt-input-group">
                        <label for="education_level">Education Level</label>
                        <select name="education_level" id="education_level" class="form-select">
                            <option value="1">Select Qualification</option>
                            <option value="2">SSC</option>
                            <option value="3">HSC</option>
                            <option value="4">Diploma</option>
                            <option value="5">Graduation</option>
                            <option value="6">Post Graduation</option>
                        </select>
                    </div>
                    <div class="rt-input-group">
                        <label for="qualification">Qualification</label>
                        <select name="qualification" id="qualification" class="form-select">
                            <option value="1">Select Qualification</option>
                            <option value="2">SSC</option>
                            <option value="3">HSC</option>
                            <option value="4">Diploma</option>
                            <option value="5">Graduation</option>
                            <option value="6">Post Graduation</option>
                        </select>
                    </div>
                    <div class="rt-input-group">
                        <label for="branch">Branch</label>
                        <select name="branch" id="branch" class="form-select">
                            <option value="1">Select Qualification</option>
                            <option value="2">SSC</option>
                            <option value="3">HSC</option>
                            <option value="4">Diploma</option>
                            <option value="5">Graduation</option>
                            <option value="6">Post Graduation</option>
                        </select>
                    </div>
                    <div class="rt-input-group">
                        <label for="lang">Language</label>
                        <select name="lang[]" id="lang" class="form-select">
                            <option value="1">Select Language</option>
                            <option value="2">English</option>
                            <option value="3">Hindi</option>
                            <option value="4">French</option>
                            <option value="5">Spanish</option>
                            <option value="6">Chinese</option>
                        </select>
                    </div>
                </div>
                <!-- qualification end -->

                <!-- experience -->
                <div class="row row-cols-sm-2 row-cols-1 g-3">
                    <div class="rt-input-group">
                        <label for="experience">experience</label>
                        <select name="experience" id="experience" class="form-select">
                            <option value="1">Experience</option>
                            <option value="2">1 Year</option>
                            <option value="3">2 Year</option>
                            <option value="4">3 Year</option>
                            <option value="5">4 Year</option>
                        </select>
                    </div>
                    <div class="rt-input-group">
                        <label for="show">Looking for a job ? </label>
                        <select name="show" id="show" class="form-select">
                            <option value="">Select</option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                        </select>
                    </div>

                </div>
                <!-- experience end -->
                <!-- editor area -->
                <div class="rt-input-group">
                    <label for="description">Candidate Description</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Enter Description" cols="10"
                        rows="5"></textarea>
                </div>
                <!-- editor area end -->
            </div>
            <h6 class="fw-medium mt-4 mb-4">Social Links</h6>
            <div class="social__links p-30 radius-16 bg-white" id="social">
                <div class="info__field" id="socialFields">
                    <!-- First Field -->
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="rt-input-group">
                                <label for="Facebook">Facebook</label>
                                <input type="url" id="Facebook" name="social_link[]"
                                    placeholder="https://www.facebook.com/yourpage" required>
                                <input type="hidden" name="social_link[]" value="Facebook">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Button -->
                <div class="d-block mt-30">
                    <button type="button" class="added__social__link">
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
                            <select name="Country" id="Country" class="form-select">
                                <option value="1">Select Country</option>
                                <option value="2">Bangladesh</option>
                                <option value="3">India</option>
                                <option value="4">Pakistan</option>
                                <option value="5">Nepal</option>
                                <option value="6">Srilanka</option>
                                <option value="7">China</option>
                                <option value="8">USA</option>
                            </select>
                        </div>
                        <div class="rt-input-group">
                            <label for="pr">Present Address</label>
                            <input type="text" id="pr" name="address" placeholder="2715 Ash Dr. San Jose,USA" required>
                        </div>
                    </div>
                    <div>
                        <div class="info__field">
                            <div class="rt-input-group">
                                <label for="State">State</label>
                                <select name="State" id="State" class="form-select">
                                    <option value="1">Select State</option>
                                    <option value="2">Dhaka</option>
                                    <option value="3">Chittagong</option>
                                    <option value="4">Sylhet</option>
                                    <option value="5">Rajshahi</option>
                                    <option value="6">Khulna</option>
                                    <option value="7">Barishal</option>
                                    <option value="8">Mymensingh</option>
                                </select>
                            </div>
                            <div class="rt-input-group">
                                <label for="ps">Postal Code</label>
                                <input type="text" id="ps" name="ps" placeholder="8340" required>
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
        $('#Profile').on('submit', function (e) {
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
                success: function (result) {
                    if (result.status_code == 1) {
                        Toastify({
                            text: result.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            className: "bg-success"
                        }).showToast();
    
                        setTimeout(function () {
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
                error: function (xhr) {
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
