
<!-- Modals -->

{{-- Reservation --}}

<div class="portfolio-modal modal fade" id="reservation" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
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
</div>

    <!-- Modal 1 -->

@foreach($services as $service)
<div class="portfolio-modal modal fade" id="modal{{ $service->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
            <div class="rl"></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="modal-body">
                        <!-- Project Details Go Here -->
                        <h2 class="text-uppercase">{{ $service->name }}</h2>
                        
                        <img class="img-fluid d-block mx-auto" src="{{ $service->image }}" alt="">
                        <p class="item-intro text-muted">{{ $service->description }}</p>
                        {{-- <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                        <ul class="list-inline">
                            <li>Date: January 2017</li>
                            <li>Client: Threads</li>
                            <li>Category: Illustration</li>
                        </ul> --}}
                        
                    </div>
                </div>

                <hr>
                @php
                    $sets = App\Setting::get();
                    $inclusion = App\Inclusion::whereIsActive(true)->first();
                    $types = App\Type::get();
                @endphp
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="row">
                    @if(!empty($sets))
                        @foreach ($sets as $set)
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <h1 class="menu-heading">{{ ucfirst($set->name) }}</h1>
                                <h2 class="sub-heading" style="font-size: 16px;">P{{ $set->price }}/Head</h2>
                                <small class="text-muted">only 1 per each</small>
                                <ul class="list-inline">
                                    @foreach ($set->types as $type)
                                        <li>{{ $type->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    @endif
                    </div>
                </div>

                <hr>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h2 class="sub-heading" style="font-size: 30px;">Menus</h2>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="row">
                        @if(!empty($types))
                            @foreach ($types as $type)
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-3">
                                    <h5>{{ $type->name }}</h5>
                                    <ul class="list-inline">
                                        @foreach ($type->courses as $course)
                                            <li><small class="text-muted">{{ $course->name }}</small></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                @if(!empty($inclusion))
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h2 class="sub-heading" style="font-size: 30px;">Inclusions and Amenities</h2>
                    <ul class="list-inline">
                        
                        @foreach ($inclusion->features as $feature)
                            <li>{{ $feature->name }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
            </div>
            <button class="btn btn-primary" data-dismiss="modal" type="button">
                <i class="fas fa-times"></i>
                    Close Project
            </button>
        </div>
        </div>
    </div>
</div>
@endforeach

@push('additionalJS')
<script src="{{ asset('assets/frontend/vendor/datepicker/datepicker.js') }}"></script>
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