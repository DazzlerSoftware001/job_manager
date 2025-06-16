@extends('admin.adminlayout.main')
@section('title')
    Admin-General Setting
@endsection
@section('page-title')
    Front Page Setting
@endsection

@section('main-container')
    <div class="main-content">
        <div class="page-content">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-2 mb-2">
                            <a href="{{ route('Admin.HomePageSettings') }}" class="btn btn-primary w-100">Home Page</a>
                        </div>
                        {{-- <div class="col-md-2 mb-2">
                            <a href="/page2" class="btn btn-success w-100">Go to Page 2</a>
                        </div>
                        <div class="col-md-2 mb-2">
                            <a href="/page3" class="btn btn-warning w-100">Go to Page 3</a>
                        </div>
                        <div class="col-md-2 mb-2">
                            <a href="/page4" class="btn btn-danger w-100">Go to Page 4</a> --}}
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
