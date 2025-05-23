@extends('admin.adminlayout.main')
@section('title')
    Admin-Annual Salary
@endsection
@section('page-title')
Annual Salary
@endsection

@section('main-container')

    
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Import Annual Salary</h4>
                            </div>

                            <div class="px-3 mt-3 d-flex align-items-center gap-2">
                                
                            </div>

                            <div class="card-body">
                                
                                <div class="row">
                                    <div class="col-12">
{{-- {{route('Admin.AnnualSalarySubmit')}} --}}


                                        <form action="javascript:void(0)" id="AnnualSalaryImport" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <label for="annualSalary" class="form-label">Upload Annual Salary File <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="annualSalary" id="annualSalary" required>
                                            <button type="submit" class="btn btn-primary">Import</button>
                                        </form>


                                      
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Example</h4>
                            </div>

                            <div class="px-3 mt-3 d-flex align-items-center gap-2">
                                
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>salary</th>
                                                <th>status</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <td>1000</td>
                                            <td>0</td>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-6">


                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Rules</h4>
                            </div>

                            <div class="px-3 mt-3 d-flex align-items-center gap-2">
                                
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>salary</th>
                                                <th>status</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <td>1000</td>
                                            <td>0</td>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
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


       {{-- <script>
            $(document).ready(function() {
                $('#AnnualSalaryImport').on('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    var url = "{{ route('Admin.AnnualSalarySubmit') }}"; // Submission URL
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
                                $('#AnnualSalaryImport').trigger("reset");
                                // $('#myTable').DataTable().ajax.reload(null, false);  

                                Toastify({
                                    text: result.message,
                                    duration: 3000,
                                    gravity: "top",
                                    position: "right",
                                    style: {
                                        background: "green",
                                        color: "white"
                                    }
                                }).showToast();

                            } else if (result.status_code === 2) {
                                Toastify({
                                    text: result.message,
                                    duration: 3000,
                                    gravity: "top",
                                    position: "right",
                                    style: {
                                        background: "#c7ac14",
                                        color: "white"
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
                                        color: "white"
                                    }
                                }).showToast();
                            }
                        },
                        error: function(xhr, status, error) {
                            // console.error('AJAX Error:', error);
                            Toastify({
                                text: 'An error occurred. Please try again.',
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "red",
                                    color: "white"
                                }
                            }).showToast();
                        }
                    });
                });
            });
        </script> --}}

        <script>
    $(document).ready(function () {
        $('#AnnualSalaryImport').on('submit', function (event) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to upload this file?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, upload it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "{{ route('Admin.AnnualSalarySubmit') }}";
                    var form = this;

                    Swal.fire({
                        title: 'Uploading...',
                        html: 'Please wait, don’t cancel or close the browser.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: url,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: new FormData(form),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function (result) {
                            Swal.close(); // Hide loading

                            if (result.status_code === 1) {
                                $('#AnnualSalaryImport').trigger("reset");

                                Toastify({
                                    text: result.message,
                                    duration: 3000,
                                    gravity: "top",
                                    position: "right",
                                    style: {
                                        background: "green",
                                        color: "white"
                                    }
                                }).showToast();

                            } else if (result.status_code === 2) {
                                Toastify({
                                    text: result.message,
                                    duration: 3000,
                                    gravity: "top",
                                    position: "right",
                                    style: {
                                        background: "#c7ac14",
                                        color: "white"
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
                                        color: "white"
                                    }
                                }).showToast();
                            }
                        },
                        error: function () {
                            Swal.close(); // Hide loading

                            Toastify({
                                text: 'An error occurred. Please try again.',
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "red",
                                    color: "white"
                                }
                            }).showToast();
                        }
                    });
                }
            });
        });
    });
</script>

        
    @endsection
