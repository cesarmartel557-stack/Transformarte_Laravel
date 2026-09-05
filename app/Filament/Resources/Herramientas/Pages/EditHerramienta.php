<?php

namespace App\Filament\Resources\Herramientas\Pages;

use App\Filament\Resources\Herramientas\HerramientaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHerramienta extends EditRecord
{
    protected static string $resource = HerramientaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
