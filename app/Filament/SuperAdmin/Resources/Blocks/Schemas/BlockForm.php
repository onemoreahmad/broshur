<?php

namespace App\Filament\SuperAdmin\Resources\Blocks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BlockForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('معلومات الكتلة')
                    ->schema([
                        Select::make('tenant_id')
                            ->label('العميل')
                            ->relationship('tenant', 'name')
                            ->searchable()
                            ->preload(),
                        Select::make('user_id')
                            ->label('المستخدم')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload(),
                        Select::make('theme_id')
                            ->label('القالب')
                            ->relationship('theme', 'name')
                            ->searchable()
                            ->preload(),
                        TextInput::make('name')
                            ->label('الاسم')
                            ->required()
                            ->maxLength(100),
                        TextInput::make('template')
                            ->label('القالب')
                            ->maxLength(150),
                        TextInput::make('position')
                            ->label('الموضع')
                            ->default('page')
                            ->maxLength(100),
                        TextInput::make('entry_id')
                            ->label('معرف الإدخال')
                            ->numeric(),
                        TextInput::make('order')
                            ->label('الترتيب')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Toggle::make('active')
                            ->label('نشط')
                            ->default(true)
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}
