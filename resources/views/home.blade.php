@extends('layouts.app')

@section('seo')
	<x-seo :model="$hero" />
	<link rel="alternate" hreflang="x-default" href="{{ url('/') }}/">
@endsection

@section('extra_css')
<meta name="hero-bg" content="{{ storage_asset($hero->imagen ?? null, 'assets/img/banner-hero.jpg') }}">
<style>
	.error-formulario{
		color: #b3261e;
		font-size: 14px;
		margin: 0 0 16px;
	}
</style>
@endsection

@section('preloader')
<!-- =========== PreLoad =========== -->
<div id="preloader"><div class="loader"><span></span><span></span><span></span></div></div>
@endsection

@section('content')
<!-- =========== Hero =========== -->
<section id="section-trigger" class="seccion_hero" style="background-image: url('{{ storage_asset($hero->imagen ?? null, 'assets/img/banner-hero.jpg') }}');">
	<div>
		<h1>{!! $hero->titulo ?? 'El viaje hacia tu propia grandeza' !!}</h1>
		<p>{{ $hero->subtitulo ?? 'Un espacio para conocerte mejor, decidir con más claridad y avanzar hacia proyectos con sentido.' }}</p>
		<p class="hero_sesion_gratis">Primera sesión de 30 minutos 100% gratis.</p>
		<a href="{{ $hero->boton_url ?? 'https://calendar.app.google/yyE2dN7uzjg9H9TR9' }}" target="_blank" rel="noopener noreferrer" class="cta">{{ $hero->boton_texto ?? 'Agendar una Sesión' }}</a>
	</div>
	<div>
		<img src="{{ asset('assets/img/transformarte.png') }}" class="hero_transformarte">
	</div>
</section>

<!-- =========== Quien soy =========== -->
<section id="quienSoy" class="seccion_sobreMi">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6 mb-5 mb-lg-0">
				<div class="content text-center mx-auto" style="max-width: 428px;">
					<h2>{!! $sobreMi->titulo ?? 'Hola, soy <br>Gabo Patitó' !!}</h2>
					<img src="{{ storage_asset($sobreMi->imagen_felino ?? null, 'assets/img/felino.png') }}" class="mb-4 pb-3">
					<p>{{ $sobreMi->parrafo_1 ?? 'Soy coach ontológico certificado por la ICF y mi compromiso con el mundo es acompañar a las personas en su proceso de transformación interior.' }}</p>
					<p>{{ $sobreMi->parrafo_2 ?? 'Mi trabajo es acompañarte a clarificar lo que realmente querés y avanzar hacia una vida más coherente y alineada a tu propósito.' }}</p>
					<a href="#transformarte" class="cta">{{ $sobreMi->cta_texto ?? 'Descubre TransformArte' }}</a>
				</div>
			</div>
			<div class="col-lg-6">
				<img src="{{ storage_asset($sobreMi->imagen ?? null, 'assets/img/Gabo-Patito.jpg') }}">
			</div>
		</div>
	</div>
</section>

<!-- =========== Transformarte =========== -->
<section id="transformarte" class="seccion_transformarte">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mb-5 mb-lg-0">
				<div class="content" style="max-width: 563px;">
					<div class="insignia">{{ $transformarte->insignia ?? 'Transformarte' }}</div>
					<h2>{!! $transformarte->titulo ?? 'Un espacio <br>para crecer' !!}</h2>
					<p class="mb-4">{{ $transformarte->parrafo_1 ?? '' }}</p>
					<p>{{ $transformarte->parrafo_2 ?? '' }}</p>
					<img src="{{ storage_asset($transformarte->imagen ?? null, 'assets/img/mujer-ojos.jpg') }}" class="img">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="content mx-auto" style="max-width: 414px;">
					@if ($transformarte && $transformarte->items->isNotEmpty())
					@foreach ($transformarte->items as $item)
					<div class="item">
						@if ($item->icono)
						<img src="{{ storage_asset($item->icono) }}">
						@endif
						<h4>{{ $item->titulo }}</h4>
						<p>{{ $item->texto }}</p>
					</div>
					@endforeach
					@endif
				</div>
			</div>
		</div>
	</div>
</section>

