<?php

namespace App\Filament\Resources\Ebooks;

use App\Filament\Resources\Ebooks\Pages\CreateEbook;
use App\Filament\Resources\Ebooks\Pages\EditEbook;
use App\Filament\Resources\Ebooks\Pages\ListEbooks;
use App\Filament\Resources\Ebooks\Schemas\EbookForm;
use App\Filament\Resources\Ebooks\Tables\EbooksTable;
use App\Models\Ebook;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class EbookResource extends Resource
{
    protected static ?string $model = Ebook::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-book-open';

    protected static string|UnitEnum|null $navigationGroup = 'Contenido';

    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'Ebook';

    protected static ?string $pluralModelLabel = 'Ebooks';

    public static function form(Schema $schema): Schema
    {
        return EbookForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EbooksTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEbooks::route('/'),
            'create' => CreateEbook::route('/create'),
            'edit' => EditEbook::route('/{record}/edit'),
        ];
    }
}
