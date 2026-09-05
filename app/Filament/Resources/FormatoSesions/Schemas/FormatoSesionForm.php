<?php

namespace App\Filament\Resources\FormatoSesions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FormatoSesionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('insignia')
                    ->label('Insignia')
                    ->required(),
                TextInput::make('titulo')
                    ->label('Título')
                    ->required(),
                Textarea::make('parrafo_1')
                    ->label('Párrafo 1')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('parrafo_2')
                    ->label('Párrafo 2 (opcional)')
                    ->rows(3)
                    ->columnSpanFull(),
                TextInput::make('detalle')
                    ->label('Detalle (duración/precio)')
                    ->required(),
                TextInput::make('boton_texto')
                    ->label('Texto del botón')
                    ->required(),
                TextInput::make('boton_url')
                    ->label('URL del botón')
                    ->helperText('Puede ser un enlace externo (https://...) o un ancla (#contacto).')
                    ->required(),
            ]);
    }
}
