<?php

namespace App\Filament\Resources\Transformartes\Pages;

use App\Filament\Resources\Transformartes\TransformarteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTransformartes extends ListRecords
{
    protected static string $resource = TransformarteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
