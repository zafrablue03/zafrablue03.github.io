@extends('layouts.backend.master')

@push('additionalCSS')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs4.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs4-custom.css') }}" />
@endpush

@push('additionalJS')
    @include('pages.backend.partials.datatables')
@endpush

@section('content')

<div class="page-title">
    <div class="row gutters">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <h5 class="title">Reservations</h5>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="daterange-container pr-5">
                <a class="btn btn-secondary btn-rounded" href="{{ route('reservation.create') }}"><span class="icon-add"></span>New Reservation</a>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="icon-area-graph"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reservations</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
    
<div class="content-wrapper">
    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="card custom-default">
                <div class="card-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending Reservations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="approved-tab" data-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="false">Approved Reservations</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body pt-0">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">

                            <div class="card">
                                <div class="card-header">
                                    <h3> <span class="badge badge-danger">Pending Reservations</span></h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="pending-reservations" class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                    <th>Venue</th>
                                                    <th>Event Date</th>
                                                    <th>Date of reservation</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pending_reservations as $pending)
                                                <tr>
                                                    <td>{{ $pending->id }}</td>
                                                    <td>{{ $pending->name }}</td>
                                                    <td>{{ $pending->email }}</td>
                                                    <td>{{ $pending->contact }}</td>
                                                    <td>{{ $pending->venue }}</td>
                                                    <td>{{ $pending->date }}</td>
                                                    {{-- <td>{{ str_limit($pending->message, $limit=50, $end="...") }}</td> --}}
                                                    <td>{{ $pending->created_at->diffForHumans() }}({{ $pending->created_at->toFormattedDateString() }})</td>
                                                    {{-- <td><span class="badge badge-danger">Pending</span></td> --}}
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown">
                                                                <i class="fa fa-cogs mr-2"></i>Actions
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @php
                                                                    $over = $now < $pending->eventDate();
                                                                @endphp
                                                                @if($over)
                                                                    <a class="dropdown-item" {{ $over ? 'disabled' : '' }} 
                                                                    href="{{ route('reservation.edit', $pending->id) }}">Manage reservation</a>
                                                                    <form action="{{ route('reservation.destroy', $pending->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" name="action" value="delete" class="dropdown-item" onclick="return confirm('Are you sure about this?');">Delete</button>
                                                                    </form>
                                                                @else
                                                                <small class="text-muted dropdown-item" aria-readonly="true">Event date is over!</small>
                                                                <form action="{{ route('reservation.destroy', $pending->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" name="action" value="delete" class="dropdown-item" onclick="return confirm('Are you sure about this?');">Delete</button>
                                                                </form>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3><h3> <span class="badge badge-success">Approved Reservations</span></h3></h3>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="approved-reservations" class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                    <th>Service</th>
                                                    <th>Status</th>
                                                    <th>Payment</th>
                                                    <th>Date <a href="#" title="Cancellation of reservation will be unavailable if event date is less than two days!"><i class="icon-report"></i></a></th>
                                                    <th>Time</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($approved_reservations as $approved)
                                                <tr>
                                                    <td>{{ $approved->id }}</td>
                                                    <td>{{ $approved->name }}</td>
                                                    <td>{{ $approved->email }}</td>
                                                    <td>{{ $approved->contact }}</td>
                                                    <td>{{ $approved->service->name }}</td>
                                                    <td>
                                                        @if($approved->eventDate() > $now )
                                                            <span class="badge badge-warning">Upcoming</span>
                                                        @elseif($approved->eventDate() < $now)
                                                            <span class="badge badge-danger">Over</span>
                                                        @elseif($approved->eventDate() == $now)
                                                            <span class="badge badge-success">On Going</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($approved->payment)
                                                            @if($approved->payment->is_paid == true)
                                                                <span class="badge badge-success">Paid</span>
                                                            @else
                                                                <span class="badge badge-warning">Downpayment</span>
                                                            @endif
                                                        @else
                                                            <span class="badge badge-danger">To be reviewed</span>
                                                        @endif
                                                    </td>
                                                    @php
                                                        $date = $approved->eventDate();
                                                        $diffInDays = $now->diffInDays($date, false);
                                                        $year = $approved->eventDate()->year;
                                                    @endphp
                                                    <td>{{ $date->toFormattedDateString() }} <a href="#" title="Cancellation of reservation will be unavailable if event date is less than two days!"><i class="icon-report"></i></a></td>
                                                    <td>{{ $approved->time}}
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown">
                                                                <i class="fa fa-cogs mr-2"></i>Actions
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{ route('reservation.show', $approved->id) }}">View</a>
                                                                <form action="{{ route('reservation.destroy', $approved->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" name="approved" value="cancel" class="dropdown-item"
                                                                    @if(!($now->year == $year))
                                                                        disabled
                                                                        style="background:gray; color:grayish; cursor:default"
                                                                    @elseif( $diffInDays < 2 AND $date->month <= $now->month )
                                                                        disabled
                                                                        style="background:gray; color:grayish; cursor:default"
                                                                    @endif
                                                                    >Cancel</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                        <a href="{{ route('reservation.pdf', $approved->id) }}" class="btn btn-info" target="_blank"><i class="icon-export"></i>Export PDF</a>
                                                    </td> --}}
                                                </tr>
                                                @endforeach               
                                            </tbody>
                                        </table>
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

@endsection


