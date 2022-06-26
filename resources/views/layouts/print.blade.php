<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		{{-- <title>Metronic - the world's #1 selling Bootstrap Admin Theme Ecosystem for HTML, Vue, React, Angular &amp; Laravel by Keenthemes</title> --}}
		<title>Sekolah Minggu</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="{{ asset("assets/plugins/global/plugins.bundle.css") }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset("assets/css/style.bundle.css") }}" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="{{ asset("assets/images/logo.png") }}" type="image/x-icon">

		@stack('head')
	</head>
	<body class="bg-white">
		@yield('content')

		@stack('scripts')

		<script src="{{ asset("assets/plugins/global/plugins.bundle.js")}}"></script>
		<script src="{{ asset("assets/js/scripts.bundle.js") }}"></script>
	</body>
</html>