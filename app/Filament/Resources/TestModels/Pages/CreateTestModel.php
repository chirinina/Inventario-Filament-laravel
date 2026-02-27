<?php

namespace App\Filament\Resources\TestModels\Pages;

use App\Filament\Resources\TestModels\TestModelResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTestModel extends CreateRecord
{
    protected static string $resource = TestModelResource::class;
}
