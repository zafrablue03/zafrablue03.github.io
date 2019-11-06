<nav class="navbar navbar-expand-lg custom-navbar">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#retailAdminNavbar" aria-controls="retailAdminNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
            <i></i>
            <i></i>
            <i></i>
        </span>
    </button>
    <div class="collapse navbar-collapse" id="retailAdminNavbar">
        <ul class="navbar-nav m-auto">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin') ? 'active-page': '' }}" href="{{ route('admin') }}">
                    <i class="icon-devices_other nav-icon"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('reservation*') ? 'active-page': '' }}" href="{{ route('reservation.index') }}">
                    <i class="icon-calendar nav-icon"></i>
                    Reservation
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::routeIs(['features*', 'inclusions*', 'services*']) ? 'active-page': '' }}" href="#" id="appsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-package nav-icon"></i>
                    Services
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="appsDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('services.index') }}">Services</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('inclusions.index') }}">Manage Inclusions</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('features.index') }}">Features</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::routeIs(['courses*', 'types*']) ? 'active-page': '' }}" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-local_bar nav-icon"></i>
                    Menus
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="formsDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('types.index') }}">Types</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('courses.index') }}">Courses</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::routeIs('settings*') ? 'active-page': '' }}" href="#" id="tablesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-shopping-bag1 nav-icon"></i>
                    Setting
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="tablesDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('settings.index') }}">Setting</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('gallery*') ? 'active-page': '' }}" href="{{ route('gallery.index') }}">
                    <i class="icon-camera2 nav-icon"></i>
                    Gallery
                </a>
            </li>
            {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="formsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-edit1 nav-icon"></i>
                    Reviews
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="formsDropdown">
                    <li>
                        <a class="dropdown-item" href="bs-select.html">BS Select</a>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </div>
</nav>