<?php

namespace App\Filament\Resources\Contactos;

use App\Filament\Resources\Contactos\Pages\ManageContactos;
use App\Models\Contacto;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class ContactoResource extends Resource
{
    protected static ?string $model = Contacto::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-envelope';

    protected static string|UnitEnum|null $navigationGroup = 'Configuración';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Contacto';

    protected static ?string $pluralModelLabel = 'Contacto';

    public static function canCreate(): bool
    {
        return Contacto::count() === 0;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),
                TextInput::make('whatsapp')
                    ->label('WhatsApp (solo números)')
                    ->helperText('Ej.: 5491149274026 (código de país + número, sin +).')
                    ->required(),
                TextInput::make('calendly_url')
                    ->label('URL de Agendamiento (Google Calendar)')
                    ->helperText('Enlace directo de Google Calendar o servicio de agendamiento.')
                    ->url()
                    ->required(),
                TextInput::make('instagram_url')
                    ->label('URL de Instagram')
                    ->url()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('whatsapp')
                    ->label('WhatsApp'),
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
            'index' => ManageContactos::route('/'),
        ];
    }
}
