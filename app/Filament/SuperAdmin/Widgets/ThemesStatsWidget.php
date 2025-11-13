<?php

namespace App\Filament\SuperAdmin\Widgets;

use App\Models\Theme;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ThemesStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalThemes = Theme::count();
        $activeThemes = Theme::where('active', true)->count();
        $publishedThemes = Theme::where('is_published', true)->count();
        $purchasableThemes = Theme::where('is_purchasable', true)->count();

        return [
            Stat::make('إجمالي القوالب', $totalThemes)
                ->description('جميع القوالب المتاحة')
                ->descriptionIcon('heroicon-m-paint-brush')
                ->color('primary'),
            Stat::make('قوالب نشطة', $activeThemes)
                ->description('قوالب نشطة ومتاحة للاستخدام')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            Stat::make('قوالب منشورة', $publishedThemes)
                ->description('قوالب منشورة للعامة')
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('info'),
            Stat::make('قوالب قابلة للشراء', $purchasableThemes)
                ->description('قوالب متاحة للشراء')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),
        ];
    }
}

