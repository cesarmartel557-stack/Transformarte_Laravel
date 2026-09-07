<?php

namespace App\Filament\Resources\Configuracions\Pages;

use App\Filament\Resources\Configuracions\ConfiguracionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageConfiguracions extends ManageRecords
{
    protected static string $resource = ConfiguracionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
