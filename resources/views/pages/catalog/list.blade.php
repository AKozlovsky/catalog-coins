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
    <h4 class="py-3 mb-4">
        @if ($input)
            <span class="text-muted fw-light">{{ $title }} /</span> {{ $input }}
        @else
            <span class="text-muted fw-light">List /</span> {{ $title }}
        @endif
    </h4>

    <div class="card">
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
                                        <td>{{ $row->continent }}</td>
                                        <td>{{ $row->country }}</td>
                                        <td>{{ $row->currency }}</td>
                                        <td>{{ $row->symbol }}</td>
                                        <td>{{ $row->numerical_value }}</td>
                                        <td style="display: none">{{ $row->id }}</td>
                                        <td style="display: none">{{ $row->reign_period_from }}</td>
                                        <td style="display: none">{{ $row->reign_period_to }}</td>
                                        <td style="display: none">{{ $row->mintage_year }}</td>
                                        <td style="display: none">{{ $row->avers }}</td>
                                        <td style="display: none">{{ $row->revers }}</td>
                                        <td style="display: none">{{ $row->coin_edge }}</td>
                                        <td style="display: none">{{ $row->century }}</td>
                                        <td style="display: none">{{ $row->metal }}</td>
                                        <td style="display: none">{{ $row->quality }}</td>
                                        <td style="display: none">{{ $row->price_by_krause }}</td>
                                    @break

                                    @case('reign_period')
                                        <td>{{ $row->reign_period_from }}</td>
                                        <td>{{ $row->reign_period_to }}</td>
                                        <td>{{ $row->continent }}</td>
                                        <td>{{ $row->country }}</td>
                                        <td>{{ $row->currency }}</td>
                                        <td>{{ $row->symbol }}</td>
                                        <td>{{ $row->numerical_value }}</td>
                                        <td style="display: none">{{ $row->id }}</td>
                                        <td style="display: none">{{ $row->monarch }}</td>
                                        <td style="display: none">{{ $row->mintage_year }}</td>
                                        <td style="display: none">{{ $row->avers }}</td>
                                        <td style="display: none">{{ $row->revers }}</td>
                                        <td style="display: none">{{ $row->coin_edge }}</td>
                                        <td style="display: none">{{ $row->century }}</td>
                                        <td style="display: none">{{ $row->metal }}</td>
                                        <td style="display: none">{{ $row->quality }}</td>
                                        <td style="display: none">{{ $row->price_by_krause }}</td>
                                    @break

                                    @case('mintage_year')
                                        <td>{{ $row->mintage_year }}</td>
                                        <td>{{ $row->continent }}</td>
                                        <td>{{ $row->country }}</td>
                                        <td>{{ $row->currency }}</td>
                                        <td>{{ $row->symbol }}</td>
                                        <td>{{ $row->numerical_value }}</td>
                                        <td style="display: none">{{ $row->id }}</td>
                                        <td style="display: none">{{ $row->monarch }}</td>
                                        <td style="display: none">{{ $row->reign_period_from }}</td>
                                        <td style="display: none">{{ $row->reign_period_to }}</td>
                                        <td style="display: none">{{ $row->avers }}</td>
                                        <td style="display: none">{{ $row->revers }}</td>
                                        <td style="display: none">{{ $row->coin_edge }}</td>
                                        <td style="display: none">{{ $row->century }}</td>
                                        <td style="display: none">{{ $row->metal }}</td>
                                        <td style="display: none">{{ $row->quality }}</td>
                                        <td style="display: none">{{ $row->price_by_krause }}</td>
                                    @break

                                    @case('avers')
                                        <td>{{ $row->avers }}</td>
                                        <td>{{ $row->continent }}</td>
                                        <td>{{ $row->country }}</td>
                                        <td>{{ $row->currency }}</td>
                                        <td>{{ $row->symbol }}</td>
                                        <td>{{ $row->numerical_value }}</td>
                                        <td style="display: none">{{ $row->id }}</td>
                                        <td style="display: none">{{ $row->monarch }}</td>
                                        <td style="display: none">{{ $row->reign_period_from }}</td>
                                        <td style="display: none">{{ $row->reign_period_to }}</td>
                                        <td style="display: none">{{ $row->mintage_year }}</td>
                                        <td style="display: none">{{ $row->revers }}</td>
                                        <td style="display: none">{{ $row->coin_edge }}</td>
                                        <td style="display: none">{{ $row->century }}</td>
                                        <td style="display: none">{{ $row->metal }}</td>
                                        <td style="display: none">{{ $row->quality }}</td>
                                        <td style="display: none">{{ $row->price_by_krause }}</td>
                                    @break

                                    @case('revers')
                                        <td>{{ $row->revers }}</td>
                                        <td>{{ $row->continent }}</td>
                                        <td>{{ $row->country }}</td>
                                        <td>{{ $row->currency }}</td>
                                        <td>{{ $row->symbol }}</td>
                                        <td>{{ $row->numerical_value }}</td>
                                        <td style="display: none">{{ $row->id }}</td>
                                        <td style="display: none">{{ $row->monarch }}</td>
                                        <td style="display: none">{{ $row->reign_period_from }}</td>
                                        <td style="display: none">{{ $row->reign_period_to }}</td>
                                        <td style="display: none">{{ $row->mintage_year }}</td>
                                        <td style="display: none">{{ $row->avers }}</td>
                                        <td style="display: none">{{ $row->coin_edge }}</td>
                                        <td style="display: none">{{ $row->century }}</td>
                                        <td style="display: none">{{ $row->metal }}</td>
                                        <td style="display: none">{{ $row->quality }}</td>
                                        <td style="display: none">{{ $row->price_by_krause }}</td>
                                    @break

                                    @case('coin_edge')
                                        <td>{{ $row->coin_edge }}</td>
                                        <td>{{ $row->continent }}</td>
                                        <td>{{ $row->country }}</td>
                                        <td>{{ $row->currency }}</td>
                                        <td>{{ $row->symbol }}</td>
                                        <td>{{ $row->numerical_value }}</td>
                                        <td style="display: none">{{ $row->id }}</td>
                                        <td style="display: none">{{ $row->monarch }}</td>
                                        <td style="display: none">{{ $row->reign_period_from }}</td>
                                        <td style="display: none">{{ $row->reign_period_to }}</td>
                                        <td style="display: none">{{ $row->mintage_year }}</td>
                                        <td style="display: none">{{ $row->avers }}</td>
                                        <td style="display: none">{{ $row->revers }}</td>
                                        <td style="display: none">{{ $row->century }}</td>
                                        <td style="display: none">{{ $row->metal }}</td>
                                        <td style="display: none">{{ $row->quality }}</td>
                                        <td style="display: none">{{ $row->price_by_krause }}</td>
                                    @break

                                    @case('currency')
                                        <td>{{ $row->currency }}</td>
                                        <td>{{ $row->symbol }}</td>
                                        <td>{{ $row->continent }}</td>
                                        <td>{{ $row->country }}</td>
                                        <td>{{ $row->numerical_value }}</td>
                                        <td style="display: none">{{ $row->id }}</td>
                                        <td style="display: none">{{ $row->monarch }}</td>
                                        <td style="display: none">{{ $row->reign_period_from }}</td>
                                        <td style="display: none">{{ $row->reign_period_to }}</td>
                                        <td style="display: none">{{ $row->mintage_year }}</td>
                                        <td style="display: none">{{ $row->avers }}</td>
                                        <td style="display: none">{{ $row->revers }}</td>
                                        <td style="display: none">{{ $row->coin_edge }}</td>
                                        <td style="display: none">{{ $row->century }}</td>
                                        <td style="display: none">{{ $row->metal }}</td>
                                        <td style="display: none">{{ $row->quality }}</td>
                                        <td style="display: none">{{ $row->price_by_krause }}</td>
                                    @break

                                    @case('century')
                                        <td>{{ $row->century }}</td>
                                        <td>{{ $row->continent }}</td>
                                        <td>{{ $row->country }}</td>
                                        <td>{{ $row->currency }}</td>
                                        <td>{{ $row->symbol }}</td>
                                        <td>{{ $row->numerical_value }}</td>
                                        <td style="display: none">{{ $row->id }}</td>
                                        <td style="display: none">{{ $row->monarch }}</td>
                                        <td style="display: none">{{ $row->reign_period_from }}</td>
                                        <td style="display: none">{{ $row->reign_period_to }}</td>
                                        <td style="display: none">{{ $row->mintage_year }}</td>
                                        <td style="display: none">{{ $row->avers }}</td>
                                        <td style="display: none">{{ $row->revers }}</td>
                                        <td style="display: none">{{ $row->coin_edge }}</td>
                                        <td style="display: none">{{ $row->metal }}</td>
                                        <td style="display: none">{{ $row->quality }}</td>
                                        <td style="display: none">{{ $row->price_by_krause }}</td>
                                    @break

                                    @case('metal')
                                        <td>{{ $row->metal }}</td>
                                        <td>{{ $row->continent }}</td>
                                        <td>{{ $row->country }}</td>
                                        <td>{{ $row->currency }}</td>
                                        <td>{{ $row->symbol }}</td>
                                        <td>{{ $row->numerical_value }}</td>
                                        <td style="display: none">{{ $row->id }}</td>
                                        <td style="display: none">{{ $row->monarch }}</td>
                                        <td style="display: none">{{ $row->reign_period_from }}</td>
                                        <td style="display: none">{{ $row->reign_period_to }}</td>
                                        <td style="display: none">{{ $row->mintage_year }}</td>
                                        <td style="display: none">{{ $row->avers }}</td>
                                        <td style="display: none">{{ $row->revers }}</td>
                                        <td style="display: none">{{ $row->coin_edge }}</td>
                                        <td style="display: none">{{ $row->century }}</td>
                                        <td style="display: none">{{ $row->quality }}</td>
                                        <td style="display: none">{{ $row->price_by_krause }}</td>
                                    @break

                                    @case('quality')
                                        <td>{{ $row->quality }}</td>
                                        <td>{{ $row->continent }}</td>
                                        <td>{{ $row->country }}</td>
                                        <td>{{ $row->currency }}</td>
                                        <td>{{ $row->symbol }}</td>
                                        <td>{{ $row->numerical_value }}</td>
                                        <td style="display: none">{{ $row->id }}</td>
                                        <td style="display: none">{{ $row->monarch }}</td>
                                        <td style="display: none">{{ $row->reign_period_from }}</td>
                                        <td style="display: none">{{ $row->reign_period_to }}</td>
                                        <td style="display: none">{{ $row->mintage_year }}</td>
                                        <td style="display: none">{{ $row->avers }}</td>
                                        <td style="display: none">{{ $row->revers }}</td>
                                        <td style="display: none">{{ $row->coin_edge }}</td>
                                        <td style="display: none">{{ $row->century }}</td>
                                        <td style="display: none">{{ $row->metal }}</td>
                                        <td style="display: none">{{ $row->price_by_krause }}</td>
                                    @break

                                    @case('price_by_krause')
                                        <td>{{ $row->price_by_krause }}</td>
                                        <td>{{ $row->continent }}</td>
                                        <td>{{ $row->country }}</td>
                                        <td>{{ $row->currency }}</td>
                                        <td>{{ $row->symbol }}</td>
                                        <td>{{ $row->numerical_value }}</td>
                                        <td style="display: none">{{ $row->id }}</td>
                                        <td style="display: none">{{ $row->monarch }}</td>
                                        <td style="display: none">{{ $row->reign_period_from }}</td>
                                        <td style="display: none">{{ $row->reign_period_to }}</td>
                                        <td style="display: none">{{ $row->mintage_year }}</td>
                                        <td style="display: none">{{ $row->avers }}</td>
                                        <td style="display: none">{{ $row->revers }}</td>
                                        <td style="display: none">{{ $row->coin_edge }}</td>
                                        <td style="display: none">{{ $row->century }}</td>
                                        <td style="display: none">{{ $row->metal }}</td>
                                        <td style="display: none">{{ $row->quality }}</td>
                                    @break

                                    @default
                                @endswitch
                                <td></td>
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
