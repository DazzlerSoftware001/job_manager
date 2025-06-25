@php use App\Models\GeneralSetting; @endphp
@php use App\Models\FooterSetting; @endphp
@php
    $footerLogo = GeneralSetting::value('logo');
    $footerSettings = FooterSetting::first();
@endphp

<footer class="rts__section  footer__home__one">
    <div class="container">
        <div class="row">
            <div
                class="footer__wrapper d-flex flex-wrap flex-column flex-sm-row gap-4 gap-md-0 gap-sm-3 justify-content-between pt-60 pb-60">
                <div class="rts__footer__widget max-320">
                    <a href="index.html" class="footer__logo" aria-label="logo">
                        <img src="{{ asset($footerLogo) }}"
                            onerror="this.onerror=null; this.src='{{ url('settings/logo/default.png') }}';"
                            width="160" height="40" alt="logo">
                    </a>
                    @if ($footerSettings !== null && $footerSettings->description !== null)
                        <p class="mt-4">{{ $footerSettings->description }}</p>
                    @else
                        <p class="mt-4">Whether you're an experienced professional or a fresh graduate eager to dive
                            into
                            the workforce, we have something for everyone.
                        </p>
                    @endif
                </div>

                <!-- footer menu -->
                {{-- <div class="rts__footer__widget max-content">
                    <div class="font-20 fw-medium mb-3 h6">Links</div>
                    <ul class="list-unstyled">
                        <li><a href="job-list-1.html" aria-label="footer__menu__link">Browse Jobs</a></li>
                        <li><a href="candidate-1.html" aria-label="footer__menu__link">Browse Candidates</a></li>
                        <li><a href="blog-1.html" aria-label="footer__menu__link">Blog & News</a></li>
                        <li><a href="faq.html" aria-label="footer__menu__link">FAQ Question</a></li>
                        <li><a href="#" aria-label="footer__menu__link">Job Alerts</a></li>
                    </ul>
                </div> --}}

                <div class="rts__footer__widget max-content">
                    <div class="font-20 fw-medium mb-3 h6 ">
                        Contact Us
                    </div>
                    <ul class="list-unstyled mb-3">
                        <li><a href="#"><i class="fa-light fa-location-dot"></i>
                                @if ($footerSettings !== null && $footerSettings->address != null)
                                    {{ $footerSettings->address }}
                                @else
                                    2715 Ash Dr. San Jose,USA
                                @endif
                            </a></li>

                        <li><a href="callto:+880171234578"><i class="fa-light fa-phone"></i>+
                                @if ($footerSettings !== null && $footerSettings->phone != null)
                                    {{ $footerSettings->phone }}
                                @else
                                    (61)
                                    545-432-234
                                @endif
                            </a>
                        </li>
                        <li><a href="mailto:careernext@gmail.com"><i class="fa-light fa-envelope"></i>
                                @if ($footerSettings !== null && $footerSettings->email != null)
                                    {{ $footerSettings->email }}
                                @else
                                    careernext@gmail.com
                                @endif
                            </a></li>
                    </ul>
                    <div class="font-20 fw-medium text-dark">
                        Social Link
                    </div>
                    @php
                        $socialLinks = [];

                        if (!empty($footerSettings->social_links)) {
                            if (is_string($footerSettings->social_links)) {
                                $socialLinks = json_decode($footerSettings->social_links, true) ?? [];
                            } elseif (is_array($footerSettings->social_links)) {
                                $socialLinks = $footerSettings->social_links;
                            }
                        }
                    @endphp

                    @if (!empty($socialLinks))
                        <div class="rts__social d-flex gap-4">
                            @foreach ($socialLinks as $social)
                                <a target="_blank" href="{{ $social['link'] ?? '#' }}"
                                    aria-label="{{ strtolower($social['name'] ?? 'social') }}">
                                    <i class="{{ $social['icon'] ?? 'fas fa-globe' }}"></i>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="rts__social d-flex gap-4">
                            <a target="_blank" href="https://facebook.com/" aria-label="facebook">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                            <a target="_blank" href="https://instagram.com/" aria-label="instagram">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a target="_blank" href="https://linkedin.com/" aria-label="linkedin">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                            <a target="_blank" href="https://pinterest.com/" aria-label="pinterest">
                                <i class="fa-brands fa-pinterest"></i>
                            </a>
                            <a target="_blank" href="https://youtube.com/" aria-label="youtube">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        </div>
                    @endif
                </div>

                {{-- <!-- newsletter form -->
                <div class="rts__footer__widget max-320">
                    <div class="font-20 fw-medium mb-3 h6 ">Subscribe Our Newsletter</div>
                    <p class="br-sm-none">Subscribe Our Newsletter get <br> Update our New Course</p>
                    <form action="#" class="d-flex align-items-center justify-content-between mt-4 newsletter">
                        <input type="email" name="semail" id="semail" placeholder="Enter your email" required>
                        <button type="submit" class="rts__btn fill__btn">Subscribe</button>
                    </form>
                </div>
                <!-- newsletter form end --> --}}

            </div>
        </div>
    </div>
    <div class="rts__copyright">
        <div class="container">
            <p class="text-center fw-medium py-4">
                @if ($footerSettings !== null && $footerSettings->copyright != null)
                    {{ $footerSettings->copyright }}
                @else
                    {{-- Copyright &copy; 2024 All Rights Reserved by careernext --}}
                    2025 © CareerNest Design & Develop by Dazzler Software
                @endif

            </p>
        </div>
    </div>
