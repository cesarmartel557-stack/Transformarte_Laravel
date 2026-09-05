<?php

namespace App\Filament\Resources\Cursos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CursoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->label('Título')
                    ->required(),
                Textarea::make('texto')
                    ->label('Texto')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
