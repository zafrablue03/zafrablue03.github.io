<script src="{{ asset('assets/vendor/calendar/js/fullcalendar.min.js') }}"></script>
<script>
 $(function() {
 	"use strict";
 	$('#calendar1').fullCalendar({
 		header: {
 			left: 'prev,next today',
 			center: 'title',
 			right: 'month'
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
					@php
						$count_reservation = App\Reservation::whereIsApproved(true)->where('date', $reservation->eventDate())->count();
						$color = $count_reservation < 4 ? 'limegreen' : 'red';
					@endphp
					@if($reservation->payment)
						{
							title: '{{ $reservation->service->name }}',
							start: '{{ $reservation->date }}',
							color: '{{ $color }}'
						},
					@endif
				@endforeach
			@endif
    	]
 	}); 	
});
</script>