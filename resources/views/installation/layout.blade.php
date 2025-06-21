<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') | CareerNext Installer</title>
@php use App\Models\GeneralSetting; @endphp

  @php
    $footerLogo = GeneralSetting::value('favicon');
@endphp

  <link rel="shortcut icon" href="{{ asset($footerLogo) }}" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <style>
    body {
      font-family: 'DM Sans', sans-serif;
      background: linear-gradient(135deg, #f8f9fc, #eaf1ff);
      color: #343a40;
    }

    .installer-header {
      text-align: center;
      padding: 30px 20px;
    }

    .installer-header img {
      max-width: 160px;
      margin-bottom: 20px;
    }

    .installer-header h1 {
      font-size: 2rem;
      font-weight: 700;
    }

    .installer-header p {
      color: #6c757d;
      margin-top: 5px;
    }

    .installer-steps {
      display: flex;
      justify-content: center;
      gap: 20px;
      /* margin: 30px 0; */
      margin-bottom: 30px;
      flex-wrap: wrap;
    }

    .step-badge {
      padding: 12px 25px;
      border-radius: 30px;
      font-weight: 500;
      background-color: #dee2e6;
      color: #495057;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .step-badge.active {
      background: #0d6efd;
      color: #fff;
      box-shadow: 0 0 12px rgba(13, 110, 253, 0.4);
    }

    .step-badge.finished {
      background: #198754;
      color: #fff;
    }

    .card-wrap {
      background-color: #fff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      margin-top: 20px;
    }

    @media (max-width: 576px) {
      .installer-header h1 {
        font-size: 1.5rem;
      }

      .step-badge {
        font-size: 14px;
        padding: 8px 16px;
      }
    }
  </style>
</head>
<body>

  <!-- Header Section -->
  <div class="installer-header">
    <img src="{{ asset('user/assets/img/logo/header__one.png') }}" alt="CareerNext Logo">
    <h1>CareerNext - Installer</h1>
    <p>{{ now()->format('l, j F Y') }}</p>
  </div>

  <!-- Step Indicator -->
  <div class="installer-steps">
    <div class="step-badge {{ Route::is('installer.pre-install') ? 'active' : (Route::is('installer.configuration') || Route::is('installer.finish') ? 'finished' : '') }}">
      <i class="bi bi-gear-fill"></i> Pre-Installation
    </div>
    <div class="step-badge {{ Route::is('installer.configuration') ? 'active' : (Route::is('installer.finish') ? 'finished' : '') }}">
      <i class="bi bi-sliders2"></i> Configuration
    </div>
    <div class="step-badge {{ Route::is('installer.finish') ? 'active finished' : '' }}">
      <i class="bi bi-check2-circle"></i> Finish
    </div>
  </div>

  <!-- Main Content Area -->
  <div class="container mb-5">
    <div class="card-wrap">
      @yield('content')
    </div>
  </div>

  @stack('script')

  <!-- Bootstrap Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
