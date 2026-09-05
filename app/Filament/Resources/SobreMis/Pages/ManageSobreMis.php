<?php

namespace App\Filament\Resources\SobreMis\Pages;

use App\Filament\Resources\SobreMis\SobreMiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSobreMis extends ManageRecords
{
    protected static string $resource = SobreMiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
