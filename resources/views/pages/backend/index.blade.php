@extends('layouts.backend.master')

@push('additionalCSS')
<link rel="stylesheet" href="{{ asset('assets/vendor/calendar/css/fullcalendar.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/calendar/css/custom-calendar.css') }}" />
@endpush

@push('additionalJS')
<!-- Apex Charts -->
<script src="{{ asset('assets/vendor/apex/apexcharts.min.js') }}"></script>

@include('pages.backend.partials.apexLineChartGradient')
@include('pages.backend.partials.ajax-dynamic-load-dashboard')
@include('pages.backend.partials.fullcalendar')

@endpush

@section('content')

    <!-- Page header start -->
    <div class="page-title">
        <div class="row gutters">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <h5 class="title">Welcome back, {{ auth()->user()->name }}</h5>
            </div>
        </div>
    </div>
    <!-- Page header end -->


    <!-- Content wrapper start -->
    <div class="content-wrapper">


        <!-- ************************** Visitors and Revenue ************************** -->
        <!-- Row start -->
        <div class="row gutters justify-content-center">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0 card-title">Reservation Event Calendar</h3>
                        </div>
                        <div class="card-body">
                            <div id='calendar1'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gutters justify-content-center">
            <h1 class="styled">Record as of Month 
                <select name="months" id="months" class="form-control">
                    @foreach ($months_array as $key => $months)
                        <option value="{{ $key }}">{{ $months }}</option>
                    @endforeach
                </select>
            </h1>
        </div>

        <div class="row gutters justify-content-center">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                
                <div class="daily-sales">
                    <h6>Customers</h6>
                    <h1 id="total_pax"></h1>
                    <p>No. of pax based on approved reservations</p>
                    <small class="text-muted">(varies when a reservation is canceled)</small>
                    <div id="apexLineChartGradient" class="blue-graph"></div>
                </div>

            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                
                <div class="daily-sales">
                    <h6>Revenue</h6>
                    <h1 id="revenue"></h1>
                    {{-- {{ number_format($revenue) }} --}}
                    <p>Revenue based on approved reservations</p>
                    <small class="text-muted pb-2">
                        (expected revenue for this month <strong id="expected"></strong>)
                        {{-- {{ number_format($expected_monthly_revenue) }} --}}
                    </small>
                    <br>
                    <small class="text-muted">(varies when a reservation is canceled)</small>
                    <div id="apexLineChartGradient2" class="red-graph"></div>
                </div>

            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                
                <div class="daily-sales">
                    <h6>Approved Reservations</h6>
                    <h1 id="approved"></h1>
                    <p>Total Approved Reservation</p>
                    <div id="apexLineChartGradient3" class="green-graph"></div>
                </div>

            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                
                <div class="daily-sales">
                    <h6>Pending Reservations</h6>
                    <h1 id="pending"></h1>
                    <p>Total Pending Reservation</p>
                    <div id="apexLineChartGradient4" class="lavandar-graph"></div>
                </div>

            </div>
        </div>
        <!-- Row end -->


        <!-- Row start -->
        <div class="row gutters justify-content-center">
            <div class="col-xl-11 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Services Sales this month</div>
                                <div class="card-sub-title">Overall Sales Revenue Performance of different Services.</div>
                            </div>
                            <div class="card-body btm-dr yellow pb-0">
                                <div class="dpt-sales">
                                    <div class="dpt-sales-header">
                                        <span class="dpt-sales-number" id="total_sales">
                                        </span>
                                    </div>
                                    <div id="apexSales" class="yellow-graph"></div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Monthly Total Pax</div>
                                <div class="card-sub-title">Overall pax per reservation by this month.</div>
                            </div>
                            <div class="card-body btm-dr yellow pb-0">
                                <div class="dpt-sales">
                                    <div class="dpt-sales-header">
                                        <span class="dpt-sales-number" id="pax">
                                        </span>
                                    </div>
                                    <div id="apexOrders" class="yellow-graph"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row end -->

    </div>
    <!-- Content wrapper end -->


</div>
@endsection