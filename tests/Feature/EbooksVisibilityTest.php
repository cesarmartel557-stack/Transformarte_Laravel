<?php

namespace Tests\Feature;

use App\Filament\Resources\Configuracions\Pages\ManageConfiguracions;
use App\Models\Configuracion;
use App\Models\Contacto;
use App\Models\Ebook;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EbooksVisibilityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Contacto::create([
            'email' => 'hola@espaciotransformarte.com',
            'whatsapp' => '5491149274026',
            'calendly_url' => 'https://calendar.app.google/yyE2dN7uzjg9H9TR9',
            'instagram_url' => 'https://www.instagram.com/espacio_transformarte/',
        ]);
    }

    public function test_ebooks_section_and_links_are_hidden_when_mostrar_ebooks_is_false(): void
    {
        Ebook::create([
            'titulo' => 'Mi Gran Ebook',
            'texto' => 'Descripción del contenido del ebook.',
        ]);

        Configuracion::create([
            'mostrar_ebooks' => false,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('id="ebooks"', false);
        $response->assertDontSee('BIBLIOTECA TRANSFORMARTE');
        $response->assertDontSee('Mi Gran Ebook');
        $response->assertDontSee(url('/#ebooks'));
        $response->assertDontSee('Biblioteca de ebooks');
    }

    public function test_ebooks_section_and_links_are_visible_when_mostrar_ebooks_is_true(): void
    {
        Ebook::create([
            'titulo' => 'Mi Gran Ebook',
            'texto' => 'Descripción del contenido del ebook.',
        ]);

        Configuracion::create([
            'mostrar_ebooks' => true,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('id="ebooks"', false);
        $response->assertSee('BIBLIOTECA TRANSFORMARTE');
        $response->assertSee('Mi Gran Ebook');
        $response->assertSee(url('/#ebooks'));
        $response->assertSee('Biblioteca de ebooks');
    }

    public function test_ebooks_section_is_hidden_when_no_ebooks_exist_even_if_setting_is_true(): void
    {
        Configuracion::create([
            'mostrar_ebooks' => true,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('id="ebooks"', false);
        $response->assertDontSee('BIBLIOTECA TRANSFORMARTE');
    }

    public function test_admin_can_access_filament_configuracion_resource(): void
    {
        $user = User::factory()->create();

        Configuracion::create([
            'mostrar_ebooks' => false,
        ]);

        Livewire::actingAs($user);

        Livewire::test(ManageConfiguracions::class)
            ->assertSuccessful();
    }
}
