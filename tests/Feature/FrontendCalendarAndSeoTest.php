<?php

namespace Tests\Feature;

use App\Models\Contacto;
use App\Models\Gracias;
use App\Models\Hero;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FrontendCalendarAndSeoTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_displays_google_calendar_link_with_target_blank(): void
    {
        Hero::create([
            'titulo' => 'El viaje hacia tu propia grandeza',
            'subtitulo' => 'Un espacio para conocerte mejor',
            'boton_texto' => 'Agendar una Sesión',
            'boton_url' => 'https://calendar.app.google/yyE2dN7uzjg9H9TR9',
        ]);

        Contacto::create([
            'email' => 'hola@espaciotransformarte.com',
            'whatsapp' => '5491149274026',
            'calendly_url' => 'https://calendar.app.google/yyE2dN7uzjg9H9TR9',
            'instagram_url' => 'https://www.instagram.com/espacio_transformarte/',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('https://calendar.app.google/yyE2dN7uzjg9H9TR9');
        $response->assertSee('target="_blank"', false);
        $response->assertSee('rel="noopener noreferrer"', false);
        $response->assertSee('Primera sesión de 30 minutos 100% gratis.');
        $response->assertDontSee('calendly.com');
    }

    public function test_home_page_renders_dynamic_seo_and_schema_markup(): void
    {
        Hero::create([
            'titulo' => 'Transformarte Coaching',
            'subtitulo' => 'Sesiones personalizadas de coaching ontológico',
            'boton_texto' => 'Agendar',
            'boton_url' => 'https://calendar.app.google/yyE2dN7uzjg9H9TR9',
            'meta_title' => 'Coaching Ontológico con Gabo Patito | Transformarte',
            'meta_description' => 'Espacio de coaching ontológico enfocado en tu desarrollo personal.',
            'meta_keywords' => 'coaching, ontologico, gabo patito',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('<title>Coaching Ontológico con Gabo Patito | Transformarte</title>', false);
        $response->assertSee('name="description" content="Espacio de coaching ontológico enfocado en tu desarrollo personal."', false);
        $response->assertSee('property="og:title" content="Coaching Ontológico con Gabo Patito | Transformarte"', false);
        $response->assertSee('name="twitter:card" content="summary_large_image"', false);
        $response->assertSee('https://schema.org', false);
        $response->assertSee('ProfessionalService', false);
    }

    public function test_gracias_page_has_noindex_nofollow_seo(): void
    {
        Gracias::create([
            'insignia' => 'MENSAJE RECIBIDO',
            'titulo' => 'Gracias por tu mensaje',
            'texto' => 'Nos pondremos en contacto.',
            'texto_urgencia' => 'Escribinos por WhatsApp.',
            'boton_whatsapp_texto' => 'WhatsApp',
        ]);

        Contacto::create([
            'email' => 'hola@espaciotransformarte.com',
            'whatsapp' => '5491149274026',
            'calendly_url' => 'https://calendar.app.google/yyE2dN7uzjg9H9TR9',
            'instagram_url' => 'https://www.instagram.com/espacio_transformarte/',
        ]);

        $response = $this->get('/gracias');

        $response->assertStatus(200);
        $response->assertSee('name="robots" content="noindex, nofollow"', false);
        $response->assertSee('property="og:site_name" content="Transformarte"', false);
    }
}
