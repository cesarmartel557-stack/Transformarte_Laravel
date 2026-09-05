<?php

namespace App\Filament\Resources\Transformartes;

use App\Filament\Resources\Transformartes\Pages\CreateTransformarte;
use App\Filament\Resources\Transformartes\Pages\EditTransformarte;
use App\Filament\Resources\Transformartes\Pages\ListTransformartes;
use App\Filament\Resources\Transformartes\RelationManagers\ItemsRelationManager;
use App\Models\Transformarte;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class TransformarteResource extends Resource
{
    protected static ?string $model = Transformarte::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-sparkles';

    protected static string|UnitEnum|null $navigationGroup = 'Secciones';

    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'Transformarte';

    protected static ?string $pluralModelLabel = 'Transformarte';

    public static function canCreate(): bool
    {
        return Transformarte::count() === 0;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('insignia')
                    ->label('Insignia')
                    ->required(),
                TextInput::make('titulo')
                    ->label('Título')
                    ->helperText('Podés usar <br> para saltos de línea.')
                    ->required(),
                Textarea::make('parrafo_1')
                    ->label('Párrafo 1')
                    ->rows(4)
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('parrafo_2')
                    ->label('Párrafo 2')
                    ->rows(4)
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('imagen')
                    ->label('Imagen')
                    ->image()
                    ->disk('public')
                    ->directory('uploads/img')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('insignia')
                    ->label('Insignia'),
                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable(),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTransformartes::route('/'),
            'create' => CreateTransformarte::route('/create'),
            'edit' => EditTransformarte::route('/{record}/edit'),
        ];
    }
}
