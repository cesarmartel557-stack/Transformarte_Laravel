<?php

namespace App\Filament\Resources\Tallers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TallersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->reorderable('orden')
            ->defaultSort('orden')
            ->columns([
                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable(),
                TextColumn::make('estado')
                    ->label('Estado')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state === 'inscripciones_abiertas'
                        ? 'Inscripciones abiertas'
                        : 'Próximamente')
                    ->color(fn (string $state): string => $state === 'inscripciones_abiertas'
                        ? 'success'
                        : 'gray'),
                TextColumn::make('boton_texto')
                    ->label('Botón'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
