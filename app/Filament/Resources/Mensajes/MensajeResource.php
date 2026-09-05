<?php

namespace App\Filament\Resources\Mensajes;

use App\Filament\Resources\Mensajes\Pages\ListMensajes;
use App\Models\Mensaje;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MensajeResource extends Resource
{
    protected static ?string $model = Mensaje::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-inbox';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Mensaje';

    protected static ?string $pluralModelLabel = 'Mensajes';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos de contacto')
                    ->columns(2)
                    ->components([
                        TextEntry::make('nombre')->label('Nombre'),
                        TextEntry::make('apellido')->label('Apellido'),
                        TextEntry::make('email')->label('Email')->copyable(),
                        TextEntry::make('telefono')->label('Teléfono')->placeholder('No indicó'),
                        TextEntry::make('sesion')->label('Le interesa'),
                        TextEntry::make('created_at')->label('Recibido')->dateTime(),
                    ]),
                Section::make('Mensaje')
                    ->components([
                        TextEntry::make('mensaje')->label('Mensaje')->html(false)->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                IconColumn::make('leido')
                    ->label('Leído')
                    ->boolean(),
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->formatStateUsing(fn (Mensaje $record): string => $record->nombre.' '.$record->apellido)
                    ->searchable(['nombre', 'apellido'])
                    ->weight(fn (Mensaje $record): ?string => $record->leido ? null : 'bold'),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('sesion')
                    ->label('Le interesa')
                    ->badge()
                    ->limit(25),
                TextColumn::make('created_at')
                    ->label('Recibido')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMensajes::route('/'),
        ];
    }
}
