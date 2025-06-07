@extends('User.UserLayout.main')

@section('title')
    Contact Us
@endsection

@section('main-container')
    <!-- Hero Section -->
    <section class="text-white pt-260 pb-5 text-center" style="background:#2775e4;">
        <div class="container">
            <h1 class="display-5 fw-bold text-light">Get in Touch</h1>
            <p class="lead mt-2">Have a question, feedback, or just want to say hello? We're here to help!</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5">
        <div class="container">
            <div class="row gy-4 align-items-stretch">
                <!-- Google Map -->
                <div class="col-lg-6">
                    <div class="h-100 w-100 overflow-hidden rounded shadow-sm">
                        <iframe class="w-100 h-100" style="min-height: 300px;" 
                            src="https://maps.google.com/maps?q=Delhi&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                            frameborder="0" allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>

                <!-- Contact Info + Form -->
                <div class="col-lg-6">
                    <div class="mb-4">
                        <h3 class="text-primary">Contact Information</h3>
                        <p class="mb-2"><i class="bi bi-geo-alt-fill text-primary me-2"></i>123 CareerNext Street, New Delhi, India</p>
                        <p class="mb-2"><i class="bi bi-telephone-fill text-primary me-2"></i>+91 98765 43210</p>
                        <p class="mb-4"><i class="bi bi-envelope-fill text-primary me-2"></i>support@careernext.com</p>
                    </div>

                    <h3 class="text-primary mb-3">Send Us a Message</h3>
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject (optional)">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea name="message" id="message" rows="5" class="form-control" placeholder="Write your message here..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary px-4">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
