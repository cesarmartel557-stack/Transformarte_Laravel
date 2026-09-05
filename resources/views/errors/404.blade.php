@extends('layouts.app')

@section('seo')
	<x-seo title="Página no encontrada | Transformarte" description="La página que buscás no existe o fue movida. Volvé al inicio de Transformarte." robots="noindex, follow" />
@endsection

@section('extra_css')
<style>
	/* Estilos propios de la página 404 */
	.seccion_404{
		padding: 160px 0 120px;
		text-align: center;
	}
	.seccion_404 .error-box{
		max-width: 720px;
		margin: 0 auto;
	}
	.seccion_404 .insignia{
		display: inline-block;
		margin-bottom: 24px;
	}
	.seccion_404 .error-num{
		font-size: 120px;
		line-height: 1;
		margin: 0 0 16px;
		opacity: .25;
	}
	.seccion_404 h1{
		font-size: 56px;
		line-height: 1.1;
		margin: 0 0 24px;
	}
	.seccion_404 h1 em{
		font-style: italic;
	}
	.seccion_404 p{
		max-width: 560px;
		margin: 0 auto 16px;
		font-size: 18px;
		line-height: 1.6;
	}
	.seccion_404 .error-line{
		width: 64px;
		height: 1px;
		background-color: #393c25;
		opacity: .35;
		margin: 40px auto;
	}
	.seccion_404 .error-btn{
		display: inline-block;
		padding: 16px 34px;
		border-radius: 40px;
		border: 1px solid #393c25;
		text-decoration: none;
		font-size: 15px;
		letter-spacing: .04em;
		text-transform: uppercase;
		transition: all .3s ease;
		background-color: #393c25;
		color: #f0e6dd;
	}
	.seccion_404 .error-btn:hover{
		background-color: transparent;
		color: #393c25;
	}
	@media (max-width: 767px){
		.seccion_404{ padding: 120px 0 80px; }
		.seccion_404 .error-num{ font-size: 80px; }
		.seccion_404 h1{ font-size: 38px; }
		.seccion_404 p{ font-size: 16px; }
	}
</style>
@endsection

@section('content')
<!-- =========== 404 =========== -->
<section class="seccion_404">
	<div class="container">
		<div class="error-box">
			<div class="error-num">404</div>
			<div class="insignia">PÁGINA NO ENCONTRADA</div>
			<h1>Uy, <em>nada por aquí</em></h1>
			<p>La página que buscás no existe o fue movida. Probá volviendo al inicio o escribinos si pensás que algo falló.</p>
			<div class="error-line"></div>
			<a href="{{ url('/') }}" class="error-btn">Volver al inicio</a>
		</div>
	</div>
</section>
@endsection
