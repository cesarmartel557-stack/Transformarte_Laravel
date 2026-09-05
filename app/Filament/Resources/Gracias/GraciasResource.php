<?php

namespace App\Filament\Resources\Gracias;

use App\Filament\Resources\Gracias\Pages\ManageGracias;
use App\Filament\Support\SeoFormSection;
use App\Models\Gracias;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class GraciasResource extends Resource
{
    protected static ?string $model = Gracias::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-envelope-open';

    protected static string|UnitEnum|null $navigationGroup = 'Secciones';

    protected static ?int $navigationSort = 4;

    protected static ?string $modelLabel = 'Página de gracias';

    protected static ?string $pluralModelLabel = 'Página de gracias';

    public static function canCreate(): bool
    {
        return Gracias::count() === 0;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('insignia')
                    ->label('Insignia superior')
                    ->helperText('Texto corto en mayúsculas que va sobre el título.')
                    ->required(),
                TextInput::make('titulo')
                    ->label('Título')
                    ->helperText('Podés usar <em>…</em> para la parte en itálica.')
                    ->required(),
                Textarea::make('texto')
                    ->label('Texto principal')
                    ->rows(3)
                    ->required(),
                Textarea::make('texto_urgencia')
                    ->label('Texto de urgencia (WhatsApp)')
                    ->rows(2)
                    ->required(),
                TextInput::make('boton_whatsapp_texto')
                    ->label('Texto del botón de WhatsApp')
                    ->required(),
                SeoFormSection::make('SEO de la Página de Gracias'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titulo')
                    ->label('Título')
                    ->limit(40),
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
            'index' => ManageGracias::route('/'),
        ];
    }
}
