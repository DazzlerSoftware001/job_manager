 <body data-sidebar="dark">

     <!-- <body data-layout="horizontal"> -->

     <!-- Begin page -->
     <div id="layout-wrapper">


         <header id="page-topbar" class="isvertical-topbar">
             <div class="navbar-header">
                 <div class="d-flex">
                     <!-- LOGO -->
                     <div class="navbar-brand-box">
                         <a href="{{ route('Recruiter.dashboard') }}" class="logo logo-dark">
                             <span class="logo-sm">
                                 <img src="{{ url('recruiter/assets/images/logo-dark-sm.png') }}" alt=""
                                     height="22">
                             </span>
                             <span class="logo-lg">
                                 <img src="{{ url('recruiter/assets/images/logo-dark-sm.png') }}" alt=""
                                     height="22">
                             </span>
                         </a>

                         <a href="{{ route('Recruiter.dashboard') }}" class="logo logo-light">
                             <span class="logo-lg">
                                 <img src="{{ url('recruiter/assets/images/logo-light.png') }}" alt=""
                                     height="22">
                             </span>
                             <span class="logo-sm">
                                 <img src="{{ url('recruiter/assets/images/logo-light-sm.png') }}" alt=""
                                     height="22">
                             </span>
                         </a>
                     </div>

                     <button type="button"
                         class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn topnav-hamburger">
                         <span class="hamburger-icon open">
                             <span></span>
                             <span></span>
                             <span></span>
                         </span>
                     </button>

                     <div class="d-none d-sm-block ms-3 align-self-center">
                         <h4 class="page-title">@yield('page-title')</h4>
                     </div>

                 </div>

                 <div class="d-flex">
                    {{-- <div class="dropdown">
                        <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="icon-sm" data-eva="search-outline"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-md p-0">
                            <form class="p-2">
                                <div class="search-box">
                                    <div class="position-relative">
                                        <input type="text" class="form-control bg-light border-0"
                                            placeholder="Search...">
                                        <i class="search-icon" data-eva="search-outline" data-eva-height="26"
                                            data-eva-width="26"></i>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                     <div class="dropdown d-inline-block language-switch">
                         <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true"
                             aria-expanded="false">
                             <img class="header-lang-img" src="{{ url('recruiter/assets/images/flags/us.jpg') }}"
                                 alt="Header Language" height="16">
                         </button>
                         <div class="dropdown-menu dropdown-menu-end">

                             <!-- item-->
                             <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="eng">
                                 <img src="{{ url('recruiter/assets/images/flags/us.jpg') }}" alt="user-image"
                                     class="me-1" height="12"> <span class="align-middle">English</span>
                             </a>

                             <!-- item-->
                             <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp">
                                 <img src="{{ url('recruiter/assets/images/flags/spain.jpg') }}" alt="user-image"
                                     class="me-1" height="12"> <span class="align-middle">Spanish</span>
                             </a>

                             <!-- item-->
                             <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
                                 <img src="{{ url('recruiter/assets/images/flags/germany.jpg') }}" alt="user-image"
                                     class="me-1" height="12"> <span class="align-middle">German</span>
                             </a>

                             <!-- item-->
                             <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
                                 <img src="{{ url('recruiter/assets/images/flags/italy.jpg') }}" alt="user-image"
                                     class="me-1" height="12"> <span class="align-middle">Italian</span>
                             </a>

                             <!-- item-->
                             <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                                 <img src="{{ url('recruiter/assets/images/flags/russia.jpg') }}" alt="user-image"
                                     class="me-1" height="12"> <span class="align-middle">Russian</span>
                             </a>
                         </div>
                     </div>

                     <div class="dropdown d-none d-lg-inline-block">
                         <button type="button" class="btn header-item noti-icon" data-bs-toggle="dropdown"
                             aria-haspopup="true" aria-expanded="false">
                             <i class="icon-sm" data-eva="grid-outline"></i>
                         </button>
                         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                             <div class="p-3">
                                 <div class="row align-items-center">
                                     <div class="col">
                                         <h5 class="m-0 font-size-15"> Web Apps </h5>
                                     </div>
                                     <div class="col-auto">
                                         <a href="#!" class="small fw-semibold text-decoration-underline"> View
                                             All</a>
                                     </div>
                                 </div>
                             </div>
                             <div class="px-lg-2 pb-2">
                                 <div class="row g-0">
                                     <div class="col">
                                         <a class="dropdown-icon-item" href="#!">
                                             <img src="{{ url('recruiter/assets/images/brands/github.png') }}"
                                                 alt="Github">
                                             <span>GitHub</span>
                                         </a>
                                     </div>
                                     <div class="col">
                                         <a class="dropdown-icon-item" href="#!">
                                             <img src="{{ url('recruiter/assets/images/brands/bitbucket.png') }}"
                                                 alt="bitbucket">
                                             <span>Bitbucket</span>
                                         </a>
                                     </div>
                                     <div class="col">
                                         <a class="dropdown-icon-item" href="#!">
                                             <img src="{{ url('recruiter/assets/images/brands/dribbble.png') }}"
                                                 alt="dribbble">
                                             <span>Dribbble</span>
                                         </a>
                                     </div>
                                 </div>

                                 <div class="row g-0">
                                     <div class="col">
                                         <a class="dropdown-icon-item" href="#!">
                                             <img src="{{ url('recruiter/assets/images/brands/dropbox.png') }}"
                                                 alt="dropbox">
                                             <span>Dropbox</span>
                                         </a>
                                     </div>
                                     <div class="col">
                                         <a class="dropdown-icon-item" href="#!">
                                             <img src="{{ url('recruiter/assets/images/brands/mail_chimp.png') }}"
                                                 alt="mail_chimp">
                                             <span>Mail Chimp</span>
                                         </a>
                                     </div>
                                     <div class="col">
                                         <a class="dropdown-icon-item" href="#!">
                                             <img src="{{ url('recruiter/assets/images/brands/slack.png') }}"
                                                 alt="slack">
                                             <span>Slack</span>
                                         </a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>--}}

                       @php
                            $UserProfile = \App\Models\UserProfile::where('user_type', 2)
                                ->where('user_details', 'Recruiter')
                                ->first();
                            $notifications = $UserProfile ? $UserProfile->unreadNotifications : collect();
                        @endphp

                     <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown-v"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-sm" data-eva="bell-outline"></i>
                            @if($notifications->count())
                                <span class="noti-dot bg-danger rounded-pill">{{ $notifications->count() }}</span>
                            @endif
                        </button>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown-v">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="m-0 font-size-15"> Notifications </h5>
                                    </div>
                                    {{-- <div class="col-auto">
                                        <a href="{{ route('notifications.markAllRead') }}" class="small fw-semibold text-decoration-underline">Mark all as read</a>
                                    </div> --}}
                                </div>
                            </div>

                            <div data-simplebar style="max-height: 250px;">
                                @forelse($notifications as $notification)
                                    <a href="{{ $notification->data['url'] ?? '#' }}" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-sm me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="bx bx-bell"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ $notification->data['title'] ?? 'Notification' }}</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">{{ $notification->data['message'] ?? '' }}</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 
                                                        <span>{{ $notification->created_at->diffForHumans() }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <a href="#" class="text-reset notification-item">
                                        <div class="d-flex justify-content-center">
                                            <span class="text-muted">No new notifications</span>
                                        </div>
                                    </a>
                                @endforelse
                            </div>

                            {{-- <div class="p-2 border-top d-grid">
                                <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="{{ route('notifications.all') }}">
                                    <i class="uil-arrow-circle-right me-1"></i> <span>View More..</span>
                                </a>
                            </div> --}}
                        </div>
                    </div>

                    {{-- <div class="dropdown d-inline-block">
                         <button type="button" class="btn header-item noti-icon right-bar-toggle"
                             id="right-bar-toggle-v">
                             <i class="icon-sm" data-eva="settings-outline"></i>
                         </button>
                     </div>--}}

                     <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown-v"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" id="profileImage1" src="{{ url('recruiter/logo/default.png') }}" onerror="this.onerror=null; this.src='{{ url('recruiter/logo/default.png') }}';"
                            alt="Header Avatar">
                        </button>
                         <div class="dropdown-menu dropdown-menu-end pt-0">
                             <div class="p-3 border-bottom">
                                 <h6 class="mb-0" id="nameDisplay1"></h6>
                                 <p class="mb-0 font-size-11 text-muted" id="emailDisplay1"></p>
                             </div>
                             <a class="dropdown-item" href="#"><i
                                     class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i>
                                 <span class="align-middle">Profile</span></a>

                             {{-- <a class="dropdown-item" href="3"><i
                                     class="mdi mdi-message-text-outline text-muted font-size-16 align-middle me-1"></i>
                                 <span class="align-middle">Messages</span></a>
                             <a class="dropdown-item" href="#"><i
                                     class="mdi mdi-lifebuoy text-muted font-size-16 align-middle me-1"></i> <span
                                     class="align-middle">Help</span></a>
                             <div class="dropdown-divider"></div>
                             <a class="dropdown-item" href="#"><i
                                     class="mdi mdi-wallet text-muted font-size-16 align-middle me-1"></i> <span
                                     class="align-middle">Balance : <b>$6951.02</b></span></a>
                             <a class="dropdown-item d-flex align-items-center" href="#"><i
                                     class="mdi mdi-cog-outline text-muted font-size-16 align-middle me-1"></i> <span
                                     class="align-middle">Settings</span><span
                                     class="badge bg-success-subtle text-success ms-auto">New</span></a>
                             <a class="dropdown-item" href="#"><i
                                     class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> <span
                                     class="align-middle">Lock screen</span></a> --}}
                             <a class="dropdown-item" href="javascript:void(0);" id="logoutButton">
                                 <i class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i>
                                 <span class="align-middle">Logout</span>
                             </a>
                         </div>
                     </div>
                 </div>
             </div>
         </header>

         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
         <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

         <script type="text/javascript">
             $('#logoutButton').on('click', function() {
                 var url = "{{ route('Recruiter.logout') }}";

                 $.ajax({
                     url: url,
                     type: 'POST',
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
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
                     },
                     error: function() {
                         Toastify({
                             text: 'Logout failed. Please try again.',
                             duration: 3000,
                             gravity: "top",
                             position: "right",
                             className: "bg-danger",
                             style: "style",
                         }).showToast();
                     }
                 });
             });
         </script>

         {{-- To get details --}}
        <script>
            $(document).ready(function() {
                $.ajax({
                    url: "{{ route('Recruiter.dashboardData') }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {

                        // Check if logo exists and update the profile image
                        if (data.logo) {
                            $('#profileImage1').attr('src', "{{ asset('') }}" + data.logo);
                        } else {
                            $('#profileImage1').attr('src',
                                "{{ url('recruiter/logo/default.png') }}");
                        }

                        $('#nameDisplay1').text(data.name);
                        $('#emailDisplay1').text(data.email);
                    },
                    error: function() {
                        alert('Failed to fetch data!');
                    }
                });
            });
        </script>
