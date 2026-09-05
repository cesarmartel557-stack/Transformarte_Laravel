<?php

namespace App\Filament\Resources\Herramientas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class HerramientaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->label('Nombre')
                    ->required(),
            ]);
    }
}
