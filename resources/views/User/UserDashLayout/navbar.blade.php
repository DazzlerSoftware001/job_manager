<body class="template-dashboard">
    <!-- header area -->
    <header class="rts__section rts__dashboard__header position-fixed w-100">
        <div class="container-fluid g-0">
            <div class="rts__menu__background mw-100 px-20 mobile__padding rounded-0">
                <div class="row">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="rts__logo">
                            <a href="index.html">
                                <img class="logo__image" src="{{ url('user/assets/img/logo/header__one.png') }}"
                                    width="160" height="40" alt="logo">
                            </a>
                        </div>
                        <div class="navigation d-none d-lg-block">
                            <nav class="navigation__menu" id="offcanvas__menu">
                                @php
                                    $menuItems = DB::table('menu_items')->orderBy('order')->get()->groupBy('parent_id');
                                @endphp

                                @if ($menuItems->isEmpty())
                                    <ul class="list-unstyled">
                                        <li class="navigation__menu--item has-child">
                                            <a href="{{ route('User.Home') }}"
                                                class="navigation__menu--item__link">Home</a>
                                        </li>

                                        <li class="navigation__menu--item has-child">
                                            <a href="{{ route('User.JobList') }}"
                                                class="navigation__menu--item__link">Jobs</a>
                                        </li>

                                        <li class="navigation__menu--item has-child has-arrow">
                                            <a href="#" class="navigation__menu--item__link">Employers</a>
                                            <ul class="submenu sub__style" role="menu">
                                                <li role="menuitem" class="has-child has-arrow">
                                                    <a href="employer-1.html">Employer Style</a>
                                                    <ul class="sub__style" role="menu">
                                                        <li role="menuitem"><a href="employer-1.html">Employer One</a>
                                                        </li>
                                                        <li role="menuitem"><a href="employer-2.html">Employer Two</a>
                                                        </li>
                                                        <li role="menuitem"><a href="employer-3.html">Employer Three</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li role="menuitem" class="has-child has-arrow">
                                                    <a href="employer-details-1.html">Employer Details</a>
                                                    <ul class="sub__style" role="menu">
                                                        <li role="menuitem"><a href="employer-details-1.html">Employer
                                                                Details 1</a></li>
                                                        <li role="menuitem"><a href="employer-details-2.html">Employer
                                                                Details 2</a></li>
                                                    </ul>
                                                </li>
                                                <li role="menuitem"><a href="employer-dashboard.html">Employer
                                                        Dashboard</a></li>
                                            </ul>
                                        </li>

                                        <li class="navigation__menu--item has-child has-arrow">
                                            <a href="#" class="navigation__menu--item__link">Candidates</a>
                                            <ul class="submenu sub__style" role="menu">
                                                <li role="menuitem" class="has-child has-arrow">
                                                    <a href="candidate-1.html">Candidate Style</a>
                                                    <ul class="sub__style" role="menu">
                                                        <li role="menuitem"><a href="candidate-1.html">Candidate One</a>
                                                        </li>
                                                        <li role="menuitem"><a href="candidate-2.html">Candidate Two</a>
                                                        </li>
                                                        <li role="menuitem"><a href="candidate-3.html">Candidate
                                                                Three</a></li>
                                                        <li role="menuitem"><a href="candidate-4.html">Candidate
                                                                Four</a></li>
                                                    </ul>
                                                </li>
                                                <li role="menuitem" class="has-child has-arrow">
                                                    <a href="candidate-details-1.html">Candidate Details</a>
                                                    <ul class="sub__style" role="menu">
                                                        <li role="menuitem"><a href="candidate-details-1.html">Candidate
                                                                Details 1</a></li>
                                                        <li role="menuitem"><a href="candidate-details-2.html">Candidate
                                                                Details 2</a></li>

                                                    </ul>
                                                </li>
                                                <li role="menuitem"><a href="candidate-dashboard.html">Candidate
                                                        Dashboard</a></li>
                                            </ul>
                                        </li>

                                        <li class="navigation__menu--item has-child has-arrow">
                                            <a href="#" class="navigation__menu--item__link">Pages</a>
                                            <ul class="submenu sub__style" role="menu">
                                                <li role="menuitem" class="has-child has-arrow">
                                                    <a href="about.html">Blog</a>
                                                    <ul class="sub__style" role="menu">
                                                        <li role="menuitem"><a href="blog-1.html">Blog One</a></li>
                                                        <li role="menuitem"><a href="blog-2.html">Blog Two</a></li>
                                                        <li role="menuitem"><a href="blog-3.html">Blog Three</a></li>
                                                        <li role="menuitem"><a href="blog-4.html">Blog Four</a></li>
                                                        <li role="menuitem"><a href="blog-details.html">Blog Details</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li role="menuitem"><a href="about.html">About</a></li>
                                                <li role="menuitem"><a href="faq.html">Faq</a></li>
                                                <li role="menuitem"><a href="tos.html">Terms &amp; Conditions</a></li>
                                                <li role="menuitem"><a href="privacy.html">Privacy Policy</a></li>
                                                <li role="menuitem"><a href="pricing.html">Pricing</a></li>
                                            </ul>
                                        </li>

                                        <li class="navigation__menu--item has-child has-arrow">
                                            <a href="#" class="navigation__menu--item__link">Contact</a>
                                            <ul class="submenu sub__style" role="menu">
                                                <li role="menuitem"><a href="contact-1.html">Contact One</a></li>
                                                <li role="menuitem"><a href="contact-2.html">Contact Two</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                @else
                                    {{-- <ul class="list-unstyled"> --}}
                                    <ul class="navigation__menu">
                                        @php

                                            function renderMenu($items, $menuItems, $isTopLevel = true)
                                            {
                                                foreach ($items as $item) {
                                                    $hasChildren = isset($menuItems[$item->id]);

                                                    // Set classes
                                                    $liClass = $hasChildren ? 'has-child has-arrow' : '';
                                                    $liRoleAttr = $isTopLevel ? '' : ' role="menuitem"';
                                                    $liClassAttr = $isTopLevel
                                                        ? 'class="navigation__menu--item ' . $liClass . '"'
                                                        : 'class="' . $liClass . '"';

                                                    echo '<li ' . $liRoleAttr . ' ' . $liClassAttr . '>';

                                                    // Only top-level <a> gets special class for hover
                                                    $aClass = $isTopLevel
                                                        ? ' class="navigation__menu--item__link"'
                                                        : '';
                                                    $href = $hasChildren ? '#' : route('User.ViewPage', $item->url);
                                                    echo '<a href="' .
                                                        $href .
                                                        '"' .
                                                        $aClass .
                                                        '>' .
                                                        $item->title .
                                                        '</a>';

                                                    // Submenu
                                                    if ($hasChildren) {
                                                        $ulClass = $isTopLevel ? 'submenu sub__style' : 'sub__style';
                                                        echo '<ul class="' . $ulClass . '" role="menu">';
                                                        renderMenu($menuItems[$item->id], $menuItems, false);
                                                        echo '</ul>';
                                                    }

                                                    echo '</li>';
                                                }
                                            }

                                            if (isset($menuItems[null])) {
                                                renderMenu($menuItems[null], $menuItems, true);
                                            } elseif (isset($menuItems[0])) {
                                                renderMenu($menuItems[0], $menuItems, true);
                                            }
                                        @endphp
                                    </ul>
                                @endif
                            </nav>
                        </div>

                        <div class="rts__menu d-flex gap-5 gap-lg-4 gap-xl-5 align-items-center">


                            @php

                                $User = \App\Models\UserProfile::where('user_type', 0)
                                    ->where('user_details', 'User')
                                    ->where('id', Auth::id()) 
                                    ->first();
                                $notifications = $User ? $User->unreadNotifications : collect();
                                dd($notifications);
                            @endphp


                            <div class="header__right__btn d-flex align-items-center gap-30">
                                <div class="notification__btn">
                                <div class="notification__icon" data-bs-toggle="dropdown">
                                    <svg width="23" height="27" viewBox="0 0 23 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22.4936 16.8814L20.125 14.5128V11.375C20.1223 9.20661 19.3156 7.11624 17.8611 5.50811C16.4065 3.89998 14.4072 2.88832 12.25 2.66875V0.875H10.5V2.66875C8.34275 2.88832 6.34354 3.89998 4.88895 5.50811C3.43436 7.11624 2.62771 9.20661 2.625 11.375V14.5128L0.256375 16.8814C0.0922693 17.0454 4.95577e-05 17.268 0 17.5V20.125C0 20.3571 0.0921872 20.5796 0.256282 20.7437C0.420376 20.9078 0.642936 21 0.875 21H7V21.6799C6.98058 22.79 7.3717 23.8683 8.09836 24.7078C8.82501 25.5473 9.83603 26.089 10.9375 26.229C11.5458 26.2893 12.16 26.2217 12.7405 26.0304C13.3211 25.8391 13.8552 25.5284 14.3085 25.1183C14.7617 24.7082 15.1242 24.2078 15.3724 23.6492C15.6207 23.0906 15.7493 22.4863 15.75 21.875V21H21.875C22.1071 21 22.3296 20.9078 22.4937 20.7437C22.6578 20.5796 22.75 20.3571 22.75 20.125V17.5C22.75 17.268 22.6577 17.0454 22.4936 16.8814ZM14 21.875C14 22.5712 13.7234 23.2389 13.2312 23.7312C12.7389 24.2234 12.0712 24.5 11.375 24.5C10.6788 24.5 10.0111 24.2234 9.51884 23.7312C9.02656 23.2389 8.75 22.5712 8.75 21.875V21H14V21.875ZM21 19.25H1.75V17.8623L4.11862 15.4936C4.28273 15.3296 4.37495 15.107 4.375 14.875V11.375C4.375 9.51849 5.1125 7.73801 6.42525 6.42525C7.73801 5.1125 9.51848 4.375 11.375 4.375C13.2315 4.375 15.012 5.1125 16.3247 6.42525C17.6375 7.73801 18.375 9.51849 18.375 11.375V14.875C18.375 15.107 18.4673 15.3296 18.6314 15.4936L21 17.8623V19.25Z" fill="#0B0D28"/>
                                    </svg>
                                    <span class="notification__count">{{ $notifications->count() }}</span>
                                </div>
                                <div class="rts__dropdown notification__dropdown dropdown-menu top-25">
                                    <div class="rts__dropdown__content">
                                        <div class="notification__header">
                                            <h6>Notification</h6>
                                        </div>
                                        <div class="notification__body">
                                            @forelse($notifications as $notification)
                                               <div class="single__notification" id="notification-{{ $notification->id }}">
                                                    <div class="notification__content">
                                                        <p>{{ $notification->data['message'] ?? '' }}</p>
                                                    </div>
                                                    <div class="time">
                                                        <span>{{ $notification->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <button class="delete-notification border-0 bg-transparent p-0 m-0"
                                                            data-id="{{ $notification->id }}"
                                                            data-url="{{ route('notifications.delete', $notification->id) }}"
                                                            title="Delete">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </button>
                                                </div>
                                                
                                            @empty
                                                <p class="text-muted px-2">No new notifications</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>  
                            </div>
                                <div class="user__info">
                                    <div class="d-flex gap-3 align-items-center pointer" data-bs-toggle="dropdown">
                                        <div class="user__image">
                                            <img class="rounded-5" width="48" height="48"
                                                src="{{ asset(Auth::user()->logo) }}"
                                                onerror="this.onerror=null; this.src='{{ url('user/assets/img/profile/default.png') }}';"
                                                alt="">
                                        </div>
                                        <div class="user__name d-none d-xl-block">
                                            <h6 class="font-20 mb-0 fw-medium lh-sm">{{ Auth::user()->name }}
                                                {{ Auth::user()->lname }}</h6>
                                            <span>Candidate</span>
                                        </div>
                                        <div class="dropdown__option d-none d-xl-block">
                                            <div class="dropdown__icon "><i class="fa-light fa-chevron-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="rts__dropdown dropdown-menu top-25">
                                        {{-- <li><a class="dropdown-item" href="{{route('User.Dashboard')}}">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{route('User.Profile')}}">Profile</a></li>
                                    <li><a class="dropdown-item" href="candidate-resume.html">Resume</a></li>
                                    <li><a class="dropdown-item" href="candidate-shortlist.html">Shortlist Job</a></li>
                                    <li><a class="dropdown-item" href="candidate-message.html">Message</a></li> --}}
                                        <li><a class="dropdown-item" href="{{ route('User.ChangePassword') }}">Change
                                                Password</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" id="logoutButton">Log
                                                Out</a></li>
                                        {{-- <li><a class="dropdown-item" href="candidate-deleteprofile.html">Delete Account</a></li> --}}
                                    </ul>
                                </div>
                                <button class="d-md-block d-lg-none" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvas" aria-controls="offcanvas"><i
                                        class="fa-sharp fa-regular fa-bars"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header area end -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    {{-- To logout --}}
    <script type="text/javascript">
        $('#logoutButton').on('click', function() {
            var url = "{{ route('User.logout') }}";

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

    {{-- <script>
        $(document).on('click', '.delete-notification', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let url = $(this).data('url');
            let token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: url,
                type: 'DELETE',
                data: { _token: token },
                success: function(response) {
                    if (response.success) {
                        $('#notification-' + id).fadeOut();
                        updateNotificationCount();
                    }
                }
            });
        });
    </script> --}}

<script>
    $(document).on('click', '.delete-notification', function(e) {
    e.preventDefault();
    let button = $(this);
    let id = button.data('id');
    let url = button.data('url');
    let token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: url,
        type: 'DELETE',
        data: {
            _token: token
        },
        success: function(response) {
            if (response.success) {
                // Fade out and remove the deleted notification
                $('#notification-' + id).fadeOut(300, function() {
                    $(this).remove();
                    updateNotificationCount();

                    // Optional: Show "No new notifications" if none left
                    if ($('.single__notification:visible').length === 0) {
                        $('.notification__body').html('<p class="text-muted px-2">No new notifications</p>');
                    }
                });
            }
        }
    });
});

function updateNotificationCount() {
    let count = $('.single__notification:visible').length;
    $('.notification__count').text(count > 0 ? count : '');
}

</script>


