@extends('layouts/layoutMaster')

@section('title', 'Edit')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dropzone/dropzone.css') }}" />
@endsection

@section('page-style')
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-action.js') }}"></script>
@endsection

@section('content')
    <form action="/form-submit" class="dropzone needsclick" id="formDropzone" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-12">
            <h6>Media Upload</h6>
            <hr class="mt-0" />
        </div>
        <div class="fallback">
            <input name="file" type="file" />
        </div>
        <div class="dz-message needsclick my-5">
            Drag and drop your image here
            <small class="text-muted d-block fs-6 my-2">or</small>
            <span class="needsclick btn btn-outline-primary d-inline" id="btnBrowse">Browse
                image</span>
        </div>
        <button class="btn btn-primary fw-medium py-3 px-4 mt-3" id="formSubmit" type="submit">
            <span class="spinner-border spinner-border-sm d-none me-2" aria-hidden="true"></span>
            Submit Form
        </button>
        <input id="files" name="files[]" type="file" style="display: none" />
    </form>
@endsection
