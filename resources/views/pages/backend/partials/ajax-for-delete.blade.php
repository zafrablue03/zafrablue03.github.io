<script>
    $(document).ready(function() {
        $(document).on('click', '.button-delete', function(event) {
            event.preventDefault();
            var slug = $(this).attr('slug')

            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                $.ajax({
                    url: "{{ url()->current() }}/"+slug,
                    type: 'DELETE',
                    data: {
                        '_token': "{{ csrf_token() }}"
                    },
                })
                .done(function(data) {
                    Swal.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    )
                    location.reload();
                })
                .fail(function(xhr,status,error) {
                    console.log(xhr.responseText);
                });
                
              }
            })
        }); 
    });
</script>