<?php

namespace App\Filament\Resources\Transformartes\Pages;

use App\Filament\Resources\Transformartes\TransformarteResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTransformarte extends EditRecord
{
    protected static string $resource = TransformarteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
