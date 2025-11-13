<?php

namespace App\Filament\SuperAdmin\Resources\Themes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ThemeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('معلومات القالب')
                    ->schema([
                        TextInput::make('name')
                            ->label('الاسم')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->label('المعرف')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        TextInput::make('type')
                            ->label('النوع')
                            ->default('site-theme')
                            ->maxLength(80),
                        TextInput::make('app')
                            ->label('التطبيق')
                            ->default('linkinbio')
                            ->maxLength(100),
                        TextInput::make('subtype')
                            ->label('النوع الفرعي')
                            ->maxLength(80),
                        Select::make('user_id')
                            ->label('تم الإنشاء بواسطة')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->default(1),
                        Select::make('tenant_id')
                            ->label('العميل')
                            ->relationship('tenant', 'name')
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(2),
                Section::make('الإعدادات')
                    ->schema([
                        Toggle::make('is_system')
                            ->label('نظام')
                            ->default(false)
                            ->required(),
                        Toggle::make('active')
                            ->label('نشط')
                            ->default(true)
                            ->required(),
                        Toggle::make('is_published')
                            ->label('منشور')
                            ->default(true)
                            ->required(),
                        Toggle::make('is_purchasable')
                            ->label('قابل للشراء')
                            ->default(false)
                            ->required(),
                        TextInput::make('price')
                            ->label('السعر')
                            ->numeric()
                            ->default(0)
                            ->prefix('$'),
                        Select::make('recurring')
                            ->label('التكرار')
                            ->options([
                                'once' => 'مرة واحدة',
                                'monthly' => 'شهري',
                            ])
                            ->default('once')
                            ->required(),
                        TextInput::make('order')
                            ->label('الترتيب')
                            ->numeric()
                            ->default(100),
                    ])
                    ->columns(3),
            ]);
    }
}
