<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ asset('admin/img/icons/icon-48x48.png')}}" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>
		@yield('title_prefix', config('helpwa.title_prefix', ''))
		@yield('title', config('helpwa.title', 'Adminkit'))
		@yield('title_postfix', config('helpwa.title_postfix', ''))	
	</title>

	<link href="{{ asset('admin/css/app.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		@include('layouts.admin.sidebar')

		<div class="main">
			@include('layouts.admin.navbar')

			<main class="content">
				@yield('content')
			</main>

			@include('layouts.admin.footer')
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	@stack('scripts')
	<script src="{{ asset('admin/js/app.js')}}"></script>


</body>

</html>