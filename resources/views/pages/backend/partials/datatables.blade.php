<script src="{{ asset('assets/vendor/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap.min.js') }}"></script>

<!-- Custom Data tables -->
{{-- <script src="{{ asset('assets/vendor/datatables/custom/custom-datatables.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/custom/fixedHeader.js') }}"></script> --}}
<script>
    $(function(e) {
        $('#datatables').DataTable();
    } );
</script>

<script>
    $(function(e) {
        $('#pending-reservations').DataTable({
            "order": [[ 6, "desc" ]]
        });
    } );
</script>
<script>
    $(function(e) {
        $('#approved-reservations').DataTable();
    } );
</script>