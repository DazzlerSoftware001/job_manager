    <!-- header area -->
    <style>
        .navigation__menu--item.has-child>ul,
        .submenu .has-child>ul {
            display: none;
            position: absolute;
            /* or as per your layout */
            /* add any necessary styling for submenu */
        }

        .navigation__menu--item.has-child:hover>ul,
        .submenu .has-child:hover>ul {
            display: block;
        }
    </style>
    <header class="rts__section rts__header absolute__header">
        <div class="container-none">
            <div class="rts__menu__background">
                <div class="row">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="rts__logo">
                            <a href="{{ route('User.Home') }}">
                                <img class="logo__image" src="{{ url('user/assets/img/logo/header__one.png') }}"
                                    width="160" height="40" alt="logo">
                            </a>
                        </div>
                        <div class="rts__menu d-flex gap-5 gap-lg-4 gap-xl-5 align-items-center">
                            <div class="navigation d-none d-lg-block">
                                <nav class="navigation__menu" id="offcanvas__menu">

                                    @php
                                        $menuItems = DB::table('menu_items')
                                            ->orderBy('order')
                                            ->get()
                                            ->groupBy('parent_id');
                                    @endphp

                                    @if ($menuItems->isEmpty())
                                        <ul class="list-unstyled">
                                            <li class="navigation__menu">
                                                <a href="{{ route('User.Home') }}"
                                                    class="navigation__menu--item__link">Home</a>
                                                {{-- <ul class="submenu sub__style" role="menu">
                                                    <li role="menuitem"><a href="index.html">Home One</a></li>
                                                    <li role="menuitem"><a href="index-2.html">Home Two</a></li>
                                                    <li role="menuitem"><a href="index-3.html">Home Three</a></li>
                                                    <li role="menuitem"><a href="index-4.html">Home Four</a></li>
                                                    <li role="menuitem"><a href="index-5.html">Home Five</a></li>
                                                    <li role="menuitem"><a href="index-6.html">Home Six</a></li>
                                                </ul> --}}
                                            </li>

                                            <li class="navigation__menu--item has-child">
                                                <a href="{{ route('User.JobList') }}"
                                                    class="navigation__menu--item__link">
                                                    Jobs</a>
                                                {{-- <ul class="submenu sub__style" role="menu">
                                            <li role="menuitem" class="has-child has-arrow">
                                                <a href="#">Job List</a>
                                                <ul class="sub__style" role="menu">
                                                    <li role="menuitem"><a href="job-list-1.html">Job List One</a></li>
                                                    <li role="menuitem"><a href="job-list-2.html">Job List Two</a></li>
                                                    <li role="menuitem"><a href="job-list-3.html">Job List Three</a></li>
                                                    <li role="menuitem"><a href="job-list-4.html">Job List Four</a></li>
                                                    <li role="menuitem"><a href="job-list-5.html">Job List Five</a></li>
                                                </ul>
                                            </li>
                                            <li role="menuitem" class="has-child has-arrow">
                                                <a href="#">Job Details</a>
                                                <ul class="sub__style" role="menu">
                                                    <li role="menuitem"><a href="job-details-1.html">Job Details One</a></li>
                                                    <li role="menuitem"><a href="job-details-2.html">Job Details Two</a></li>
                                                    <li role="menuitem"><a href="job-details-3.html">Job Details Three</a></li>
                                                    <li role="menuitem"><a href="job-details-4.html">Job Details Four</a></li>
                                                </ul>
                                            </li>
                                        </ul> --}}
                                            </li>

                                            {{-- <li class="navigation__menu--item has-child has-arrow">
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
                                        </li> --}}

                                            <li class="navigation__menu--item has-child">
                                                <a href="{{ route('User.Dashboard') }}"
                                                    class="navigation__menu--item__link">Candidates</a>
                                                {{-- <ul class="submenu sub__style" role="menu">
                                                    <li role="menuitem" class="has-child has-arrow">
                                                        <a href="candidate-1.html">Candidate Style</a>
                                                        <ul class="sub__style" role="menu">
                                                            <li role="menuitem"><a href="candidate-1.html">Candidate One</a></li>
                                                            <li role="menuitem"><a href="candidate-2.html">Candidate Two</a></li>
                                                            <li role="menuitem"><a href="candidate-3.html">Candidate Three</a></li>
                                                            <li role="menuitem"><a href="candidate-4.html">Candidate Four</a></li>
                                                        </ul>
                                                    </li>
                                                    <li role="menuitem" class="has-child has-arrow">
                                                        <a href="candidate-details-1.html">Candidate Details</a>
                                                        <ul class="sub__style" role="menu">
                                                            <li role="menuitem"><a href="candidate-details-1.html">Candidate Details 1</a></li>
                                                            <li role="menuitem"><a href="candidate-details-2.html">Candidate Details 2</a></li>
                                                            
                                                        </ul>
                                                    </li>
                                                    <li role="menuitem"><a href="candidate-dashboard.html">Candidate Dashboard</a></li>
                                                </ul> --}}
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
                                                    <li role="menuitem"><a href="contact-1.html">Co</a></li>
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
                                                            $ulClass = $isTopLevel
                                                                ? 'submenu sub__style'
                                                                : 'sub__style';
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
                            @php
                                $user = Auth::user();
                            @endphp
                            @if (empty($user) || $user->user_type != '0')
                                <div class="header__right__btn d-flex gap-3">
                                    <a href="{{ route('User.login') }}"
                                        class="small__btn d-none d-sm-flex no__fill__btn border-6 font-xs"
                                        aria-label="Login Button"> <i class="rt-login"></i>Sign In</a>
                                    <button class="d-md-block d-lg-none" type="button" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvas" aria-controls="offcanvas"><i
                                            class="fa-sharp fa-regular fa-bars"></i></button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header area end -->
