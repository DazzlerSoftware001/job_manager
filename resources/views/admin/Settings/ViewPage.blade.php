@extends('admin.adminlayout.main')
@section('title')
    {{$page->title}}
@endsection
@section('page-title')
{{$page->title}}
@endsection

@section('main-container')

    
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h4 class="card-title">Job List</h4>
                            </div> --}}

                            {!! $page->content !!}
                           
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
     
    @endsection
