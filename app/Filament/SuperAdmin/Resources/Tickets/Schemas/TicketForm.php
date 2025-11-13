<?php

namespace App\Filament\SuperAdmin\Resources\Tickets\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('معلومات التذكرة')
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
                        TextInput::make('subject')
                            ->label('الموضوع')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('message')
                            ->label('الرسالة')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                        Select::make('status')
                            ->label('الحالة')
                            ->options([
                                'open' => 'مفتوحة',
                                'pending' => 'قيد الانتظار',
                                'closed' => 'مغلقة',
                            ])
                            ->default('open')
                            ->required(),
                        Select::make('priority')
                            ->label('الأولوية')
                            ->options([
                                1 => 'منخفضة',
                                2 => 'متوسطة',
                                3 => 'عالية',
                            ])
                            ->default(1)
                            ->required(),
                        DateTimePicker::make('closed_at')
                            ->label('تاريخ الإغلاق'),
                    ])
                    ->columns(2),
            ]);
    }
}
