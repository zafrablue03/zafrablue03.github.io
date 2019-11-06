<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        @if(Request::routeIs(['gallery','reservation']))
            <a class="navbar-brand js-scroll-trigger" href="{{ route('home') }}">Triple E Gourmet and Catering Services</a>
        @else
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Triple E Gourmet and Catering Services</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#portfolio">Services</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#team">Team</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                    <a class="portfolio-link nav-link" href="{{route('reservation')}}">Reservations</a>
                    </li>
                </ul>
            </div>
        @endif
    </div>
</nav>