@extends('layouts/layoutMaster')
@section('title', $windowTitle)
@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
@endsection
@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
@endsection
@section('page-script')
<script src="{{asset('js/custom/data-table.js')}}"></script>
@endsection
@section('content')
<div class="card">
   <div class="card-header border-bottom">
      <h5 class="card-title">
         <span class="text-muted fw-light">{{ $title }} /</span> {{ $input }}
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
<input type="hidden" id="input" value="{{ strtolower($input) }}">
<input type="hidden" id="action" value="{{ $action }}">
@endsection
