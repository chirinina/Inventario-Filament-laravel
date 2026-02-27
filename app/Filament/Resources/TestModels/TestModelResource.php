<?php

namespace App\Filament\Resources\TestModels;

use App\Filament\Resources\TestModels\Pages\CreateTestModel;
use App\Filament\Resources\TestModels\Pages\EditTestModel;
use App\Filament\Resources\TestModels\Pages\ListTestModels;
use App\Filament\Resources\TestModels\Pages\ViewTestModel;
use App\Filament\Resources\TestModels\Schemas\TestModelForm;
use App\Filament\Resources\TestModels\Schemas\TestModelInfolist;
use App\Filament\Resources\TestModels\Tables\TestModelsTable;
use App\Models\TestModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestModelResource extends Resource
{
    protected static ?string $model = TestModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Prueba';

    public static function form(Schema $schema): Schema
    {
        return TestModelForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TestModelInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TestModelsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTestModels::route('/'),
            'create' => CreateTestModel::route('/create'),
            'view' => ViewTestModel::route('/{record}'),
            'edit' => EditTestModel::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
