<?php

namespace App\Filament\Resources\Testimonios\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TestimonioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('frase')
                    ->label('Frase')
                    ->rows(4)
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('nombre')
                    ->label('Nombre')
                    ->required(),
                TextInput::make('formato')
                    ->label('Formato')
                    ->helperText('Ej.: Proceso de Coaching, Sesión individual.')
                    ->required(),
            ]);
    }
}