<!-- =========== Sesiones =========== -->
<section id="sesiones" class="seccion_sesiones">
	<div class="container">
		<div class="content text-center">
			<div class="insignia">SESIONES</div>
			<h2>Elegí el formato que <br>mejor acompaña tu momento</h2>
			<div class="mx-auto" style="max-width: 374px;">
				<p>Los tres formatos pueden ser transformadores. La diferencia está en el tipo de recorrido.</p>
			</div>
		</div>
		<div class="grid_cards">
			@foreach ($sesiones as $sesion)
			<div class="card">
				<div>
					<div class="card_insignia">{{ $sesion->insignia }}</div>
					<h4>{{ $sesion->titulo }}</h4>
					<p>{{ $sesion->parrafo_1 }}</p>
					@if ($sesion->parrafo_2)
					<p>{{ $sesion->parrafo_2 }}</p>
					@endif
				</div>
				<div>
					<p class="sesion">{{ $sesion->detalle }}</p>
					<a href="{{ $sesion->boton_url }}" target="_blank" rel="noopener noreferrer" class="cta">{{ $sesion->boton_texto }}</a>
				</div>
			</div>
			@endforeach
		</div>
</section>

<!-- =========== Google Calendar =========== -->
<section class="seccion_googleCalendar">
	<div class="container">
		<div class="content">
			<div>
				<h2>¿Listo para empezar?</h2>
				<p>Agendá tu primera sesión directamente en Google Calendar. <br>Sin vueltas, sin esperas. Elegís el día y el horario que mejor te quede.</p>
			</div>
			<div class="calendar_cta_wrapper">
				<p class="calendar_sesion_gratis">Primera sesión de 30 minutos 100% gratis.</p>
				<a href="{{ $contacto->calendly_url ?? 'https://calendar.app.google/yyE2dN7uzjg9H9TR9' }}" target="_blank" rel="noopener noreferrer" class="cta">Agendar en Google Calendar</a>
			</div>
		</div>
	</div>
</section>

<!-- =========== Temas =========== -->
<section class="seccion_temas">
	<div class="container">
		<div class="content text-center">
			<div class="insignia">TEMAS A TRABAJAR</div>
			<h2>¿Sobre qué podemos <br>trabajar juntos?</h2>
			<div class="mx-auto" style="max-width: 545px;">
				<p>El coaching abre conversaciones sobre distintas áreas de la vida. Algunos de los temas más frecuentes en las sesiones:</p>
			</div>
		</div>
	</div>
	<div class="container_full_carrusel">
		<div class="carrusel_temas">
			@foreach ($temas as $tema)
			<div>
				<div class="card">
					<h4>{!! $tema->titulo !!}</h4>

					<p>{{ $tema->texto }}</p>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>

<!-- =========== Herramientas =========== -->
<section id="herramientas" class="seccion_herramientas">
	<div class="container">
		<div class="content">
			<div class="insignia">HERRAMIENTAS</div>
			<h2>¿Cómo trabajamos?</h2>
			<div style="max-width: 540px;">
				<p>Cada sesión combina conversación profunda con herramientas prácticas diseñadas para generar movimiento real.</p>
			</div>

			<div class="wrapper_pildoras">
				@foreach ($herramientas as $herramienta)
				<div class="pildora">{{ $herramienta->nombre }}</div>
				@endforeach
			</div>
		</div>
	</div>
</section>

@if ($mostrarEbooks && $ebooks->isNotEmpty())
<!-- =========== Biblioteca =========== -->
<section id="ebooks" class="seccion_biblioteca">
	<div class="container">
		<div class="content text-center">
			<div class="insignia">BIBLIOTECA TRANSFORMARTE</div>
			<h2>Ebooks para <br>seguir creciendo</h2>
			<div class="mx-auto" style="max-width: 355px;">
				<p>Guías prácticas para trabajar en profundidad los temas que más importan.</p>
			</div>
		</div>
		<div class="grid_cards">
			@foreach ($ebooks as $ebook)
			<div class="card">
				<img src="{{ storage_asset($ebook->imagen) }}" alt="">
				<div class="card_content">
					<div class="card_insignia">EBOOK</div>
					<div>
						<h4>{!! $ebook->titulo !!}</h4>
						<p>{{ $ebook->texto }}</p>
						@if ($ebook->pdf)
						<a href="{{ storage_asset($ebook->pdf) }}" target="_blank" class="cta">Obtener Ebook</a>
						@endif
					</div>
				</div>
			</div>
			@endforeach
		</div>
