<script src="{{ asset('assets/vendor/calendar/js/fullcalendar.min.js') }}"></script>
<script>
 $(function() {
 	"use strict";
 	$('#calendar1').fullCalendar({
 		header: {
 			left: 'prev,next today',
 			center: 'title',
 			right: 'month,agendaWeek,agendaDay'
 		},
		eventRender: function(event, eventElement) {
		if (event.imageurl) {
			eventElement.find("div.fc-content").prepend("<img src='" + event.imageurl +"' width='16' height='16'>");
			}
		},
 		navLinks: true, // can click day/week names to navigate views
 		selectable: false,
 		selectHelper: true,
 		select: function(start, end) {
 			var title = prompt('Event Title:');
 			var eventData;
 			if (title) {
 				eventData = {
 					title: title,
 					start: start,
 					end: end
 				};
 				$('#calendar1').fullCalendar('renderEvent', eventData, true); // stick? = true
 			}
 			$('#calendar1').fullCalendar('unselect');
 		},
 		editable: true,
 		eventLimit: true, // allow "more" link when too many events
 		events: [
			@php
				$reservations = App\Reservation::whereIsApproved(true)->get();
			@endphp
			@if(!empty($reservations))
				@foreach($reservations as $reservation)
					@if($reservation->payment)
					{
						@php
							//   $colors = ['#67caf0', '#80bcdc', '#fd7274', '#a5ca7b', '#f68d60', '#f9be52', '#ff8087', '#ac92ec', '#41ca94', '#ffb445', '#89bf52', '#00b894'];
							//   $randomColors = array_rand($colors);
								$now = Carbon\Carbon::now();
								$color = $reservation->eventDate() < $now ? 'darkgrey' : 'limegreen';
								$is_over = $reservation->eventDate() < $now ? '(Over)' : '';
						@endphp
						title: '{{ $reservation->service->name }} - {{ $reservation->name }} {{ $is_over }}',
						start: '{{ $reservation->date }} {{ $reservation->time }}',
						color: '{{ $color }}',
						url: '{{ route('reservation.show', $reservation->id) }}',
						imageurl: '{{ $reservation->service->thumbnail }}'
					},
					@endif
				@endforeach
			@endif
    ]
 	}); 	
});
</script>