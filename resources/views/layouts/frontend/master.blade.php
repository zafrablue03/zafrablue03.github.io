<!DOCTYPE html>
<html lang="en">

@include('partials.frontend.head')
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<body id="page-top">

  <!-- Navigation -->
    @include('partials.frontend.navigation')

    {{-- Body --}}
    @if(Request::routeIs(['gallery','reservation']))
      @yield('reservation')
      @yield('gallery')
    @else
      <!-- Header -->
      @include('partials.frontend.header')
      @yield('content')
      {{-- Modals --}}
      @include('partials.frontend.modals')
    @endif
    

    @include('partials.frontend.contact-us')

    <!-- Footer -->
    @include('partials.frontend.footer')

    @include('sweetalert::alert')
    {{-- Javascripts --}}
    @include('partials.frontend.javascripts')

</body>

</html>
