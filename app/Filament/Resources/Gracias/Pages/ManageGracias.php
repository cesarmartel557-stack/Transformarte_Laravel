<?php

namespace App\Filament\Resources\Gracias\Pages;

use App\Filament\Resources\Gracias\GraciasResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageGracias extends ManageRecords
{
    protected static string $resource = GraciasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
