@extends('layouts/layoutMaster')

@section('title', 'Add')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dropzone/dropzone.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-action.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Actions /</span><span> Add</span>
    </h4>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Add a new item</h5>
                <div class="card-body">
                    <form id="formAddItem" class="row g-3" action="{{ url('/add-submit') }}" method="POST">
                        @csrf
                        <div class="col-12">
                            <h6>1. Origin Details</h6>
                            <hr class="mt-0" />
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select id="continent" name="continent" class="select2 form-select" data-allow-clear="true">
                                    <option value="">Select Continent</option>
                                    @foreach ($continents as $continent)
                                        <option value="{{ $continent->name }}">{{ $continent->name }}</option>
                                    @endforeach
                                </select>
                                <label for="continent">Continent</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select id="country" name="country" class="select2 form-select" data-allow-clear="true"
                                    required>
                                    <option value="">Select Country</option>
                                </select>
                                <label for="country">Country</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <h6 class="mt-2">2. Currency Details</h6>
                            <hr class="mt-0" />
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select id="currency" class="select2 form-select" data-placeholder="Select Currency">
                                    <option value="">Select Currency</option>
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency->code }}">{{ $currency->code }} -
                                            {{ $currency->name }}
                                            ({{ $currency->symbol }})
                                        </option>
                                    @endforeach
                                </select>
                                <label for="currency">Currency</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control" id="currencyValue"
                                    placeholder="Select Currency Value" name="currencyValue" aria-label="Currency Value">
                                <label for="currencyValue">Currency Value</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <h6 class="mt-2">3. Monarch Details</h6>
                            <hr class="mt-0" />
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" id="monarch" placeholder="Select Monarch"
                                    name="monarch" aria-label="Monarch">
                                <label for="monarch">Monarch</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control" id="reignFrom"
                                    placeholder="Select Reign Period From" name="reignFrom" aria-label="Reign Period From">
                                <label for="reignFrom">Reign Period From</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control" id="reignTo"
                                    placeholder="Select Reign Period To" name="reignTo" aria-label="Reign Period To">
                                <label for="reignTo">Reign Period To</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <h6 class="mt-2">4. Other Details</h6>
                            <hr class="mt-0" />
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control" id="mintageYear"
                                    placeholder="Select Mintage Year" name="mintageYear" aria-label="Mintage Year">
                                <label for="mintageYear">Mintage Year</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" id="avers" placeholder="Select Avers"
                                    name="avers" aria-label="Avers">
                                <label for="avers">Avers</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" id="revers" placeholder="Select Revers"
                                    name="revers" aria-label="Revers">
                                <label for="revers">Revers</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" id="coinEdge" placeholder="Select Coin Edge"
                                    name="coinEdge" aria-label="Coin Edge">
                                <label for="coinEdge">Coin Edge</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control" id="century" placeholder="Select Century"
                                    name="century" aria-label="Century">
                                <label for="century">Century</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" id="metal" placeholder="Select Metal"
                                    name="metal" aria-label="Metal">
                                <label for="metal">Metal</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" id="quality" placeholder="Select Quality"
                                    name="quality" aria-label="Quality">
                                <label for="quality">Quality</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control" id="krausePrice"
                                    placeholder="Select Krause Price" name="krausePrice" aria-label="Krause Price">
                                <label for="krausePrice">Krause Price</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="submitButton" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
                {{-- <div class="card-body">
                    <div class="col-12">
                        <h6 class="mt-2">5. Media Upload</h6>
                        <hr class="mt-0" />
                    </div>
                    <form action="/upload" class="dropzone needsclick" id="dropzone-basic">
                        <div class="dz-message needsclick my-5">
                            Drag and drop your image here
                            <small class="text-muted d-block fs-6 my-2">or</small>
                            <span class="needsclick btn btn-outline-primary d-inline" id="btnBrowse">Browse
                                image</span>
                        </div>
                        <div class="fallback">
                            <input name="file" type="file" />
                        </div>
                    </form>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
