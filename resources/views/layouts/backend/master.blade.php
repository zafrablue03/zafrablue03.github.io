<!doctype html>
<html lang="en">


	@include('partials.backend.head')
	

	<body>

		<!-- Loading starts -->
		@if(Request::is('admin/index'))
			<div id="loading-wrapper">
				<div class="spinner-border text-apex-green" role="status">
					<span class="sr-only">Loading...</span>
				</div>
			</div>
		@endif
		<!-- Loading ends -->
	
		<div class="container">
			<!-- *************
				************ Header section start *************
				************* -->


			<!-- Header start -->
			@include('partials.backend.header')
			<!-- Header end -->



			<!-- Navigation start -->
			@include('partials.backend.navigation')
			<!-- Navigation end -->



			<!-- *************
				************ Main container start *************
				************* -->
				
			<div class="main-container">
				@yield('content')
			</div>
			<!-- *************
				************ Main container end *************
				************* -->


		</div>

		@include('sweetalert::alert')

		@include('partials.backend.javascripts')
		

	</body>

</html>