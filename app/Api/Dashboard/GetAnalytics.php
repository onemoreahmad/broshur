<?php

namespace App\Api\Dashboard;

use Lorisleiva\Actions\Concerns\AsAction;
 
use App\Services\AnalyticsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use MeShaon\RequestAnalytics\Http\Requests\OverviewRequest;
use MeShaon\RequestAnalytics\Http\Requests\PageViewsRequest;
use MeShaon\RequestAnalytics\Http\Requests\VisitorsRequest;
use App\Models\Order;
use App\Models\Subscriber;
 

class GetAnalytics extends BaseController
{
  
    public function __construct(protected AnalyticsService $analyticsService) {}

    public function overview(OverviewRequest $request): JsonResponse
    {
        $params = $request->validated();
        $dateRange = $this->analyticsService->getDateRange($params);
        $tenant = tenant();
        $data = Cache::remember("tenant{$tenant->id}_api_overview_{$dateRange['key']}", now()->addMinutes(5), fn (): array => $this->analyticsService->getOverviewData($params));
        $order = Order::where('tenant_id', $tenant->id)->where('created_at', '>=', $dateRange['start'])->where('created_at', '<=', $dateRange['end'])->get();
        $orderCount = $order->count();
        $orderTotal = $order->sum('total');

        return response()->json([
            'data' => $data,
            'date_range' => $dateRange,
            'order' => $order,
            'order_count' => $orderCount,
            'order_total' => $orderTotal,
            'subscribers_count' => Subscriber::count('id'),
        ]);
    }

    public function visitors(VisitorsRequest $request): JsonResponse
    {
        $params = $request->validated();
        $perPage = (int) $request->input('per_page', 50);

        $visitors = $this->analyticsService->getVisitors($params, $perPage);

        return response()->json([
            'data' => $visitors,
        ]);
    }

    public function pageViews(PageViewsRequest $request): JsonResponse
    {
        $params = $request->validated();
        $perPage = (int) $request->input('per_page', 50);

        $pageViews = $this->analyticsService->getPageViews($params, $perPage);

        return response()->json([
            'data' => $pageViews,
        ]);
    }
}