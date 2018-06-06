<!DOCTYPE html>
<html>
<head>
	@includeIf('user/partials/head')
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
		<main class="main-panel py-4">
			@yield('mainpanel')
		</main>
	</div>
	<script src="{{ asset('js/app.js') }}" defer></script>
	@includeIf('user/partials/scripts')

	<script type="text/javascript">
		$(document).ready(function(e) {
			$('input').addClass('form-control')
		});
	</script>
</body>
</html>