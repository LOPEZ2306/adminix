<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>@yield('title', 'Login')</title>

	<!-- Normalize V8.0.1 -->
	<link rel="stylesheet" href="{{ asset('css/normalize.css') }}">

	<!-- Bootstrap V4.3 -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

	<!-- Bootstrap Material Design V4.0 -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap-material-design.min.css') }}">

	<!-- Font Awesome V5.9.0 -->
	<link rel="stylesheet" href="{{ asset('css/all.css') }}">

	<!-- Sweet Alerts V8.13.0 CSS file -->
	<link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">

	<!-- jQuery Custom Content Scroller V3.1.5 -->
	<link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.css') }}">

	<!-- General Styles -->
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">

	<!-- Sweet Alert V8.13.0 JS file (cárgalo aquí si quieres que cargue primero) -->
	<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
</head>
<body>

	@yield('content')

	<!-- jQuery V3.4.1 -->
	<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>

	<!-- popper -->
	<script src="{{ asset('js/popper.min.js') }}"></script>

	<!-- Bootstrap V4.3 -->
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>

	<!-- jQuery Custom Content Scroller V3.1.5 -->
	<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>

	<!-- Bootstrap Material Design V4.0 -->
	<script src="{{ asset('js/bootstrap-material-design.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('body').bootstrapMaterialDesign();
		});
	</script>

	<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
