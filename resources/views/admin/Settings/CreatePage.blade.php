@extends('admin.adminlayout.main')
@section('title')
    Admin-Page Setting
@endsection
@section('page-title')
Page Setting
@endsection
<!-- Summernote CSS -->

@section('main-container')

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
   
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                {{-- <div class="card-header">
                                    <h4 class="card-title">Job List</h4>
                                </div> --}}

                                <div class="px-3 mt-3 d-flex align-items-center gap-2">
                                    <input type="text" id="search" name="search"
                                        class="form-control form-control-sm bg-light rounded w-25" placeholder="Search...">
                                        <a href="{{ route('Admin.CreatePage') }}" class="btn btn-primary">+ Create New Page</a>
                                </div>

                                <form action="{{ route('Admin.InsertPage') }}" method="POST">
                                    @csrf
                            
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Page Title</label>
                                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Slug (URL friendly)</label>
                                        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" required>
                                        @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="content" class="form-label">Content</label>
                                        <textarea id="content" name="content" rows="10" class="form-control" required>{{ old('content') }}</textarea>
                                        @error('content') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    

                                    <button type="submit" class="btn btn-success">Create Page</button>
                                    <a href="{{ route('Admin.PageSettings') }}" class="btn btn-secondary">Cancel</a>
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
   
    @section('script')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Summernote JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#content').summernote({
                    height: 300,   // set editor height
                    placeholder: 'Write your content here...'
                });
            });
        </script>




    @endsection
