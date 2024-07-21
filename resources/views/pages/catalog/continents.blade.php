@extends('layouts/layoutMaster')

@section('title', 'Continents')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/css/custom/index.css') }}" />
@endsection

@section('page-script')
    <script src="{{ asset('js/custom/continents.js') }}"></script>
@endsection

@section('content')
    <div class="row">
        @foreach ($continents as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card card-continents mb-3">
                    <div class="card-header">{{ $item->name }}</div>
                    <div class="card-body">
                        <p class="card-text">
                            <img class="card-img" src="{{ asset($item->path) }}" alt="{{ $item->name }} map"
                                height="180" />
                            <a href="{{ url($item->url) }}" style="display: none"></a>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
