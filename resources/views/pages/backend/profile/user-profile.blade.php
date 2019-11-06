@extends('layouts.backend.master')

@push('additionalCSS')
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs4.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs4-custom.css') }}" />
<style>
    .card-profile-img {
        max-width: 6rem;
        margin-bottom: 1rem;
        border: 3px solid #fff;
        border-radius: 100%;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    }

    .status-icon {
        content: '';
        width: 0.5rem;
        height: 0.5rem;
        display: inline-block;
        background: currentColor;
        border-radius: 50%;
        transform: translateY(-1px);
        margin-right: .375rem;
        vertical-align: middle;
    }
    .bg-success {
        background-color: #4ecc48 !important;
    }
    .bg-danger {
        background-color: #c21a1a !important;
    }
    .bg-warning {
        background-color: #ecb403 !important;
    }
</style>
@endpush
@push('additionalJS')
    @include('pages.backend.partials.datatables')
    @if (count($errors) > 0)
        <script>
            $(function() {
                $( "#modalAddStaffForm" ).modal('show');
            });
        </script>
    @endif
@endpush
@section('content')
    
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-profile "  style="background-image: url({{ asset('assets/img/listing-bg.png') }}); background-position: center; background-size:cover;">
                    <div class="card-body text-center">
                        <img class="card-profile-img" src="{{ $user->profile->image }}">
                        <h3 class="mb-3 text-white">{{ $user->name }}</h3>
                        <p class="mb-4 text-white">{{ $user->profile->title }}</p>
                        <p><span class="badge badge-pill badge-success">{{ $user->is_owner ? 'Administrator' : 'Staff' }}</span></p><br><br>
                        <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Edit profile</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-5 ">
                    <div class="card-title">
                        Sites &amp; Social Media
                    </div>
                    <div class="media-list">
                        <div class="media mt-1 pb-2">
                            <div class="mediaicon">
                                <i class="icon-mail" aria-hidden="true"></i>
                            </div>
                            <div class="media-body ml-5 mt-1">
                                <h6 class="mediafont text-dark">Email Address</h6><span class="d-block">{{ $user->email }}</span>
                            </div>
                            <!-- media-body -->
                        </div>
                        <!-- media -->
                        <div class="media mt-1 pb-2">
                            <div class="mediaicon">
                                <i class="icon-twitter" aria-hidden="true"></i>
                            </div>
                            <div class="media-body ml-5 mt-1">
                                <h6 class="mediafont text-dark">Twitter</h6><a class="d-block" href="{{ $user->profile->twitter }}">@ {{ $user->name }}</a>
                            </div>
                        </div>
                        <div class="media mt-1 pb-2">
                            <div class="mediaicon">
                                <i class="icon-facebook" aria-hidden="true"></i>
                            </div>
                            <div class="media-body ml-5 mt-1">
                                <h6 class="mediafont text-dark">Facebook</h6><a class="d-block" href="{{ $user->profile->facebook }}">@ {{ $user->name }}</a>
                            </div>
                        </div>
                        <div class="media mt-1 pb-2">
                            <div class="mediaicon">
                                <i class="icon-instagram" aria-hidden="true"></i>
                            </div>
                            <div class="media-body ml-5 mt-1">
                                <h6 class="mediafont text-dark">Instagram</h6><a class="d-block" href="{{ $user->profile->instagram }}">@ {{ $user->name }}</a>
                            </div>
                        </div>
                    </div>
                    <!-- media-list -->
                </div>

            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class=" " id="profile-log-switch">
                            <div class="fade show active " >
                                <div class="table-responsive border pt-4 pb-4">
                                    <table class="table row table-borderless w-100 m-0">
                                        <tbody class="col-lg-6 p-0">
                                            <tr>
                                                <td><strong>Full Name :</strong> {{ $user->name }}</td>
                                            </tr>
                                        </tbody>
                                        <tbody class="col-lg-6 p-0">
                                            <tr>
                                                <td><strong>Email :</strong> {{ $user->email }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row mt-5 profie-img">
                                    <div class="col-md-12">
                                        <div class="media-heading">
                                        <h5><strong>About</strong></h5>
                                    </div>
                                    {!! $user->profile->about ?? '<p> nothing to view </p>'!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('pages.backend.profile.add-staff-modal')
            @if(auth()->user()->isOwner())
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">My Staff(s)</h3>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="daterange-container pr-5">
                            <a href="" class="btn btn-secondary btn-rounded mb-4" data-toggle="modal" data-target="#modalAddStaffForm">
                                Add new Staff
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatables" class="table m-0">
                                <thead>
                                    <tr>
                                        <th>Staff ID:</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date staff added</th>
                                        @if($user->is_owner)
                                        <th>Feature to team</th>
                                        <th>Status</th>
                                        @endif
                                        <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    @if($user->is_owner == true) 
                                        @continue 
                                    @endif
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->toFormattedDateString() }}</td>
                                            <td>
                                                <form action="{{ route('feature.staff', $user->id) }}" method="POST">
                                                    @csrf
                                                    @php
                                                        $featured = $user->is_featured_to_team;
                                                        $admin = $user->is_admin;
                                                    @endphp
                                                    <button class="btn {{ $featured ? 'btn-success' : 'btn-light' }} btn-rounded" 
                                                    type="submit" name="action" value="feature" {{ $admin ? '' : 'disabled' }}>
                                                        {{ $featured ? 'Featured' : 'Feature to Team'}}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('feature.staff', $user->id) }}" method="POST">
                                                    @csrf
                                                    @php
                                                        $admin = $user->is_admin;
                                                    @endphp
                                                    <button class="btn {{ $admin ? 'btn-success' : 'btn-outline-success' }} btn-rounded" 
                                                    type="submit" name="action" value="admin">
                                                        {{ $admin ? 'Admin' : 'Make admin'}}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('delete.staff', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this item>');">
                                                        <i class="icon-trash"></i> Remove
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Recent Customer</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter border text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Service</th>
                                        <th>Setting</th>
                                        <th>Number of Pax</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations->take(6) as $reservation)
                                        <tr>
                                            <td><a href="{{ route('reservation.show', $reservation->id) }}" target="_blank" class="text-inherit">{{ $reservation->name }}</a></td>
                                            <td>{{ Carbon\Carbon::parse($reservation->date)->toFormattedDateString() }}</td>
                                            <td>
                                                @php
                                                    $now = Carbon\Carbon::now();
                                                @endphp
                                                @if($reservation->eventDate() > $now )
                                                    <span class="badge badge-warning">Upcoming</span>
                                                @elseif($reservation->eventDate() < $now)
                                                    <span class="badge badge-danger">Over</span>
                                                @elseif($reservation->eventDate() == $now)
                                                    <span class="badge badge-success">On Going</span>
                                                @endif
                                            </td>
                                            <td>{{ $reservation->service->name ?? '' }}</td>
                                            <td>{{ $reservation->setting->name ?? '' }}</td>
                                            <td>{{ $reservation->pax }}</td>
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

@endsection