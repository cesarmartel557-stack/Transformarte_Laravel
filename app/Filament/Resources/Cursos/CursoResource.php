<?php

namespace App\Filament\Resources\Cursos;

use App\Filament\Resources\Cursos\Pages\CreateCurso;
use App\Filament\Resources\Cursos\Pages\EditCurso;
use App\Filament\Resources\Cursos\Pages\ListCursos;
use App\Filament\Resources\Cursos\Schemas\CursoForm;
use App\Filament\Resources\Cursos\Tables\CursosTable;
use App\Models\Curso;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class CursoResource extends Resource
{
    protected static ?string $model = Curso::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';

    protected static string|UnitEnum|null $navigationGroup = 'Servicios';

    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'Curso';

    protected static ?string $pluralModelLabel = 'Cursos';

    public static function form(Schema $schema): Schema
    {
        return CursoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CursosTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCursos::route('/'),
            'create' => CreateCurso::route('/create'),
            'edit' => EditCurso::route('/{record}/edit'),
        ];
    }
}
