@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Continents')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
{{-- <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" /> --}}
{{-- <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" /> --}}

<!-- Row Group CSS -->
{{-- <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css')}}"> --}}

<!-- Form Validation -->
{{-- <link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" /> --}}
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
@endsection

@section('page-script')
{{-- <script src="{{asset('assets/js/forms-selects.js')}}"></script> --}}
<script src="{{asset('js/custom/list-by-continent.js')}}"></script>
@endsection

@section('content')

<div class="card">
   <div class="card-header border-bottom">
      <h5 class="card-title">
         <span class="text-muted fw-light">Continent /</span> {{ $continent }}
      </h5>
   </div>
   <div class="card-datatable table-responsive">
      <table class="datatable table">
         <thead class="table-light">
            <tr>
                @foreach ($columns as $col)
                <th>{{ $col->name }}</th>
                @endforeach
            </tr>
         </thead>
      </table>
   </div>
</div>

<input type="hidden" id="continent" value="{{ strtolower($continent) }}">

@endsection
