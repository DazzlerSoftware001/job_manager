@extends('User.UserLayout.main')

@section('title')
    About Us
@endsection

@section('main-container')

<!-- Hero Section -->
<section class="text-white pt-260 pb-5" style="background:#F1F1F1;">
  <div class="container text-center">
    <h1 class="display-4 fw-bold">Empowering Careers, Enabling Futures</h1>
    <p class="lead mt-3 text-dark">
      At CareerNext, we connect talent with opportunity. Whether you're a job seeker or a recruiter, we're here to make career growth seamless.
    </p>
  </div>
</section>

<!-- Mission & Offer -->
<section class="py-5">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-md-6">
        <h2 class="fw-bold text-primary mb-4">Our Mission</h2>
        <p class="text-muted fs-5">
          Our mission is to bridge the gap between skilled candidates and top organizations. We strive to simplify recruitment and help individuals build fulfilling careers through a transparent, efficient, and empowering platform.
        </p>
      </div>
      <div class="col-md-6">
        <h2 class="fw-bold text-primary mb-4">What We Offer</h2>
        <ul class="list-group list-group-flush fs-5">
          <li class="list-group-item">✔ Smart job-matching technology</li>
          <li class="list-group-item">✔ Verified candidate and employer profiles</li>
          <li class="list-group-item">✔ Resume building tools</li>
          <li class="list-group-item">✔ Real-time hiring updates</li>
          <li class="list-group-item">✔ Personalized career recommendations</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- Team Section -->
<section class="bg-light py-5">
  <div class="container text-center">
    <h2 class="fw-bold text-primary mb-5">Meet Our Team</h2>
    <div class="row g-4 justify-content-center">
      @php
        $team = [
          ['name' => 'Ankit Sharma', 'role' => 'Founder & CEO', 'img' => 'https://via.placeholder.com/150'],
          ['name' => 'Riya Verma', 'role' => 'CTO', 'img' => 'https://via.placeholder.com/150'],
          ['name' => 'Aman Gupta', 'role' => 'Marketing Head', 'img' => 'https://via.placeholder.com/150'],
        ];
      @endphp

      @foreach ($team as $member)
        <div class="col-sm-6 col-md-4">
          <div class="card border-0 shadow h-100">
            <img src="{{ $member['img'] }}" class="card-img-top rounded-circle mx-auto mt-4" style="width: 100px; height: 100px;" alt="{{ $member['name'] }}">
            <div class="card-body text-center">
              <h5 class="card-title mb-1">{{ $member['name'] }}</h5>
              <p class="text-muted mb-0">{{ $member['role'] }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Call to Action -->
<section class="text-white text-center py-5" style="background:#1967D2;">
  <div class="container">
    <h3 class="fw-bold mb-3">Ready to take the next step in your career?</h3>
    <a href="/register" class="btn btn-light btn-lg fw-semibold px-4 py-2 rts__btn common__btn  fill__btn mt-50">Join CareerNext Today</a>
  </div>
</section>

@endsection
