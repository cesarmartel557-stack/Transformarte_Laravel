<!DOCTYPE html>
<html lang="es">
	<head>
		@include('partials.google-tags')

		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		@if (View::hasSection('seo'))
			@yield('seo')
		@else
			<x-seo />
		@endif

		@yield('extra_meta')

		<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}" sizes="32x32">
		<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}" sizes="16x16">

	    <!-- Style css -->
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/tiny-slider.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
	    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">

		@yield('extra_css')
	</head>

	<body>
		@yield('preloader')

		<!-- =========== Header =========== -->
		<header class="Web-Header">
			<div class="header-original">
				<div class="container">
					<div class="main-header">
						<div class="header-row">
							<div class="col-header col-header_left">
								<div class="header-logo header-logo_mob">
									<a href="{{ url('/') }}">
										<img src="{{ asset('assets/img/Logo-Transformarte.png') }}" alt="Logo" class="logo-principal img-fluid">
									</a>
								</div>	
								<nav class="main-navigation">
									<ul>
										<li><a href="{{ url('/#quienSoy') }}">Quién soy</a></li>
										<li><a href="{{ url('/#sesiones') }}">Sesiones</a></li>
										<li><a href="{{ url('/#herramientas') }}">Herramientas</a></li>
									</ul>
								</nav>
							</div>
							<div class="col-header col-header_center">
								<div class="header-logo header-logo_desk">
									<a href="{{ url('/') }}">
										<img src="{{ asset('assets/img/Logo-Transformarte.png') }}" alt="Logo" class="logo-principal img-fluid">
									</a>
								</div>
							</div>
							<div class="col-header col-header_right">
								<nav class="main-navigation">
									<ul>
										<li><a href="{{ url('/#ebooks') }}">Ebooks</a></li>
										<li><a href="{{ url('/#talleres') }}">Talleres</a></li>
										<li><a href="{{ url('/#faq') }}">FAQ</a></li>
										<li><a href="{{ url('/#contacto') }}">Contacto</a></li>
									</ul>
								</nav>
								<div class="main-nav-mob">
									<button class="burger openSideMenu" aria-label="Abrir menú">
									    <span></span>
									    <span></span>
									    <span></span>
								    </button>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="header-sticky">
				<div class="container">
					<div class="main-header">
						<div class="header-row">
							<div class="col-header col-header_left">
								<div class="header-logo header-logo_mob">
									<a href="{{ url('/') }}">
										<img src="{{ asset('assets/img/Logo-Transformarte.png') }}" alt="Logo" class="logo-principal img-fluid">
									</a>
								</div>	
								<nav class="main-navigation">
									<ul>
										<li><a href="{{ url('/#quienSoy') }}">Quién soy</a></li>
										<li><a href="{{ url('/#sesiones') }}">Sesiones</a></li>
										<li><a href="{{ url('/#herramientas') }}">Herramientas</a></li>
									</ul>
								</nav>
							</div>
							<div class="col-header col-header_center">
								<div class="header-logo header-logo_desk">
									<a href="{{ url('/') }}">
										<img src="{{ asset('assets/img/Logo-Transformarte.png') }}" alt="Logo" class="logo-principal img-fluid">
									</a>
								</div>
							</div>
							<div class="col-header col-header_right">
								<nav class="main-navigation">
									<ul>
										<li><a href="{{ url('/#ebooks') }}">Ebooks</a></li>
										<li><a href="{{ url('/#talleres') }}">Talleres</a></li>
										<li><a href="{{ url('/#faq') }}">FAQ</a></li>
										<li><a href="{{ url('/#contacto') }}">Contacto</a></li>
									</ul>
								</nav>
								<div class="main-nav-mob">
									<button class="burger openSideMenu" aria-label="Abrir menú">
									    <span></span>
									    <span></span>
									    <span></span>
								    </button>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<!-- =========== Menu =========== -->
		<nav class="menu">
			<ul>
				<li><a class="js-scroll" href="{{ url('/#quienSoy') }}">Quién soy</a></li>
				<li><a class="js-scroll" href="{{ url('/#sesiones') }}">Sesiones</a></li>
				<li><a class="js-scroll" href="{{ url('/#herramientas') }}">Herramientas</a></li>
				<li><a class="js-scroll" href="{{ url('/#ebooks') }}">Ebooks</a></li>
				<li><a class="js-scroll" href="{{ url('/#talleres') }}">Talleres</a></li>
				<li><a class="js-scroll" href="{{ url('/#faq') }}">FAQ</a></li>
				<li><a class="js-scroll" href="{{ url('/#contacto') }}">Contacto</a></li>
			</ul>
		</nav>

		<!-- =========== Main =========== -->
		<main>
			@yield('content')
		</main>

		<!-- =========== Footer =========== -->
		<footer class="web-footer">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-xl-6 mb-5 mb-lg-0">
						<div class="footer-widget">
							<h5>Encontremos el mejor <br>camino para vos</h5>
							<a href="{{ $contactoGlobal['calendly_url'] }}" target="_blank" rel="noopener noreferrer" class="cta">Agendar una Sesión</a>
						</div>
					</div>
					<div class="col-lg-3 col-xl-2 mb-5 mb-lg-0">
						<div class="footer-widget">
							<h6>SERVICIOS</h6>
							<ul class="footer-nav">
								<li><a href="{{ url('/#sesiones') }}" target="_blank" rel="noopener">Sesión individual</a></li>
								<li><a href="{{ url('/#sesiones') }}" target="_blank" rel="noopener">Pack de 4 sesiones</a></li>
								<li><a href="{{ url('/#sesiones') }}" target="_blank" rel="noopener">Proceso de Coaching</a></li>
								<li><a href="{{ url('/#cursos') }}" target="_blank" rel="noopener">Cursos grabados</a></li>
								<li><a href="{{ url('/#talleres') }}" target="_blank" rel="noopener">Talleres grupales</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-xl-2 mb-5 mb-lg-0">
						<div class="footer-widget">
							<h6>RECURSOS</h6>
							<ul class="footer-nav">
								<li><a href="{{ url('/#ebooks') }}" target="_blank" rel="noopener">Biblioteca de ebooks</a></li>
								<li><a href="{{ url('/#material') }}" target="_blank" rel="noopener">Material gratuito</a></li>
								<li><a href="{{ url('/#material') }}" target="_blank" rel="noopener">Recursos gratuitos</a></li>
								<li><a href="{{ url('/#herramientas') }}" target="_blank" rel="noopener">Herramientas</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-1 col-xl-2">
						<a href="{{ $contactoGlobal['instagram_url'] }}" target="_blank" class="f-icon-instagram"></a>
					</div>
				</div>
				<div class="footer-copy">
					<p>2026 © Transformarte</p>
				</div>
			</div>
		</footer>

	    <!-- Main js -->
		<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
		<script src="{{ asset('assets/js/main.js') }}"></script>
	</body>
</html>
