<?php

namespace App\Filament\SuperAdmin\Widgets;

use App\Models\Tenant;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TenantsStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalTenants = Tenant::count();
        $activeTenants = Tenant::where('active', true)->count();
        $inactiveTenants = Tenant::where('active', false)->count();
        $recentTenants = Tenant::where('created_at', '>=', now()->subDays(7))->count();

        return [
            Stat::make('إجمالي العملاء', $totalTenants)
                ->description('جميع العملاء المسجلين')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5]),
            Stat::make('العملاء النشطون', $activeTenants)
                ->description('العملاء النشطون حالياً')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            Stat::make('العملاء غير النشطين', $inactiveTenants)
                ->description('العملاء غير النشطين')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('gray'),
            Stat::make('عملاء جدد (7 أيام)', $recentTenants)
                ->description('تم التسجيل خلال آخر 7 أيام')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info'),
        ];
    }
}

