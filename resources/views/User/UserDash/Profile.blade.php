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
        <form method="POST" action="javascript:void(0)" id="Profile">
            <div class="my__details" id="info">
                <div class="info__top">
                    <div class="author__image">
                        <img src="{{ url('user/assets/img/profile/default.png') }}" alt="">
                    </div>
                    <div class="select__image">
                        <label for="file" class="file-upload__label">Upload New Photo</label>
                        <input type="file" class="file-upload__input" name="img" id="file" required >
                    </div>
                    <div class="delete__data">
                        <i class="fa-light fa-trash-can"></i>
                    </div>
                </div>
                <div class="info__field">
                    <div class="row row-cols-sm-2 row-cols-1 g-3">
                        <div class="rt-input-group">
                            <label for="name">First Name</label>
                            <input type="text" id="name" name="name" placeholder="First Name" required>
                        </div>
                        <div class="rt-input-group">
                            <label for="name">Last Name</label>
                            <input type="text" id="lname" name="lname" placeholder="Last Name" required>
                        </div>
                        <div class="rt-input-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="careernext@gmqail.com" required>
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
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        {{-- <div class="rt-input-group">
                                    <label for="age">Age</label>
                                    <select name="age" id="age" class="form-select">
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                        <option value="32">32</option>
                                        <option value="33">33</option>
                                        <option value="34">34</option>
                                        <option value="35">35</option>
                                        <option value="36">36</option>
                                        <option value="37">37</option>
                                    </select>
                                </div> --}}
                    </div>
                    <!-- salary type -->
                    {{-- <div class="row row-cols-sm-3 row-cols-1 g-3">
                                <div class="rt-input-group">
                                    <label for="salary">Salary Type</label>
                                    <select name="salary" id="salary" class="form-select">
                                        <option value="hourly">Hourly</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="yearly">Yearly</option>
                                    </select>
                                </div>
                                <div class="rt-input-group">
                                    <label for="jobcat">Job Category</label>
                                    <select name="jobcat" id="jobcat" class="form-select">
                                        <option value="1">Select Job Category</option>
                                        <option value="2">it consultancy</option>
                                        <option value="3">Job Category 2</option>
                                        <option value="4">Job Category 3</option>
                                        <option value="5">Job Category 4</option>
                                        <option value="6">Job Category 5</option>
                                        <option value="7">Job Category 6</option>
                                    </select>
                                </div>
                                <div class="rt-input-group">
                                    <label for="jobtitle">Job Title</label>
                                    <input type="text" id="jobtitle" placeholder="Enter Job Title" required>
                                </div>
                            </div> --}}
                    <!-- salary type end -->

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
                            <select name="lang" id="lang" class="form-select">
                                <option value="1">Select Language</option>
                                <option value="2">English</option>
                                <option value="3">Hindi</option>
                                <option value="4">French</option>
                                <option value="5">Spanish</option>
                                <option value="6">Chinese</option>
                            </select>
                        </div>
                        {{-- <div class="rt-input-group">
                                    <label for="tags">Tags</label>
                                    <input type="text" id="tags" placeholder="Enter Tags" required>
                                </div> --}}
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
            </div>
            <h6 class="fw-medium mt-4 mb-4">Social Links</h6>
            <div class="social__links p-30 radius-16 bg-white" id="social">
                <div class="info__field" id="socialFields">
                    <!-- First Field -->
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="rt-input-group">
                                <label for="Facebook">Facebook</label>
                                <input type="url" id="Facebook" name="social_link[]" placeholder="https://www.facebook.com/yourpage" required>
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
                            <input type="text" id="pr" placeholder="2715 Ash Dr. San Jose,USA" required>
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
    

    <script type="text/javascript">
        // Add or Update
        $('#Profile').on('submit', function() {

            var url = "{{ route('User.ProfileInsert') }}";

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
                            className: "bg-success",
                            style: "style",
                        }).showToast();
                        
                        // Redirect to login or home page & Reload after 0.7 seconds (750 ms)
                        setTimeout(function() {
                            window.location.href = result.redirect_url;
                        }, 750);

                    } else if (result.status_code == 2) {
                        Toastify({
                            text: result.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            className: "bg-warning",
                            style: "style",
                        }).showToast();

                    } else {
                        Toastify({
                            text: result.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            className: "bg-danger",
                            style: "style",
                        }).showToast();
                    }
                }
            });
        });
    </script>
@endsection
