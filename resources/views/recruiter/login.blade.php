<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>CareerNest | Recruiter Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="CareerNest | Recruiter Login" name="description" />
    <meta content="Dazzler Software" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="{{ url('recruiter/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ url('recruiter/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ url('recruiter/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0 align-items-center">
                <div class="col-xxl-4 col-lg-4 col-md-6">
                    <div class="row justify-content-center g-0">
                        <div class="col-xl-9">
                            <div class="p-4">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <div class="auth-full-page-content rounded d-flex p-3 my-2">
                                            <div class="w-100">
                                                <div class="d-flex flex-column h-100">
                                                    <div class="mb-4 mb-md-5">
                                                        <a href="index.html" class="d-block auth-logo">
                                                            <img src="{{ url('recruiter/assets/images/logo-dark.png') }}"
                                                                alt="" height="22"
                                                                class="auth-logo-dark me-start">
                                                            <img src="{{ url('recruiter/assets/images/logo-light.png') }}"
                                                                alt="" height="22"
                                                                class="auth-logo-light me-start">
                                                        </a>
                                                    </div>
                                                    <div class="auth-content my-auto">
                                                        <div class="text-center">
                                                            <h5 class="mb-0">Welcome Back !</h5>
                                                            <p class="text-muted mt-2">Sign in to continue to Borex.</p>
                                                        </div>

                                                        {{-- @if(session('error'))
                                                            <div class="alert alert-danger">
                                                                {{ session('error') }}
                                                            </div>
                                                        @endif --}}


                                                        <form class="mt-4 pt-2" method="POST"
                                                            action="javascript:void(0)" id="Login">
                                                            {{--  --}}
                                                            <div class="form-floating form-floating-custom mb-4">
                                                                <input type="email" class="form-control"
                                                                    id="input-username" name="email"
                                                                    placeholder="Enter Email" value="" required>
                                                                <label for="input-username">Email</label>
                                                                <div class="form-floating-icon">
                                                                    <i data-eva="email-outline"></i>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
                                                                <input type="password" class="form-control pe-5"
                                                                    id="password-input" name="password"
                                                                    placeholder="Enter Password" value="" required>
                                                                <button type="button"
                                                                    class="btn btn-link position-absolute h-100 end-0 top-0"
                                                                    id="password-addon">
                                                                    <i
                                                                        class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                                </button>
                                                                <label for="password-input">Password</label>
                                                                <div class="form-floating-icon">
                                                                    <i data-eva="lock-outline"></i>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-4">
                                                                <div class="col">
                                                                    <div class="form-check font-size-15">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="remember-check" name="remember">
                                                                        <label class="form-check-label font-size-13"
                                                                            for="remember-check"> Remember me </label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <button
                                                                    class="btn btn-primary w-100 waves-effect waves-light"
                                                                    type="submit">Log In</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="mt-4 text-center">
                                                        <p class="mb-0">©
                                                            <script>
                                                                document.write(new Date().getFullYear())
                                                            </script> CareerNest . Crafted with <i
                                                                class="mdi mdi-heart text-danger"></i> by Dazzler Software
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
                <div class="col-xxl-8 col-lg-8 col-md-6">
                    <div class="auth-bg bg-white py-md-5 p-4 d-flex">
                        <div class="bg-overlay bg-white"></div>
                        <!-- end bubble effect -->
                        <div class="row justify-content-center align-items-center">
                            <div class="col-xl-8">
                                <div class="mt-4">
                                    <img src="{{ url('recruiter/assets/images/login-img.png') }}" class="img-fluid"
                                        alt="">
                                </div>
                                <div class="p-0 p-sm-4 px-xl-0 py-5">
                                    <div id="reviewcarouselIndicators" class="carousel slide auth-carousel"
                                        data-bs-ride="carousel">
                                        <div class="carousel-indicators carousel-indicators-rounded">
                                            <button type="button" data-bs-target="#reviewcarouselIndicators"
                                                data-bs-slide-to="0" class="active" aria-current="true"
                                                aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#reviewcarouselIndicators"
                                                data-bs-slide-to="1" aria-label="Slide 2"></button>
                                            <button type="button" data-bs-target="#reviewcarouselIndicators"
                                                data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        </div>

                                        <!-- end carouselIndicators -->
                                        <div class="carousel-inner w-75 mx-auto">
                                            <div class="carousel-item active">
                                                <div class="testi-contain text-center">
                                                    <h5 class="font-size-20 mt-4">“I feel confident
                                                        imposing change
                                                        on myself”
                                                    </h5>
                                                    <p class="font-size-15 text-muted mt-3 mb-0">Vestibulum auctor orci
                                                        in risus iaculis consequat suscipit felis rutrum aliquet iaculis
                                                        augue sed tempus In elementum ullamcorper lectus vitae pretium
                                                        Aenean sed odio dolor Nullam ultricies diam
                                                        eu ultrices tellus eifend sagittis.</p>
                                                </div>
                                            </div>

                                            <div class="carousel-item">
                                                <div class="testi-contain text-center">
                                                    <h5 class="font-size-20 mt-4">“Our task must be to
                                                        free widening our circle”</h5>
                                                    <p class="font-size-15 text-muted mt-3 mb-0">
                                                        Curabitur eget nulla eget augue dignissim condintum Nunc
                                                        imperdiet ligula porttitor commodo elementum
                                                        Vivamus justo risus fringilla suscipit faucibus orci luctus
                                                        ultrices posuere cubilia curae lectus non ultricies cursus.
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="carousel-item">
                                                <div class="testi-contain text-center">
                                                    <h5 class="font-size-20 mt-4">“I've learned that
                                                        people will forget what you”</h5>
                                                    <p class="font-size-15 text-muted mt-3 mb-0">
                                                        Pellentesque lacinia scelerisque arcu in aliquam augue molestie
                                                        rutrum magna Fusce dignissim dolor id auctor accumsan
                                                        vehicula dolor
                                                        vivamus feugiat odio erat sed vehicula lorem tempor quis Donec
                                                        nec scelerisque magna
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end carousel-inner -->
                                    </div>
                                    <!-- end review carousel -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ url('recruiter/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('recruiter/assets/libs/metismenujs/metismenujs.min.js') }}"></script>
    <script src="{{ url('recruiter/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('recruiter/assets/libs/eva-icons/eva.min.js') }}"></script>

    <script src="{{ url('recruiter/assets/js/pages/pass-addon.init.js') }}"></script>

    <script src="{{ url('recruiter/assets/js/pages/eva-icon.init.js') }}"></script>

    {{-- Login User --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script type="text/javascript">
        // Add or Update
        $('#Login').on('submit', function() {

            var url = "{{ route('Recruiter.loginInsert') }}";

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
