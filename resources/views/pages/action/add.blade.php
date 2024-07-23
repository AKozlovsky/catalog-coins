@extends('layouts/layoutMaster')

@section('title', 'Add')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-action.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Actions /</span><span> Add</span>
    </h4>

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
        <div class="d-flex flex-column justify-content-center">
            <h4 class="mb-1 mt-3">Add a new item</h4>
        </div>
        <div class="d-flex align-content-center flex-wrap gap-3">
            <button type="submit" class="btn btn-primary">Add item</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-tile mb-0">Origin information</h5>
                </div>
                <div class="card-body">
                    <div class="form-floating form-floating-outline mb-4">
                        <select id="continent" class="select2 form-select" data-placeholder="Select Continent">
                            <option value="">Select Continent</option>
                            @foreach ($continents as $continent)
                                <option value="{{ $continent->name }}">{{ $continent->name }}</option>
                            @endforeach
                        </select>
                        <label for="continent">Continent</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <select id="country" class="select2 form-select" data-placeholder="Select Country">
                            <option value="">Select Country</option>
                        </select>
                        <label for="country">Country</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
