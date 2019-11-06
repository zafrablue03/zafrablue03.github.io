@extends('layouts.frontend.master')

@section('reservation')

@php
    $services = App\Service::get();
@endphp
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <h2 class="section-heading text-uppercase">Reservation</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h3 class="mb-0 card-title">
                                </h3> --}}
                                <span class="badge badge-pill badge-success"><small>Available</small></span>
                                <span class="badge badge-pill badge-danger"><small>Fully Booked</small></span>
                        </div>
                        <div class="card-body">
                            <div id='calendar1'></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-12 col-md-12">
                    <div class="modal-body">
                    <!-- Project Details Go Here -->
                        <div class="container">
                            <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                                <h1 class="menu-heading">Reservations</h1>
                                <h5 class="section-subheading text-muted">Experience quality food, excellent service, and affordable prices for your Catering needs.</h5>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <form action="{{ route('reservations.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                                        <div class="form-group">
                                                            <label for="date">Choose the date</label>
                                                            <input class="form-control @error('date') is-invalid @enderror" name="date" type='text' id="date" placeholder="yyyy-mm-dd" readonly 
                                                            required="required" data-validation-required-message="Please enter the target date." value="{{ old('date') }}">
                                                            @error('date')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <p class="help-block text-danger"></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                                        <div class="form-group">
                                                            <label for="menu">Choose a Service</label>
                                                            <select class="form-control selectpicker @error('service_id') is-invalid @enderror" data-style="btn-info" name="service_id" required>
                                                                <option selected disabled>Select Service</option>
                                                                @foreach( $services->pluck('name','id') as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('service_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <p class="help-block text-danger"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="form-label" style="float:left">Name <small>(required*)</small></label>
                                                    <input class="form-control @error('name') is-invalid @enderror" name="name" id="name" type="text" placeholder="Name" 
                                                    required="required" data-validation-required-message="Please enter your name." value="{{ old('name') }}">
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <p class="help-block text-danger"></p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="venue" class="form-label" style="float:left">Venue <small></small></label>
                                                    <input class="form-control @error('venue') is-invalid @enderror" name="venue" id="venue" type="text" placeholder="Venue" 
                                                    required="required" value="{{ old('venue') }}">
                                                    @error('venue')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <p class="help-block text-danger"></p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="form-label" style="float:left">Email <small>(required*)</small></label>
                                                    <input class="form-control @error('email') is-invalid @enderror" name="email" id="email" type="email" placeholder="Email Address" 
                                                    required="required" data-validation-required-message="Please enter your email address." value="{{ old('email') }}">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <p class="help-block text-danger"></p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 col-md-6 col-sm-6 col-xs-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label for="phone" class="form-label" style="float:left">Contact Number <small>(required*)</small></label>
                                                            <input class="form-control @error('contact') is-invalid @enderror" name="contact" id="phone" type="text" placeholder="Contact Number" 
                                                            required="required" data-validation-required-message="Please enter your phone number." value="{{ old('contact') }}">
                                                            @error('contact')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <p class="help-block text-danger"></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6 col-xs-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label for="phone" class="form-label" style="float:left">Number of Pax <small>(required*)</small></label>
                                                            <input class="form-control @error('pax') is-invalid @enderror" name="pax" id="pax" type="number" 
                                                            min="1.00" max="999.00" step="0.01"placeholder="Total Pax" 
                                                            required="required" data-validation-required-message="Please enter total number of pax." value="{{ old('pax') }}">
                                                            @error('pax')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <p class="help-block text-danger"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="10" cols="30" id="message" placeholder="Your Message *" 
                                                    data-validation-required-message="Please enter a message.">{{ old('message') }}</textarea>
                                                    @error('message')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <p class="help-block text-danger"></p>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                                            <div id="success"></div>
                                            <button class="btn btn-primary btn-xl text-uppercase" type="submit">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="#top" id="back-to-top" style="display: inline;"><i class="fa fa-angle-up"></i></a>
@endsection


@push('additionalCSS')            
    <link href="{{ asset('assets/frontend/css/dashboard.css') }}" rel="stylesheet" />
    <!---Font icons-->
    <link href="{{ asset('assets/frontend/plugins/iconfonts/plugin.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/calendar/css/fullcalendar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/calendar/css/custom-calendar.css') }}" />
@endpush

@push('additionalJS')
<script src="{{ asset('assets/frontend/vendor/datepicker/datepicker.js') }}"></script>
@include('partials.frontend.fullcalendar')
<script>
    $(function() {
        var date = new Date();
        $( "#date" ).datepicker({
            'startDate': date,
            'format': 'yyyy-mm-dd',
            'autoclose': true,
            'todayHighlight': true
        });
    });
</script>
@endpush