@extends('User.UserLayout.main')

@section('title')
    Contact Us
@endsection

@section('main-container')
    <!-- Hero Section -->
    <section class="bg-primary text-white pt-260 pb-5 text-center">
        <div class="container">
            <h1 class="display-5 fw-bold">Get in Touch</h1>
            <p class="lead mt-2">Have a question, feedback, or just want to say hello? We're here to help!</p>
        </div>
    </section>

    <!-- Contact Info + Form -->
    <section class="py-5">
        <div class="container">
            <div class="row g-5">

                <!-- Contact Information -->
                <div class="col-md-6">
                    <iframe src="https://maps.google.com/maps?q=Delhi&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
                        allowfullscreen loading="lazy"></iframe>
                </div>

                <!-- Contact Form -->
                <div class="col-md-6">
                    <h3 class="text-primary mb-4">Contact Information</h3>
                    <p class="mb-3"><i class="bi bi-geo-alt-fill text-primary me-2"></i>123 CareerNext Street, New Delhi,
                        India</p>
                    <p class="mb-3"><i class="bi bi-telephone-fill text-primary me-2"></i>+91 98765 43210</p>
                    <p class="mb-3"><i class="bi bi-envelope-fill text-primary me-2"></i>support@careernext.com</p>
                    <h3 class="text-primary mb-4">Send Us a Message</h3>
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" name="name" class="form-control" required
                                placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" name="email" class="form-control" required
                                placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="Subject (optional)">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea name="message" class="form-control" rows="5" required placeholder="Write your message here..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 py-2">Send Message</button>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection
