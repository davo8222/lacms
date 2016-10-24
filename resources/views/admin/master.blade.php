<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'LaCMS') }}</title>


		<!-- CSS -->
		<link rel="stylesheet" href="{{'/css/bootstrap.min.css'}}">
		<!--icons-->
		<link href="{{'/admin/css/themify-icons/themify-icons.css'}}" rel="stylesheet">
		<!--[if lt IE 8]><!-->
		<link rel="stylesheet" href="{{'/admin/css/themify-icons/ie7/ie7.css'}}">
		<!--<![endif]-->
		<link href="{{'/admin/css/fontawesome/css/font-awesome.min.css'}}" rel="stylesheet">
		<!--summernote-->
		<link rel="stylesheet" href="{{'/admin/plugins/summernote/summernote.css'}}">
		
		<!--endsummernote-->
		<link rel="stylesheet" href="{{'/admin/css/style.css'}}">
		
		<!-- google fonts-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
		@yield('head')
		
		
	</head>
	<body class="la-dashboard">
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="logo">
							@yield('title')
						</div>
					</div>
					<div class="col-md-4">
						<div class="to-front">

						</div>
					</div>
					<div class="col-md-4">
						<ul class="nav navbar-nav navbar-right">
							<!-- Authentication Links -->
							@if (Auth::guest())
							<li><a href="{{ url('/login') }}">Login</a></li>
							<li><a href="{{ url('/register') }}">Register</a></li>
							@else
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
									{{ Auth::user()->name }}
								</a>
							<li>
								<a href="{{ url('/logout') }}"
								   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
									Logout
								</a>

								<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
							</li>
							@endif
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="main-content">
			@yield('content')
		</div>
		<footer>
			<div class="container">
				<p class="text-right">LaCMS laravel CMS</p>
			</div>
		</footer>
                <div class="ajaxloading"></div>
		<!-- JS -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script src="{{'/js/bootstrap.min.js'}}"></script> 
		<script src="{{'/admin/plugins/summernote/summernote.js'}}"></script>
        @yield('scripts')
		<script src="{{'/admin/js/ajax-actions.js'}}"></script>
		
		<script src="{{'/admin/js/script.js'}}"></script>
		
	</body>
</html>
