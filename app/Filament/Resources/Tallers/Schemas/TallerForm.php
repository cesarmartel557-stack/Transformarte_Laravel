<?php

namespace App\Filament\Resources\Tallers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TallerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('estado')
                    ->label('Estado')
                    ->options([
                        'inscripciones_abiertas' => 'Inscripciones abiertas',
                        'proximamente' => 'Próximamente',
                    ])
                    ->default('inscripciones_abiertas')
                    ->required(),
                TextInput::make('titulo')
                    ->label('Título')
                    ->helperText('Podés usar <br> para saltos de línea.')
                    ->required(),
                Textarea::make('texto')
                    ->label('Texto')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('boton_texto')
                    ->label('Texto del botón')
                    ->required(),
                TextInput::make('boton_url')
                    ->label('URL del botón')
                    ->helperText('Puede ser un enlace externo (https://...) o un ancla (#contacto).'),
            ]);
    }
}
