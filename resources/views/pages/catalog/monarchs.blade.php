@extends('layouts/layoutMaster')
@section('title', 'Monarchs')
@section('content')
<div class="row">
    <div class="col-md-6 col-lg-4 mb-4">
       <div class="form-floating form-floating-outline">
          <select id="select-monarch" class="select2 form-select form-select-lg" data-allow-clear="true">
             <option value=""></option>
             @foreach ($data as $value)
             <option value="{{ $value->id }}">{{ $value->monarch }}</option>
             @endforeach
          </select>
          <label for="select-monarch">Monarch</label>
       </div>
    </div>
 </div>
@endsection
