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
                    <h5 class="card-tile mb-0">Origin</h5>
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

        <div class="col-12 col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Currency</h5>
                </div>
                <div class="card-body">
                    <div class="form-floating form-floating-outline mb-4">
                        <select id="currency" class="select2 form-select" data-placeholder="Select Currency">
                            <option value="">Select Currency</option>
                            @foreach ($currencies as $currency)
                                <option value="{{ $currency->code }}">{{ $currency->code }} - {{ $currency->name }}
                                    ({{ $currency->symbol }})
                                </option>
                            @endforeach
                        </select>
                        <label for="currency">Currency</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="currencyValue" placeholder="Select Currency Value"
                            name="currencyValue" aria-label="Currency Value">
                        <label for="currencyValue">Currency Value</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-tile mb-0">Monarch</h5>
                </div>
                <div class="card-body">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="monarch" placeholder="Select Monarch"
                            name="monarch" aria-label="Monarch">
                        <label for="monarch">Monarch</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="reignFrom" placeholder="Select Reign Period From"
                            name="reignFrom" aria-label="Reign Period From">
                        <label for="reignFrom">Reign Period From</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="reignTo" placeholder="Select Reign Period To"
                            name="reignTo" aria-label="Reign Period To">
                        <label for="reignTo">Reign Period To</label>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title">Media</h5>
                    <a href="javascript:void(0);" class="fw-medium">Add media from URL</a>
                </div>
                <div class="card-body">
                    <form action="/upload" class="dropzone needsclick" id="dropzone-basic">
                        <div class="dz-message needsclick my-5">
                            Drag and drop your image here
                            <small class="text-muted d-block fs-6 my-2">or</small>
                            <span class="needsclick btn btn-outline-primary d-inline" id="btnBrowse">Browse image</span>
                        </div>
                        <div class="fallback">
                            <input name="file" type="file" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Details</h5>
                </div>
                <div class="card-body">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="mintageYear" placeholder="Select Mintage Year"
                            name="mintageYear" aria-label="Mintage Year">
                        <label for="mintageYear">Mintage Year</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="avers" placeholder="Select Avers"
                            name="avers" aria-label="Avers">
                        <label for="avers">Avers</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="revers" placeholder="Select Revers"
                            name="revers" aria-label="Revers">
                        <label for="revers">Revers</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="coinEdge" placeholder="Select Coin Edge"
                            name="coinEdge" aria-label="Coin Edge">
                        <label for="coinEdge">Coin Edge</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="century" placeholder="Select Century"
                            name="century" aria-label="Century">
                        <label for="century">Century</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="metal" placeholder="Select Metal"
                            name="metal" aria-label="Metal">
                        <label for="metal">Metal</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="proof" placeholder="Select Proof"
                            name="proof" aria-label="Proof">
                        <label for="proof">Proof</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-4">
                        <input type="number" class="form-control" id="krausePrice" placeholder="Select Krause Price"
                            name="krausePrice" aria-label="Krause Price">
                        <label for="krausePrice">Krause Price</label>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
