<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Detalles de la categoria')
                    ->columns(2)
                    ->schema(static::create())
            ]);
    }

    public static function create()
    {
        return [
            TextInput::make('name')
                ->required()
                ->label('Nombre')
                ->placeholder('Nombre de la categoria'),

            TextInput::make('summary')
                ->required()
                ->label('Resumen')
                ->placeholder('Resumen de la categoria'),
        ];
    }
}
