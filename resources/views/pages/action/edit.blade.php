@extends('layouts/layoutMaster')

@section('title', 'Edit')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dropzone/dropzone.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
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
        <span class="text-muted fw-light">Actions /</span><span> Edit</span>
    </h4>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Edit item</h5>
                <div class="card-body">
                    <form id="formEditItem" class="row g-3" method="POST">
                        @csrf
                        <div class="col-12">
                            <h6>Origin</h6>
                            <hr class="mt-0" />
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select id="continent" name="continent" class="select2 form-select" data-allow-clear="true">
                                    <option value="">Select Continent</option>
                                    @foreach ($continents as $continent)
                                        @if ($continent->name == $continentName)
                                            <option selected value="{{ $continent->name }}">{{ $continent->name }}
                                            </option>
                                        @else
                                            <option value="{{ $continent->name }}">{{ $continent->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="continent">Continent</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select id="country" name="country" class="select2 form-select" data-allow-clear="true">
                                    <option value="">Select Country</option>
                                </select>
                                <label for="country">Country</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <h6 class="mt-2">Currency</h6>
                            <hr class="mt-0" />
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select id="currency" name="currency" class="select2 form-select" data-allow-clear="true">
                                    <option value="">Select Currency</option>
                                    @foreach ($currencies as $currency)
                                        @if ($currency->code == $currencyCode)
                                            <option selected value="{{ $currency->code }}">{{ $currency->code }} -
                                                {{ $currency->name }}
                                                ({{ $currency->symbol }})
                                            </option>
                                        @else
                                            <option value="{{ $currency->code }}">{{ $currency->code }} -
                                                {{ $currency->name }}
                                                ({{ $currency->symbol }})
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="currency">Currency</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                @if ($numericalValue)
                                    <input type="number" class="form-control" id="currencyValue" name="currencyValue"
                                        value="{{ $numericalValue->value }}">
                                @else
                                    <input type="number" class="form-control" id="currencyValue" name="currencyValue">
                                @endif
                                <label for="currencyValue">Currency Value</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <h6 class="mt-2">Monarch</h6>
                            <hr class="mt-0" />
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" id="monarch" placeholder="Select Monarch"
                                    name="monarch" aria-label="Monarch" value="{{ $otherCriteria->monarch }}">
                                <label for="monarch">Monarch</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control" id="reign_period_from"
                                    placeholder="Select Reign Period From" name="reign_period_from"
                                    aria-label="Reign Period From" value="{{ $otherCriteria->reign_period_from }}">
                                <label for="reign_period_from">Reign Period From</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control" id="reign_period_to"
                                    placeholder="Select Reign Period To" name="reign_period_to" aria-label="Reign Period To"
                                    value="{{ $otherCriteria->reign_period_to }}">
                                <label for="reign_period_to">Reign Period To</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <h6 class="mt-2">Others</h6>
                            <hr class="mt-0" />
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control" id="mintage_year"
                                    placeholder="Select Mintage Year" name="mintage_year" aria-label="Mintage Year"
                                    value="{{ $otherCriteria->mintage_year }}">
                                <label for="mintage_year">Mintage Year</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" id="avers" placeholder="Select Avers"
                                    name="avers" aria-label="Avers" value="{{ $otherCriteria->avers }}">
                                <label for="avers">Avers</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" id="revers" placeholder="Select Revers"
                                    name="revers" aria-label="Revers" value="{{ $otherCriteria->revers }}">
                                <label for="revers">Revers</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" id="coin_edge" placeholder="Select Coin Edge"
                                    name="coin_edge" aria-label="Coin Edge" value="{{ $otherCriteria->coin_edge }}">
                                <label for="coin_edge">Coin Edge</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control" id="century" placeholder="Select Century"
                                    name="century" aria-label="Century" value="{{ $otherCriteria->century }}">
                                <label for="century">Century</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" id="metal" placeholder="Select Metal"
                                    name="metal" aria-label="Metal" value="{{ $otherCriteria->metal }}">
                                <label for="metal">Metal</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" id="quality" placeholder="Select Quality"
                                    name="quality" aria-label="Quality" value="{{ $otherCriteria->quality }}">
                                <label for="quality">Quality</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control" id="price_by_krause"
                                    placeholder="Select Krause Price" name="price_by_krause" aria-label="Krause Price"
                                    value="{{ $otherCriteria->price_by_krause }}">
                                <label for="price_by_krause">Krause Price</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="hidden" id="collectionId" value="{{ $collectionId }}">
                            <button type="submit" name="submitButton" class="btn btn-primary data-submit">Edit</button>
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

    @if ($countryName)
        <input type="hidden" id="countryToSelect" value="{{ $countryName }}">
    @endif
@endsection
