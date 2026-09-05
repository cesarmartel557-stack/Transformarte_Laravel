@extends('layouts.app')

@section('seo')
	<x-seo :model="$gracias" robots="noindex, nofollow" />
@endsection

@section('extra_css')
<style>
	/* Estilos propios de la página de gracias (sin reglas generales) */
	.seccion_gracias{
		padding: 160px 0 120px;
		text-align: center;
	}
	.seccion_gracias .gracias-box{
		max-width: 720px;
		margin: 0 auto;
	}
	.seccion_gracias .gracias-icon{
		width: 76px;
		height: 76px;
		margin: 0 auto 32px;
		border-radius: 50%;
		border: 1px solid #393c25;
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.seccion_gracias .gracias-icon svg{
		width: 30px;
		height: 30px;
		stroke: #393c25;
		fill: none;
		stroke-width: 1.4;
	}
	.seccion_gracias .insignia{
		display: inline-block;
		margin-bottom: 24px;
	}
	.seccion_gracias h1{
		font-size: 56px;
		line-height: 1.1;
		margin: 0 0 24px;
	}
	.seccion_gracias h1 em{
		font-style: italic;
	}
	.seccion_gracias p{
		max-width: 560px;
		margin: 0 auto 16px;
		font-size: 18px;
		line-height: 1.6;
	}
	.seccion_gracias .gracias-line{
		width: 64px;
		height: 1px;
		background-color: #393c25;
		opacity: .35;
		margin: 40px auto;
	}
	.seccion_gracias .gracias-actions{
		display: flex;
		flex-wrap: wrap;
		gap: 16px;
		justify-content: center;
	}
	.seccion_gracias .gracias-btn{
		display: inline-block;
		padding: 16px 34px;
		border-radius: 40px;
		border: 1px solid #393c25;
		text-decoration: none;
		font-size: 15px;
		letter-spacing: .04em;
		text-transform: uppercase;
		transition: all .3s ease;
	}
	.seccion_gracias .gracias-btn_primary{
		background-color: #393c25;
		color: #f0e6dd;
	}
	.seccion_gracias .gracias-btn_primary:hover{
		background-color: transparent;
		color: #393c25;
	}
	.seccion_gracias .gracias-btn_ghost{
		color: #393c25;
	}
	.seccion_gracias .gracias-btn_ghost:hover{
		background-color: #393c25;
		color: #f0e6dd;
	}
	@media (max-width: 767px){
		.seccion_gracias{ padding: 120px 0 80px; }
		.seccion_gracias h1{ font-size: 38px; }
		.seccion_gracias p{ font-size: 16px; }
		.seccion_gracias .gracias-actions{ flex-direction: column; }
		.seccion_gracias .gracias-btn{ width: 100%; }
	}
</style>
@endsection

@section('content')
<!-- =========== Gracias =========== -->
<section class="seccion_gracias">
	<div class="container">
		<div class="gracias-box">
			<div class="gracias-icon">
				<svg viewBox="0 0 24 24" aria-hidden="true">
					<rect x="2.5" y="5" width="19" height="14" rx="2"></rect>
					<path d="M3 6.5l9 6.5 9-6.5"></path>
				</svg>
			</div>
			<div class="insignia">{{ $gracias->insignia ?? 'MENSAJE RECIBIDO' }}</div>
			<h1>{!! $gracias->titulo ?? 'Gracias por <em>tu mensaje</em>' !!}</h1>
			<p>{{ $gracias->texto ?? 'Tu consulta fue recibida correctamente. Será revisada y respondida dentro de las próximas 24 a 48 horas hábiles al correo electrónico que indicaste.' }}</p>
			@if (! empty($gracias?->texto_urgencia) && ! empty($contacto?->whatsapp))
			<p>{{ $gracias->texto_urgencia }}</p>
			@endif
			<div class="gracias-line"></div>
			<div class="gracias-actions">
				<a href="{{ url('/') }}" class="gracias-btn gracias-btn_primary">Volver al inicio</a>
				@if (! empty($contacto?->whatsapp))
				<a href="https://wa.me/{{ $contacto->whatsapp }}" target="_blank" class="gracias-btn gracias-btn_ghost">{{ $gracias->boton_whatsapp_texto ?? 'Escribir por WhatsApp' }}</a>
				@endif
			</div>
		</div>
	</div>
</section>
@endsection
