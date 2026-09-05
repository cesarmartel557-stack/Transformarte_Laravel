<?php

namespace App\Filament\Resources\Temas;

use App\Filament\Resources\Temas\Pages\CreateTema;
use App\Filament\Resources\Temas\Pages\EditTema;
use App\Filament\Resources\Temas\Pages\ListTemas;
use App\Filament\Resources\Temas\Schemas\TemaForm;
use App\Filament\Resources\Temas\Tables\TemasTable;
use App\Models\Tema;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class TemaResource extends Resource
{
    protected static ?string $model = Tema::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-light-bulb';

    protected static string|UnitEnum|null $navigationGroup = 'Contenido';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Tema';

    protected static ?string $pluralModelLabel = 'Temas de sesión';

    public static function form(Schema $schema): Schema
    {
        return TemaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TemasTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTemas::route('/'),
            'create' => CreateTema::route('/create'),
            'edit' => EditTema::route('/{record}/edit'),
        ];
    }
}
