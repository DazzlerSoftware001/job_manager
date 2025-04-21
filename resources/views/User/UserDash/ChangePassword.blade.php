@extends('User.UserDashLayout.main')
@section('title')
Change Password
@endsection
@section('main-container')
<div class="candidate__passwordchange">
    <h6 class="mb-3">Change Password</h6>
    <div class="change__password">
        <div class="password__change__form">
            <h6 class="text-center mb-4">Change Password</h6>
            <form action="javascript:void(0)" method="POST" id="ChangePassword">
                
                <!-- single item -->
                <div class="rt-input-group position-relative">
                    <label for="password">Password</label>
                    <div class="input-box position-relative">
                        <input type="password" class="form-control" name="password" id="password" placeholder="New password">
                        <span class="position-absolute" style="top: 73%; right: 15px; transform: translateY(-50%); cursor: pointer;" onclick="togglePassword('password', 'toggleIcon1')">
                            <i class="far fa-eye" id="toggleIcon1"></i>
                        </span>
                    </div>
                </div>
                

                <!-- single item end -->

                <!-- single item -->
                <div class="rt-input-group position-relative">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="input-box position-relative">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                        <span class="position-absolute" style="top: 73%; right: 15px; transform: translateY(-50%); cursor: pointer;" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                            <i class="far fa-eye" id="toggleIcon2"></i>
                        </span>
                    </div>
                </div>
                

                <!-- single item end -->
                 <div class="d-flex justify-content-center mt-3">
                     <button type="submit" class="btn btn-primary">Update Password</button>
                 </div>
            </form>
        </div>
    </div>
</div>

    <!-- address area end -->
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            const isPassword = input.type === 'password';
        
            input.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }
    </script>

    <script type="text/javascript">
        $('#ChangePassword').on('submit', function(e) {
            e.preventDefault(); // prevent form from reloading

            var url = "{{ route('User.UpdatePassword') }}";

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
                    if (result.status_code == 1) {
                        Toastify({
                            text: result.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            className: "bg-success"
                        }).showToast();

                        setTimeout(function() {
                            if (result.redirect_url) {
                                window.location.href = result.redirect_url;
                            } else {
                                location.reload();
                            }
                        }, 750);

                    } else if (result.status_code == 2) {
                        Toastify({
                            text: result.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            className: "bg-warning"
                        }).showToast();
                    } else {
                        Toastify({
                            text: result.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            className: "bg-danger"
                        }).showToast();
                    }
                },
                error: function(xhr) {
                    Toastify({
                        text: "Something went wrong!",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        className: "bg-danger"
                    }).showToast();
                }
            });
        });
    </script>
        
   
@endsection
