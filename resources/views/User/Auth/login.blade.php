<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="Your Ultimate Job HTML Template">
    <meta name="keywords" content="Job, Resume, Employer, Agency">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="Your Ultimate Job HTML Template">
    <meta property="og:description" content="Your Ultimate Job HTML Template">
    <meta property="og:image" content="../../../www.example.com/image.html">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Your Ultimate Job HTML Template">
    <meta name="twitter:description" content="Your Ultimate Job HTML Template">

    <link rel="shortcut-icon" href="{{url('user/assets/img/favicon-16x16.png')}}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&amp;display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{url('user/assets/img/favicon.ico')}}" type="image/x-icon">
    <title>careernext - Job Seeker &amp; Job Holder HTML Template</title>

    <link rel="stylesheet" href="{{url('user/assets/fonts/icon/css/rt-icons.css')}}">
    <link rel="stylesheet" href="{{url('user/assets/fonts/fontawesome/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{url('user/assets/css/plugins.min.css')}}">
    <link rel="stylesheet" href="{{url('user/assets/css/style.css')}}">
</head>

<body>

    <div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow rounded-4 border-0" style="max-width: 500px; width: 100%;">
            <div class="card-body p-4">
                <div class="d-flex mb-3 align-items-center justify-content-center">
                    <h5 class="mb-0 fw-semibold">Login to careernext</h5>
                </div>
                <div class="d-block has__line text-center mb-4"></div>
                {{-- <div class="d-block has__line text-center mb-4">
                    <p class="mb-0">Choose your Account Type</p>
                </div>
    
                <div class="tab__switch flex-wrap flex-sm-nowrap nav-tab mb-4 text-center d-flex justify-content-center gap-3">
                    <button class="rts__btn nav-link active"><i class="fa-light fa-user"></i> Candidate</button>
                    <button class="rts__btn nav-link"><i class="rt-briefcase"></i> Employer</button>
                </div> --}}
    
                <form action="javascript:void(0)" method="post" class="d-flex flex-column gap-3" id="Login">
                    {{-- @csrf --}}
                    <div class="form-group">
                        <label for="email" class="fw-medium text-dark mb-2">Your Email</label>
                        <div class="position-relative">
                            <input type="email" name="email" value="ankit@gmail.com" id="email" class="form-control" placeholder="Enter your email" required>
                            <i class="fa-light fa-user icon position-absolute end-0 top-50 translate-middle-y me-3"></i>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="password" class="fw-medium text-dark mb-2">Password</label>
                        <div class="position-relative">
                            <input type="password" name="password" value="12345678" id="password" class="form-control" placeholder="Enter your password" required>
                            <i class="fa-light fa-lock icon position-absolute end-0 top-50 translate-middle-y me-3"></i>
                        </div>
                    </div>
    
                    <div class="d-flex flex-wrap justify-content-between align-items-center fw-medium">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                        </div>
                        <a href="#" class="forgot__password text-para">Forgot Password?</a>
                    </div>
    
                    <div class="form-group my-3">
                        <button type="submit" class="rts__btn w-100 fill__btn">Login</button>
                    </div>
                </form>
    
                {{-- <div class="d-block has__line text-center my-4"><p class="mb-0">Or</p></div>
    
                <div class="d-flex gap-3 flex-wrap justify-content-center mb-4">
                    <div class="is__social google">
                        <button class="btn btn-light w-100"><img src="{{url('user/assets/img/icon/google-small.svg')}}" alt=""> Continue with Google</button>
                    </div>
                    <div class="is__social facebook">
                        <button class="btn btn-light w-100"><img src="{{url('user/assets/img/icon/facebook-small.svg')}}" alt=""> Continue with Facebook</button>
                    </div>
                </div> --}}
    
                <span class="d-block text-center fw-medium">
                    Don’t have an account?
                    <a href="{{route('User.register')}}" class="text-primary">Sign Up</a>
                </span>
            </div>
        </div>
    </div>
    

    <script src="{{url('user/assets/js/plugins.min.js')}}"></script>
    <script src="{{url('user/assets/js/main.js')}}"></script>

     {{-- Login User --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script type="text/javascript">
        // Add or Update
        $('#Login').on('submit', function() {

            var url = "{{ route('User.loginInsert') }}";

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

</body>

</html>
