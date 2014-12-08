<html>
	<head>
		
		<!-- JQuery -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<!-- JQuery UI -->
		<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

		<!-- Date Picker -->
		<link href="{{ asset('plugins/datepicker/css/datepicker.css') }}" rel="stylesheet">
		<script src="{{ asset('plugins/datepicker/js/bootstrap-datepicker.js') }}"></script>
		
		<!-- Time Picker -->
		<link href="{{ asset('plugins/timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet">
		<link href="{{ asset('plugins/timepicker/css/bootstrap-responsive.css') }}" rel="stylesheet">
		<script src="{{ asset('plugins/timepicker/js/bootstrap-timepicker.min.js') }}"></script>
		
		<!-- Theme CSS -->
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
		
		
	</head>
	
	<body>		
		<div class="container">
			@yield('content')
		</div>
	</body>
	<script>
		@yield('footerScripts')
	</script>	
</html>
