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

    <!-- Core default css-->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/
    css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

    <link href="https://fonts.googleapis.com/
    css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

    <link href="{{ asset('css/material-dashboard.css?v=2.0.0') }}" rel="stylesheet">
</head>
<body class="">
	<div class="spinner-wrapper">
		<div class="spinner">
	  	<div class="bounce1"></div>
	  	<div class="bounce2"></div>
	  	<div class="bounce3"></div>
		</div>
	</div>
	<div class="wrapper">
		<main class="py-4">
			@yield('mainpanel')
		</main>
	</div>
	
</body>
</html>