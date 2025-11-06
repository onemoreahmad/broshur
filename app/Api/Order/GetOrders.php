<?php

namespace App\Api\Order;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class GetOrders
{
    use AsAction;

    public function handle(Request $request)
    {
        $orders = \App\Models\Order::where('tenant_id', $request->user()->tenant->id)
            ->with(['items'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json([
            'data' => $orders->items(),
            'pagination' => [
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'per_page' => $orders->perPage(),
                'total' => $orders->total(),
                'has_more' => $orders->hasMorePages()
            ]
        ]);
    }
}

