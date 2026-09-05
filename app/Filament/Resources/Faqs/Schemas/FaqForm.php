<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('pregunta')
                    ->label('Pregunta')
                    ->required(),
                RichEditor::make('respuesta')
                    ->label('Respuesta')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('activo')
                    ->label('Visible en la home')
                    ->default(true)
                    ->required(),
            ]);
    }
}
