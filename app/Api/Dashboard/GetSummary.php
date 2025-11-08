<?php

namespace App\Api\Dashboard;

use App\Models\Order;
use App\Models\Subscriber;
use Lorisleiva\Actions\Concerns\AsAction;

class GetSummary
{
    use AsAction;

    public function handle()
    {
        return response()->json([
            'data' => [
                'orders_count' => Order::count(),
                'subscribers_count' => Subscriber::count(),
            ],
        ]);
    }
}

