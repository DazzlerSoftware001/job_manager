@extends('admin.adminlayout.main')
@section('title')
    Admin-Page Setting
@endsection
@section('page-title')
    Page Setting
@endsection

@section('main-container')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.css">


    <style>
        .choices {
            border: var(--bs-border-width) solid var(--bs-border-color);
            border-radius: var(--bs-border-radius);
            overflow: hidden;
            line-height: 0.8;
            height: 38px;
        }

        .choices__inner {
            background-color: var(--bs-secondary-bg);
            color: var(--bs-body-color);
        }

        .choices__list--single .choices__item {
            color: #000000;
        }

        .choices[data-type*=select-one] .choices__input {
            display: block;
            width: 100%;
            border: 1px solid #a29898 !important;
            background-color: #ffffff;
            border-radius: 10px;
        }

        .is-focused .choices__inner,
        .is-open .choices__inner {
            border: var(--bs-border-width) solid var(--bs-border-color);
            border-radius: var(--bs-border-radius);
        }

        .choices[data-type*="select-one"]::after {
            content: "";
            width: 12px;
            /* Adjust based on your icon size */
            height: 12px;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2322354e' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            position: absolute;
            right: 15px;
            top: 60%;
            /* Keep it centered */
            transform: translateY(-50%);
            /* Ensure it remains vertically aligned */
            pointer-events: none;
            border: none;
            /* Remove existing arrow */
            transition: transform 0.3s ease;
            /* Smooth transition */
        }

        /* When select box is open, rotate the arrow */
        .choices[data-type*="select-one"].is-open::after {
            transform: translateY(-90%) rotate(180deg);
        }



        .choices[data-type*="select-one"].is-open::after {
            border-color: transparent transparent #333;
            margin-top: 2px;

        }
    </style>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-4">
                        <div class="card p-3">
                            <h5>Pages</h5>
                            <form method="POST" id="AddMenu">
                                <div class="mb-3" style="max-height: 300px; overflow-y: auto;">
                                    @php
                                        $menuOptions = [
                                            ['title' => 'Home', 'url' => '/'],
                                            ['title' => 'Jobs', 'url' => 'JobList'],
                                            ['title' => 'Candidate', 'url' => 'User/Dashboard'],
                                            ['title' => 'Profile', 'url' => 'User/Profile'],
                                            ['title' => 'Resume', 'url' => 'User/Resume'],
                                            ['title' => 'Applied Job', 'url' => 'User/AppliedJob'],
                                            ['title' => 'Shortlisted', 'url' => 'User/ShortList'],
                                            ['title' => 'Saved Job', 'url' => 'User/GetSavedJob'],
                                        ];
                                    @endphp

                                    @foreach ($menuOptions as $index => $option)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                name="menu_items[{{ $index }}][selected]" value="1">
                                            <input type="hidden" name="menu_items[{{ $index }}][title]"
                                                value="{{ $option['title'] }}">
                                            <input type="hidden" name="menu_items[{{ $index }}][url]"
                                                value="{{ $option['url'] }}">
                                            <label class="form-check-label">
                                                {{ $option['title'] }}
                                            </label>
                                        </div>
                                    @endforeach

                                    {{-- Dynamic custom pages --}}
                                    @foreach ($customPages as $customIndex => $custom)
                                        @php $dynamicIndex = count($menuOptions) + $customIndex; @endphp
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                name="menu_items[{{ $dynamicIndex }}][selected]" value="1">
                                            <input type="hidden" name="menu_items[{{ $dynamicIndex }}][title]"
                                                value="{{ $custom->title }}">
                                            <input type="hidden" name="menu_items[{{ $dynamicIndex }}][url]"
                                                value="{{ $custom->slug }}">
                                            <label class="form-check-label">{{ $custom->title }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="submit" class="btn btn-primary mt-2">+ Add to menu</button>
                            </form>

                        </div>
                    </div>


                    <div class="col-lg-8">
                        <div class="card p-3">
                            <div class="dd" id="menu">
                                <ol class="dd-list">
                                    @php
                                        function renderMenu($items, $parentId = null)
                                        {
                                            $filtered = $items->where('parent_id', $parentId);

                                            foreach ($filtered as $item) {
                                                echo '<li class="dd-item menu-item-' .
                                                    $item->id .
                                                    '" data-id="' .
                                                    $item->id .
                                                    '">';
                                                echo '<div class="dd-handle">' . $item->title . '</div>';

                                                // Delete Form (AJAX)
                                                echo '<form class="delete-menu-form" style="position: absolute;top:0;right:0;">';
                                                echo csrf_field();
                                                echo method_field('DELETE');
                                                echo '<button type="button" class="btn btn-sm btn-danger" onclick="deleteMenuItem(' . $item->id . ')">Delete</button>';
                                                echo '</form>';

                                                // Recursive Children
                                                if ($items->where('parent_id', $item->id)->isNotEmpty()) {
                                                    echo '<ol class="dd-list">';
                                                    renderMenu($items, $item->id);
                                                    echo '</ol>';
                                                }

                                                echo '</li>';
                                            }
                                        }

                                        renderMenu($menuItems);
                                    @endphp
                                </ol>
                            </div>

                            <button id="saveBtn" class="btn btn-success mt-3">Save Menu</button>


                        </div>
                    </div>
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    @endsection

    @section('script')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.js"></script>

        {{-- Get Job list --}}
        {{-- <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    // DataTable options
                    "paging": true,
                    "lengthMenu": [10, 25, 50, 100],
                    "serverSide": true,
                    "processing": true,
                    "searching": false,
                    "lengthChange": true,
                    "fixedHeader": true,
                    "order": [
                        [0, "desc"]
                    ],
                    "ajax": {
                        url: "",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: function(data) {
                            data.search = $('#search').val();
                        }
                    },
                    "language": {
                        "emptyTable": "<div><lord-icon src='https://cdn.lordicon.com/msoeawqm.json' trigger='loop' style='width:75px;height:75px'></div> <div class='mt-2 noresult'><b>Sorry! No Result Found</b></div>"
                    }
                });

                $('#search').on('keyup', function(e) {
                    e.preventDefault();
                    $('#myTable').DataTable().draw();
                });
            });
        </script> --}}

        {{-- DeleteJobCategory --}}
        {{-- <script>
            function deleteRecord(id) {
                // First AJAX to show confirmation modal
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you really want to delete this record?',
                    icon: 'warning',
                    showCancelButton: true, // Show cancel button
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    background: '#28a745',
                }).then((response) => {
                    // If user clicks "Yes, delete it!"
                    if (response.isConfirmed) {
                        // Second AJAX for actual deletion
                        $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ route('Admin.DeleteJobPost') }}",
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(deleteResult) {
                                if (deleteResult.status_code == 1) {
                                    // Reload the DataTable after successful deletion
                                    $('#myTable').DataTable().ajax.reload(null, false);
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'Record deleted successfully!',
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        background: '#28a745'
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: deleteResult.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        background: '#dc3545'
                                    });
                                }
                            }
                        });
                    } else {
                        // If user clicks "Cancel", show the info message and no deletion happens
                        Swal.fire({
                            title: 'Cancelled',
                            text: 'Your record was not deleted.',
                            icon: 'info',
                            confirmButtonText: 'Okay',
                            background: '#17a2b8'
                        });
                    }
                });
            }
        </script> --}}

        {{-- For Sava Order --}}
        <script>
            $(document).ready(function() {
                $('#menu').nestable();

                $('#saveBtn').click(function() {
                    var order = $('#menu').nestable('serialize');

                    $.ajax({
                        url: '{{ route('Admin.menusave') }}',
                        type: 'POST',
                        data: {
                            order: order,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            Toastify({
                                text: "Menu order saved successfully!",
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "#28a745",
                                },
                            }).showToast();

                            setTimeout(function() {
                                location.reload();
                            }, 750);
                        },
                        error: function() {
                            Toastify({
                                text: "Error saving menu order!",
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                style: {
                                    background: "#dc3545",
                                },
                            }).showToast();
                        }
                    });
                });
            });
        </script>

        {{-- For Add Menu --}}
        <script>
            $(document).ready(function() {
                $('#AddMenu').on('submit', function(event) {
                    event.preventDefault(); // prevent default submit

                    var url = "{{ route('menu.add') }}";

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
                            console.log(result); // debug

                            if (result.status_code === 1) {
                                $('#AddMenu')[0].reset(); // reset form
                                Toastify({
                                    text: result.message,
                                    duration: 3000,
                                    gravity: "top",
                                    position: "right",
                                    style: {
                                        background: "#28a745",
                                    },
                                }).showToast();

                                setTimeout(function() {
                                    location.reload();
                                }, 750);
                            } else if (result.status_code === 2) {
                                Toastify({
                                    text: result.message,
                                    duration: 3000,
                                    gravity: "top",
                                    position: "right",
                                    style: {
                                        background: "#ffc107",
                                    },
                                }).showToast();
                                $('#AddMenu')[0].reset();
                            } else {
                                Toastify({
                                    text: result.message,
                                    duration: 3000,
                                    gravity: "top",
                                    position: "right",
                                    style: {
                                        background: "#dc3545",
                                    },
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
                                    background: "#dc3545",
                                },
                            }).showToast();
                        }
                    });
                });

            });
        </script>

        <script>
            function deleteMenuItem(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you really want to delete this menu item?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    background: '#fff',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('menu.delete', ':id') }}".replace(':id', id),
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Menu item deleted successfully!',
                                    icon: 'success',
                                    confirmButtonText: 'Okay',
                                    background: '#fff'
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Something went wrong while deleting.',
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    background: '#fff'
                                });
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            title: 'Cancelled',
                            text: 'Your menu item was not deleted.',
                            icon: 'info',
                            confirmButtonText: 'Okay',
                            background: '#fff'
                        });
                    }
                });
            }
        </script>
    @endsection
