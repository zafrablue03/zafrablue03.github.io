
@if(Request::routeIs(['reservation.edit', 'reservation.create']))

    <script src="{{ asset('assets/form-wizard-only/js/vendors/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/form-wizard-only/js/vendors/bootstrap.bundle.min.js') }}"></script>
    <!-- forn-wizard js-->
    <script src="{{ asset('assets/form-wizard-only/plugins/forn-wizard/js/material-bootstrap-wizard.js') }}"></script>
    <script src="{{ asset('assets/form-wizard-only/plugins/forn-wizard/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/form-wizard-only/plugins/forn-wizard/js/jquery.bootstrap.js') }}"></script>

    <!-- Custom scroll bar Js-->
    <script src="{{ asset('assets/form-wizard-only/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Custom Js-->
    {{-- <script src="{{ asset('assets/form-wizard-only/js/custom.js') }}"></script> --}}

@else

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/nav.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.js') }}"></script>
    <!-- *************
            ************ Vendor Js Files *************
        ************* -->
    <!-- Daterange -->
    <script src="{{ asset('assets/vendor/daterange/daterange.js') }}"></script>
    <!-- Main Js Required -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

@endif

@stack('additionalJS')