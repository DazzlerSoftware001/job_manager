@extends('installation.layout')

@section('title', 'Configuration')

@section('content')
    <div class="container my-5">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <form action="{{ route('installer.configuration.store') }}" method="POST">
            @csrf

            {{-- Application Settings --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Application Settings</h5>
                </div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label for="AppName" class="form-label">App Name</label>
                        <input type="text" name="app_name" id="AppName" class="form-control"
                            value="{{ env('APP_NAME') }}" placeholder="App Name">
                    </div>
                    <div class="col-md-6">
                        <label for="AppURL" class="form-label">App URL</label>
                        <input type="text" name="app_url" id="AppURL" class="form-control"
                            value="{{ env('APP_URL') }}" placeholder="http://localhost">
                    </div>
                </div>
            </div>

            {{-- Purchase Info --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Purchase Verification</h5>
                </div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Customer Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                            placeholder="example@example.com">
                    </div>
                    <div class="col-md-6">
                        <label for="purchase_code" class="form-label">Purchase Code</label>
                        <input type="text" name="purchase_code" id="purchase_code" class="form-control"
                            value="{{ old('purchase_code') }}" placeholder="xxxx-xxxx-xxxx-xxxx">
                    </div>
                </div>
            </div>

            {{-- Database Config --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Database Configuration</h5>
                </div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label for="DatabaseHost" class="form-label">Database Host</label>
                        <input type="text" name="db_host" id="DatabaseHost" class="form-control"
                            value="{{ env('DB_HOST') }}" placeholder="localhost">
                    </div>
                    <div class="col-md-6">
                        <label for="DatabaseUser" class="form-label">Database User</label>
                        <input type="text" name="db_user" id="DatabaseUser" class="form-control"
                            value="{{ env('DB_USERNAME') }}" placeholder="root">
                    </div>
                    <div class="col-md-6">
                        <label for="DatabaseName" class="form-label">Database Name</label>
                        <input type="text" name="db_name" id="DatabaseName" class="form-control"
                            value="{{ env('DB_DATABASE') }}" placeholder="your_database">
                    </div>
                    <div class="col-md-6">
                        <label for="Password" class="form-label">Database Password</label>
                        <input type="password" name="db_password" id="Password" class="form-control"
                            value="{{ env('DB_PASSWORD') }}" placeholder="password">
                    </div>
                </div>
            </div>

            {{-- SMTP Config --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">SMTP Configuration</h5>
                </div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label for="MailHost" class="form-label">Mail Host</label>
                        <input type="text" name="mail_host" id="MailHost" class="form-control"
                            value="{{ old('mail_host', $mailSetting->mail_host ?? '') }}" placeholder="smtp.example.com">
                    </div>
                    <div class="col-md-6">
                        <label for="MailPort" class="form-label">Mail Port</label>
                        <input type="text" name="mail_port" id="MailPort" class="form-control"
                            value="{{ old('mail_port', $mailSetting->mail_port ?? '') }}" placeholder="587">
                    </div>
                    <div class="col-md-6">
                        <label for="MailUsername" class="form-label">Username</label>
                        <input type="text" name="mail_username" id="MailUsername" class="form-control"
                            value="{{ old('mail_username', $mailSetting->mail_username ?? '') }}"
                            placeholder="your@email.com">
                    </div>
                    <div class="col-md-6">
                        <label for="MailPassword" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="text" name="mail_password" id="MailPassword" class="form-control"
                                value="{{ old('mail_password', $mailSetting->mail_password ?? '') }}"
                                placeholder="mail password">
                        </div>
                    </div>

                </div>
            </div>

            {{-- Buttons --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('installer.pre-install') }}" class="btn btn-outline-secondary">Back</a>
                <button type="submit" class="btn btn-success">Next Step</button>
            </div>
        </form>
    </div>
@endsection


<script>
    function togglePassword() {
        const passwordField = document.getElementById('MailPassword');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
    }
</script>
