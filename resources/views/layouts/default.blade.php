<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
	<link href='https://fonts.googleapis.com/css?family=Rosarivo:400,400italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title') &middot; Vinfo</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/selectize/selectize.bootstrap-paper.css') }}">
	@yield('styles')

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	@include('partials/nav')
	<div class="container">
		<h4 class="page-header">
			@yield('title')
			<small>@yield('subtitle')</small>
		</h4>
		@include('partials/alerts')
		@yield('content')
	</div>

	@yield('modals')
	@include('partials/footer')

	<!-- jQuery -->
	<script src="//code.jquery.com/jquery.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src="{{ asset('vendor/selectize/selectize.min.js') }}"></script>
	<script>
		function base_url(path) {
			return '{{ url('/') }}/'+path.trim('/');	
		} 
	</script>
	<script src="{{ asset('js/script.js') }}"></script>
	@yield('scripts')
</body>
</html>