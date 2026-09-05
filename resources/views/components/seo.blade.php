@props([
    'title' => null,
    'description' => null,
    'keywords' => null,
    'image' => null,
    'model' => null,
    'type' => 'website',
    'robots' => 'index, follow',
])

@php
    $defaultTitle = 'Transformarte | Coaching Ontológico con Gabo Patito';
    $defaultDescription = 'Sesiones de coaching ontológico online con Gabo Patito, coach certificado por la ICF. Clarificá lo que querés, tomá decisiones con más sentido y avanzá hacia tu propósito.';
    $defaultKeywords = 'coaching ontológico, coach online, sesiones de coaching, autoconocimiento, desarrollo personal, Transformarte, Gabo Patito';
    $defaultImage = asset('assets/img/Logo-Transformarte.png');

    // Resolución de título
    $finalTitle = $title 
        ?: ($model?->meta_title ?: ($model?->titulo ? strip_tags((string) $model->titulo) . ' | Transformarte' : $defaultTitle));

    // Resolución de descripción
    $finalDescription = $description 
        ?: ($model?->meta_description ?: ($model?->subtitulo ?: ($model?->texto ? \Illuminate\Support\Str::limit(strip_tags((string) $model->texto), 155) : $defaultDescription)));

    // Resolución de palabras clave
    $finalKeywords = $keywords 
        ?: ($model?->meta_keywords ?: $defaultKeywords);

    // Resolución de imagen (Open Graph / Twitter)
    $finalImage = $defaultImage;
    if ($image) {
        $finalImage = str_starts_with($image, 'http') ? $image : asset($image);
    } elseif ($model?->meta_image) {
        $finalImage = \Illuminate\Support\Facades\Storage::disk('public')->url($model->meta_image);
    } elseif ($model?->imagen) {
        $finalImage = \Illuminate\Support\Facades\Storage::disk('public')->url($model->imagen);
    }

    $canonicalUrl = url()->current();

    $schemaData = [
        '@context' => 'https://schema.org',
        '@type' => 'ProfessionalService',
        'name' => 'Transformarte',
        'url' => url('/'),
        'logo' => asset('assets/img/Logo-Transformarte.png'),
        'image' => $finalImage,
        'description' => $finalDescription,
        'founder' => [
            '@type' => 'Person',
            'name' => 'Gabo Patito',
            'jobTitle' => 'Coach Ontológico Profesional ICF',
        ],
    ];
@endphp

<!-- Metadatos Primarios -->
<title>{{ $finalTitle }}</title>
<meta name="title" content="{{ $finalTitle }}">
<meta name="description" content="{{ $finalDescription }}">
<meta name="keywords" content="{{ $finalKeywords }}">
<meta name="author" content="Transformarte">
<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $canonicalUrl }}">

<!-- Open Graph / Facebook / WhatsApp / LinkedIn -->
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:title" content="{{ $finalTitle }}">
<meta property="og:description" content="{{ $finalDescription }}">
<meta property="og:image" content="{{ $finalImage }}">
<meta property="og:site_name" content="Transformarte">
<meta property="og:locale" content="es_AR">

<!-- Twitter Cards -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ $canonicalUrl }}">
<meta name="twitter:title" content="{{ $finalTitle }}">
<meta name="twitter:description" content="{{ $finalDescription }}">
<meta name="twitter:image" content="{{ $finalImage }}">

<!-- Schema.org Datos Estructurados (JSON-LD) -->
<script type="application/ld+json">
{!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
</script>
