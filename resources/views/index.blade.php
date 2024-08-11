@extends('layouts.master')

@section('title') Dashboard @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Dashboards @endslot
        @slot('title') Dashboard @endslot
    @endcomponent

    <div class="row">

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8">
                            <h4 class="card-title">Total Sales</h4>
                            <h3 class="text-dark">{{ number_format(@$total_general['total_amount'],2) }} RON</h3>
                        </div>
                        <div class="col-sm-4">
                            <div class="d-flex align-items-center mt-4 mt-sm-0">
                                <div class="flex-shrink-0 me-4">
                                    <h1 class="fw-semibold display-4 mb-0 text-primary">{{ @$total_general['total_count'] }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h4 class="card-title mb-4">Monthly orders</h4>
                        <div class="col-sm-8">
                            <p class="text-muted">This month</p>
                            <h3>{{ number_format(@$total_current_month['total_amount'],2) }} RON</h3>

                            @if(@$total_current_month['total_count_percentage'] > 0)
                                <p class="text-muted"><span class="text-success me-2"> {{ @$total_current_month['total_count_percentage'] ?? 0 }}% <i class="mdi mdi-arrow-up"></i>
                            @elseif(@$total_current_month['total_count_percentage'] < 0)
                                <p class="text-muted"><span class="text-danger me-2"> {{ @$total_current_month['total_count_percentage'] ?? 0 }}% <i class="mdi mdi-arrow-down"></i>
                            @else
                                <p class="text-muted"><span class="text-dark me-2"> {{ @$total_current_month['total_count_percentage'] ?? 0 }}% <i class="bx bx-minus"></i>
                            @endif
                                </span> From previous period</p>

                            {{-- <div class="mt-4">
                                <a href="" class="btn btn-primary waves-effect waves-light btn-sm">View More <i class="mdi mdi-arrow-right ms-1"></i></a>
                            </div> --}}
                        </div>
                        <div class="col-sm-4">
                            <div class="d-flex align-items-center mt-4 mt-sm-0">
                                <div class="flex-shrink-0 me-4">
                                    <h1 class="fw-semibold display-4 mb-0 text-primary">{{ @$total_current_month['total_count'] }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">New orders</p>
                                    <h4 class="mb-0">{{ $orders_status['1']['total_count'] ?? 0 }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium"> In progress & Finalized</p>
                                    <h4 class="mb-0">{{ ($orders_status['4']['total_count'] ?? 0) + ($orders_status['3']['total_count'] ?? 0) + ($orders_status['2']['total_count'] ?? 0)  }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Returned & Canceled</p>
                                    <h4 class="mb-0">{{ ($orders_status['5']['total_count'] ?? 0) + ($orders_status['0']['total_count'] ?? 0)  }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex flex-wrap">
                        <h4 class="card-title mb-4">Email Sent</h4>
                        <div class="ms-auto">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Week</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Month</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">Year</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div id="stacked-column-chart" data-colors='["--bs-primary", "--bs-warning", "--bs-success"]' class="apex-charts" dir="ltr"></div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script src="{{ URL::asset('build/js/pages/dashboard.init.js') }}"></script>
@endsection
