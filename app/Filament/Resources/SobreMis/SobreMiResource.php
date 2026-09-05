<?php

namespace App\Filament\Resources\SobreMis;

use App\Filament\Resources\SobreMis\Pages\ManageSobreMis;
use App\Models\SobreMi;
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

class SobreMiResource extends Resource
{
    protected static ?string $model = SobreMi::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user';

    protected static string|UnitEnum|null $navigationGroup = 'Secciones';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Quién soy';

    protected static ?string $pluralModelLabel = 'Quién soy';

    public static function canCreate(): bool
    {
        return SobreMi::count() === 0;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                    ->label('Foto de Gabo')
                    ->image()
                    ->disk('public')
                    ->directory('uploads/img'),
                FileUpload::make('imagen_felino')
                    ->label('Imagen del felino')
                    ->image()
                    ->disk('public')
                    ->directory('uploads/img'),
                TextInput::make('cta_texto')
                    ->label('Texto del botón (CTA)')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable(),
                TextColumn::make('cta_texto')
                    ->label('CTA'),
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

    public static function getPages(): array
    {
        return [
            'index' => ManageSobreMis::route('/'),
        ];
    }
}
