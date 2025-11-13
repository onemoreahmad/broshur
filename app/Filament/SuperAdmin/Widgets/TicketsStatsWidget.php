<?php

namespace App\Filament\SuperAdmin\Widgets;

use App\Models\Ticket;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TicketsStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalTickets = Ticket::count();
        $openTickets = Ticket::where('status', 'open')->count();
        $pendingTickets = Ticket::where('status', 'pending')->count();
        $closedTickets = Ticket::where('status', 'closed')->count();
        $recentTickets = Ticket::where('created_at', '>=', now()->subDays(7))->count();
        $highPriorityTickets = Ticket::where('priority', 3)->whereIn('status', ['open', 'pending'])->count();

        return [
            Stat::make('إجمالي التذاكر', $totalTickets)
                ->description('جميع تذاكر الدعم')
                ->descriptionIcon('heroicon-m-ticket')
                ->color('primary'),
            Stat::make('تذاكر مفتوحة', $openTickets)
                ->description('تذاكر مفتوحة تحتاج متابعة')
                ->descriptionIcon('heroicon-m-clock')
                ->color('success'),
            Stat::make('تذاكر قيد الانتظار', $pendingTickets)
                ->description('تذاكر في انتظار رد')
                ->descriptionIcon('heroicon-m-pause-circle')
                ->color('warning'),
            Stat::make('تذاكر مغلقة', $closedTickets)
                ->description('تذاكر تم حلها')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('gray'),
            Stat::make('تذاكر عالية الأولوية', $highPriorityTickets)
                ->description('تذاكر عالية الأولوية مفتوحة')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
            Stat::make('تذاكر جديدة (7 أيام)', $recentTickets)
                ->description('تم إنشاؤها خلال آخر 7 أيام')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info'),
        ];
    }
}

