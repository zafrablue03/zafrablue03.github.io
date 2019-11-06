<div>
    <div class="row">
        <div class="col-xs-7">
            <h4>From:</h4>
            <strong>Triple E Catering Services</strong>
            <br> Poblacion, Clarin, Bohol
            <br> P: (038) 509-9063
            <br> E: jheyceq05@yahoo.com
            <br>

            <br>
        </div>

        <div class="col-xs-4">
            <h4><strong>Triple E Catering Services</strong></h4>
        </div>
    </div>

    <div style="margin-bottom: 0px">&nbsp;</div>

    <div class="row">
        <div class="col-xs-6">
            <h4>To:</h4>
            <address>
            <span>{{ $reservation->name }}</span><br>
            <span>{{ $reservation->email }}</span><br>
            <strong>Venue:</strong><br>
            <span>{{ $reservation->venue }}</span> <br>
            <span>{{ $reservation->eventDate()->toFormattedDateString() }} {{ $reservation->time }}</span> <br>
            <span>{{ $reservation->contact }}</span>
        </address>
        </div>

        <div class="col-xs-5">
            <table style="width: 100%">
                <tbody>
                    <tr>
                        <th>Total Pax:</th>
                        <td class="text-right">{{ $reservation->pax }}</td>
                    </tr>
                    <tr>
                        <th>Setting Price:</th>
                        <td class="text-right">{{ $reservation->setting->description }}</td>
                    </tr>
                    <tr>
                        <th> Transportation Fee:</th>
                        <td class="text-right">{{ number_format($reservation->payment->transportation_charge) }}</td>
                    </tr>
                    <tr>
                        <th> Total Payable:</th>
                        <td class="text-right">{{ number_format($reservation->payment->payable) }}</td>
                    </tr>
                    <tr>
                        <th> Payment/Down Payment:</th>
                        <td class="text-right">{{ number_format($reservation->payment->payment) }}</td>
                    </tr>
                    {{-- <tr>
                        <th> Date: </th>
                        <td class="text-right">{{ $date }}</td>
                    </tr> --}}
                </tbody>
            </table>

            <div style="margin-bottom: 0px">&nbsp;</div>

            <table style="width: 100%; margin-bottom: 20px">
                <tbody>
                    <tr class="well" style="padding: 5px">
                        <th style="padding: 5px">
                            <div>Balance: </div>
                        </th>
                        <td style="padding: 5px" class="text-right"><strong> P{{ number_format($reservation->payment->balance) }} </strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <table class="table">
        <thead style="background: #F5F5F5;">
            <tr>
                <th>Item List</th>
                <th></th>
                <th class="text-right">Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div><strong>Service</strong></div>
                    <p>{{ $reservation->service->name }}</p><br>
                    <p>{{ $reservation->service->description }}</p>
                </td>
                <td></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td>
                    <div><strong>Setting</strong></div>
                    <p>{{ $reservation->setting->name }}</p>
                    <p>{{ $reservation->setting->description }}</p>
                </td>
                <td></td>
                <td class="text-right"> P{{ $reservation->setting->price }}</td>
            </tr>
            <tr>
                <td>
                    <div><strong>Inclusion</strong></div>
                    @if(!empty($inclusion->features))
                        @foreach($inclusion->features as $feature)
                            {{ $loop->first ? '' : ',' }}
                            {{ $feature->name }}
                        @endforeach
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="col-xs-6"></div>
        <div class="col-xs-5">
            <table style="width: 100%">
                <tbody>
                    <tr class="well" style="padding: 5px">
                        <th style="padding: 5px">
                            <div> Balance: </div>
                        </th>
                        <td style="padding: 5px" class="text-right"><strong> P{{ number_format($reservation->payment->balance) }} </strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-bottom: 0px">&nbsp;</div>
    Thank you for your business.
    <div class="row">
        <div class="col-xs-4 invbody-terms text-center">
            <br>
            <br>
            <br>
            <br>
            <h4>{{ $reservation->name }}</h4>
            <small>Signature over printed name</small>
            <h5>Customer</h5>
        </div>
        <div class="col-xs-4 invbody-terms text-center" style="float:right">
            <br>
            <br>
            <br>
            <br>
            <h4>Jhey-r Alima Cequina</h4>
            <small>Signature over printed name</small>
            <h5>Owner</h5>
        </div>
    </div>
</div>