</footer>




<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header p-0 mb-5 mt-4">
        <a href="index.html" class="offcanvas-title" id="offcanvasLabel">
            <img src="{{ asset($footerLogo) }}" width="160" height="40" alt="logo">
        </a>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <!-- login offcanvas -->
    <div class="mb-4 d-block d-sm-none">
        <div class="header__right__btn d-flex justify-content-center gap-3">
            <a href="#" class="small__btn no__fill__btn border-6 font-xs" aria-label="Login Button"
                data-bs-toggle="modal" data-bs-target="#loginModal"> <i class="rt-login"></i>Sign In</a>
            <a href="#" class="small__btn d-xl-flex fill__btn border-6 font-xs"
                aria-label="Job Posting Button">Add Job</a>
        </div>
    </div>

    <div class="offcanvas-body p-0">
        <div class="rts__offcanvas__menu overflow-hidden">
            <div class="offcanvas__menu"></div>
        </div>

        <p class="max-auto font-20 fw-medium text-center text-decoration-underline mt-4">Our Social Links</p>
        <div class="rts__social d-flex justify-content-center gap-3 mt-3">
            <a target="_blank" href="https://facebook.com/" aria-label="facebook">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a target="_blank" href="https://instagram.com/" aria-label="instagram">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a target="_blank" href="https://linkedin.com/" aria-label="linkedin">
                <i class="fa-brands fa-linkedin"></i>
            </a>
            <a target="_blank" href="https://pinterest.com/" aria-label="pinterest">
                <i class="fa-brands fa-pinterest"></i>
            </a>
            <a target="_blank" href="https://youtube.com/" aria-label="youtube">
                <i class="fa-brands fa-youtube"></i>
            </a>
        </div>
    </div>
</div>
<!-- THEME PRELOADER START -->
<div class="loader-wrapper">
    <div class="loader">
    </div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!-- THEME PRELOADER END -->
<button type="button" class="rts__back__top" id="rts-back-to-top">
    <i class="fas fa-arrow-up"></i>
</button>
<!-- all plugin js -->
<script src="{{ url('user/assets/js/plugins.min.js') }}"></script>
<script src="{{ url('user/assets/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

@yield('script')
</body>

<!--  index.html   11:17:54 GMT -->

</html>
