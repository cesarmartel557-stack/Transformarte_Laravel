<?php

namespace App\Filament\Resources\Temas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TemaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->label('Título')
                    ->helperText('Podés usar <br> para saltos de línea.')
                    ->required(),
                Textarea::make('texto')
                    ->label('Texto')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
