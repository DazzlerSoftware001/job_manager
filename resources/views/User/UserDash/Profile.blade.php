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
                            <select name="country_code" id="country_code" class="form-select" style="height: 55px;"
                                required>

                            </select>

                            <input type="text" id="phone" name="phone" value="{{ $user->phone ?? '' }}"
                                placeholder="1234567890" required readonly style="width:77%;height: 55px;">
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
                            <option value="Matric" {{ $user->education_level == 'Matric' ? 'selected' : '' }}>Secondary
                                Education</option>
                            <option value="Higher Secondary"
                                {{ $user->education_level == 'Higher Secondary' ? 'selected' : '' }}>Higher Secondary
                                Education</option>
                            <option value="UG" {{ $user->education_level == 'UG' ? 'selected' : '' }}>Undergraduate
                                (UG)</option>
                            <option value="PG" {{ $user->education_level == 'PG' ? 'selected' : '' }}>Postgraduate (PG)
                            </option>
                            <option value="PhD" {{ $user->education_level == 'PhD' ? 'selected' : '' }}>Doctorate (PhD)
                            </option>
                            <option value="PostDoc" {{ $user->education_level == 'PostDoc' ? 'selected' : '' }}>
                                Postdoctoral Research (After PhD)</option>
                            <option value="Diploma" {{ $user->education_level == 'Diploma' ? 'selected' : '' }}>Diploma &
                                Certificate Courses</option>
                        </select>
                    </div>
                    <div class="rt-input-group">
                        <label for="qualification">Qualification</label>
                        <input type="text" name="qualification" id="qualification" class="form-control"
                            value="{{ $user->qualification }}" placeholder="Ex- B.Tech" required>

                    </div>

                    <div class="rt-input-group">
                        <label for="branch">Branch</label>
                        <input type="text" name="branch" id="branch" placeholder="Ex- CS"
                            value="{{ $user->branch }}" class="form-control">

                    </div>

                    @php
                        // Decode languages from the database
                        $selectedLanguages = json_decode($user->language, true) ?? [];
                    @endphp

                    <div class="rt-input-group">
                        <label for="lang">Language</label>
                        <select name="lang[]" id="lang" class="form-select" multiple>
                            <option value="">Select Language</option>
                            {{-- Options will be injected by JS --}}
                        </select>
                    </div>

                </div>
                <!-- qualification end -->

                <!-- experience -->
                <div class="row row-cols-sm-2 row-cols-1 g-3">
                    @php
                        $experience = $user->experience ?? 0;
                        $expParts = explode('.', number_format($experience, 2, '.', ''));
                        $exp_year = $expParts[0] ?? '';
                        $exp_months = ltrim($expParts[1] ?? '', '0'); // Remove leading zero (e.g. '05' => '5')
                    @endphp

                    <div class="rt-input-group">
                        <label for="experience">Experience</label>
                        <div style="display: flex; gap: 10px;">
                            <input type="number" name="exp_year" id="experience" class="no-spinner"
                                placeholder="Years" value="{{ $exp_year }}">
                            <select name="exp_months" id="experience_months" class="form-select">
                                <option value="">Select Months</option>
                                @for ($i = 1; $i <= 11; $i++)
                                    <option value="{{ $i }}" {{ $exp_months == $i ? 'selected' : '' }}>
                                        {{ $i }} Month{{ $i > 1 ? 's' : '' }}
                                    </option>
                                @endfor
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
                        rows="5">{{ $user->description }}</textarea>
                </div>
                <!-- editor area end -->
            </div>
            <h6 class="fw-medium mt-4 mb-4">Social Links</h6>
            @php
                $socialLinks = json_decode($user->social_links ?? '{}', true);
            @endphp

            <div class="social__links p-30 radius-16 bg-white" id="social">
                <div class="info__field" id="socialFields">
                    @foreach ($socialLinks as $name => $link)
                        <div class="row g-3 social-group align-items-end">
                            @if ($loop->first && $name === 'Facebook')
                                <!-- Default Facebook field -->
                                <div class="col-sm-6">
                                    <div class="rt-input-group">
                                        <label for="{{ $name }}">{{ $name }}</label>
                                        <input type="url" name="social_link[]" value="{{ $link }}"
                                            placeholder="https://www.{{ strtolower($name) }}.com/yourpage" required>
                                        <input type="hidden" name="social_name[]" value="{{ $name }}">
                                    </div>
                                </div>
                            @else
                                <!-- Additional fields -->
                                <div class="col-sm-3">
                                    <div class="rt-input-group">
                                        <label>Media Name</label>
                                        <input type="text" name="social_name[]" value="{{ $name }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="rt-input-group">
                                        <label>Media Link</label>
                                        <input type="url" name="social_link[]" value="{{ $link }}"
                                            placeholder="https://{{ strtolower($name) }}.com/yourprofile" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-danger remove-social">Remove</button>
                                </div>
                            @endif
                        </div>
                    @endforeach
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
                        @php
                            $selectedCountry = $user->country;
                        @endphp
                        <div class="rt-input-group">
                            <label for="Country">Country</label>
                            <select name="country" id="country" class="form-select">
                                <option value="">Select Country</option>
                            </select>
                        </div>


                        <div class="rt-input-group">
                            <label for="pr">Present Address</label>
                            <input type="text" id="pr" name="address" value="{{ $user->address }}"
                                placeholder="Enter Your Address " required>
                        </div>
                    </div>
                    <div>
                        <div class="info__field">
                            <div class="rt-input-group">
                                <label for="state">State</label>
                                <input type="text" name="state" id="state" value="{{ $user->state }}"
                                    class="form-control" placeholder="Enter Your State" required>

                            </div>

                            <div class="rt-input-group">
                                <label for="postalCode">Postal Code</label>
                                <input type="text" id="postalCode" name="postalCode"
                                    value="{{ $user->postal_code }}" placeholder="Ex -128340" required>
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


    {{-- country_code --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var countryCodeDropdown = document.getElementById('country_code');

            if (countryCodeDropdown) {
                // Full list of country codes with country names
                const countryCodeList = [{
                        code: "+1",
                        country: "United States"
                    },
                    {
                        code: "+1",
                        country: "Canada"
                    },
                    {
                        code: "+44",
                        country: "United Kingdom"
                    },
                    {
                        code: "+91",
                        country: "India"
                    },
                    {
                        code: "+61",
                        country: "Australia"
                    },
                    {
                        code: "+81",
                        country: "Japan"
                    },
                    {
                        code: "+33",
                        country: "France"
                    },
                    {
                        code: "+49",
                        country: "Germany"
                    },
                    {
                        code: "+55",
                        country: "Brazil"
                    },
                    {
                        code: "+34",
                        country: "Spain"
                    },
                    {
                        code: "+39",
                        country: "Italy"
                    },
                    {
                        code: "+86",
                        country: "China"
                    },
                    {
                        code: "+7",
                        country: "Russia"
                    },
                    {
                        code: "+27",
                        country: "South Africa"
                    },
                    {
                        code: "+52",
                        country: "Mexico"
                    },
                    {
                        code: "+31",
                        country: "Netherlands"
                    },
                    {
                        code: "+41",
                        country: "Switzerland"
                    },
                    {
                        code: "+47",
                        country: "Norway"
                    },
                    {
                        code: "+46",
                        country: "Sweden"
                    },
                    {
                        code: "+45",
                        country: "Denmark"
                    },
                    {
                        code: "+48",
                        country: "Poland"
                    },
                    {
                        code: "+53",
                        country: "Cuba"
                    },
                    {
                        code: "+54",
                        country: "Argentina"
                    },
                    {
                        code: "+56",
                        country: "Chile"
                    },
                    {
                        code: "+57",
                        country: "Colombia"
                    },
                    {
                        code: "+58",
                        country: "Venezuela"
                    },
                    {
                        code: "+60",
                        country: "Malaysia"
                    },
                    {
                        code: "+62",
                        country: "Indonesia"
                    },
                    {
                        code: "+63",
                        country: "Philippines"
                    },
                    {
                        code: "+64",
                        country: "New Zealand"
                    },
                    {
                        code: "+65",
                        country: "Singapore"
                    },
                    {
                        code: "+66",
                        country: "Thailand"
                    },
                    {
                        code: "+81",
                        country: "Japan"
                    },
                    {
                        code: "+82",
                        country: "South Korea"
                    },
                    {
                        code: "+84",
                        country: "Vietnam"
                    },
                    {
                        code: "+90",
                        country: "Turkey"
                    },
                    {
                        code: "+91",
                        country: "India"
                    },
                    {
                        code: "+92",
                        country: "Pakistan"
                    },
                    {
                        code: "+93",
                        country: "Afghanistan"
                    },
                    {
                        code: "+94",
                        country: "Sri Lanka"
                    },
                    {
                        code: "+95",
                        country: "Myanmar"
                    },
                    {
                        code: "+98",
                        country: "Iran"
                    },
                    {
                        code: "+211",
                        country: "South Sudan"
                    },
                    {
                        code: "+212",
                        country: "Morocco"
                    },
                    {
                        code: "+213",
                        country: "Algeria"
                    },
                    {
                        code: "+216",
                        country: "Tunisia"
                    },
                    {
                        code: "+218",
                        country: "Libya"
                    },
                    {
                        code: "+220",
                        country: "Gambia"
                    },
                    {
                        code: "+221",
                        country: "Senegal"
                    },
                    {
                        code: "+222",
                        country: "Mauritania"
                    },
                    {
                        code: "+223",
                        country: "Mali"
                    },
                    {
                        code: "+224",
                        country: "Guinea"
                    },
                    {
                        code: "+225",
                        country: "Ivory Coast"
                    },
                    {
                        code: "+226",
                        country: "Burkina Faso"
                    },
                    {
                        code: "+227",
                        country: "Niger"
                    },
                    {
                        code: "+228",
                        country: "Togo"
                    },
                    {
                        code: "+229",
                        country: "Benin"
                    },
                    {
                        code: "+230",
                        country: "Mauritius"
                    },
                    {
                        code: "+231",
                        country: "Liberia"
                    },
                    {
                        code: "+232",
                        country: "Sierra Leone"
                    },
                    {
                        code: "+233",
                        country: "Ghana"
                    },
                    {
                        code: "+234",
                        country: "Nigeria"
                    },
                    {
                        code: "+235",
                        country: "Chad"
                    },
                    {
                        code: "+236",
                        country: "Central African Republic"
                    },
                    {
                        code: "+237",
                        country: "Cameroon"
                    },
                    {
                        code: "+238",
                        country: "Cape Verde"
                    },
                    {
                        code: "+239",
                        country: "São Tomé and Príncipe"
                    },
                    {
                        code: "+240",
                        country: "Equatorial Guinea"
                    },
                    {
                        code: "+241",
                        country: "Gabon"
                    },
                    {
                        code: "+242",
                        country: "Congo"
                    },
                    {
                        code: "+243",
                        country: "Democratic Republic of the Congo"
                    },
                    {
                        code: "+244",
                        country: "Angola"
                    },
                    {
                        code: "+245",
                        country: "Guinea-Bissau"
                    },
                    {
                        code: "+246",
                        country: "British Indian Ocean Territory"
                    },
                    {
                        code: "+247",
                        country: "Ascension Island"
                    },
                    {
                        code: "+248",
                        country: "Seychelles"
                    },
                    {
                        code: "+249",
                        country: "Sudan"
                    },
                    {
                        code: "+250",
                        country: "Rwanda"
                    },
                    {
                        code: "+251",
                        country: "Ethiopia"
                    },
                    {
                        code: "+252",
                        country: "Somalia"
                    },
                    {
                        code: "+253",
                        country: "Djibouti"
                    },
                    {
                        code: "+254",
                        country: "Kenya"
                    },
                    {
                        code: "+255",
                        country: "Tanzania"
                    },
                    {
                        code: "+256",
                        country: "Uganda"
                    },
                    {
                        code: "+257",
                        country: "Burundi"
                    },
                    {
                        code: "+258",
                        country: "Mozambique"
                    },
                    {
                        code: "+260",
                        country: "Zambia"
                    },
                    {
                        code: "+261",
                        country: "Madagascar"
                    },
                    {
                        code: "+262",
                        country: "Réunion"
                    },
                    {
                        code: "+263",
                        country: "Zimbabwe"
                    },
                    {
                        code: "+264",
                        country: "Namibia"
                    },
                    {
                        code: "+265",
                        country: "Malawi"
                    },
                    {
                        code: "+266",
                        country: "Lesotho"
                    },
                    {
                        code: "+267",
                        country: "Botswana"
                    },
                    {
                        code: "+268",
                        country: "Eswatini"
                    },
                    {
                        code: "+269",
                        country: "Comoros"
                    },
                    {
                        code: "+27",
                        country: "South Africa"
                    }
                ];

                // Populate the country code dropdown dynamically
                countryCodeList.forEach(function(item) {
                    const option = document.createElement('option');
                    option.value = item.code; // Set value to country code
                    option.textContent = `${item.country} (${item.code})`; // Display country and code
                    countryCodeDropdown.appendChild(option);
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            var country_code = document.getElementById('country_code');
            if (country_code) {
                const country = new Choices(country_code, {
                    shouldSort: false,
                    // position: 'down', // Enables removing selected items
                });
            }
        });
    </script>

    {{-- End country_code --}}




    {{-- country --}}
    <script>
        $(document).ready(function() {
            const selectedCountry = @json($selectedCountry); // Passing the selected country to JS

            // Sample country list (can be fetched from an API or database)
            const countries = [
                "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Argentina",
                "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain",
                "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Bhutan",
                "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei",
                "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada",
                "Chile", "China", "Colombia", "Costa Rica", "Croatia", "Cuba", "Cyprus",
                "Czech Republic", "Denmark", "Dominican Republic", "Ecuador", "Egypt",
                "El Salvador", "Estonia", "Ethiopia", "Fiji", "Finland", "France", "Germany",
                "Greece", "Guatemala", "Honduras", "Hungary", "Iceland", "India", "Indonesia",
                "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan",
                "Kazakhstan", "Kenya", "Kuwait", "Malaysia", "Mexico", "Morocco", "Nepal",
                "Netherlands", "New Zealand", "Nigeria", "Norway", "Pakistan", "Panama", "Peru",
                "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "South Korea",
                "Spain", "Sri Lanka", "Sudan", "Sweden", "Switzerland", "Syria", "Thailand", "Turkey",
                "United Kingdom", "United States", "Uruguay", "Vietnam", "Yemen"
            ];

            // Loop through the countries array and append to the select element
            countries.forEach(function(country) {
                const isSelected = country === selectedCountry ? 'selected' :
                ''; // Check if the country is the selected one
                $('#country').append(`<option value="${country}" ${isSelected}>${country}</option>`);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var country = document.getElementById('country');
            if (country) {
                const countries = new Choices(country, {
                    shouldSort: false,
                    position: 'down',
                });
            }
        });
    </script>
    {{-- End country --}}

    {{-- language --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var lang = document.getElementById('lang');

            // Inject PHP selected values into JS
            const selectedLanguages = @json($selectedLanguages);

            const languageList = [
                "Afrikaans", "Arabic", "Bengali", "Chinese", "Czech", "Danish", "Dutch", "English",
                "Finnish", "French", "German", "Greek", "Gujarati", "Hebrew", "Hindi", "Hungarian",
                "Indonesian", "Italian", "Japanese", "Javanese", "Kannada", "Korean", "Latvian",
                "Mandarin", "Malay", "Marathi", "Norwegian", "Polish", "Portuguese", "Punjabi",
                "Romanian", "Russian", "Spanish", "Swahili", "Swedish", "Tamil", "Telugu", "Turkish",
                "Ukrainian", "Urdu", "Vietnamese", "Wolof", "Yoruba", "Zulu"
            ];

            // Populate and preselect
            languageList.forEach(function(langName) {
                const option = document.createElement('option');
                option.value = langName;
                option.textContent = langName;

                // Check if it should be selected
                if (selectedLanguages.includes(langName)) {
                    option.selected = true;
                }

                lang.appendChild(option);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var lang = document.getElementById('lang');
            if (lang) {
                const lang1 = new Choices(lang, {
                    shouldSort: false,
                    position: 'down',
                    removeItemButton: true, // Enables removing selected items
                });
            }
        });
    </script>
    {{-- End language --}}



    <!-- JS to handle adding new social fields -->
    <script>
        document.querySelector('.added__social__links').addEventListener('click', function() {
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
        document.addEventListener('click', function(e) {
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
