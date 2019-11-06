<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>{{ env('APP_NAME') }}</title>
    
    <!-- Bootstrap core CSS -->
    
    <link href="{{ asset('assets/frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="{{ asset('assets/frontend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merienda+One' rel='stylesheet' type='text/css'>

    {{-- Select picker --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/bs-select/bs-select.css') }}" />


    {{-- Datepicker --}}
    <link href="{{ asset('assets/frontend/vendor/datepicker/datepicker.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/frontend/css/agency.min.css') }}" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }
        
        .column {
            float: left;
            width: 33.33%;
            padding: 5px;
        }
        
        /* Clearfix (clear floats) */
        .row::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
    <style>
            h1.menu-heading {
                font: 400 100px/1.2 'Merienda One', Helvetica, sans-serif;
                font-size: 45px;
                color: #8ac318;
            }
            body h1 {
                /* font-family: 'Old Standard TT', serif !important; */
                letter-spacing: -5px;
            }
            h1 {
                margin: 0 0 15px;
                display: block;
                margin-inline-start: 0px;
                margin-inline-end: 0px;
            }
            h2.sub-heading {
                letter-spacing: -1px;
                text-transform: uppercase;
                color: #f3a615;
                margin-top: -5px;
            }
        </style>
        @stack('additionalCSS')

    
</head>