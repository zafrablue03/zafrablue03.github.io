
<header class="header">
    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-6">
            <a href="{{route('admin')}}" class="logo">Triple E Gourmet Catering Services</a>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-6 col-sm-6 col-6">
            <!-- Header actions start -->
            <ul class="header-actions">
                <li class="dropdown d-none d-sm-block">
                    <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                        @php
                            $auth = auth()->user();
                            $pending_reservation = App\Reservation::whereIsApproved(false)->get();
                        @endphp
                        <img src="{{ asset('assets/img/notification.svg') }}" alt="notifications" class="list-icon" />
                        @if(count($pending_reservation) > 0)
                            <span class="badge badge-danger badge-pill">{{ $pending_reservation->count() }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu lrg" aria-labelledby="notifications">
                        <div class="dropdown-menu-header">
                            <h5>Reservations</h5>
                            <p class="m-0 sub-title">You have {{ $pending_reservation->count() }} pending reservation/s</p>
                        </div>
                        <ul class="header-notifications">
                            <li>
                                @if(!empty($pending_reservation))
                                    @foreach ($pending_reservation->take(5) as $pending)
                                        <a href="{{ route('reservation.edit',$pending->id) }}" class="clearfix">
                                            <div class="avatar">
                                                <img src="{{ asset('assets/img/user.png') }}" alt="avatar" />
                                            </div>
                                            <div class="details">
                                                <h6>{{ ucfirst($pending->name) }}</h6>
                                                <p>{{ $pending->eventDate()->toFormattedDateString() }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif
                            </li>
                        </ul>
                    </div>
                </li>
                @auth
                <li class="dropdown">
                    <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                        <span class="user-name">{{ auth()->user()->name }}</span>

                        <span class="avatar">{{ auth()->user()->getInitials() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
                        <div class="header-profile-actions">
                            <div class="header-user-profile">
                                <div class="header-user">
                                    <img src="{{ auth()->user()->profile->image }}" alt="Reatil Admin" />
                                </div>
                                <h5>{{ auth()->user()->name }}</h5>
                                <p>{{ auth()->user()->profile->title }}</p>
                            </div>
                            <a href="{{ route('profile.index') }}"><i class="icon-user1"></i> My Profile</a>
                            <a href="{{ route('logout') }}" 
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" >
                                <i class="icon-log-out1"></i> 
                                Sign Out
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
                @endauth
            </ul>						
            <!-- Header actions end -->
        </div>
    </div>
    <!-- Row end -->
</header>