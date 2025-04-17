<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="Your Ultimate Job HTML Template">
    <meta name="keywords" content="Job, Resume, Employer, Agency">
    <meta name="robots" content="index, follow">
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
    
                <form action="#" method="post" class="d-flex flex-column gap-3">
                    @csrf
                    <div class="form-group">
                        <label for="sname" class="fw-medium text-dark mb-3">First Name</label>
                        <div class="position-relative">
                            <input type="text" name="sname" id="sname" class="form-control" placeholder="First Name" required>
                            <i class="fa-light fa-user icon position-absolute end-0 top-50 translate-middle-y me-3"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lname" class="fw-medium text-dark mb-3">Last Name</label>
                        <div class="position-relative">
                            <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required>
                            <i class="fa-light fa-user icon position-absolute end-0 top-50 translate-middle-y me-3"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="fw-medium text-dark mb-2">Your Email</label>
                        <div class="position-relative">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="password" class="fw-medium text-dark mb-2">Password</label>
                        <div class="position-relative">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
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
                        <button class="rts__btn w-100 fill__btn">Register</button>
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
                    Already have an account?
                    <a href="{{route('User.login')}}" class="text-primary">Sign In</a>
                </span>
            </div>
        </div>
    </div>
    

    <script src="{{url('user/assets/js/plugins.min.js')}}"></script>
    <script src="{{url('user/assets/js/main.js')}}"></script>
</body>

</html>
