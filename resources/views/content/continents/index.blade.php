@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Continents')

@section('content')

<div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
    @foreach ($data as $value)
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{$value->name}}</h5>
                    <img class="card-img-top" src="{{asset($value->path)}}" alt="{{$value->name}} map" height="160" />
                    <a href="{{ url($value->url) }}" class="btn btn-outline-primary">Display data</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