</section>
@endif

<!-- =========== Material =========== -->
<section id="material" class="seccion_material">
	<div class="container">
		<div class="content text-center">
			<div class="insignia">MATERIAL GRATUITO</div>
			<h2>Recursos para empezar <br>hoy mismo</h2>
			<div class="mx-auto" style="max-width: 466px;">
				<p>Materiales gratuitos para que puedas comenzar a explorar antes de una sesión, o simplemente porque querés crecer.</p>
			</div>
		</div>
		<div class="grid_cards">
			@foreach ($materiales as $material)
			<div class="card">
				<div class="position-relative">
					<img src="{{ storage_asset($material->imagen) }}" alt="" class="image">
					<div class="card_insignia">{{ $material->insignia }}</div>
				</div>
				<div class="card_content">
					<h4>{!! $material->titulo !!}</h4>
					<p>{{ $material->texto }}</p>
					<a href="{{ $material->boton_url ?: '#contacto' }}" @if ($material->boton_url) target="_blank" rel="noopener" @endif class="cta">Descargar Gratis</a>
				</div>
			</div>
			@endforeach
		</div>
</section>

<!-- =========== Cursos =========== -->
<section id="cursos" class="seccion_cursos">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mb-5 mb-lg-0">
				<div class="content" style="max-width: 563px;">
					<div class="insignia">CURSOS GRABADOS</div>
					<h2>Aprendé a tu ritmo</h2>
					<div style="max-width: 500px;">
						<p>Cursos en video para profundizar en los temas que más te interesan, cuando quieras y desde donde estés.</p>
					</div>
					<div class="wrapper_cta">
						<a href="#contacto" class="cta-2">Videos</a>
						<a href="#contacto" class="cta-2">Material descargable</a>
					</div>

					<img src="{{ asset('assets/img/manos-en-el-agua.jpg') }}" class="img">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="content mx-auto" style="max-width: 473px;">
					@foreach ($cursos as $curso)
					<div class="item">
						<div class="numero">{{ sprintf('%02d', $loop->iteration) }}</div>
						<h4>{{ $curso->titulo }}</h4>
						<p>{{ $curso->texto }}</p>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>

<!-- =========== Talleres =========== -->
<section id="talleres" class="seccion_talleres">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mb-5 mb-lg-0">
				<div class="content">
					<div class="insignia">TALLERES</div>
					<h2>Experiencias <br>grupales en vivo</h2>
					<div style="max-width: 485px;">
						<p>Talleres online para trabajar en grupo, compartir experiencias y aprender con otros. Cada uno diseñado para generar movimiento real.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="ms-lg-auto" style="max-width: 557px;">
					<img src="{{ asset('assets/img/grupo-de-personas.jpg') }}" alt="">
				</div>
			</div>
			<div class="col-12">
				<div class="wrapper_talleres">
					@foreach ($talleres as $taller)
					<div class="item_taller{{ $taller->estado === 'proximamente' ? ' prox' : '' }}">
						<div style="max-width: 360px;width: 100%;">
							<div class="insignia">{{ $taller->estado === 'proximamente' ? 'PRÓXIMAMENTE' : 'INSCRIPCIONES ABIERTAS' }}</div>
							<h4>{!! $taller->titulo !!}</h4>
						</div>
						<div style="max-width: 600px; width: 100%;">
							<p>{{ $taller->texto }}</p>
						</div>
						<div>
							<a href="{{ $taller->boton_url ?: '#contacto' }}" class="cta">{{ $taller->boton_texto }}</a>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>

<!-- =========== Testimonios =========== -->
<section class="seccion_testimonios">
	<div class="container">
		<div class="content">
			<div class="insignia">TESTIMONIOS</div>
			<div style="max-width: 620px;">
				<h2>Lo que dicen quienes ya pasaron por aquí</h2>
			</div>
		</div>
		<div class="wrapper_testimonios">
			<div class="carrusel_testimonios">
				@foreach ($testimonios as $testimonio)
				<div>
					<div class="card">
						<div>
							<h4>{{ $testimonio->frase }}</h4>
						</div>
						<div>
							<p class="nombre">{{ $testimonio->nombre }}</p>
							<p class="sesion">{{ $testimonio->formato }}</p>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</section>

