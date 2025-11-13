<?php

namespace App\Filament\SuperAdmin\Pages;

use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;

class CustomDashboard extends BaseDashboard
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-home';
    
    protected static ?string $navigationLabel = 'لوحة التحكم';
    
    public function getWidgets(): array
    {
        return [
            \App\Filament\SuperAdmin\Widgets\TenantsStatsWidget::class,
            \App\Filament\SuperAdmin\Widgets\TicketsStatsWidget::class,
            \App\Filament\SuperAdmin\Widgets\ThemesStatsWidget::class,
            \App\Filament\SuperAdmin\Widgets\BlocksStatsWidget::class,
        ];
    }
}

