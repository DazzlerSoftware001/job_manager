@extends('installation.layout')

@section('title', 'Installation Finished')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 40vh;">
    <div class="text-center p-4 shadow rounded bg-white" style="max-width: 500px; width: 100%;">
        <h2 class="mb-3 text-success">🎉 Installation Completed Successfully!</h2>
        <p class="mb-4">Your application is now ready to use. You can proceed to the home page and start exploring.</p>
        <a href="{{ route('User.Home') }}" class="btn btn-primary px-4">Go to Home</a>
    </div>
</div>
@endsection
