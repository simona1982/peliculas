<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>
	
	<!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

	<!-- Simple splash screen-->
	<div class="splash"> <div class="color-line"></div><div class="splash-title"><h1>Homer - Responsive Admin Theme</h1><p>Special AngularJS Admin Theme for small and medium webapp with very clean and aesthetic style and feel. </p><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>
	<!--[if lt IE 7]>
	<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<div id="app">
		<!-- Header -->
		<div id="header">
			@include('layouts.partials.dashboard.header')
		</div>

		<!-- Navigation -->
		<aside id="menu">
			@include('layouts.partials.dashboard.navigation')
		</aside>

		<!-- Main Wrapper -->
		<div id="wrapper">
			
			@yield('title')

			<div class="content animate-panel">
				@yield('content')
			</div>

			<!-- Footer-->
		    <footer class="footer">
		        @include('layouts.partials.dashboard.footer')
		    </footer>
		</div>
	</div>

	<script src="{{ asset('/js/app.js') }}"></script>

	@stack('scripts')
	
</body>
</html>