<!-- =========== Preguntas =========== -->
<section id="faq" class="seccion_preguntas">
	<div class="container">
		<div class="content">
			<h2>Preguntas frecuentes</h2>
		</div>
		<div class="wrapper_accordion">
			<div class="accordion accordion_preguntas" id="accordionPreguntas">
				@foreach ($faqs as $faq)
				<div class="accordion-item">
					<h2 class="accordion-header" id="headingFaq{{ $faq->id }}">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq{{ $faq->id }}" aria-expanded="false" aria-controls="collapseFaq{{ $faq->id }}">
							{{ $faq->pregunta }}
						</button>
					</h2>
					<div id="collapseFaq{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="headingFaq{{ $faq->id }}" data-bs-parent="#accordionPreguntas">
						<div class="accordion-body">
							{!! $faq->respuesta !!}
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</section>

<!-- =========== Contacto =========== -->
<section id="contacto" class="seccion_contacto">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="insignia">CONTACTO</div>							
			</div>
			
			<div class="col-lg-6 mb-5 mb-lg-0">
				<div class="content">
					<div>
						<h2>¿Hablamos?</h2>
						<div style="max-width: 500px;">
							<p>Si tenés alguna duda, querés más información o simplemente querés saber si el coaching es para vos, escribime.</p>
						</div>
					</div>
					<div>
						<div class="item_icon">
							<div class="icon icon-email"></div>
							<a href="mailto:{{ $contacto->email ?? 'hola@espaciotransformarte.com' }}" target="_blank">{{ $contacto->email ?? 'hola@espaciotransformarte.com' }}</a>
						</div>
						<div class="item_icon">
							<div class="icon icon-whatsapp"></div>
							<a href="https://wa.me/{{ $contacto->whatsapp ?? '5491149274026' }}" target="_blank">Escribir por WhatsApp</a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-6">
				<form action="{{ route('contacto.store') }}" method="POST">
					@csrf

					<!-- Honeypot antispam: campo oculto que los humanos nunca completan -->
					<input type="text" name="empresa" value="" tabindex="-1" autocomplete="off" style="position:absolute; left:-9999px; opacity:0;" aria-hidden="true">

					@if ($errors->any())
					<p class="error-formulario">{{ $errors->first() }}</p>
					@endif

					<div class="row">
						<div class="col-lg-6 mb-4 pb-2">
							<input type="text" id="nombre" name="nombre" placeholder="Tu nombre" value="{{ old('nombre') }}" required>
						</div>
						<div class="col-lg-6 mb-4 pb-2">
							<input type="text" id="apellido" name="apellido" placeholder="Tu apellido" value="{{ old('apellido') }}" required>
						</div>
						<div class="col-lg-6 mb-4 pb-2">
							<input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="on" required>
						</div>
						<div class="col-lg-6 mb-4 pb-2">
							<input type="tel" id="telefono" name="telefono" placeholder="Teléfono" value="{{ old('telefono') }}" autocomplete="on">
						</div>
						<div class="col-12 mb-4 pb-2">
							<select name="sesion" id="sesion" required>
								<option value="" selected disabled>Me interesa trabajar en...</option>
								<option value="Proceso de Coaching" @selected(old('sesion') === 'Proceso de Coaching')>Proceso de Coaching</option>
								<option value="Sesión Individual" @selected(old('sesion') === 'Sesión Individual')>Sesión Individual</option>
								<option value="Pack de 4 Sesiones" @selected(old('sesion') === 'Pack de 4 Sesiones')>Pack de 4 Sesiones</option>
							</select>
						</div>
						<div class="col-12 mb-4 pb-2">
							<textarea id="mensaje" name="mensaje" placeholder="Mensaje..." required>{{ old('mensaje') }}</textarea>
						</div>
						<div class="col-12 mb-4 pb-2">
							<x-turnstile theme="light" />
						</div>
						<div class="col-12">
							<button type="submit" class="btn-form">Enviar</button>
						</div>
					</div>
				</form>
			</div>
		</div>					
	</div>
</section>
@endsection
