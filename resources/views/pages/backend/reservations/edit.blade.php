@extends('layouts.backend.master')

@push('additionalCSS')
<link href="{{ asset('assets/vendor/datepicker/datepicker.css') }}" rel="stylesheet">
    <style>
    [type=radio] { 
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* IMAGE STYLES */
    [type=radio] + img {
        cursor: pointer;
    }

    /* CHECKED STYLES */
    [type=radio]:checked + img {
        outline: 2px solid #f00;
    }
    </style>
@endpush

@push('additionalJS')
<script>
    $('.type').hide();
    // find elements
    var choiceObj = $(".choice");
    // handle click and add class
    choiceObj.on("click", function(){
        radioBtnValue = $(this).find("input[id='sets']").val();
        var targetDiv = $(".set_" + radioBtnValue);
        $(".card.type").not(targetDiv).hide();
        $(targetDiv).show();
    })
</script>
<script src="{{ asset('assets/vendor/datepicker/datepicker.js') }}"></script>
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
                    <li class="breadcrumb-item active" aria-current="page">Manage Reservation</li>
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
                        <div class="card-title"> Manage Reservation</div>
                    </div>
                    <div class="card-body p-12">
                        <div class="wizard-container">
                            <div class="wizard-card m-0" data-color="red" id="wizardProfile">
                                <form action="{{ route('reservation.update', $reservation->id) }}" method="POST">
                                    @csrf
                                    {{ method_field('PUT') }}
                                    <div class="wizard-navigation">
                                        <ul>
                                            <li><a href="#firstTab" data-toggle="tab">Customer Details</a></li></a></li>
                                            <li><a href="#secondTab" data-toggle="tab">Service</a></li>
                                            <li><a href="#thirdTab" data-toggle="tab">Menus and Sets</a></li>
                                        </ul>
                                    </div>
                
                                    <div class="tab-content">

                                        <div class="tab-pane" id="firstTab">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="input-group">
                
                                                                <div class="form-group label-floating">
                                                                    <label class="control-label">Name <small>(required)</small></label>
                                                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $reservation->name }}" required>
                                                                    @error('name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                    
                                                        <div class="col-sm-3">
                                                            <div class="input-group">
    
                                                                <div class="form-group label-floating">
                                                                    <label class="control-label">Contact # <small>(required)</small></label>
                                                                    <input name="contact" type="text" class="form-control @error('contact') is-invalid @enderror" value="{{ old('contact') ?? $reservation->contact }}" required>
                                                                </div>
                                                                @error('contact')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="input-group">
    
                                                                <div class="form-group label-floating">
                                                                    <label class="control-label">Email <small>(required)</small></label>
                                                                    <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ?? $reservation->email }}" required>
                                                                </div>
                                                                @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
    
    
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="date">Choose the date(required)</label>
                                                                <input class="form-control @error('date') is-invalid @enderror" name="date" type='text' id="date" placeholder="yyyy-mm-dd" value="{{ old('date') ?? $reservation->date }}" 
                                                                required>
                                                                @error('date')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-2">
                                                            <div class="form-group">
                                                                <label for="time">Time <small>(required)</small></label>
                                                                <select name="time" class="form-control">
                                                                    @foreach ($datetimes as $key => $value)
                                                                        <option value="{{ $key }}">{{ $value }} ({{ $key }})</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
    
                                                        <div class="col-sm-5">
                                                            <div class="input-group">
                                                                <div class="form-group label-floating">
                                                                    <label class="control-label">Venue <small>(required)</small></label>
                                                                    <input name="venue" type="text" class="form-control @error('venue') is-invalid @enderror" value="{{ old('venue') ?? $reservation->venue }}" required>
                                                                    @error('venue')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="input-group">
    
                                                                <div class="form-group label-floating">
                                                                    <label class="control-label">Number of pax <small>(required)</small></label>
                                                                    <input name="pax" type="text" class="form-control @error('pax') is-invalid @enderror" value="{{ old('pax') ?? $reservation->pax }}" required>
                                                                </div>
                                                                @error('pax')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="tab-pane" id="secondTab">
                                            <h4 class="info-text"> Choose Service (radio button) </h4>
                                            <div class="row">
                                                @php 
                                                    $services = App\Service::get();
                                                @endphp
                                                @foreach($services as $service)
                                                    <div class="col-sm-4 pb-5">
                                                        <div  class="text-center">
                                                            <label>
                                                                <input type="radio" name="service_id" id="service" value="{{ $service->id }}" required>
                                                                <img src="{{ $service->thumbnail }}" class="w-50">
                                                                <h6>{{ $service->name }}</h6>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach


                                            </div>
                                        </div>

                                        <div class="tab-pane" id="thirdTab">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-12 pb-5">
                                                            <h4 class="info-text"> Choose desired set</h4>
                                                        </div>
                                                        @php
                                                            $sets = App\Setting::get();
                                                        @endphp

                                                        @foreach($sets as $set)
                                                            <div class="col-sm-4">
                                                                <div class="choice" data-toggle="wizard-radio">
                                                                    <input type="radio" name="set_id" value="{{ $set->id }}" id="sets" required>
                                                                    <div class="icon">
                                                                        <i class="fa fa-laptop"></i>
                                                                    </div>
                                                                    <h6>{{ $set->name }} (&#8369; {{ $set->description }})</h6>
                                                                    <ul>
                                                                        @foreach($set->types as $type)
                                                                            <li style="width:10em; float:left;"><small>&bull;{{ $type->name }}</small></li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="form-group">
                                                    <div class="col-sm-12 pb-4 pt-4">
                                                        <h3>Package of Choosen Set Includes: </h3>
                                                    </div>
                                                    <hr>
                                                    {{-- Loop Here --}}
                                                    {{-- Sets --}}
                                                    @foreach ($sets as $set)
                                                        <div class="card type set_{{ $set->id }}">
                                                            {{-- Set types --}}
                                                            @foreach($set->types as $type)
                                                                <div class="card-header">
                                                                    <div class="card-title">{{ $type->name }} <small>(choose one)</small></div>
                                                                </div>
                                                                <div class="card-body">
                                                                    {{-- Set type and courses --}}
                                                                    @foreach ($type->courses as $course)
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="{{ $set->slug }}_{{ $course->slug }}" name="course[][{{ $type->slug }}]" value="{{ $course->id }}" class="custom-control-input" required>
                                                                            <label class="custom-control-label" for="{{ $set->slug }}_{{ $course->slug }}">{{ $course->name }}</label>
                                                                        </div>
                                                                    @endforeach

                                                                </div>
                                                            @endforeach

                                                        </div>

                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="wizard-footer">
                                        <div class="pull-right">
                                            <input type='button' class='btn btn-next btn-fill btn-primary btn-wd m-0' name='next' value='Next' />
                                            <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd m-0' name='finish' value='Finish' />
                                        </div>
                
                                        <div class="pull-left">
                                            <input type='button' class='btn btn-previous btn-fill btn-default btn-wd m-0' name='previous' value='Previous' />
                                        </div>
                                        <div class="clearfix"></div>
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