<?php

namespace App\Filament\Resources\Herramientas;

use App\Filament\Resources\Herramientas\Pages\CreateHerramienta;
use App\Filament\Resources\Herramientas\Pages\EditHerramienta;
use App\Filament\Resources\Herramientas\Pages\ListHerramientas;
use App\Filament\Resources\Herramientas\Schemas\HerramientaForm;
use App\Filament\Resources\Herramientas\Tables\HerramientasTable;
use App\Models\Herramienta;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class HerramientaResource extends Resource
{
    protected static ?string $model = Herramienta::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static string|UnitEnum|null $navigationGroup = 'Contenido';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Herramienta';

    protected static ?string $pluralModelLabel = 'Herramientas';

    public static function form(Schema $schema): Schema
    {
        return HerramientaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HerramientasTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHerramientas::route('/'),
            'create' => CreateHerramienta::route('/create'),
            'edit' => EditHerramienta::route('/{record}/edit'),
        ];
    }
}
