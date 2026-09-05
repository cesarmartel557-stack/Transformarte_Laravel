<?php

namespace App\Filament\Resources\Tallers;

use App\Filament\Resources\Tallers\Pages\CreateTaller;
use App\Filament\Resources\Tallers\Pages\EditTaller;
use App\Filament\Resources\Tallers\Pages\ListTallers;
use App\Filament\Resources\Tallers\Schemas\TallerForm;
use App\Filament\Resources\Tallers\Tables\TallersTable;
use App\Models\Taller;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class TallerResource extends Resource
{
    protected static ?string $model = Taller::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static string|UnitEnum|null $navigationGroup = 'Servicios';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Taller';

    protected static ?string $pluralModelLabel = 'Talleres';

    public static function form(Schema $schema): Schema
    {
        return TallerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TallersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTallers::route('/'),
            'create' => CreateTaller::route('/create'),
            'edit' => EditTaller::route('/{record}/edit'),
        ];
    }
}
