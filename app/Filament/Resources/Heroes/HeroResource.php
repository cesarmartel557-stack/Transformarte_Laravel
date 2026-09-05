<?php

namespace App\Filament\Resources\Heroes;

use App\Filament\Resources\Heroes\Pages\ManageHeroes;
use App\Filament\Support\SeoFormSection;
use App\Models\Hero;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class HeroResource extends Resource
{
    protected static ?string $model = Hero::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';

    protected static string|UnitEnum|null $navigationGroup = 'Secciones';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Portada (Hero)';

    protected static ?string $pluralModelLabel = 'Portada';

    public static function canCreate(): bool
    {
        return Hero::count() === 0;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->label('Título')
                    ->required(),
                Textarea::make('subtitulo')
                    ->label('Subtítulo')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('boton_texto')
                    ->label('Texto del botón')
                    ->required(),
                TextInput::make('boton_url')
                    ->label('URL del botón')
                    ->helperText('Puede ser un enlace externo (https://...) o un ancla (#contacto).')
                    ->required(),
                FileUpload::make('imagen')
                    ->label('Imagen de fondo')
                    ->image()
                    ->disk('public')
                    ->directory('uploads/img')
                    ->columnSpanFull(),
                SeoFormSection::make('SEO de la Portada (Home)'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable(),
                TextColumn::make('boton_texto')
                    ->label('Botón'),
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
            'index' => ManageHeroes::route('/'),
        ];
    }
}
