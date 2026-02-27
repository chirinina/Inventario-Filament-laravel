<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Información del cliente')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Estado del cliente')
                            ->required()
                            ->columnSpan(2)
                            ->default(true),

                        TextInput::make('name')
                            ->label('Nombre del cliente')
                            ->required(),

                        TextInput::make('email')
                            ->label('Correo electrónico')
                            ->email()
                            ->unique(table: 'customers', column: 'email')
                            ->validationMessages([
                                'unique' => 'El correo ya está registrado en el sistema.',
                            ]),

                        TextInput::make('phone')
                            ->prefix('+591')
                            ->tel()
                            ->unique(table: 'customers', column: 'phone')
                            ->validationMessages([
                                'unique' => 'El telefono ya está registrado en el sistema.',
                            ]),
                        
                        TextInput::make('nit')
                            ->required()
                            ->unique(table: 'customers', column: 'nit')
                            ->validationMessages([
                                'unique' => 'El NIT ya está registrado en el sistema.',
                            ])
                            ->label('Razón social / NIT'),
                    ])
            ]);
    }
}
