<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="Bootstrap Admin App + jQuery">
	<meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
	<title>E-Price Track</title>
	<!-- =============== VENDOR STYLES ===============-->
	<!-- FONT AWESOME-->
	<link rel="stylesheet" href="{{ URL::to('src/vendor/fontawesome/css/font-awesome.min.css') }}">
	<!-- SIMPLE LINE ICONS-->
	<link rel="stylesheet" href="{{ URL::to('src/vendor/simple-line-icons/css/simple-line-icons.css') }}">
	<!-- =============== BOOTSTRAP STYLES ===============-->
	<link rel="stylesheet" href="{{ URL::to('src/app/css/bootstrap.css') }}" id="bscss">
	<!-- =============== APP STYLES ===============-->
	<link rel="stylesheet" href="{{ URL::to('src/app/css/app.css') }}" id="maincss">
	<link rel="stylesheet" href="{{ URL::to('css/main.css') }}" id="bscss">
</head>

<body class="login-page">
<div class="wrapper">
	<div class="block-center mt-xl wd-xl">

		@yield('content')
		<div class="p-lg text-center">
			<span>&copy;</span>
			<span>2017</span>
			<span>-</span>
			<span>Powered by <a href="http://team-online.biz">Team Online</a></span>
		</div>
	</div>
</div>
<!-- =============== VENDOR SCRIPTS ===============-->
<!-- MODERNIZR-->
<script src="{{ URL::to('src/vendor/modernizr/modernizr.custom.js') }}"></script>
<!-- JQUERY-->
<script src="{{ URL::to('src/vendor/jquery/dist/jquery.js') }}"></script>
<!-- BOOTSTRAP-->
<script src="{{ URL::to('src/vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
<!-- STORAGE API-->
<script src="{{ URL::to('src/vendor/jQuery-Storage-API/jquery.storageapi.js') }}"></script>
<!-- PARSLEY-->
<script src="{{ URL::to('src/vendor/parsleyjs/dist/parsley.min.js') }}"></script>
<!-- =============== APP SCRIPTS ===============-->
<script src="{{ URL::to('src/app/js/app.js') }}"></script>
</body>

</html>