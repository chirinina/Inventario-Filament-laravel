<?php

namespace App\Filament\Resources\TestModels\Pages;

use App\Filament\Resources\TestModels\TestModelResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTestModel extends ViewRecord
{
    protected static string $resource = TestModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
