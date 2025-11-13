<?php

namespace App\Filament\SuperAdmin\Resources\Tenants;

use App\Filament\SuperAdmin\Resources\Tenants\Pages\CreateTenant;
use App\Filament\SuperAdmin\Resources\Tenants\Pages\EditTenant;
use App\Filament\SuperAdmin\Resources\Tenants\Pages\ListTenants;
use App\Filament\SuperAdmin\Resources\Tenants\Pages\ViewTenant;
use App\Filament\SuperAdmin\Resources\Tenants\Schemas\TenantForm;
use App\Filament\SuperAdmin\Resources\Tenants\Tables\TenantsTable;
use App\Models\Tenant;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationLabel = 'العملاء';
    
    protected static ?string $modelLabel = 'عميل';
    
    protected static ?string $pluralModelLabel = 'العملاء';
    
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-building-office';
    
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return TenantForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TenantsTable::configure($table);
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
            'index' => ListTenants::route('/'),
            'create' => CreateTenant::route('/create'),
            'view' => ViewTenant::route('/{record}'),
            'edit' => EditTenant::route('/{record}/edit'),
        ];
    }
}
