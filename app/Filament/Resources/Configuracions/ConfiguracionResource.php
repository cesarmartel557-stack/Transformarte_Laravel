<?php

namespace App\Filament\Resources\Configuracions;

use App\Filament\Resources\Configuracions\Pages\ManageConfiguracions;
use App\Models\Configuracion;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use UnitEnum;

class ConfiguracionResource extends Resource
{
    protected static ?string $model = Configuracion::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string|UnitEnum|null $navigationGroup = 'Configuración';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Ajustes';

    protected static ?string $pluralModelLabel = 'Ajustes Generales';

    public static function canCreate(): bool
    {
        return Configuracion::count() === 0;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Toggle::make('mostrar_ebooks')
                    ->label('Mostrar sección de Ebooks en la web')
                    ->helperText('Si se desactiva, la sección de biblioteca de ebooks y sus enlaces de navegación no se mostrarán en la web pública.')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ToggleColumn::make('mostrar_ebooks')
                    ->label('Mostrar Ebooks en la web'),
                TextColumn::make('updated_at')
                    ->label('Última modificación')
                    ->dateTime()
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageConfiguracions::route('/'),
        ];
    }
}
