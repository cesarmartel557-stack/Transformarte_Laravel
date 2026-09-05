<?php

namespace App\Filament\Resources\FormatoSesions\Pages;

use App\Filament\Resources\FormatoSesions\FormatoSesionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFormatoSesion extends EditRecord
{
    protected static string $resource = FormatoSesionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
