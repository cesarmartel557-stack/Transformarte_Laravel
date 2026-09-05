<?php

namespace App\Filament\Resources\Ebooks\Schemas;

use App\Filament\Support\SeoFormSection;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EbookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('imagen')
                    ->label('Imagen de tapa')
                    ->image()
                    ->disk('public')
                    ->directory('uploads/img'),
                TextInput::make('titulo')
                    ->label('Título')
                    ->helperText('Podés usar <br> para saltos de línea.')
                    ->required(),
                Textarea::make('texto')
                    ->label('Texto')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('pdf')
                    ->label('Archivo PDF')
                    ->acceptedFileTypes(['application/pdf'])
                    ->disk('public')
                    ->directory('uploads/pdfs')
                    ->maxSize(20480),
                SeoFormSection::make('SEO del Ebook'),
            ]);
    }
}
