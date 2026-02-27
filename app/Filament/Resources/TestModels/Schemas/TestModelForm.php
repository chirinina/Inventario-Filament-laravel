<?php

namespace App\Filament\Resources\TestModels\Schemas;

use Filament\Schemas\Schema;

class TestModelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }
}
