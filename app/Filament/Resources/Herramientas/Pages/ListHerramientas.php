<?php

namespace App\Filament\Resources\Herramientas\Pages;

use App\Filament\Resources\Herramientas\HerramientaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHerramientas extends ListRecords
{
    protected static string $resource = HerramientaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
