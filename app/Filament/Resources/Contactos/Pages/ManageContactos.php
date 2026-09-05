<?php

namespace App\Filament\Resources\Contactos\Pages;

use App\Filament\Resources\Contactos\ContactoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageContactos extends ManageRecords
{
    protected static string $resource = ContactoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
