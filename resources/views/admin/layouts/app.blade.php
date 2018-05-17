<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')</title>

	@include('admin/partials/head')

</head>
<body class="">
	
	<div class="wrapper">

		<div class="sidebar" data-color="purple">
		
			@include('admin/partials/sidebar')

		</div>

		@include('admin/partials/mainpanel')
	</div>


	@include('admin/partials/scripts')

</body>
</html>