<?php

namespace App\Filament\Resources\Tallers\Pages;

use App\Filament\Resources\Tallers\TallerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTaller extends EditRecord
{
    protected static string $resource = TallerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
