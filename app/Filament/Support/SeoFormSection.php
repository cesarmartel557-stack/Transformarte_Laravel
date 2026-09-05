<?php

namespace App\Filament\Support;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class SeoFormSection
{
    public static function make(string $heading = 'SEO y Redes Sociales'): Section
    {
        return Section::make($heading)
            ->description('Optimización de etiquetas meta para motores de búsqueda (Google) y vistas previas en redes sociales (Open Graph y Twitter Cards).')
            ->icon('heroicon-o-globe-alt')
            ->collapsible()
            ->collapsed()
            ->columns(2)
            ->columnSpanFull()
            ->components([
                TextInput::make('meta_title')
                    ->label('Meta Título (Title Tag)')
                    ->placeholder('Ej: Coaching Ontológico Online | Transformarte')
                    ->maxLength(60)
                    ->helperText('Título optimizado para buscadores (máximo recomendado: 60 caracteres). Si se deja vacío, se generará a partir del contenido.')
                    ->columnSpanFull(),

                Textarea::make('meta_description')
                    ->label('Meta Descripción')
                    ->placeholder('Ej: Descubrí cómo el coaching ontológico puede transformar tu manera de observar...')
                    ->rows(3)
                    ->maxLength(160)
                    ->helperText('Resumen descriptivo para la página de resultados de Google (máximo recomendado: 160 caracteres).')
                    ->columnSpanFull(),

                TextInput::make('meta_keywords')
                    ->label('Palabras Clave (Keywords)')
                    ->placeholder('coaching ontológico, sesiones online, desarrollo personal')
                    ->maxLength(255)
                    ->helperText('Términos relevantes separados por comas.')
                    ->columnSpan(1),

                FileUpload::make('meta_image')
                    ->label('Imagen para Redes Sociales (Open Graph)')
                    ->image()
                    ->disk('public')
                    ->directory('uploads/seo')
                    ->visibility('public')
                    ->helperText('Imagen para compartir en WhatsApp, Facebook, LinkedIn o Twitter (recomendado: 1200x630 px).')
                    ->columnSpan(1),
            ]);
    }
}
