<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')</title>
	
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<script src="{{ asset('js/app.js') }}" defer></script>

<!-- 	@section('head')
        @include('admin/partials/head')
    @show -->

    @yield('style')
    
</head>
<body class="">
	
	<div class="wrapper">

		<div class="sidebar" data-color="purple">
			
			@yield('sidebar')

		</div>	
		

		<main class="main-panel py-4">
			@yield('mainpanel')
			
		</main>

	</div>

	@include('admin/partials/scripts')

</body>
</html>