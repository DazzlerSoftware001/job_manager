@extends('admin.adminlayout.main')
@section('title')
    Admin-General Setting
@endsection
@section('page-title')
    General Setting
@endsection

<style>
    /* From Uiverse.io by alexruix */
    /* The switch - the box around the slider */
    .switch {
        font-size: 17px;
        position: relative;
        display: inline-block;
        width: 3.5em;
        height: 2em;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #B0B0B0;
        border: 1px solid #B0B0B0;
        transition: .4s;
        border-radius: 32px;
        outline: none;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 2rem;
        width: 2rem;
        border-radius: 50%;
        outline: 2px solid #B0B0B0;
        left: -1px;
        bottom: -1px;
        background-color: #fff;
        transition: transform .25s ease-in-out 0s;
    }

    .slider-icon {
        opacity: 0;
        height: 12px;
        width: 12px;
        stroke-width: 8;
        position: absolute;
        z-index: 999;
        stroke: #222222;
        right: 60%;
        top: 30%;
        transition: right ease-in-out .3s, opacity ease-in-out .15s;
    }

    input:checked+.slider {
        background-color: #222222;
    }

    input:checked+.slider .slider-icon {
        opacity: 1;
        right: 20%;
    }

    input:checked+.slider:before {
        transform: translateX(1.5em);
        outline-color: #181818;
    }
</style>

@section('main-container')
    <div class="main-content">
        <div class="page-content">
            <div class="col-md-3">
                <div class="card">
                    @php
                        $maintenance = \App\Models\MaintenanceMode::first();
                    @endphp
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Maintenance Mode</h4>
                        <form action="javascript:void(0)" id="ChangeMaintenanceStatus" class="mb-0">
                            <label class="switch d-flex align-items-center mb-0">
                                <input type="checkbox" id="toggleMaintenance"
                                    {{ $maintenance && $maintenance->maintenance ? 'checked' : '' }}>
                                <span class="slider d-flex align-items-center justify-content-center">
                                    <svg class="slider-icon" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true" role="presentation">
                                        <path fill="none" d="m4 16.5 8 8 16-16"></path>
                                    </svg>
                                </span>
                            </label>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#toggleMaintenance').on('change', function() {
            let status = $(this).is(':checked') ? 1 : 0;

            // Revert toggle temporarily until confirmation
            $(this).prop('checked', !status);

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to " + (status ? "enable" : "disable") + " maintenance mode?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('Admin.ChangeMaintenanceStatus') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            status: status
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });

                            // Update toggle status only on success
                            $('#toggleMaintenance').prop('checked', status);
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Something went wrong. Please try again.',
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
