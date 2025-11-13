<?php

namespace App\Filament\SuperAdmin\Widgets;

use App\Models\Block;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BlocksStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalBlocks = Block::count();
        $activeBlocks = Block::where('active', true)->count();
        $inactiveBlocks = Block::where('active', false)->count();
        $recentBlocks = Block::where('created_at', '>=', now()->subDays(7))->count();

        return [
            Stat::make('إجمالي الكتل', $totalBlocks)
                ->description('جميع الكتل في النظام')
                ->descriptionIcon('heroicon-m-squares-2x2')
                ->color('primary'),
            Stat::make('كتل نشطة', $activeBlocks)
                ->description('كتل نشطة ومفعلة')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            Stat::make('كتل غير نشطة', $inactiveBlocks)
                ->description('كتل معطلة')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('gray'),
            Stat::make('كتل جديدة (7 أيام)', $recentBlocks)
                ->description('تم إنشاؤها خلال آخر 7 أيام')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info'),
        ];
    }
}

