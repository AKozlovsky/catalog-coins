@extends('layouts/layoutMaster')

@section('title', 'Countries')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/css/custom/index.css')}}" />
@endsection

@section('page-script')
{{-- <script src="{{asset('js/custom/continents.js')}}"></script> --}}
@endsection

@section('content')

<div class="row">
    @foreach ($data as $value)
        @foreach ($countries as $country)
            @if ($value->country_name == $country->name)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card card-countries text-center mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $value->country_name }}</h5>
                        <p class="card-subtitle">{{ $value->full_name }}</p>
                    </div>
                    <img src="{{asset('assets/img/flags')}}/{{strtolower($country->alpha3)}}.svg" alt="Card image cap" height="60"/>
                    <div class="card-body">
                        <a href="" class="btn btn-outline-primary">View Data</a>
                        <a href="" class="btn btn-outline-primary">Wikipedia</a>
                    </div>
                </div>
              </div>
            @endif
        @endforeach
    @endforeach
</div>

@endsection
