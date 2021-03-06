<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'Laravel') }}</title>
		
		<!-- Styles -->
		<!-- google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,400,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
		 <!-- CSS -->
        <link rel="stylesheet" href="{{'/css/bootstrap.min.css'}}">
		 <link rel="stylesheet" href="{{'/css/front_styles.css'}}">
        <!--icons-->
        <link href="{{'/admin/css/fontawesome/css/font-awesome.min.css'}}" rel="stylesheet">

		<!-- Scripts -->
		<script>
			window.Laravel = <?php
echo json_encode([
	'csrfToken' => csrf_token(),
]);
?>
		</script>
	</head>
	<body>
		<nav class="navbar navbar-default navbar-static-top">

			<div class="container">

				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					@include('layouts.nav')
					<!-- Right Side Of Navbar -->
					<ul class="nav navbar-nav navbar-right">
						<!-- Authentication Links -->
						@if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
						@else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
									   onclick="event.preventDefault();
											   document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		@yield('content')

		<!-- Scripts -->
		<script src="/js/app.js"></script>
	</body>
</html>
