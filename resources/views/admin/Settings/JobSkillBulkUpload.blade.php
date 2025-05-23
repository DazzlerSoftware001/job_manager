@extends('admin.adminlayout.main')
@section('title')
    Admin-Job Skill
@endsection
@section('page-title')
Job Skill
@endsection

@section('main-container')

    
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Import Job Skill</h4>
                            </div>

                            <div class="px-3 mt-3 d-flex align-items-center gap-2">
                                
                            </div>

                            <div class="card-body">
                                
                                <div class="row">
                                    <div class="col-12">

                                        <form action="javascript:void(0)" id="JobSkillImport" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <label for="JobSkill" class="form-label">Upload Job_Skill File <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="JobSkill" id="JobSkill" required accept=".xlsx,.xls,.csv">
                                            <small class="text-danger d-block">Upload only .xlsx, .xls, or .csv files</small>
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
                                                <th>skill</th>
                                                <th>status</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>HTML</td>
                                                <td>1</td>
                                            </tr>

                                            <tr>
                                                <td>CSS</td>
                                                <td>0</td>
                                            </tr>
                                            
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
                                                <th>column</th>
                                                <th>rules</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>name</th>
                                                <td>The skill is mandatory and should not exceed 100 characters.
                                            </tr>

                                            <tr>
                                                <td>status</th>
                                                <td>The status is mandatory it must be 0 or 1.
                                            </tr>
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


        <script>
    $(document).ready(function () {
        $('#JobSkillImport').on('submit', function (event) {
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
                    var url = "{{ route('Admin.JobSkillSubmit') }}";
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
                                $('#JobSkillImport').trigger("reset");

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
