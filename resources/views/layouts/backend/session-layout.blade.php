<!doctype html>
<html lang="en">

@include('partials.backend.head')

	<body class="authentication">
		
		<!-- Container start -->
		<div class="container">
			@yield('content')
		</div>
		<!-- Container end -->
        @include('partials.backend.javascripts')

	</body>

</html>