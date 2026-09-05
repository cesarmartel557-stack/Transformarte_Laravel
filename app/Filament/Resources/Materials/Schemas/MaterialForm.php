<?php

namespace App\Filament\Resources\Materials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MaterialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('imagen')
                    ->label('Imagen')
                    ->image()
                    ->disk('public')
                    ->directory('uploads/img'),
                TextInput::make('insignia')
                    ->label('Insignia')
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
                TextInput::make('boton_url')
                    ->label('URL del botón')
                    ->helperText('Puede ser un enlace externo (https://...) o un ancla (#contacto).'),
            ]);
    }
}
