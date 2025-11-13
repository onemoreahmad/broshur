<?php

namespace App\Filament\SuperAdmin\Resources\Tenants\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class TenantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('تفاصيل العميل')
                    ->tabs([
                        Tab::make('المعلومات الأساسية')
                            ->schema([
                                Select::make('user_id')
                                    ->label('المالك')
                                    ->relationship('user', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Select::make('theme_id')
                                    ->label('القالب')
                                    ->relationship('theme', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->default(1)
                                    ->required(),
                                TextInput::make('handle')
                                    ->label('المعرف')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                                TextInput::make('name')
                                    ->label('الاسم')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('domain')
                                    ->label('النطاق')
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),
                                Select::make('domain_status')
                                    ->label('حالة النطاق')
                                    ->options([
                                        0 => 'غير نشط',
                                        1 => 'نشط',
                                    ])
                                    ->default(0)
                                    ->required(),
                                Toggle::make('active')
                                    ->label('نشط')
                                    ->default(true)
                                    ->required(),
                                Toggle::make('picked')
                                    ->label('مميز')
                                    ->default(false),
                                DateTimePicker::make('verified_at')
                                    ->label('تاريخ التحقق'),
                            ]),
                        Tab::make('معلومات الاتصال')
                            ->schema([
                                TextInput::make('email')
                                    ->label('البريد الإلكتروني')
                                    ->email()
                                    ->maxLength(255),
                                TextInput::make('phone')
                                    ->label('الهاتف')
                                    ->tel()
                                    ->maxLength(20),
                                TextInput::make('country')
                                    ->label('الدولة')
                                    ->default('SA')
                                    ->maxLength(4),
                                TextInput::make('city')
                                    ->label('المدينة')
                                    ->maxLength(150),
                                TextInput::make('address')
                                    ->label('العنوان')
                                    ->maxLength(255),
                                TextInput::make('sr_number')
                                    ->label('رقم السجل التجاري')
                                    ->maxLength(60),
                                TextInput::make('tax_number')
                                    ->label('الرقم الضريبي')
                                    ->maxLength(120),
                            ]),
                        Tab::make('الإعدادات')
                            ->schema([
                                TextInput::make('currency')
                                    ->label('العملة')
                                    ->default('SAR')
                                    ->maxLength(4),
                                TextInput::make('language')
                                    ->label('اللغة')
                                    ->default('ar')
                                    ->maxLength(4),
                                TextInput::make('timezone')
                                    ->label('المنطقة الزمنية')
                                    ->default('Asia/Riyadh')
                                    ->maxLength(40),
                                Toggle::make('convert_currency')
                                    ->label('تحويل العملة')
                                    ->default(false),
                                TextInput::make('traffic_website_id')
                                    ->label('معرف موقع المرور')
                                    ->maxLength(255),
                            ]),
                        Tab::make('قاعدة البيانات')
                            ->schema([
                                Toggle::make('has_own_db')
                                    ->label('لديه قاعدة بيانات خاصة')
                                    ->default(false)
                                    ->required()
                                    ->live(),
                                TextInput::make('db_host')
                                    ->label('مضيف قاعدة البيانات')
                                    ->default('127.0.0.1')
                                    ->maxLength(20)
                                    ->visible(fn ($get) => $get('has_own_db')),
                                TextInput::make('db_name')
                                    ->label('اسم قاعدة البيانات')
                                    ->maxLength(100)
                                    ->unique(ignoreRecord: true)
                                    ->visible(fn ($get) => $get('has_own_db')),
                                TextInput::make('db_username')
                                    ->label('اسم المستخدم')
                                    ->maxLength(100)
                                    ->visible(fn ($get) => $get('has_own_db')),
                                TextInput::make('db_password')
                                    ->label('كلمة المرور')
                                    ->password()
                                    ->maxLength(100)
                                    ->visible(fn ($get) => $get('has_own_db')),
                            ]),
                        Tab::make('الإحصائيات')
                            ->schema([
                                TextInput::make('reviews')
                                    ->label('التقييمات')
                                    ->numeric()
                                    ->default(0),
                                TextInput::make('visits')
                                    ->label('الزيارات')
                                    ->numeric()
                                    ->default(0),
                                TextInput::make('sales')
                                    ->label('المبيعات')
                                    ->numeric()
                                    ->default(0),
                            ]),
                    ]),
            ]);
    }
}
