@extends('admin.adminlayout.main')
@section('title')
    Admin-Page Setting
@endsection
@section('page-title')
Page Setting
@endsection

@section('main-container')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
   
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Page: {{ $page->title }}</h4>
                                </div>


                                <form action="{{ route('Admin.UpdatePage', $page->id) }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Page Title</label>
                                        <input type="text" name="title" class="form-control" value="{{ old('title', $page->title) }}" required>
                                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $page->slug) }}" required>
                                        @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="content" class="form-label">Content</label>
                                        <textarea id="content" name="content" rows="10" class="form-control" required>{{ old('content', $page->content) }}</textarea>
                                        @error('content') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Page</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 300,
                placeholder: 'Write your content here...'
            });
        });
    </script>





    @endsection
