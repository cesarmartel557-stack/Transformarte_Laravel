<?php

namespace App\Filament\Resources\FormatoSesions\Pages;

use App\Filament\Resources\FormatoSesions\FormatoSesionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFormatoSesions extends ListRecords
{
    protected static string $resource = FormatoSesionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
