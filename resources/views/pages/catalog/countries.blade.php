@extends('layouts/layoutMaster')
@section('title', 'Countries')
@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/css/custom/index.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
@endsection
@section('vendor-script')
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
@endsection
@section('page-script')
<script src="{{asset('assets/js/forms-selects.js')}}"></script>
<script src="{{asset('js/custom/countries.js')}}"></script>
@endsection
@section('content')
<div class="row">
   <div class="col-md-6 col-lg-4 mb-4">
      <div class="form-floating form-floating-outline">
         <select id="select-country" class="select2 form-select form-select-lg" data-allow-clear="true">
            <option value=""></option>
            @foreach ($data as $value)
            <option value="{{ $value->country_name }}">{{ $value->country_name }}</option>
            @endforeach
         </select>
         <label for="select-country">Country</label>
      </div>
   </div>
</div>
<div class="row" id="card-countries-1">
   @foreach ($data as $value)
   @foreach ($countries as $country)
   @if ($value->country_name == $country->name)
   <div class="col-md-6 col-lg-4 mb-3" id="{{ strtolower(str_replace(" ", "-", $country->name)) }}">
   <div class="card card-countries text-center mb-4">
      <div class="card-body">
         <img src="{{$country->flag_url}}" alt="Card image cap" height="60"/>&nbsp;
         <img src="{{$country->emblem_url}}" alt="Emblem image" height="60"/>
         <br><br>
         <h5 class="card-title">{{ $value->country_name }}</h5>
         <p class="card-subtitle">{{ $value->full_name }}</p>
         <br>
         <a href="/countries/{{ strtolower(str_replace(" ", "-", $country->name)) }}" class="btn btn-outline-primary">View Data</a>
         <a href="https://en.wikipedia.org{{$country->url}}" class="btn btn-outline-primary">Wikipedia</a>
      </div>
   </div>
</div>
@endif
@endforeach
@endforeach
</div>
<div class="row" id="card-countries-2" style="display: none"></div>
@endsection
