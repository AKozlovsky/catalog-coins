@extends('layouts/layoutMaster')

@section('title', 'Edit')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-action.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Actions /</span><span> Edit Currency</span>
    </h4>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Edit the currency - {{ $currency->name }}</h5>
                <div class="card-body">
                    <form id="formEditCurrency" class="row g-3" method="POST">
                        @csrf
                        <div class="col-12">
                            <h6>Currency Info</h6>
                            <hr class="mt-0" />
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" id="currencyName" placeholder="Enter Name"
                                    name="currencyName" aria-label="Name" value="{{ $currency->name }}">
                                <label for="currencyName">Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" id="currencyCode" placeholder="Enter Code"
                                    name="currencyCode" aria-label="Code" maxlength="3" value="{{ $currency->code }}">
                                <label for="currencyCode">Code</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" id="currencySymbol" placeholder="Enter Symbol"
                                    name="currencySymbol" aria-label="Symbol" maxlength="5"
                                    value="{{ $currency->symbol }}">
                                <label for="currencySymbol">Symbol</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="hidden" id="id" value="{{ $currency->id }}">
                            <button type="submit" name="submitButton" class="btn btn-primary data-submit">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
