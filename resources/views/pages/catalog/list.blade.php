@extends('layouts/layoutMaster')
@section('title', $pageTitle)
@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
@endsection
@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endsection
@section('page-script')
    <script type="text/javascript" src="{{ asset('js/custom/columns.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/custom/data-table.js') }}"></script>
@endsection
@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title">
                @if ($input)
                    <span class="text-muted fw-light">{{ $title }} /</span> {{ $input }}
                @else
                    <span class="text-muted fw-light">List /</span> {{ $title }}
                @endif
            </h5>
        </div>
        @if ($inputSelector)
            <div class="card-header">
                <h5 class="card-title">Search Filter</h5>
                <div class="d-flex align-items-center row py-3 gap-md-0">
                    @switch($type)
                        @case('reign_period')
                            <div class="col-md-4 col-lg-4 select_{{ $type }}_from"></div>
                            <div class="col-md-4 col-lg-4 select_{{ $type }}_to"></div>
                        @break

                        @default
                            <div class="col-md-4 col-lg-4 select_{{ $type }}"></div>
                    @endswitch
                </div>
            </div>
        @endif
        <div class="card-datatable table-responsive">
            <table class="datatable table">
                <thead class="table-light">
                    <tr>
                        @foreach ($columns as $col)
                            <th>{{ $col->name }}</th>
                        @endforeach
                    </tr>
                </thead>
                @if (!empty($data))
                    <tbody>
                        @foreach ($data as $row)
                            <tr>
                                @switch($type)
                                    @case('monarch')
                                        <td>{{ $row->monarch }}</td>
                                    @break

                                    @case('reign_period')
                                        <td>{{ $row->reign_period_from }}</td>
                                        <td>{{ $row->reign_period_to }}</td>
                                    @break

                                    @case('mintage_year')
                                        <td>{{ $row->mintage_year }}</td>
                                    @break

                                    @case('avers')
                                        <td>{{ $row->avers }}</td>
                                    @break

                                    @case('revers')
                                        <td>{{ $row->revers }}</td>
                                    @break

                                    @case('coin_edge')
                                        <td>{{ $row->coin_edge }}</td>
                                    @break

                                    @case('currency')
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->code }}</td>
                                        <td>{{ $row->symbol }}</td>
                                    @break

                                    @case('century')
                                        <td>{{ $row->century }}</td>
                                    @break

                                    @case('metal')
                                        <td>{{ $row->metal }}</td>
                                    @break

                                    @case('quality')
                                        <td>{{ $row->quality }}</td>
                                    @break

                                    @case('price_by_krause')
                                        <td>{{ $row->price_by_krause }}</td>
                                    @break

                                    @default
                                @endswitch
                                <td>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-sm btn-icon edit-record" data-id=""
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-target="#offcanvasAddUser" title="Preview"><i
                                                class="mdi mdi-eye-outline mdi-20px mx-1"></i></button>
                                        <a href="" data-bs-toggle="tooltip" class="text-body" data-bs-placement="top"
                                            title="Edit"><i class="mdi mdi-pencil-outline mdi-20px mx-1"></i></a>
                                        <button class="btn btn-sm btn-icon delete-record" data-id=""
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i
                                                class="mdi mdi-delete-outline mdi-20px mx-1"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @endif
            </table>
        </div>
    </div>
    <input type="hidden" id="input" value="{{ strtolower($input) }}">
    <input type="hidden" id="action" value="{{ $action }}">
    <input type="hidden" id="type" value="{{ $type }}">
@endsection
