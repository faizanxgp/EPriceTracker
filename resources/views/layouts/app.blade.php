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
	<!-- ANIMATE.CSS-->
	<link rel="stylesheet" href="{{ URL::to('src/vendor/animate.css/animate.min.css') }}">
	<!-- WHIRL (spinners)-->
	<link rel="stylesheet" href="{{ URL::to('src/vendor/whirl/dist/whirl.css') }}">
	<!-- =============== PAGE VENDOR STYLES ===============-->
	<link rel="stylesheet" href="{{ URL::to('src/vendor/sweetalert/dist/sweetalert.css') }}">
	<!-- =============== BOOTSTRAP STYLES ===============-->
	<link rel="stylesheet" href="{{ URL::to('src/app/css/bootstrap.css') }}" id="bscss">
	<!-- =============== APP STYLES ===============-->
	<link rel="stylesheet" href="{{ URL::to('src/app/css/app.css') }}" id="maincss">
	<link rel="stylesheet" href="{{ URL::to('css/main.css') }}" id="bscss">
</head>

<body>
<div class="wrapper">
	@include('partials.header')
	{{--@include('partials.sidebar')--}}
	<!-- Main section-->


	<section>
		<!-- Page content-->
		<div class="content-wrapper">
			<h3>EPriceTracker
				<small>Competitive Intelligence</small>
			</h3>
			<div class="row">
				<div class="col-lg-12">
					@yield('content')
				</div>
			</div>
		</div>
	</section>
	@include('partials.footer')
</div>
<!-- =============== VENDOR SCRIPTS ===============-->
<!-- MODERNIZR-->
<script src="{{ URL::to('src/vendor/modernizr/modernizr.custom.js') }}"></script>
<!-- MATCHMEDIA POLYFILL-->
<script src="{{ URL::to('src/vendor/matchMedia/matchMedia.js') }}"></script>
<!-- JQUERY-->
<script src="{{ URL::to('src/vendor/jquery/dist/jquery.js') }}"></script>
<!-- BOOTSTRAP-->
<script src="{{ URL::to('src/vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
<!-- STORAGE API-->
<script src="{{ URL::to('src/vendor/jQuery-Storage-API/jquery.storageapi.js') }}"></script>
<!-- JQUERY EASING-->
<script src="{{ URL::to('src/vendor/jquery.easing/js/jquery.easing.js') }}"></script>
<!-- ANIMO-->
<script src="{{ URL::to('src/vendor/animo.js/animo.js') }}"></script>
<!-- SLIMSCROLL-->
<script src="{{ URL::to('src/vendor/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- SCREENFULL-->
<script src="{{ URL::to('src/vendor/screenfull/dist/screenfull.js') }}"></script>
<!-- LOCALIZE-->
<script src="{{ URL::to('src/vendor/jquery-localize-i18n/dist/jquery.localize.js') }}"></script>
<!-- RTL demo-->
<script src="{{ URL::to('src/app/js/demo/demo-rtl.js') }}"></script>
<!-- =============== PAGE VENDOR SCRIPTS ===============-->
<script src="{{ URL::to('src/vendor/sweetalert/dist/sweetalert.min.js') }}"></script>

<script src="{{ URL::to('src/vendor/Chart.js/dist/Chart.js') }}"></script>
<!-- =============== APP SCRIPTS ===============-->
<script src="{{ URL::to('src/app/js/app.jsxx') }}"></script>

@yield('js')

</body>

</html>