@extends('layouts/layoutMaster')

@section('title', 'Dashboard')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-logistics-dashboard.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-academy-dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">My Coins /</span> Dashboard
    </h4>

    <div class="row">
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i
                                    class="mdi mdi-hand-coin mdi-20px"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0 display-6">{{ $totalItems }}</h4>
                    </div>
                    <p class="mb-0 text-heading">Total of items</p>
                    <p class="mb-0">
                        <span class="me-1">+ {{ $itemsThisWeek }}</span>
                        <small class="text-muted">this week</small>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class='mdi mdi-earth mdi-20px'></i></span>
                        </div>
                        <h4 class="ms-1 mb-0 display-6">{{ $totalCountries }}</h4>
                    </div>
                    <p class="mb-0 text-heading">Total of countries</p>
                    <p class="mb-0">
                        <span class="me-1">+ {{ $countriesThisWeek }}</span>
                        <small class="text-muted">this week</small>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4 g-4">
        <div class="col-12 col-xl-8">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">List of countries with most items</h5>
                </div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <div id="horizontalBarChart"></div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-around align-items-center">
                        <div>
                            <div class="d-flex align-items-baseline">
                                <span class="text-primary me-2"><i class='mdi mdi-circle mdi-14px'></i></span>
                                <div>
                                    <p class="mb-1">UI Design</p>
                                    <h5>35%</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-baseline my-3">
                                <span class="text-success me-2"><i class='mdi mdi-circle mdi-14px'></i></span>
                                <div>
                                    <p class="mb-1">Music</p>
                                    <h5>14%</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <span class="text-danger me-2"><i class='mdi mdi-circle mdi-14px'></i></span>
                                <div>
                                    <p class="mb-1">React</p>
                                    <h5>10%</h5>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="d-flex align-items-baseline">
                                <span class="text-info me-2"><i class='mdi mdi-circle mdi-14px'></i></span>
                                <div>
                                    <p class="mb-1">UX Design</p>
                                    <h5>20%</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-baseline my-3">
                                <span class="text-secondary me-2"><i class='mdi mdi-circle mdi-14px'></i></span>
                                <div>
                                    <p class="mb-1">Animation</p>
                                    <h5>12%</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <span class="text-warning me-2"><i class='mdi mdi-circle mdi-14px'></i></span>
                                <div>
                                    <p class="mb-1">SEO</p>
                                    <h5>9%</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 order-5">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">The last items</h5>
                </div>
            </div>
            {{-- <div class="card-datatable table-responsive">
                <table class="dt-route-vehicles table">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th></th>
                            <th>location</th>
                            <th>starting route</th>
                            <th>ending route</th>
                            <th>warnings</th>
                            <th class="w-20">progress</th>
                        </tr>
                    </thead>
                </table>
            </div> --}}
        </div>
    </div>
@endsection
