<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Filament\Resources\Categories\Schemas\CategoryForm;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Información del producto')
                    ->columns(3)
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Esta activo?')
                            ->columnSpan(3)
                            ->default(true)
                            ->required(),

                        TextInput::make('code')
                            ->label('Codigo')
                            ->placeholder('Ej: FIC-0001')
                            ->required(),

                        TextInput::make('name')
                            ->label('Nombre del producto')
                            ->required(),

                        TextInput::make('summary')
                            ->label('Resumen')
                            ->required(),

                        TextInput::make('price')
                            ->label('Precio de venta')
                            ->numeric()
                            ->minValue(0)
                            ->required()
                            ->prefix('$'),

                        // TODO: Add category relation
                        Select::make('category_id')
                            ->label('Categoría')
                            ->required()
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm(CategoryForm::create()),
                    ]),

                Section::make('Imagen del producto')
                    ->schema([
                        FileUpload::make('image')
                            ->disk('public')
                            ->label('Imagen')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->maxSize(1024)
                            ->acceptedFileTypes(['image/*'])
                            ->required(),
                    ]),
                
                Section::make('Descripción del producto')
                    ->schema([
                        RichEditor::make('description')
                        ->label('Descripción')
                        ->required()
                        ->toolbarButtons([
                            'bold',
                            'h1',
                            'h2',
                            'h3',
                            'italic',
                            'link',
                            'alignStart',
                            'alignCenter',
                            'alignEnd',
                            'undo',
                            'redo',
                            'bulletList',
                        ]),
                    ]),
            ]);
    }
}
