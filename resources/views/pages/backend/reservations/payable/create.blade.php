@extends('layouts.backend.master')

@push('additionalCSS')
<link rel="stylesheet" href="{{ asset('assets/css/pricing.css') }}">
@endpush

@section('content')

<div class="page-title">
    <div class="row gutters">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <h5 class="title">Reservations</h5>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="icon-area-graph"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('reservation.index') }}">Reservations</a></li>
                    <li class="breadcrumb-item active" aria-current="page">New Reservation</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="content-wrapper">
        <!-- Row start -->
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"> Adding Payments</div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                Reservation Details
                            </div>

                            <div class="card-body">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="pricing-plan">
                                        <div class="pricing-header">
                                            <h4 class="pricing-title">Service</h4>
                                            <div class="pricing-cost">{{ ucfirst($reservation->service->name) }}</div>
                                            <div class="pricing-save">Number of Pax: {{ $reservation->pax }}</div>
                                            <div class="pricing-save">Set name: {{ $reservation->setting->name }} - {{ $reservation->setting->description }}</div>
                                            @if($reservation->payment)
                                            @php
                                                $total = number_format($reservation->payment->payable,2);
                                                $balance = number_format($reservation->payment->balance,2);
                                                $paid = $reservation->payment->is_paid;
                                            @endphp
                                            <div class="pricing-save">Total: &#8369; {{ number_format($reservation->payment->payable, 2) }}
                                                 <small>(with transportation fee of &#8369;{{ number_format($reservation->payment->transportation_charge) }})</small>
                                            </div>
                                            <div class="pricing-save">{{ $paid ? 'Payment:' : 'Downpayment:'}} &#8369; {{ number_format($reservation->payment->payment, 2) }}</div>
                                            <div class="pricing-save">Balance: &#8369; {{ $balance }}</div>
                                            @else
                                            <div class="pricing-save">Total: &#8369; {{ number_format($reservation->payable(),2) .' + transportation fee'}}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Payments</div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('payable.store',$reservation->id) }}" method="POST">
                                    @csrf
                                    <div class="row gutters">
                                        @php
                                        //check if exist, true : false;
                                            $exists = $reservation->payment ? true : false;
                                        @endphp
                                        <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-6">
                                            <div class="form-group">
                                                <label for="inputName">Transportation Charge:</label>
                                                <input type="number" {{ $exists ? 'disabled' : '' }} class="form-control @error('transportation_charge') is-invalid @enderror" 
                                                min="0.00" max="5000.00" step="0.01" name="transportation_charge" required value="{{ old('value') }}" />
                                                <small id="passwordHelpBlock" class="form-text text-muted">
                                                    Areas within Tubigon and Inabanga are free of charge.
                                                </small>
                                                @error('transportation_charge')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-6">
                                            <div class="form-group">
                                                <label for="inputName">{{ $exists ? 'Fullpayment' : 'Payment/DownPayment' }}:</label>
                                                <input type="number" class="form-control @error('payment') is-invalid @enderror" 
                                                min="0.00" max="1000000.00" step="0.01" name="payment" required value="{{ old('value') }}" />
                                                @error('payment')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" name="action" value="{{ $exists ? 'update' : 'create'}}" class="btn btn-info" style="float:right">Submit</button>
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

@endsection