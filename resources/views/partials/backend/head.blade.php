<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta -->
    {{-- <meta name="description" content="Responsive Bootstrap4 Dashboard Template">
    <meta name="author" content="ParkerThemes"> --}}
    <link rel="shortcut icon" href="{{ asset('assets/img/fav.png') }}" />
    <!-- Title -->
    <title>{{ env('APP_NAME') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    
    <!-- *************
        ************ Common Css Files *************
        ************ -->
    <!-- Bootstrap css -->
    @if(Request::routeIs(['reservation.edit', 'reservation.create']))

        <link rel="stylesheet" href="{{ asset('assets/form-wizard-only/fonts/fonts/font-awesome.min.css') }}">
        <!-- forn-wizard css-->
        <link href="{{ asset('assets/form-wizard-only/plugins/forn-wizard/css/material-bootstrap-wizard.css') }}" rel="stylesheet" />
        {{-- <link href="{{ asset('assets/form-wizard-only/plugins/forn-wizard/css/demo.css') }}" rel="stylesheet" /> --}}
        <!---Font icons-->
        <link href="{{ asset('assets/form-wizard-only/plugins/iconfonts/plugin.css') }}" rel="stylesheet" />

    @endif
        <link rel="stylesheet" href="{{ asset('assets/vendor/daterange/daterange.css') }}" />
    <!-- Icomoon Font Icons css -->
        
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    @stack('additionalCSS')


</head>