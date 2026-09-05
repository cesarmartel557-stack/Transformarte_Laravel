<?php

namespace Tests\Feature;

use App\Filament\Resources\Ebooks\Pages\CreateEbook;
use App\Filament\Resources\Ebooks\Pages\EditEbook;
use App\Models\Ebook;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FilamentSeoResourceTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_ebook_with_seo_metadata(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user);

        Livewire::test(CreateEbook::class)
            ->fillForm([
                'titulo' => 'Mi Primer Ebook',
                'texto' => 'Descripción del contenido del ebook.',
                'meta_title' => 'Ebook de Coaching Ontológico | Transformarte',
                'meta_description' => 'Descargá gratis este ebook y empezá tu proceso.',
                'meta_keywords' => 'ebook, gratis, coaching',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('ebooks', [
            'titulo' => 'Mi Primer Ebook',
            'meta_title' => 'Ebook de Coaching Ontológico | Transformarte',
            'meta_description' => 'Descargá gratis este ebook y empezá tu proceso.',
            'meta_keywords' => 'ebook, gratis, coaching',
        ]);
    }

    public function test_can_edit_ebook_and_update_seo_metadata(): void
    {
        $user = User::factory()->create();
        $ebook = Ebook::create([
            'titulo' => 'Ebook Existente',
            'texto' => 'Texto inicial del ebook.',
        ]);

        Livewire::actingAs($user);

        Livewire::test(EditEbook::class, ['record' => $ebook->id])
            ->fillForm([
                'meta_title' => 'Título SEO Actualizado',
                'meta_description' => 'Descripción SEO Actualizada',
                'meta_keywords' => 'nuevo, seo, keywords',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('ebooks', [
            'id' => $ebook->id,
            'meta_title' => 'Título SEO Actualizado',
            'meta_description' => 'Descripción SEO Actualizada',
            'meta_keywords' => 'nuevo, seo, keywords',
        ]);
    }
}
