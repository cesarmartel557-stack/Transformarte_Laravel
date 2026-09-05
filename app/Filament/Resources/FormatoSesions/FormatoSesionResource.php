<?php

namespace App\Filament\Resources\FormatoSesions;

use App\Filament\Resources\FormatoSesions\Pages\CreateFormatoSesion;
use App\Filament\Resources\FormatoSesions\Pages\EditFormatoSesion;
use App\Filament\Resources\FormatoSesions\Pages\ListFormatoSesions;
use App\Filament\Resources\FormatoSesions\Schemas\FormatoSesionForm;
use App\Filament\Resources\FormatoSesions\Tables\FormatoSesionsTable;
use App\Models\FormatoSesion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class FormatoSesionResource extends Resource
{
    protected static ?string $model = FormatoSesion::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-briefcase';

    protected static string|UnitEnum|null $navigationGroup = 'Servicios';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Formato de sesión';

    protected static ?string $pluralModelLabel = 'Sesiones';

    public static function form(Schema $schema): Schema
    {
        return FormatoSesionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FormatoSesionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFormatoSesions::route('/'),
            'create' => CreateFormatoSesion::route('/create'),
            'edit' => EditFormatoSesion::route('/{record}/edit'),
        ];
    }
}
