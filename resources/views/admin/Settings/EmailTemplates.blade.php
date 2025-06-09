@extends('admin.adminlayout.main')
@section('title')
    Admin-Email Setting
@endsection
@section('page-title')
    Email Setting
@endsection

@section('main-container')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Email Setting </h4>
                            </div>

                            {{-- <div class="px-3 mt-3 d-flex align-items-center gap-2">
                                
                            </div> --}}

                            <div class="card-body">
                                <form action="javascript:void(0)" method="POST" id="mailSettingData">
                                    @csrf

                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label for="mail_mailer" class="form-label">MAIL_MAILER</label>
                                            <input type="text" class="form-control" name="mail_mailer"
                                                value="{{ old('mail_mailer', $mailSetting->mail_mailer ?? 'smtp') }}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="mail_host" class="form-label">MAIL_HOST</label>
                                            <input type="text" class="form-control" name="mail_host" id="mail_host"
                                                value="{{ old('mail_host', $mailSetting->mail_host ?? '') }}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="mail_port" class="form-label">MAIL_PORT</label>
                                            <input type="number" class="form-control" name="mail_port" id="mail_port"
                                                value="{{ old('mail_port', $mailSetting->mail_port ?? '') }}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="mail_username" class="form-label">MAIL_USERNAME</label>
                                            <input type="text" class="form-control" name="mail_username"
                                                id="mail_username"
                                                value="{{ old('mail_username', $mailSetting->mail_username ?? '') }}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="mail_password" class="form-label">MAIL_PASSWORD</label>
                                            <input type="text" class="form-control" name="mail_password"
                                                id="mail_password"
                                                value="{{ old('mail_password', $mailSetting->mail_password ?? '') }}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="mail_encryption" class="form-label">MAIL_ENCRYPTION</label>
                                            <input type="text" class="form-control" name="mail_encryption"
                                                id="mail_encryption"
                                                value="{{ old('mail_encryption', $mailSetting->mail_encryption ?? '') }}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="mail_from_address" class="form-label">MAIL_FROM_ADDRESS</label>
                                            <input type="text" class="form-control" name="mail_from_address"
                                                id="mail_from_address"
                                                value="{{ old('mail_from_address', $mailSetting->mail_from_address ?? '') }}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="mail_from_name" class="form-label">MAIL_FROM_NAME</label>
                                            <input type="text" class="form-control" name="mail_from_name"
                                                id="mail_from_name"
                                                value="{{ old('mail_from_name', $mailSetting->mail_from_name ?? '') }}">
                                        </div>


                                    </div>

                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary">Save Settings</button>
                                    </div>
                            </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>



        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('script')
    <script>
        $(document).ready(function() {
            $('#mailSettingData').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                var url = "{{ route('Admin.UpdateEmailSetting') }}";
                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    success: function(result) {
                        if (result.status_code === 1) {
                            $('#mailSettingData').trigger("reset");
                            Toastify({
                                text: result.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "green",
                                    color: "white",
                                }
                            }).showToast();

                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        } else if (result.status_code === 0) {
                            Toastify({
                                text: result.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "#c7ac14",
                                    color: "white",
                                }
                            }).showToast();
                        } else {
                            Toastify({
                                text: result.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "red",
                                    color: "white",
                                }
                            }).showToast();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        Toastify({
                            text: 'An error occurred. Please try again.',
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            style: {
                                background: "red",
                                color: "white",
                            }
                        }).showToast();
                    }
                });
            });
        });
    </script>
@endsection
