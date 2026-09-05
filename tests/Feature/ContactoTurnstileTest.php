<?php

namespace Tests\Feature;

use App\Models\Mensaje;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactoTurnstileTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_renders_turnstile_widget(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('cf-turnstile', false);
        $response->assertSee('challenges.cloudflare.com/turnstile', false);
    }

    public function test_contact_form_submission_fails_without_turnstile_token(): void
    {
        $payload = [
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'email' => 'juan@ejemplo.com',
            'telefono' => '1122334455',
            'sesion' => 'Proceso de Coaching',
            'mensaje' => 'Hola, me gustaría agendar una sesión.',
            // Omitimos cf-turnstile-response
        ];

        $response = $this->post(route('contacto.store'), $payload);

        $response->assertSessionHasErrors(['cf-turnstile-response']);
        $this->assertDatabaseCount(Mensaje::class, 0);
    }

    public function test_contact_form_submission_fails_when_turnstile_verification_fails(): void
    {
        $this->fakeTurnstile(success: false);

        $payload = [
            'nombre' => 'Bot',
            'apellido' => 'Spammer',
            'email' => 'bot@spammer.com',
            'sesion' => 'Sesión Individual',
            'mensaje' => 'Spam message content',
            'cf-turnstile-response' => 'invalid-token',
        ];

        $response = $this->post(route('contacto.store'), $payload);

        $response->assertSessionHasErrors(['cf-turnstile-response']);
        $this->assertDatabaseCount(Mensaje::class, 0);
    }

    public function test_contact_form_submission_succeeds_with_valid_turnstile_token(): void
    {
        $this->fakeTurnstile(success: true);

        $payload = [
            'nombre' => 'Maria',
            'apellido' => 'Gomez',
            'email' => 'maria@ejemplo.com',
            'telefono' => '1155667788',
            'sesion' => 'Pack de 4 Sesiones',
            'mensaje' => 'Hola, estoy interesada en el pack de 4 sesiones.',
            'cf-turnstile-response' => 'valid-mocked-turnstile-token',
        ];

        $response = $this->post(route('contacto.store'), $payload);

        $response->assertRedirect('/gracias');
        $this->assertDatabaseHas(Mensaje::class, [
            'email' => 'maria@ejemplo.com',
            'nombre' => 'Maria',
            'sesion' => 'Pack de 4 Sesiones',
        ]);
    }
}
